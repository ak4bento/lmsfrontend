@extends('frontend.layouts.app') @section('content')
    <div class="container">
        <div class="jumbotron jumbotron-fluid text-white" style="background-color: #1967d2;border-radius: 10px ;">
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
                                    <a href="{{ route('createAssignment', $classrooms->slug) }}">
                                        assignment </a>
                                    <a href="{{ route('createResources', $classrooms->slug) }}">
                                        resources </a>

                                </div>
                            </div>
                            @foreach ($teachables as $teachable)
                                <div class="card card-widget">
                                    <div class="card-header">
                                        <div class="user-block">
                                            @if ($teachable->teachable_type == 'quiz')
                                                {{ App\Models\Quizzes::where('id', $teachable->teachable_id)->where('deleted_at', null)->first()->title }}
                                            @elseif ($teachable->teachable_type == 'resource')
                                                {{ App\Models\Resource::where('id', $teachable->teachable_id)->where('deleted_at', null)->first()->title }}
                                            @elseif ($teachable->teachable_type == 'assignment')
                                                {{ App\Models\Assignment::where('id', $teachable->teachable_id)->where('deleted_at', null)->first()->title }}
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
                                            <div class="col-lg-9 col-md-8 col-sm-6">
                                                @if ($teachable->teachable_type == 'quiz')
                                                    {!! App\Models\Quizzes::find($teachable->teachable_id)->description !!}
                                                @elseif ($teachable->teachable_type == 'resource')
                                                    {!! App\Models\Resource::find($teachable->teachable_id)->description !!}
                                                @elseif ($teachable->teachable_type == 'assignment')
                                                    {!! App\Models\Assignment::find($teachable->teachable_id)->description !!}
                                                @endif
                                            </div>
                                            <div class="col-lg-3 col-md-4 col-sm-6">
                                                @if ($classroomUsers > 0)
                                                    @if ($teachable->teachable_type == 'quiz')
                                                        <a href="{{ url('/class-work-detail') }}/{{ 'quizzes' }}/{{ $teachable->teachable_id }}"
                                                            class="btn btn-primary btn-sm float-right" data-html="true"
                                                            data-toggle="tooltip" title="<h6>Lihat Kuis</h6>"><i
                                                                class="far fa-eye"></i>
                                                        </a>
                                                    @elseif ($teachable->teachable_type == 'resource')
                                                        {{-- resource --}}
                                                        {{-- hapus --}}
                                                        <a data-url="{{ route('destroyResources', $teachable->teachable_id) }}"
                                                            class="btn btn-danger btn-sm float-right" id="delete"
                                                            data-html="true" style="margin-left: 2px" data-toggle="tooltip"
                                                            title="<h6>Hapus Materi</h6>"><i class="fa fa-trash"></i>
                                                        </a>

                                                        {{-- edit --}}
                                                        <a href="{{ route('editResources', ['slug' => $classrooms->slug, 'id' => $teachable->teachable_id]) }}"
                                                            class="btn btn-success btn-sm float-right"
                                                            style="margin-left: 2px" data-toggle="tooltip" data-html="true"
                                                            title="<h6>Edit Materi</h6>"><i class="far fa-edit"></i>
                                                        </a>

                                                        {{-- lihat --}}
                                                        <a href="{{ url('/class-work-detail') }}/{{ 'resources' }}/{{ $teachable->teachable_id }}"
                                                            class="btn btn-primary btn-sm float-right" data-html="true"
                                                            data-toggle="tooltip" title="<h6>Lihat Materi</h6>"><i
                                                                class="far fa-eye"></i>
                                                        </a>
                                                    @elseif ($teachable->teachable_type == 'assignment')
                                                        {{-- assignment --}}
                                                        {{-- hapus --}}
                                                        <a data-url="{{ route('destroyAssignment', $teachable->teachable_id) }}"
                                                            class="btn btn-danger btn-sm float-right" id="delete"
                                                            data-html="true" style="margin-left: 2px" data-toggle="tooltip"
                                                            title="<h6>Hapus Tugas</h6>"><i class="fa fa-trash"></i>
                                                        </a>

                                                        {{-- edit --}}
                                                        <a href="{{ route('editAssignment', ['slug' => $classrooms->slug, 'id' => $teachable->teachable_id]) }}"
                                                            class="btn btn-success btn-sm float-right"
                                                            style="margin-left: 2px" data-toggle="tooltip" data-html="true"
                                                            title="<h6>Edit Tugas</h6>"><i class="far fa-edit"></i>
                                                        </a>

                                                        {{-- lihat --}}
                                                        <a href="{{ url('/class-work-detail') }}/{{ 'assignments' }}/{{ $teachable->teachable_id }}"
                                                            class="btn btn-primary btn-sm float-right" data-html="true"
                                                            data-toggle="tooltip" title="<h6>Lihat Tugas</h6>"><i
                                                                class="far fa-eye"></i>
                                                        </a>
                                                        {{-- end assignment --}}
                                                    @endif
                                                @else
                                                    <a class="btn btn-primary btn-sm float-right not_allowed"
                                                        data-html="true" data-toggle="tooltip" title="<h6>Lihat</h6>"><i
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
                cancelButtonText: 'Batal',
                confirmButtonText: 'Tutup'
            })
        });
        $(document).ready(function() {
            $('[data-toggle="tooltip"]').tooltip();
        });

    </script>
@endpush
