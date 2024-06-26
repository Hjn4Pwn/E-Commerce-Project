<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreFlavorRequest;
use App\Http\Requests\UpdateFlavorRequest;
use App\Models\Flavor;
use App\Services\Interfaces\FlavorServiceInterface;

class FlavorController extends Controller
{
    protected $flavorService;

    public function __construct(
        FlavorServiceInterface $flavorService
    ) {
        $this->flavorService = $flavorService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $flavors = $this->flavorService->getAll();
        return view('admin.pages.flavor.flavors', [
            'flavors' => $flavors,
            'page' => 'Flavors',
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.pages.flavor.createFlavor', [
            'parentPage' => ['Flavors', 'admin.flavors.index'],
            'childPage' => 'Create',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreFlavorRequest $request)
    {
        $validatedData = $request->validated();
        if ($this->flavorService->store($validatedData)) {
            return redirect()->route('admin.flavors.index')->with('success', 'Create Flavor successfully');
        }
        return back()->withErrors('Failed to create flavor.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Flavor $flavor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Flavor $flavor)
    {
        return view('admin.pages.flavor.editFlavor', [
            'flavor' => $flavor,
            'parentPage' => ['Flavors', 'admin.flavors.index'],
            'childPage' => 'Edit',
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateFlavorRequest $request, Flavor $flavor)
    {
        $validatedData = $request->validated();
        if ($this->flavorService->update($flavor, $validatedData)) {
            return redirect()->route('admin.flavors.index')->with('success', 'Update Flavor successfully');
        }
        return back()->withErrors('Failed to update flavor.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Flavor $flavor)
    {
        if ($this->flavorService->delete($flavor)) {
            return redirect()->route('admin.flavors.index')->with('success', 'Delete flavor successfully');
        }
        return back()->withErrors('Failed to delete flavor and its products.');
    }
}
