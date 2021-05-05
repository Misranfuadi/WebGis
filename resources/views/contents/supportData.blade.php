@extends('layouts.admin')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Data Support</h1>
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
                        <h1 class="card-title">Data Nama Field
                        </h1>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="aliasTable" class="table table-bordered table-striped" width="100%">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th class="text-nowrap">Nama Field</th>
                                    <th>Alias</th>
                                    <th>Penginput</th>
                                    <th>{{ trans('cruds.user.fields.created_at') }}</th>
                                    <th>{{ trans('cruds.user.fields.updated_at') }}</th>
                                    <th style="text-align: center">
                                        <button type="button" name="create_record_alias" id="create_record_alias"
                                            class=" btn btn-xs btn-primary">
                                            <i class="fa fa-plus mr-2"></i>{{ trans('cruds.user.fields.add') }}</button>
                                    </th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>

            <div class="row">
                <div class="card col">
                    <div class="card-header">
                        <h1 class="card-title">Data Jenis Rencana
                        </h1>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="rencanaTable" class="table table-bordered table-striped" width="100%">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Jenis Rencana</th>
                                    <th>Penginput</th>
                                    <th>{{ trans('cruds.user.fields.created_at') }}</th>
                                    <th>{{ trans('cruds.user.fields.updated_at') }}</th>
                                    <th style="text-align: center">
                                        <button type="button" name="create_record_rencana" id="create_record_rencana"
                                            class=" btn btn-xs btn-primary">
                                            <i class="fa fa-plus mr-2"></i>{{ trans('cruds.user.fields.add') }}</button>
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
    <!-- /.content -->

    {{-- modal-add-alias --}}
    <div id="formModalAlias" class="modal fade" role="dialog" data-backdrop="static">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form id="aliasForm" novalidate>
                    @csrf
                    @method('POST')
                    <div class="card-body">
                        <div id="form-nama_field" class="form-group">
                            <label for="nama_field">Nama Field</label>
                            <input type="text" name="nama_field" id="nama_field" class="form-control" />
                            <span id="error-nama_field" class="error text-red"></span>
                        </div>
                        <div id="form-alias" class="form-group">
                            <label for="alias">Alias</label>
                            <input type="text" name="alias" id="alias" class="form-control" />
                            <span id="error-alias" class="error text-red"></span>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" name="action_alias" id="action_alias" />
                        <input type="hidden" name="id" id="id" />
                        <input type="submit" name="action_button_alias" id="action_button_alias"
                            class="btn btn-primary">
                        <button type="button" class="btn btn-default"
                            data-dismiss="modal">{{ trans('cruds.user.fields.close') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- modal-add-rencana --}}
    <div id="formModalRencana" class="modal fade" role="dialog" data-backdrop="static">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form id="rencanaForm" novalidate>
                    @csrf
                    @method('POST')
                    <div class="card-body">
                        <div id="form-nama_rencana" class="form-group">
                            <label for="nama_rencana">Nama Rencana</label>
                            <input type="text" name="nama_rencana" id="nama_rencana" class="form-control" />
                            <span id="error-nama_rencana" class="error text-red"></span>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" name="action_rencana" id="action_rencana" />
                        <input type="hidden" name="id" id="id_rencana" />
                        <input type="submit" name="action_button_rencana" id="action_button_rencana"
                            class="btn btn-primary">
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
                    <input type="hidden" name="action_delete" id="action_delete" />
                    <button type="button" name="ok_button" id="ok_button" class="btn btn-danger">OK</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                </div>
                </form>
            </div>
        </div>
    </div>


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


    var table = $("#aliasTable").DataTable({
        "responsive": true,
        "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],

        processing: true,
        serverSide: true,
        ajax: {"dataType": 'json',
            url : "{{ route('support.alias') }}",
            type : "GET",
        },

        columns: [
            { data: "DT_RowIndex" , width: 10 },
            { data: "nama_field" },
            { data: "alias" , className:"text-nowrap"},
            { data: "created_by" },
            { data: "created_at" },
            { data: "updated_at" },
            { data: "aksi",orderable: false, searchable: false ,className: "text-nowrap text-center" }
        ]
    });

    var table = $("#rencanaTable").DataTable({
        "responsive": true,
        "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],

        processing: true,
        serverSide: true,
        ajax: {"dataType": 'json',
            url : "{{ route('support.rencana') }}",
            type : "GET",
        },
        columns: [
            { data: "DT_RowIndex" , width: 10 },
            { data: "title" },
            { data: "created_by" },
            { data: "created_at" },
            { data: "updated_at" },
            { data: "aksi",orderable: false, searchable: false ,className: "text-nowrap text-center" }
        ]" }
        ]
    });

    //add-alias function
    $('#create_record_alias').click(function () {
        $('#action_button_alias').val("{{ trans('cruds.user.fields.add') }}");
        $('#formModalAlias').modal('show');
        $('.modal-title').text("{{ trans('cruds.alias.title_add_modal')}}");
        $('#action_alias').val("add");
        $('#aliasForm')[0].reset();
        $('.has-error').removeClass('has-error');
        $('.error').html('').removeClass('error');
    });

    //edit-alias function
    $(document).on('click', '.edit_alias', function () {
        var id = $(this).attr('id');
        $.ajax({

            url: "/support/alias/edit/" + id ,
            dataType: "json",
            type:"GET",
            beforeSend: function () {
                  $('.has-error').removeClass('has-error');
                  $('.error').html('').removeClass('error');
                  $('.modal-title').text("{{ trans('cruds.alias.title_edit_modal')}}");
                  $('.bg-loading').show();
                  $('#aliasForm')[0].reset();
                 },
            success: function (data) {
                $('.bg-loading').hide();
                $('#nama_field').val(data.nama_field);
                $('#alias').val(data.alias);
                $('#id').val(id);
                $('#action_button').val("{{ trans('cruds.user.fields.edit') }}");
                $('#action_alias').val("edit");
                $('#formModalAlias').modal('show');
            }

        })
    });

    //add-rencana function
    $('#create_record_rencana').click(function () {
        $('#action_button_rencana').val("{{ trans('cruds.user.fields.add') }}");
        $('#formModalRencana').modal('show');
        $('.modal-title').text("{{ trans('cruds.rencana.title_add_modal')}}");
        $('#action_rencana').val("add");
        $('#rencanaForm')[0].reset();
        $('.has-error').removeClass('has-error');
        $('.error').html('').removeClass('error');
    });

    //edit-rencana function
    $(document).on('click', '.edit_rencana', function () {
        var id = $(this).attr('id');
        $.ajax({

            url: "/support/rencana/edit/" + id ,
            dataType: "json",
            type:"GET",
            beforeSend: function () {
                  $('.has-error').removeClass('has-error');
                  $('.error').html('').removeClass('error');
                  $('.modal-title').text("{{ trans('cruds.rencana.title_edit_modal')}}");
                  $('.bg-loading').show();
                  $('#rencanaForm')[0].reset();
                 },
            success: function (data) {
                $('.bg-loading').hide();
                $('#nama_rencana').val(data.title);
                $('#id_rencana').val(id);
                $('#action_button').val("{{ trans('cruds.user.fields.edit') }}");
                $('#action_rencana').val("edit");
                $('#formModalRencana').modal('show');
            }

        })
    });


    //function add and edit alias
    $('#aliasForm').on('submit', function (event) {
        event.preventDefault();
        var action = $('#action_alias').val();
        if ( action == 'add') {
            $.ajax({
                url : "{{ route('alias.store') }}",
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
                        $('#aliasForm')[0].reset();
                        $('#aliasTable').DataTable().ajax.reload();
                        $('.bg-loading').hide();
                        $('#formModalAlias').modal('hide');
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
               url : "{{ route('alias.update') }}",
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
                        $('#aliasForm')[0].reset();
                        $('#aliasTable').DataTable().ajax.reload();
                        $('.bg-loading').hide();
                        $('#formModalAlias').modal('hide');
                        Toast.fire({
                            icon: 'success',
                            title: 'Data berhasil diedit'
                        });
                    }
                }
            });
        }
    });


    //function add and edit rencana
    $('#rencanaForm').on('submit', function (event) {
        event.preventDefault();
        var action = $('#action_rencana').val();
        if ( action == 'add') {
            $.ajax({
                url : "{{ route('rencana.store') }}",
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
                        $('#rencanaForm')[0].reset();
                        $('#rencanaTable').DataTable().ajax.reload();
                        $('.bg-loading').hide();
                        $('#formModalRencana').modal('hide');
                        Toast.fire({
                            icon: 'success',
                            title: 'Data berhasil disimpan'
                        });
                    }
                    if(data.errors){
                        Toast.fire({
                            icon: 'error',
                            title: data.errors
                        });
                    }
                }
            })
        }

        if (action == "edit") {
            $.ajax({
               url : "{{ route('rencana.update') }}",
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
                        $('#rencanaForm')[0].reset();
                        $('#rencanaTable').DataTable().ajax.reload();
                        $('.bg-loading').hide();
                        $('#formModalRencana').modal('hide');
                        Toast.fire({
                            icon: 'success',
                            title: 'Data berhasil diedit'
                        });
                    }
                }
            });
        }
    });

    // delete alias
    $(document).on('click', '.delete_alias', function () {
        user_id = $(this).attr('id');
        token = $(this).attr('token');
        $('#action_delete').val("alias");
        $('#confirmModal').modal('show');
    });

     $(document).on('click', '.delete_rencana', function () {
        user_id = $(this).attr('id');
        token = $(this).attr('token');
        $('#action_delete').val("rencana");
        $('#confirmModal').modal('show');
    });

    $('#ok_button').click(function () {
        event.preventDefault();
        var action = $('#action_delete').val();
        if ( action == 'alias') {
            $.ajax({
                url: "support/alias/destroy/" + user_id,
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
                    $('#aliasTable').DataTable().ajax.reload();
                    $('.bg-loading').hide();
                    Toast.fire({
                        icon: 'success',
                        title: 'Data berhasil dihapus'
                    });
                    }
                }
            })
        }
        if ( action == 'rencana') {
            $.ajax({
                url: "support/rencana/destroy/" + user_id,
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
                    $('#rencanaTable').DataTable().ajax.reload();
                    $('.bg-loading').hide();
                    Toast.fire({
                        icon: 'success',
                        title: 'Data berhasil dihapus'
                    });
                    }
                }
            })
        }
    });

</script>
@endsection
