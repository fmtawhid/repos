<?php

namespace App\Services\MenuItem;

use App\Models\Product;

/**
 * Class MenuItemService.
 */
class MenuItemService
{
    public $model;

    public function getAll(
        $isPaginateGetOrPluck = null,
        $onlyActives = null,
    )
    {
        $request = request();
        $query = Product::query()->filters();

        if($request->has('is_active')) {
            $query->isActive(intval($request->is_active));
        }
        if(!is_null($onlyActives)){
            $query->isActive($onlyActives);
        }

        if (is_null($isPaginateGetOrPluck)) {
            return $query->pluck("name", "id");
        }

        return $isPaginateGetOrPluck ? $query->paginate(maxPaginateNo()) : $query->get();
    }

    //-------------------------------------
    // Store menu item
    //-------------------------------------
    public function store($payloads)
    {
        $this->model = Product::query()->create($this->menuItemRequest($payloads));

        return $this;
    }


    // To update Menu Item
    public function updateMenuItem($product, $payloads)
    {
        $this->model = $product->update($this->menuItemRequest($payloads));
        return $this;
    }

    // Menu item Request
    private function menuItemRequest($request){
        $data = [
            "name"              => $request["name"] ?? null,
            "description"       => $request["description"] ?? null,
            "preparation_time"  => $request["preparation_time"] ?? null,
            "price"             => $request["price"] ?? 0,
            "discounted_price"  => $request["price"] ?? 0,
            "media_manager_id"  => $request["media_manager_id"] ?? null,
            "menu_id"           => $request["menu_id"] ?? null,
            "item_category_id"  => $request["item_category_id"] ?? null,
            "is_active"         => $request["is_active"] ?? null
        ];

        $productAddons = null;

        if(isset($request['addon_titles'])){
            $productAddons = collect();
            foreach ($request['addon_titles'] as $key => $addonTitle) {
                $productAddon = [
                    'title' => $addonTitle,
                    'price' => $request['addon_prices'][$key] ?? 0,
                ];
                $productAddons->push($productAddon);
            }
        }

        $data['product_addons'] = $productAddons ? ($productAddons) : null;

        return $data;
    }

    //-------------------------------------
    // Store menu item variations
    //-------------------------------------
    public function storeVariations($data)
    {
        foreach($data["variation_titles"] as $key => $title) {

            $price = $data["variation_prices"][$key];

            if(!is_null($price)){

                $this->model->productAttributes()->create([
                    "title"      => $title,
                    "price"      => $price,
                    "discounted_price" => $price,
                    "product_id" => $this->model->id,
                    "is_active"  => 1,
                ]);
            }
        }

        return $this;
    }


    //-----------------------------------------
    // update Or Create Variations
    //-----------------------------------------
    public function updateOrCreateVariations($product, $requestData)
    {
        // new variation create or update existing one..
        if(isset($requestData["variation_ids"])){
            $product->productAttributes()->whereNotIn('id', $requestData["variation_ids"])->delete();
        }

        foreach($requestData["variation_titles"] as $key => $title) {
            $variation_id = $requestData["variation_ids"][$key] ?? null;

            $product->productAttributes()->updateOrCreate(
                ['id' => $variation_id],
                [
                    "title"            => $title,
                    "price"            => $requestData["variation_prices"][$key],
                    "discounted_price" => $requestData["variation_prices"][$key],
                    "product_id"       => $product->id,
                    "is_active"        => 1,
                ]
            );
        }
        return $this;
    }

    //-------------------------------------
    // find menu item
    //-------------------------------------
    public function findById($id, $relationship = [])
    {
        return Product::with($relationship)->findOrFail($id);
    }

}
