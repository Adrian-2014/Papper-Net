<?php

namespace App\Http\Controllers;

use App\Models\book;
use App\Models\cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'user_id' => 'required',
            'book_id' => 'required',
        ]);

        $exist = Cart::where('user_id', $request->user_id)
            ->where('book_id', $request->book_id)->where('status', 'antrean')
            ->first();

        $targetBook = Book::where('id', $request->book_id)->first();

        if ($exist) {
            $exist->quantity++;
            $exist->subtotal = $exist->quantity * $targetBook->harga;
            $exist->save();
        } else {
            $cart = new Cart();
            $cart->book_id = $request->book_id;
            $cart->user_id = $request->user_id;
            $cart->quantity = 1;
            $cart->subtotal = $targetBook->harga;
            $cart->save();
        }

        $userId = auth()->id();
        $crot = Cart::where('user_id', $userId)->where('status', 'antrean')->with('book')->orderBy('updated_at', 'desc')->get();
        $count = Cart::where('user_id', $userId)->where('status', 'antrean')->with('book')->count();
        $total = Cart::where('user_id', $userId)->where('status', 'antrean')->sum('subtotal');

        // Mengembalikan HTML untuk tampilan keranjang yang diperbarui
        $html = view('template.cart', ['crot' => $crot])->render();
        $xml = view('template.cart-kurung', ['count' => $count])->render();
        $ss = view('template.cart-keranjang', ['hitung' => $count])->render();
        $total = view('template.total', ['total'=> $total, 'count' => $count])->render();

        return response()->json([
            'success' => true,
            'html' => $html,
            'xml' => $xml,
            'ss' => $ss,
            'total' => $total,
        ]);
    }

    public function destroy(Request $request)
    {
        $cartItem = Cart::where('id', $request->cart_id)
            ->where('user_id', $request->user_id)->where('status', 'antrean')
            ->first();
        $cartItem->delete();
        // $cartItem->save();

        $userId = auth()->id();
        $crot = Cart::where('user_id', $userId)->where('status', 'antrean')->with('book')->orderBy('updated_at', 'desc')->get();
        $count = Cart::where('user_id', $userId)->where('status', 'antrean')->with('book')->count();
        $total = Cart::where('user_id', $userId)->where('status', 'antrean')->sum('subtotal');

        // Mengembalikan HTML untuk tampilan keranjang yang diperbarui
        $html = view('template.cart', ['crot' => $crot])->render();
        $xml = view('template.cart-kurung', ['count' => $count])->render();
        $ss = view('template.cart-keranjang', ['hitung' => $count])->render();
        $total = view('template.total', ['total'=> $total, 'count'=>$count])->render();

        return response()->json([
            'success' => true,
            'html' => $html,
            'xml' => $xml,
            'ss' => $ss,
            'total' => $total,
        ]);
    }

    public function kurangPro(Request $request)
    {
        $cartItem = Cart::where('id', $request->cart_id)
            ->where('user_id', $request->user_id)->where('status', 'antrean')
            ->first();

        if ($cartItem) {
            // Pastikan quantity tidak kurang dari 1
            if ($cartItem->quantity > 1) {
                $cartItem->quantity--;
                $targetBook = Book::where('id', $cartItem->book_id)->first();
                $cartItem->subtotal = $cartItem->quantity * $targetBook->harga;
                $cartItem->save();
            }
        }

        $userId = auth()->id();
        $crot = Cart::where('user_id', $userId)->where('status', 'antrean')->with('book')->orderBy('updated_at', 'desc')->get();
        $count = Cart::where('user_id', $userId)->where('status', 'antrean')->with('book')->count();
        $total = Cart::where('user_id', $userId)->where('status', 'antrean')->sum('subtotal');

        // Mengembalikan HTML untuk tampilan keranjang yang diperbarui
        $html = view('template.cart', ['crot' => $crot])->render();
        $xml = view('template.cart-kurung', ['count' => $count])->render();
        $ss = view('template.cart-keranjang', ['hitung' => $count])->render();
        $total = view('template.total', ['total'=> $total, 'count'=>$count])->render();

        return response()->json([
            'success' => true,
            'html' => $html,
            'xml' => $xml,
            'ss' => $ss,
            'total' => $total,
        ]);
    }

    public function tambahPro(Request $request)
    {
        $cartItem = Cart::where('id', $request->cart_id)
            ->where('user_id', $request->user_id)->where('status', 'antrean')
            ->first();

        if ($cartItem) {
            $cartItem->quantity++;
            $targetBook = Book::where('id', $cartItem->book_id)->first();
            $cartItem->subtotal = $cartItem->quantity * $targetBook->harga;
            $cartItem->save();
        }

        $userId = auth()->id();
        $crot = Cart::where('user_id', $userId)->where('status', 'antrean')->with('book')->orderBy('updated_at', 'desc')->get();
        $count = Cart::where('user_id', $userId)->where('status', 'antrean')->with('book')->count();
        $total = Cart::where('user_id', $userId)->where('status', 'antrean')->sum('subtotal');

        // Mengembalikan HTML untuk tampilan keranjang yang diperbarui
        $html = view('template.cart', ['crot' => $crot])->render();
        $xml = view('template.cart-kurung', ['count' => $count])->render();
        $ss = view('template.cart-keranjang', ['hitung' => $count])->render();
        $total = view('template.total', ['total'=> $total, 'count'=>$count])->render();

        return response()->json([
            'success' => true,
            'html' => $html,
            'xml' => $xml,
            'ss' => $ss,
            'total' => $total,
        ]);
    }

    public function deleteAll(Request $request) {
        $userId = auth()->id();

        Cart::where('user_id', $userId)->where('status', 'antrean')->delete();


        $crot = Cart::where('user_id', $userId)->where('status', 'antrean')->with('book')->orderBy('updated_at', 'desc')->get();
        $count = Cart::where('user_id', $userId)->where('status', 'antrean')->with('book')->count();
        $total = Cart::where('user_id', $userId)->where('status', 'antrean')->sum('subtotal');

        $html = view('template.cart', ['crot' => $crot])->render();
        $xml = view('template.cart-kurung', ['count' => $count])->render();
        $ss = view('template.cart-keranjang', ['hitung' => $count])->render();
        $total = view('template.total', ['total'=> $total, 'count'=>$count])->render();

        return response()->json([
            'success' => true,
            'html' => $html,
            'xml' => $xml,
            'ss' => $ss,
            'total' => $total,
        ]);
    }
}
