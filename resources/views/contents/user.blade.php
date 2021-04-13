@extends('layouts.admin')

@section('styles')
<link rel="stylesheet" href="{{ asset('adminlte/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('adminlte/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('adminlte/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
@endsection

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
                        <table id="tableUser" class="table table-bordered table-striped" width="100%">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>{{ trans('cruds.user.fields.nip') }}</th>
                                    <th>{{ trans('cruds.user.fields.name') }}</th>
                                    <th>{{ trans('cruds.user.fields.email') }}</th>
                                    <th class="text-nowrap">{{ trans('cruds.user.fields.verify') }}</th>
                                    <th>{{ trans('cruds.user.fields.created_at') }}</th>
                                    <th>{{ trans('cruds.user.fields.status') }}</th>
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
                            <span id="error-nip" class="error invalid-feedback"></span>
                        </div>
                        <div id="form-name" class="form-group">
                            <label for="name">{{ trans('cruds.user.fields.name') }}</label>
                            <input type="text" name="name" id="name" class="form-control" />
                            <span id="error-name" class="error invalid-feedback"></span>
                        </div>
                        <div id="form-email" class="form-group">
                            <label for="email">{{ trans('cruds.user.fields.email') }}</label>
                            <input type="text" name="email" id="email" class="form-control" />
                            <span id="error-email" class="error invalid-feedback"></span>
                        </div>
                        <div id="form-password" class="form-group">
                            <label for="password">{{ trans('cruds.user.fields.password') }}</label>
                            <input type="password" name="password" id="password" class="form-control" />
                            <span id="error-password" class="error invalid-feedback"></span>
                        </div>
                        <div id="form-password-confirm" class="form-group">
                            <label for="password-confirm">{{ trans('cruds.user.fields.password_confirm') }}</label>
                            <input type="password" name="password_confirmation" id="password-confirm"
                                class="form-control" />
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" name="action" id="action" />
                        <input type="hidden" name="id" id="id" />
                        <input type="submit" name="action_button" id="action_button" class="btn btn-primary"
                            value="tambah">
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
<script src="{{ asset('adminlte/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{ asset('adminlte/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{ asset('adminlte/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{ asset('adminlte/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
<script src="{{ asset('adminlte/plugins/datatables-buttons/js/dataTables.buttons.min.js')}}"></script>
<script src="{{ asset('adminlte/plugins/datatables-buttons/js/buttons.bootstrap4.min.js')}}"></script>
<script src="{{ asset('adminlte/plugins/jszip/jszip.min.js')}}"></script>
<script src="{{ asset('adminlte/plugins/pdfmake/pdfmake.min.js')}}"></script>
<script src="{{ asset('adminlte/plugins/pdfmake/vfs_fonts.js')}}"></script>
<script src="{{ asset('adminlte/plugins/datatables-buttons/js/buttons.html5.min.js')}}"></script>
<script src="{{ asset('adminlte/plugins/datatables-buttons/js/buttons.print.min.js')}}"></script>
<script src="{{ asset('adminlte/plugins/datatables-buttons/js/buttons.colVis.min.js')}}"></script>

<script>
    var table = $("#tableUser").DataTable({
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
            table.buttons().container().appendTo('#tableUser_wrapper .col-md-6:eq(0)')
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
                { data: "created_at" ,className: "text-center"},
                { data: "status" ,className: "text-center" },
                { data: "aksi",orderable: false, searchable: false ,className: "text-nowrap" }
            ]
        });

  //add function
    $('#create_record').click(function () {
        $('#action_button').val("{{ trans('cruds.user.fields.add') }}");
        $('#formModal').modal('show');
        $('.modal-title').text("{{ trans('cruds.user.title_add_modal')}}");
        $('#action').val("add");
        $('#userForm')[0].reset();
        $('.has-error').removeClass('has-error');
        $('.error').html('').removeClass('error');
    });


    // submit add and edit
    $('#userForm').on('submit', function (event) {
        event.preventDefault();
        var action = $('#action').val();
        if ( action == 'add') {
            $.ajax({
                url : "{{ route('user/store') }}",
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
                        $('#haktanahForm')[0].reset();
                        $('#haktanahTable').DataTable().ajax.reload();
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
               url : "{{ route('haktanah/update') }}",
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
                        $('#haktanahForm')[0].reset();
                        $('#haktanahTable').DataTable().ajax.reload();
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

</script>
@endsection
