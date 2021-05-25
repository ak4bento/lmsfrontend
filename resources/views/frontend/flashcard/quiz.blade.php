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
	<div class="row">
		<div class="col-12">
			<div class="card py-2 px-2">
                <div class="row justify-content-between">
                    <div class="col-2">
                        <button type="button" class="btn btn-primary">
                            <i class="fas fa-angle-left"></i> 
                        </button>
                    </div>
                    <div class="col-8  align-self-center" style="text-align: center">
                        1 dari 10
                    </div>
                    <div class="col-2">
                        <button type="button" class="btn btn-primary float-right ">
                             <i class="fas fa-angle-right"></i> 
                        </button>
                    </div>
                </div>
			</div>
		</div>
    </div>
    <section class="content">
        <div class="row">
            <div class="col-lg-12">
                <div class="row">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card card-widget card-primary card-outline">
                                    <div class="card-header">
                                        <span class="card-title" style="font-size: 15px">
                                            Diterbitkan - 
                                        </span>
                                    </div>
                                    <div class="card-body">
                                        @foreach ($questions as $question)
                                            <p>
                                                {{ $question->id }}
                                            </p>
                                        @endforeach
                                    </div>
                                </div>
                                {{ $questions->links() }}
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
                        var data =  '<div class="py-2 px-2 hover border-bottom"  onclick="third_category('+ value.id +')">'+
                                        '<div class="custom-control custom-checkbox">'+
                                            '<input class="custom-control-input hover" id="second_category['+ value.id +']" name="second_category['+ value.id +']" type="checkbox">'+
                                            '<label style="font-family: sans-serif; font-weight: normal !important;" class="cursor-pointer hover d-block custom-control-label" for="second_category['+ value.id +']">'+ value.category +'</label>'+
                                        '</div>'+
                                    '</div>';
                        $(".second_category").append(data);
                    });
                }
            });
        }
    
	</script>
@endpush
