<?php
namespace Modules\PosManager\Services\Business;

use App\Models\Area;
use App\Models\Product;
use App\Models\ItemCategory;
use App\Models\Table;
use App\Models\User;
use App\Models\VendorCustomer;
use Illuminate\Support\Facades\Log;

class PosManagerService
{

    public function getProductsByProductOwnerId($productOwnerId = null)
    {
        $request = request();

        $categoryId = $request->category_id ?? null;


        $query = Product::query()
            ->with('mediaManager')

            ->filters()


            // Product Owner
            ->where("products.vendor_id", $productOwnerId)

            //Active
            ->where("products.is_active", "=", appStatic()::ACTIVE)
            ->whereNull("products.deleted_at");

        return $query->paginate(maxPaginateNo());
    }

    public function getProductsByBranchIdAndVendorId($vendorId, $branchId)
    {
        $request = request();

        $categoryId = $request->category_id ?? null;


        $query = Product::query()

            ->select("products.*")

            ->with('mediaManager')

            ->filters()

            // join Menu
            ->join("branch_menus",  function ($query) use ($branchId) {
                $query->on("branch_menus.menu_id", "=", "products.menu_id");
            })

            // Join Menu
            ->join("menus", function ($query) {
                $query->on("menus.id", "=", "branch_menus.menu_id")
                    ->whereNull("menus.deleted_at")
                    ->where("menus.is_active", "=", appStatic()::ACTIVE);
            })

            // Join Branch
            ->join("branches", function ($query) use ($branchId) {
                $query->on("branch_menus.branch_id", "=", "branches.id")
                    ->where("branches.is_active", "=", appStatic()::ACTIVE)
                    ->whereNull("branches.deleted_at");
            })

            ->where("branch_menus.branch_id", $branchId)

            // Product Owner
            ->where("products.vendor_id", $vendorId)

            //Active
            ->where("products.is_active", "=", appStatic()::ACTIVE)
            ->whereNull("products.deleted_at")

            ->groupBy("products.id");


        return $query->paginate(maxPaginateNo());
    }

    /**
     * NB : item_categories.vendor_id will add from VendorIdGlobalTrait file dynamically.
     * */
    public function getCategoriesByProductProductOwnerId($productOwnerId)
    {

        $active = appStatic()::ACTIVE;

        $query = ItemCategory::query()
            ->select([
                "item_categories.id",
                "item_categories.name"
            ])

            // Join
            ->leftJoin("products", function ($join) use ($active){
                $join->on("products.item_category_id", "=", "item_categories.id")
                    ->whereNull("products.deleted_at")
                    ->where("products.is_active", "=", $active);
            })

            // Active
            ->where("item_categories.is_active", "=", $active)

            // Deleted Null
            ->whereNull("item_categories.deleted_at")

            // Group by categories to avoid duplicates
            ->groupBy("item_categories.id");

        //dd($query->toRawSql(),$query->get());

        return $query->get();
    }

    public function getBrandsByProductProductOwnerId($productOwnerId)
    {

        $query = Brand::query()

            // Select
            ->select([
                "brands.id",
                "media_managers.media_file",
                "brands.title as title",
                "brand_localizations.title as localize_title",
                \DB::raw("COUNT(products.id) as total_products")
            ])

            ->join("products", "brands.id", "=", "products.brand_id")

            // Brand Localizations
            ->leftJoin("brand_localizations", function ($join) {
                $join->on("brands.id", "=", "brand_localizations.brand_id")
                    ->where("brand_localizations.language_id", "=", $this->languageId);
            })
            ->leftJoin("media_managers", "brands.media_manager_id", "=", "media_managers.id")

            // Active
            ->where("brands.is_active", "=", appStatic()::ACTIVE)
            ->where("products.is_active", "=", appStatic()::ACTIVE)

            // Deleted Null
            ->whereNull("brands.deleted_at")
            ->whereNull("products.deleted_at")

            // Check media_managers.is_active only if media exists
            ->where(function ($query) {
                $query->whereNull("media_managers.id") // Allow categories with no media
                ->orWhere("media_managers.is_active", "=", appStatic()::ACTIVE); // Check only if media exists
            })

            // Apply condition for non-admin users
            ->when(!isAdminGroup(), function ($q) use ($productOwnerId) {
                $q->where("products.product_owner_id", "=", $productOwnerId);
            })

            // Group By brands.id
            ->groupBy("brands.id");

        return $query->get();
    }

    public function getTablesByBranchId($branchId)
    {

        $query = Table::query()
            ->where("branch_id", "=", $branchId)
            ->where("is_active", "=", appStatic()::ACTIVE)
            ->whereNull("deleted_at");


    }

    public function getAreasByBranchId($branchId, $hasTables) // hasTables = true means those areas have tables
    {
        $query = Area::query()
            ->select("areas.*")
            ->with("tables")
            // join area branch
            ->join("area_branch", "areas.id", "=", "area_branch.area_id")
            ->where("area_branch.branch_id", "=", $branchId)
            ->where("areas.is_active", "=", appStatic()::ACTIVE)
            ->whereNull("areas.deleted_at");

        if ($hasTables) {
            $query = $query
                ->has('tables');
        }

        $query = $query->groupBy("areas.id","areas.name");

           Log::info($query->toRawSql());

        return $query->get();
    }
    
    public function registerNewCustomer(array $data)
    {

        $user = User::query()->updateOrCreate([
            "email" => $data["email"],
        ],
        $data);

        $vendorCustomerData = [
            'customer_id' => $user->id,
            'vendor_id'   => vendorId(),
            'branch_id'   => getUserBranchId()
        ];
        VendorCustomer::query()->updateOrCreate([
            "customer_id"   => $user->id
        ], $vendorCustomerData);

        return $user;
    }

}
