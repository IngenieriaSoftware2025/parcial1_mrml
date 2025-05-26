<!-- 
=======================================================
CONTENEDOR PRINCIPAL Y FONDO
=======================================================
-->

<!-- CONTENEDOR PRINCIPAL CON FONDO GRADIENTE -->
<div class="container-fluid min-vh-100 d-flex align-items-center justify-content-center" 
     style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
    
    <!-- SISTEMA DE GRILLA RESPONSIVE -->
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

                <!-- HEADER CON GRADIENTE Y TÍTULO -->
                <div class="card-header text-center py-4 border-0" 
                     style="background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%); border-radius: 25px 25px 0 0;">
                    
                    <!-- CONTENIDO DEL HEADER: ICONO + TÍTULO -->
                    <div class="d-flex align-items-center justify-content-center mb-3">
                        <!-- Icono circular blanco -->
                        <div class="bg-white rounded-circle p-3 shadow-sm me-3">
                            <i class="bi bi-person-plus-fill text-primary" style="font-size: 2rem;"></i>
                        </div>
                        <!-- Títulos -->
                        <div>
                            <h2 class="text-white mb-0 fw-bold">Registro de una Actividad</h2>
                            <p class="text-white-50 mb-0">Complete la información de Actividad</p>
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
                    <form id="FormActividades" novalidate>
                        
                        <!-- CAMPO OCULTO PARA ID  -->
                        <input type="hidden" id="act_id" name="act_id">

<!-- 
=======================================================
INFORMACIÓN PERSONAL
=======================================================
-->

                        <!-- INFORMACIÓN PERSONAL -->
                        <div class="mb-4">
                            <!-- Título de sección con icono y línea -->
                            <div class="d-flex align-items-center mb-3">
                                <i class="bi bi-person-circle text-primary me-2" style="font-size: 1.5rem;"></i>
                                <h5 class="mb-0 text-primary fw-semibold">Información de la Actividad</h5>
                                <hr class="flex-grow-1 ms-3">
                            </div>
                            
                            <!-- CAMPOS -->
                            <div class="row g-3">
                                
                                <!-- Campo: Nombre -->
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="text" class="form-control border-2" 
                                               id="act_nombre" name="act_nombre" placeholder="Nombre de la Actividad" required>
                                        <label for="act_nombre">
                                            <i class="bi bi-person me-1"></i>Nombre de la Actividad
                                        </label>
                                        <div class="invalid-feedback">
                                            <i class="bi bi-exclamation-circle me-1"></i>El nombre es obligatorio
                                        </div>
                                    </div>
                                </div>
                                
                            </div>
                        </div>

<!-- 
=======================================================
CONFIGURACIÓN
=======================================================
-->

                        <!--SECCIÓN: CONFIGURACIÓN -->
                        <div class="mb-4">
                            <div class="d-flex align-items-center mb-3">
                                <i class="bi bi-gear-fill text-warning me-2" style="font-size: 1.5rem;"></i>
                                <h5 class="mb-0 text-warning fw-semibold">Configuración</h5>
                                <hr class="flex-grow-1 ms-3">
                            </div>
                            
                            <div class="row g-3">
                                
                                <!-- Campo: Estado (SELECT) -->
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <select class="form-select border-2" id="act_estado" name="act_estado" required>
                                            <option value="">Seleccionar estado...</option>
                                            <option value="ACTIVO">ACTIVO</option>
                                            <option value="INACTIVO">INACTIVO</option>
                                            <option value="SUSPENDIDO">SUSPENDIDO</option>
                                        </select>
                                        <label for="act_estado">
                                            <i class="bi bi-check-circle me-1"></i>Estado de la Actividad
                                        </label>
                                        <div class="invalid-feedback">
                                            <i class="bi bi-exclamation-circle me-1"></i>Seleccione un estado
                                        </div>
                                    </div>
                                </div>

                                <!-- Campo: Fecha -->
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="datetime-local" class="form-control border-2" 
                                               id="act_fecha" name="act_fecha" required>
                                        <label for="act_fecha">
                                            <i class="bi bi-calendar-event me-1"></i>Fecha de Registro
                                        </label>
                                        <div class="invalid-feedback">
                                            <i class="bi bi-exclamation-circle me-1"></i>La fecha es obligatoria
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
                                    style="background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%); 
                                           border: none; border-radius: 15px; color: white; font-weight: 600;">
                                <i class="bi bi-save me-2"></i>Guardar Actividad
                            </button>
                            
                            <!-- Botón Modificar (oculto inicialmente) -->
                            <button type="button" id="BtnModificar" class="btn btn-lg px-4 py-2 shadow-sm d-none" 
                                    style="background: linear-gradient(135deg, #fa709a 0%, #fee140 100%); 
                                           border: none; border-radius: 15px; color: white; font-weight: 600;">
                                <i class="bi bi-pencil-square me-2"></i>Modificar Actividad
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
<!-- ----------------TABLA------------------------------------------- -->

<div class="container-fluid py-5" style="background: #f8f9fa;">
    <div class="row justify-content-center">
        <div class="col-11">
            <div class="card shadow border-0" style="border-radius: 20px;">
                <div class="card-header py-4 border-0" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border-radius: 20px 20px 0 0;">
                    <div class="d-flex align-items-center">
                        <i class="bi bi-table text-white me-3" style="font-size: 1.5rem;"></i>
                        <h4 class="text-white mb-0 fw-bold">ACTIVIDADES REGISTRADAS</h4>
                    </div>
                </div>
                <div class="card-body p-4">
                    <div class="table-responsive">
                        <!--SOLO ESTO - DataTable hace el resto -->
                        <table class="table table-hover align-middle" id="TableActividades">
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="<?= asset('build/js/actividades/index.js') ?>"></script>