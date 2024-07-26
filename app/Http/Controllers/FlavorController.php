<?php

namespace App\Http\Controllers;

use App\Http\Requests\SearchRequest;
use App\Http\Requests\StoreFlavorRequest;
use App\Http\Requests\UpdateFlavorRequest;
use App\Models\Flavor;
use App\Services\Interfaces\FlavorServiceInterface;
use Illuminate\Http\Request;

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

    public function index(SearchRequest $request)
    {
        $search = $request->input('search');
        $flavors = $this->flavorService->getAllFlavors($search);
        return view('admin.pages.flavor.index', [
            'flavors' => $flavors,
            'page' => 'Flavors',
            'search' => $search
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.pages.flavor.create', [
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
        if ($this->flavorService->storeFlavor($validatedData)) {
            return redirect()->route('admin.flavors.index')->with('success', 'Create Flavor successfully');
        }
        return back()->withErrors('Failed to create flavor.');
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Flavor $flavor)
    {
        return view('admin.pages.flavor.edit', [
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
        if ($this->flavorService->updateFlavor($flavor, $validatedData)) {
            return redirect()->route('admin.flavors.index')->with('success', 'Update Flavor successfully');
        }
        return back()->withErrors('Failed to update flavor.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Flavor $flavor)
    {
        if ($this->flavorService->deleteFlavor($flavor)) {
            return redirect()->route('admin.flavors.index')->with('success', 'Delete flavor successfully');
        }
        return back()->withErrors('Failed to delete flavor.');
    }
}
