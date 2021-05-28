
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <div class="container-fluid">
                    <span style="font-size: 20px" id="exampleModalLongTitle">
                        Biodata
                    </span>
                </div>
            </div>
            @php
                $authProfile = App\Models\Profile::where('user_id',Auth::user()->id)->first();
            @endphp
            <form action="{{ route('updateProfile', Auth::user()->id) }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="row">
                            <!-- Name Field -->
                            <div class="form-group col-sm-12 col-md-12 col-lg-12 col-xs-12">
                                <label for="">Username</label>
                                <input type="text" value="{{ Auth::user()->name }}" placeholder="username"
                                    class="form-control" name="name">
                            </div>

                            <!-- Email Field -->
                            <div class="form-group col-sm-12 col-md-12 col-lg-12 col-xs-12">
                                <label for="">email</label>
                                <input type="text" value="{{ Auth::user()->email ?? '' }}" placeholder="email"
                                    class="form-control" name="email">
                            </div>

                            <!-- Password Field -->
                            <div class="form-group col-sm-12 col-md-12 col-lg-12 col-xs-12">
                                <label for="">Kata Sandi</label>
                                <input type="text" placeholder="Biarkan kosong jika tidak ingin mengubah kata sandi"
                                    class="form-control" name="password">
                            </div>

                            <!-- Full Name Field -->
                            <div class="form-group col-sm-12 col-md-12 col-lg-12 col-xs-12">
                                <label for="">Nama Lengkap</label>
                                <input type="text" placeholder="Nama Lengkap" value="{{ $authProfile->full_name ?? '' }}"
                                    class="form-control" name="full_name">
                            </div>

                            <!-- Address Field -->
                            <div class="form-group col-sm-12 col-md-12 col-lg-12 col-xs-12">
                                <label for="">Alamat</label>
                                <input type="text" value="{{ $authProfile->address ?? '' }}" placeholder="Alamat"
                                    class="form-control" name="address">
                            </div>

                            <!-- Phone Number Field -->
                            <div class="form-group col-sm-12 col-md-12 col-lg-12 col-xs-12">
                                <label for="">Nomor Hp</label>
                                <input type="text" value="{{ $authProfile->phone_number ?? '' }}" placeholder="Nomor Hp"
                                    class="form-control" name="phone_number">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="container-fluid">
                        <button type="submit" class="btn btn-primary btn-md float-right" data-togglebtn="tooltip"
                            data-placement="top" title="Simpan"><i class="fas fa-save"></i></button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="exampleModalCenter2" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <div class="container-fluid">
                    <span style="font-size: 20px" id="exampleModalLongTitle">
                        Tambahkan Foto
                    </span>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>
            <form action="{{ route('updateProfile', Auth::user()->id) }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="row">
                            <!-- Name Field -->
                            <div class="form-group col-sm-12 col-md-12 col-lg-12 col-xs-12">
                                <input type="file" name="file" id="file" accept="image/*">
                            </div>
                        </div>
                    </div>
                </div>

            </form>
        </div>
    </div>
</div>
