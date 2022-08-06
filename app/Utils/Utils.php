<?php

namespace App\Utils;

use App\Models\Product;
use App\Models\Reference;
use Carbon\Carbon;

class Utils
{

    public function updateReferenceCount(string $type, int $businessId)
    {

        $reference = Reference::where('type',  $type)
            ->where('business_id', $businessId)
            ->first();

        if (!empty($reference)) {

            $reference->count++;
            $reference->save();

            return $reference->count;
        } else {
            $new_reference = Reference::create([
                'type'          => $type,
                'business_id'   => $businessId,
                'count'         => 1
            ]);

            return  $new_reference->count;
        }
    }

    public function generateReferenceNo(int $referenceCount)
    {

        $prefix = "PO";
        $ref_digits = str_pad($referenceCount, 4, 0, STR_PAD_LEFT);
        $ref_year   = Carbon::now()->year;
        $ref_month  = Carbon::now()->month;
        $ref_day    = Carbon::now()->day;

        return $prefix . $ref_year . $ref_month . $ref_day . '/' . $ref_digits;
    }

    /*
    public function createVariation(Product $product, float $defaultPurchasePrice = null, float $defaultSellingPrice = null)
    {

        $productVariationData = [
            'name'      => 'DUMMY',
            'is_dummy'  => 1
        ];

        $productVariation = $product->product_variations()->create($productVariationData);

        $variationData = [
            'name'                   => 'DUMMY',
            'product_id'             => $product->id,
            'sku'                    => $product->sku,
            'default_purchase_price' => $defaultPurchasePrice,
            'default_selling_price'  => $defaultSellingPrice
        ];

        $productVariation->variations()->create($variationData);

        return true;
    }
    */
}
