<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Mail\OrderMail;
use App\Models\Comment;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ProductController extends Controller
{
    /**
     * This function show all products
     */
    public function index() {
        // dd(session()->has('cart'));
        
        return view('products.index', ['products' => Product::latest()->filter(request(['category', 'search']))->paginate(3)]);
    }

    /**
     * This function show single products
     */
    public function show(Product $product) {
        return view('products.show', [
            'product' => $product,
            'comments' => $product->comment->sortByDesc('created_at')
        ]);
    }

    /**
     * This function shows all products in shopping cart
     */
    public function shoppingCart() {
        return view('products.shopping-cart', ['products' => Product::latest()->get()]);
    }

    /**
     * This function add product to Shopping Cart
     */
    public function addToCart(Request $request, Product $product) {
    
        $product = $product;

        if(session()->has('cart')) {
            $oldCart = session()->get('cart')->items ? session()->get('cart') : null;
        } else {
            $oldCart = null;
        }

        if($oldCart) {
            if(array_key_exists($product->id, $oldCart->items)) {
                return redirect('/')->with('message', 'Product already in the Cart.');
            }
        }

        $cart = new Cart($oldCart);
        $cart->add($product);

        session()->put('cart', $cart);

        return redirect('/')->with('message', 'Product added to the Cart.');

    }

    /**
     * This function update number of products and send user to checkout page
     */
    public function checkout(Request $request) {

        $cartItems = session()->get('cart');
        $cart = new Cart($cartItems);

        $requests = $request->request;

        $cart->update($requests);

        session()->put('cart', $cart);

        if(!session()->get('cart')->items) {
            return back()->with('message', 'Your cart is empty');
        } 

        return redirect('/products/order');

        // return view('products.checkout', [
        //     'cartItems' => session()->get('cart')->items,
        //     'totalPrice' => session()->get('cart')->totalPrice
        // ]);
    }

    /**
     * This function show order form
     */
    public function showOrderForm() {
         return view('products.checkout', [
            'cartItems' => session()->get('cart')->items,
            'totalPrice' => session()->get('cart')->totalPrice
        ]);
    }

    /**
     * This function simulate order and return success message
     * aaaaand send email
     */
    public function makeOrder(Request $request) {
        $formFields = $request->validate([
            'first_name' => 'required|min:3',
            'last_name' => 'required|min:3',
            'email' => 'required|email',
            'address' => 'required'
        ]);

        $order = new Order();

        // Mail::to(auth()->user()->email)->send(new OrderMail());

        session()->forget('cart');

        return redirect('/')->with('message', 'Order success');
    }

    /**
     * This function Empty shopping cart
     */
    public function emptyCart() {
        session()->forget('cart');

        return back()->with('message', 'Cart is empty');
    }


}