<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Status\StatusUpdateRequest;
use App\Models\Area;
use App\Services\Admin\Status\ActiveStatusService;
use App\Traits\Api\ApiResponseTrait;
use App\Traits\Global\AllModelNameTrait;
use App\Traits\UnHashed\UnHashedTrait;
use App\Utils\AppStatic;
use Illuminate\Contracts\Encryption\DecryptException;
use App\Http\Resources\Admin\ActiveStatus\ActiveStatusResource;
use App\Models\Currency;
use App\Models\FAQ;
use App\Models\ItemCategory;
use App\Models\Menu;
use App\Models\OfflinePaymentMethod;
use App\Models\Page;
use App\Models\Product;
use App\Models\Role;
use App\Models\SubscriptionPlan;
use App\Models\SupportCategory;
use App\Models\SupportPriority;
use App\Models\Table;
use App\Models\User;
use Illuminate\Http\Request;
use Modules\BranchModule\App\Models\Branch;
use Modules\KitchenManager\App\Models\Kitchen;
use Modules\ReservationManager\App\Models\Reservation;

class StatusUpdateController extends Controller
{
    use ApiResponseTrait;

    public function updateActiveStatus(
        Request $request,
        $id,
        AppStatic $appStatic,
        ActiveStatusService $activeStatusService
    )
    {
        try {
            $model = $this->getModelNameBasedOnRouteName();
            
            // Model instance check
            if (empty($model)) {
                return $this->sendResponse(
                    $appStatic::VALIDATION_ERROR,
                    localize("Model Not Found Something Went wrong with incoming information")
                );
            }

            // Model Row
            $modelRow = findById($model, $id);

            // Active Status Service
            $activeStatusService->updateActiveStatus($modelRow);

            return $this->sendResponse(
                $appStatic::SUCCESS_WITH_DATA,
                $appStatic::MESSAGE_STATUS_UPDATE,
                ActiveStatusResource::make($modelRow)
            );
        }
        catch (DecryptException $decryptException){

            return $this->sendResponse(
                $appStatic::VALIDATION_ERROR,
                localize("Failed to update status")." | ".$decryptException->getMessage(),
                [],
                errorArray($decryptException)
            );
        }
        catch (\Throwable $e){

            return $this->sendResponse(
                $appStatic::VALIDATION_ERROR,
                localize("Failed to update status")." | ".$e->getMessage(),
                [],
                errorArray($e)
            );
        }
    }

    public function getModelNameBasedOnRouteName()
    {
        $routeName = currentRoute();

        $modelArr = [
            "admin.areas.statusUpdate"                   => new Area(),
            "admin.kitchens.statusUpdate"                => new Kitchen(),
            "admin.menus.statusUpdate"                   => new Menu(),
            "admin.item-categories.statusUpdate"         => new ItemCategory(),
            "admin.menu-items.statusUpdate"              => new Product(),
            "admin.tables.statusUpdate"                  => new Table(),
            "admin.branches.statusUpdate"                => new Branch(),
            "reservationmanager.statusUpdate"            => new Reservation(),
            "admin.currencies.statusUpdate"              => new Currency(),
            "admin.pages.statusUpdate"                   => new Page(),
            "admin.faqs.statusUpdate"                    => new FAQ(),
            "admin.support-categories.statusUpdate"      => new SupportCategory(),
            "admin.support-priorities.statusUpdate"      => new SupportPriority(),
            "admin.subscription-plans.statusUpdate"      => new SubscriptionPlan(),
            "admin.offline-payment-methods.statusUpdate" => new OfflinePaymentMethod(),
            "admin.roles.statusUpdate"                   => new Role(),
            "admin.users.statusUpdate"                   => new User(),
        ];

        return $modelArr[$routeName] ?? null;
    }
}
