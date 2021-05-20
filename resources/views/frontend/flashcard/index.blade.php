@extends('frontend.layouts.app')

@push('page_css')
<style>
    .list-group{
        max-height: 300px;
        min-height: 300px;
        margin-bottom: 10px;
        overflow-x: hidden; 
        overflow-y: scroll; 
        -webkit-overflow-scrolling: touch;
        border-top-style: solid;
        border-bottom-style: solid;
        border-color: #1b5cb838;
    }

    .border{
        border-top-style: solid;
        border-bottom-style: solid;
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
                            <div class="col-lg-12 col-md-12 col-sm-12 col-12 p-0">
                                <div class="card py-2" style="padding-left: 20px">
                                    <div class="custom-control custom-checkbox">
                                        <input class="custom-control-input hover-all" onclick="checkAll(this)"  id="selectAll" name="select_all" type="checkbox">
                                        <label style="width: 100px; font-family: sans-serif; font-weight: normal !important;" class="cursor-pointer hover-all d-block custom-control-label" for="selectAll">
                                            Pilih Semua
                                        </label>
                                    </div>
                                </div>
                            </div>
                            {{-- kategori 1 --}}
                            <div class="col-lg-3 col-md-6 col-sm-12 col-12 p-0">
                                <ul class="list-group style-3" id="" style="border-left-style:solid ">
                                    @foreach (App\Models\FlashcardCategories::where('deleted_at',null)->where('parent_id',null)->get() as $item)
                                        <li class="list-group-item rounded-0 hover" onclick="first_category({{ $item->id}})">
                                            <div class="custom-control custom-checkbox">
                                                <input class="custom-control-input hover" id="category[{{ $item->id}}]" name="category[{{ $item->id}}]" type="checkbox">
                                                <label style="font-family: sans-serif; font-weight: normal !important;" class="cursor-pointer hover d-block custom-control-label" for="category[{{ $item->id}}]">{{ $item->category}}</label>
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
    
                            {{-- kategori 2 --}}
                            <div class="col-lg-3 col-md-6 col-sm-12 col-12 p-0">
                                <ul class="list-group second_category style-3" id="second_category">
                                     
                                </ul>
                            </div>
    
                            {{-- kategori 3 --}}
                            <div class="col-lg-3 col-md-6 col-sm-12 col-12 p-0">
                                <ul class="list-group style-3 third_category" id="third_category">
                                    
                                </ul>
                            </div>
    
                            {{-- kategori 4 --}}
                            <div class="col-lg-3 col-md-6 col-sm-12 col-12 p-0">
                                <ul class="list-group style-3 fourth_category" id="fourth_category">
                                     
                                </ul>
                            </div>
    
                            <div class="col-lg-3 col-md-6 col-sm-12 col-12 p-0">
                
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
                                <button type="submit" class="btn btn-primary btn-md float-right" data-togglebtn="tooltip"
                                    data-placement="top" title="Simpan">Mulai</button>
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
        first_category = (id) => {

            document.getElementById('second_category').innerHTML = "Loading...";

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
                        var data = '<li class="list-group-item rounded-0 hover" onclick="third_category('+ value.id +')">'+
                                        '<div class="custom-control custom-checkbox">'+
                                            '<input class="custom-control-input hover"  id="second_category['+ value.id +']" name="second_category[]" type="checkbox">'+
                                            '<label style="font-family: sans-serif; font-weight: normal !important;" class="cursor-pointer hover d-block custom-control-label" for="second_category['+ value.id +']">'+ value.category +'</label>'+
                                        '</div>'+
                                    '</li>';
                        $(".second_category").append(data);
                    });
                }
            });
              
        }

        second_category = (id) => {
            document.getElementById('third_category').innerHTML = "Loading...";
            var rute = "{{ url('flashcard-categories') }}/" + id;
            $.ajax({
                url: rute,
                type: 'get',
                success: function(response) {
                    document.getElementById('second_category').innerHTML = "";

                    console.log('ini on button : ', response);
                    $.each(response, function(key, value) {
                        var data = '<li class="list-group-item rounded-0 hover" onclick="third_category('+ value.id +')">'+
                                        '<div class="custom-control custom-checkbox">'+
                                            '<input class="custom-control-input hover"  id="second_category['+ value.id +']" name="second_category[]" type="checkbox">'+
                                            '<label style="font-family: sans-serif; font-weight: normal !important;" class="cursor-pointer hover d-block custom-control-label" for="second_category['+ value.id +']">'+ value.category +'</label>'+
                                        '</div>'+
                                    '</li>';
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

                        var data = '<li class="list-group-item rounded-0 hover" onclick="fourth_category('+ value.id +')">'+
                                        '<div class="custom-control custom-checkbox">'+
                                            '<input class="custom-control-input hover"  id="third_category['+ value.id +']" name="third_category[]" type="checkbox">'+
                                            '<label style="font-family: sans-serif; font-weight: normal !important;" class="cursor-pointer hover d-block custom-control-label" for="third_category['+ value.id +']">'+ value.category +'</label>'+
                                        '</div>'+
                                    '</li>';
                        $(".third_category").append(data);
                    });
                }
            }); 
        } 

        fourth_category = (id) => {
            document.getElementById('fourth_category').innerHTML = "Loading...3";

            var rute = "{{ url('flashcard-categories') }}/" + id;
            $.ajax({
                url: rute,
                type: 'get',
                success: function(response) {
                    document.getElementById('fourth_category').innerHTML = "";

                    console.log('ini on button : ', response);
                    $.each(response, function(key, value) {
                        console.log('ini on value : ', value);

                        var data = '<li class="list-group-item rounded-0 hover">'+
                                        '<div class="custom-control custom-checkbox">'+
                                            '<input class="custom-control-input hover"  id="fourth_category['+ value.id +']" name="fourth_category[]" type="checkbox">'+
                                            '<label style="font-family: sans-serif; font-weight: normal !important;" class="cursor-pointer hover d-block custom-control-label" for="fourth_category['+ value.id +']">'+ value.category +'</label>'+
                                        '</div>'+
                                    '</li>';
                        $(".fourth_category").append(data);
                    });
                }
            }); 
        }

        checkAll = (ele) => {
        var checkboxes = document.getElementsByTagName('input');
            if (ele.checked) {
                for (var i = 0; i < checkboxes.length; i++) {
                    if (checkboxes[i].type == 'checkbox' ) {
                        checkboxes[i].checked = true;
                    }
                }
            } else {
                for (var i = 0; i < checkboxes.length; i++) {
                    if (checkboxes[i].type == 'checkbox') {
                        checkboxes[i].checked = false;
                    }
                }
            }
        }
    </script>
@endpush
