                    @foreach ($classrooms as $item)
                        <div class="col-lg-6 col-sm-12 col-md-12">
                            <div class="card card-primary card-outline" >
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
                                                {{ substr($item->description, 0, 70) }} <br> <a style="font-size: 13px"
                                                    href="{{ url('class-detail/') }}/{{ $item->slug }}">Selengkapnya...</a>
                                            </p>
                                        </div>
                                        <div class="col-3 text-center">
                                            @if(is_null(App\Models\Media::where('media_type', 'user')->where('media_id', $item->created_by)->latest('created_at')->first()))
                                            <img src="{{ asset('files/') }}/{{App\Models\Media::where('media_type', 'user')->where('media_id', $item->created_by)->latest('created_at') ->first()->file_name ?? 'avatar.png'}}"
                                                class="img-circle img-fluid" />
                                            @else
                                                <img src="{{ asset('avatar.png') }}"
                                                    class="img-circle img-fluid" />
                                            @endif
                                            {{ App\Models\User::find($item->created_by)->name }}
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer" style="border-radius: 10px; background-color: #ffff">
                                    <div class="row">
                                        <div class="col-4">
                                           <div class="text-left">
                                                <a style="font-size: 13px">
                                                    {{ App\Models\TeachingPeriod::find($item->teaching_period_id)->first()->name }}
                                                </a>
                                           </div>
                                        </div>
                                        <div class="col-8">
                                            <a href="{{ url('class-detail/') }}/{{ $item->slug }}"
                                                class="btn btn-sm btn-primary float-right" >
                                                Lihat Kelas
                                            </a>
                                            <a class="btn btn-sm bg-teal float-right" style="margin-right: 3px">
                                                <strong>
                                                    {{ App\Models\ClassroomUser::where('classroom_id', $item->id)->count() }}
                                                </strong>&nbsp;Bergabung
                                            </a>
                                       </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach