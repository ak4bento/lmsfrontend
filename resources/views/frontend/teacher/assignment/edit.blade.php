@extends('frontend.layouts.app')

@section('content')
    <div class="container">
        <section class="content-header">
            <div class="row mb-2">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-sm-6">
                            <h1>Perbaharui Tugas</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="{{ url('/home') }}">Home</a></li>
                                <li class="breadcrumb-item active">
                                    <a href="{{ route('classroom.detail', $classrooms->slug) }}">Kelas</a>
                                </li>
                                <li class="breadcrumb-item active">
                                    Perbaharui Tugas
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Main content -->
        <section class="content px-3">
            <div class="card card-primary card-outline">
                <form action="{{ route('updateAssignment', $assignments->id) }}" method="POST">
                    <div class="card-body">
                        <div class="form-row">
                            @include('frontend.teacher.assignment.fields')
                        </div>
                    </div>
                    <div class="card-footer">
                        <input type="submit" value="Simpan" class="btn btn-primary">
                        <a href="{{ route('classroom.detail', $classrooms->slug) }}" class="btn btn-default">Batal</a>
                    </div>
                </form>
            </div>
        </section>
    </div>
@endsection
