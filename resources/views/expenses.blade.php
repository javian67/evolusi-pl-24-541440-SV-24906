<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pencatat Pengeluaran</title>
    <style>
        * { box-sizing: border-box; }
        body {
            margin: 0;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, #fff7ed 0%, #f3f4f6 100%);
            font-family: Arial, sans-serif;
            color: #1f2937;
        }
        .card {
            width: min(560px, 92vw);
            background: #ffffff;
            border-radius: 20px;
            padding: 28px 22px;
            box-shadow: 0 18px 45px rgba(15, 23, 42, 0.12);
            border: 1px solid #e5e7eb;
        }
        h2 {
            margin: 0 0 10px;
            text-align: center;
            color: #111827;
            font-size: 28px;
        }
        .total {
            margin: 0 0 22px;
            padding: 14px 16px;
            text-align: center;
            border-radius: 12px;
            background: linear-gradient(135deg, #fee2e2 0%, #fef2f2 100%);
            color: #b91c1c;
            font-size: 20px;
            font-weight: 700;
        }
        .filter-box {
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            padding: 14px 12px;
            margin-bottom: 18px;
        }
        .filter-box label {
            font-weight: 700;
            margin-right: 8px;
        }
        .filter-box select,
        .field,
        .btn,
        .edit-btn,
        .delete-btn,
        .cancel-btn {
            font: inherit;
        }
        .filter-box select,
        .field {
            padding: 10px 12px;
            border: 1px solid #d1d5db;
            border-radius: 10px;
            background: #fff;
        }
        .filter-box button,
        .btn,
        .edit-btn,
        .cancel-btn {
            border: none;
            border-radius: 10px;
            padding: 10px 16px;
            font-weight: 700;
            cursor: pointer;
            transition: 0.2s ease;
            text-decoration: none;
            display: inline-block;
        }
        .filter-box button {
            background: #2563eb;
            color: white;
        }
        .filter-box button:hover,
        .btn:hover,
        .edit-btn:hover,
        .cancel-btn:hover {
            transform: translateY(-1px);
            filter: brightness(0.98);
        }
        .add-form, .edit-form {
            display: grid;
            grid-template-columns: 1.4fr 1fr auto;
            gap: 10px;
            margin-bottom: 18px;
        }
        .field {
            width: 100%;
        }
        .btn {
            background: #22c55e;
            color: white;
        }
        .edit-btn {
            background: #f59e0b;
            color: white;
            padding: 8px 12px;
            font-size: 13px;
        }
        .cancel-btn {
            background: #e5e7eb;
            color: #374151;
            padding: 10px 14px;
        }
        .divider {
            border: none;
            border-top: 1px solid #e5e7eb;
            margin: 18px 0;
        }
        .expense-list {
            list-style: none;
            padding: 0;
            margin: 0;
            display: flex;
            flex-direction: column;
            gap: 12px;
        }
        .expense-item {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            background: #f9fafb;
            border: 1px solid #e5e7eb;
            border-radius: 12px;
            padding: 12px 14px;
        }
        .expense-name {
            font-weight: 700;
            color: #111827;
        }
        .expense-date {
            display: block;
            color: #6b7280;
            font-size: 12px;
            margin-top: 4px;
        }
        .expense-meta {
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .amount {
            font-weight: 700;
            color: #111827;
        }
        .delete-btn {
            background: #fee2e2;
            color: #b91c1c;
            border: 1px solid #fecaca;
            border-radius: 10px;
            padding: 8px 12px;
            font-weight: 700;
            cursor: pointer;
        }
        .delete-btn:hover {
            background: #fecaca;
        }
        .empty-state {
            text-align: center;
            color: #6b7280;
            padding: 18px 10px;
            background: #f8fafc;
            border-radius: 10px;
            border: 1px dashed #d1d5db;
        }
        .edit-section {
            margin-top: 18px;
            padding: 14px;
            border: 1px solid #fbbf24;
            background: #fffbeb;
            border-radius: 12px;
        }
        @media (max-width: 520px) {
            .add-form, .edit-form {
                grid-template-columns: 1fr;
            }
            .expense-item {
                flex-direction: column;
                align-items: flex-start;
            }
            .expense-meta {
                width: 100%;
                justify-content: space-between;
            }
        }
    </style>
</head>
<body>
    <div class="card">
        <h2>Catatan Pengeluaran</h2>
        <div class="total">Total: Rp {{ number_format($total, 0, ',', '.') }}</div>

        <form action="{{ route('expenses.index') }}" method="GET" class="filter-box">
            <label for="day">Tampilkan Hari:</label>
            <select name="day" id="day">
                <option value="semua" {{ request('day') == 'semua' ? 'selected' : '' }}>Semua Hari</option>
                <option value="1" {{ request('day') == '1' ? 'selected' : '' }}>Senin</option>
                <option value="2" {{ request('day') == '2' ? 'selected' : '' }}>Selasa</option>
                <option value="3" {{ request('day') == '3' ? 'selected' : '' }}>Rabu</option>
                <option value="4" {{ request('day') == '4' ? 'selected' : '' }}>Kamis</option>
                <option value="5" {{ request('day') == '5' ? 'selected' : '' }}>Jumat</option>
                <option value="6" {{ request('day') == '6' ? 'selected' : '' }}>Sabtu</option>
                <option value="7" {{ request('day') == '7' ? 'selected' : '' }}>Minggu</option>
            </select>
            <button type="submit">Filter</button>
        </form>

        <form action="{{ route('expenses.store') }}" method="POST" class="add-form">
            @csrf
            <input type="text" name="title" placeholder="Beli apa?" required class="field">
            <input type="text" id="amountInput" placeholder="Harga (Rp)" required class="field" inputmode="numeric" autocomplete="off">
            <input type="hidden" name="amount" id="amountHidden" required>
            <button type="submit" class="btn">Tambah</button>
        </form>

        @if($editingExpense)
            <div class="edit-section">
                <form action="{{ route('expenses.update', $editingExpense->id) }}" method="POST" class="edit-form">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="day" value="{{ request('day', 'semua') }}">
                    <input type="text" name="title" value="{{ $editingExpense->title }}" required class="field">
                    <input type="text" id="editAmountInput" value="{{ number_format($editingExpense->amount, 0, ',', '.') }}" class="field" inputmode="numeric" autocomplete="off">
                    <input type="hidden" name="amount" id="editAmountHidden" value="{{ $editingExpense->amount }}">
                    <button type="submit" class="btn">Simpan</button>
                    <a href="{{ route('expenses.index', ['day' => request('day', 'semua')]) }}" class="cancel-btn">Batal</a>
                </form>
            </div>
        @endif

        <hr class="divider">

        <ul class="expense-list">
            @forelse($expenses as $expense)
                <li class="expense-item">
                    <div>
                        <span class="expense-name">{{ $expense->title }}</span>
                        <small class="expense-date">{{ $expense->created_at->format('l, d M Y') }}</small>
                    </div>
                    <div class="expense-meta">
                        <span class="amount">Rp {{ number_format($expense->amount, 0, ',', '.') }}</span>
                        <a href="{{ route('expenses.index', ['edit' => $expense->id, 'day' => request('day')]) }}" class="edit-btn">Edit</a>
                        <form action="{{ route('expenses.destroy', $expense->id) }}" method="POST">
                            @csrf @method('DELETE')
                            <button type="submit" class="delete-btn">Hapus</button>
                        </form>
                    </div>
                </li>
            @empty
                <li class="empty-state">Tidak ada pengeluaran di hari ini.</li>
            @endforelse
        </ul>
    </div>

    <script>
        function formatRupiah(value) {
            const cleanValue = value.replace(/\D/g, '');
            if (!cleanValue) return '';
            return new Intl.NumberFormat('id-ID').format(Number(cleanValue));
        }

        function setupCurrencyInput(inputId, hiddenId, formSelector = null) {
            const input = document.getElementById(inputId);
            const hidden = document.getElementById(hiddenId);

            if (!input || !hidden) return;

            input.addEventListener('input', function () {
                const rawValue = this.value.replace(/\D/g, '');
                this.value = rawValue ? formatRupiah(rawValue) : '';
                hidden.value = rawValue || '';
            });

            if (formSelector) {
                const form = document.querySelector(formSelector);
                if (form) {
                    form.addEventListener('submit', function (event) {
                        if (!hidden.value) {
                            event.preventDefault();
                            input.focus();
                        }
                    });
                }
            }
        }

        setupCurrencyInput('amountInput', 'amountHidden', '.add-form');
        setupCurrencyInput('editAmountInput', 'editAmountHidden', '.edit-form');
    </script>
</body>
</html>