<?php

namespace App\Http\Controllers;

use App\Models\cart;
use App\Models\Checkout;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function index() {

        $userId = auth()->id();

        $itemCheck = cart::where('user_id', $userId)->where('status', 'antrean')->with('book')->orderBy('updated_at', 'desc')->get();
        $total = cart::where('user_id', $userId)->where('status', 'antrean')->sum('subtotal');
        $quantity = cart::where('user_id', $userId)->where('status', 'antrean')->sum('quantity');

        return view('checkout', compact('itemCheck', 'quantity', 'total'));
    }

    public function checkout(Request $request) {
        $check = new Checkout();
        $check->user_id = auth()->id();
        $check->nama = $request->nama;
        $check->alamat = $request->alamat;
        $check->tanggal_pengiriman = $request->tanggal_pengiriman;
        $check->metode_pembayaran = $request->metode_pembayaran;
        $check->e_wallet = $request->e_wallet;
        $check->total_harga = $request->total_harga;
        $check->total_item = $request->total_item;
        $check->save();

        $cart = Cart::where('user_id', auth()->id())->where('status', 'antrean')->update(['status' => 'done', 'check_id' => $check->id]);

        return redirect('/');

    }
}
