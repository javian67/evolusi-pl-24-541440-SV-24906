<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use Illuminate\Http\Request;

class ExpenseController extends Controller
{
   public function index(Request $request)
    {
        $expenses = Expense::all();

        if ($request->has('day') && $request->day != 'semua') {
            $expenses = $expenses->filter(function ($expense) use ($request) {
                return $expense->created_at->format('N') == $request->day;
            });
        }

        $total = $expenses->sum('amount');
        $editingExpense = null;

        if ($request->filled('edit')) {
            $editingExpense = Expense::find($request->edit);
        }

        return view('expenses', compact('expenses', 'total', 'editingExpense'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'amount' => 'required|numeric'
        ]);

        Expense::create([
            'title' => $request->title,
            'amount' => (int) $request->amount,
        ]);

        return redirect()->back();
    }

    public function edit(Expense $expense)
    {
        return redirect()->route('expenses.index', ['edit' => $expense->id, 'day' => request('day')]);
    }

    public function update(Request $request, Expense $expense)
    {
        $request->validate([
            'title' => 'required',
            'amount' => 'required|numeric',
        ]);

        $expense->update([
            'title' => $request->title,
            'amount' => (int) $request->amount,
        ]);

        return redirect()->route('expenses.index', ['day' => request('day')]);
    }

    public function destroy(Expense $expense)
    {
        $expense->delete();
        return redirect()->back();
    }
}