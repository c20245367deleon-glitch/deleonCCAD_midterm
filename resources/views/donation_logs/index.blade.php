<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blood Donation System - Donors</title>
</head>
<body>

    <h1>Blood Donation System</h1>
    <h2>Donor List</h2>

    <a href="{{ route('donors.create') }}">Add New Donor</a>

    <table border="1" cellpadding="10">
        <thead>
            <tr>
                <th>ID</th>
                <th>Donor Name</th>
                <th>Blood Type</th>
            </tr>
        </thead>

        <tbody>
            @forelse ($donors as $donor)
                <tr>
                    <td>{{ $donor->id }}</td>
                    <td>{{ $donor->donor_name }}</td>
                    <td>{{ $donor->blood_type }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="3">No donors found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    {{ $donors->links() }}

</body>
</html>
