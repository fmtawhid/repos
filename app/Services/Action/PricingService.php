<?php

namespace App\Services\Action;

use App\Models\CampaignProductAttribute;
use App\Models\ProductAttribute;

class PricingService
{
    /**
     * Get the price of a product variation based on campaign status.
     *
     * @param int $productId
     * @param int $variationId
     *
     */
    public function getProductVariation($productId, $variationId)
    {
        // Step 1: Attempt to fetch the campaign price using a join for active campaigns
        $campaignProductVariation = CampaignProductAttribute::query()
            ->select('campaign_product_attributes.*')
            ->join('campaigns', 'campaign_product_attributes.campaign_id', '=', 'campaigns.id')
            ->where('campaign_product_attributes.product_id', $productId)
            ->where('campaign_product_attributes.product_attribute_id', $variationId)
            ->where('campaigns.is_active', 1)
            ->whereDate('campaigns.end_date_time', '>=',now())
            ->first();

        // Step 2: If a campaign price exists, return it
        if (!empty($campaignProductVariation)) {
            return [
                "is_campaign_product_variation" => true,
                "campaignProductVariation"      => $campaignProductVariation
            ];
        }

        // Step 3: Fallback to the regular price in ProductVariation if no campaign price was found
        $productVariation = ProductAttribute::query()
            ->selectRaw("product_attributes.*")
            ->join("products", "product_attributes.product_id", "=", "products.id")
            ->join("users", "products.product_owner_id", "=", "users.id")
            ->where("users.account_status",1)
            ->whereNull("users.deleted_at")
            ->whereNull("products.deleted_at")
            ->where("products.is_active", 1)
            ->where('products.id', $productId)
            ->where('product_attributes.id', $variationId)->first();

        return [
            "is_campaign_product_variation" => false,
            "productVariation"              => $productVariation
        ];
    }


    public function cartInfo()
    {

        return [
            "sub_total" => 0,
            "total_qty" => 0,
            "total_discount" => 0,
            "total_tax" => 0,
            "grand_total" => 0,
            "cart_items" => []
        ];
    }
}
