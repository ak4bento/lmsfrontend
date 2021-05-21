@extends('frontend.layouts.app')

@push('page_css')
<style>
    .list-group{
        max-height: 300px;
        min-height: 300px;
        overflow-x: hidden; 
        overflow-y: scroll; 
        -webkit-overflow-scrolling: touch;
        border-style: solid;
        border-color: #1b5cb838;
    }

    .style{
        border-radius: 5px; 
        font-family: sans-serif;
        background: linear-gradient(#206dda, #1b5cb8);
    }
    .border{
        /* border-bottom-style:solid; */
        /* border-width: thin;  */
    }
    .group{
        max-height: 300px;
        min-height: 300px;
        overflow-x: hidden; 
        overflow-y: scroll; 
        -webkit-overflow-scrolling: touch;
        border-style: solid;
        border-color: #1b5cb838;
    }

 
    .style-3::-webkit-scrollbar-track
    {
        -webkit-box-shadow: inset 0 0 6px #cfcfee;
        background-color: #F5F5F5;
    }

    .style-3::-webkit-scrollbar
    {
        width: 6px;
        background-color: #F5F5F5;
    }
    .style-3::-webkit-scrollbar-thumb
    {
        background-color: #206dda;
    }
    .hover:hover{
        cursor: pointer;
        background: rgb(204, 205, 209);
    } 

    .hover-all:hover{
        cursor: pointer;
    }
</style>
<style>
    .bg-overlay {
        background: linear-gradient(#206dda, #1b5cb8); 
        margin-bottom:10px;
        border-radius:10px;
        color: #fff;
    }
</style>
@endpush
@section('content')
    <div class="container">
        <div class="row p-0">
            <div class="content-header bg-overlay px-5 py-5 col-lg-12 col-md-12 col-sm-12 ">
                <div class="container">
                    <div class="row">
                        <a style="font-size: 2.5em">Flashcard </a>
                    </div>
                    <div class="row">
                        <a style="font-size: 1.5em">Buat Kuis Anda</a>
                    </div>
                </div>
            </div>
        </div>

        <section class="content"> 
            <div class="row" >
                @php
                    $count = 1;
                @endphp 
                <div class="card col-lg-12">
                    <div class="card-body">
                        <div class="row">
                            
                            <div class="col-lg-3 p-0 group style-3" style="border-style: solid;border-width:thin ">
                                <div class="py-2 px-2 border-bottom" style="  background: linear-gradient(#206dda, #1b5cb8); text-align: center" >
                                    <label style="color:white; font-family: sans-serif; font-weight: normal !important;">Kategori </label>
                                </div>
                                @foreach (App\Models\FlashcardCategories::where('deleted_at',null)->where('parent_id',null)->get() as $item)
                                <div class="py-2 px-2 hover border-bottom" onclick="first_category({{ $item->id}})">
                                    <div class="custom-control custom-checkbox">
                                        <input class="custom-control-input hover" data-category="{{ $item->category }}" onclick="checked_category({{ $item->id}})" id="category[{{ $item->id}}]" name="category[{{ $item->id}}]" type="checkbox">
                                        <label style="font-family: sans-serif; font-weight: normal !important;" class="cursor-pointer hover  custom-control-label" for="category[{{ $item->id}}]">{{ $item->category }}</label>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                            <div class="col-lg-3 p-0 group style-3 " style="border-style: solid;border-width:thin " >
                                <div class="py-2 px-2 border-bottom" style="background: linear-gradient(#206dda, #1b5cb8); text-align: center" >
                                    <label style="color:white; font-family: sans-serif; font-weight: normal !important;">Kategori </label>
                                </div>
                                <div class="second_category style-3" id="second_category">

                                </div>
                            </div>
                            <div class="col-lg-3 p-0 group style-3" style="border-style: solid;border-width:thin ">
                                <div class="py-2 px-2 border-bottom" style="background: linear-gradient(#206dda, #1b5cb8); text-align: center" >
                                    <label style="color:white; font-family: sans-serif; font-weight: normal !important;">Kategori </label>
                                </div>
                                <div class="third_category" id="third_category">

                                </div>
                            </div>
                            <div class="col-lg-3 p-0 group style-3"  style="border-style: solid;border-width:thin ">
                                <div class="py-2 px-2 border-bottom" style="background: linear-gradient(#206dda, #1b5cb8); text-align: center" >
                                    <label style="color:white; font-family: sans-serif; font-weight: normal !important;">Kategori </label>
                                </div>
                                <div class="fourth_category" id="fourth_category">

                                </div>
                            </div>
                            <div class="col-lg-12 p-0" id="btn-group" style="margin-top:10px">
                                <div class="btn-category" id="btn-category">

                                </div>
                                {{-- <button class="btn btn-primary style" >Kategori </button> --}}
                            </div>
                            <div class="col-lg-12 p-0"  style="margin-top:10px">
                                <input type="button" class="check btn btn-outline-primary" value="Bersihkan" />
                            </div>                                    
                        </div>
                    </div>
                </div>
            </div>

            <div class="row" style="margin-top: 5px">
                <div class="col-lg-12 col-md-12 col-sm-12 col-12 p-0">
                    <div class="card">
                        <div class="card-body"> 
                            <div class="row d-flex align-items-center">
                                <div style="text-align: center" class="col-lg-2">
                                    <a style="font-weight: bold;font-size: 30px; display: block;">891237</a>
                                    <a style="font-size: 18px;"> Flash Card </a>
                                </div>
                                <div class="col-lg-6">
                                    <div class="progress" style="height: 40px; border-radius: 30px">
                                        <div class="progress-bar progress-bar-striped" role="progressbar" style="width: 20%"
                                            aria-valuenow="10" aria-valuemin="0" aria-valuemax="100">20 %
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-2">
                                    <select class="form-control">
                                        <option value="" selected disabled>Maksimal Soal</option>
                                        <option>10</option>
                                        <option>25</option>
                                        <option>40</option>
                                        <option>50</option>
                                        <option>100</option>
                                        <option>250</option>
                                        <option>1000</option>
                                        <option>3000</option>
                                    </select>
                                </div>
                                <div class="col-lg-2">
                                    <button class="btn btn-block btn-primary" data-toggle="modal"
                                    data-togglebtn="tooltip" data-placement="top" title="Lengkapi atau ubah biodata"
                                    data-target="#quizZummary">Buat Kuis</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <div class="modal fade" id="quizZummary" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <div class="container-fluid" style="text-align: center">
                            <span style="font-size: 20px" id="exampleModalLongTitle">
                                Ringkasan Kuis
                            </span>
                        </div>
                    </div>
                    <form action="{{ route('updateProfile', Auth::user()->id) }}" method="POST">
                        @csrf
                        <div class="modal-body">
                            <div class="container-fluid">
                                <div class="row">
                                     
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <div class="container-fluid">
                                <a href="{{ route('flashcard.start') }}" class="btn btn-primary btn-md float-right" data-togglebtn="tooltip"
                                    data-placement="top" title="Simpan">Mulai</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection 
@push('page_scripts')
    <script>

        checked_category = (id) => {
            var rute = "{{ url('flashcard-selected') }}/" + id;
            checkbox_id = 'category['+id+']';
            var checkboxes = document.getElementById(checkbox_id);
            console.log(checkboxes);
            if(checkboxes.checked){
                $.ajax({
                    url: rute,
                    type: 'get',
                    success: function(response) { 
                        console.log('ini on button select: ', response); 
                        var data =  '<button class="btn btn-primary btn-sm style" data-button="delete" name="btn['+response.id+']" id="btn['+response.id+']" style="margin-left:2px;margin-right:2px" > '+ response.category +' </button>';
                        var buttonId = 'btn['+response.id+']';
                        var buttonLabel = document.getElementById(buttonId);
                        console.log('button label :', buttonLabel);
                        if(buttonLabel == null)
                        $(".btn-category").append(data);
                    }
                });
            }
            else {
                rute = "{{ url('flashcard-unselected') }}/" + id;
                btn_id = 'btn['+id+']';
                var btn = document.getElementById(btn_id);
                btn.remove();
                console.log('222222 : ',btn_id);

                $.ajax({
                    url: rute,
                    type: 'get',
                    success: function(response) { 
                        console.log('ini on button 2222: ', response); 
                        $.each(response, function(key, value) {
                       
                            btn_id = 'btn['+value.id+']';
                            btn = document.getElementById(btn_id);
                            console.log('333333333 : ',btn_id);
                            console.log('obeject btn 3', btn);
                            if(btn != null)
                                btn.remove();

                            rute = "{{ url('flashcard-unselected') }}/" + value.id;
                            btn_id = 'btn['+value.id+']';
                            btn = document.getElementById(btn_id); 

                            $.ajax({
                                url: rute,
                                type: 'get',
                                success: function(response) { 
                                    console.log('ini on button 3333: ', response); 
                                    $.each(response, function(key, value) {
                                
                                        btn_id = 'btn['+value.id+']';
                                        btn = document.getElementById(btn_id);
                                        if(btn != null)
                                            btn.remove();
                                        rute = "{{ url('flashcard-unselected') }}/" + value.id;
                                        btn_id = 'btn['+value.id+']';
                                        btn = document.getElementById(btn_id); 
                                        
                                        $.ajax({
                                            url: rute,
                                            type: 'get',
                                            success: function(response) { 
                                                console.log('ini on button 4444: ', response); 
                                                    $.each(response, function(key, value) {
                                                
                                                    btn_id = 'btn['+value.id+']';

                                                    btn = document.getElementsByName(btn_id); 
                                                        // console.log();
                                                    if(btn != null)
                                                        btn.remove();
                                                });
                                            }
                                        });
                                    });
                                }
                            });
                        });
                    }
                });
            }
        }

        first_category = (id) => {
            document.getElementById('second_category').innerHTML =  'Loading...';

            document.getElementById('third_category').innerHTML = "";
            document.getElementById('fourth_category').innerHTML = "";

            var rute = "{{ url('flashcard-categories') }}/" + id;
            $.ajax({
                url: rute,
                type: 'get',
                success: function(response) {
                    document.getElementById('second_category').innerHTML = "";

                    console.log('ini on button : ', response);
                    $.each(response, function(key, value) {
                        var data =  '<div class="py-2 px-2 hover border-bottom"  onclick="third_category('+ value.id +')">'+
                                        '<div class="custom-control custom-checkbox">'+
                                            '<input class="custom-control-input hover" data-category="'+value.category+'" onclick="checked_category('+ value.id +')" id="category['+ value.id +']" name="second_category['+ value.id +']" type="checkbox">'+
                                            '<label style="font-family: sans-serif; font-weight: normal !important;" class="cursor-pointer hover  custom-control-label" for="category['+ value.id +']">'+ value.category +'</label>'+
                                        '</div>'+
                                    '</div>';
                        $(".second_category").append(data);
                    });
                }
            });
        }

        second_category = (id) => {
            document.getElementById('third_category').innerHTML = "Loading...2";
            var rute = "{{ url('flashcard-categories') }}/" + id;
            $.ajax({
                url: rute,
                type: 'get',
                success: function(response) {
                    document.getElementById('second_category').innerHTML = "";

                    console.log('ini on button : ', response);
                    $.each(response, function(key, value) {
                        var data =  '<div class="py-2 px-2 hover border-bottom"  onclick="third_category('+ value.id +')">'+
                                        '<div class="custom-control custom-checkbox">'+
                                            '<input class="custom-control-input hover" data-category="'+value.category+'" onclick="checked_category('+ value.id +')" id="category['+ value.id +']" name="second_category['+ value.id +']" type="checkbox">'+
                                            '<label style="font-family: sans-serif; font-weight: normal !important;" class="cursor-pointer hover  custom-control-label" for="category['+ value.id +']">'+ value.category +'</label>'+
                                        '</div>'+
                                    '</div>';
                                     
                        $(".third_category").append(data);
                    });
                }
            }); 
        }


        third_category = (id) => {
            document.getElementById('third_category').innerHTML = "Loading...";
            document.getElementById('fourth_category').innerHTML = "";

            var rute = "{{ url('flashcard-categories') }}/" + id;
            $.ajax({
                url: rute,
                type: 'get',
                success: function(response) {
                    document.getElementById('third_category').innerHTML = "";

                    console.log('ini on button : ', response);
                    $.each(response, function(key, value) {
                        console.log('ini on value : ', value);
                        var data =  '<div class="py-2 px-2 hover border-bottom"  onclick="fourth_category('+ value.id +')">'+
                                        '<div class="custom-control custom-checkbox">'+
                                            '<input class="custom-control-input hover" data-category="'+value.category+'" onclick="checked_category('+ value.id +')" id="category['+ value.id +']" name="third_category['+ value.id +']" type="checkbox">'+
                                            '<label style="font-family: sans-serif; font-weight: normal !important;" class="cursor-pointer hover  custom-control-label" for="category['+ value.id +']">'+ value.category +'</label>'+
                                        '</div>'+
                                    '</div>';

                        $(".third_category").append(data);
                    });
                }
            }); 
        } 

        fourth_category = (id) => {
            document.getElementById('fourth_category').innerHTML = "Loading...";

            var rute = "{{ url('flashcard-categories') }}/" + id;
            $.ajax({
                url: rute,
                type: 'get',
                success: function(response) {
                    document.getElementById('fourth_category').innerHTML = "";

                    console.log('ini on button : ', response);
                    $.each(response, function(key, value) {
                        console.log('ini on value : ', value);

                        var data =  '<div class="py-2 px-2 hover border-bottom" >'+
                                        '<div class="custom-control custom-checkbox">'+
                                            '<input class="custom-control-input hover" data-category="'+value.category+'" onclick="checked_category('+ value.id +')" id="category['+ value.id +']" name="fourth_category['+ value.id +']" type="checkbox">'+
                                            '<label style="font-family: sans-serif; font-weight: normal !important;" class="cursor-pointer hover  custom-control-label" for="category['+ value.id +']">'+ value.category +'</label>'+
                                        '</div>'+
                                    '</div>';
                        $(".fourth_category").append(data);
                    });
                }
            }); 
        }
 

        $('.check:button').click(function(){
            var checked = false;
            $('input:checkbox').prop('checked', checked);
            $(this).val(checked ? 'uncheck all' : 'Bersihkan' )
            $(this).data('checked', checked);
            
            var btn = document.getElementById('btn-category'); 
            btn.remove(); 
            var data = '<div class="btn-category" id="btn-category"></div>';
            $("#btn-group").append(data);

        });

        checkAll = (ele) => {
        var checkboxes = document.getElementsByTagName('input');
            // if (ele.checked) {
            //     for (var i = 0; i < checkboxes.length; i++) {
            //         if (checkboxes[i].type == 'checkbox') {
            //             checkboxes[i].checked = false;
            //             btn_id = 'btn['+i+']';
            //             var btn = document.getElementById(btn_id); 

            //             console.log('btn : ', btn);
            //             if(btn != null)
            //                 btn.remove();
            //         }
            //     }
            //     for (var i = 0; i < checkboxes.length; i++) {
            //         if (checkboxes[i].type == 'checkbox' ) {
            //             checkboxes[i].checked = true;
            //             console.log('select all : ',checkboxes[i].getAttribute("id"));
            //             if(checkboxes[i].getAttribute("id") != null && checkboxes[i].getAttribute("data-category") != null){
            //                 var data =  '<button class="btn btn-primary btn-sm style" id="btn['+i+']" style="margin-left:2px;margin-right:2px" > '+ checkboxes[i].getAttribute("data-category") +' </button>';
            //                 $(".btn-category").append(data);
            //             }
            //         }
            //     }
                
            // } 
            for (var i = 0; i < checkboxes.length; i++) {
                if (checkboxes[i].type == 'checkbox') {
                    checkboxes[i].checked = false;
                    btn_id = 'btn['+i+']';
                    var btn = document.getElementById(btn_id); 

                    console.log('btn : ', i);
                    if(btn != null){
                        btn.remove(); 
                    }
                    // if(i == 6){
                    //     btn_id = 'btn['+ i+1 +']';
                    //     console.log('btn 7 : ', btn_id);

                    //     btn = document.getElementById(btn_id); 
                    //     btn.remove();
                    // }
                        
                }
            }
        }
    </script>
@endpush
