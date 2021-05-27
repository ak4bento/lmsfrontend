<div class="card card-outline card-primary">
    <div class="card-header">
        Kelas Yang Sedang Dipelajari
        <br>
        Berikut ini adalah daftar kelas yang kamu ikuti. Mengalami kesusahan untuk menyelesaikannya? Pelajari tips belajar di SIPS.
    </div>
    <div class="card-body">

        @forelse (DB::table('classroom_user')->where('user_id', Auth::user()->id)->where('deleted_at', null)->get() as $class)
            @php
                $teachables = DB::table('teachables')
                    ->select('teachables.*')
                    ->where('teachables.classroom_id',$class->classroom_id)
                    ->where('teachables.deleted_at',null)
                    ->orderBy('teachables.created_at','DESC')
                    ->count();

                if(is_null($teachables) || $teachables==0)
                    $teachables = 1;

                $progress = DB::table('progress')
                    ->select('*')
                    ->where('class_id',$class->classroom_id)
                    ->where('user_id',Auth::user()->id)
                    ->count();
            @endphp
            @if (($progress / $teachables * 100) != 100)
            <div class="card">
                <div class="card-header">
                    <strong>
                        <a href="{{ route('classroom.detail', App\Models\Classroom::find($class->classroom_id)->slug) }}"
                            data-togglebtn="tooltip" data-placement="top" title="Lihat Kelas">
                            {{ App\Models\Classroom::find($class->classroom_id)->title }}
                        </a>
                    </strong>
                </div>
                <div class="card-body">
                    <div class="progress">
                        <div class="progress-bar progress-bar-striped" role="progressbar" style="width: {{ $progress / $teachables * 100 }}%"
                            aria-valuenow="10" aria-valuemin="0" aria-valuemax="100">{{ number_format($progress / $teachables * 100, 1) }} %
                        </div>
                    </div>
                </div>
            </div>
            @endif
        @empty
            Data kelas anda kosong
        @endforelse
    </div>
    <!-- /.card-body -->
</div>
<div class="card card-outline card-primary">
    <div class="card-header">
        Kelas Yang Telah Diselesaikan
    </div>
    <div class="card-body">

        @forelse (DB::table('classroom_user')->where('user_id', Auth::user()->id)->where('deleted_at', null)->get() as $class)
            @php
                $teachables = DB::table('teachables')
                    ->select('teachables.*')
                    ->where('teachables.classroom_id',$class->classroom_id)
                    ->where('teachables.deleted_at',null)
                    ->orderBy('teachables.created_at','DESC')
                    ->count();

                if(is_null($teachables) || $teachables==0)
                    $teachables = 1;

                $progress = DB::table('progress')
                    ->select('*')
                    ->where('class_id',$class->classroom_id)
                    ->where('user_id',Auth::user()->id)
                    ->count();
            @endphp
            @if (($progress / $teachables * 100) == 100)
            <div class="card">
                <div class="card-header">
                    <strong>
                        <a href="{{ route('classroom.detail', App\Models\Classroom::find($class->classroom_id)->slug) }}"
                            data-togglebtn="tooltip" data-placement="top" title="Lihat Kelas">
                            {{ App\Models\Classroom::find($class->classroom_id)->title }}
                        </a>
                    </strong>
                </div>
                <div class="card-body">
                    <div class="progress">
                        <div class="progress-bar progress-bar-striped" role="progressbar" style="width: {{ $progress / $teachables * 100 }}%"
                            aria-valuenow="10" aria-valuemin="0" aria-valuemax="100">{{ number_format($progress / $teachables * 100, 1) }} %
                        </div>
                    </div>
                </div>
            </div>
            @endif
        @empty
            Data kelas anda kosong
        @endforelse
    </div>
    <!-- /.card-body -->
</div>
<div class="card card-outline card-primary">
    <div class="card-header">
        Rekomendasi SIPS Terbaru
        <br>
        Berikut adalah rekomendasi kelas sesuai dengan minat belajar Anda. Pelajari sekarang juga!
    </div>
    <div class="card-body" style="padding: 35px;">
        <section class="regular slider">
            @forelse ($classroom as $item)
                <div style="padding: 10px">
                    <div class="card card-primary card-outline" style="min-height: 230px" >
                        <div class="card-header text-muted border-bottom-0">
                            <div class="row">
                                {{ $item->subject }}
                            </div>
                        </div>
                        <div class="card-body pt-0">
                            <div class="row">
                                <div class="col-12">
                                    <div class="row">
                                        <a href="{{route('classroom.detail',$item->slug)}}"
                                            target="_blank"
                                            class="title-hover tooltips">
                                            @if (strlen($item->title) < 30)
                                                {{ $item->title }}
                                            @else
                                                {{ substr($item->title,0,30) }}...
                                            @endif
                                        </a>
                                    </div>
                                </div>
                                <div class="col-12 text-center">
                                    @if(is_null(App\Models\Media::where('media_type', 'user')->where('media_id', $item->created_by)->latest('created_at')->first()))
                                    <img src="{{ asset('files/') }}/{{App\Models\Media::where('media_type', 'user')->where('media_id', $item->created_by)->latest('created_at') ->first()->file_name ?? 'avatar.png'}}"
                                        height="50px" width="50px" class="img-circle img-fluid" />
                                    @else
                                        <img src="{{ asset('avatar.png') }}"
                                        height="50px" width="50px" class="img-circle img-fluid" />
                                    @endif
                                    {{ App\Models\User::find($item->created_by)->name }}
                                </div>
                            </div>
                        </div>
                        <div class="card-footer" style="border-radius: 10px; background-color: #ffff">
                            <div class="row">
                                <div class="col-12">
                                    <a href="{{route('classroom.detail',$item->slug)}}"
                                        class="btn btn-xs btn-primary float-right" >
                                        Lihat Kelas
                                    </a>
                                    <a class="btn btn-xs bg-teal float-right" style="margin-right: 3px">
                                        <strong>
                                            {{ App\Models\ClassroomUser::where('classroom_id', $item->id)->count() }}
                                        </strong>&nbsp;Bergabung
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div>
                    <img src="https://via.placeholder.com/150/000000/FFFFFF/?text=SIPS">
                </div>
            @endforelse
        </section>
    </div>
</div>

