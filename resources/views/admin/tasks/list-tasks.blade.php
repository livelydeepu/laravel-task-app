@extends('layouts.app')

@section('styles')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('admin/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('admin/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('admin/plugins/jquery-ui/jquery-ui.theme.min.css') }}" />
    <!-- Toastr -->
    <link rel="stylesheet" href="{{ asset('admin/plugins/toastr/toastr.min.css') }}" />
@endsection

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
    <div class="container-fluid">
        <!-- Main row -->
        <div class="row">
            <div class="col-lg-12">
                <!-- Task List -->
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title"><i class="ion ion-clipboard mr-1"></i>Task List</h3>
                        <div class="card-tools">
                            <a href="{{ route('task.manage','') }}" class="btn btn-primary mr-4"><i class="fa fa-plus-circle"></i> Add New Task</a>
                            <div class="btn-group">
                                <button type="button" id="allTask" class="btn btn-secondary">
                                    <span class="mr-1">All</span>
                                    <span class="badge badge-pill badge-info">{{ $allTaskCount }}</span>
                                </button>
                                <button type="button" id="openTask" class="btn btn-danger">
                                    <span class="mr-1">Open</span>
                                    <span class="badge badge-pill badge-info">{{ $openTaskCount }}</span>
                                </button>
                                <button type="button" id="inprogressTask"class="btn btn-warning">
                                    <span class="mr-1">Inprogress</span>
                                    <span class="badge badge-pill badge-info">{{ $inprogressTaskCount }}</span>
                                </button>
                                <button type="button" id="completedTask"class="btn btn-success">
                                    <span class="mr-1">Completed</span>
                                    <span class="badge badge-pill badge-info">{{ $completedTaskCount }}</span>
                                </button>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-12 col-md-6 mb-2">
                                <div class="project-filter dataTables_filter">
                                    <label>Select Project
                                        <select id="projectFilter" class="custom-select form-control form-control-sm">
                                            <option value="">Show All</option>
                                            @foreach($project as $proList)
                                                <option value="{{ $proList->project_name }}">{{ $proList->project_name }}</option>
                                            @endforeach
                                        </select>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <table id="taskTable" class="table table-hover table-bordered taskTable">
                            <thead style="cursor: ">
                                <tr>
                                    <th scope="row">#</th>
                                    <th scope="col">Task Title</th>
                                    <th scope="col">Task Description</th>
                                    <th scope="col">Project</th>
                                    <th scope="col">Priority</th>
                                    <th scope="col">Created At</th>
                                    <th scope="col">Created By</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody style="cursor: all-scroll;">
                                @php
                                    $no = 1;
                                @endphp
                                @forelse ($tasks as $task)
                                <tr data-id="{{ $task->id }}">
                                    <td scope="row">{{ $no++ }}</td>
                                    <td scope="col">{{ $task->task_title }}</td>
                                    <td scope="col">{{ $task->task_description }}</td>
                                    <td scope="col">{{ $task->project->project_name }}</td>
                                    <td scope="col">{{ $task->priority }}</td>
                                    <td scope="col">{{ $task->created_at }}</td>
                                    <td scope="col">{{ $task->user->name }}</td>
                                    <td scope="col">
                                        @if($task->status == 'Completed') 
                                        <span class="badge bg-success">{{ $task->status }}</span>
                                        @elseif($task->status == 'Inprogress')
                                        <span class="badge bg-yellow">{{ $task->status }}</span>
                                        @else
                                        <span class="badge bg-danger">{{ $task->status }}</span>
                                        @endif
                                    </td>
                                    <td scope="col">
                                    <div class="btn-group btn-group-sm">
                                        <form method="POST" action="{{ route('task.manage', $task->id) }}">
                                        @csrf
                                        @method('GET')
                                            <button class="btn btn-primary" title="Edit" data-id="{{ $task->id }}"><i class="fa fa-edit"></i></button>
                                        </form>
                                        <form method="POST" action="{{ route('task.destroy', $task->id) }}">
                                        @csrf
                                        @method('DELETE')
                                            <button class="btn btn-danger show_confirm" title="Delete" data-id="{{ $task->id }}"><i class="fa fa-trash"></i></button>
                                        </form>
                                    </div>
                                    </td>
                                </tr>
                                @empty
                                <tr class="text-center">
                                    <td colspan="9"><p class="mt-2">No results found</p></td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer clearfix">
                        
                    </div>
                </div><!-- /.card -->
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- ./container-fluid -->
@endsection

@section('scripts')
    <!-- jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
	<script src="{{ asset('admin/plugins/jquery/jquery.min.js') }}"></script>
    <!-- DataTables  & Plugins -->
    <script src="{{ asset('admin/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('admin/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('admin/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('admin/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('admin/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('admin/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="{{ asset('admin/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
	<!-- Toastr -->
    <script src="{{asset('admin/plugins/toastr/toastr.min.js')}}"></script>
	<script type="text/javascript">
		$(document).ready(function() {
            toastr.options.timeOut = 900;
            @if (Session::has('error'))
                toastr.error('{{ Session::get('error') }}');
            @elseif(Session::has('success'))
                toastr.success('{{ Session::get('success') }}');
            @endif

            $('.show_confirm').click(function(e) {
                if(!confirm('Are you sure you want to delete this record?')) {
                    e.preventDefault();
                } 
            });

            $("#taskTable").dataTable({
                "searching": true,
                "ordering": true,
                "responsive": true,
            });

            var table = $('#taskTable').DataTable();

            $("#taskTable_filter.dataTables_filter").append($("#project-filter"));

            var projectIndex = 0;
            $("#taskTable th").each(function (i) {
                if ($($(this)).html() == "Project") {
                    projectIndex = i; 
                    return false;
                }
            });

            //Use the built in datatables API to filter the existing rows by the Project column
            $.fn.dataTable.ext.search.push(
                function (settings, data, dataIndex) {
                var selectedItem = $('#projectFilter').val()
                var project = data[projectIndex];
                if (selectedItem === "" || project.includes(selectedItem)) {
                    return true;
                }
                    return false;
                }
            );

            $("#taskTable tbody").sortable({
                placeholder: "ui-state-highlight",
                
                update: function(event, ui) {
                    var priority = [];
                    $('tbody tr').each(function() {
                        priority.push({
                            id: $(this).attr('data-id'),
                            position: index + 1,
                        });
                    });

                    $.ajax({
                        url: '{{ route("task.updatePriority") }}',
                        method: "POST",
                        data: {
                            priority: priority,
                        },
                        success: function(response) {
                            if (response.status == "success") {
                                console.log(response);
                            } else {
                                console.log(response);
                            }
                        }
                    });
                }
            });

            $("#projectFilter").change(function (e) {
                table.draw();
            });

            $("#allTask").click(function () {
                table.columns(7).search("", true, false, true).draw();
            });

            $("#openTask").click(function () {
                table.columns(7).search("Open", true, false, true).draw();
            });

            $("#inprogressTask").click(function () {
                table.columns(7).search("Inprogress", true, false, true).draw();
            });

            $("#completedTask").click(function () {
                table.columns(7).search("Completed", true, false, true).draw();
            });

            table.draw();
        });
    </script>
@endsection