@extends('frontend.layouts.app')

@section('content')
    <div class="container">
        @include('adminlte-templates::common.errors')
        <div class="row">

            <div class="col-sm-3 col-md-3 col-lg-3">

                <!-- Profile Image -->
                <div class="card card-primary card-outline">
                    <div class="card-body box-profile">
                        <div class="text-center">
                            <img class="profile-user-img img-fluid img-circle"
                                src="{{ asset('dist/img/user4-128x128.jpg') }}" alt="User profile picture">
                        </div>

                        <h3 class="profile-username text-center">{{ Auth::user()->name }}</h3>

                        <p class="text-muted text-center">
                            @foreach (Auth::user()->getRoleNames() as $roles)
                                {{ $roles }}
                            @endforeach
                        </p>
                        <a type="button" class="btn btn-primary btn-block" data-toggle="modal"
                            data-target="#exampleModalCenter">

                            &nbsp;Lengkapi Biodata
                        </a>
                    </div>

                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
                @include('frontend.users.profileForm')
                <!-- About Me Box -->
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Profil Saya</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="card">
                            <div class="card-body">
                                <strong><i class="fas fa-user mr-1"></i> Nama lengkap :
                                    {{ $profile->full_name ?? '' }}</strong>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <strong><i class="fas fa-map-marker-alt mr-1"></i> Alamat :
                                    {{ $profile->address ?? '' }}</strong>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <strong><i class="fas fa-mobile mr-1"></i> Telepon :
                                    {{ $profile->phone_number ?? '' }}</strong>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->

                <!-- About Me Box -->
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Kelas Saya</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        @forelse (DB::table('classroom_user')->where('user_id', Auth::user()->id)->where('deleted_at', null)->get() as $class)
                            <div class="card">
                                <div class="card-body">
                                    <i class="far fa-circle"></i>
                                    <strong>
                                        <a
                                            href="{{ route('classroom.detail', App\Models\Classroom::find($class->classroom_id)->slug) }}">{{ App\Models\Classroom::find($class->classroom_id)->title }}</a>
                                    </strong>
                                </div>
                            </div>
                        @empty
                            Data kelas anda kosong
                        @endforelse
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
            <div class="col-lg-9 col-md-9 col-sm-12">
                <!-- Default box -->
                <div class="card card-outline card-primary">
                    <div class="card-header">
                        Bagaimana proses belajar anda?
                    </div>
                    <div class="card-body">
                        @forelse (DB::table('classroom_user')->where('user_id', Auth::user()->id)->where('deleted_at', null)->get() as $class)

                            <div class="card">
                                <div class="card-header">
                                    <strong>
                                        <a
                                            href="{{ route('classroom.detail', App\Models\Classroom::find($class->classroom_id)->slug) }}">
                                            {{ App\Models\Classroom::find($class->classroom_id)->title }}
                                        </a>
                                    </strong>
                                </div>
                                <div class="card-body">

                                    <div class="progress">
                                        <div class="progress-bar progress-bar-striped" role="progressbar" style="width: 30%"
                                            aria-valuenow="10" aria-valuemin="0" aria-valuemax="100">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            Data kelas anda kosong
                        @endforelse
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
@endsection
