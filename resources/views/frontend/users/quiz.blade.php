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
                                        {{-- mulai : {{ Session::get('timerStartQuiz')}}
                                        selesai : {{ Session::get('timerEndQuiz')}}
                                        <br>
                                        sisa :{{ Session::get('remainingTime')}} --}}
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
                                        <div id="btn_question_number"></div>
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
                                        @foreach ($question as $key => $item)
                                        @if($key % 2 == 0)
                                        <button type="button" id="back" data-question_id="{{$item->id}}"
                                            class="btn btn-primary">
                                            <i class="fas fa-angle-left"></i>
                                        </button>
                                        @endif
                                        @if($key % 2 == 1)
                                        <button type="button" id="next" data-question_id="{{$item->id}}"
                                            class="btn btn-primary">
                                            <i class="fas fa-angle-right"></i>
                                        </button>
                                        @endif
                                        @endforeach
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
                                        {{-- question --}}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="card card-widget">
                                <div class="card-body">
                                    <div class="form-group" style="font-size: large;" id="itemOption">
                                        {{-- option --}}
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
    $('#back').on('click', function () { 
        let id = $(this).data('question_id');
        console.log("question id : ", id);
        var rute = "{{ url('get-question') }}/" + id; 
    });

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
                var question = "<p> " + response[0].content + "</p> </div>";
                $("#question").append(question);
                $.each(response, function(key, value) {
                    console.log("ini mi responya :", response[key]);
                    var option = '<div class="custom-control custom-radio"> <input class="custom-control-input" type="radio" id="itemOption_radio_'+response[key].qc_id+'" name="itemOption_radio"> <label for="itemOption_radio_'+response[key].qc_id+'" class="custom-control-label">'+
                                response[key].choice_text
                                    +'</label></div><hr>'; 
                    $("#itemOption").append(option);
                }); 
            }
        });
    });
    $(document).ready(function() {
        var id = {{ $quizzes->id }};
        var rute = "{{ url('get-quiz') }}/" + id;
        $.ajax({
            url: rute,
            type: 'get',
            success: function(response) {
                var i = 1;
                $.each(response, function(key, value) {
                    console.log("ini quiz : ",response[key].id);
                    var btn_question_number = '<button style="margin-bottom:2px;width:23%;margin-left:2px;margin-right:2px;" id="btn_question_'+response[key].id+'" data-question_id="'+response[key].id+'" type="button" class="btn btn-default"  onclick="btnQuestion('+response[key].id+')" >'+ i++ +'</button>';
                    $("#btn_question_number").append(btn_question_number);
                }); 
            }
        });
    });

    btnQuestion = (id) => {
        console.log('ini id',id);
        var rute = "{{ url('get-question') }}/" + id;
        console.log("ini rute :", rute);
        $.ajax({
            url: rute,
            type: 'get',
            success: function(response) {
                // var myobj = document.getElementById('question_text');
                document.getElementById('question').innerHTML = "";
                document.getElementById('itemOption').innerHTML = "";
                var question = "<p> " + response[0].content + "</p>";
                $("#question").append(question);
                $.each(response, function(key, value) {
                    console.log("ini mi responya :", value);
                    var option = '<div class="custom-control custom-radio"> <input class="custom-control-input" type="radio" id="itemOption_radio_'+response[key].qc_id+'" name="itemOption_radio"> <label for="itemOption_radio_'+response[key].qc_id+'" class="custom-control-label">'+
                                response[key].choice_text
                                    +'</label></div><hr>'; 
                    $("#itemOption").append(option);
                }); 
            }
        });
    }

    $('#btn_question_1').on('click', function (e) { 
        let id = $(this).data('question_id');
        console.log("question id : ", id);
        var rute = "{{ url('get-question') }}/" + id; 
    });

    $(document).ready(function() {
        // Set the date we're counting down to
        countDownDate = new Date("Jan 5, 2021 15:37:25").getTime();
    
        // Update the count down every 1 second
        var x = setInterval(function() {
    
        // Get today's date and time
        var now = new Date().getTime();
    
        // Find the distance between now and the count down date
        var distance = countDownDate - now;
    
        // Time calculations for days, hours, minutes and seconds
        var days = Math.floor(distance / (1000 * 60 * 60 * 24));
        var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        var seconds = Math.floor((distance % (1000 * 60)) / 1000);
    
        // Display the result in the element with id="time"
        document.getElementById("time").innerHTML = days + "d " + hours + "h "
        + minutes + "m " + seconds + "s ";
    
            // If the count down is finished, write some text
            if (distance < 0) {
                clearInterval(x);
                document.getElementById("time").innerHTML = "EXPIRED";
            }
        }, 1000);
    });
</script>
@endpush