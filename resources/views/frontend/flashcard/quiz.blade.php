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
                    <div class="col-8  align-self-center" id="question_count" style="text-align: center">
                        
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
                                        
                                        <div id="question">

                                        </div>
                                        <div id="explanation">

                                            
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

        questionCount = () => {
            var dataLenght = data.length
            var question_count = number+1 + " dari " + dataLenght
            document.getElementById('question_count').innerHTML = question_count;
        }

        $(document).ready(function() {  
            questionCount();
            console.log(data);  
            viewDataQuestion();
        });

        viewDataQuestion = () =>{ 
            document.getElementById('explanation').innerHTML = "";
            document.getElementById('question').innerHTML = "";

            var html =  '<div class="row justify-content-center py-2">'+
                            '<div class="col-12 col-md-12 col-lg-12 py-2" style="text-align: center;">'+
                                '<h4> '+ data[number].question +' </h4>'+
                            '</div>'+
                            '<div class="col-12 col-md-12 col-lg-12" style="text-align: center;">'+
                                '<img class="img-responsive pad" width="100%" src="flashcardfiles/images/'+data[number].images+'" alt="Photo">'+
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
            var dataLenght = data.length
            choice = var_choice;

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
                    console.log('ini data : ', response);

                }
            });
            if(number+1 < dataLenght){
                number++; 
            }
            
            var question_count = number+1 + " dari " + dataLenght
            document.getElementById('question_count').innerHTML = question_count;

            console.log('panjang data : ',data.length);
            console.log('data sekarang : ',number);
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
                                '<h4> '+ data[number].explanation +' </h4>'+
                            '</div>'+
                            '<div class="col-12 col-md-12 col-lg-12" style="text-align: center;">'+
                                '<img class="img-responsive pad col-12 col-sm-12 col-md-12 col-lg-12" src="flashcardfiles/images_explanation/'+data[number].images_explanation+'" alt="Photo">'+
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
                        anchor = anchor + ' <div class="row"> <a href="#" >'+ no++ +'.'+  value.subject +'</a> </div>';
                        console.log('subject : ',anchor); 
                    });

                    var subject =   '<div class="row justify-content-center px-3">'+
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
