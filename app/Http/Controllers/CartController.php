<?php

namespace App\Http\Controllers;

use App\Models\Meal;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);
        $total = array_reduce($cart, function ($carry, $item) {
            return $carry + ($item['price'] * $item['quantity']);
        }, 0);

        return view('cart.index', compact('cart', 'total'));
    }

    public function add(Request $request)
    {
        $meal = Meal::findOrFail($request->meal_id);
        $cart = session()->get('cart', []);

        if (isset($cart[$meal->id])) {
            $cart[$meal->id]['quantity']++;
        } else {
            $cart[$meal->id] = [
                "name" => $meal->name,
                "quantity" => 1,
                "price" => $meal->unit_price,
                "image" => $meal->image_path
            ];
        }

        session()->put('cart', $cart);
        return redirect()->back()->with('success', 'Item successfully added to cart!');
    }

    public function update(Request $request, $id)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            $cart[$id]['quantity'] = $request->quantity;
            session()->put('cart', $cart);
        }

        return redirect()->back()->with('success', 'Cart successfully updated!');
    }

    public function remove($id)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }

        return redirect()->back()->with('success', 'Item successfully removed from cart!');
    }
}
