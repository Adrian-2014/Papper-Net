<?php

namespace App\Http\Controllers;

use App\Models\book;
use App\Models\cart;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class userControl extends Controller
{
    public function welcome() {
        // For Buku

        $buku = book::inRandomOrder()->get();

        $userId = auth()->id();
        $crot = Cart::where('user_id', $userId)->where('status', 'antrean')->with('book')->orderBy('updated_at', 'desc')->get();
        $count = Cart::where('user_id', $userId)->where('status', 'antrean')->with('book')->count();
        $hitung = Cart::where('user_id', $userId)->where('status', 'antrean')->with('book')->count();
        $total = Cart::where('user_id', $userId)->where('status', 'antrean')->sum('subtotal');

        return view('welcome', compact('buku', 'crot', 'count', 'hitung', 'total'));

        // For Buku
    }
}
