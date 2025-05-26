// 🎯 IMPORTS NECESARIOS (igual que usuarios)
import { Dropdown } from "bootstrap";
import Swal from "sweetalert2";
import { validarFormulario } from '../funciones';
import DataTable from "datatables.net-bs5";
import { lenguaje } from "../lenguaje";
import { data } from "jquery";


//Elementos del DOM 
const FormActividades = document.getElementById('FormActividades'); 
const BtnGuardar = document.getElementById('BtnGuardar');
const BtnModificar = document.getElementById('BtnModificar');
const BtnLimpiar = document.getElementById('BtnLimpiar');  


// Guardar 
const GuardarActividades = async (event) => {
    event.preventDefault();
    BtnGuardar.disabled = true;

    if (!validarFormulario(FormActividades, ['act_id'])) { 
        Swal.fire({
            position: "center",
            icon: "info",
            title: "FORMULARIO INCOMPLETO",
            text: "Debe de validar todos los campos",
            showConfirmButton: true,
        });
        BtnGuardar.disabled = false;
        return; 
    }

    const body = new FormData(FormActividades);  

    const url = '/parcial1_mrml/actividades/guardarAPI';
    const config = {
        method: 'POST',
        body
    }

    try {
        const respuesta = await fetch(url, config);
        const datos = await respuesta.json();
        console.log(datos)
        const { codigo, mensaje } = datos

        if (codigo == 1) {
            await Swal.fire({
                position: "center",
                icon: "success",
                title: "Exito",
                text: mensaje,
                showConfirmButton: true,
            });

            limpiarTodo();
            BuscarActividades(); 
        } else {
            await Swal.fire({
                position: "center",
                icon: "info",
                title: "Error",
                text: mensaje,
                showConfirmButton: true,
            });
        }
    } catch (error) {
        console.log(error)
    }
    BtnGuardar.disabled = false;
}

//  Buscar
const BuscarActividades = async () => {
    const url = '/parcial1_mrml/actividades/buscarAPI';
    const config = {
        method: 'GET'
    }

    try {
        const respuesta = await fetch(url, config);
        const datos = await respuesta.json();
        const { codigo, mensaje, data } = datos

        if (codigo == 1) {
            datatable.clear().draw();
            datatable.rows.add(data).draw();
        } else {
            await Swal.fire({
                position: "center",
                icon: "info",
                title: "Error",
                text: mensaje,
                showConfirmButton: true,
            });
        }
    } catch (error) {
        console.log(error)
    }
}

//DATATABLE: Configuración para Actividades
const datatable = new DataTable('#TableActividades', { 
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
    columns: [
        {
            title: 'No.',
            data: 'act_id',
            width: '%',
            render: (data, type, row, meta) => meta.row + 1
        },
        { title: 'Nombre', data: 'act_nombre' },
        { title: 'Fecha', data: 'act_fecha' }, 
        {
            title: 'Estado', 
            data: 'act_estado',  // 
            render: (data, type, row) => {
                const estado = row.act_estado;
                
                if (estado == "ACTIVO") {
                    return '<span class="badge bg-success">ACTIVO</span>';
                } else if (estado == "INACTIVO") {
                    return '<span class="badge bg-warning">INACTIVO</span>';
                } else if (estado == "SUSPENDIDO") {
                    return '<span class="badge bg-danger">SUSPENDIDO</span>';
                }
            }
        },
        {
            title: 'Acciones',
            data: 'act_id',
            searchable: false,
            orderable: false,
            render: (data, type, row, meta) => {
                return `
                 <div class='d-flex justify-content-center'>
                     <button class='btn btn-warning modificar mx-1' 
                         data-id="${data}" 
                         data-nombre="${row.act_nombre}" 
                         data-estado="${row.act_estado}"  
                         data-fecha="${row.act_fecha}" 
                         <i class='bi bi-pencil-square me-1'></i> Modificar
                     </button>
                     <button class='btn btn-danger eliminar mx-1' 
                         data-id="${data}">
                        <i class="bi bi-trash3 me-1"></i>Eliminar
                     </button>
                 </div>`;
            }
        }
    ]
});

// 🎯 FUNCIÓN: Llenar formulario para modificar
const llenarFormulario = (event) => {
    const datos = event.currentTarget.dataset

    document.getElementById('act_id').value = datos.id;
    document.getElementById('act_nombre').value = datos.nombre;
    document.getElementById('act_estado').value = datos.estado;
    document.getElementById('act_fecha').value = datos.fecha;


    BtnGuardar.classList.add('d-none');
    BtnModificar.classList.remove('d-none');

    window.scrollTo({
        top: 0
    });
}

//Limpiar formulario
const limpiarTodo = () => {
    FormActividades.reset(); 
    BtnGuardar.classList.remove('d-none');
    BtnModificar.classList.add('d-none');
}

//FUNCIÓN: Modificar Actividades
const ModificarActividades = async (event) => {
    event.preventDefault();
    BtnModificar.disabled = true;

    if (!validarFormulario(FormActividades, [''])) { 
        Swal.fire({
            position: "center",
            icon: "info",
            title: "FORMULARIO INCOMPLETO",
            text: "Debe de validar todos los campos",
            showConfirmButton: true,
        });
        BtnModificar.disabled = false; 
        return;
    }

    const body = new FormData(FormActividades); 

    const url = '/parcial1_mrml/actividades/modificarAPI';
    const config = {
        method: 'POST',
        body
    }

    try {
        const respuesta = await fetch(url, config);
        const datos = await respuesta.json();
        const { codigo, mensaje } = datos

        if (codigo == 1) {
            await Swal.fire({
                position: "center",
                icon: "success",
                title: "Exito",
                text: mensaje,
                showConfirmButton: true,
            });

            limpiarTodo();
            BuscarActividades();
        } else {
            await Swal.fire({
                position: "center",
                icon: "info",
                title: "Error",
                text: mensaje,
                showConfirmButton: true,
            });
        }
    } catch (error) {
        console.log(error)
    }
    BtnModificar.disabled = false;
}

//FUNCIÓN: Eliminar
const EliminarActividades = async (e) => {
    const idActividades = e.currentTarget.dataset.id

    const AlertaConfirmarEliminar = await Swal.fire({
        position: "center",
        icon: "info",
        title: "¿Desea ejecutar esta acción?",
        text: 'Esta completamente seguro que desea eliminar este registro',
        showConfirmButton: true,
        confirmButtonText: 'Si, Eliminar',
        confirmButtonColor: 'red',
        cancelButtonText: 'No, Cancelar',
        showCancelButton: true
    });

    if (AlertaConfirmarEliminar.isConfirmed) {
        const url = `/parcial1_mrml/actividades/eliminar?id=${idActividades}`;
        const config = {
            method: 'GET'
        }

        try {
            const consulta = await fetch(url, config);
            const respuesta = await consulta.json();
            const { codigo, mensaje } = respuesta;

            if (codigo == 1) {
                await Swal.fire({
                    position: "center",
                    icon: "success",
                    title: "Exito",
                    text: mensaje,
                    showConfirmButton: true,
                });

                BuscarActividades(); 
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
            console.log(error)
        }
    }
}


// 🎯 INICIALIZACIÓN: Event Listeners (CAMBIOS en nombres)
document.addEventListener('DOMContentLoaded', () => {
    
    // 🌍 NUEVO: Establecer fecha actual por defecto
    const fechaInput = document.getElementById('act_fecha');
    if (fechaInput) {
        fechaInput.value = new Date().toISOString().split('T')[0];
    }
});



// EVENT LISTENERS: (CAMBIOS en nombres de variables)
BuscarActividades();
datatable.on('click', '.eliminar', EliminarActividades);  
datatable.on('click', '.modificar', llenarFormulario);
FormActividades.addEventListener('submit', GuardarActividades);  
BtnLimpiar.addEventListener('click', limpiarTodo);
BtnModificar.addEventListener('click', ModificarActividades);  