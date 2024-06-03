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

    public function getFlavorsByProduct(Product $product)
    {
        // Eager load the flavors relation with pivot data
        $flavors = $product->flavors()->get();

        $flavorDetails = $flavors->map(function ($flavor) {
            return [
                'id' => $flavor->id,
                'name' => $flavor->name,
                'quantity' => $flavor->pivot->quantity, // Truy xuất quantity từ bảng pivot
            ];
        });

        return $flavorDetails;
    }

    public function getFlavorsWithCheckedStatus(Product $product)
    {
        $allFlavors = Flavor::all();

        $productFlavorIds = $product->flavors()->pluck('flavor_id')->toArray();

        $productFlavors = $product->flavors()->get(['flavor_id', 'quantity'])->keyBy('flavor_id');

        $flavorsWithCheckedStatus = $allFlavors->map(function ($flavor) use ($productFlavorIds, $productFlavors) {
            return [
                'id' => $flavor->id,
                'name' => $flavor->name,
                'is_checked' => in_array($flavor->id, $productFlavorIds),
                'quantity' => $productFlavors->has($flavor->id) ? $productFlavors->get($flavor->id)->quantity : 0,
            ];
        });

        return $flavorsWithCheckedStatus;
    }

    public function updateProductFlavors(Product $product, $newFlavors, $quantity)
    {
        $currentFlavorIds = $this->getFlavorIDByProduct($product);
        $newFlavorIds = array_map('intval', $newFlavors);

        $flavorsToAdd = array_diff($newFlavorIds, $currentFlavorIds);

        $flavorsToRemove = array_diff($currentFlavorIds, $newFlavorIds);

        foreach ($flavorsToAdd as $flavorId) {
            $this->storeProductFlavor($product, $flavorId, $quantity[$flavorId]);
        }

        foreach ($flavorsToRemove as $flavorId) {
            $this->deleteProductFlavor($product, $flavorId);
        }

        foreach ($newFlavorIds as $flavorId) {
            if (in_array($flavorId, $currentFlavorIds)) {
                $this->updateProductFlavorQuantity($product, $flavorId, $quantity[$flavorId]);
            }
        }
    }

    public function storeProductFlavor(Product $product, $flavorId, $quantity)
    {
        $product->flavors()->attach($flavorId, ['quantity' => $quantity]);
    }

    public function deleteProductFlavor(Product $product, $flavorId)
    {
        // $product->flavors()->where('flavor_id', $flavorId)->delete();
        $product->flavors()->detach($flavorId);
    }

    public function updateProductFlavorQuantity(Product $product, $flavorId, $quantity)
    {
        $currentQuantity = $product->flavors()->wherePivot('flavor_id', $flavorId)->first()->pivot->quantity;

        if ($currentQuantity != $quantity) {
            $product->flavors()->updateExistingPivot($flavorId, ['quantity' => $quantity]);
        }
    }


    public function getFlavorIDByProduct(Product $product)
    {
        return $product->flavors()->pluck('flavor_id')->toArray();
    }

    public function deleteFlavorByProduct(Product $product)
    {
        // $product->flavors()->delete();
        // ProductFlavor::where('product_id', $product->id)->delete();
        $product->flavors()->detach(); // pivot
    }
}
