<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Finance Report</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 13px; color: #222; }
        h2 { text-align: center; margin-bottom: 18px; }
        .section-title { font-size: 1.1rem; font-weight: bold; margin: 18px 0 8px 0; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 18px; }
        th, td { border: 1px solid #e5e7eb; padding: 8px 10px; text-align: left; }
        th { background: #f3f4f6; font-weight: bold; }
        .amount-income { color: #22c55e; font-weight:600; }
        .amount-expense { color: #ef4444; font-weight:600; }
        .totals-row td { font-weight:700; background:#f9fafb; }
    </style>
</head>
<body>
    <h2>Finance Report</h2>
    <div><strong>Period:</strong> {{ $start->format('Y-m-d') }} - {{ $end->format('Y-m-d') }}</div>
    <div class="section-title">Summary by Category</div>
    <table>
        <thead>
            <tr>
                <th>Category</th>
                <th>Type</th>
                <th>Transaction Count</th>
                <th>Total Amount</th>
            </tr>
        </thead>
        <tbody>
            @forelse($summary as $item)
                <tr>
                    <td>{{ $item['category'] }}</td>
                    <td>{{ $item['type'] }}</td>
                    <td>{{ $item['count'] }}</td>
                    <td class="{{ $item['type'] == 'Income' ? 'amount-income' : 'amount-expense' }}">{{ number_format($item['total'], 2) }}</td>
                </tr>
            @empty
                <tr><td colspan="4" style="text-align:center; color:#888;">No data</td></tr>
            @endforelse
            <tr class="totals-row">
                <td colspan="3">Total Income</td>
                <td class="amount-income">{{ number_format($totalIncome, 2) }}</td>
            </tr>
            <tr class="totals-row">
                <td colspan="3">Total Expense</td>
                <td class="amount-expense">{{ number_format($totalExpense, 2) }}</td>
            </tr>
            <tr class="totals-row">
                <td colspan="3">Balance</td>
                <td style="font-weight:700; color:#222;">{{ number_format($balance, 2) }}</td>
            </tr>
        </tbody>
    </table>
    <div class="section-title">Analysis</div>
    <table>
        <thead>
            <tr>
                <th></th>
                <th>Min</th>
                <th>Max</th>
                <th>Average</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Income</td>
                <td class="amount-income">{{ number_format($analysis['income_min'], 2) }}</td>
                <td class="amount-income">{{ number_format($analysis['income_max'], 2) }}</td>
                <td class="amount-income">{{ number_format($analysis['income_avg'], 2) }}</td>
            </tr>
            <tr>
                <td>Expense</td>
                <td class="amount-expense">{{ number_format($analysis['expense_min'], 2) }}</td>
                <td class="amount-expense">{{ number_format($analysis['expense_max'], 2) }}</td>
                <td class="amount-expense">{{ number_format($analysis['expense_avg'], 2) }}</td>
            </tr>
        </tbody>
    </table>
</body>
</html> 