@extends('frontend.layouts.app') @section('content')
<div class="container">
    <section class="content-header">
        <div class="row mb-2">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-sm-6">
                        <h1>Kuis</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ url('/home') }}">Home</a></li>
                            <li class="breadcrumb-item active">Quiz</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-9">
                            <div class="row">
                                @foreach ($quiestion_quiz as $item)
                                <div class="col-md-12">
                                    <div class="card card-widget">
                                        <div class="card-header">
                                            <h3 class="card-title">{!!$item->content!!}</h3>
                                            <div class="card-tools">
                                                <button type="button" class="btn btn-tool"
                                                    data-card-widget="collapse"><i class="fas fa-minus"></i>
                                                </button>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            @foreach (
                                            App\Models\QuestionChoiceItem::where('question_id',$item->id)->get()
                                            as $value)
                                            @if($value->is_correct)
                                            <label>*{{$value->choice_text}}
                                                <label class="text-primary" style="font-size: 10px">
                                                    Jawaban yang benar
                                                </label>
                                            </label>
                                            @else
                                            <label>*{{$value->choice_text}}
                                                <label class="text-danger" style="font-size: 10px"> Jawaban yang
                                                    tidak benar
                                                </label>
                                            </label>
                                            @endif
                                            <hr>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card card-primary card-outline">
                                <div class="card-body box-profile">
                                    <h3 class="profile-username">Status Penyelesaian Kuis</h3>
                                    <p class="text-success"><i class="fas fa-check-circle"></i>
                                        Selesai</p>
                                </div>
                            </div>
                            <a href="{{ url('/class-detail') }}/{{$classroom->slug}}" type="button"
                                class="btn btn-block btn-primary btn-lg quiz">
                                Kembali ke Kelas
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection