<x-app-layout>
    {{-- Sayfa Başlığı --}}
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-800 leading-tight">
            {{ __('Financial Items') }}
        </h2>
    </x-slot>

    <head>
        <style>
            body, html {
                background: #f6f7fa;
            }
            .dashboard-container {
                max-width: 950px;
                margin: 40px auto 0 auto;
                padding: 0 24px;
            }
            .dashboard-title {
                font-size: 2rem;
                font-weight: 700;
                color: #222;
                margin-bottom: 32px;
            }
            .category-card {
                background: #fff;
                border-radius: 18px;
                box-shadow: 0 4px 24px 0 rgba(30,34,90,0.07);
                padding: 40px 36px 32px 36px;
                margin-bottom: 32px;
                display: flex;
                flex-direction: column;
                align-items: center;
            }
            .category-header {
                display: flex;
                width: 100%;
                justify-content: space-between;
                align-items: center;
                margin-bottom: 32px;
            }
            .category-info {
                text-align: left;
            }
            .category-info h3 {
                font-size: 1.3rem;
                font-weight: 700;
                margin-bottom: 6px;
            }
            .category-info p {
                color: #6b7280;
                font-size: 1rem;
            }
            .btn-blue {
                background: #2563eb;
                color: #fff;
                border: none;
                border-radius: 4px;
                padding: 10px 22px;
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
            .btn-blue:hover {
                background: #1d4ed8;
            }
            .btn-blue svg {
                margin-right: 8px;
            }
            .category-table {
                width: 100%;
                border-collapse: separate;
                border-spacing: 0;
                background: #fff;
                border-radius: 12px;
                box-shadow: 0 2px 12px 0 rgba(30,34,90,0.04);
                overflow: hidden;
            }
            .category-table th, .category-table td {
                padding: 16px 18px;
                text-align: left;
            }
            .category-table th {
                background: #f3f4f6;
                color: #6b7280;
                font-size: 0.95rem;
                font-weight: 700;
                letter-spacing: 0.04em;
            }
            .category-table tr:not(:last-child) {
                border-bottom: 1px solid #e5e7eb;
            }
            .category-table td {
                font-size: 1rem;
                color: #222;
            }
            .category-table .actions {
                text-align: right;
            }
            .btn-group {
                display: flex;
                gap: 10px;
            }
            @media (max-width: 700px) {
                .dashboard-container { padding: 0 4px; }
                .category-card { padding: 18px 6px; }
                .category-header { flex-direction: column; gap: 18px; align-items: flex-start; }
                .category-table th, .category-table td { padding: 10px 6px; font-size: 0.95rem; }
            }
        </style>
    </head>

    <div class="dashboard-container">
        {{-- Finansal Özet Kutuları ve Raporlar Butonu --}}
        <div style="display:flex; gap:24px; align-items:center; margin-bottom:32px; flex-wrap:wrap;">
            <div style="flex:1; min-width:180px; background:#fff; border-radius:14px; box-shadow:0 2px 12px 0 rgba(30,34,90,0.06); padding:24px 18px; text-align:center;">
                <div style="font-size:1.1rem; color:#6b7280; margin-bottom:6px;">Total Income</div>
                <div style="font-size:1.5rem; font-weight:700; color:#22c55e;">{{ number_format($totalIncome, 2) }}</div>
            </div>
            <div style="flex:1; min-width:180px; background:#fff; border-radius:14px; box-shadow:0 2px 12px 0 rgba(30,34,90,0.06); padding:24px 18px; text-align:center;">
                <div style="font-size:1.1rem; color:#6b7280; margin-bottom:6px;">Total Expense</div>
                <div style="font-size:1.5rem; font-weight:700; color:#ef4444;">{{ number_format($totalExpense, 2) }}</div>
            </div>
            <div style="flex:1; min-width:180px; background:#fff; border-radius:14px; box-shadow:0 2px 12px 0 rgba(30,34,90,0.06); padding:24px 18px; text-align:center;">
                <div style="font-size:1.1rem; color:#6b7280; margin-bottom:6px;">Balance</div>
                <div style="font-size:1.5rem; font-weight:700; color:#222;">{{ number_format($balance, 2) }}</div>
            </div>
            <a href="{{ route('reports.index') }}" class="btn-blue" style="height:48px; align-self:stretch; display:flex; align-items:center; font-size:1rem; margin-left:auto; min-width:170px; justify-content:center;">Go to Reports</a>
        </div>
        {{-- Son İşlemler Tablosu --}}
        <div class="category-card" style="margin-bottom:0;">
            <div class="category-header">
                <div class="category-info">
                    <h3>Recent Transactions</h3>
                    <p>Last 10 income/expense entries</p>
                </div>
                <a href="{{ route('transactions.index') }}" class="btn-blue">All Transactions</a>
            </div>
            <table class="category-table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Date</th>
                        <th>Category</th>
                        <th>Type</th>
                        <th>Description</th>
                        <th>Amount</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($transactions as $i => $transaction)
                        <tr>
                            <td>{{ $i+1 }}</td>
                            <td>{{ \Carbon\Carbon::parse($transaction->transaction_date)->format('Y-m-d') }}</td>
                            <td>{{ $transaction->category->name ?? '-' }}</td>
                            <td>{{ $transaction->category->type ?? '-' }}</td>
                            <td>{{ $transaction->description }}</td>
                            <td class="{{ ($transaction->category->type ?? '') == 'Gelir' ? 'amount-income' : 'amount-expense' }}">
                                {{ ($transaction->category->type ?? '') == 'Gelir' ? '+' : '-' }}{{ number_format($transaction->amount, 2) }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" style="text-align:center; color:#888;">No transactions found</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        {{-- Kategori Yönetimi Tablosu --}}
        <div class="category-card">
            <div class="category-header">
                <div class="category-info">
                    <h3>Financial Item Management</h3>
                    <p>Create and edit your income and expense items here.</p>
                </div>
                <a href="{{ route('categories.create') }}" class="btn-blue">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/></svg>
                    Add New Financial Item
                </a>
            </div>
            <table class="category-table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Financial Item Name</th>
                        <th>Type</th>
                        <th class="actions">Transactions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($categories as $index => $category)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td style="font-weight:600;">{{ $category->name }}</td>
                            <td style="font-weight:600; color:{{ $category->type == 'Gelir' ? '#22c55e' : '#ef4444' }};">
                                {{ $category->type }}
                            </td>
                            <td class="actions">
                                <div class="btn-group" style="justify-content: flex-end; display: flex; gap: 10px;">
                                    <a href="{{ route('categories.edit', $category) }}" class="btn-blue">Edit</a>
                                    <form action="{{ route('categories.destroy', $category) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-blue">Delete</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" style="text-align:center; color:#888;">No financial item found yet</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
