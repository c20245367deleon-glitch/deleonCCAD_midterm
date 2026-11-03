
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Donors</title>
</head>
<body>
    <h1>Blood Donation - Donors</h1>

    @if (session('success'))
        <p>{{ session('success') }}</p>
    @endif

    <p><a href="{{ route('donors.create') }}">Add Donor</a></p>

    <table border="1" cellpadding="8">
        <thead>
            <tr>
                <th>ID</th>
                <th>Donor Name</th>
                <th>Blood Type</th>
                <th>Donation Logs</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($donors as $donor)
                <tr>
                    <td>{{ $donor->id }}</td>
                    <td>{{ $donor->donor_name }}</td>
                    <td>{{ $donor->blood_type }}</td>
                    <td>{{ $donor->donation_logs_count }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="4">No donors found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    {{ $donors->links() }}
</body>
</html>
