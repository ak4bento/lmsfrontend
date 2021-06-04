@extends('frontend.layouts.app')

@push('page_css')
<style>
    .list-group {
        max-height: 300px;
        min-height: 300px;
        overflow-x: hidden;
        overflow-y: scroll;
        -webkit-overflow-scrolling: touch;
        border-style: solid;
        border-color: #1b5cb838;
    }

    .style {
        border-radius: 5px;
        font-family: sans-serif;
        margin-top: 3px;
        background: linear-gradient(#206dda, #1b5cb8);
    }

    .border {
        /* border-bottom-style:solid; */
        /* border-width: thin;  */
    }

    .group {
        max-height: 300px;
        min-height: 300px;
        overflow-x: hidden;
        overflow-y: scroll;
        -webkit-overflow-scrolling: touch;
        border-style: solid;
        border-color: #1b5cb838;
    }


    .style-3::-webkit-scrollbar-track {
        -webkit-box-shadow: inset 0 0 6px #cfcfee;
        background-color: #F5F5F5;
    }

    .style-3::-webkit-scrollbar {
        width: 6px;
        background-color: #F5F5F5;
    }

    .style-3::-webkit-scrollbar-thumb {
        background-color: #206dda;
    }

    .hover:hover {
        cursor: pointer;
        background: rgba(133, 153, 224, 0.151);
    }

    .hover-all:hover {
        cursor: pointer;
    }
</style>
<style>
    .bg-overlay {
        background: linear-gradient(#206dda, #1b5cb8);
        margin-bottom: 10px;
        border-radius: 10px;
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
        <div class="row">
            @php
            $count = 1;
            @endphp
            <div class="card col-lg-12">
                <div class="card-body">
                    <div class="row">

                        <div class="col-lg-3 col-md-6 col-sm-12 col-12 p-0 group style-3"
                            style="border-style: solid;border-width:thin ">
                            <div class="py-2 px-2 border-bottom"
                                style="  background: linear-gradient(#206dda, #1b5cb8); text-align: center">
                                <label
                                    style="color:white; font-family: sans-serif; font-weight: normal !important;">Kategori
                                </label>
                            </div>
                            @foreach($flashcardCategories as $item)
                            <div class="py-2 px-2 hover border-bottom" onclick="first_category({{ $item->id}})">
                                <div class="icheck-primary d-inline">
                                    <input data-category="{{ $item->category }}"
                                        onclick="checked_category({{ $item->id}})" id="category[{{ $item->id}}]"
                                        name="category[{{ $item->id}}]" type="checkbox">
                                    <label for="category[{{ $item->id}}]" style="font-family: sans-serif;">
                                        {{ $item->category }}
                                    </label>
                                    <label class="float-right">
                                        {{ $item->question_count }}
                                        <i class="fas fa-angle-right"></i>
                                    </label>
                                    {{-- <div class="progress progress-xxs">
                                        <div class="progress-bar progress-bar-danger progress-bar-striped" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%">
                                        <span class="sr-only">60% Complete (warning)</span>
                                        </div>
                                    </div> --}}
                                </div>
                            </div>
                            @endforeach
                        </div>
                        <div class="col-lg-3 col-md-6 col-sm-12 col-12 p-0 group style-3 "
                            style="border-style: solid;border-width:thin ">
                            <div class="py-2 px-2 border-bottom"
                                style="background: linear-gradient(#206dda, #1b5cb8); text-align: center">
                                <label
                                    style="color:white; font-family: sans-serif; font-weight: normal !important;">Kategori
                                </label>
                            </div>
                            <div class="second_category style-3" id="second_category">

                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 col-sm-12 col-12 p-0 group style-3"
                            style="border-style: solid;border-width:thin ">
                            <div class="py-2 px-2 border-bottom"
                                style="background: linear-gradient(#206dda, #1b5cb8); text-align: center">
                                <label
                                    style="color:white; font-family: sans-serif; font-weight: normal !important;">Kategori
                                </label>
                            </div>
                            <div class="third_category" id="third_category">

                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 col-sm-12 col-12 p-0 group style-3"
                            style="border-style: solid;border-width:thin ">
                            <div class="py-2 px-2 border-bottom"
                                style="background: linear-gradient(#206dda, #1b5cb8); text-align: center">
                                <label
                                    style="color:white; font-family: sans-serif; font-weight: normal !important;">Kategori
                                </label>
                            </div>
                            <div class="fourth_category" id="fourth_category">

                            </div>
                        </div>
                        <div class="col-lg-12 p-0" id="btn-group" style="margin-top:10px">
                            <div class="btn-category" id="btn-category">

                            </div>
                            {{-- <button class="btn btn-primary style" >Kategori </button> --}}
                        </div>
                        <div class="col-lg-12 p-0" style="margin-top:10px">
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
                        <div class="row align-items-center">
                            <div style="text-align: center" class="col-lg-2 col-md-6 col-sm-12 col-12 py-1">
                                <a id="countQuestion" style="font-weight: bold;font-size: 30px; display: block;">
                                    0
                                </a>
                                <a style="font-size: 18px;"> Flash Card </a>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12 col-12 py-1">
                                <div class="progress" style="height: 40px; border-radius: 30px">
                                    <div class="progress-bar progress-bar-striped" role="progressbar" style="width: 20%"
                                        aria-valuenow="10" aria-valuemin="0" aria-valuemax="100">20 %
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-2 col-md-6 col-sm-12 col-12 py-1">
                                <select onchange="limitQuestion()" disabled id="limit_question" class="form-control">
                                    <option value="" selected disabled>Maksimal Soal</option>
                                    <option value="10">10</option>
                                    <option value="25">25</option>
                                    <option value="40">40</option>
                                    <option value="50">50</option>
                                    <option value="100">100</option>
                                    <option value="250">250</option>
                                </select>
                            </div>
                            <div class="col-lg-2 col-md-6 col-sm-12 col-12 py-1">
                                <button disabled id="btn_limit" class="btn btn-block btn-primary" data-toggle="modal"
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
                <form action="{{ route('flashcard.start') }}" id="ringkasan" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="container-fluid">
                            <div class="row">
                                <input type="text" id="data_quiz" name="data" value="">
                                <input type="hidden" id="limit" name="limit" value="">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div class="container-fluid">
                            <button type="submit" id="start" data-url="{{ route('flashcard.start') }}"
                                class="btn btn-primary btn-md float-right">Mulai</button>
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
    $(document).ready(function() {
            sessionStorage.clear();
        });

        limitQuestion = () => {
            d = document.getElementById("limit_question").value;
            document.getElementById("limit").value = d;
        }

        let QC = [];
        let QC_result = 0;

        $("#start").click(function(e) {
            e.preventDefault();

            let url = $(this).data('url');

            key = Object.keys(sessionStorage);
            console.log("ini key : ", key);
            data = "";
            var dataArray = "";
            for (let index = 0; index < key.length; index++) {
                const element = key[index];
                // console.log("ini element : ", key[index]);
                if (index === key.length - 1)
                    data = data + '"' + element + '":' + sessionStorage.getItem(element);
                else
                    data = data + '"' + element + '":' + sessionStorage.getItem(element) + ',';
            }

            // data = '{"data":{' + data + '}}';
            data = "{" + data + "}";
            // console.log("ini gabungan element : ",data);
            console.log('url', url);
            var rute = url;
            console.log("ini gabungan element : ", data);
            document.getElementById("data_quiz").value = data;
            sessionStorage.clear();
            document.getElementById("ringkasan").submit();

        });

        function checkQC(data) {
            for (let index = 0; index < QC.length; index++) {
                console.log('QCC : ', QC[index].id);
                if (data.level == 4) {
                    if (data.third_parent_id == QC[index].id)
                        return 1;
                } else if (data.level == 3) {
                    if (data.second_parent_id == QC[index].id)
                        return 1;
                } else if (data.level == 2) {
                    if (data.parent_id == QC[index].id)
                        return 1;
                }

                if (data.level == 1) {
                    if (QC[index].parent_id == data.id)
                    {
                        for (let index = 0; index < QC.length; index++) {
                            if(QC[index].parent_id == data.id){
                                QC.splice(index, 1);
                                console.log('qcc hapus', QC);
                            }
                        }

                        QC_result = 0;
                        for (let index = 0; index < QC.length; index++) {
                            QC_result = QC_result+QC[index].question_count;
                            console.log('qc result hapus', QC_result);
                            document.getElementById('countQuestion').innerHTML = QC_result;//response.question_count;
                        }
                        return 0;
                    }
                }

                if (data.level == 2) {
                    if (QC[index].second_parent_id == data.id)
                    {
                        for (let index = 0; index < QC.length; index++) {
                            if(QC[index].second_parent_id == data.id){
                                QC.splice(index, 1);
                                console.log('qcc hapus', QC);
                            }
                        }

                        QC_result = 0;
                        for (let index = 0; index < QC.length; index++) {
                            QC_result = QC_result+QC[index].question_count;
                            console.log('qc result hapus', QC_result);
                            document.getElementById('countQuestion').innerHTML = QC_result;//response.question_count;
                        }
                        return 0;
                    }
                }

                if (data.level == 3) {
                    if (QC[index].third_parent_id == data.id)
                    {
                        for (let index = 0; index < QC.length; index++) {
                            if(QC[index].third_parent_id == data.id){
                                QC.splice(index, 1);
                                console.log('qcc hapus', QC);
                            }
                        }

                        QC_result = 0;
                        for (let index = 0; index < QC.length; index++) {
                            console.log('sebelum di hitung', QC_result);
                            QC_result = QC_result+QC[index].question_count;
                            console.log('index qc count', QC[index].question_count);
                            console.log('qc result hapus', QC_result);
                            document.getElementById('countQuestion').innerHTML = QC_result;//response.question_count;
                        }
                        return 0;
                    }
                }
                // if (QC[index].id == data.id)
                //     return 1;
            }
            return 0;
        }


        checked_category = (id) => {
            var rute = "{{ url('flashcard-selected') }}/" + id;
            checkbox_id = 'category['+id+']';
            var checkboxes = document.getElementById(checkbox_id);
            // console.log(checkboxes);
            document.getElementById('btn_limit').disabled = false;
            document.getElementById('limit_question').disabled = false;

            if(checkboxes.checked){
                $.ajax({
                    url: rute,
                    type: 'get',
                    success: function(response) {
                        console.log('ini ceked : ',response);
                        var data =  '<button class="btn btn-primary btn-sm style" data-button="delete" name="btn['+response.id+']" id="btn['+response.id+']" style="margin-left:2px;margin-right:2px" > '+ response.category +' </button>';
                        var buttonId = 'btn['+response.id+']';
                        var buttonLabel = document.getElementById(buttonId);
                        if(buttonLabel == null){
                            sessionStorage.setItem(response.id, response.parent_id);
                            $(".btn-category").append(data);
                        }

                        $.ajax({
                            type: 'post',
                            url: 'flashcard-selected-count',
                            data: {
                                "id": response.id,
                                "level": response.level,
                                "_token": "{{ csrf_token() }}"
                            },
                            success: function(response) {

                                console.log('ini response : ',response);

                                checkQC(response);

                                // for (let index = 0; index < QC.length; index++) {
                                if(checkQC(response) == 0){
                                    QC.push(response);
                                    QC_result = QC_result+response.question_count;
                                }
                                // }
                                console.log('count : ',QC);
                                console.log('count result QC : ',QC_result);
                                document.getElementById('countQuestion').innerHTML = QC_result;//response.question_count;
                            }
                        });
                    }
                });
            } else {
                rute = "{{ url('flashcard-unselected') }}/" + id;
                btn_id = 'btn['+id+']';
                var btn = document.getElementById(btn_id);
                btn.remove();

                // console.log('222222 : ',btn_id);
                sessionStorage.removeItem(id);
                for (let index = 0; index < QC.length; index++) {
                    if(QC[index].id == id){
                        QC.splice(index, 1);
                        console.log('qcc hapus', QC);
                    }
                }
                QC_result = 0;
                for (let index = 0; index < QC.length; index++) {
                    QC_result = QC_result+QC[index].question_count;
                    console.log('qc result hapus', QC_result);
                }
                document.getElementById('countQuestion').innerHTML = QC_result;//response.question_count;
                $.ajax({
                    url: rute,
                    type: 'get',
                    success: function(response) {
                        $.each(response, function(key, value) {
                            btn_id = 'btn['+value.id+']';
                            btn = document.getElementById(btn_id);
                            if(btn != null){

                                btn.remove();
                                sessionStorage.removeItem(value.id);
                            }


                        //     rute = "{{ url('flashcard-unselected') }}/" + value.id;
                        //     btn_id = 'btn['+value.id+']';
                        //     btn = document.getElementById(btn_id);

                        //     $.ajax({
                        //         url: rute,
                        //         type: 'get',
                        //         success: function(response) {
                        //             console.log('ini on button 3333: ', response);
                        //             $.each(response, function(key, value) {

                        //                 btn_id = 'btn['+value.id+']';
                        //                 btn = document.getElementById(btn_id);
                        //                 if(btn != null){
                        //                     btn.remove();
                        //                     sessionStorage.removeItem(value.id);
                        //                 }
                        //                 rute = "{{ url('flashcard-unselected') }}/" + value.id;
                        //                 btn_id = 'btn['+value.id+']';
                        //                 btn = document.getElementById(btn_id);

                        //                 $.ajax({
                        //                     url: rute,
                        //                     type: 'get',
                        //                     success: function(response) {
                        //                         // console.log('ini on button 4444: ', response);
                        //                         $.each(response, function(key, value) {

                        //                             btn_id = 'btn['+value.id+']';

                        //                             btn = document.getElementById(btn_id);
                        //                                 console.log();
                        //                             if(btn != null){
                        //                                 btn.remove();
                        //                                 sessionStorage.removeItem(value.id);
                        //                             }
                        //                             document.getElementById('limit_question').disabled = true;

                        //                             document.getElementById('btn_limit').disabled = true;
                        //                         });
                        //                     }
                        //                 });
                        //             });
                        //         }
                        //     });
                        });
                    }
                });
            }
        }

        first_category = (id) => {
            document.getElementById('second_category').innerHTML =  'Loading...';

            document.getElementById('third_category').innerHTML = "";
            document.getElementById('fourth_category').innerHTML = "";

            var rute = "{{ url('flashcard-second-categories') }}/" + id;
            $.ajax({
                url: rute,
                type: 'get',
                success: function(response) {
                    document.getElementById('second_category').innerHTML = "";

                    console.log('ini on button : ', response);
                    $.each(response, function(key, value) {
                        var data = '<div class="py-2 px-2 hover border-bottom"  onclick="third_category('+ value.id +')">'+
                                        '<div class="icheck-primary d-inline">'+
                                            '<input data-category="'+value.category+'"  onclick="checked_category('+ value.id +')" id="category['+ value.id +']" name="category['+ value.id +']" type="checkbox">'+
                                            '<label for="category['+ value.id +']" style="font-family: sans-serif;">'
                                                + value.category +
                                            '</label>'+
                                            '<label class="float-right"> '+ value.question_count + ' <i class="fas fa-angle-right"></i></label>'
                                        '</div>'+
                                    '</div>';
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

                    // console.log('ini on button : ', response);
                    $.each(response, function(key, value) {
                        var data =  '<div class="py-2 px-2 hover border-bottom"  onclick="third_category('+ value.id +')">'+
                                        '<div class="custom-control custom-checkbox">'+
                                            '<input class="custom-control-input hover" data-category="'+value.category+'" onclick="checked_category('+ value.id +')" id="category['+ value.id +']" name="second_category['+ value.id +']" type="checkbox">'+
                                            '<label style="font-family: sans-serif;" class="cursor-pointer hover  custom-control-label" for="category['+ value.id +']">'+ value.category +'</label>'+
                                            '<label class="float-right"> '+ value.question_count + ' <i class="fas fa-angle-right"></i></label>'+
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

            var rute = "{{ url('flashcard-third-categories') }}/" + id;
            $.ajax({
                url: rute,
                type: 'get',
                success: function(response) {
                    document.getElementById('third_category').innerHTML = "";

                    // console.log('ini on button : ', response);
                    $.each(response, function(key, value) {
                        // console.log('ini on value : ', value);
                        var data = '<div class="py-2 px-2 hover border-bottom"  onclick="fourth_category('+ value.id +')">'+
                                        '<div class="icheck-primary d-inline">'+
                                            '<input data-category="'+value.category+'"  onclick="checked_category('+ value.id +')" id="category['+ value.id +']" name="category['+ value.id +']" type="checkbox">'+
                                            '<label for="category['+ value.id +']" style="font-family: sans-serif;">'
                                                + value.category +
                                            '</label>'+
                                            '<label class="float-right"> '+ value.question_count + ' <i class="fas fa-angle-right"></i></label>'+
                                        '</div>'+
                                    '</div>';
                        $(".third_category").append(data);
                    });
                }
            });
        }

        fourth_category = (id) => {
            document.getElementById('fourth_category').innerHTML = "Loading...";

            var rute = "{{ url('flashcard-fourth-categories') }}/" + id;
            $.ajax({
                url: rute,
                type: 'get',
                success: function(response) {
                    document.getElementById('fourth_category').innerHTML = "";

                    // console.log('ini on button : ', response);
                    $.each(response, function(key, value) {
                        // console.log('ini on value : ', value);
                        var data = '<div class="py-2 px-2 hover border-bottom" >'+
                                        '<div class="icheck-primary d-inline">'+
                                            '<input data-category="'+value.category+'"  onclick="checked_category('+ value.id +')" id="category['+ value.id +']" name="category['+ value.id +']" type="checkbox">'+
                                            '<label for="category['+ value.id +']" style="font-family: sans-serif;">'
                                                + value.category +
                                            '</label>'+
                                            '<label class="float-right"> '+ value.question_count +
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

            QC = [];
            QC_result = 0;
            document.getElementById('countQuestion').innerHTML = QC_result;

            var btn = document.getElementById('btn-category');
            btn.remove();
            var data = '<div class="btn-category" id="btn-category"></div>';
            $("#btn-group").append(data);
            sessionStorage.clear();
            document.getElementById('btn_limit').disabled = true;
            document.getElementById('limit_question').disabled = true;


        });

        checkAll = (ele) => {
        var checkboxes = document.getElementsByTagName('input');
            // if (ele.checked) {
            //     for (var i = 0; i < checkboxes.length; i++) {
            //         if (checkboxes[i].type == 'checkbox') {
            //             checkboxes[i].checked = false;
            //             btn_id = 'btn['+i+']';
            //             var btn = document.getElementById(btn_id);

                        console.log('btn : ', btn);
            //             if(btn != null)
            //                 btn.remove();
            //         }
            //     }
            //     for (var i = 0; i < checkboxes.length; i++) {
            //         if (checkboxes[i].type == 'checkbox' ) {
            //             checkboxes[i].checked = true;
                        console.log('select all : ',checkboxes[i].getAttribute("id"));
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

                    // console.log('btn : ', i);
                    if(btn != null){
                        btn.remove();
                    }
                    // if(i == 6){
                    //     btn_id = 'btn['+ i+1 +']';
                        console.log('btn 7 : ', btn_id);

                    //     btn = document.getElementById(btn_id);
                    //     btn.remove();
                    // }

                }
            }
        }
</script>
@endpush