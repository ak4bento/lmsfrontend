<div class="card card-outline card-primary">
    <div class="card-header">
        Bagaimana proses belajar anda?
    </div>
    <div class="card-body">

        @forelse (DB::table('classroom_user')->where('user_id', Auth::user()->id)->where('deleted_at', null)->get() as $class)

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
                    <div class="progress">
                        <div class="progress-bar progress-bar-striped" role="progressbar" style="width: {{ $progress / $teachables * 100 }}%"
                            aria-valuenow="10" aria-valuemin="0" aria-valuemax="100">{{ $progress / $teachables * 100 }} %
                        </div>
                    </div>
                </div>
            </div>
        @empty
            Data kelas anda kosong
        @endforelse
    </div>
    <!-- /.card-body -->
</div>
