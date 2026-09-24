<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use Illuminate\Http\Request;

class ExpenseController extends Controller
{
   public function index(Request $request)
    {
        // Ambil semua data pengeluaran
        $expenses = Expense::all();

        // Jika user memilih filter hari (dan bukan 'semua')
        if ($request->has('day') && $request->day != 'semua') {
            $expenses = $expenses->filter(function ($expense) use ($request) {
                // format('N') mengubah tanggal menjadi angka 1 (Senin) s.d. 7 (Minggu)
                return $expense->created_at->format('N') == $request->day;
            });
        }

        // Hitung total dari data yang sudah difilter
        $total = $expenses->sum('amount'); 
        
        return view('expenses', compact('expenses', 'total'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'amount' => 'required|numeric'
        ]);
        Expense::create($request->all());
        return redirect()->back();
    }

    public function destroy(Expense $expense)
    {
        $expense->delete();
        return redirect()->back();
    }
}