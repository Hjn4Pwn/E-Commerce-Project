<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCartItemRequest;
use App\Models\Cart;
use App\Models\CartItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Services\Interfaces\CartServiceInterface;
use App\Services\Interfaces\CategoryServiceInterface;

class CartController extends Controller
{

    protected $cartService;
    protected $categoryService;

    public function __construct(
        CartServiceInterface $cartService,
        CategoryServiceInterface $categoryService,
    ) {
        $this->cartService = $cartService;
        $this->categoryService = $categoryService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = auth()->user();
        $cartItems = $this->cartService->getCartItems($user->id);
        $categories = $this->categoryService->getAllCategories();

        return view('shop.pages.cart', [
            'categories' => $categories,
            'cartItems' => $cartItems,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Cart $cart)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cart $cart)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Cart $cart)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cart $cart)
    {
        //
    }


    public function addToCart(StoreCartItemRequest $request)
    {
        // dd($request);
        $user = Auth::user();
        $cart = $this->cartService->getUserCart($user->id);

        $this->cartService->addItemToCart(
            $cart->id,
            $request->product_id,
            $request->quantity,
            $request->flavor_id
        );

        return redirect('cart/')->with('success', 'Product added to cart successfully');
    }

    public function removeItem(Request $request)
    {
        // $userId = auth()->id();
        $userId = Auth::user()->id;
        $productId = $request->product_id;
        $flavorId = $request->flavor_id;

        $result = $this->cartService->removeItem($userId, $productId, $flavorId);

        return redirect()->back()->with($result['status'], $result['message']);
    }
}
