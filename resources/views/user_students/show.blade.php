@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Daftar Kelas {{ $userStudent->name }}</h1>
                </div>
                <div class="col-sm-6">
                    <a class="btn btn-primary float-right" style="margin-left:10px;"
                        href="{{ url('classroomUsers/create', [$userStudent->id]) }}">
                        Tambah Kelas
                    </a>
                    <a class="btn btn-default float-right " href="{{ route('userStudents.index') }}">
                        Kembali
                    </a>
                </div>
            </div>
        </div>
    </section>

    <div class="content px-3">
        <div class="card card-primary card-outline">

            <div class="card-body">
                <div class="row">
                    @include('user_students.show_fields')
                </div>
            </div>

        </div>
    </div>
@endsection
