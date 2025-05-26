<!-- CONTENEDOR PRINCIPAL CON FONDO GRADIENTE -->
<div class="container-fluid min-vh-100 d-flex align-items-center justify-content-center" 
     style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
    
    <div class="row w-100 justify-content-center">
        <div class="col-11 col-md-10 col-lg-8 col-xl-6">

            <!-- CARD PRINCIPAL -->
            <div class="card shadow-lg border-0" 
                 style="border-radius: 25px; backdrop-filter: blur(10px); background: rgba(255, 255, 255, 0.95);">

                <!-- HEADER CON GRADIENTE Y TÍTULO -->
                <div class="card-header text-center py-4 border-0" 
                     style="background: linear-gradient(135deg, #28a745 0%, #20c997 100%); border-radius: 25px 25px 0 0;">
                    
                    <div class="d-flex align-items-center justify-content-center mb-3">
                        <div class="bg-white rounded-circle p-3 shadow-sm me-3">
                            <i class="bi bi-clock-fill text-success" style="font-size: 2rem;"></i>
                        </div>
                        <div>
                            <h2 class="text-white mb-0 fw-bold">Registro de Asistencia</h2>
                            <p class="text-white-50 mb-0">Marcar asistencia a actividades</p>
                        </div>
                    </div>
                </div>

                <!-- BODY DEL CARD -->
                <div class="card-body p-5">
                    
                    <!-- FORMULARIO PRINCIPAL -->
                    <form id="FormRegistro" novalidate>
                        
                        <input type="hidden" id="reg_id" name="reg_id">

                        <!-- SELECCIÓN DE ACTIVIDAD -->
                        <div class="mb-4">
                            <div class="d-flex align-items-center mb-3">
                                <i class="bi bi-calendar-event text-primary me-2" style="font-size: 1.5rem;"></i>
                                <h5 class="mb-0 text-primary fw-semibold">Seleccionar Actividad</h5>
                                <hr class="flex-grow-1 ms-3">
                            </div>
                            
                            <div class="row g-3">
                                <div class="col-12">
                                    <div class="form-floating">
                                        <select class="form-select border-2" id="act_id" name="act_id" required>
                                            <option value="">Cargando actividades...</option>
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

                        <!-- INFORMACIÓN AUTOMÁTICA -->
                        <div class="mb-4">
                            <div class="d-flex align-items-center mb-3">
                                <i class="bi bi-info-circle text-info me-2" style="font-size: 1.5rem;"></i>
                                <h5 class="mb-0 text-info fw-semibold">Información Automática</h5>
                                <hr class="flex-grow-1 ms-3">
                            </div>
                            
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <div class="alert alert-light border-2 border-info">
                                        <div class="d-flex align-items-center">
                                            <i class="bi bi-clock-history text-info me-2" style="font-size: 1.2rem;"></i>
                                            <div>
                                                <small class="text-muted">Fecha y hora actual:</small>
                                                <div class="fw-semibold" id="fecha-actual"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

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

                        <!-- BOTONES DE ACCIÓN -->
                        <div class="d-flex flex-wrap gap-3 justify-content-center pt-3">
                            <button type="submit" id="BtnGuardar" class="btn btn-lg px-4 py-2 shadow-sm" 
                                    style="background: linear-gradient(135deg, #28a745 0%, #20c997 100%); 
                                           border: none; border-radius: 15px; color: white; font-weight: 600;">
                                <i class="bi bi-check-circle me-2"></i>Registrar Asistencia
                            </button>
                            
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

<!-- TABLA DE REGISTROS CON FILTROS -->
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

                <!-- filtros -->
                <div class="card-body border-bottom" style="background: #f8f9fa;">
                    <div class="row g-3 align-items-end">
                        <!-- Filtro por Actividad -->
                        <div class="col-md-4">
                            <label for="filtro_actividad" class="form-label fw-semibold">
                                <i class="bi bi-funnel me-1"></i>Filtrar por Actividad
                            </label>
                            <select class="form-select" id="filtro_actividad">
                                <option value="">Todas las actividades</option>
                            </select>
                        </div>

                        <!-- Filtro Fecha Inicio -->
                        <div class="col-md-3">
                            <label for="filtro_fecha_inicio" class="form-label fw-semibold">
                                <i class="bi bi-calendar-date me-1"></i>Fecha Inicio
                            </label>
                            <input type="date" class="form-control" id="filtro_fecha_inicio">
                        </div>

                        <!-- Filtro Fecha Fin -->
                        <div class="col-md-3">
                            <label for="filtro_fecha_fin" class="form-label fw-semibold">
                                <i class="bi bi-calendar-date-fill me-1"></i>Fecha Fin
                            </label>
                            <input type="date" class="form-control" id="filtro_fecha_fin">
                        </div>

                        <!-- Botones de Filtro -->
                        <div class="col-md-2">
                            <div class="d-flex gap-2">
                                <button type="button" id="btn_filtrar" class="btn btn-primary">
                                    <i class="bi bi-search"></i>
                                </button>
                                <button type="button" id="btn_limpiar_filtros" class="btn btn-outline-secondary">
                                    <i class="bi bi-x-lg"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Contador de Registros -->
                    <div class="row mt-3">
                        <div class="col-12">
                            <small class="text-muted" id="texto-filtros">Cargando registros...</small>
                        </div>
                    </div>
                </div>

                <div class="card-body p-4">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle" id="TableRegistros">
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



<script src="<?= asset('build/js/registro/index.js') ?>"></script>