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
                        <li class="breadcrumb-item active">Users</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
@endsection

@section('content')
    @php
        if($id > 0){
            $avatar_required = "";
        }
        else {
            $avatar_required = "required";
        }
    @endphp
    <div class="container-fluid">
        <!-- Main row -->
        <div class="row">
            <div class="col-lg-12">
                <!-- Manage User -->
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title"><i class="ion ion-clipboard mr-1"></i>Manage User</h3>
                        <div class="card-tools">
                            <a href="{{ route('users') }}" class="btn btn-primary" title="Back"><i class="fa fa-arrow-left"></i></a>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <form id="loginForm" action="{{ route('user.process') }}" method="POST" enctype="multipart/form-data" autocomplete="off">
                    @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" id="name" name="name" value="{{ $name }}" class="form-control @error('name') is-invalid @enderror" aria-describedby="name" placeholder="Enter full name" {{ $id ? 'disabled' : '' }}>
                                @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="form-group">
                                <label for="email">Email Id</label>
                                <input type="text" id="email" name="email" value="{{ $email }}" class="form-control @error('email') is-invalid @enderror" aria-describedby="email" placeholder="Enter email" {{ $id ? 'disabled' : '' }}>
                                @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" id="password" name="password" class="form-control @error('password') is-invalid @enderror" aria-describedby="password" placeholder="Password">
                                @error('password') <div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="form-group">
                                <label for="password_confirmation">Confirm Password</label>
                                <input type="password" id="password_confirmation" name="password_confirmation" value="" class="form-control" placeholder="Confirm Password">
                            </div>
                            <div class="form-group">
                                <label for="avatar">Avatar</label>
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input type="file" id="avatar" name="avatar" value="{{ $avatar }}" class="custom-file-input @error('avatar') is-invalid @enderror" {{ $avatar_required }}>
                                        <label class="custom-file-label" for="avatar">Choose Image</label>
                                    </div>
                                    <div class="input-group-append">
                                    <span>
                                        @if($avatar != '')
                                        <a href="{{ asset('storage/media/'.$avatar) }}" target="_blank"><img src="{{ asset('storage/media/'.$avatar) }}" alt="Avatar" width="40px"></a>
                                        @endif
                                    </span>
                                    </div>
                                    @error('avatar') <div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="role" name="role" {{ $role_selected }}>
                                    <label class="form-check-label" for="role">Is Admin</label>
                                </div>
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

@section('scripts')
    <!-- jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
	<script src="{{ asset('admin/plugins/jquery/jquery.min.js') }}"></script>
    <!-- bs-custom-file-input -->
    <script src="{{ asset('admin/plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>
    <script type="text/javascript">
		$(document).ready(function() {
            bsCustomFileInput.init();
        });
    </script>
@endsection