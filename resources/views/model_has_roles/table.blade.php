<div class="table-responsive">
    <table class="table" id="modelHasRoles-table">
        <thead>
            <tr>
                <th>Model Type</th>
                <th>Model Id</th>
                <th>Role Id</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($modelHasRoles as $modelHasRole)
                <tr>
                    <td>{{ $modelHasRole->model_type }}</td>
                    <td>{{ $modelHasRole->model_id }}</td>
                    <td>{{ $modelHasRole->role_id }}</td>

                </tr>
            @endforeach
        </tbody>
    </table>
</div>
