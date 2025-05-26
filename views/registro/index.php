<!-- 
=======================================================
CONTENEDOR PRINCIPAL Y FONDO
=======================================================
-->

<!-- 1️⃣ CONTENEDOR PRINCIPAL CON FONDO GRADIENTE -->
<div class="container-fluid min-vh-100 d-flex align-items-center justify-content-center" 
     style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
    
    <!-- 2️⃣ SISTEMA DE GRILLA RESPONSIVE -->
    <div class="row w-100 justify-content-center">
        <div class="col-11 col-md-10 col-lg-8 col-xl-6">

<!-- 
=======================================================
CARD PRINCIPAL
=======================================================
-->

            <!-- CARD PRINCIPAL -->
            <div class="card shadow-lg border-0" 
                 style="border-radius: 25px; backdrop-filter: blur(10px); background: rgba(255, 255, 255, 0.95);">

<!-- 
=======================================================
HEADER DEL FORMULARIO
=======================================================
-->

                <!-- 4️⃣ HEADER CON GRADIENTE Y TÍTULO -->
                <div class="card-header text-center py-4 border-0" 
                     style="background: linear-gradient(135deg, #28a745 0%, #20c997 100%); border-radius: 25px 25px 0 0;">
                    
                    <!-- 5️⃣ CONTENIDO DEL HEADER: ICONO + TÍTULO -->
                    <div class="d-flex align-items-center justify-content-center mb-3">
                        <!-- Icono circular blanco -->
                        <div class="bg-white rounded-circle p-3 shadow-sm me-3">
                            <i class="bi bi-clock-fill text-success" style="font-size: 2rem;"></i>
                        </div>
                        <!-- Títulos -->
                        <div>
                            <h2 class="text-white mb-0 fw-bold">Registro de Asistencia</h2>
                            <p class="text-white-50 mb-0">Marcar asistencia a actividades</p>
                        </div>
                    </div>
                </div>

<!-- 
=======================================================
INICIO DEL FORMULARIO
=======================================================
-->

                <!-- BODY DEL CARD -->
                <div class="card-body p-5">
                    
                    <!-- FORMULARIO PRINCIPAL -->
                    <form id="FormRegistro" novalidate>
                        
                        <!-- CAMPO OCULTO PARA ID  -->
                        <input type="hidden" id="reg_id" name="reg_id">

<!-- 
=======================================================
SELECCIÓN DE ACTIVIDAD
=======================================================
-->

                        <!-- SELECCIÓN DE ACTIVIDAD -->
                        <div class="mb-4">
                            <!-- Título de sección con icono y línea -->
                            <div class="d-flex align-items-center mb-3">
                                <i class="bi bi-calendar-event text-primary me-2" style="font-size: 1.5rem;"></i>
                                <h5 class="mb-0 text-primary fw-semibold">Seleccionar Actividad</h5>
                                <hr class="flex-grow-1 ms-3">
                            </div>
                            
                            <!-- CAMPO DE SELECCIÓN -->
                            <div class="row g-3">
                                
                                <!-- Campo: Actividad -->
                                <div class="col-12">
                                    <div class="form-floating">
                                        <select class="form-select border-2" id="act_id" name="act_id" required>
                                            <option value="">Cargando actividades...</option>
                                            <!-- Las actividades se cargan dinámicamente desde la API -->
                                        </select>
                                        <label for="act_id">
                                            <i class="bi bi-list-check me-1"></i>Seleccionar Actividad
                                        </label>
                                        <div class="invalid-feedback">
                                            <i class="bi bi-exclamation-circle me-1"></i>Debe seleccionar una actividad
                                        </div>
                                    </div>
                                </div>
                                
                            </div>
                        </div>

<!-- 
=======================================================
INFORMACIÓN AUTOMÁTICA
=======================================================
-->

                        <!-- INFORMACIÓN AUTOMÁTICA -->
                        <div class="mb-4">
                            <div class="d-flex align-items-center mb-3">
                                <i class="bi bi-info-circle text-info me-2" style="font-size: 1.5rem;"></i>
                                <h5 class="mb-0 text-info fw-semibold">Información Automática</h5>
                                <hr class="flex-grow-1 ms-3">
                            </div>
                            
                            <div class="row g-3">
                                
                                <!-- Información de fecha/hora actual -->
                                <div class="col-md-6">
                                    <div class="alert alert-light border-2 border-info">
                                        <div class="d-flex align-items-center">
                                            <i class="bi bi-clock-history text-info me-2" style="font-size: 1.2rem;"></i>
                                            <div>
                                                <small class="text-muted">Fecha y hora actual:</small>
                                                <div class="fw-semibold" id="fecha-actual">
                                                    <!-- Se actualiza automáticamente con JavaScript -->
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Estado de puntualidad previsto -->
                                <div class="col-md-6">
                                    <div class="alert alert-light border-2 border-warning">
                                        <div class="d-flex align-items-center">
                                            <i class="bi bi-speedometer2 text-warning me-2" style="font-size: 1.2rem;"></i>
                                            <div>
                                                <small class="text-muted">Estado previsto:</small>
                                                <div class="fw-semibold">
                                                    <span class="text-muted">Seleccione una actividad</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                            </div>
                        </div>

<!-- 
=======================================================
BOTONES DE ACCIÓN
=======================================================
-->

                        <!-- BOTONES DE ACCIÓN -->
                        <div class="d-flex flex-wrap gap-3 justify-content-center pt-3">
                            
                            <!-- Botón Guardar -->
                            <button type="submit" id="BtnGuardar" class="btn btn-lg px-4 py-2 shadow-sm" 
                                    style="background: linear-gradient(135deg, #28a745 0%, #20c997 100%); 
                                           border: none; border-radius: 15px; color: white; font-weight: 600;">
                                <i class="bi bi-check-circle me-2"></i>Registrar Asistencia
                            </button>
                            
                            <!-- Botón Limpiar -->
                            <button type="reset" id="BtnLimpiar" class="btn btn-lg btn-outline-secondary px-4 py-2 shadow-sm" 
                                    style="border-radius: 15px; font-weight: 600;">
                                <i class="bi bi-arrow-clockwise me-2"></i>Limpiar Formulario
                            </button>
                            
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- -------------------------------------------------------------- -->
<!-- -------------------------------------------------------------- -->
<!-- ----------------TABLA DE REGISTROS-------------------------- -->

<div class="container-fluid py-5" style="background: #f8f9fa;">
    <div class="row justify-content-center">
        <div class="col-11">
            <div class="card shadow border-0" style="border-radius: 20px;">
                <div class="card-header py-4 border-0" style="background: linear-gradient(135deg, #28a745 0%, #20c997 100%); border-radius: 20px 20px 0 0;">
                    <div class="d-flex align-items-center">
                        <i class="bi bi-table text-white me-3" style="font-size: 1.5rem;"></i>
                        <h4 class="text-white mb-0 fw-bold">REGISTROS DE ASISTENCIA</h4>
                    </div>
                </div>
                <div class="card-body p-4">
                    <div class="table-responsive">
                        <!-- TABLA DE REGISTROS - DataTable hace el resto -->
                        <table class="table table-hover align-middle" id="TableRegistros">
                            <!-- Las columnas se definen dinámicamente en JavaScript -->
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Api publica -->
<script>
function actualizarFechaActual() {
    const ahora = new Date();
    const fechaFormateada = ahora.toLocaleString('es-ES', {
        year: 'numeric',
        month: '2-digit',
        day: '2-digit',
        hour: '2-digit',
        minute: '2-digit',
        second: '2-digit'
    });
    
    const elemento = document.getElementById('fecha-actual');
    if (elemento) {
        elemento.textContent = fechaFormateada;
    }
}

// Actualizar cada segundo
setInterval(actualizarFechaActual, 1000);

actualizarFechaActual();
</script>

<!-- Incluir el script del módulo -->
<script src="<?= asset('build/js/registro/index.js') ?>"></script>