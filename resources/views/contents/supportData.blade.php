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
                        <h1 class="card-title">Data Jenis Rencana
                            <button type="button" name="create_record" id="create_record"
                                class=" btn btn-sm btn-primary">
                                <i class="fa fa-plus mr-2"></i>{{ trans('cruds.user.fields.add') }}</button>
                        </h1>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="userTable" class="table table-bordered table-striped" width="100%">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Jenis Rencana</th>
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
