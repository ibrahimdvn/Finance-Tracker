<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\Category;
use Carbon\Carbon;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        $start = $request->input('start_date') ? Carbon::parse($request->input('start_date')) : Carbon::now()->startOfMonth();
        $end = $request->input('end_date') ? Carbon::parse($request->input('end_date')) : Carbon::now()->endOfMonth();

        $transactions = Transaction::with('category')
            ->whereBetween('transaction_date', [$start, $end])
            ->get();

        $categories = Category::all();

        $summary = $transactions->groupBy('category_id')->map(function($items, $catId) use ($categories) {
            $cat = $categories->where('id', $catId)->first();
            return [
                'category' => $cat ? $cat->name : '-',
                'type' => $cat ? $cat->type : '-',
                'total' => $items->sum('amount'),
                'count' => $items->count(),
            ];
        });

        $totalIncome = $transactions->filter(fn($t) => $t->category && $t->category->type == 'Income')->sum('amount');
        $totalExpense = $transactions->filter(fn($t) => $t->category && $t->category->type == 'Expense')->sum('amount');
        $balance = $totalIncome - $totalExpense;

        $incomeStats = $transactions->filter(fn($t) => $t->category && $t->category->type == 'Income')->pluck('amount');
        $expenseStats = $transactions->filter(fn($t) => $t->category && $t->category->type == 'Expense')->pluck('amount');

        $analysis = [
            'income_min' => $incomeStats->min(),
            'income_max' => $incomeStats->max(),
            'income_avg' => $incomeStats->avg(),
            'expense_min' => $expenseStats->min(),
            'expense_max' => $expenseStats->max(),
            'expense_avg' => $expenseStats->avg(),
        ];

        return view('reports.index', compact('start', 'end', 'summary', 'totalIncome', 'totalExpense', 'balance', 'analysis'));
    }

    public function exportPdf(Request $request)
    {
        $start = $request->input('start_date') ? \Carbon\Carbon::parse($request->input('start_date')) : \Carbon\Carbon::now()->startOfMonth();
        $end = $request->input('end_date') ? \Carbon\Carbon::parse($request->input('end_date')) : \Carbon\Carbon::now()->endOfMonth();

        $transactions = \App\Models\Transaction::with('category')
            ->whereBetween('transaction_date', [$start, $end])
            ->get();
        $categories = \App\Models\Category::all();
        $summary = $transactions->groupBy('category_id')->map(function($items, $catId) use ($categories) {
            $cat = $categories->where('id', $catId)->first();
            return [
                'category' => $cat ? $cat->name : '-',
                'type' => $cat ? $cat->type : '-',
                'total' => $items->sum('amount'),
                'count' => $items->count(),
            ];
        });
        $totalIncome = $transactions->filter(fn($t) => $t->category && $t->category->type == 'Income')->sum('amount');
        $totalExpense = $transactions->filter(fn($t) => $t->category && $t->category->type == 'Expense')->sum('amount');
        $balance = $totalIncome - $totalExpense;
        $incomeStats = $transactions->filter(fn($t) => $t->category && $t->category->type == 'Income')->pluck('amount');
        $expenseStats = $transactions->filter(fn($t) => $t->category && $t->category->type == 'Expense')->pluck('amount');
        $analysis = [
            'income_min' => $incomeStats->min(),
            'income_max' => $incomeStats->max(),
            'income_avg' => $incomeStats->avg(),
            'expense_min' => $expenseStats->min(),
            'expense_max' => $expenseStats->max(),
            'expense_avg' => $expenseStats->avg(),
        ];
        $pdf = \PDF::loadView('reports.pdf', compact('start', 'end', 'summary', 'totalIncome', 'totalExpense', 'balance', 'analysis'));
        return $pdf->download('finance-report.pdf');
    }
} 