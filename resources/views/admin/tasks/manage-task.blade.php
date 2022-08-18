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
                        <li class="breadcrumb-item active">Tasks</li>
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
                <!-- Manage Task -->
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title"><i class="ion ion-clipboard mr-1"></i>Manage Task</h3>
                        <div class="card-tools">
                            <a href="{{ route('tasks') }}" class="btn btn-primary" title="Back"><i class="fa fa-arrow-left"></i></a>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <form id="loginForm" action="{{ route('task.process') }}" method="POST" enctype="multipart/form-data" autocomplete="off">
                    @csrf
                        <div class="card-body">
                            <input type="hidden" id="created_by" name="created_by" value="{{ auth()->user()->id }}" class="form-control @error('created_by') is-invalid @enderror" aria-describedby="created_by">
                            <div class="form-group">
                                <label for="task_title">Task Title</label>
                                <input type="text" id="task_title" name="task_title" value="{{ $task_title }}" class="form-control @error('task_title') is-invalid @enderror" aria-describedby="task_title" placeholder="Enter task title">
                                @error('task_title')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="form-group">
                                <label for="task_description">Task Description</label>
                                <textarea row="3" id="task_description" name="task_description" class="form-control @error('task_description') is-invalid @enderror" aria-describedby="task_description" placeholder="Enter task description">{{ $task_description }}</textarea>
                                @error('task_description')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="form-group">
                                <label>Project</label>
                                <select class="form-control select2" id="project_id" name="project_id">
                                    <option value="">Select Project</option>
                                    @foreach($project as $proList)
                                        @if($project_id == $proList->id)
                                        <option value="{{ $proList->id }}" selected>{{ $proList->project_name }}</option>
                                        @else
                                        <option value="{{ $proList->id }}">{{ $proList->project_name }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                            <?php
                                $enumPriority = [
                                    'Low',
                                    'Medium',
                                    'High'
                                ];
                            ?>
                            <div class="form-group">
                                <label>Priority</label>
                                <select class="form-control select2" id="priority" name="priority">
                                    <option value="">Select Priority</option>
                                    @foreach($enumPriority as $priority1)
                                        @if($priority == $priority1)
                                        <option value="{{ $priority1 }}" selected>{{ $priority1 }}</option>
                                        @else
                                        <option value="{{ $priority1 }}">{{ $priority1 }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                            <?php
                                $enumStatus = [
                                    'Open',
                                    'Inprogress',
                                    'Completed'
                                ];
                            ?>
                            <div class="form-group">
                                <label>Status</label>
                                <select class="form-control select2 status" id="status" name="status">
                                    @foreach($enumStatus as $status1)
                                        @if($status == $status1)
                                        <option value="{{ $status1 }}" selected>{{ $status1 }}</option>
                                        @else
                                        <option value="{{ $status1 }}">{{ $status1 }}</option>
                                        @endif
                                    @endforeach
                                </select>
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