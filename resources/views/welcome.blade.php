<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Prueba tecnica - MIGUEL-P</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Rethink+Sans:ital,wght@0,400..800;1,400..800&family=Roboto:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet" />
    <!-- Styles -->
    <link href="{{asset('assets/css/themes.css')}}" rel="stylesheet" />
</head>

<body>

    <main>
        <!-- User -->
        <div class="modal fade" id="userModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="userModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content bg-body border-0 rounded-2">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5 fw-bold" id="userModalLabel">Registrar usuario</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body px-4 py-5">
                        <form class="row g-3 needs-validation" novalidate>

                            <div class="col-md-6">
                                <label for="departamento" class="form-label fw-semibold fs-sm mb-1">Departamento:</label>
                                <select class="form-select rounded-1" name="departamento" id="departamento" required>
                                    <option selected disabled value="">Seleccione un Departamento</option>
                                    <option>...</option>
                                </select>
                                <div class="invalid-feedback">
                                    Please select a valid state.
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="cargo" class="form-label fw-semibold fs-sm mb-1">Cargo:</label>
                                <select class="form-select rounded-1" name="cargo" id="cargo" required>
                                    <option selected disabled value="">Seleccione un perfil</option>
                                    <option>...</option>
                                </select>
                                <div class="invalid-feedback">
                                    Please select a valid state.
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label for="usuario" class="form-label fw-semibold fs-sm mb-1">Usuario:</label>
                                <input type="text" class="form-control rounded-1" id="usuario" required />
                                <div class="invalid-feedback">
                                    Looks good!
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label for="email" class="form-label fw-semibold fs-sm mb-1">Email:</label>
                                <input type="email" class="form-control rounded-1" name="email" id="email" required />
                                <div class="invalid-feedback">
                                    Looks good!
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label for="primerNombre" class="form-label fw-semibold fs-sm mb-1">Primer Nombre:</label>
                                <input type="text" class="form-control rounded-1" id="primerNombre" required />
                                <div class="invalid-feedback">
                                    Please provide a valid city.
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <label for="segundoNombre" class="form-label fw-semibold fs-sm mb-1">Segundo Nombre</label>
                                <input type="text" class="form-control rounded-1" id="segundoNombre" required />
                                <div class="invalid-feedback">
                                    Please provide a valid zip.
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label for="primerApellido" class="form-label fw-semibold fs-sm mb-1">Primer Apellido:</label>
                                <input type="text" class="form-control rounded-1" id="primerApellido" required />
                                <div class="invalid-feedback">
                                    Please provide a valid city.
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <label for="segundoApellido" class="form-label fw-semibold fs-sm mb-1">Segundo Apellido</label>
                                <input type="text" class="form-control rounded-1" id="segundoApellido" required />
                                <div class="invalid-feedback">
                                    Please provide a valid zip.
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary rounded-0 px-4">Registrar</button>
                        <button type="button" class="btn btn-custom rounded-0 px-4" data-bs-dismiss="modal">Cancelar</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Delete -->
        <div class="modal fade" id="deleteModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content border-0 shadow-lg">
                    <div class="modal-body">
                        <p class="text-start fs-sm mb-0">¿Está seguro de eliminar el usuario seleccionado?</p>
                    </div>
                    <div class="modal-footer border-0 pt-0">
                        <button type="button" class="btn btn-primary px-4">Aceptar</button>
                        <button type="button" class="btn btn-secondary px-4" data-bs-dismiss="modal">Cancelar</button>
                    </div>
                </div>
            </div>
        </div>

        <section class="py-5">
            <div class="container-fluid">
                <div class="row g-3 mb-4 border-bottom-body">
                    <div class="px-4">
                        <div class="col-auto mb-3">
                            <p class="small mb-0">Módulo de Administración</p>
                            <h4 class="fw-bold">Administración de usuarios</h4>
                        </div>
                        <div class="mb-3">
                            <div class="d-flex flex-wrap gap-3">
                                <div class="dropdown">
                                    <button class="btn btn-custom-dropdown dropdown-toggle rounded-0" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        Seleccione un Departamento
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item">Action</a></li>
                                        <li><a class="dropdown-item">Another action</a></li>
                                        <li><a class="dropdown-item">Something else here</a></li>
                                    </ul>
                                </div>

                                <div class="dropdown">
                                    <button class="btn btn-custom-dropdown dropdown-toggle rounded-0" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        Seleccione un Cargo
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item">Action</a></li>
                                        <li><a class="dropdown-item">Another action</a></li>
                                        <li><a class="dropdown-item">Something else here</a></li>
                                    </ul>
                                </div>

                                <div class="ms-xxl-auto">
                                    <button type="button" class="btn btn-custom fw-normal rounded-0" data-bs-toggle="modal" data-bs-target="#userModal">Crear nuevo usuario</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="px-3" id="users">
                    <div class="card border-0 rounded-0">
                        <div class="card-body p-4">
                            <div class="table-responsive">
                                <table class="table border">
                                    <thead>
                                        <tr>
                                            <th class="text-table-body text-center fw-semibold fs-6" scope="col">Usuario</th>
                                            <th class="text-table-body text-center fw-semibold fs-6" scope="col">Nombres</th>
                                            <th class="text-table-body text-center fw-semibold fs-6" scope="col">Apellidos</th>
                                            <th class="text-table-body text-center fw-semibold fs-6" scope="col">Departamento</th>
                                            <th class="text-table-body text-center fw-semibold fs-6" scope="col">Cargo</th>
                                            <th class="text-table-body text-center fw-semibold fs-6" scope="col">Email</th>
                                            <th class="text-table-body text-center fw-semibold fs-6" scope="col">Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="text-table-body text-center">Mark</td>
                                            <td class="text-table-body">Otto</td>
                                            <td class="text-table-body">@mdo</td>
                                            <td class="text-table-body">Mark</td>
                                            <td class="text-table-body">Otto</td>
                                            <td class="text-table-body">@mdo</td>
                                            <td class="text-center">
                                                <button type="button" class="btn btn-fruit px-4 rounded-1" data-bs-toggle="modal" data-bs-target="#userModal" data-mode="edit"><i class="bi bi-pencil-square"></i> Editar</button>
                                                <button type="button" class="btn btn-razzmatazz px-4 rounded-1" data-bs-toggle="modal" data-bs-target="#deleteModal"><i class="bi bi-trash"></i> Eliminar</button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>
</body>

</html>