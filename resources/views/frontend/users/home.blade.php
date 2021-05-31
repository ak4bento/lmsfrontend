@extends('frontend.layouts.app')

@push('page_css')
    <style>
        .size-img{
            height: 150px;
        }
        .hover-img:hover {
            /* background-color: ; */
            border: 2px solid #87befc;
            cursor: pointer;
            box-shadow: 0 10px 20px rgba(0, 0, 0, .12), 0 4px 8px rgba(0, 0, 0, .06);
        }

        .fixme{
            margin-bottom: 17px;
        }
    </style>
    <link rel="stylesheet" type="text/css" href="{{ asset('js/slick/slick.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('js/slick/slick-theme.css') }}">

    <style>
        .ion-medium {
            font-size: 16px;
        }

        .bookmark-active{
            color:#1b5cb8;
            font-size:22px;
        }

        .bookmark-default{
            color:rgb(190, 190, 190);
            font-size:22px;
        }
        .bookmark-clik:hover{
            transform: scale(1.20);
            cursor: pointer;
            color:#3b72ca;
        }

    </style>
@endpush
@section('content')
    <div class="container">
        <div class="jumbotron jumbotron-fluid text-white p-5" style="background: linear-gradient(#206dda, #1b5cb8);border-radius:10px">
            <div class="container ">
                <div class="row">
                    <a style="font-size: 2.5em">Dashboard</a>
                </div>
                <div class="row">
                    <a style="font-size: 1.5em">Selamat datang, {{ Auth::user()->name }} di SIPS LMS.</a>
                </div>
            </div>
        </div>
        @include('adminlte-templates::common.errors')
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="card card-primary">
                    <div class="card-body">
                        <div class="input-group input-group-md">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-search"></i></span>
                            </div>
                            <input type="text" class="form-control">
                            <span class="input-group-append">
                                <button type="button" class="btn btn-info btn-flat" style="background-color: #4E9FFF">Cari!</button>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-4 col-md-4 col-sm-4">
                <div class="card card-primary card-outline ">
                    <div class="card-body box-profile">
                        <div class="text-center">
                            <img class="img-fluid img-circle hover-img size-img"
                                data-toggle="modal"
                                data-togglebtn="tooltip" data-placement="top" title="Ubah Foto Profil"
                                data-target="#exampleModalCenter2"
                                style="width: 170px; height: 170px; object-fit: cover;"
                                src="{{ asset('files') }}/{{App\Models\Media::where('media_type', 'user')->where('media_id', Auth::user()->id)->latest('created_at')->first()->file_name ?? 'avatar.png'}}" alt="User profile picture">
                        </div>

                        <h3 class="profile-username text-center">{{ Auth::user()->name }}</h3>

                        <p class="text-muted text-center"  style="text-transform: uppercase;">
                            @foreach (Auth::user()->getRoleNames() as $roles)
                                {{ $roles }}
                            @endforeach
                        </p>
                        <a type="button" class="btn btn-primary btn-block" data-toggle="modal"
                            data-togglebtn="tooltip" data-placement="top" title="Lengkapi atau ubah biodata"
                            data-target="#exampleModalCenter">
                            &nbsp;Lengkapi Biodata
                        </a>
                    </div>

                    <!-- /.card-body -->
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4">
                <!-- About Me Box -->
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Profil Saya</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="card">
                            <div class="card-body">
                                <strong style="font-size:13px">
                                    <i class="fas fa-user mr-1"></i>
                                    Nama :
                                    {{ $profile->full_name ?? '' }}
                                </strong>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <strong style="font-size:13px"><i class="fas fa-map-marker-alt mr-1"></i> Alamat :
                                    {{ $profile->address ?? '' }}</strong>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <strong style="font-size:13px"><i class="fas fa-mobile mr-1"></i> Telepon :
                                    {{ $profile->phone_number ?? '' }}</strong>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4">
                <div class="card card-outline card-primary">
                    <!-- /.col -->
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        @forelse ($teachables as $teachable)
                        {{-- <div class="card" id="card"> --}}
                            <div class="card-body">
                                <div class="row align-items-center">
                                    {{-- <div class="col col-lg-1 col-md-1 col-sm-1">
                                        <img src="{{ asset('study.png') }}" style="max-width: 50px"
                                            class="img-fluid">
                                    </div> --}}
                                    <div class="col-10 col-lg-10 col-md-10 col-sm-10">
                                        <div class="row">
                                            @if ($teachable->teachable_type == 'quiz')
                                                <a data-toggle="tooltip" data-placement="top" title="Lihat Kuis"
                                                    style="font-weight: bold;"
                                                    href="{{ route('class.work.detail', ['quizzes', $teachable->teachable_id]) }}">

                                                    @if (App\Models\Progress::where('progress_type', 'quizzes')->where('progress_id', $teachable->teachable_id)->where('class_id', $teachable->classroom_id)->where('user_id', Auth::user()->id)->count() > 0)
                                                    <i class="fas fa-check-circle text-success"></i>
                                                    @endif

                                                    {{  App\Models\Classroom::find($teachable->classroom_id)->first()->title }} : {{ App\Models\Quizzes::where('id', $teachable->teachable_id)->where('deleted_at', null)->first()->title }}
                                                </a>
                                            @elseif ($teachable->teachable_type == 'resource')
                                                <a data-toggle="tooltip" data-placement="top" title="Lihat Materi"
                                                    style="font-weight: bold;"
                                                    href="{{ route('class.work.detail', ['resources', $teachable->teachable_id]) }}">

                                                    @if (App\Models\Progress::where('progress_type', 'resources')->where('progress_id', $teachable->teachable_id)->where('class_id', $teachable->classroom_id)->where('user_id', Auth::user()->id)->count() > 0)
                                                    <i class="fas fa-check-circle text-success"></i>
                                                    @endif

                                                    {{  App\Models\Classroom::find($teachable->classroom_id)->first()->title }} : {{ App\Models\Resource::where('id', $teachable->teachable_id)->where('deleted_at', null)->first()->title }}
                                                </a>
                                            @elseif ($teachable->teachable_type == 'assignments')
                                                <a data-toggle="tooltip" data-placement="top" title="Lihat Tugas"
                                                    style="font-weight: bold;"
                                                    href="{{ route('class.work.detail', ['assignments', $teachable->teachable_id]) }}">

                                                    @if (App\Models\Progress::where('progress_type', 'assignments')->where('progress_id', $teachable->teachable_id)->where('class_id', $teachable->classroom_id)->where('user_id', Auth::user()->id)->count() > 0)
                                                    <i class="fas fa-check-circle text-success"></i>
                                                    @endif

                                                    {{  App\Models\Classroom::find($teachable->classroom_id)->first()->title }} : {{ App\Models\Assignment::where('id', $teachable->teachable_id)->where('deleted_at', null)->first()->title }}
                                                </a>
                                            @endif
                                        </div>
                                        <div class="row">
                                            <span style="color: grey;font-size:10px">
                                                Diposting
                                                {{App\Models\User::find($teachable->created_by)->name}}
                                                -
                                                {{ date('d-m-Y H:iA', strtotime($teachable->updated_at)) }}
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-2 col-lg-2 col-md-2 col-sm-2">
                                        @if(is_null(App\Models\Bookmark::where('teachable_id',$teachable->id)->first() ))
                                            <i
                                                data-teachable_id="{{$teachable->id}}"
                                                data-toggle="tooltip"
                                                data-placement="left"
                                                class="onClick fa fa-bookmark float-right bookmark-clik bookmark-default add"
                                                aria-hidden="true">
                                            </i>
                                        @else
                                            <i
                                                data-teachable_id="{{$teachable->id}}"
                                                data-toggle="tooltip"
                                                data-placement="left"
                                                class="onClick fa fa-bookmark float-right bookmark-clik bookmark-active remove"
                                                aria-hidden="true">
                                            </i>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <hr>
                        {{-- </div> --}}
                        @empty
                        {{-- <div class="card" id="card"> --}}
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        Belum ada meteri yang di markah
                                    </div>
                                </div>
                            </div>
                        {{-- </div> --}}
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <!-- /.col -->
            <div class="col-lg-12 col-md-12 col-sm-12">
                <!-- Default box -->
                @hasanyrole('student')
                @include('frontend.users.student_home')
                @endhasanyrole
                @hasanyrole('teacher|owner')
                @include('frontend.users.teacher_home')
                @endhasanyrole
                <!-- /.card -->
            </div>
            <!-- /.col -->
            {{-- <div class="col-sm-12 col-md-12 col-lg-12">
                <div class="fixme">
                    <div class="card card-primary card-outline ">
                        <div class="card-body box-profile">
                            <div class="text-center">
                                <img class="img-fluid img-circle hover-img size-img"
                                    data-toggle="modal"
                                    data-togglebtn="tooltip" data-placement="top" title="Ubah Foto Profil"
                                    data-target="#exampleModalCenter2"
                                    style="width: 200px; height: 200px; object-fit: cover;"
                                    src="{{ asset('files') }}/{{App\Models\Media::where('media_type', 'user')->where('media_id', Auth::user()->id)->latest('created_at')->first()->file_name ?? 'avatar.png'}}" alt="User profile picture">
                            </div>

                            <h3 class="profile-username text-center">{{ Auth::user()->name }}</h3>

                            <p class="text-muted text-center"  style="text-transform: uppercase;">
                                @foreach (Auth::user()->getRoleNames() as $roles)
                                    {{ $roles }}
                                @endforeach
                            </p>
                            <a type="button" class="btn btn-primary btn-block" data-toggle="modal"
                                data-togglebtn="tooltip" data-placement="top" title="Lengkapi atau ubah biodata"
                                data-target="#exampleModalCenter">
                                &nbsp;Lengkapi Biodata
                            </a>
                        </div>

                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->

                    <!-- About Me Box -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Profil Saya</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="card">
                                <div class="card-body">
                                    <strong style="font-size:13px">
                                        <i class="fas fa-user mr-1"></i>
                                        Nama :
                                        {{ $profile->full_name ?? '' }}
                                    </strong>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-body">
                                    <strong style="font-size:13px"><i class="fas fa-map-marker-alt mr-1"></i> Alamat :
                                        {{ $profile->address ?? '' }}</strong>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-body">
                                    <strong style="font-size:13px"><i class="fas fa-mobile mr-1"></i> Telepon :
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
                                        <i class="far fa-circle" style="font-size:13px"></i>
                                        <strong>
                                            <a style="font-size:13px"
                                                data-togglebtn="tooltip" data-placement="top" title="Lihat Kelas"
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
            </div> --}}
        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
@endsection
@push('page_scripts')
<script src="https://code.jquery.com/jquery-2.2.0.min.js" type="text/javascript"></script>
<script src="{{ asset('/js/slick/slick.js') }}" type="text/javascript" charset="utf-8"></script>
<script type="text/javascript">
    $(document).on('ready', function() {
      $(".regular").slick({
        dots: true,
        infinite: true,
        slidesToShow: 3,
        slidesToScroll: 3,
        prevArrow: '<button type="button" data-role="none" class="slick-prev" aria-label="Previous" tabindex="0" role="button">Previous</button>',
        nextArrow: '<button type="button" data-role="none" class="slick-next" aria-label="Next" tabindex="0" role="button">Next</button>',
      });
      $(".lazy").slick({
        lazyLoad: 'ondemand', // ondemand progressive anticipated
        infinite: true
      });
    });
</script>
@endpush
