@push('page_css')
    <link href="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.css" rel="stylesheet">
    <link href="https://unpkg.com/filepond/dist/filepond.css" rel="stylesheet" />
@endpush
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
                                <input type="text" value="{{ $user->email ?? '' }}" placeholder="email"
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
                                <input type="text" placeholder="Nama Lengkap" value="{{ $profile->full_name ?? '' }}"
                                    class="form-control" name="full_name">
                            </div>

                            <!-- Address Field -->
                            <div class="form-group col-sm-12 col-md-12 col-lg-12 col-xs-12">
                                <label for="">Alamat</label>
                                <input type="text" value="{{ $profile->address ?? '' }}" placeholder="Alamat"
                                    class="form-control" name="address">
                            </div>

                            <!-- Phone Number Field -->
                            <div class="form-group col-sm-12 col-md-12 col-lg-12 col-xs-12">
                                <label for="">Nomor Hp</label>
                                <input type="text" value="{{ $profile->phone_number ?? '' }}" placeholder="Nomor Hp"
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
@push('page_scripts')
    <script src="https://unpkg.com/filepond-plugin-file-validate-type/dist/filepond-plugin-file-validate-type.js"></script>
    <script src="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.js"></script>
    <script src="https://unpkg.com/filepond-plugin-image-crop/dist/filepond-plugin-image-crop.js"></script> 
    <script src="https://unpkg.com/filepond-plugin-file-validate-size/dist/filepond-plugin-file-validate-size.js"></script>
    <script src="https://unpkg.com/filepond-plugin-image-transform/dist/filepond-plugin-image-transform.js"></script>
    <script src="https://unpkg.com/filepond/dist/filepond.js"></script>
    <script>
        const inputElement = document.querySelector('input[id="file"]');
        FilePond.registerPlugin(FilePondPluginFileValidateType);
        FilePond.registerPlugin(FilePondPluginImagePreview);
        FilePond.registerPlugin(FilePondPluginImageCrop);
        FilePond.registerPlugin(FilePondPluginFileValidateSize);
        FilePond.registerPlugin(FilePondPluginImageTransform);
        const pond = FilePond.create( 
            inputElement,
            { 
                
                allowFileSizeValidation:true,
                maxFileSize:2048000,
                allowImageCrop:true,
                imageCropAspectRatio:'1:1',
                allowImagePreview:true,
                labelFileSizeNotAvailable:'',
                labelIdle:'Drag & Drop your file or <span class="filepond--label-action"> Browse </span>',
                acceptedFileTypes: ['image/png'],
                fileValidateTypeDetectType: (source, type) => new Promise((resolve, reject) => {
                    resolve(type);
                })
            },
            {
                imageResizeTargetWidth: 600,
                imageCropAspectRatio: 1,
                imageTransformVariants: {
                    thumb_medium_: (transforms) => {
                    transforms.resize = {
                        size: {
                        width: 384,
                        height: 384,
                        },
                    };
                    return transforms;
                    },
                    thumb_small_: (transforms) => {
                    transforms.resize = {
                        size: {
                        width: 128,
                        height: 128,
                        },
                    };
                    return transforms;
                    },
                },
            } 
        );
        
        FilePond.setOptions({
            server: {
                url : 'avatar-upload/',
                method: 'POST',
                headers :{
                   'X-CSRF-TOKEN':'{{ csrf_token() }}'
                }
            }
        });
    </script>
    <script>
        $(document).ready(function() {
            $('[data-togglebtn="tooltip"]').tooltip();
        });

    </script>
@endpush
