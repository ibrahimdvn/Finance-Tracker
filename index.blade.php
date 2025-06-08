<x-app-layout>
<head>
    <style>
        .trans-card {
            background: #fff;
            border-radius: 18px;
            box-shadow: 0 4px 24px 0 rgba(30,34,90,0.07);
            padding: 40px 36px 32px 36px;
            max-width: 1050px;
            margin: 40px auto;
        }
        .trans-title {
            font-size: 1.3rem;
            font-weight: 700;
            margin-bottom: 18px;
            color: #222;
        }
        .trans-table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 2px 12px 0 rgba(30,34,90,0.04);
            overflow: hidden;
        }
        .trans-table th, .trans-table td {
            padding: 14px 16px;
            text-align: left;
        }
        .trans-table th {
            background: #f3f4f6;
            color: #6b7280;
            font-size: 0.95rem;
            font-weight: 700;
            letter-spacing: 0.04em;
        }
        .trans-table tr:not(:last-child) {
            border-bottom: 1px solid #e5e7eb;
        }
        .trans-table td {
            font-size: 1rem;
            color: #222;
        }
        .trans-table .actions {
            text-align: right;
        }
        .btn-group {
            display: flex;
            gap: 10px;
            justify-content: flex-end;
        }
        .btn-blue {
            background: #2563eb;
            color: #fff;
            border: none;
            border-radius: 4px;
            padding: 8px 18px;
            font-weight: 600;
            font-size: 15px;
            cursor: pointer;
            transition: background 0.2s;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            text-transform: uppercase;
            letter-spacing: 0.03em;
        }
        .btn-blue:hover { background: #1d4ed8; }
        .amount-income { color: #22c55e; font-weight:600; }
        .amount-expense { color: #ef4444; font-weight:600; }
        @media (max-width: 900px) {
            .trans-card { padding: 18px 6px; }
            .trans-table th, .trans-table td { padding: 10px 6px; font-size: 0.95rem; }
        }
    </style>
</head>
<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Transactions
    </h2>
</x-slot>
<div class="trans-card">
    <div class="trans-title">Transactions</div>
    <a href="{{ route('transactions.create') }}" class="btn-blue" style="margin-bottom:18px; float:right;">Add Transaction</a>
    <table class="trans-table">
        <thead>
            <tr>
                <th>No</th>
                <th>Date</th>
                <th>Category</th>
                <th>Type</th>
                <th>Description</th>
                <th>Amount</th>
                <th class="actions">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($transactions as $i => $transaction)
                <tr>
                    <td>{{ $transactions->firstItem() + $i }}</td>
                    <td>{{ \Carbon\Carbon::parse($transaction->transaction_date)->format('Y-m-d') }}</td>
                    <td>{{ $transaction->category->name ?? '-' }}</td>
                    <td>{{ $transaction->category->type ?? '-' }}</td>
                    <td>{{ $transaction->description }}</td>
                    <td class="{{ ($transaction->category->type ?? '') == 'Income' ? 'amount-income' : 'amount-expense' }}">
                        {{ ($transaction->category->type ?? '') == 'Income' ? '+' : '-' }}{{ number_format($transaction->amount, 2) }}
                    </td>
                    <td class="actions">
                        <div class="btn-group">
                            <a href="{{ route('transactions.edit', $transaction) }}" class="btn-blue">Edit</a>
                            <form action="{{ route('transactions.destroy', $transaction) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-blue">Delete</button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" style="text-align:center; color:#888;">No transaction found yet</td>
                </tr>
            @endforelse
        </tbody>
    </table>
    <div style="margin-top:18px;">{{ $transactions->links() }}</div>
</div>
</x-app-layout>
