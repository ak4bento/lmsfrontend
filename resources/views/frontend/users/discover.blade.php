@extends('frontend.layouts.app')

@section('content')
    <div class="container">
        <div class="jumbotron jumbotron-fluid text-white p-5" style="background: linear-gradient(#206dda, #1b5cb8);border-radius:10px">
            <div class="container ">
                <div class="row">
                    <a style="font-size: 2.5em">Discover</a>
                </div>
                <div class="row">
                    <a style="font-size: 1.5em">Temukan kelas terbaik untuk anda.</a>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4 col-lg-3 col-sm-12">
                <div class="card fixme">
                    <form action="?" method="get">
                        <div class="card-body">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text sm"><i class="fas fa-search"></i></span>
                                </div>
                                <input type="text" class="form-control form-control-sm" id="search" name="search"
                                    placeholder="Cari Kelas" />
                            </div>
                            <ul class="list-group list-group-unbordered mb-3">

                                @foreach ($subjects as $subject)
                                    <div class="form-group clearfix">
                                        <div class="icheck-primary d-inline">
                                            <input type="checkbox" name="{{ $subject->id }}"
                                                id="checkboxPrimary{{ $subject->id }}">
                                            <label for="checkboxPrimary{{ $subject->id }}" style="font-size:13px">
                                                {{ $subject->title }}
                                            </label>
                                        </div>
                                    </div>
                                @endforeach
                            </ul>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-lg-9 col-md-8 col-sm-12">
                <div class="row" id="post-data">
                    @include('frontend.users.card_classroom_discover')
                </div>
                <div class="ajax-load text-center" style="display: none">
                    <img src="{{ asset('preview.gif') }}" width="100px">
                </div>
            </div>
        </div>
    </div>
@endsection
@push('page_scripts')
    <script>
        $(document.body).on('touchmove', onScroll);
        $(window).on('scroll', onScroll);

        function loadMoreData(page){
            $.ajax({
                url:'/discover/ajax?page='+page,
                type:'get',
                beforeSend:function(){
                    $('.ajax-load').show();
                }
            })
            .done(function(data){
                if(data.html == ""){
                    $('.ajax-load').html("");
                    return;
                }
                $('.ajax-load').hide();
                $("#post-data").append(data.html);
            })
            .fail(function(jqXHR,ajaxOptions,thrownError){
                alert("server not res");
            });
        }
        var page = 1;
        function onScroll(){
            // if($(window).scrollTop() >= ($(document).height() - $(window).height())) {
            if( $(window).scrollTop() + window.innerHeight >= document.body.scrollHeight ){
                console.log('jalan 1')
                page++;
                loadMoreData(page);
            }
        }

        $(document).ready(function() {
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>
@endpush
