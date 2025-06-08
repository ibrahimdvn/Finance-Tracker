<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        $transactions = \App\Models\Transaction::with('category')->latest('transaction_date')->take(10)->get();
        $totalIncome = \App\Models\Transaction::whereHas('category', function($q) { $q->where('type', 'Income'); })->sum('amount');
        $totalExpense = \App\Models\Transaction::whereHas('category', function($q) { $q->where('type', 'Expense'); })->sum('amount');
        $balance = $totalIncome - $totalExpense;
        return view('dashboard', compact('categories', 'transactions', 'totalIncome', 'totalExpense', 'balance'));
    }

    public function create()
    {
        return view('categories.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|string|max:255',
        ]);

        Category::create($request->all());

        return redirect()->route('dashboard')->with('success', 'Category added.');
    }

    public function edit(Category $category)
    {
        return view('categories.edit', compact('category'));
    }

    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|string|max:255',
        ]);
        $category->update($request->all());
        return redirect()->route('dashboard')->with('success', 'Category updated successfully.');
    }

    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->route('dashboard')->with('success', 'Category deleted successfully.');
    }
}
