@extends('layouts.admin')

@section('styles')
<!-- Select2 -->
<link rel="stylesheet" href="{{ asset('adminlte/plugins/select2/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('adminlte/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
@endsection

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">{{ trans('cruds.shp.title') }}</h1>
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
                        <table id="shpTable" class="table table-bordered table-striped" width="100%">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>No.Reg</th>
                                    <th>Peta</th>
                                    <th>Keluaran</th>
                                    <th class="text-nowrap">Jenis Rencana</th>
                                    <th class="text-nowrap">Sumber Dokumen</th>
                                    <th class="text-nowrap">Jenis Data</th>
                                    <th>Alias</th>
                                    <th>Penginput</th>
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
    <!-- /.content -->


    {{-- modal-add-shp --}}
    <div id="formModal" class="modal fade" role="dialog" data-backdrop="static">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form id="shpForm" novalidate enctype="multipart/form-data">
                    @csrf
                    @method('POST')
                    <div class="card-body">
                        <div class="row">
                            <div class="col-6">
                                <div id="form-nama_peta" class="form-group ">
                                    <label for="nama_peta">Nama Peta</label>
                                    <input type="text" name="nama_peta" id="nama_peta"
                                        class="form-control form-control-sm" />
                                    <span id="error-nama_peta" class="error text-red"></span>
                                </div>

                                <div id="form-keluaran" class="form-group">
                                    <label for="keluaran">Keluaran</label>
                                    <input type="text" name="keluaran" id="keluaran"
                                        class="form-control form-control-sm" />
                                    <span id="error-keluaran" class="error text-red"></span>
                                </div>
                                <div id="form-sumber_dokumen" class="form-group">
                                    <label for="sumber_dokumen">Sumber Dokumen</label>
                                    <input type="text" name="sumber_dokumen" id="sumber_dokumen"
                                        class="form-control form-control-sm" />
                                    <span id="error-sumber_dokumen" class="error text-red"></span>
                                </div>

                                <div id="form-jenis_rencana" class="form-group">
                                    <label for="jenis_rencana">Jenis Rencana</label>

                                    @if ( count($listRencana) > 0)
                                    <select class="form-control form-control-sm select2" id="jenis_rencana"
                                        name="jenis_rencana" style="width: 100%;">
                                        <option value="" selected="selected">Pilih Jenis Rencana</option>
                                        @foreach ($listRencana as $rencana)
                                        <option value="{{ $rencana->id }}">{{ $rencana->title}}
                                        </option>
                                        @endforeach
                                    </select>
                                    @else
                                    <a href="{{ route('support') }}"
                                        class="form-control form-control-sm  btn btn-primary btn-sm">Data Rencana
                                        belum tersedia
                                    </a>
                                    @endif
                                    <span id="error-jenis_rencana" class="error text-red"></span>
                                </div>


                            </div>

                            <div class="col-6">
                                <div id="form-jenis_data" class="form-group">
                                    <label for="jenis_data">Jenis Data</label>
                                    <select class="form-control form-control-sm select2" id="jenis_data"
                                        name="jenis_data">
                                        <option value="" selected="selected">Pilih Jenis Data</option>
                                        <option value="polygon">Polygon</option>
                                        <option value="line">Line</option>
                                        <option value="point">Point</option>
                                    </select>
                                    <span id="error-jenis_data" class="error text-red"></span>
                                </div>

                                <div id="form-nama_field" class="form-group">
                                    <label for="nama_field">Nama Field</label>
                                    @if ( count($listAlias) > 0)
                                    <select class="form-control form-control-sm select2" id="nama_field"
                                        name="nama_field" style="width: 100%;">
                                        <option value="" selected="selected">Pilih Nama Field / Alias</option>
                                        @foreach ($listAlias as $alias)
                                        <option value="{{ $alias->id }}">
                                            ({{ $alias->nama_field}}) {{ $alias->alias }}
                                        </option>
                                        @endforeach
                                    </select>
                                    @else
                                    <a href="{{ route('support') }}"
                                        class="form-control form-control-sm  btn btn-primary btn-sm">Data Nama Field
                                        belum tersedia
                                    </a>
                                    @endif
                                    <span id="error-nama_field" class="error text-red"></span>
                                </div>

                                <div id="form-file_shp" class="form-group">
                                    <label for="file_shp">File SHP (.zip atau .rar)</label>

                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" name="file_shp" id="file_shp">
                                        <label class="custom-file-label" for="file_shp"></label>
                                    </div>

                                    <span id="error-file_shp" class="error text-red"></span>

                                </div>

                                <div id="form-note" class="form-group">
                                    <label for="note">Note</label>
                                    <textarea name="note" id="note" class="form-control form-control-sm"
                                        rows="3"></textarea>
                                </div>
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
</div>
@endsection

@section('scripts')
<!-- Select2 -->
<script src="{{ asset("adminlte/plugins/select2/js/select2.full.min.js") }}"></script>
<!-- bs-custom-file-input -->
<script src="{{ asset("adminlte/plugins/bs-custom-file-input/bs-custom-file-input.min.js") }}"></script>

<script>
    $('.select2').select2()

    $(function () {
      bsCustomFileInput.init();
    });

    const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000
    });

    var table = $("#shpTable").DataTable({
        "responsive": true,
        "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
        dom: 'Bfrtip',
        "buttons": [
                {
                    extend: 'copy',
                    exportOptions: {
                        columns: [ 0, 1, 2, 3, 4 ,5,6,7,8 ]
                    }
                },
                {
                    extend: 'excel',
                    title: 'Data SHP',
                    exportOptions: {
                        columns: [ 0, 1, 2, 3, 4 ,5,6,7,8 ]
                    },
                    customize: function( xlsx ) {
                        var sheet = xlsx.xl.worksheets['sheet1.xml'];
                        $('row c', sheet).attr( 's', '25' );
                    }
                },
                {
                    extend: 'pdf',
                    title: 'Data SHP',
                    exportOptions: {
                        columns: [ 0, 1, 2, 3, 4 ,5,6,7,8 ]
                    }
                },
                {
                    extend: 'print',
                    exportOptions: {
                        columns: [ 0, 1, 2, 3, 4,5,6,7,8 ]
                    }
                }, "colvis"],
        "initComplete": function(settings, json) {
            table.buttons().container().appendTo('#shpTable_wrapper .col-md-4:eq(0)')
        },
        processing: true,
        serverSide: true,
        ajax: {"dataType": 'json',
            url : "{{ route('shp') }}",
            type : "GET",
        },
        columns: [
            { data: "DT_RowIndex" , width: 10 },
            { data: "register" },
            { data: "peta",},
            { data: "keluaran",className: "text-nowrap" },
            { data: "id_rencana" },
            { data: "sumber_dokumen" ,className: "text-nowrap" },
            { data: "jenis_data", className:"text-capitalize" },
            { data: "id_alias" },
            { data: "created_by" },
            { data: "created_at" },
            { data: "updated_at" },
            { data: "aksi",orderable: false, searchable: false ,className: "text-nowrap" }
        ]
    });

    $('#create_record').click(function () {
        $('#action_button').val("{{ trans('cruds.user.fields.add') }}");
        $('#formModal').modal('show');
        $('#form-file_shp').show();
        $('#form-note').show();
        $('.modal-title').text("Tambah Data Shp");
        $('#action').val("add");
        $('#shpForm')[0].reset();

        $('#jenis_rencana').val('').change();
        $('#jenis_data').val('').change();
        $('#nama_field').val('').change();


        $('.has-error').removeClass('has-error');
        $('.error').html('').removeClass('error');
    });

    //edit function
    $(document).on('click', '.edit', function () {
        var id = $(this).attr('id');
        $.ajax({
            url: "/shp/edit/" + id ,
            dataType: "json",
            type:"GET",
            beforeSend: function () {
                  $('.has-error').removeClass('has-error');
                  $('.error').html('').removeClass('error');
                  $('.modal-title').text("Edit Data Shp");
                  $('.bg-loading').show();
                  $('#shpForm')[0].reset();
                 },
            success: function (data) {
                $('.bg-loading').hide();
                $('#form-file_shp').hide();
                $('#form-note').hide();
                $('#nama_peta').val(data.peta);
                $('#keluaran').val(data.keluaran);
                $('#sumber_dokumen').val(data.sumber_dokumen);
                $('#jenis_rencana').val(data.id_rencana).change();
                $('#jenis_data').val(data.jenis_data).change();
                $('#nama_field').val(data.id_alias).change();
                $('#id').val(id);
                $('#action_button').val("{{ trans('cruds.user.fields.edit') }}");
                $('#action').val("edit");
                $('#formModal').modal('show');
            }

        })
    });

    $('#shpForm').on('submit', function (event) {
        event.preventDefault();
        var action = $('#action').val();
        if ( action == 'add') {
            $.ajax({
                url : "{{ route('shp.store') }}",
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
                        $('#shpForm')[0].reset();
                        $('#shpTable').DataTable().ajax.reload();
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
               url : "{{ route('shp.update') }}",
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
                        $('#shpForm')[0].reset();
                        $('#shpTable').DataTable().ajax.reload();
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
            url: "shp/destroy/" + user_id,
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
                $('#shpTable').DataTable().ajax.reload();
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
