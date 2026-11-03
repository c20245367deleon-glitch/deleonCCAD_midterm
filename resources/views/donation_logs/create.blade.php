
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Record Donation</title>
</head>
<body>
    <h1>Record Donation</h1>

    @if ($errors->any())
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <form action="{{ route('donation-logs.store') }}" method="POST">
        @csrf

        <label>Donor</label>
        <select name="donor_id" required>
            <option value="">Select donor</option>
            @foreach ($donors as $donor)
                <option value="{{ $donor->id }}"
                    @selected(old('donor_id') == $donor->id)>
                    {{ $donor->donor_name }} ({{ $donor->blood_type }})
                </option>
            @endforeach
        </select>

        <label>Campaign</label>
        <select name="campaign_id" required>
            <option value="">Select campaign</option>
            @foreach ($campaigns as $campaign)
                <option value="{{ $campaign->id }}"
                    @selected(old('campaign_id') == $campaign->id)>
                    {{ $campaign->campaign_location }}
                    — {{ $campaign->drive_date->format('Y-m-d') }}
                </option>
            @endforeach
        </select>

        <label>Phlebotomist</label>
        <select name="phlebotomist_id" required>
            <option value="">Select phlebotomist</option>
            @foreach ($phlebotomists as $person)
                <option value="{{ $person->id }}"
                    @selected(old('phlebotomist_id') == $person->id)>
                    {{ $person->phlebotomist_name }}
                </option>
            @endforeach
        </select>

        <label>Hemoglobin (g/dL)</label>
        <input type="number" step="0.1" min="0"
               name="hemoglobin_level"
               value="{{ old('hemoglobin_level') }}" required>

        <label>Blood Pressure</label>
        <input type="text" name="blood_pressure"
               placeholder="120/80"
               value="{{ old('blood_pressure') }}" required>

        <label>Volume (mL)</label>
        <input type="number" name="volume_ml" min="1"
               value="{{ old('volume_ml') }}">

        <button type="submit">Save Donation Log</button>
    </form>

    <p>
        <a href="{{ route('donation-logs.index') }}">Back to Logs</a>
    </p>
</body>
</html>
