<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BookReturn;
use App\Models\Book;
use App\Models\LoanDetail;

class ReturnController extends Controller
{
    public function index()
    {
        // Ambil semua data pengembalian
        $returns = BookReturn::with(['loanDetail.loan', 'loanDetail.book'])->get();

        // Tampilkan data pengembalian ke view
        return view('returns.index', compact('returns'));
    }

    public function create()
    {
        $loanDetails = LoanDetail::where('is_return', false)->with(['book', 'loan.user'])->get();
        return view('return_form', compact('loanDetails'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'loans_detail_id' => 'required|exists:loan_details,id',
            'charge' => 'required|numeric|min:0',
            'amount' => 'required|numeric|min:0',
        ]);

        // Update Loan Detail
        $loanDetail = LoanDetail::findOrFail($validated['loans_detail_id']);
        $loanDetail->update(['is_return' => true]);

        // Create Return Record
        BookReturn::create([
            'loans_detail_id' => $validated['loans_detail_id'],
            'charge' => $validated['charge'],
            'amount' => $validated['amount'],
        ]);

        return redirect()->route('returns.create')->with('success', 'Pengembalian berhasil disimpan.');
    }
}