<x-app-layout>
<head>
    <style>
        .form-card {
            background: #fff;
            border-radius: 18px;
            box-shadow: 0 4px 24px 0 rgba(30,34,90,0.07);
            padding: 40px 36px 32px 36px;
            max-width: 420px;
            margin: 40px auto;
        }
        .form-title {
            font-size: 1.3rem;
            font-weight: 700;
            margin-bottom: 18px;
            color: #222;
        }
        .form-group { margin-bottom: 22px; }
        .form-label { display:block; font-weight:600; margin-bottom:7px; color:#222; }
        .form-input, .form-select {
            width: 100%;
            border: 1px solid #e5e7eb;
            border-radius: 6px;
            padding: 10px 12px;
            font-size: 1rem;
            color: #222;
            background: #f9fafb;
        }
        .form-input:focus, .form-select:focus { outline: 2px solid #2563eb; }
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
        .btn-blue:hover { background: #1d4ed8; }
    </style>
</head>
<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Edit Financial Item
    </h2>
</x-slot>
<div class="form-card">
    <a href="{{ route('dashboard') }}" class="btn-blue" style="margin-bottom: 18px; display: inline-block;">&larr; Back</a>
    <div class="form-title">Edit Financial Item</div>
    <form action="{{ route('categories.update', $category) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="name" class="form-label">Financial Item Name</label>
            <input type="text" name="name" id="name" required class="form-input" value="{{ old('name', $category->name) }}">
        </div>
        <div class="form-group">
            <label for="type" class="form-label">Type</label>
            <select name="type" id="type" required class="form-select">
                <option value="Income" {{ old('type', $category->type) == 'Income' ? 'selected' : '' }}>Income</option>
                <option value="Expense" {{ old('type', $category->type) == 'Expense' ? 'selected' : '' }}>Expense</option>
            </select>
        </div>
        <button type="submit" class="btn-blue">Save</button>
    </form>
</div>
</x-app-layout>
