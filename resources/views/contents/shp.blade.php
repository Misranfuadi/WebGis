@extends('layouts.admin')

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
                        <table id="userTable" class="table table-bordered table-striped" width="100%">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Peta</th>
                                    <th>Keluaran</th>
                                    <th class="text-nowrap">Jenis Rencana</th>
                                    <th class="text-nowrap">Sumber Dokumen</th>
                                    <th>Jenis Data</th>
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
</div>
@endsection
