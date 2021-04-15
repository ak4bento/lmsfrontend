@extends('frontend.layouts.app') @section('content')
<div class="container">
    <div class="jumbotron jumbotron-fluid text-white" style="background-color: #174ea6">
        <div class="container">
            <h1 class="display-4">Discover</h1>
            <p class="lead">Temukan kelas terbaik untuk anda.</p>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 col-lg-12 col-sm-12">
            <div class="row">
                <div class="col-lg-3 col-md-12 col-sm-12" style="margin-bottom:10px;">
                    <div class="row">
                        <div class="col-12">
                            <div class="card card-primary card-outline">
                                <div class="card-body box-profile">
                                    <div class="btn-group btn-block">
                                        <button type="button" class="btn btn-primary">1</button>
                                        <button type="button" class="btn btn-default">2</button>
                                        <button type="button" class="btn btn-primary">3</button>
                                        <button type="button" class="btn btn-default">4</button>
                                        <button type="button" class="btn btn-primary">5</button>
                                    </div>
                                    <div class="btn-group btn-block">
                                        <button type="button" class="btn btn-primary">6</button>
                                        <button type="button" class="btn btn-default">7</button>
                                        <button type="button" class="btn btn-default">8</button>
                                        <button type="button" class="btn btn-primary">9</button>
                                        <button type="button" class="btn btn-primary">10</button>
                                    </div>
                                    <div class="btn-group btn-block">
                                        <button type="button" class="btn btn-primary">11</button>
                                        <button type="button" class="btn btn-default">12</button>
                                        <button type="button" class="btn btn-primary">13</button>
                                        <button type="button" class="btn btn-primary">14</button>
                                        <button type="button" class="btn btn-default">15</button>
                                    </div>
                                    <div class="btn-group btn-block">
                                        <button type="button" class="btn btn-default">16</button>
                                        <button type="button" class="btn btn-default">17</button>
                                        <button type="button" class="btn btn-primary">18</button>
                                        <button type="button" class="btn btn-primary">19</button>
                                        <button type="button" class="btn btn-primary">20</button>
                                    </div>
                                </div>
                                <!-- /.card-body -->
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <!-- Profile Image -->
                            <div class="card card-primary card-outline">
                                <div class="card-body box-profile">
                                    <h1 class="text-center">56:30</h1>
                                </div>
                                <!-- /.card-body -->
                            </div>
                            <!-- /.card -->
                            <a href="quiz_submit.html">
                                <button type="button" class="btn btn-block btn-warning btn-lg">Submit</button>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-9 col-md-12 col-sm-12">
                    <div class="row">
                        <div class="col-md-12">
                            <!-- Box Comment -->
                            <div class="card card-widget">
                                <div class="card-header">
                                    <div class="user-block">
                                        <img class="img-circle" src="https://img.icons8.com/carbon-copy/2x/file.png"
                                            alt="User Image">
                                        <span class="username"><a href="#">Question 17</a></span>
                                        <span class="description">of 20</span>
                                    </div>
                                    <!-- /.user-block -->
                                    <div class="card-tools">
                                        <button type="button" class="btn btn-primary">
                                            <i class="fas fa-angle-left"></i>
                                        </button>
                                        <button type="button" class="btn btn-primary">
                                            <i class="fas fa-angle-right"></i>
                                        </button>
                                    </div>
                                    <!-- /.card-tools -->
                                </div>
                                <!-- /.card-header -->
                            </div>
                            <!-- /.card -->
                        </div>
                        <!-- /.col -->
                        <div class="col-md-12">
                            <!-- Box Comment -->
                            <div class="card card-widget">
                                <div class="card-body">
                                    <!-- post text -->
                                    <p>Far far away, behind the word mountains, far from the
                                        countries Vokalia and Consonantia, there live the blind
                                        texts. Separated they live in Bookmarksgrove right at</p>

                                    <p>the coast of the Semantics, a large language ocean.
                                        A small river named Duden flows by their place and supplies
                                        it with the necessary regelialia. It is a paradisematic
                                        country, in which roasted parts of sentences fly into
                                        your mouth.</p>
                                </div>
                            </div>
                            <!-- /.card -->
                        </div>
                        <!-- /.col -->
                        <!-- /.col -->
                        <div class="col-md-12">
                            <!-- Box Comment -->
                            <div class="card card-widget">
                                <div class="card-body">
                                    <!-- radio -->
                                    <div class="form-group" style="font-size: large;">
                                        <div class="custom-control custom-radio">
                                            <input class="custom-control-input" type="radio" id="customRadio1"
                                                name="customRadio">
                                            <label for="customRadio1" class="custom-control-label">Custom Radio</label>
                                        </div>
                                        <hr>
                                        <div class="custom-control custom-radio">
                                            <input class="custom-control-input" type="radio" id="customRadio2"
                                                name="customRadio">
                                            <label for="customRadio2" class="custom-control-label">Custom Radio
                                                checked</label>
                                        </div>
                                        <hr>
                                        <div class="custom-control custom-radio">
                                            <input class="custom-control-input" type="radio" id="customRadio3"
                                                name="customRadio">
                                            <label for="customRadio3" class="custom-control-label">Custom Radio</label>
                                        </div>
                                        <hr>
                                        <div class="custom-control custom-radio">
                                            <input class="custom-control-input" type="radio" id="customRadio4"
                                                name="customRadio">
                                            <label for="customRadio4" class="custom-control-label">Custom Radio
                                                checked</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card -->
                        </div>
                        <!-- /.col -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection