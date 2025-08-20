<?php

namespace App\Utils;

use App\Models\Product;
use App\Models\User;
use App\Services\Models\Category\CategoryService;
use App\Services\Models\Product\ProductService;
use App\Services\Models\User\UserService;

class CacheManager
{
    /**
     * Category Cache Key's
     * */
    const CACHE_ALL_CATEGORIES = "cache_categories";
    const CACHE_SINGLE_CATEGORY = "cache_single_category";



    /**
     * Product Cache Key's
     * */
    const CACHE_ALL_PRODUCTS = "cache_products";
    const CACHE_SINGLE_PRODUCT = "cache_single_product";


    /**
     * ######################################
     * Cache Category Start
     * ######################################
     * */
    public function getParentCategories()
    {

        $request           = request();
        $categoryService   = new CategoryService();

        return $categoryService->getAll(false, true,true);

        $page              = 1;
        $perPage           = $request->has("page") ? (int) $request->page : $page;
        $categoryCacheName = cacheManager()::CACHE_ALL_CATEGORIES."_{$perPage}";

        info("cache for {$categoryCacheName}");

        if(isCacheExists($categoryCacheName)){
            info("Fetching from IF : {$categoryCacheName}");
            return getCache($categoryCacheName);
        }

        return setCacheData($categoryCacheName, $categoryService->getAll(
            true,
            true,
            null,
            ["mediaManager","categories"],
            ["perPage" => request()->per_page ?? 16]
        ));
    }

    /**
     * ######################################
     * Cache Category End
     * ######################################
     * */


    /**
     * ######################################
     * Media Manager Cache Start
     * ######################################
     * */

    public function setGetMediaManager(
        $keyword,
        $collection = null,
        $relationshipMethod = "productThumbnail"
    )
    {
        if(empty($collection)){


            return $collection;
        }

        if(!isCacheExists($keyword)){

            return setCacheData(
                $keyword,
                $collection->$relationshipMethod
            );
        }

        return getCache($keyword);
    }

    /**
     * ######################################
     * Media Manager Cache End
     * ######################################
     * */


    /**
     * ######################################
     * Product Cache Start
     * ######################################
     * */

    public function  getAllProducts($ignoreUserIds, $apiCacheRename = null, $panelName = "website")
    {
        $page =  request()->has("page") ? (int) request()->page : 1;

        $keyword = "{$apiCacheRename}_websiteProducts_{$page}";

        return  (new ProductService())->getAll(
            true,
            true,
            $panelName,
            ["variations","productThumbnail","variationCombinations"],
            [
                "ignoreUserIds"     =>$ignoreUserIds,
                "ignoreSupplierIds" => true
            ]
        );
//        if(!isCacheExists($keyword)){
//            info("Website Product caching : $keyword");
//
//
//            return setCacheData(
//                $keyword,
//                (new ProductService())->getAll(
//                    true,
//                    true,
//                    $panelName,
//                    ["category","brand","metaMediaManager","productThumbnail","variationCombinations","reviews"],
//                    [
//                        "ignoreUserIds"     =>$ignoreUserIds,
//                        "ignoreSupplierIds" => true
//                    ]
//                )
//            );
//        }

        return getCache($keyword);
    }


    public function getMerchantAdminProducts()
    {
        $browserCountryId = getSurfingCountryId();

        $query = Product::query()
            ->with([
                //"category",
                //"brand",
                "metaMediaManager",
                "productThumbnail",
                "variationCombinations",
               // "reviews"
            ])
            ->filters()
            ->activeStatus(true)
            ->whereHas("user", function ($query) use($browserCountryId){
                $query->where("users.user_type" ,"!=", appStatic()::TYPE_SUPPLIER)
                    ->where("users.country_id", $browserCountryId)
                    ->where("users.account_status", constantFlags()::ACTIVE_ACCOUNT);
            });

        info("Product Filter Raw Query : ". json_encode($query->toRawSql()));


        return $query->paginate(maxPaginateNo());
    }


    /**
     * ######################################
     * Product Cache End
     * ######################################
     * */


    public function getMerchants()
    {
        $keyword = "webMerchants";

        if(!isCacheExists($keyword)){

            info("Website Merchant caching : $keyword");

            return setCacheData(
                $keyword,
                (new UserService())->findByUserType(
                    appStatic()::TYPE_MERCHANT,
                    false,
                    ["shop","products"],
                    [
                        "products",
                        "ratings",
                        "orders"
                    ],
                    [],
                    true,
                    true
                )
            );
        }

        return getCache($keyword);
    }


    public function getMerchantProducts($user_id)
    {
        $page =  request()->has("page") ? (int) request()->page : 1;

        $keyword = "webMerchantProducts_{$user_id}_page{$page}";

        if(!isCacheExists($keyword)){

            return setCacheData(
                $keyword,
                (new ProductService())->getAll(
                    true,true,constantFlags()::PANEL_WEBSITE_FILTER,
                    [
                        "categories",
                        "reviews",
                        "variations",
                        "productThumbnail",
                    ],
                    [
                        "userIds"=>[$user_id]
                    ]
                )
            );
        }

        return getCache($keyword);
    }

    public function getOrdersByDeliveryStatus($user , $delivery_status, $returnCount = true)
    {
        $query = $user->orders()->latest("id")->where("delivery_status_id",$delivery_status);

        return $returnCount ? $query->count() ?? 0 : $query->get();
    }


    public function getShippingChargeByWeight($weight)
    {
        $cacheKeyword = "webShippingChargeByWeight_{$weight}";

        if(isCacheExists($cacheKeyword)){

            return getCache($cacheKeyword);
        }

        $shippingCharge = 0;

        return setCacheData($cacheKeyword, $shippingCharge ?? 0);
    }
}
