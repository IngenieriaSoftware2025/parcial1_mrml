// 🎯 IMPORTS NECESARIOS
import { Dropdown } from "bootstrap";
import Swal from "sweetalert2";
import { validarFormulario } from '../funciones';
import DataTable from "datatables.net-bs5";
import { lenguaje } from "../lenguaje";

// 🎯 ELEMENTOS DEL DOM
const FormRegistro = document.getElementById('FormRegistro'); 
const BtnGuardar = document.getElementById('BtnGuardar');
const BtnLimpiar = document.getElementById('BtnLimpiar');
const selectActividades = document.getElementById('act_id');

// FUNCIÓN: Cargar actividades disponibles en el select
const CargarActividades = async () => {
    try {
        const url = '/parcial1_mrml/registro/obtenerRegistrosConActividades';
        const respuesta = await fetch(url);
        const datos = await respuesta.json();
        
        if (datos.codigo == 1) {
            selectActividades.innerHTML = '<option value="">Seleccionar actividad...</option>';
            
            datos.data.forEach(actividad => {
                const option = document.createElement('option');
                option.value = actividad.act_id;
                
                // Formatear fecha para mostrar
                const fecha = new Date(actividad.act_fecha);
                const fechaFormateada = fecha.toLocaleString('es-ES', {
                    year: 'numeric',
                    month: '2-digit',
                    day: '2-digit',
                    hour: '2-digit',
                    minute: '2-digit'
                });
                
                option.textContent = `${actividad.act_nombre} - ${fechaFormateada}`;
                option.dataset.fechaActividad = actividad.act_fecha;
                selectActividades.appendChild(option);
            });
        } else {
            selectActividades.innerHTML = '<option value="">No hay actividades disponibles</option>';
        }
    } catch (error) {
        console.error('Error al cargar actividades:', error);
        selectActividades.innerHTML = '<option value="">Error al cargar actividades</option>';
    }
};

// FUNCIÓN: Mostrar información de puntualidad en tiempo real
const MostrarInfoPuntualidad = () => {
    const actividadSeleccionada = selectActividades.selectedOptions[0];
    
    if (!actividadSeleccionada || !actividadSeleccionada.value) {
        document.getElementById('info-puntualidad')?.remove();
        return;
    }

    const fechaActividad = new Date(actividadSeleccionada.dataset.fechaActividad);
    const ahora = new Date();
    const diferenciaMs = ahora - fechaActividad;
    const diferenciaMinutos = Math.floor(diferenciaMs / (1000 * 60));

    // Como se mostrara el estado de una forma dinamica
    let estado, clase, icono;
    if (diferenciaMinutos <= 5) {
        estado = 'PUNTUAL';
        clase = 'success';
        icono = 'bi-check-circle-fill';

    } else if (diferenciaMinutos <= 15) {
        estado = 'TARDANZA';
        clase = 'warning';
        icono = 'bi-exclamation-triangle-fill';
    } else {
        estado = 'IMPUNTUAL';
        clase = 'danger';
        icono = 'bi-x-circle-fill';
    }

    // Crear o actualizar el elemento de información
    let infoElement = document.getElementById('info-puntualidad');
    if (!infoElement) {
        infoElement = document.createElement('div');
        infoElement.id = 'info-puntualidad';
        infoElement.className = 'mt-3';
        selectActividades.parentElement.parentElement.appendChild(infoElement);
    }

    const mensaje = diferenciaMinutos <= 0 
        ? 'A tiempo para la actividad' 
        : `${Math.abs(diferenciaMinutos)} minutos de diferencia`;

    infoElement.innerHTML = `
        <div class="alert alert-${clase} d-flex align-items-center">
            <i class="bi ${icono} me-2"></i>
            <div>
                <strong>Estado previsto: ${estado}</strong><br>
                <small>${mensaje}</small>
            </div>
        </div>
    `;
};

// 🎯 FUNCIÓN: Guardar registro de asistencia
const GuardarRegistro = async (event) => {
    event.preventDefault();
    BtnGuardar.disabled = true;

    if (!validarFormulario(FormRegistro, ['reg_id'])) {
        Swal.fire({
            position: "center",
            icon: "info",
            title: "FORMULARIO INCOMPLETO",
            text: "Debe seleccionar una actividad",
            showConfirmButton: true,
        });
        BtnGuardar.disabled = false;
        return;
    }

    const body = new FormData(FormRegistro);
    
    const url = '/parcial1_mrml/registro/guardarAPI';
    const config = {
        method: 'POST',
        body
    };

    try {
        const respuesta = await fetch(url, config);
        const datos = await respuesta.json();
        
        const { codigo, mensaje, estado_asistencia, diferencia_minutos } = datos;

        if (codigo == 1) {
            // Mostrar alerta con información detallada
            let iconoResultado = 'success';
            if (estado_asistencia === 'TARDANZA') iconoResultado = 'warning';
            if (estado_asistencia === 'IMPUNTUAL') iconoResultado = 'error';

            await Swal.fire({
                position: "center",
                icon: iconoResultado,
                title: "¡Asistencia Registrada!",
                html: `
                    <div class="text-center">
                        <h5>Estado: <span class="badge bg-${iconoResultado === 'error' ? 'danger' : iconoResultado}">${estado_asistencia}</span></h5>
                        <p class="mb-0">${mensaje}</p>
                        ${diferencia_minutos > 0 ? `<small class="text-muted">Diferencia: ${diferencia_minutos} minutos</small>` : ''}
                    </div>
                `,
                showConfirmButton: true,
                confirmButtonText: 'Entendido'
            });

            limpiarTodo();
            BuscarRegistros();
        } else {
            await Swal.fire({
                position: "center",
                icon: "error",
                title: "Error",
                text: mensaje,
                showConfirmButton: true,
            });
        }
    } catch (error) {
        console.error('Error:', error);
        await Swal.fire({
            position: "center",
            icon: "error",
            title: "Error de conexión",
            text: "No se pudo conectar con el servidor",
            showConfirmButton: true,
        });
    }
    
    BtnGuardar.disabled = false;
};

// 🎯 FUNCIÓN: Buscar registros
const BuscarRegistros = async () => {
    const url = '/parcial1_mrml/registro/buscarAPI';
    const config = { method: 'GET' };

    try {
        const respuesta = await fetch(url, config);
        const datos = await respuesta.json();
        const { codigo, mensaje, data } = datos;

        if (codigo == 1) {
            datatable.clear().draw();
            datatable.rows.add(data).draw();
        } else {
            await Swal.fire({
                position: "center",
                icon: "info",
                title: "Información",
                text: mensaje,
                showConfirmButton: true,
            });
        }
    } catch (error) {
        console.error('Error:', error);
    }
};

//CONFIGURACIÓN DEL DATATABLE
const datatable = new DataTable('#TableRegistros', {
    dom: `
        <"row mt-3 justify-content-between" 
            <"col" l> 
            <"col" B> 
            <"col-3" f>
        >
        t
        <"row mt-3 justify-content-between" 
            <"col-md-3 d-flex align-items-center" i> 
            <"col-md-8 d-flex justify-content-end" p>
        >
    `,
    language: lenguaje,
    data: [],
    order: [[1, 'desc']], // Ordenar por fecha de registro descendente
    columns: [
        {
            title: 'No.',
            data: 'reg_id',
            width: '5%',
            render: (data, type, row, meta) => meta.row + 1
        },
        {
            title: 'Fecha/Hora Registro',
            data: 'reg_fecha',
            width: '20%',
            render: (data) => {
                const fecha = new Date(data);
                return fecha.toLocaleString('es-ES', {
                    year: 'numeric',
                    month: '2-digit',
                    day: '2-digit',
                    hour: '2-digit',
                    minute: '2-digit',
                    second: '2-digit'
                });
            }
        },
        {
            title: 'Actividad',
            data: 'act_nombre',
            width: '25%'
        },
        {
            title: 'Fecha Programada',
            data: 'fecha_programada_actividad',
            width: '20%',
            render: (data) => {
                const fecha = new Date(data);
                return fecha.toLocaleString('es-ES', {
                    year: 'numeric',
                    month: '2-digit',
                    day: '2-digit',
                    hour: '2-digit',
                    minute: '2-digit'
                });
            }
        },
        {
            title: 'Estado Asistencia',
            data: 'estado_asistencia',
            width: '15%',
            render: (data) => {
                let clase = '';
                let icono = '';
                
                switch (data) {
                    case 'PUNTUAL':
                        clase = 'bg-success';
                        icono = 'bi-check-circle-fill';
                        break;
                    case 'TARDANZA':
                        clase = 'bg-warning';
                        icono = 'bi-exclamation-triangle-fill';
                        break;
                    case 'IMPUNTUAL':
                        clase = 'bg-danger';
                        icono = 'bi-x-circle-fill';
                        break;
                    default:
                        clase = 'bg-secondary';
                        icono = 'bi-question-circle-fill';
                }
                
                return `<span class="badge ${clase}"><i class="bi ${icono} me-1"></i>${data}</span>`;
            }
        },
        {
            title: 'Acciones',
            data: 'reg_id',
            width: '15%',
            searchable: false,
            orderable: false,
            render: (data) => {
                return `
                    <div class='d-flex justify-content-center'>
                        <button class='btn btn-danger btn-sm eliminar' 
                            data-id="${data}">
                            <i class="bi bi-trash3 me-1"></i>Eliminar
                        </button>
                    </div>
                `;
            }
        }
    ]
});

//Limpiar formulario
const limpiarTodo = () => {
    FormRegistro.reset();
    document.getElementById('info-puntualidad')?.remove();
    CargarActividades(); // Recargar actividades
};

// 🎯 FUNCIÓN: Eliminar registro
const EliminarRegistro = async (e) => {
    const idRegistro = e.currentTarget.dataset.id;

    const AlertaConfirmarEliminar = await Swal.fire({
        position: "center",
        icon: "warning",
        title: "¿Confirmar eliminación?",
        text: '¿Está seguro que desea eliminar este registro de asistencia?',
        showConfirmButton: true,
        confirmButtonText: 'Sí, Eliminar',
        confirmButtonColor: '#dc3545',
        cancelButtonText: 'Cancelar',
        showCancelButton: true
    });

    if (AlertaConfirmarEliminar.isConfirmed) {
        const url = `/parcial1_mrml/registro/eliminar?id=${idRegistro}`;
        const config = { method: 'GET' };

        try {
            const consulta = await fetch(url, config);
            const respuesta = await consulta.json();
            const { codigo, mensaje } = respuesta;

            if (codigo == 1) {
                await Swal.fire({
                    position: "center",
                    icon: "success",
                    title: "Eliminado",
                    text: mensaje,
                    showConfirmButton: true,
                });
                BuscarRegistros();
            } else {
                await Swal.fire({
                    position: "center",
                    icon: "error",
                    title: "Error",
                    text: mensaje,
                    showConfirmButton: true,
                });
            }
        } catch (error) {
            console.error('Error:', error);
        }
    }
};

//EVENT LISTENERS
document.addEventListener('DOMContentLoaded', () => {
    CargarActividades();
});

// Mostrar información de puntualidad cuando cambia la selección
selectActividades.addEventListener('change', MostrarInfoPuntualidad);

FormRegistro.addEventListener('submit', GuardarRegistro);
BtnLimpiar.addEventListener('click', limpiarTodo);
datatable.on('click', '.eliminar', EliminarRegistro);

// Cargar datos iniciales
BuscarRegistros();