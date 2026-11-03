<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDonationLogRequest;
use App\Http\Requests\UpdateDonationLogRequest;
use App\Models\Campaign;
use App\Models\Donor;
use App\Models\DonationLog;
use App\Models\Phlebotomist;
use App\Services\DonationService;

class DonationLogController extends Controller
{
    public function __construct(
        private DonationService $service
    ) {}

   public function index()
{
    $donationLogs = \App\Models\DonationLog::with([
        'donor',
        'campaign',
        'phlebotomist'
    ])
    ->latest()
    ->paginate(10);

    return view('donation_logs.index', compact('donationLogs'));
}
    public function create()
    {
        $donors = Donor::orderBy('donor_name')->get();
        $campaigns = Campaign::orderByDesc('drive_date')->get();
        $phlebotomists = Phlebotomist::orderBy(
            'phlebotomist_name'
        )->get();

        return view('donation_logs.create', compact(
            'donors',
            'campaigns',
            'phlebotomists'
        ));
    }

    public function store(StoreDonationLogRequest $request)
    {
        $this->service->createDonationLog(
            $request->validated()
        );

        return redirect()
            ->route('donation-logs.index')
            ->with('success', 'Donation log created successfully.');
    }

    public function update(UpdateDonationLogRequest $request, $id)
    {
        $log = DonationLog::findOrFail($id);

        $this->service->updateDonationLog(
            $log,
            $request->validated()
        );

        return redirect()
            ->route('donation-logs.index')
            ->with('success', 'Donation log updated successfully.');
    }
}