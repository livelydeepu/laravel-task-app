@extends('layouts.app')

@section('content-header')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">{{ $page_title }}</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Projects</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
@endsection

@section('content')
    <div class="container-fluid">
        <!-- Main row -->
        <div class="row">
            <div class="col-lg-12">
                <!-- Manage Project -->
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title"><i class="ion ion-clipboard mr-1"></i>Manage Project</h3>
                        <div class="card-tools">
                            <a href="{{ route('projects') }}" class="btn btn-primary" title="Back"><i class="fa fa-arrow-left"></i></a>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <form id="loginForm" action="{{ route('project.process') }}" method="POST" enctype="multipart/form-data" autocomplete="off">
                    @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label for="name">Project Name</label>
                                <input type="text" id="project_name" name="project_name" value="{{ $project_name }}" class="form-control @error('project_name') is-invalid @enderror" aria-describedby="project_name" placeholder="Enter project name">
                                @error('project_name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer clearfix">
                            <button type="submit" class="btn btn-primary"><i class="fa fa-save mr-1"></i> Save</button>
                            <input type="hidden" class="form-control" id="id" name="id" value="{{ $id }}">
                        </div>
                    </form>
                </div><!-- /.card -->
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- ./container-fluid -->
@endsection