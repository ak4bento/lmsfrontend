@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1>Edit Flashcard Subject</h1>
                </div>
            </div>
        </div>
    </section>

    <div class="content px-3">

        @include('adminlte-templates::common.errors')

        <div class="card">

            {!! Form::model($flashcardSubject, ['route' => ['flashcardSubjects.update', $flashcardSubject->id], 'method' => 'patch']) !!}

            <div class="card-body">
                <div class="row">
                    @include('flashcard_subjects.fields')
                </div>
            </div>

            <div class="card-footer">
                {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
                <a href="{{ route('flashcardSubjects.index') }}" class="btn btn-default">Cancel</a>
            </div>

           {!! Form::close() !!}

        </div>
    </div>
@endsection