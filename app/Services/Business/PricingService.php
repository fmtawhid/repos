<?php

namespace App\Services\Business;

/**
 * Class PricingService.
 */
class PricingService
{
    public function calculateDiscountedPrice($price, $discountType, $discountValue)
    {
        if ($this->isPercentage($discountType)) {
            return $price - ($price * ($discountValue / 100));
        } else {
            return max($price - $discountValue, 0); // Ensures price can't be negative
        }
    }

    public function getDiscountedPrice($price, $discountType, $discountValue)
    {
        if ($this->isPercentage($discountType)) {
            return ($price * ($discountValue / 100));
        }

        return max($discountValue, 0);
    }


    public function isPercentage($type)
    {

        return constantFlags()::TYPE_PERCENTAGE == $type;
    }

    public function formatPrice(
        $price,
        $truncate = false,
        $forceTruncate = false,
        $addSymbol = true,
        $numberFormat = true
    )
    {

        // convert amount equal to local currency
        $price               = convertAmountEqualToLocalCurrency($price);
        $defaultCurrencyRate =  getRate() ?: 1;
        $rate                = setRate();

        if ($price > 0) {
            $price = ($price / $defaultCurrencyRate) * $rate;
        }

        if ($numberFormat) {
            // truncate price
            if ($truncate) {
                if (getSetting('truncate_price') == 1 || $forceTruncate == true) {
                    $price = $this->truncatePrice($price);
                }
            } else {
                // decimals
                if (getSetting('no_of_decimals') > 0) {
                    $price = number_format($price, getSetting('no_of_decimals'));
                } else {
                    $price = number_format($price, getSetting('no_of_decimals', 2), '.', ',');
                }
            }
        }

        if ($addSymbol) {
            // currency symbol
            return addSymbol($price);
        }
        return $price;

    }

    public function truncatePrice($price)
    {
        if ($price < 1000000) {
            // less than a million
            $price = number_format($price, getSetting('no_of_decimals'));
        } else if ($price < 1000000000) {
            // less than a billion
            $price = number_format($price / 1000000, getSetting('no_of_decimals')) . 'M';
        } else {
            // at least a billion
            $price = number_format($price / 1000000000, getSetting('no_of_decimals')) . 'B';
        }

        return $price;
    }

    public function addSymbol(
        $price
    )
    {
        $symbol          = getSymbol();
        $symbolAlignment = getAlignment();

        if ($symbolAlignment == 0) {
            return $symbol . $price;
        } else if ($symbolAlignment == 1) {
            return $price . $symbol;
        } else if ($symbolAlignment == 2) {
            # space
            return $symbol . ' ' . $price;
        } else {
            # space
            return $price . ' ' .  $symbol;
        }
    }

    public function getProductInfo(object $product, $fetchImages = false)
    {
        $productImages = [];
        if($fetchImages){
            foreach ($product->images as $productImage) {
                $productImages[] = urlVersion($productImage->mediaManager?->media_url ?: null);
            }
        }


        $productArr = getProductPriceAndDiscountWithCampaignValidStockFlag($product);

        $productArr+= [
            "id"             => $product->id,
            "title"          => $product->title,
            "slug"           => $product->slug,
            "discount_type"  => $product->discount_type,
            "discount_value" => $product->discount_value,
            "thumbnail"      => urlVersion(productThumbnail($product)),
            "images"         => $productImages,
        ];

        return $productArr;
    }

}
