@extends('frontend.layouts.app')
@push('page_css')
    <style>
        .title-hover{
            color:black;
            font-size: 18px; 
            font-weight: bold;
        }
        .title-hover:hover{
            cursor: pointer;
            color:#3b72ca;
            border-bottom: 1px solid #3b72ca;
        }
    </style>
@endpush
@section('content')
    <div class="container">
        <div class="jumbotron jumbotron-fluid text-white p-5" style="background-color: #1b5cb8;border-radius: 10px ;">
            <div class="container ">
                <div class="row">
                    <a style="font-size: 2.5em">Kelas</a>
                </div>
                <div class="row">
                    <a style="font-size: 1.5em">Temukan kelas yang anda ikuti.</a>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-3 col-md-12 col-sm-12">
                <!-- About Me Box -->
                <div class="fixme">
                    @hasanyrole('owner')
                    <div class="card">
                        <div class="dropdown ">
                            <a class="btn btn-primary btn-block py-2" href="{{ route('createClassroom') }}">
                                <i class="fa fa-plus primary"></i> &nbsp;Buat Kelas
                            </a>
                        </div>
                    </div>
                    @endhasanyrole
                    <div class="card">
                        <form action="?" method="get">
                            <div class="card-body">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text sm"><i class="fas fa-search"></i></span>
                                    </div>
                                    <input type="text" class="form-control form-control-sm" id="search" name="search"
                                        placeholder="Cari Kelas" />
                                </div>
                                <ul class="list-group list-group-unbordered mb-3">
                                    @foreach ($subjects as $subject)
                                        <div class="form-group clearfix">
                                            <div class="icheck-primary d-inline">
                                                <input type="checkbox" name="{{ $subject->id }}"
                                                    id="checkboxPrimary{{ $subject->id }}">
                                                <label for="checkboxPrimary{{ $subject->id }}" style="font-size:13px">
                                                    {{ $subject->title }}
                                                </label>
                                            </div>
                                        </div>
                                    @endforeach
                                </ul>
                            </div>
                            <!-- /.card-body -->
                        </form>
                    </div>
                </div>
                <!-- /.card -->
            </div>
            <div class="col-lg-9 col-md-12 col-sm-12">
                <div class="row">
                    @forelse ($classrooms as $item)
                    <div class="col-lg-6 col-sm-12 col-md-12">
                        <div class="card card-primary card-outline" style="min-height: 230px" >
                            <div class="card-header text-muted border-bottom-0">
                                <div class="row">
                                    {{ $item->subject }}
                                </div>
                            </div>
                            <div class="card-body pt-0">
                                <div class="row">
                                    <div class="col-9">
                                        <div class="row">
                                            <a  href="{{route('classroom.detail',$item->slug)}}"
                                                target="_blank"
                                                class="title-hover">
                                                {{ $item->title }}
                                            </a>
                                        </div>
                                        <div class="row align-items-center">
                                            {{ substr($item->description, 0, 120) }}
                                        </div>
                                    </div>
                                    <div class="col-3 text-center">
                                        @if(is_null(App\Models\Media::where('media_type', 'user')->where('media_id', $item->created_by)->latest('created_at')->first()))
                                        <img src="{{ asset('files/') }}/{{App\Models\Media::where('media_type', 'user')->where('media_id', $item->created_by)->latest('created_at') ->first()->file_name ?? 'avatar.png'}}"
                                            class="img-circle img-fluid" />
                                        @else
                                            <img src="{{ asset('avatar.png') }}"
                                                class="img-circle img-fluid" />
                                        @endif
                                        {{ App\Models\User::find($item->created_by)->name }}
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer" style="border-radius: 10px; background-color: #ffff">
                                <div class="row">
                                    <div class="col-4">
                                        <div class="text-left">
                                            <a style="font-size: 13px">
                                                {{ App\Models\TeachingPeriod::find($item->teaching_period_id)->first()->name }}
                                            </a>
                                        </div>
                                    </div>
                                    <div class="col-8">
                                        <a href="{{ url('class-detail/') }}/{{ $item->slug }}"
                                            class="btn btn-sm btn-primary float-right" >
                                            Lihat Kelas
                                        </a>
                                        <a class="btn btn-sm bg-teal float-right" style="margin-right: 3px">
                                            <strong>
                                                {{ App\Models\ClassroomUser::where('classroom_id', $item->id)->count() }}
                                            </strong>&nbsp;Bergabung
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @empty
                        <div class="col-12 col-sm-6 col-md-6 d-flex align-items-stretch">
                            <div class="card card-primary card-outline" style="background-color: #ffff">
                                <div class="card-header text-muted border-bottom-0">
                                    Anda Belum mengikuti kelas.
                                </div>
                                <div class="card-body pt-0">
                                    <div class="row">
                                        Silahkan join di kelas yang ada melalui menu Discover atau klik link berikut
                                        ini. <a href="/discover">pergi ke DISCOVER</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
@endsection 