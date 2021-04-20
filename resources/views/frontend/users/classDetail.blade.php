@extends('frontend.layouts.app') @section('content')
<div class="container">
    <div class="jumbotron jumbotron-fluid text-white" style="background-color: #1967d2">
        <div class="container">
            <h1 class="display-4">{{ $classrooms->title }}</h1>
            <p class="lead">
                {{ $classrooms->subject }}
            </p>
            <p class="lead">
                Ditambahkan : {{ date('d/m/Y', strtotime($classrooms->created_at)) }}
            </p>
        </div>
    </div>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-lg-12">

                <div class="row">
                    <div class="col-md-3">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">
                                    Deskripsi
                                </h3>
                            </div>
                            <div class="card-body">
                                <dl>
                                    {{ $classrooms->description }}
                                </dl>
                            </div>
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                    <div class="col-md-9">
                        <div class="card card-widget">
                            <div class="card-body">
                            </div>
                        </div>
                        @foreach ($teachables as $teachable)
                        <div class="card card-widget">
                            <div class="card-header">
                                <div class="user-block">
                                    @if ($teachable->teachable_type == 'quiz')
                                    {{ App\Models\Quizzes::find($teachable->teachable_id)->title }}
                                    @elseif ($teachable->teachable_type == 'resource')
                                    {{ App\Models\Resource::find($teachable->teachable_id)->title }}
                                    @elseif ($teachable->teachable_type == 'assignment')
                                    {{ App\Models\Assignment::find($teachable->teachable_id)->title }}
                                    @endif
                                </div>
                                <!-- /.user-block -->
                                <div class="card-tools">
                                    @php
                                    @endphp
                                    Ditambahkan :
                                    {{ date('h:ia', strtotime($teachable->updated_at)) }}
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                </div>
                                <!-- /.card-tools -->
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <!-- post text -->
                                <div class="row align-items-end">
                                    <div class="col-10">
                                        @if ($teachable->teachable_type == 'quiz')
                                        {{ App\Models\Quizzes::find($teachable->teachable_id)->description }}
                                        @elseif ($teachable->teachable_type == 'resource')
                                        {{ App\Models\Resource::find($teachable->teachable_id)->description }}
                                        @elseif ($teachable->teachable_type == 'assignment')
                                        {{ App\Models\Assignment::find($teachable->teachable_id)->description }}
                                        @endif
                                    </div>
                                    <div class="col-2">
                                        @if($classroomUsers > 0)
                                        @if ($teachable->teachable_type == 'quiz')
                                        <a href="{{ url('/class-work-detail') }}/{{ 'quizzes' }}/{{ $teachable->teachable_id }}"
                                            class="btn btn-primary btn-sm float-right"><i class="far fa-eye"></i>
                                            Lihat</a>
                                        @elseif ($teachable->teachable_type == 'resource')
                                        <a href="{{ url('/class-work-detail') }}/{{ 'resources' }}/{{ $teachable->teachable_id }}"
                                            class="btn btn-primary btn-sm float-right"><i class="far fa-eye"></i>
                                            Lihat</a>
                                        @elseif ($teachable->teachable_type == 'assignment')
                                        <a href="{{ url('/class-work-detail') }}/{{ 'assignments' }}/{{ $teachable->teachable_id }}"
                                            class="btn btn-primary btn-sm float-right"><i class="far fa-eye"></i>
                                            Lihat</a>
                                        @endif
                                        @else
                                        <a class="btn btn-primary btn-sm float-right not_allowed"><i
                                                class="far fa-eye"></i>
                                            Lihat</a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.card -->
                        @endforeach
                    </div>
                    <!-- /.col -->
                </div>
            </div>
        </div>
        <!-- /.row -->
    </section>
</div>
@endsection
@push('page_scripts')
<script>
    $(".not_allowed").click(function(e) {
        e.preventDefault(); 
        Swal.fire({
            title: 'Tidak di Izinkan',
            text: "Anda tidak terdaftar atau  tidak diizankan membuka materi ini!",
            icon: 'warning', 
            confirmButtonColor: '#174ea6',
            cancelButtonColor: '#d33',
            cancelButtonText:'Batal',
            confirmButtonText: 'Tutup'
        }) 
    });
</script>
@endpush