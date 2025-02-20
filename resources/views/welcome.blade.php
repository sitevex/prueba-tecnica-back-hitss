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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
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
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="departamento" class="form-label fw-semibold fs-sm mb-1">Departamento:</label>
                                <select class="form-select rounded-1" name="departamento" id="departamento" required>
                                    <option selected disabled value="">Seleccione un Departamento</option>
                                    <option>...</option>
                                </select>
                                <div class="invalid-feedback" id="departamentoError">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="cargo" class="form-label fw-semibold fs-sm mb-1">Cargo:</label>
                                <select class="form-select rounded-1" name="cargo" id="cargo" required>
                                    <option selected disabled value="">Seleccione un perfil</option>
                                    <option>...</option>
                                </select>
                                <div class="invalid-feedback" id="cargoError">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label for="usuario" class="form-label fw-semibold fs-sm mb-1">Usuario:</label>
                                <input type="text" class="form-control rounded-1" name="usuario" id="usuario" required />
                                <div class="invalid-feedback" id="usuarioError">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label for="email" class="form-label fw-semibold fs-sm mb-1">Email:</label>
                                <input type="email" class="form-control rounded-1" name="email" id="email" required />
                                <div class="invalid-feedback" id="emailError">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label for="primerNombre" class="form-label fw-semibold fs-sm mb-1">Primer Nombre:</label>
                                <input type="text" class="form-control rounded-1" name="primerNombre" id="primerNombre" required />
                                <div class="invalid-feedback" id="primerNombreError">
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <label for="segundoNombre" class="form-label fw-semibold fs-sm mb-1">Segundo Nombre</label>
                                <input type="text" class="form-control rounded-1" name="segundoNombre" id="segundoNombre" required />
                                <div class="invalid-feedback" id="segundoNombreError">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label for="primerApellido" class="form-label fw-semibold fs-sm mb-1">Primer Apellido:</label>
                                <input type="text" class="form-control rounded-1" name="primerApellido" id="primerApellido" required />
                                <div class="invalid-feedback" id="primerApellidoError">
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <label for="segundoApellido" class="form-label fw-semibold fs-sm mb-1">Segundo Apellido</label>
                                <input type="text" class="form-control rounded-1" name="segundoApellido" id="segundoApellido" required />
                                <div class="invalid-feedback" id="segundoApellidoError">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary rounded-0 px-4" id="registerButton">Registrar</button>
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
                        <button type="button" class="btn btn-primary px-4" id="deleteButton">Aceptar</button>
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
                                    <button class="btn btn-custom-dropdown btn-department dropdown-toggle rounded-0" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        Seleccione un Departamento
                                    </button>
                                    <ul class="dropdown-menu dropdown-department">
                                    </ul>
                                </div>

                                <div class="dropdown">
                                    <button class="btn btn-custom-dropdown btn-cargo dropdown-toggle rounded-0" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        Seleccione un Cargo
                                    </button>
                                    <ul class="dropdown-menu dropdown-cargo">
                                    </ul>
                                </div>

                                <div class="ms-xxl-auto">
                                    <button type="button" class="btn btn-custom fw-normal rounded-0" data-bs-toggle="modal" data-bs-target="#userModal" data-modo="addUsuario">Crear nuevo usuario</button>
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
                                    <tbody class="list" id="usuarios-table-body">
                                        <td colspan="7" class="fs-9 align-middle text-center">
                                            <div class="spinner-border text-primary" roles="status">
                                                <span class="visually-hidden">Loading...</span>
                                            </div>
                                        </td>
                                    </tbody>
                                </table>
                            </div>
                            <div class="row align-items-center justify-content-between py-2 pe-0 fs-9">
                                <div class="col-auto d-flex">
                                    <span class="fs-9" id="page-info-usuarios-lists"></span>
                                </div>
                                <div class="col-auto d-flex">
                                    <ul class="fs-9 mb-0 pagination align-items-center" id="paginationBodyUsuariosList"></ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>
    <script src="{{asset('assets/js/api/apiClient.js')}}"></script>
    <script src="{{asset('assets/js/helpers/utils.js')}}"></script>
    <script>

        const btnDepartment = document.querySelector('.btn-department');
        const btnJobPosition = document.querySelector('.btn-cargo');
        const departmentDropdownItems = document.querySelectorAll('.dropdown-department .dropdown-item');
        const jobPositionDropdownItems = document.querySelectorAll('.dropdown-cargo .dropdown-item');
        const deleteButton = document.getElementById('deleteButton');

        departmentsList({
            sortBy: 'id',
            sortDirection: 'asc',
            populateSelect: true,
        });

        departmentsList({
            sortBy: 'id',
            sortDirection: 'asc',
            populateDropdown: true,
        });

        cargosList({
            sortBy: 'id',
            sortDirection: 'asc',
            populateSelect: true,
        });

        cargosList({
            sortBy: 'id',
            sortDirection: 'asc',
            populateDropdown: true,
        });

        usersList(1);

        document.querySelector('.dropdown-department').addEventListener('click', function(event) {
            const item = event.target.closest('.dropdown-item'); // Verifica si el clic fue en un <a>
            if (item) {
                event.preventDefault();
                let departmentId = item.getAttribute('data-id');
                let departmentName = item.textContent;

                btnDepartment.innerHTML = `${departmentName} <span class="fas fa-angle-down ms-2"></span>`;
                btnDepartment.setAttribute('data-id', departmentId);

                usersList(1);
            }
        });

        document.querySelector('.dropdown-cargo').addEventListener('click', function(event) {
            const item = event.target.closest('.dropdown-item'); // Verifica si el clic fue en un <a>
            if (item) {
                event.preventDefault();
                let cargoId = item.getAttribute('data-id');
                let cargoName = item.textContent;

                btnJobPosition.innerHTML = `${cargoName} <span class="fas fa-angle-down ms-2"></span>`;
                btnJobPosition.setAttribute('data-id', cargoId);

                usersList(1);
            }
        });

        deleteButton.addEventListener('click', async () => {
            const idUser = deleteModal.getAttribute('data-idUsuario');
            await deleteUser(idUser);
        });

        userModal.addEventListener('show.bs.modal', function () {
            const button = event.relatedTarget;
            const mode = button.getAttribute('data-modo');
            const data = mode === 'editUsuario' ? {
                idUser: button.getAttribute('data-idUsuario'),
                departamento: button.getAttribute('data-idDepartamento'),
                cargo: button.getAttribute('data-idCargo'),
                usuario: button.getAttribute('data-usuario'),
                email: button.getAttribute('data-email'),
                primerNombre: button.getAttribute('data-primerNombre'),
                segundoNombre: button.getAttribute('data-segundoNombre'),
                primerApellido: button.getAttribute('data-primerApellido'),
                segundoApellido: button.getAttribute('data-segundoApellido'),
            } : {};
            initializeUserData(mode === 'addUsuario' ? 'add' : 'edit', data);
        });

        deleteModal.addEventListener('show.bs.modal', function () {
            const button = event.relatedTarget;
            const idUser = button.getAttribute('data-idUsuario');
            // Guardar los datos en la modal para referencia
            deleteModal.setAttribute('data-idUsuario', idUser);
        });

        // ----- Department -----
        async function departmentsList(options = {}) {
            const url = `departments`;
            const queryParams = new URLSearchParams({
                // search: options.search !== undefined ? options.search : queryDepartmentValue,
                paginate: options.paginate || false,
                perPage: options.perPage || '',
                page: options.page || 1, // Página actual
                sortBy: options.sortBy || '',
                sortDirection: options.sortDirection || '',
            });

            const headers = {
                // 'Authorization': 'Bearer your_token_here por Token'
                "Accept": "application/json",
                "X-CSRF-TOKEN": '{{ csrf_token() }}',
            };

            const data = await fetchDataFromApi(url, queryParams, 'GET', headers);
            if (data && data.success) {
                if (options.populateSelect) {
                    populateSelectDepartmets(data.data.departments);
                }
                if (options.populateDropdown) {
                    populateDropdownDepartments(data.data.departments);
                }
            } else {
                console.error("Error al cargar departamentos");
            }
        }

        function populateSelectDepartmets(departments) {
            const departmentsSelect = document.getElementById('departamento');

            while (departmentsSelect.options.length > 1) {
                departmentsSelect.remove(1);
            }

            departments.forEach(department => {
                const option = document.createElement('option');
                option.value = department.idDepartment.toString();
                option.textContent = department.name;
                departmentsSelect.appendChild(option);
            });

        }

        function populateDropdownDepartments(departments) {
            const dropdownMenu = document.querySelector('.dropdown-department'); 
            dropdownMenu.innerHTML = ''; // Limpiar lista antes de agregar nuevos elementos

            // Agregar el ítem fijo "Todos"
            const allItem = document.createElement('li');
            allItem.innerHTML = `<a class="dropdown-item cursor-pointer" data-id="0">Todos</a>`;
            dropdownMenu.appendChild(allItem);


            departments.forEach(department => {
                const listItem = document.createElement('li');
                listItem.innerHTML = `<a class="dropdown-item cursor-pointer" data-id="${department.idDepartment}">${department.name}</a>`;
                dropdownMenu.appendChild(listItem);
            });
        }

        // ----- Cargo -----
        async function cargosList(options = {}) {
            const url = `cargos`;
            const queryParams = new URLSearchParams({
                // search: options.search !== undefined ? options.search : queryCargoValue,
                paginate: options.paginate || false,
                perPage: options.perPage || '',
                page: options.page || 1, // Página actual
                sortBy: options.sortBy || '',
                sortDirection: options.sortDirection || '',
            });

            const headers = {
                // 'Authorization': 'Bearer your_token_here por Token'
                "Accept": "application/json",
                "X-CSRF-TOKEN": '{{ csrf_token() }}',
            };

            const data = await fetchDataFromApi(url, queryParams, 'GET', headers);
            if (data && data.success) {
                if (options.populateSelect) {
                    populateSelectCargos(data.data.cargos);
                }
                if (options.populateDropdown) {
                    populateDropdownCargos(data.data.cargos);
                }
            } else {
                console.error("Error al cargar los cargos");
            }
        }
        
        function populateSelectCargos(cargos) {
            const cargosSelect = document.getElementById('cargo');

            while (cargosSelect.options.length > 1) {
                cargosSelect.remove(1);
            }

            cargos.forEach(cargo => {
                const option = document.createElement('option');
                option.value = cargo.idCargo.toString();
                option.textContent = cargo.name;
                cargosSelect.appendChild(option);
            });

        }

        function populateDropdownCargos(cargos) {
            const dropdownMenu = document.querySelector('.dropdown-cargo'); 
            dropdownMenu.innerHTML = ''; // Limpiar lista antes de agregar nuevos elementos

            // Agregar el ítem fijo "Todos"
            const allItem = document.createElement('li');
            allItem.innerHTML = `<a class="dropdown-item cursor-pointer" data-id="0">Todos</a>`;
            dropdownMenu.appendChild(allItem);

            cargos.forEach(cargo => {
                const listItem = document.createElement('li');
                listItem.innerHTML = `<a class="dropdown-item cursor-pointer" data-id="${cargo.idCargo}">${cargo.name}</a>`;
                dropdownMenu.appendChild(listItem);
            });
        }

        // ----- Usuario -----
        async function usersList(page) {
            // let search = document.getElementById('search').value.trim();
            let departmentCode = btnDepartment.getAttribute('data-id');
            let positionCode = btnJobPosition.getAttribute('data-id');
            currentPage = page === undefined ? currentPage : page;

            const url = `user-lists`;
            const queryParams = new URLSearchParams({
                // search: search,
                departmentCode: departmentCode || '',
                positionCode: positionCode || '',
                paginate: true,
                perPage: 10,
                page: currentPage
            });

            const headers = {
                // 'Authorization': 'Bearer your_token_here por Token'
                "Accept": "application/json",
                "X-CSRF-TOKEN": '{{ csrf_token() }}',
            };

            const data = await fetchDataFromApi(url, queryParams, 'GET', headers);
            if (data && data.success) {
                populateTableUsers(data.data.users);
                footerUsers(data.pagination);
            } else {
                console.error("Error al cargar lista de usuarios");
            }
        }

        function populateTableUsers(users) {
            const usuariosTableBody = document.getElementById('usuarios-table-body');
            usuariosTableBody.innerHTML = '';
            if (users.length === 0) {
                usuariosTableBody.innerHTML = `
                <tr class="laborAction-static">
                    <td colspan="7" class="text-center fs-9">
                        <p class="fw-bo text-900 mb-0">No se encontraron resultados.</p>
                    </td>
                </tr>
                `;
            } else {
                users.forEach(value => {
                    const row = `
                        <tr>
                            <td class="text-table-body text-center">${value.usuario}</td>
                            <td class="text-table-body">${value.primerNombre} ${value.segundoNombre}</td>
                            <td class="text-table-body">${value.primerApellido} ${value.segundoApellido}</td>
                            <td class="text-table-body">${value.departamento}</td>
                            <td class="text-table-body">${value.cargo}</td>
                            <td class="text-table-body">${value.email}</td>
                            <td class="text-center">
                                <button type="button" class="btn btn-fruit px-4 rounded-1" 
                                    data-bs-toggle="modal" 
                                    data-bs-target="#userModal" 
                                    data-modo="editUsuario"
                                    data-idUsuario="${value.idUser}"
                                    data-usuario="${value.usuario}"
                                    data-primerNombre="${value.primerNombre}"
                                    data-segundoNombre="${value.segundoNombre}"
                                    data-primerApellido="${value.primerApellido}"
                                    data-segundoApellido="${value.segundoApellido}"
                                    data-idDepartamento="${value.idDepartamento}"
                                    data-departamento="${value.departamento}"
                                    data-idCargo="${value.idCargo}"
                                    data-cargo="${value.cargo}"
                                    data-email="${value.email}">
                                    <i class="bi bi-pencil-square"></i> 
                                    Editar
                                </button>
                                <button type="button" class="btn btn-razzmatazz px-4 rounded-1" 
                                    data-bs-toggle="modal" 
                                    data-bs-target="#deleteModal"
                                    data-idUsuario="${value.idUser}">
                                    <i class="bi bi-trash"></i> 
                                    Eliminar
                                </button>
                            </td>
                        </tr>
                    `;
                    usuariosTableBody.innerHTML += row;
                });
            }
        }

        function footerUsers(data) {
            pagination(
                data,
                'paginationBodyUsuariosList',
                'page-info-usuarios-lists',
                'btn-prev-usuariosLists',
                'btn-next-usuariosLists',
                usersList
            )
        }

        function initializeUserData(mode, data = {}) {
            clearValidationErrors();

            const registerButton = document.getElementById('registerButton');
            registerButton.textContent = mode === 'add' ? '{{__("Registrar")}}' : '{{__("Actualizar")}}';
            registerButton.onclick = () => mode === 'add' ? sendUsuario() : updateUsuario(data.idUser);

            const fields = [
                'departamento',
                'cargo',
                'usuario',
                'email',
                'primerNombre',
                'segundoNombre',
                'primerApellido',
                'segundoApellido',
            ];
            fields.forEach(field => document.getElementById(field).value = data[field] || '');
        }

        async function updateUsuario(idUser) {
            // console.log(idUser);
            const departamento = document.getElementById('departamento').value;
            const cargo = document.getElementById('cargo').value;
            const usuario = document.getElementById('usuario').value;
            const email = document.getElementById('email').value;
            const primerNombre = document.getElementById('primerNombre').value;
            const segundoNombre = document.getElementById('segundoNombre').value;
            const primerApellido = document.getElementById('primerApellido').value;
            const segundoApellido = document.getElementById('segundoApellido').value;

            const url = `user/update`;
            const header = {
                // 'Authorization': 'Bearer your_token_here por Token'
                "Accept": "application/json",
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
            }

            const data = {
                idUser: idUser,
                usuario: usuario,
                primerNombre: primerNombre,
                segundoNombre: segundoNombre,
                primerApellido: primerApellido,
                segundoApellido: segundoApellido,
                idDepartamento: departamento,
                idCargo: cargo,
                email: email,
            }

            const response = await fetchDataFromApi(url, data, 'PUT', header);
            if (response && response.success) {
                showToast(response.message);
                const userModal = document.getElementById("userModal");
                const modalInstance = bootstrap.Modal.getInstance(userModal);
                if (modalInstance) modalInstance.hide();
                usersList(1);
            } else {
                handleValidationErrors(response.errors || {});
            }
        }

        async function sendUsuario() {
            console.log('test');
            clearValidationErrors();
            disableButtonWithLoader('registerButton');
            try {
                const departamento = document.getElementById('departamento').value;
                const cargo = document.getElementById('cargo').value;
                const usuario = document.getElementById('usuario').value;
                const email = document.getElementById('email').value;
                const primerNombre = document.getElementById('primerNombre').value;
                const segundoNombre = document.getElementById('segundoNombre').value;
                const primerApellido = document.getElementById('primerApellido').value;
                const segundoApellido = document.getElementById('segundoApellido').value;

                const url = `user/store`;
                const header = {
                    // 'Authorization': 'Bearer your_token_here por Token'
                    "Accept": "application/json",
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                };

                const data = {
                    usuario: usuario,
                    primerNombre: primerNombre,
                    segundoNombre: segundoNombre,
                    primerApellido: primerApellido,
                    segundoApellido: segundoApellido,
                    idDepartamento: departamento,
                    idCargo: cargo,
                    email: email,
                }

                const response = await fetchDataFromApi(url, data, 'POST', header);
                if (response && response.success) {
                    showToast(response.message);
                    const userModal = document.getElementById("userModal");
                    const modalInstance = bootstrap.Modal.getInstance(userModal);
                    if (modalInstance) modalInstance.hide();
                    usersList(1);
                } else {
                    handleValidationErrors(response.errors || {});
                    throw new Error(response.message || 'Error al registrar usuario');
                }
            } catch (error) {
                showToast(error.message || 'Ocurrió un error inesperado', 'error');
            } finally {
                enableButtonWithLoader('registerButton');
            }
        }

        // Delete
        async function deleteUser(idUser) {
            // console.log(idUser);
            const url = `user/delete`;
            const header = {
                // 'Authorization': 'Bearer your_token_here por Token'
                "Accept": "application/json",
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
            }

            const data = {
                idUser: idUser,
            }

            const response = await fetchDataFromApi(url, data, 'DELETE', header);

            if (response && response.success) {
                showToast(response.message);
                const deleteModal = document.getElementById("deleteModal");
                const modalInstance = bootstrap.Modal.getInstance(deleteModal);
                if (modalInstance) modalInstance.hide();
                usersList(1);
            } else {
                handleValidationErrors(response.errors || {});
            }
        }

    </script>
</body>

</html>