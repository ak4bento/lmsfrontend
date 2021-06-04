@extends('frontend.layouts.app')

@push('page_css')

<style>

</style>

@endpush
@section('content')

<div class="container">
    <div class="row">
        <div class="col-12">
            <div class="card py-2 px-2">
                <div class="row justify-content-between">
                    <div class="col-2">
                        <button type="button" onclick="prev()" class="btn btn-primary">
                            <i class="fas fa-angle-left"></i>
                        </button>
                    </div>
                    <div class="col-8  align-self-center" style="text-align: center">
                        <div class="row">
                            <div class="col-12" id="question_count"></div>
                        </div>
                        <div class="row">
                            <div class="col-12" id="answered_quiz">
                                <div class="progress" style="height: 3px">
                                    <div class="progress-bar" id="progress_bar" role="progressbar" style="width: 0%"
                                        aria-valuemax="100"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-2">
                        <button type="button" onclick="next()" class="btn btn-primary float-right ">
                            <i class="fas fa-angle-right"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <section class="content">
        <div class="row" id="data_question" data-questions="{{ Session::get('flashcard_question') }}">
            <div class="col-lg-12">
                <div class="row">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card card-widget card-primary card-outline">
                                    <div class="card-body">

                                        <div class="modal fade bd-example-modal-xl" tabindex="-1" role="dialog"
                                            aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-xl">
                                                <div class="modal-content">
                                                    <div class="modal-header">

                                                        <span style="font-size: 20px" id="exampleModalLongTitle">
                                                            <div id="titleSubject">

                                                            </div>
                                                        </span>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div id="imageSubject">

                                                        </div>
                                                        <div id="referenceSubject">

                                                        </div>
                                                        <div id="externalLnk">

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                        <div id="question" class="col-lg-12 col-md-12 col-sm-12 col-12">
                                        </div>
                                        <div id="explanation" class="col-lg-12 col-md-12 col-sm-12 col-12">


                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endsection
    @push('page_scripts')

    <script>
        var number=0;
        var data = document.querySelector('#data_question');
        data = data.getAttribute('data-questions');
        data = JSON.parse(data);
        var group,choice;
        var dataLenght = data.length;

        // $(document).ready(function() {
        //     console.log('ini  lenght : ',sessionStorage.getItem('finish'));
        //     if(dataLenght == sessionStorage.getItem('finish')){
        //         quizDone();
        //         number = dataLenght;
        //     }
        // });

        questionCount = () => {
            var dataLenght = data.length
            var question_count = number+1 + " dari " + dataLenght
            document.getElementById('question_count').innerHTML = question_count;
        }

        $(document).ready(function() {
            questionCount();
            console.log(data);
            viewDataQuestion();
            sessionStorage.setItem('finished', 0);
            if(dataLenght == sessionStorage.getItem('finish')){
                quizDone();
                number = dataLenght;
                document.getElementById("progress_bar").setAttribute("style", "width:100%");
                var question_count = number + " dari " + dataLenght
                document.getElementById('question_count').innerHTML = question_count;
            }
        });

        viewDataQuestion = () =>{

            document.getElementById('explanation').innerHTML = "";
            document.getElementById('question').innerHTML = "";

            var question_count = number+1 + " dari " + dataLenght


            document.getElementById('question_count').innerHTML = question_count;

            var html =  '<div class="row justify-content-center py-2">'+
                            '<div class="col-12 col-md-12 col-lg-12 py-2" style="text-align: center;">'+
                                '<div class="card"> <div class="card-body"> <h4> '+ data[number].question + data[number].id +' </h4> </div> </div>'+
                            '</div>'+
                            '<div class="col-12 col-md-12 col-lg-12" style="text-align: center;">'+
                                '<div class="card"> <div class="card-body"> <img class="img-responsive pad" width="100%" src="flashcardfiles/images/'+data[number].images+'" alt="Photo"> </div></div>'+
                            '</div>'+
                        '</div>'+
                        '<div class="row justify-content-center py-2">'+
                            '<div style="margin-right:5px;text-align: center;">'+
                                '<button class="btn btn-primary" onclick="viewDataExplanation(1)" >Rendah</button>'+
                            '</div>'+
                            '<div style="text-align: center;">'+
                                '<button class="btn btn-primary" onclick="viewDataExplanation(2)">Menengah</button>'+
                            '</div>'+
                            '<div style="margin-left:5px;text-align: center;">'+
                                '<button class="btn btn-primary" onclick="viewDataExplanation(3)">Tinggi</button>'+
                            '</div>'+
                        '</div>';

            $("#question").append(html);
        }

        changeNumber = (var_choice) =>{

            choice = var_choice;
            // console.log('var choice : ',var_choice);
            var rute = "{{ url('flashcard-answer') }}";


            $.ajax({
                type: 'post',
                url: rute,
                data: {
                    "flashcard_questions_id": data[number].id,
                    "group": group,
                    "choice": choice,
                    "_token": "{{ csrf_token() }}"
                },
                success: function(response) {
                    progressBar();

                }
            });
            if(number+1 < dataLenght){
                number++;
                var question_count = number+1 + " dari " + dataLenght
                document.getElementById('question_count').innerHTML = question_count;

                console.log('panjang data : ',data.length);
                console.log('data sekarang : ',number);
                viewDataQuestion();
            } else if (number+1 == dataLenght) {
                quizDone();
            }
        }

        progressBar = () => {

                var finished = sessionStorage.getItem('finished')
                console.log('progress : ', finished);
                finished++;
                var percent = (finished / dataLenght) * 100;
                var width = "width: "+percent+"%";
                var progress =  document.getElementById("progress_bar").setAttribute("style", width);

                sessionStorage.setItem('finished', finished);

        }

        quizDone = () => {

            document.getElementById('question').innerHTML = "";
            document.getElementById('explanation').innerHTML = "";

            var html = '<div class="row justify-content-center" style="text-align: center;">'+
                            '<div class="card col-12 col-sm-12 col-md-6 col-lg-6">'+
                                '<div class="card-body" >'+
                                    '<h4>You ve finished all the questions in this quiz.</h4>'+
                                    '<button class="btn btn-outline-primary" style="margin-right:5px" onclick="reapetQuiz()" > Ulangi</button>'+
                                    '<a href="/flashcard" class="btn btn-primary" style="margin-right:5px" > Buat Kuis Baru</a>'+
                                '</div>'+
                            '</div>'+
                        '</div>';
            sessionStorage.setItem('finish', dataLenght);
            $("#question").append(html);
        }

        reapetQuiz = () => {
            number = 0;
            sessionStorage.clear();
            sessionStorage.setItem('finished', -1);
            progressBar();

            viewDataQuestion();
        }


        viewDataExplanation = (var_group) => {
            group = var_group;

            document.getElementById('explanation').innerHTML = "";
            document.getElementById('question').innerHTML = "";


            var data = document.querySelector('#data_question');
            data = data.getAttribute('data-questions');
            data = JSON.parse(data);
            var html =  '<div class="row justify-content-center py-2">'+
                            '<div class="col-12 col-md-12 col-lg-12 py-2" style="text-align: center;">'+
                                '<div class="card"> <div class="card-body"> <h4> '+ data[number].explanation +' </h4> </div> </div>'+
                            '</div>'+
                            '<div class="col-12 col-md-12 col-lg-12" style="text-align: center;">'+
                                '<div class="card"> <div class="card-body"> <img class="img-responsive pad col-12 col-sm-12 col-md-12 col-lg-12" src="flashcardfiles/images_explanation/'+data[number].images_explanation+'" alt="Photo"> </div> </div>'+
                            '</div>'+
                        '</div>' ;

            $("#explanation").append(html);

            var rute = "{{ url('flashcard-subject') }}/" + data[number].id;

            var anchor = '';
            var no = 1;
            $.ajax({
                url: rute,
                type: 'get',
                success: function(response) {
                    $.each(response, function(key, value) {
                        anchor = `${anchor} <div class="row"> ${no++}.
                                                <a href="#" data-toggle="modal" onclick="viewSubject(${value.id})"
                                                    data-target=".bd-example-modal-xl" >${value.subject}
                                                </a>
                                            </div>`;
                        console.log('subject : ',value);
                    });

                    var subject =   '<div class="row justify-content-center px-2">'+
                                        '<div class="card col-12 col-md-12 col-lg-12" >'+
                                            '<div class="card-body" style="text-align: center;">'+ anchor+'</div>'+
                                        '</div>'+
                                    '</div>'+
                                    '<div class="row justify-content-center py-2">'+
                                        '<div style="text-align: center;">'+
                                            '<button class="btn btn-success" onclick="changeNumber(1)" >Mengerti</button>'+
                                        '</div>'+
                                        '<div style="margin-left:5px;text-align: center;">'+
                                            '<button class="btn btn-danger" onclick="changeNumber(2)">Tidak Mengerti</button>'+
                                        '</div>'+
                                    '</div>';
                    $("#explanation").append(subject);
                }
            });
        }

        viewSubject = (subject) => {
            var rute = `{{ url('flashcard-subject-single') }}/${subject}`;
            document.getElementById('titleSubject').innerHTML = "";
            document.getElementById('imageSubject').innerHTML = "";
            var no = 1;
            $.ajax({
                url: rute,
                type: 'get',
                success: function(value) {

                        console.log('value : ',value);
                        let title = `<h5>${value.subject}</h5>`;
                        $("#titleSubject").append(title);
                        let image = `<img class="img-responsive pad" width="100%" src="flashcardfiles/files/${value.files}" alt="Photo">`;
                        $("#imageSubject").append(image);


                }
            });
        }

        next = () => {
            if(number+1 < data.length){
                number++;
            }
            questionCount();
            console.log('panjang data : ',data.length);
            console.log('data sekarang : ',number);
            viewDataQuestion();
        }

        prev = () => {
            if(number > 0){
                number--;
            }
            questionCount();
            console.log('panjang data : ',data.length);
            console.log('data sekarang : ',number);
            viewDataQuestion();
        }

    </script>
    @endpush
