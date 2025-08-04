<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel Crud</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
</head>

<body>
    <div class="container p-3">
        <div class="card shadow-sm main-card my-4">
            <div class="card-header py-3">
                <div class="d-flex justify-content-between align-items-center">
                    <h5 class="mb-0 text-white">User Management</h5>
                    <button class="btn add-user-btn btn-sm fw-bold" data-bs-toggle="modal"
                        data-bs-target="#exampleModal">
                        <i class="bi bi-plus-circle me-2"></i>Add User
                    </button>
                </div>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover styled-table mb-0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Password</th>
                                <th class="text-end">Actions</th>
                            </tr>
                        </thead>
                        <tbody id="userList">
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Add User Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Add New User</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="userForm">
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <div class="input-group has-validation">
                                <input type="text" id="name" class="form-control" placeholder="Enter name">
                            </div>
                            <div id="nameError" class="invalid-feedback d-block d-none"></div>
                        </div>

                        <div class="mb-3 position-relative">
                            <label for="email" class="form-label">Email address</label>
                            <div class="input-group has-validation">
                                <input type="email" class="form-control" id="email" placeholder="Enter email">
                            </div>
                            <div class="invalid-feedback d-block d-none" id="emailError"></div>
                        </div>

                        <div class="mb-3 position-relative">
                            <label for="password" class="form-label">Password</label>
                            <div class="position-relative">
                                <input type="password" class="form-control pe-5" id="password"
                                    placeholder="Enter password">
                                <i class="fa-solid fa-eye position-absolute top-50 end-0 translate-middle-y me-3"
                                    id="togglePassword" style="cursor: pointer;"></i>
                            </div>
                            <div class="invalid-feedback d-block d-none" id="passwordError"></div>
                        </div>

                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="saveUserBtn">
                        <i class="bi bi-check-circle me-2"></i>Save User
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Update User Modal -->
    <div class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="updateModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="updateModalLabel">Update User</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="userForm">
                        <div class="form-group position-relative">
                            <label for="updateName">Name</label>
                            <input type="text" id="updateName" class="form-control" placeholder="Enter name">
                            <div id="updateNameIcon"
                                class="position-absolute top-50 end-0 translate-middle-y me-2 text-danger d-none">
                                <i class="fas fa-exclamation-circle"></i> <!-- Font Awesome -->
                            </div>
                            <small id="updateNameError" class="text-danger d-none"></small>
                        </div>

                        <div class="form-group position-relative">
                            <label for="updateEmail">Email</label>
                            <input type="email" id="updateEmail" class="form-control" placeholder="Enter email">
                            <div id="updateEmailIcon"
                                class="position-absolute top-50 end-0 translate-middle-y me-2 text-danger d-none">
                                <i class="fas fa-exclamation-circle"></i>
                            </div>
                            <small id="updateEmailError" class="text-danger d-none"></small>
                        </div>


                        <input type="hidden" id="updateid">
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="UpdateUser">
                        <i class="bi bi-check-circle me-2"></i>Update User
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous">
    </script>

    <script>
        $(document).ready(function() {

            userList();

            $('#saveUserBtn').on('click', function() {
                // Reset all field errors
                ['name', 'email', 'password'].forEach(field => {
                    $(`#${field}`).removeClass('is-invalid');
                    $(`#${field}Icon`).addClass('d-none');
                    $(`#${field}Error`).addClass('d-none').text('');
                });

                $.ajax({
                    type: 'POST',
                    url: '{{ route('user.add') }}',
                    data: {
                        _token: '{{ csrf_token() }}',
                        name: $('#name').val(),
                        email: $('#email').val(),
                        password: $('#password').val()
                    },
                    success: function(response) {
                        if (response.status === 'success') {
                            $('#exampleModal').modal('hide');
                            $('#name, #email, #password').val('');
                            Swal.fire({
                                icon: 'success',
                                title: 'Added!',
                                text: response.message || "User has been Added.",
                                confirmButtonColor: '#3085d6',
                            });
                            userList();
                        }
                    },
                    error: function(xhr) {
                        if (xhr.status === 422) {
                            let errors = xhr.responseJSON.errors;

                            if (errors.name) {
                                $('#name').addClass('is-invalid');
                                $('#nameIcon').removeClass('d-none');
                                $('#nameError').removeClass('d-none').text(errors.name[0]);
                            }

                            if (errors.email) {
                                $('#email').addClass('is-invalid');
                                $('#emailIcon').removeClass('d-none');
                                $('#emailError').removeClass('d-none').text(errors.email[0]);
                            }

                            if (errors.password) {
                                $('#password').addClass('is-invalid');
                                $('#passwordIcon').removeClass('d-none');
                                $('#passwordError').removeClass('d-none').text(errors.password[
                                    0]);
                            }
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops!',
                                text: xhr.responseJSON?.message ||
                                    "Something went wrong. Please try again.",
                                confirmButtonColor: '#d33',
                            });
                        }
                    }
                });
            });

            $('#togglePassword').on('click', function() {
                const input = $('#password');
                const icon = $(this);
                const isPassword = input.attr('type') === 'password';

                input.attr('type', isPassword ? 'text' : 'password');
                icon.toggleClass('fa-eye fa-eye-slash');
            });


            $('#UpdateUser').on('click', function() {
                // Reset previous errors
                ['updateName', 'updateEmail'].forEach(field => {
                    $(`#${field}`).removeClass('is-invalid');
                    $(`#${field}Icon`).addClass('d-none');
                    $(`#${field}Error`).addClass('d-none').text('');
                });

                $.ajax({
                    type: 'POST',
                    url: '{{ route('user.update') }}',
                    data: {
                        _token: '{{ csrf_token() }}',
                        id: $('#updateid').val(),
                        name: $('#updateName').val(),
                        email: $('#updateEmail').val()
                    },
                    success: function(response) {
                        if (response.status === 'success') {
                            $('#updateModal').modal('hide');
                            $('#updateName, #updateEmail').val('');

                            Swal.fire({
                                icon: 'success',
                                title: 'Updated!',
                                text: response.message || "User has been Updated.",
                                confirmButtonColor: '#3085d6',
                            });
                            userList(); // Refresh list
                        }
                    },
                    error: function(xhr) {
                        if (xhr.status === 422) {
                            let errors = xhr.responseJSON.errors;

                            if (errors.name) {
                                $('#updateName').addClass('is-invalid');
                                $('#updateNameIcon').removeClass('d-none');
                                $('#updateNameError').removeClass('d-none').text(errors.name[
                                    0]);
                            }

                            if (errors.email) {
                                $('#updateEmail').addClass('is-invalid');
                                $('#updateEmailIcon').removeClass('d-none');
                                $('#updateEmailError').removeClass('d-none').text(errors.email[
                                    0]);
                            }
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops!',
                                text: xhr.responseJSON?.message ||
                                    "Something went wrong. Please try again.",
                                confirmButtonColor: '#d33',
                            });
                        }
                    }
                });
            });

        });


        function getInitials(name) {
            return name.split(' ').map(n => n[0]).join('').toUpperCase();
        }

        function userList() {
            $.ajax({
                type: "GET",
                url: '{{ route('user.get') }}',
                success: function(response) {
                    let users = response.data;
                    let html = "";
                    var no = 1;

                    if (users.data == null) {
                        html += `
                        <tr>
                            <td colspan="5" class="text-center">No users found</td>
                            </tr>
                            `;

                    } else {
                        users.forEach(user => {
                            html += `
                            <tr>
                                <td><span class="user-no">${no}</span></td>
                                <td>
                                    <div class="user-name">
                                        <div class="avatar">${getInitials(user.name)}</div>
                                        ${user.name}
                                    </div>
                                </td>
                                <td><span class="user-email">${user.email}</span></td>
                                <td>
                                    <div class="password-field">
                                        <span class="password-text password-hidden" id="password-${user.id}">••••••••</span>
                                    </div>
                                </td>
                                <td class="text-end">
                                    <button class="btn btn-edit action-btn" onclick="editUser(${user.id})" title="Edit">
                                        ✏️ Edit
                                    </button>
                                    <button class="btn btn-delete action-btn" onclick="deleteUser(${user.id})" title="Delete">
                                        🗑️ Delete
                                    </button>
                                </td>
                            </tr>
                        `;
                            no++;
                        });
                    }

                    $("#userList").html(html);
                },
                error: function() {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Something went wrong!',
                    })
                }
            });
        }

        function deleteUser(id) {
            Swal.fire({
                title: 'Are you sure?',
                text: "This action cannot be undone!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: "DELETE",
                        url: '{{ route('user.delete') }}',
                        data: {
                            _token: '{{ csrf_token() }}',
                            id: id
                        },
                        success: function(response) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Deleted!',
                                text: response.message || "User has been deleted.",
                                confirmButtonColor: '#3085d6',
                            });
                            userList();
                        },
                        error: function() {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error!',
                                text: "Failed to delete the user.",
                                confirmButtonColor: '#d33',
                            });
                        }
                    });
                }
            });
        }

        function editUser(id) {
            $.ajax({
                type: 'GET',
                url: '{{ route('user.edit') }}',
                data: {
                    id: id
                },
                success: function(response) {
                    console.log(response);

                    $('#updateName').val(response.data.name);
                    $('#updateEmail').val(response.data.email);
                    $('#updateid').val(response.data.id);
                    $('#updateModal').modal('show');
                },
                error: function(xhr) {
                    alert('Something went wrong. Please try again.');
                }
            });
        }
    </script>

</body>

</html>
