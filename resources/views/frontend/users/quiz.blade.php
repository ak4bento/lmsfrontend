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
                                        <span class="username"><a href="#" id="questionCounting"></a></span>
                                        <span class="description">of {{ $question->count() }}</span>
                                    </div>
                                    <!-- /.user-block -->
                                    <div class="card-tools" id="arrow_button">

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

    function itemOptionClick(question_id,itemOption_radio) {  
        checkedItem = itemOption_radio.value;
        data = '{question id: '+question_id+',checked item id:'+checkedItem+'}';
        question = 'question id: '+question_id;
        sessionStorage.setItem(question_id,checkedItem);
    }
    
    // question and option
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
                document.getElementById('questionCounting').innerHTML = "";
                var question = "<p> " + response[0].content + "</p> </div>";
                $("#question").append(question);
                $.each(response, function(key, value) {
                    checkedItem = sessionStorage.getItem(response[key].id); 
                    console.log("yang tercek : ",checkedItem);
                    checking = null;
                    if(checkedItem == response[key].qc_id )
                        checking = "checked";
                    var option = '<div class="custom-control custom-radio"> <input '+checking+' onclick="itemOptionClick('+response[key].id+',this);" value="'+response[key].qc_id+'" class="custom-control-input" type="radio" id="itemOption_radio_'+response[key].qc_id+'" name="itemOption_radio"> <label for="itemOption_radio_'+response[key].qc_id+'" class="custom-control-label">'+
                                response[key].choice_text
                                    +'</label></div><hr>';  
                    $("#itemOption").append(option);
                }); 
            }
        });
    });

    // button number ready
    $(document).ready(function() {
        var id = {{ $quizzes->id }};
        var rute = "{{ url('get-quiz') }}/" + id;
        $.ajax({
            url: rute,
            type: 'get',
            success: function(response) {
                var i = 1;
                $.each(response, function(key, value) {
                    document.getElementById('questionCounting').innerHTML = "";
                    console.log("ini quiz : ",response[key].id);
                    var btn_question_number = '<button style="margin-bottom:2px;width:23%;margin-left:2px;margin-right:2px;" id="btn_question_'+response[key].id+'" data-question_id="'+response[key].id+'" type="button" class="btn btn-default"  onclick="btnQuestion('+response[key].id+','+i+')" >'+ i++ +'</button>';
                    $("#btn_question_number").append(btn_question_number);
                    $("#questionCounting").append("Soal Nomor 1");
                }); 
            }
        });
    });

    // button number onclick
    btnQuestion = (id,number) => {
        // questionCounting
        loadingView();
        console.log('ini id',id);
        var rute = "{{ url('get-question') }}/" + id;
        console.log("ini rute :", rute);
        $.ajax({
            url: rute,
            type: 'get',
            success: function(response) {
                // var myobj = document.getElementById('question_text');
                remover();
                
                var question = "<p> " + response[0].content + "</p>";
                $("#question").append(question);
                $.each(response, function(key, value) {
                    checkedItem = sessionStorage.getItem(response[key].id); 
                    console.log("yang tercek : ",checkedItem);
                    checking = null;
                    if(checkedItem == response[key].qc_id )
                        checking = "checked";

                    console.log("ini mi responya :", value);
                    var option = '<div class="custom-control custom-radio"> <input '+checking+' onclick="itemOptionClick('+response[key].id+',this);" value="'+response[key].qc_id+'" class="custom-control-input" type="radio" id="itemOption_radio_'+response[key].qc_id+'" name="itemOption_radio"> <label for="itemOption_radio_'+response[key].qc_id+'" class="custom-control-label">'+
                                response[key].choice_text
                                    +'</label></div><hr>';  
                    $("#itemOption").append(option);
                }); 
                number = "Soal Nomor "+number;
                $("#questionCounting").append(number);
            }
        });
    }

    function remover(){
        document.getElementById('question').innerHTML = "";
        document.getElementById('itemOption').innerHTML = "";
        document.getElementById('questionCounting').innerHTML = "";
    }

    function loadingView(){
        document.getElementById('question').innerHTML = "Loading";
        document.getElementById('itemOption').innerHTML = "Loading";
        document.getElementById('questionCounting').innerHTML = "Loading";
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