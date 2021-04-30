@extends('frontend.layouts.app') @section('content')
    <div class="container">
        <div class="jumbotron jumbotron-fluid text-white" style="background-color: #174ea6;border-radius: 10px ;">
            <div class="container">
                <h1 class="display-4"><strong>Discover</strong> </h1>
                <p class="lead">Temukan kelas terbaik untuk anda.</p>
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
                <div class="row">
                    @foreach ($classrooms as $item)
                        <div class="col-lg-6 col-sm-12 col-md-12">
                            <div class="card bg-light card-primary card-outline">
                                <div class="card-header text-muted border-bottom-0">
                                    <label>
                                        {{ $item->subject }}
                                    </label>
                                </div>
                                <div class="card-body pt-0">
                                    <div class="row">
                                        <div class="col-9">
                                            <label class="lead">{{ $item->title }}</label>
                                            <p>
                                                {{ substr($item->description, 0, 70) }} <br> <a
                                                    href="{{ url('class-detail/') }}/{{ $item->slug }}">Selengkapnya...</a>
                                            </p>
                                        </div>
                                        <div class="col-3 text-center">
                                            <img src="dist/img/user1-128x128.jpg" alt="user-avatar"
                                                class="img-squre img-fluid" style="border-radius: 10px" />
                                            {{ App\Models\User::find($item->created_by)->name }}
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer bg-light">
                                    <div class="text-right">
                                        <a href="#" class="btn btn-sm bg-teal">
                                            <strong>
                                                {{ App\Models\ClassroomUser::where('classroom_id', $item->id)->count() }}
                                            </strong>&nbsp;Bergabung
                                        </a>
                                        <a href="{{ url('class-detail/') }}/{{ $item->slug }}"
                                            class="btn btn-sm btn-primary">
                                            Lihat Kelas
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
