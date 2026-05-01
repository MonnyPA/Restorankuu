<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Item;
use App\Models\User;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Validator;

use function Pest\Laravel\session;

class MenuController extends Controller
{
    public function index(Request $request)
    {
        $tableNumber = $request->query('meja');
        if ($tableNumber) {
            Session::put('tableNumber', $tableNumber);
        }

        $items = Item::where('is_active', 1)->orderBy('name', 'asc')->get();

        return view('customer.menu', compact('items', 'tableNumber'));
    }

    // Keranjang
    public function cart()
    {
        $cart = Session::get('cart');
        return view('customer.cart', compact('cart'));
    }

    public function addToCart(Request $request)
    {
        // dd($request->all());
        $menuId = $request->input('id');
        $menu = Item::find($menuId);

        // dd($menu);

        if(!$menu)
            {
                return response()->json(
                    [
                        'status' => 'error',
                        'message' => 'Menu tidak ditemukan'
                    ]);
            }

        $cart = Session::get('cart');

        // dd($cart);

        if(isset($cart[$menuId]))
            {
                $cart[$menuId]['qty'] += 1;
            } else
            {
                $cart[$menuId] =
                [
                    'id' => $menu->id,
                    'name' => $menu->name,
                    'price' => $menu->price,
                    'image' => $menu->img,
                    'qty' => 1
                ];
            }

        Session::put('cart', $cart);

        return response()->json(
                    [
                        'status' => 'success',
                        'message' => 'Menu ' . $menu->name . ' Berhasil ditambahkan ke Keranjang',
                        'cart' => $cart
                    ]);
    }

    public function updateCart(Request $request)
    {
        $itemId = $request->input('id');
        $newQty = $request->input('qty');

        if($newQty <= 0)
            {
                return response()->json([
                    'success' => false
                ]);
            }

        $cart = Session::get('cart');
        if(isset($cart[$itemId]))
            {
                $cart[$itemId]['qty'] = $newQty;
                Session::put('cart', $cart);
                Session::flash('success', 'Jumlah Item berhasil diperbaharui');

                return response()->json([
                    'success' => true
                ]);
            }
    }

    public function removeCart(Request $request)
    {
        $itemId = $request->input('id');

        $cart = Session::get('cart');

        if(isset($cart[$itemId]))
            {
                unset($cart[$itemId]);
                Session::put('cart', $cart);
                Session::flash('success', 'Item Berhasil dikeluarkan dari keranjang atau dihapus');

                return response()->json([
                    'success' => true
                ]);
            }
    }

    public function clearCart()
    {
        Session::forget('cart');
        return redirect()->route('cart')->with('success', 'Keranjang Berhasil dikosongkan');
    }

    // Checkout
    public function checkout()
    {
        $cart = Session::get('cart');
        if(empty($cart))
            {
                return redirect()->route('cart')->with('error', 'Keranjang Masih Kosong');
            }

        $tableNumber = Session::get('tableNumber');

        return view('customer.checkout', compact('cart','tableNumber'));
    }

    public function storeOrder(Request $request)
    {
        $cart = Session::get('cart');
        $tableNumber = Session::get('tableNumber');

        if(empty($cart))
            {
                return redirect()->route('cart')->with('error', 'Keranjang Masih Kosong');
            }

        $validator = Validator::make($request->all(), [
            'fullname' => 'required|string|max:255',
            'phone' => 'required|string|max:15'
        ]);

        if($validator->fails())
            {
                return redirect()->route('checkout')->withErrors($validator);
            }

        $total = 0;
        foreach($cart as $item)
            {
                $total = $item['price'] * $item['qty'];
            }

        $totalAmount = 0;
        foreach($cart as $item)
            {
                $totalAmount += $item['price'] * $item['qty'];

                $itemDetails[] = [
                    'id' => $item['id'],
                    'price' => (int) $item['price'] + ($item['price']*0.1),
                    'quantity' => $item['qty'],
                    'name' => substr($item['name'], 0, 50)
                ];
            }

        $user = User::firstOrCreate([
            'fullname' => $request->input('fullname'),
            'phone' => $request->input('phone'),
            'role_id' => 4
        ]);

        $order = Order::create([
            'order_code' => 'ORD-'. $tableNumber. '-'. time(),
            'user_id' => $user->id,
            'subtotal' => $totalAmount,
            'tax' => $totalAmount * 0.1,
            'grand_total' => $totalAmount + ($totalAmount * 0.1),
            'status' => 'pending',
            'table_number' => $tableNumber,
            'payment_method' => $request->payment_method,
            'note' => $request->note,
        ]);

        foreach($cart as $itemId => $item)
            {
                OrderItem::create([
                    'order_id' => $order->id,
                    'item_id' => $item['id'],
                    'quantity' => $item['qty'],
                    'price' => $item['price'] * $item['qty'],
                    'tax' => ($item['price'] * 0.1) * $item['qty'],
                    'total_price' => ($item['price'] * $item['qty']) + ($item['price'] * 0.1 * $item['qty']),

                ]);

            }

        Session::forget('cart');

        return redirect()->route('checkout.success', ['orderId' => $order->order_code])->with('success', 'Pesanan Berhasil dibuat');
    }

    public function checkoutSuccess($orderId)
    {
        $order = Order::where('order_code', $orderId)->first();

        if(!$order)
            {
                return redirect()->route('menu')->with('error', 'Pesanan tidak dimukan');
            }

            $orderItems = OrderItem::where('order_id', $order->id)->get();

            if($order->payment_method == 'qris')
            {
                $order->status = 'settlement';
                $order->save();

            }

            return view('customer.success', compact('order','orderItems'));
    }
}
