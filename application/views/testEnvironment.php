<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Sury Technical TEST</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.3/font/bootstrap-icons.min.css">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
</head>
<body>

<div class="container mt-5">
    <div id="alert-container"></div>
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-md-8">
                    <h3>Lista usuarios</h3>
                </div>
                <div class="col-md-4">
                    <button type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#modalRegistrarUsuario">
                        Registrar Usuario
                    </button>
                </div>
            </div>
        </div>
        <div class="card-body">
         <input type="text" id="buscador" class="form-control mb-3" placeholder="Buscar...">
            <table id="tablaUsuarios" class="table table-striped">
                <thead>
                    <tr>
                        <th>Acciones</th>
                        <th>Nombre</th>
                        <th>Email</th>
                        <th>Telefono</th>
                        <th>Imagen Perfil</th>
                        <th>Fecha Creación</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($users as $user): ?>
                    <tr>
                        <!-- <td><?php echo $user->ID; ?></td> -->
                        <td>
                            <button type="button" class="btn btn-warning btn-sm edit-user" data-id="<?php echo $user->ID; ?>" data-toggle="modal" data-target="#modalEditarUsuario"><i class="bi bi-pen"></i></button>
                            <button type="button" class="btn btn-danger btn-sm delete-user" data-id="<?php echo $user->ID; ?>"><i class="bi bi-trash"></i></button>
                        </td>
                        <td><?php echo $user->Nombre; ?></td>
                        <td><?php echo $user->Email; ?></td>
                        <td><?php echo $user->Telefono; ?></td>
                        <td><img src="<?php echo base_url('uploads/' . $user->ImagenPerfil); ?>" alt="Imagen de Perfil" width="50"></td>
                        <td><?php echo $user->FechaCreacion; ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <div>
                <?php echo $links; ?>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="modalRegistrarUsuario" tabindex="-1" role="dialog" aria-labelledby="registerUserModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="registrarUsuarioLabel">Registrar nuevo</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="registrarUsuarioForm" enctype="multipart/form-data">
                    <?php echo form_hidden($this->security->get_csrf_token_name(), $this->security->get_csrf_hash()); ?>
                    <div class="form-group">
                        <label for="nombre">Nombre</label>
                        <input type="text" class="form-control" id="nombre" name="nombre" required minlength="3" maxlength="50">
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <div class="form-group">
                        <label for="telefono">Telefono</label>
                        <input type="text" class="form-control" id="telefono" name="telefono" pattern="[0-9]{8,15}">
                    </div>
                    <div class="form-group">
                        <label for="imagenPerfil">Imagen de Perfil</label>
                        <input type="file" class="form-control-file" id="imagenPerfil" name="imagenPerfil" accept=".jpg,.png">
                        <img id="registrar-imagenPerfil-preview" src="" alt="Imagen de Perfil" width="100" class="mt-2">
                    </div>
                    <button type="submit" class="btn btn-primary">Register</button>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modalEditarUsuario" tabindex="-1" role="dialog" aria-labelledby="modalEditarUsuario" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalEditarUsuario">Editar Usuario</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="editarUsuarioForm" enctype="multipart/form-data">
                    <?php echo form_hidden($this->security->get_csrf_token_name(), $this->security->get_csrf_hash()); ?>
                    <input type="hidden" id="edit-id" name="id">
                    <input type="hidden" id="edit-imagenPerfil-hidden" name="imagenPerfil_hidden">
                    <div class="form-group">
                        <label for="edit-nombre">Nombre</label>
                        <input type="text" class="form-control" id="edit-nombre" name="nombre" required minlength="3" maxlength="50">
                    </div>
                    <div class="form-group">
                        <label for="edit-email">Email</label>
                        <input type="email" class="form-control" id="edit-email" name="email" required>
                    </div>
                    <div class="form-group">
                        <label for="edit-telefono">Telefono</label>
                        <input type="text" class="form-control" id="edit-telefono" name="telefono" pattern="[0-9]{8,15}">
                    </div>
                    <div class="form-group">
                        <label for="edit-imagenPerfil">Imagen de Perfil</label>
                        <input type="file" class="form-control-file" id="edit-imagenPerfil" name="imagenPerfil" accept=".jpg,.png">
                        <img id="edit-imagenPerfil-preview" src="" alt="Imagen de Perfil" width="100" class="mt-2">
                    </div>
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </form>
            </div>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>
<script>
    $(document).ready(function() {
        var csrfName = '<?php echo $this->security->get_csrf_token_name(); ?>';
        var csrfHash = '<?php echo $this->security->get_csrf_hash(); ?>';
        
        $('#buscador').on('keyup', function() {
            var value = $(this).val().toLowerCase();
            $('#tablaUsuarios tbody tr').filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });
        $('#registrarUsuarioForm').on('submit', function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            formData.append(csrfName, csrfHash);//agrego los tokens solicitados
            //valido el tamaño
            var imagenPerfil = $('#imagenPerfil')[0].files[0];
            if (imagenPerfil && imagenPerfil.size > 2 * 1024 * 1024) { // 2MB
                alert('El peso de la imagen deberia ser  menor a 2MB');
                return;
            }
            $.ajax({
                url: '<?php echo base_url('Welcome/registrarUsuario'); ?>',
                type: 'POST',
                data: formData,
                dataType: 'json',
                contentType: false,
                processData: false,
                success: function(response) {
                    console.log(response);
                    if(response.status == 'error') {
                        alert(response.message);
                        return;
                    }else{
                        alert('User registered successfully!');
                        $('#modalRegistrarUsuario').modal('hide');
                        location.reload();
                    }
                },
                error: function(response) {
                    alert('Failed to register user.');
                }
            });
        });
        // Edit user
        $('.edit-user').on('click', function() {
            var id = $(this).data('id');
            $.ajax({
                url: '<?php echo base_url('Welcome/getUser'); ?>/' + id,
                type: 'GET',
                success: function(response) {
                    var user = JSON.parse(response);
                    $('#edit-id').val(user.ID);
                    $('#edit-nombre').val(user.Nombre);
                    $('#edit-email').val(user.Email);
                    $('#edit-telefono').val(user.Telefono);
                    $('#edit-imagenPerfil-hidden').val(user.ImagenPerfil);
                    $('#edit-imagenPerfil-preview').attr('src', '<?php echo base_url('uploads/'); ?>' + user.ImagenPerfil);
                },
                error: function(response) {
                    $('#alert-container').html('<div class="alert alert-danger alert-dismissible fade show" role="alert">Failed to fetch user data.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
                }
            });
        });

        $('#editarUsuarioForm').on('submit', function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            formData.append(csrfName, csrfHash);//agrego los tokens solicitados
            //valido el tamaño
            var editImagenPerfil = $('#edit-imagenPerfil')[0].files[0];
            if (editImagenPerfil && editImagenPerfil.size > 2 * 1024 * 1024) { // 2MB
                alert('El peso de la imagen deberia ser  menor a 2MB');
                return;
            }
            $.ajax({
                url: '<?php echo base_url('Welcome/editarUsuario'); ?>',
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {
                    $('#alert-container').html('<div class="alert alert-success alert-dismissible fade show" role="alert">User updated successfully!<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
                    $('#modalEditarUsuario').modal('hide');
                    location.reload();
                },
                error: function(response) {
                    $('#alert-container').html('<div class="alert alert-danger alert-dismissible fade show" role="alert">Failed to update user.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
                }
            });
        });

        // Delete user
        $('.delete-user').on('click', function() {
            var id = $(this).data('id');
            if (confirm('¿Esta seguro que desea eliminar el usuario?')) {
                $.ajax({
                    url: '<?php echo base_url('Welcome/eliminarUsuario'); ?>/' + id,
                    type: 'POST',
                    data: {[csrfName]: csrfHash},
                    success: function(response) {
                        $('#alert-container').html('<div class="alert alert-success alert-dismissible fade show" role="alert">User deleted successfully!<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
                        location.reload();
                    },
                    error: function(response) {
                        $('#alert-container').html('<div class="alert alert-danger alert-dismissible fade show" role="alert">Failed to delete user.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
                    }
                });
            }
        });
        // Image preview for register modal
        $('#imagenPerfil').on('change', function() {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#registrar-imagenPerfil-preview').attr('src', e.target.result);
            }
            reader.readAsDataURL(this.files[0]);
        });

        // Image preview for edit modal
        $('#edit-imagenPerfil').on('change', function() {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#edit-imagenPerfil-preview').attr('src', e.target.result);
            }
            reader.readAsDataURL(this.files[0]);
        });
    });
</script>
</body>
</html>