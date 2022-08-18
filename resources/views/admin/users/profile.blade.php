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
                        <li class="breadcrumb-item active">Profile</li>
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
                <!-- Manage User -->
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title"><i class="ion ion-clipboard mr-1"></i>Profile</h3>
                        <div class="card-tools">
                            <a href="{{ route('dashboard') }}" class="btn btn-primary" title="Back"><i class="fa fa-arrow-left"></i></a>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    @foreach ($users as $user)
                        <div class="card-body">
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" id="name" name="name" value="{{ $user->name }}" class="form-control" aria-describedby="name" disabled>
                            </div>
                            <div class="form-group">
                                <label for="email">Email Id</label>
                                <input type="text" id="email" name="email" value="{{ $user->email }}" class="form-control" aria-describedby="email" disabled>
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" id="password" name="password" value="{{ $user->password }}" class="form-control" aria-describedby="password" disabled>
                            </div>
                            <div class="form-group">
                                <label for="avatar">Avatar</label>
                                <div class="input-group">
                                    <span>
                                        <a href="{{ asset('storage/media/'.$user->avatar) }}" target="_blank"><img src="{{ asset('storage/media/'.$user->avatar) }}" alt="Avatar" width="150px" height="150px"></a>
                                    </span>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="role" name="role" {{ $user->role == 1 ? 'checked' : '' }}>
                                    <label class="form-check-label" for="role">Is Admin</label>
                                </div>
                            </div>
                        </div>
                        @endforeach
                        <!-- /.card-body -->
                        <div class="card-footer clearfix">
                            
                        </div>
                </div><!-- /.card -->
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- ./container-fluid -->
@endsection