<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Loan;
use App\Models\LoanDetail;
use App\Models\Book;
use App\Models\User;

class LoanController extends Controller
{
    public function index()
    {
        $data['books'] = Book::with('bookshelf')->get();
        return view('loans.index', $data);
    }

    public function create(Request $request)
    {
        $books = Book::all(); // Semua buku untuk dropdown jika user memilih lebih dari satu buku.
        $selectedBook = null;

        if ($request->has('book_id')) {
            $selectedBook = Book::find($request->book_id);
        }

        return view('loans.create', compact('books', 'selectedBook'));
    }

    public function store(Request $request)
    {

        // dd($request->all());
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'loan_at' => 'required|date',
            'return_at' => 'required|date|after_or_equal:loan_at',
            'book_ids' => 'required|array',
            'book_ids.*' => 'exists:books,id',
        ]);

        // Create Loan
        $loan = Loan::create([
            'user_id' => $validated['user_id'],
            'loan_at' => $validated['loan_at'],
            'return_at' => $validated['return_at'],
        ]);

        // Create Loan Details
        foreach ($validated['book_ids'] as $book_id) {
            LoanDetail::create([
                'loan_id' => $loan->id,
                'book_id' => $book_id,
                'is_return' => false,
            ]);
        }
        $notification = array(
            'message' => 'Buku Berhasil Dipinjam',
            'alert-type' => 'success'
        );

        return redirect()->route('loan')->with($notification);
    }

    
}
