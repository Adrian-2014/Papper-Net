<?php

namespace App\Http\Controllers;

use App\Models\book;
use Illuminate\Http\Request;

class adminControll extends Controller
{
    public function index() {
        $books = book::inRandomOrder()->get();
        // dd($books->all());
        return view('admin.index', compact('books'));
    }
}
