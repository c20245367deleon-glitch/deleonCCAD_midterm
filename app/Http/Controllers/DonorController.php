<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDonorRequest;
use App\Http\Requests\UpdateDonorRequest;
use App\Models\Donor;
use App\Services\DonationService;

class DonorController extends Controller
{
    public function __construct(
        private DonationService $service
    ) {}

    public function index()
    {
        $donors = Donor::withCount('donationLogs')
            ->latest()
            ->paginate(10);

        return view('donors.index', compact('donors'));
    }

    public function create()
    {
        return view('donors.create');
    }

    public function store(StoreDonorRequest $request)
    {
        $this->service->createDonor($request->validated());

        return redirect()
            ->route('donors.index')
            ->with('success', 'Donor created successfully.');
    }

    public function update(UpdateDonorRequest $request, $id)
    {
        $donor = Donor::findOrFail($id);

        $this->service->updateDonor(
            $donor,
            $request->validated()
        );

        return redirect()
            ->route('donors.index')
            ->with('success', 'Donor updated successfully.');
    }
}