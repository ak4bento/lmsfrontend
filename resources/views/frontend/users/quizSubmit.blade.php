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
                            <li class="breadcrumb-item"><a href="{{ url('/class-detail') }}/{{$classroom->slug}}" >Kelas</a></li>
                            <li class="breadcrumb-item active">Kuis</li>
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
                                        <div class="card-body">
                                            <div class="card">
                                                <div class="row p-1 align-items-center" style="margin-left: 5px;margin-right: 5px">
                                                    <a class="text-dark" style="padding-top: 15px">{!!  $item->content!!}</a>
                                                </div>
                                            </div>
                                            @foreach (App\Models\QuestionChoiceItem::where('question_id',$item->id)->get() as $value)
                                            <div class="card">
                                                <div class="row p-1 align-items-center" style="margin-left: 5px;margin-right: 5px">
                                                    @if($value->is_correct)
                                                    <a>{{$value->choice_text}}
                                                        &nbsp;:&nbsp;
                                                        <a class="text-primary" style="font-size: 10px">
                                                            Jawaban yang benar
                                                        </a>
                                                    </a>
                                                    @else
                                                    <a>{{$value->choice_text}}
                                                        &nbsp;:&nbsp;
                                                        <a class="text-danger" style="font-size: 10px"> Jawaban yang
                                                            tidak benar
                                                        </a>
                                                    </a>
                                                    @endif
                                                </div>
                                            </div>
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