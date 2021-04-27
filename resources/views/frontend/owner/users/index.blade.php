@extends('frontend.layouts.app')

@section('content')
    <div class="container">
        <div class="row ">
            <section class="content-header col-lg-12">
                <div class="row mb-2">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-sm-6">
                                <h1>Pengguna</h1>
                            </div>
                            <div class="col-sm-6">
                                <ol class="breadcrumb float-sm-right">
                                    <li class="breadcrumb-item"><a href="{{ url('/home') }}">Home</a></li>
                                    <li class="breadcrumb-item active">
                                        <a href="{{ route('classroom.detail', $classroom->slug) }}">Kelas</a>
                                    </li>
                                    <li class="breadcrumb-item active">
                                        Pengguna
                                    </li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <div class="content col-lg-12 col-sm-12 col-md-12">
                <div class="row">
                    @include('adminlte-templates::common.errors')
                    <div class="col-lg-12 col-sm-12 col-md-12">
                        <div class="card">
                            <div class="card-header card-outline card-primary">
                                <div class="d-flex justify-content-between">
                                    <p class="card-title">Pengajar</p>
                                    <!-- Button trigger modal -->
                                    <button type="button" class="btn btn-primary btn-sm" data-toggle="modal"
                                        data-target="#exampleModalCenter">
                                        Tambah
                                    </button>

                                    <!-- Modal -->
                                    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog"
                                        aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <form action="{{ route('storeTeacher', $classroom->slug) }}"
                                                    method="POST">
                                                    @csrf
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLongTitle">
                                                            Tambah Pengajar
                                                        </h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="form-group col-sm-12">
                                                            <select name="user_id" class="form-control select2" id="user_id"
                                                                style="width: 100%;">
                                                                @foreach (App\Models\User::all() as $data)
                                                                    <option {{ $data->id }} value="{{ $data->id }}">
                                                                        {{ $data->name }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-dismiss="modal">Tutup</button>
                                                        <input type="submit" value="Simpan" class="btn btn-primary">
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row align-items-center ">
                                    <div class="col-lg-12 col-md-12 col-sm-12 ">
                                        @foreach ($classroomUser as $item)
                                            <div class="row align-items-center">
                                                <table style="width: 100%">
                                                    <tr>
                                                        <td width="50px">
                                                            <div class="icheck-primary d-inline">
                                                                <input type="checkbox" name="{{ $item->id }}"
                                                                    id="{{ $item->id }}">
                                                                <label for="{{ $item->id }}" style="font-size:13px">
                                                                </label>
                                                            </div>
                                                        </td>
                                                        <td width="60px">
                                                            <img src="{{ asset('sejawat-logo-mobile.png') }}"
                                                                style="width: 30px" alt="">
                                                        </td>
                                                        <td style="width: 85%">
                                                            <label>{{ $item->name }}</label>
                                                        </td>
                                                        <td>
                                                            <a href="" class="btn btn-sm btn-danger"><i
                                                                    class="fa fa-trash"></i></a>
                                                        </td>
                                                    </tr>
                                                </table>
                                            </div>
                                            <hr>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-header card-outline card-primary">
                                <div class="d-flex justify-content-between">
                                    <p class="card-title">Murid</p>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row align-items-center ">
                                    <div class="col-lg-12 col-md-12 col-sm-12 ">
                                        @foreach ($classroomUser as $item)
                                            <div class="row align-items-center">
                                                <table style="width: 100%">
                                                    <tr>
                                                        <td width="50px">
                                                            <div class="icheck-primary d-inline">
                                                                <input type="checkbox" name="{{ $item->id }}"
                                                                    id="{{ $item->id }}">
                                                                <label for="{{ $item->id }}" style="font-size:13px">
                                                                </label>
                                                            </div>
                                                        </td>
                                                        <td width="60px">
                                                            <img src="{{ asset('sejawat-logo-mobile.png') }}"
                                                                style="width: 30px" alt="">
                                                        </td>
                                                        <td style="width: 85%">
                                                            <label>{{ $item->name }}</label>
                                                        </td>
                                                        <td>
                                                            <a href="" class="btn btn-sm btn-danger"><i
                                                                    class="fa fa-trash"></i></a>
                                                        </td>
                                                    </tr>
                                                </table>
                                            </div>
                                            <hr>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
