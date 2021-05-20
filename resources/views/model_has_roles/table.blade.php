<div class="table-responsive">
    <table id="example2" class="table table-bordered">
        <thead>
            <tr>
                <th>Wewenang</th>
                <th>Pengguna</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($modelHasRoles as $modelHasRole)
            <tr>
                <td>{{ App\Models\Role::find($modelHasRole->role_id)->name }}</td>
                <td>{{ App\Models\User::find($modelHasRole->model_id)->name }}</td>

            </tr>
            @endforeach
        </tbody>
    </table>
</div>
