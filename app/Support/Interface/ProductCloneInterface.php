<?php

namespace App\Support\Interface;

use App\Models\Product;

interface ProductCloneInterface
{
    /**
     * ###############################################
     * New product will be clone here with provided product object and user_id
     *
     * @incomingParams $product contains product object
     * @incomingParams $user_id contains user_id of the product
     * */
    public function productClone(Product $product, $user_id);

    public function productThumbnailClone(object $product, object $newProduct);

    public function productMetaMediaClone(object $product,object $newProduct);

    public function productPictureClone(object $product, object $newProduct);

    public function productVariationClone(object $product, object $newProduct, $qty, object $order);

    public function productVariationCombinationClone(object $product, object $newProduct);

    public function productVariationStockClone(object $product, object $newProduct, $qty);

    public function productCategoriesClone(object $product, object $newProduct);

    public function increaseProductCountForTheProductOwner(object $product, object $newProduct);

    public function productLocalizationClone(object $product, object $newProduct);

}