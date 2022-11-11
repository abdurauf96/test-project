<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;

class HomeController extends Controller
{
    public function home()
    {
        $books=Book::with(['authors', 'publishers'])->paginate(3);
    
        if (request()->ajax()) {
            return view('sections.books', compact('books'));
        }

        return view('home', compact('books'));
    }
}
