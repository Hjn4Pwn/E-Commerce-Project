<?php

namespace App\Services;

use App\Models\Flavor;
use App\Models\Product;
use App\Models\ProductFlavor;
use App\Services\Interfaces\FlavorServiceInterface;
use Illuminate\Support\Facades\DB;

/**
 * Class FlavorService
 * @package App\Services
 */
class FlavorService implements FlavorServiceInterface
{
    public function getAll()
    {
        return Flavor::all();
    }

    public function store($validatedData)
    {
        return Flavor::create($validatedData);
    }

    public function update(Flavor $flavor, $validatedData)
    {
        return $flavor->update($validatedData);
    }

    public function delete(Flavor $flavor)
    {
        return $flavor->delete();
    }

    public function storeProductFlavor(Product $product, $flavor_id)
    {
        return $product->flavors()->create([
            'flavor_id' => $flavor_id,
        ]);
    }

    public function getFlavorsByProduct(Product $product)
    {
        // Eager load the flavors relation
        $flavors = $product->flavors()->with('flavor')->get();

        // Collect flavor details
        $flavorDetails = $flavors->map(function ($productFlavor) {
            return $productFlavor->flavor;
        });

        return $flavorDetails;
    }

    public function getFlavorsWithCheckedStatus(Product $product)
    {
        $allFlavors = Flavor::all();

        $productFlavorIds = $product->flavors()->pluck('flavor_id')->toArray();

        $flavorsWithCheckedStatus = $allFlavors->map(function ($flavor) use ($productFlavorIds) {
            return [
                'id' => $flavor->id,
                'name' => $flavor->name,
                'is_checked' => in_array($flavor->id, $productFlavorIds),
            ];
        });

        return $flavorsWithCheckedStatus;
    }

    public function getFlavorIDByProduct(Product $product)
    {
        return $product->flavors()->pluck('flavor_id')->toArray();
    }

    public function deleteProductFlavor(Product $product, $flavor_id)
    {
        $product->flavors()->where('flavor_id', $flavor_id)->delete();
    }

    public function updateProductFlavors(Product $product, $newFlavors)
    {
        $currentFlavorIds = $this->getFlavorIDByProduct($product);
        $newFlavorIds = array_map('intval', $newFlavors); // integer

        // flavors cần thêm mới
        $flavorsToAdd = array_diff($newFlavorIds, $currentFlavorIds);

        // flavors cần xóa
        $flavorsToRemove = array_diff($currentFlavorIds, $newFlavorIds);

        foreach ($flavorsToAdd as $flavorId) {
            $this->storeProductFlavor($product, $flavorId);
        }

        foreach ($flavorsToRemove as $flavorId) {
            $this->deleteProductFlavor($product, $flavorId);
        }
    }

    public function deleteFlavorByProduct(Product $product)
    {
        $product->flavors()->delete();
        // ProductFlavor::where('product_id', $product->id)->delete();
    }
}
