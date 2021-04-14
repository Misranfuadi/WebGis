@extends('layouts.admin')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">{{ trans('cruds.user.title') }}</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Starter Page</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="card col">
                    <div class="card-header">
                        <button type="button" name="create_record" id="create_record" class=" btn btn-sm btn-primary">
                            <i class="fa fa-plus mr-2"></i>{{ trans('cruds.user.fields.add') }}</button>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="userTable" class="table table-bordered table-striped" width="100%">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>{{ trans('cruds.user.fields.nip') }}</th>
                                    <th>{{ trans('cruds.user.fields.name') }}</th>
                                    <th>{{ trans('cruds.user.fields.email') }}</th>
                                    <th class="text-nowrap">{{ trans('cruds.user.fields.verify') }}</th>
                                    <th>{{ trans('cruds.user.fields.status') }}</th>
                                    <th>{{ trans('cruds.user.fields.role') }}</th>
                                    <th>{{ trans('cruds.user.fields.created_at') }}</th>
                                    <th>{{ trans('cruds.user.fields.updated_at') }}</th>
                                    <th style="text-align: center">
                                        {{ trans('cruds.user.fields.action') }}
                                    </th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
        </div>
    </div>

    {{-- modal-add --}}
    <div id="formModal" class="modal fade" role="dialog" data-backdrop="static">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form id="userForm" novalidate>
                    @csrf
                    @method('POST')
                    <div class="card-body">
                        <div id="form-nip" class="form-group">
                            <label for="nip">{{ trans('cruds.user.fields.nip') }}</label>
                            <input type="text" name="nip" id="nip" class="form-control" />
                            <span id="error-nip" class="error text-red"></span>
                        </div>
                        <div id="form-nama" class="form-group">
                            <label for="nama">{{ trans('cruds.user.fields.name') }}</label>
                            <input type="text" name="nama" id="nama" class="form-control" />
                            <span id="error-nama" class="error text-red"></span>
                        </div>
                        <div id="form-role" class="form-group">
                            <label for="role">{{ trans('cruds.user.fields.role') }}</label>
                            <select name="role" id="role" class="form-control">
                                <option>Pilih Role</option>
                                <option value="staff">Staff</option>
                                <option value="approver">Approver</option>
                                <option value="master">Master</option>
                            </select>
                            <span id="error-role" class="error text-red"></span>
                        </div>

                        <div id="form-status" class="form-group">
                            <label for="status">{{ trans('cruds.user.fields.status') }}</label>
                            <select name="status" id="status" class="form-control">
                                <option value="1">Approve</option>
                                <option value="0">Unapprove</option>
                                <option value="2">Blocked</option>
                            </select>
                            <span id="error-status" class="error text-red"></span>
                        </div>

                        <div id="form-email" class="form-group">
                            <label for="email">{{ trans('cruds.user.fields.email') }}</label>
                            <input type="text" name="email" id="email" class="form-control" />
                            <span id="error-email" class="error text-red"></span>
                        </div>
                        <div id="form-password" class="form-group">
                            <label for="password">{{ trans('cruds.user.fields.password') }}</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="fa fa-key"></i>
                                        <input id="ubahPass" type="checkbox" class="ml-2">
                                    </span>
                                </div>
                                <input id="password" type="password" name="password" class="form-control" />
                            </div>
                            <span id="error-password" class="error text-red"></span>
                        </div>

                        <div id="form-password-confirm" class="form-group ">
                            <label for="password-confirm">{{ trans('cruds.user.fields.password_confirm') }}</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"> <i class="fa fa-key"></i></span>
                                </div>
                                <input type="password" name="password_confirmation" class="form-control" />
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" name="action" id="action" />
                        <input type="hidden" name="id" id="id" />
                        <input type="submit" name="action_button" id="action_button" class="btn btn-primary">
                        <button type="button" class="btn btn-default"
                            data-dismiss="modal">{{ trans('cruds.user.fields.close') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- modal-delete--}}
    <div id="confirmModal" class="modal fade" data-backdrop="static" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-body">
                    <div class="modal-wrapper  text-center">
                        <div class="center ">
                            <h1 class="fa fa-question-circle" style="color:#5bc0de;"></h1>
                        </div>
                        <div class="modal-text">
                            <h4>Anda yakin?</h4>
                            <p>Yakin untuk menghapus data ini?</p>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" name="ok_button" id="ok_button" class="btn btn-danger">OK</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                </div>
                </form>
            </div>
        </div>
    </div>


    <!-- /.content -->
</div>
@endsection

@section('scripts')

<script>
    const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000
    });

    $('#ubahPass').on('change', function(e) {
      e.preventDefault();
      if ($(this).is(':checked')) {
        $('#password').prop('readonly',false);
        $('#form-password-confirm').prop('hidden',false);
      } else {
        $('#password').val('');
        $('#password').prop('readonly',true);
        $('#form-password-confirm').prop('hidden',true);
      }
    });

    var table = $("#userTable").DataTable({
        "responsive": true,
        "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
        "buttons": [
                {
                    extend: 'copy',
                    exportOptions: {
                        columns: [ 0, 1, 2, 3, 4 ,5,6 ]
                    }
                },
                {
                    extend: 'excel',
                    exportOptions: {
                        columns: [ 0, 1, 2, 3, 4 ,5,6 ]
                    }
                },
                {
                    extend: 'pdf',
                    exportOptions: {
                        columns: [ 0, 1, 2, 3, 4 ,5,6 ]
                    }
                },
                {
                    extend: 'print',
                    exportOptions: {
                        columns: [ 0, 1, 2, 3, 4,5,6 ]
                    }
                }, "colvis"],
        "initComplete": function(settings, json) {
            table.buttons().container().appendTo('#tableUser_wrapper .col-md-4:eq(0)')
        },



        processing: true,
        serverSide: true,
        ajax: {"dataType": 'json',
            url : "{{ route('user') }}",
            type : "GET",
        },

            columns: [
                { data: "DT_RowIndex" , width: 10 },
                { data: "nip" , className:"text-center"},
                { data: "name" , className: "text-nowrap" },
                { data: "email" },
                { data: "verify" ,className: "text-center"},
                { data: "status" ,className: "text-center"},
                { data: "role" ,className:"text-capitalize"},
                { data: "created_at" },
                { data: "updated_at" },
                { data: "aksi",orderable: false, searchable: false ,className: "text-nowrap" }
            ]
        });

  //add function
    $('#create_record').click(function () {
        $('#action_button').val("{{ trans('cruds.user.fields.add') }}");
        $('#formModal').modal('show');
        $('.modal-title').text("{{ trans('cruds.user.title_add_modal')}}");
        $('#ubahPass').prop('hidden',true);
        $('#password').prop('readonly',false);
        $('#password').prop('placeholder', '');
        $('#form-password-confirm').prop('hidden',false);
        $('#action').val("add");
        $('#userForm')[0].reset();
        $('.has-error').removeClass('has-error');
        $('.error').html('').removeClass('error');
    });

     //edit function
    $(document).on('click', '.edit', function () {
        var id = $(this).attr('id');
        $.ajax({
            url: "/user/edit/" + id ,
            dataType: "json",
            type:"GET",
            beforeSend: function () {
                  $('.has-error').removeClass('has-error');
                  $('.error').html('').removeClass('error');
                  $('.modal-title').text("{{ trans('cruds.user.title_edit_modal')}}");
                  $('#ubahPass').prop('hidden',false);
                  $('#password').prop('readonly',true);
                  $('#password').prop('placeholder','Ubah/Reset Password');
                  $('#form-password-confirm').prop('hidden',true);
                  $('.bg-loading').show();
                  $('#userForm')[0].reset();
                 },
            success: function (data) {
                $('.bg-loading').hide();
                $('#nama').val(data.name);
                $('#nip').val(data.nip);
                $('#email').val(data.email);
                $('#role').val(data.role);
                $('#status').val(data.status);
                $('#id').val(id);
                $('#action_button').val("{{ trans('cruds.user.fields.edit') }}");
                $('#action').val("edit");
                $('#formModal').modal('show');
            }

        })
    });


    // submit add and edit
    $('#userForm').on('submit', function (event) {
        event.preventDefault();
        var action = $('#action').val();
        if ( action == 'add') {
            $.ajax({
                url : "{{ route('user.store') }}",
                type: "POST",
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData: false,
                dataType: "json",
                beforeSend: function () {
                  $('.has-error').removeClass('has-error');
                  $('.error').html('').removeClass('error');
                  $('.bg-loading').show();
                 },
                success: function (data) {
                    if (data.errors) {
                        for (control in data.errors) {
                            $('#form-' + control).addClass('has-error');
                            $('#error-' + control).addClass('error').html(data.errors[control]);
                            $('.bg-loading').hide();
                        }
                    }
                    if (data.success) {
                        $('#userForm')[0].reset();
                        $('#userTable').DataTable().ajax.reload();
                        $('.bg-loading').hide();
                        $('#formModal').modal('hide');
                        Toast.fire({
                            icon: 'success',
                            title: 'Data berhasil disimpan'
                        });
                    }
                }
            })
        }

        if (action == "edit") {
            $.ajax({
               url : "{{ route('user.update') }}",
                type: "POST",
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData: false,
                dataType: "json",
                beforeSend: function () {
                  $('.has-error').removeClass('has-error');
                  $('.error').html('').removeClass('error');
                  $('.bg-loading').show();
                 },
                success: function (data) {
                   if (data.errors) {
                        for (control in data.errors) {
                            $('#form-' + control).addClass('has-error');
                            $('#error-' + control).addClass('error').html(data.errors[control]);
                            $('.bg-loading').hide();
                        }
                    }
                    if (data.success) {
                        $('#userForm')[0].reset();
                        $('#userTable').DataTable().ajax.reload();
                        $('.bg-loading').hide();
                        $('#formModal').modal('hide');
                        Toast.fire({
                            icon: 'success',
                            title: 'Data berhasil diedit'
                        });
                    }
                }
            });
        }
    });

    //delete function
    $(document).on('click', '.delete', function () {
        user_id = $(this).attr('id');
        token = $(this).attr('token');
        $('#confirmModal').modal('show');
    });
    $('#ok_button').click(function () {
        $.ajax({
            url: "user/destroy/" + user_id,
            data: {
            _token: token
            },
            type : "DELETE",
            beforeSend: function () {
              $('#confirmModal').modal('hide');
              $('.bg-loading').show();
            },
            success: function (data) {
                if (data.errors){
                    $('.bg-loading').hide();
                    Toast.fire({
                        icon: 'error',
                        title: 'Data gagal dihapus'
                    });
                }
                 if (data.success) {
                $('#tableUser').DataTable().ajax.reload();
                $('.bg-loading').hide();
                Toast.fire({
                    icon: 'success',
                    title: 'Data berhasil dihapus'
                });
                }
            }
        })
    });

</script>
@endsection
