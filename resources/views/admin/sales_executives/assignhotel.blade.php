<div class="content-wrapper pl-3">
    <h1>Assigned Hotels</h1>
    <table class="card-body table table-bordered">
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Location</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($assignData as $hotel)
                <tr>
                    <td>{{ $hotel->name }}</td>
                    <td>{{ $hotel->email }}</td>
                    <td>{{ $hotel->location }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
