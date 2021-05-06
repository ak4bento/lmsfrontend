@extends('layouts.app') @section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Dashboard</h1>
            </div>
            <!-- /.col -->
            <div class="col-sm-6">
                {{--
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Dashboard v3</li>
                </ol>
                --}}
            </div>
        </div>
    </div>
</div>
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box">
                    <span class="info-box-icon bg-primary elevation-1">
                        <i class="nav-icon fas fa-graduation-cap"></i>
                    </span>

                    <div class="info-box-content">
                        <span class="info-box-text">Pengajar</span>
                        <span class="info-box-number">
                            {{ App\Models\ModelHasRole::where('role_id', 3)->count() }}
                        </span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->
            <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box mb-3">
                    <span class="info-box-icon bg-primary elevation-1">
                        <i class="fa fa-user" aria-hidden="true"></i>
                    </span>

                    <div class="info-box-content">
                        <span class="info-box-text">Pelajar</span>
                        <span class="info-box-number">                            
                            {{ App\Models\ModelHasRole::where('role_id', 4)->count() }}
                        </span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->

            <!-- fix for small devices only -->
            <div class="clearfix hidden-md-up"></div>
            <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box mb-3">
                    <span class="info-box-icon bg-primary elevation-1">
                        <i class="fa fa-university" aria-hidden="true"></i>
                    </span>

                    <div class="info-box-content">
                        <span class="info-box-text">Kelas</span>
                        <span class="info-box-number">
                            {{ App\Models\Classroom::count() }}
                        </span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->
            <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box mb-3">
                    <span class="info-box-icon bg-primary elevation-1"><i class="fas fa-users"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Pemilik Kelas</span>
                        <span class="info-box-number">
                            {{ App\Models\ModelHasRole::where('role_id', 5)->count() }}
                        </span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->
        </div>
        <div class="row">
            <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box">
                    <span class="info-box-icon bg-primary elevation-1">
                        <i class="nav-icon fas fa-calendar"></i>
                    </span>

                    <div class="info-box-content">
                        <span class="info-box-text">Tahun Ajar</span>
                        <span class="info-box-number">
                            {{ App\Models\TeachingPeriod::count() }}
                        </span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->
            <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box mb-3">
                    <span class="info-box-icon bg-primary elevation-1">
                        <i class="fa fa-book" aria-hidden="true"></i>
                    </span>

                    <div class="info-box-content">
                        <span class="info-box-text">Mata Kuliah</span>
                        <span class="info-box-number">                            
                            {{ App\Models\Subject::count() }}
                        </span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->

            <!-- fix for small devices only -->
            <div class="clearfix hidden-md-up"></div>
            <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box mb-3">
                    <span class="info-box-icon bg-primary elevation-1">
                        <i class="nav-icon fa fa-question"></i>
                    </span>

                    <div class="info-box-content">
                        <span class="info-box-text">Kuis</span>
                        <span class="info-box-number">
                            {{ App\Models\Quizzes::count() }}
                        </span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->
            <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box mb-3">
                    <span class="info-box-icon bg-primary elevation-1">
                        <i class="fa fa-question-circle" aria-hidden="true"></i>
                    </span>
                    <div class="info-box-content">
                        <span class="info-box-text">Kuis Terkumpul</span>
                        <span class="info-box-number">
                            {{ App\Models\QuizAttempt::count() }}
                        </span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->
        </div>
    </div>
</div>

@endsection
