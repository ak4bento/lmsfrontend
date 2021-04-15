@extends('frontend.layouts.app') @section('content')
<div class="container">
    <div class="jumbotron jumbotron-fluid text-white" style="background-color: #174ea6">
        <div class="container">
            <h1 class="display-4">Discover</h1>
            <p class="lead">Temukan kelas terbaik untuk anda.</p>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 col-lg-12 col-sm-12">
            <div class="row">
                <div class="col-lg-3 col-md-12 col-sm-12">
                    <div class="row" style="margin-bottom:10px;">
                        <div class="col-12">
                            <!-- Profile Image -->
                            <div class="card card-primary card-outline">
                                <div class="card-body box-profile">
                                    <h1 class="text-center" id="time">
                                        {{ Session::get('timerStartQuiz')}}
                                        <br>
                                        {{ Session::get('timerEndQuiz')}}
                                    </h1>
                                </div>
                                <!-- /.card-body -->
                            </div>
                            <!-- /.card -->
                            <a href="quiz_submit.html">
                                <button type="button" class="btn btn-block btn-warning btn-lg">Submit</button>
                            </a>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="card card-primary card-outline">
                                <div class="card-body">
                                    <div class="align-items-center" style="text-align:center">
                                        @foreach ($question as $key => $data)
                                        <button style="margin-bottom:2px;width:23%" type="button"
                                            class="btn btn-default">
                                            {{ ++$key }}
                                        </button>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-9 col-md-12 col-sm-12">
                    <div class="row">
                        <div class="col-md-12">
                            <!-- Box Comment -->
                            <div class="card card-widget">
                                <div class="card-header">
                                    <div class="user-block">
                                        <img class="img-circle" src="https://img.icons8.com/carbon-copy/2x/file.png"
                                            alt="User Image">
                                        <span class="username"><a href="#">Soal 1</a></span>
                                        <span class="description">of {{ $question->count() }}</span>
                                    </div>
                                    <!-- /.user-block -->
                                    <div class="card-tools">
                                        <button type="button" class="btn btn-primary">
                                            <i class="fas fa-angle-left"></i>
                                        </button>
                                        <button type="button" class="btn btn-primary">
                                            <i class="fas fa-angle-right"></i>
                                        </button>
                                    </div>
                                    <!-- /.card-tools -->
                                </div>
                                <!-- /.card-header -->
                            </div>
                            <!-- /.card -->
                        </div>
                        <!-- /.col -->
                        <div class="col-md-12">
                            <!-- Box Comment -->
                            <div class="card card-widget">
                                <div class="card-body">
                                    <!-- post text -->
                                    <div id="question">

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="card card-widget">
                                <div class="card-body">
                                    <div class="form-group" style="font-size: large;" id="itemOption">

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('page_scripts')
<script>
    $(document).ready(function() {
        var id = {{ $quiz->id }};
        console.log("ini ID :", id);
        var rute = "{{ url('get-question') }}/" + id;
        console.log("ini rute :", rute);
        $.ajax({
            url: rute,
            type: 'get',
            success: function(response) {
                console.log("ini re :", response.length);
                var question = " <p> " + response[0].content + "</p>";
                $("#question").append(question);
                $.each(response, function(key, value) {
                    console.log("ini mi responya :", response.choceItems);
                    var option = '<div class="custom-control custom-radio"> <input class="custom-control-input" type="radio" id="customRadio1" name="customRadio"> <label for="customRadio1" class="custom-control-label">'+
                                response[key].choice_text
                                    +'</label></div><hr>';
                    $("#itemOption").append(option);
                }); 
            }
        });
    });
    function startTimer(duration, display) {
        var timer = duration, minutes, seconds;
        setInterval(function () {
            minutes = parseInt(timer / 60, 10);
            seconds = parseInt(timer % 60, 10);

            minutes = minutes < 10 ? "0" + minutes : minutes;
            seconds = seconds < 10 ? "0" + seconds : seconds;

            display.textContent = minutes + ":" + seconds;

            if (--timer < 0) {
                timer = duration;
            }
            
        }, 1000);
    }

    window.onload = function () {
        var fiveMinutes = 60 * 60,
            display = document.querySelector('#time');
        startTimer(fiveMinutes, display);
    };
</script>
@endpush