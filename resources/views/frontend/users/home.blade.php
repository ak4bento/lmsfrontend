@extends('frontend.layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-3">

                <!-- Profile Image -->
                <div class="card card-primary card-outline">
                    <div class="card-body box-profile">
                        <div class="text-center">
                            <img class="profile-user-img img-fluid img-circle"
                                src="{{ asset('dist/img/user4-128x128.jpg') }}" alt="User profile picture">
                        </div>

                        <h3 class="profile-username text-center">{{ Auth::user()->name }}</h3>

                        <p class="text-muted text-center">
                            @foreach (Auth::user()->getRoleNames() as $roles)
                                {{ $roles }}
                            @endforeach
                        </p>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->

                <!-- About Me Box -->
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Profil Saya</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <strong><i class="fas fa-user mr-1"></i> Nama lengkap</strong>

                        <p class="text-muted">
                            {{ $profile->full_name ?? '' }}
                        </p>

                        <hr>

                        <strong><i class="fas fa-map-marker-alt mr-1"></i> Alamat</strong>

                        <p class="text-muted">{{ $profile->address ?? '' }}</p>

                        <hr>

                        <strong><i class="fas fa-mobile mr-1"></i> Telepon</strong>

                        <p class="text-muted">
                        <p>{{ $profile->phone_number ?? '' }}</p>
                        </p>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->

                <!-- About Me Box -->
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Kelas Saya</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        @forelse (DB::table('classroom_user')->where('user_id', Auth::user()->id)->get() as $class)
                            <i class="far fa-circle">
                                {{ App\Models\Classroom::find($class->classroom_id)->title }}</i><br>
                        @empty
                            Data kelas anda kosong
                        @endforelse
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
            <div class="col-md-9">
                <!-- Default box -->
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Projects Detail</h3>

                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                            <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12 col-md-12 col-lg-12 order-2 order-md-1">
                                <div class="row">
                                    <div class="col-12 col-sm-4">
                                        <div class="info-box bg-light">
                                            <div class="info-box-content">
                                                <span class="info-box-text text-center text-muted">Estimated
                                                    budget</span>
                                                <span class="info-box-number text-center text-muted mb-0">2300</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-4">
                                        <div class="info-box bg-light">
                                            <div class="info-box-content">
                                                <span class="info-box-text text-center text-muted">Total
                                                    amount spent</span>
                                                <span class="info-box-number text-center text-muted mb-0">2000</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-4">
                                        <div class="info-box bg-light">
                                            <div class="info-box-content">
                                                <span class="info-box-text text-center text-muted">Estimated
                                                    project duration</span>
                                                <span class="info-box-number text-center text-muted mb-0">20</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <!-- Box Comment -->
                                        <div class="card card-widget">
                                            <div class="card-header">
                                                <div class="user-block">
                                                    <img class="img-circle"
                                                        src="{{ asset('dist/img/user1-128x128.jpg') }}" alt="User Image">
                                                    <span class="username"><a href="#">Jonathan Burke
                                                            Jr.</a></span>
                                                    <span class="description">Shared publicly - 7:30 PM
                                                        Today</span>
                                                </div>
                                                <!-- /.user-block -->
                                                <div class="card-tools">
                                                    <button type="button" class="btn btn-tool" title="Mark as read">
                                                        <i class="far fa-circle"></i>
                                                    </button>
                                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                                        <i class="fas fa-minus"></i>
                                                    </button>
                                                    <button type="button" class="btn btn-tool" data-card-widget="remove">
                                                        <i class="fas fa-times"></i>
                                                    </button>
                                                </div>
                                                <!-- /.card-tools -->
                                            </div>
                                            <!-- /.card-header -->
                                            <div class="card-body">
                                                <!-- post text -->
                                                <p>Far far away, behind the word mountains, far from the
                                                    countries Vokalia and Consonantia, there live the blind
                                                    texts. Separated they live in Bookmarksgrove right at
                                                </p>

                                                <p>the coast of the Semantics, a large language ocean.
                                                    A small river named Duden flows by their place and
                                                    supplies
                                                    it with the necessary regelialia. It is a paradisematic
                                                    country, in which roasted parts of sentences fly into
                                                    your mouth.</p>

                                                <!-- Attachment -->
                                                <div class="attachment-block clearfix">
                                                    <img class="attachment-img" src="dist/img/photo1.png"
                                                        alt="Attachment Image">

                                                    <div class="attachment-pushed">
                                                        <h4 class="attachment-heading"><a
                                                                href="https://www.lipsum.com/">Lorem ipsum
                                                                text generator</a></h4>

                                                        <div class="attachment-text">
                                                            Description about the attachment can be placed
                                                            here.
                                                            Lorem Ipsum is simply dummy text of the printing
                                                            and typesetting industry... <a href="#">more</a>
                                                        </div>
                                                        <!-- /.attachment-text -->
                                                    </div>
                                                    <!-- /.attachment-pushed -->
                                                </div>
                                                <!-- /.attachment-block -->

                                                <!-- Social sharing buttons -->
                                                <button type="button" class="btn btn-default btn-sm"><i
                                                        class="fas fa-share"></i> Share</button>
                                                <button type="button" class="btn btn-default btn-sm"><i
                                                        class="far fa-thumbs-up"></i> Like</button>
                                                <span class="float-right text-muted">45 likes - 2
                                                    comments</span>
                                            </div>
                                            <!-- /.card-body -->
                                            <div class="card-footer card-comments">
                                                <div class="card-comment">
                                                    <!-- User image -->
                                                    <img class="img-circle img-sm"
                                                        src="{{ asset('dist/img/user3-128x128.jpg') }}" alt="User Image">

                                                    <div class="comment-text">
                                                        <span class="username">
                                                            Maria Gonzales
                                                            <span class="text-muted float-right">8:03 PM
                                                                Today</span>
                                                        </span><!-- /.username -->
                                                        It is a long established fact that a reader will be
                                                        distracted
                                                        by the readable content of a page when looking at
                                                        its layout.
                                                    </div>
                                                    <!-- /.comment-text -->
                                                </div>
                                                <!-- /.card-comment -->
                                                <div class="card-comment">
                                                    <!-- User image -->
                                                    <img class="img-circle img-sm"
                                                        src="{{ asset('dist/img/user5-128x128.jpg') }}" alt="User Image">

                                                    <div class="comment-text">
                                                        <span class="username">
                                                            Nora Havisham
                                                            <span class="text-muted float-right">8:03 PM
                                                                Today</span>
                                                        </span><!-- /.username -->
                                                        The point of using Lorem Ipsum is that it hrs a
                                                        morer-less
                                                        normal distribution of letters, as opposed to using
                                                        'Content here, content here', making it look like
                                                        readable English.
                                                    </div>
                                                    <!-- /.comment-text -->
                                                </div>
                                                <!-- /.card-comment -->
                                            </div>
                                            <!-- /.card-footer -->
                                            <div class="card-footer">
                                                <form action="#" method="post">
                                                    <img class="img-fluid img-circle img-sm"
                                                        src="{{ asset('dist/img/user4-128x128.jpg') }}" alt="Alt Text">
                                                    <!-- .img-push is used to add margin to elements next to floating images -->
                                                    <div class="img-push">
                                                        <input type="text" class="form-control form-control-sm"
                                                            placeholder="Press enter to post comment">
                                                    </div>
                                                </form>
                                            </div>
                                            <!-- /.card-footer -->
                                        </div>
                                        <!-- /.card -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
@endsection
