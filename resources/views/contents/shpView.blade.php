@extends('layouts.admin')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>View Data</h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->


    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-5">

                    <!-- Profile Image -->
                    <div class="card card-primary card-outline">
                        <div class="card-body box-profile">

                            <h3 class="profile-username text-center">{{ $data->peta }}</h3>
                            <p class="text-muted text-center">No.Reg {{ $data->register }}</p>
                            <strong>Keluaran</strong>
                            <p class="text-muted"> {{ $data->keluaran }}</p>
                            <hr>
                            <strong>Rencana</strong>
                            <p class="text-muted">{{ $data->rencana->title }}</p>
                            <hr>
                            <strong>Sumber Dokumen</strong>
                            <p class="text-muted">{!! $data->sumber_dokumen !!}</p>
                            <hr>
                            <strong>Jenis Data</strong>
                            <p class="text-muted text-capitalize">{{ $data->jenis_data }}</p>
                            <hr>
                            <strong>Alias / Nama Field</strong>
                            <p class="text-muted">{{ $data->alias->alias .' ('. $data->alias->nama_field.')' }}</p>
                            <hr>
                            <strong>Penginput</strong>
                            <p class="text-muted">{{ $data->createdBy->name }}</p>
                            <p class="text-muted"><strong>Di-input</strong>
                                {{ $data->created_at->format('d-m-Y H:i:s') }}
                                <br>
                                <strong>Di-update</strong>
                                {{ $data->updated_at->format('d-m-Y H:i:s') }}</p>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
                <div class="col-md-7 ">
                    <div class="card">
                        <div class="card-header p-2">
                            <ul class="nav nav-pills">
                                <li class="nav-item"><a class="nav-link active" href="#timeline"
                                        data-toggle="tab">Timeline</a>
                                </li>
                                <li class="nav-item"><a class="nav-link" href="#fileShp" data-toggle="tab">File Shp</a>
                                </li>
                            </ul>
                        </div><!-- /.card-header -->
                        <div class="card-body">
                            <div class="tab-content">
                                <div class="active tab-pane" id="timeline">
                                    <!-- The timeline -->
                                    <div class="timeline timeline-inverse ">

                                        @foreach ($data->dataShp as $shp )

                                        <!-- timeline time label -->
                                        <div class="time-label">
                                            @if ($loop->first)
                                            <span class="bg-success">
                                                {{ $shp->created_at->format('d M. Y') }}
                                            </span>
                                            @else
                                            <span class="bg-warning">
                                                {{ $shp->created_at->format('d M. Y') }}
                                            </span>
                                            @endif
                                        </div>
                                        <!-- /.timeline-label -->
                                        <!-- timeline item -->
                                        <div>
                                            @if($shp->status == 0)
                                            <i class="fas fa-file-archive bg-primary"></i>
                                            @elseif($shp->status == 1)
                                            <i class="fas fa-file-archive bg-success"></i>
                                            @else
                                            <i class="fas fa-file-archive bg-danger"></i>
                                            @endif

                                            <div class="timeline-item">
                                                <span class="time"><i class="far fa-clock"></i>
                                                    {{$shp->created_at->format('H:i')}}</span>

                                                <h3 class="timeline-header"><span
                                                        class="text-blue text-bold">{{$shp->createdBy->name}}</span>
                                                    mengupload file</h3>

                                                <div class="timeline-body">
                                                    @if (!empty($shp->note) )
                                                    {!! $shp->note !!}
                                                    @else
                                                    Peta {{ $data->peta }}
                                                    @endif
                                                </div>

                                                <div class="timeline-footer">
                                                    @if(auth::user()->role == 'approver' && $shp->status == 0 )
                                                    <a href="{{ route('shp.show.approve',['id'=> Crypt::encryptString($shp->id)]) }}"
                                                        class="btn btn-success btn-xs">Setujui</a>
                                                    <a href="{{ route('shp.show.blocked',['id'=> Crypt::encryptString($shp->id)]) }}"
                                                        class="btn btn-danger btn-xs">Blokir</a>
                                                    <a href="{{ route('shp.download',['id'=> Crypt::encryptString($shp->id), 'nama'=>$data->peta]) }}"
                                                        class="btn btn-primary btn-xs float-right">Unduh</a>
                                                    @elseif($shp->status == 1 )
                                                    <a href="{{ route('shp.download',['id'=> Crypt::encryptString($shp->id), 'nama'=>$data->peta]) }}"
                                                        class="btn btn-primary btn-xs">Unduh</a>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <!-- END timeline item -->
                                        @endforeach
                                        <div>
                                            <i class="far fa-clock bg-gray"></i>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.tab-pane -->
                                <div class="tab-pane" id="fileShp">
                                    <table id="fileShpTable" class="table table-sm " width="100%">
                                        <thead>
                                            <tr>
                                                <th>Di-Upload</th>
                                                <th>Peng-Upload</th>
                                                <th>Size</th>
                                                <th style="text-align: center">
                                                    <button type="button" name="create_record" id="create_record"
                                                        class=" btn btn-xs btn-primary">
                                                        <i class="fa fa-plus mr-2"></i>Upload</button>
                                                </th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                                <!-- /.tab-pane -->


                            </div>
                            <!-- /.tab-content -->
                        </div><!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
    {{-- modal-add-shp --}}
    <div id="formModal" class="modal fade" role="dialog" data-backdrop="static">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form id="uploadshpForm" novalidate enctype="multipart/form-data">
                    @csrf
                    @method('POST')
                    <div class="card-body">

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
                            <textarea name="note" id="note" class="form-control" rows="5"></textarea>
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
<!-- bs-custom-file-input -->
<script src="{{ asset("adminlte/plugins/bs-custom-file-input/bs-custom-file-input.min.js") }}"></script>

<script>
    $(function () {
      bsCustomFileInput.init();
    });

    const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000
    });


    var table = $("#fileShpTable").DataTable({
        responsive: true,
        ordering: false,
        processing: true,
        serverSide: true,
        ajax: {"dataType": 'json',
            url : "{{ route('shp.show',['id'=>$id ]) }}",
            type : "GET",
        },
        columns: [

            { data: "created_at" },
            { data: "created_by"},
            { data: "data_size" },
            { data: "aksi", searchable: false ,className: "text-nowrap text-center" }
        ]
    });

     $('#create_record').click(function () {
        $('#action_button').val("{{ trans('cruds.user.fields.add') }}");
        $('#formModal').modal('show');
        $('#form-file_shp').show();
        $('.modal-title').text("Tambah Data Shp {{ $data->peta }}");
        $('#action').val("add");
        $('#id').val("{{ $id  }}");
        $('#uploadshpForm')[0].reset();
        $('.has-error').removeClass('has-error');
        $('.error').html('').removeClass('error');
    });

    $(document).on('click', '.edit', function () {
        var id = $(this).attr('id');
        $.ajax({
            url: "/shp/show/edit/" + id ,
            dataType: "json",
            type:"GET",
            beforeSend: function () {
                  $('.has-error').removeClass('has-error');
                  $('.error').html('').removeClass('error');
                  $('.modal-title').text("Edit Data Shp {{ $data->peta }}");
                  $('.bg-loading').show();
                  $('#uploadshpForm')[0].reset();
                 },
            success: function (data) {
                $('.bg-loading').hide();
                $('#form-file_shp').hide();
                $('#note').val(data.note);
                $('#id').val(id);
                $('#action_button').val("{{ trans('cruds.user.fields.edit') }}");
                $('#action').val("edit");
                $('#formModal').modal('show');
            }

        })
    });

    $('#uploadshpForm').on('submit', function (event) {
        event.preventDefault();
        var action = $('#action').val();
        if ( action == 'add') {
            $.ajax({
                url : "{{ route('shp.show.upload') }}",
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
                    if (data.success) {
                        $('#uploadshpForm')[0].reset();
                        $('#fileShpTable').DataTable().ajax.reload();
                        $('.bg-loading').hide();
                        $('#formModal').modal('hide');
                        Toast.fire({
                            icon: 'success',
                            title: 'Data berhasil disimpan'
                        });
                        setTimeout(function(){ location.reload(); }, 1000);
                    }
                }
            })
        }

        if (action == "edit") {
            $.ajax({
               url : "{{ route('shp.show.update') }}",
                type: "POST",
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData: false,
                dataType: "json",
                beforeSend: function () {
                  $('.bg-loading').show();
                 },
                success: function (data) {
                    if (data.success) {
                        $('.bg-loading').hide();
                        $('#formModal').modal('hide');
                        Toast.fire({
                            icon: 'success',
                            title: 'Data berhasil diedit'
                        });
                        setTimeout(function(){ location.reload(); }, 1000);
                    }
                }
            });
        }
    });

     $(document).on('click', '.delete', function () {
        user_id = $(this).attr('id');
        token = $(this).attr('token');
        $('#confirmModal').modal('show');
    });
    $('#ok_button').click(function () {
        $.ajax({
            url: "/shp/show/destroy/" + user_id,
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
                $('#fileShpTable').DataTable().ajax.reload();
                $('.bg-loading').hide();
                Toast.fire({
                    icon: 'success',
                    title: 'Data berhasil dihapus'
                });

                setTimeout(function(){ location.reload(); }, 1000);
                }
            }
        })
    });

</script>
@endsection
