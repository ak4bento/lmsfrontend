@extends('frontend.layouts.app') @section('content')
    <div class="container">
        <section class="content-header">
            <div class="row">
                <div class="col-md-12 col-lg-12 col-xl-12">
                    <div class="card mb-2">
                        <img class="card-img-top" src="{{ asset('dist/img/Group.png') }}" alt="Dist Photo 3"
                            height="250px">
                        <div class="card-img-overlay">
                            <h1 class="card-title text-white">Handwork or handcrafts</h1>
                            <p class="card-text pb-1 pt-1 text-white">
                                Softskill <br>
                                PHP
                            </p>
                            <a href="#" class="text-white">Last update 3 days ago</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">
                                        About
                                    </h3>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <dl>
                                        <dt>Description lists</dt>
                                        <dd>A description list is perfect for defining terms.</dd>
                                        <dt>Euismod</dt>
                                        <dd>Vestibulum id ligula porta felis euismod semper eget lacinia odio sem nec
                                            elit.</dd>
                                        <dd>Donec id elit non mi porta gravida at eget metus.</dd>
                                        <dt>Malesuada porta</dt>
                                        <dd>Etiam porta sem malesuada magna mollis euismod.</dd>
                                    </dl>
                                </div>
                                <!-- /.card-body -->
                            </div>
                            <!-- /.card -->

                            <!-- USERS LIST -->
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Teacher</h3>

                                    <div class="card-tools">
                                        <span class="badge badge-danger">8 New Members</span>
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                            <i class="fas fa-minus"></i>
                                        </button>
                                        <button type="button" class="btn btn-tool" data-card-widget="remove">
                                            <i class="fas fa-times"></i>
                                        </button>
                                    </div>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body p-0">
                                    <ul class="users-list clearfix">
                                        <li>
                                            <img src="{{ asset('dist/img/user1-128x128.jpg') }}" alt="User Image">
                                            <a class="users-list-name" href="#">Alexander Pierce</a>
                                            <span class="users-list-date">Today</span>
                                        </li>
                                        <li>
                                            <img src="{{ asset('dist/img/user8-128x128.jpg') }}" alt="User Image">
                                            <a class="users-list-name" href="#">Norman</a>
                                            <span class="users-list-date">Yesterday</span>
                                        </li>
                                        <li>
                                            <img src="{{ asset('dist/img/user7-128x128.jpg') }}" alt="User Image">
                                            <a class="users-list-name" href="#">Jane</a>
                                            <span class="users-list-date">12 Jan</span>
                                        </li>
                                        <li>
                                            <img src="{{ asset('dist/img/user6-128x128.jpg') }}" alt="User Image">
                                            <a class="users-list-name" href="#">John</a>
                                            <span class="users-list-date">12 Jan</span>
                                        </li>
                                        <li>
                                            <img src="{{ asset('dist/img/user2-160x160.jpg') }}" alt="User Image">
                                            <a class="users-list-name" href="#">Alexander</a>
                                            <span class="users-list-date">13 Jan</span>
                                        </li>
                                        <li>
                                            <img src="{{ asset('dist/img/user5-128x128.jpg') }}" alt="User Image">
                                            <a class="users-list-name" href="#">Sarah</a>
                                            <span class="users-list-date">14 Jan</span>
                                        </li>
                                        <li>
                                            <img src="{{ asset('dist/img/user4-128x128.jpg') }}" alt="User Image">
                                            <a class="users-list-name" href="#">Nora</a>
                                            <span class="users-list-date">15 Jan</span>
                                        </li>
                                        <li>
                                            <img src="{{ asset('dist/img/user3-128x128.jpg') }}" alt="User Image">
                                            <a class="users-list-name" href="#">Nadia</a>
                                            <span class="users-list-date">15 Jan</span>
                                        </li>
                                    </ul>
                                    <!-- /.users-list -->
                                </div>
                                <!-- /.card-body -->
                                <div class="card-footer text-center">
                                    <a href="javascript:">View All Users</a>
                                </div>
                                <!-- /.card-footer -->
                            </div>
                            <!--/.card -->

                            <!-- USERS LIST -->
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Student</h3>

                                    <div class="card-tools">
                                        <span class="badge badge-danger">8 New Members</span>
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                            <i class="fas fa-minus"></i>
                                        </button>
                                        <button type="button" class="btn btn-tool" data-card-widget="remove">
                                            <i class="fas fa-times"></i>
                                        </button>
                                    </div>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body p-0">
                                    <ul class="users-list clearfix">
                                        <li>
                                            <img src="{{ asset('dist/img/user1-128x128.jpg') }}" alt="User Image">
                                            <a class="users-list-name" href="#">Alexander Pierce</a>
                                            <span class="users-list-date">Today</span>
                                        </li>
                                        <li>
                                            <img src="{{ asset('dist/img/user8-128x128.jpg') }}" alt="User Image">
                                            <a class="users-list-name" href="#">Norman</a>
                                            <span class="users-list-date">Yesterday</span>
                                        </li>
                                        <li>
                                            <img src="{{ asset('dist/img/user7-128x128.jpg') }}" alt="User Image">
                                            <a class="users-list-name" href="#">Jane</a>
                                            <span class="users-list-date">12 Jan</span>
                                        </li>
                                        <li>
                                            <img src="{{ asset('dist/img/user6-128x128.jpg') }}" alt="User Image">
                                            <a class="users-list-name" href="#">John</a>
                                            <span class="users-list-date">12 Jan</span>
                                        </li>
                                        <li>
                                            <img src="{{ asset('dist/img/user2-160x160.jpg') }}" alt="User Image">
                                            <a class="users-list-name" href="#">Alexander</a>
                                            <span class="users-list-date">13 Jan</span>
                                        </li>
                                        <li>
                                            <img src="{{ asset('dist/img/user5-128x128.jpg') }}" alt="User Image">
                                            <a class="users-list-name" href="#">Sarah</a>
                                            <span class="users-list-date">14 Jan</span>
                                        </li>
                                        <li>
                                            <img src="{{ asset('dist/img/user4-128x128.jpg') }}" alt="User Image">
                                            <a class="users-list-name" href="#">Nora</a>
                                            <span class="users-list-date">15 Jan</span>
                                        </li>
                                        <li>
                                            <img src="{{ asset('dist/img/user3-128x128.jpg') }}" alt="User Image">
                                            <a class="users-list-name" href="#">Nadia</a>
                                            <span class="users-list-date">15 Jan</span>
                                        </li>
                                    </ul>
                                    <!-- /.users-list -->
                                </div>
                                <!-- /.card-body -->
                                <div class="card-footer text-center">
                                    <a href="javascript:">View All Users</a>
                                </div>
                                <!-- /.card-footer -->
                            </div>
                            <!--/.card -->
                        </div>
                        <!-- /.col -->
                        <div class="col-md-9">
                            <!-- Box Comment -->
                            <div class="card card-widget">
                                <div class="card-header">
                                    <div class="user-block">
                                        <img class="img-circle" src="{{ asset('dist/img/user1-128x128.jpg') }}"
                                            alt="User Image">
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
                                    <p>
                                        Request join the class
                                    </p>
                                    <p>
                                        <button class="btn btn-lg btn-primary">JOIN THIS CLASS</button>
                                    </p>

                                    <!-- Social sharing buttons -->
                                    <button type="button" class="btn btn-default btn-sm"><i class="fas fa-share"></i>
                                        Share</button>
                                    <button type="button" class="btn btn-default btn-sm"><i class="far fa-thumbs-up"></i>
                                        Like</button>
                                    <span class="float-right text-muted">45 likes</span>
                                </div>
                            </div>
                            <!-- /.card -->
                        </div>
                        <!-- /.col -->
                    </div>
                </div>
            </div>
            <!-- /.row -->
        </section>
    </div>
@endsection
