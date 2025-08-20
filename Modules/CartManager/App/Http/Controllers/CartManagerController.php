<?php

namespace Modules\CartManager\App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Traits\Api\ApiResponseTrait;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\CartManager\App\Http\Requests\CartStoreRequest;
use Modules\CartManager\App\Http\Requests\CartUpdateRequest;
use Modules\CartManager\Services\Action\CartActionService;

class CartManagerController extends Controller
{
    use ApiResponseTrait;

    private $cartActionService;

    public function __construct()
    {
        $this->cartActionService = new CartActionService();
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        return view('cartmanager::index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('cartmanager::create');
    }


    public function store(CartStoreRequest $request)
    {
        try {
            // Cart Add/Update/Delete Permission check

            $cart = $this->cartActionService->storeCartByUserId(userID(),$request->validated());

            return $this->sendResponse(
                appStatic()::SUCCESS_WITH_DATA,
                localize("Item Added to Cart"),
                $cart
            );
        }
        catch(\Throwable $e){
            $message = localize("Failed to add to cart")." | ".$e->getMessage();

            if($e->getCode() == requestResponse()::BAD_CART_PERMISSION) {
                $message = $e->getMessage();
            }

            return $this->sendResponse(
                requestResponse()::BAD_REQUEST,
                $message,
                [],
                errorArray($e)
            );
        }
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('cartmanager::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('cartmanager::edit');
    }

    public function update(CartUpdateRequest $request, $id)
    {
        try {
            // Cart Add/Update/Delete Permission check
            $this->cartActionService->validateCartPermission();

            $cart = $this->cartActionService->updateCartByUserId(userID(),$request->validated());

            return $this->sendResponse(
                appStatic()::SUCCESS_WITH_DATA,
                localize("Cart Updated Successfully"),
                $cart
            );
        }
        catch(\Throwable $e){

            $message = localize("Failed to Update Cart")." | ".$e->getMessage();

            if($e->getCode() == requestResponse()::BAD_CART_PERMISSION) {
                $message = $e->getMessage();
            }

            return $this->sendResponse(
                requestResponse()::BAD_REQUEST,
                $message,
                [],
                errorArray($e)
            );
        }
    }


    public function destroy($id, CartActionService $cartActionService)
    {
        try{

            // Cart Add/Update/Delete Permission check
            $this->cartActionService->validateCartPermission();

            $cart = $cartActionService->getCartById($id);

            // Check if cart belongs to logged in user
            if($cart->user_id != userId()){
                return $this->sendResponse(
                    requestResponse()::BAD_REQUEST,
                    localize("You don't have permission to delete this cart")
                );
            }

            // Delete Cart
            $cart->delete();

            return $this->sendResponse(
                requestResponse()::SUCCESS,
                localize("Item removed from cart"),
            );
        }
        catch(\Throwable $e){
            $message = localize("Failed to Delete Cart")." | ".$e->getMessage();

            if($e->getCode() == requestResponse()::BAD_CART_PERMISSION) {
                $message = $e->getMessage();
            }

            return $this->sendResponse(
                requestResponse()::BAD_REQUEST,
                $message,
                [],
                errorArray($e)
            );
        }
    }

    public function deleteCarts($id, CartActionService $cartActionService)
    {
        try{
            $this->cartActionService->deleteCartsByUserId($id);

            return $this->sendResponse(
                requestResponse()::SUCCESS,
                localize("Successfully Deleted Carts"),
            );
        }
        catch(\Throwable $e){
            commonLog("Sorry Failed",errorArray($e));

            return $this->sendResponse(
                requestResponse()::BAD_REQUEST,
                localize("Failed to Delete Carts")." | ".$e->getMessage(),
                [],
                errorArray($e)
            );
        }
    }
}
