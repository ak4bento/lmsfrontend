@extends('frontend.layouts.app')

@section('content')
    <div class="container">
        <div class="jumbotron jumbotron-fluid text-white" style="background-color: #174ea6;border-radius: 10px ;">
            <div class="container">
                <h1 class="display-4">Kelas</h1>
                <p class="lead">Temukan kelas yang anda ikuti.</p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3">
                <!-- About Me Box -->
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
                        <!-- /.card-body -->
                    </form>
                </div>
                <!-- /.card -->
            </div>
            <div class="col-md-9">
                <!-- Default box -->
                <div class="card card-solid">
                    <div class="card-body pb-0">
                        <div class="row d-flex align-items-stretch">
                            @forelse ($classrooms as $item)
                                <div class="col-12 col-sm-6 col-md-6 d-flex align-items-stretch">
                                    <div class="card bg-light">
                                        <div class="card-header text-muted border-bottom-0">
                                            {{ $item->subject }}
                                        </div>
                                        <div class="card-body pt-0">
                                            <div class="row">
                                                <div class="col-7">
                                                    <label class="lead">{{ $item->title }}</label>

                                                    {{ substr($item->description, 0, 100) }} <a
                                                        href="{{ url('class-detail/') }}/{{ $item->slug }}">read
                                                        more</a>...
                                                </div>
                                                <div class="col-5 text-center">
                                                    <img src="dist/img/user1-128x128.jpg" alt="user-avatar"
                                                        class="img-circle img-fluid" />
                                                    {{ App\Models\User::find($item->created_by)->name }}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-footer">
                                            <div class="text-right">
                                                <a href="#" class="btn btn-sm bg-teal">
                                                    <strong>
                                                        {{ App\Models\ClassroomUser::where('classroom_id', $item->id)->count() }}
                                                    </strong>&nbsp;Joined
                                                </a>
                                                <a href="{{ url('class-detail/') }}/{{ $item->slug }}"
                                                    class="btn btn-sm btn-primary">
                                                    View Classes
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="col-12 col-sm-6 col-md-6 d-flex align-items-stretch">
                                    <div class="card bg-light">
                                        <div class="card-header text-muted border-bottom-0">
                                            Anda Belum mengikuti kelas.
                                        </div>
                                        <div class="card-body pt-0">
                                            <div class="row">
                                                Silahkan join di kelas yang ada melalui menu Discover atau klik link berikut
                                                ini. <a href="/discover">pergi ke DISCOVER</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforelse
                        </div>
                    </div>
                    <!-- /.card-body -->

                    <!-- /.card-footer -->
                    <div class="card-footer">
                        <nav aria-label="Contacts Page Navigation">
                            <ul class="pagination justify-content-center m-0">
                                <li class="page-item active"><a class="page-link" href="#">1</a></li>
                                <li class="page-item"><a class="page-link" href="#">2</a></li>
                                <li class="page-item"><a class="page-link" href="#">3</a></li>
                                <li class="page-item"><a class="page-link" href="#">4</a></li>
                                <li class="page-item"><a class="page-link" href="#">5</a></li>
                                <li class="page-item"><a class="page-link" href="#">6</a></li>
                                <li class="page-item"><a class="page-link" href="#">7</a></li>
                                <li class="page-item"><a class="page-link" href="#">8</a></li>
                            </ul>
                        </nav>
                    </div>
                    <!-- /.card-footer -->
                </div>
                <!-- /.card -->
            </div>
        </div>
    </div>
@endsection
