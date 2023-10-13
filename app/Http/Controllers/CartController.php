<?php
namespace App\Http\Controllers;

use App\Models\Car;
use Illuminate\Http\Request;

class CartController extends Controller
{

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function cart()
    {
        $cars = Car::all();

        return view('cars.cart', compact('cars'));
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    public function addToCart($id)
    {
        $car = Car::findOrFail($id);

        $cart = session()->get('cart', []);

        if(isset($cart[$id])) {
            $cart[$id]['quantity']++;
        } else {
            $cart[$id] = [
                "brand" => $car->brand,
                "model" => $car->model,
                "engine_size" => $car->engine_size,
                "quantity" => 1,
                "price" => $car->price,
            ];
        }

        session()->put('cart', $cart);
        return redirect()->back()->with('success', 'Car added to cart successfully!');
    }

    /**
     * Write code on Method
     *
     */
    public function updateCart(Request $request)
    {

        $allCartCars = $request->cars;
        $cart = session()->get('cart', []);

        foreach ($allCartCars as $id => $car){
            $cart[$id]['quantity'] = $car['quantity'];
        }

        session()->put('cart', $cart);
        return redirect()->back()->with('success', 'Cart is  saved!');
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function remove($id)
    {
        $cart = session()->pull('cart', []);
        unset($cart[$id]);

        session()->put('cart', $cart);

        return redirect()->route('cart')
            ->with('success','Car deleted successfully');

    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function removeAll()
    {
        session()->forget('cart');

        return redirect()->route('cars.index')
            ->with('success','Car deleted successfully');

    }
    
    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public static function getTotalQuantity(){

        return $count = count(session()->get('cart', []));
    }
}
