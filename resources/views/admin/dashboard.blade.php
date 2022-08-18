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
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
@endsection

@section('content')
    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3>{{ $projectCount }}</h3>
                            <p>Projects</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-bag"></i>
                        </div>
                        <a href="{{ route('projects') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3>{{ $completedTaskCount }}</h3>
                            <p>Completed Tasks</p>
                        </div>
                    <div class="icon">
                        <i class="ion ion-stats-bars"></i>
                    </div>
                    <a href="{{ route('tasks') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-warning">
                    <div class="inner">
                        <h3>{{ $inprogressTaskCount }}</h3>
                        <p>Inprogress Tasks</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-person-add"></i>
                    </div>
                    <a href="{{ route('tasks') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-danger">
                    <div class="inner">
                        <h3>{{ $openTaskCount }}</h3>
                        <p>Open Tasks</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-pie-graph"></i>
                    </div>
                    <a href="{{ route('tasks') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
            </div>
            <div class="row">
                @php
                    if($allTaskCount != 0) {
                        $openPer = ($openTaskCount / $allTaskCount) * 100;
                        $inprogressPer = ($inprogressTaskCount / $allTaskCount) * 100;
                        $completedPer = ($completedTaskCount / $allTaskCount) * 100;
                    } else {
                        $openPer = 0;
                        $inprogressPer = 0;
                        $completedPer = 0;
                    }
                @endphp
                <!-- /.col -->
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title text-center"><strong>Task Completion</strong></h3>
                        </div>
                        <div class="card-body">
                            <div class="progress-group">
                                <span class="progress-text">Open Tasks</span>
                                <span class="float-right"><b>{{ $openTaskCount }}</b>/{{ $allTaskCount }}</span>
                                <div class="progress progress-sm">
                                    <div class="progress-bar bg-danger" style="width: {{ $openPer }}%"></div>
                                </div>
                            </div>
                            <!-- /.progress-group -->
                            <div class="progress-group">
                                <span class="progress-text">Inprogress Tasks</span>
                                <span class="float-right"><b>{{ $inprogressTaskCount }}</b>/{{ $allTaskCount }}</span>
                                <div class="progress progress-sm">
                                    <div class="progress-bar bg-warning" style="width: {{ $inprogressPer }}%"></div>
                                </div>
                            </div>
                            <!-- /.progress-group -->
                            <div class="progress-group">
                                <span class="progress-text">Completed Tasks</span>
                                <span class="float-right"><b>{{ $completedTaskCount }}</b>/{{ $allTaskCount }}</span>
                                <div class="progress progress-sm">
                                    <div class="progress-bar bg-success" style="width: {{ $completedPer }}%" tooltip="{{ $completedPer }}"></div>
                                </div>
                            </div>
                            <!-- /.progress-group -->
                        </div>
                    </div>
                </div> <!-- /.col -->
            </div>
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
@endsection
</div>