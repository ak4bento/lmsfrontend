<div class="table-responsive">
    <table id="example2" class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Username</th>
                <th>Email</th> 
                <th>Nama Lengkap</th> 
                <th>Alamat</th> 
                <th>Nomor Hp</th> 
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($userStudents as $userStudent)
            <tr>
                <td>{{ $userStudent->name }}</td>
                <td>{{ $userStudent->email }}</td>  
                <td>{{ App\Models\Profile::where('user_id',$userStudent->id)->first()->full_name }}</td>  
                <td>{{ App\Models\Profile::where('user_id',$userStudent->id)->first()->address }}</td>  
                <td>{{ App\Models\Profile::where('user_id',$userStudent->id)->first()->phone_number }}</td>  
                <td width="120">
                    {!! Form::open(['route' => ['userStudents.destroy', $userStudent->id], 'method' => 'delete']) !!}
                    <!-- <div class='btn-group'> -->
                        <a href="{{ route('userStudents.show', [$userStudent->id]) }}" class='btn btn-default btn-sm'>
                            <i class="far fa-eye"></i>
                        </a>
                        <a href="{{ route('userStudents.edit', [$userStudent->id]) }}" class='btn btn-primary btn-sm'>
                            <i class="far fa-edit"></i>
                        </a>
                        {!! Form::button('<i class="far fa-trash-alt"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-sm', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    <!-- </div> -->
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
