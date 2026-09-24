<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Pencatat Pengeluaran</title>
</head>
<body style="font-family: sans-serif; max-width: 500px; margin: 40px auto; padding: 20px; border: 1px solid #ccc; border-radius: 10px;">
    
    <h2 style="text-align: center;">Catatan Pengeluaran </h2>
    <h3 style="color: #d9534f; text-align: center;">Total: Rp {{ number_format($total, 0, ',', '.') }}</h3>

    <!-- Form Filter Hari -->
    <form action="{{ route('expenses.index') }}" method="GET" style="margin-bottom: 20px; text-align: center; background-color: #f1f1f1; padding: 10px; border-radius: 5px;">
        <label for="day" style="font-weight: bold;">Tampilkan Hari: </label>
        <select name="day" id="day" style="padding: 5px; margin-right: 10px;">
            <option value="semua" {{ request('day') == 'semua' ? 'selected' : '' }}>Semua Hari</option>
            <option value="1" {{ request('day') == '1' ? 'selected' : '' }}>Senin</option>
            <option value="2" {{ request('day') == '2' ? 'selected' : '' }}>Selasa</option>
            <option value="3" {{ request('day') == '3' ? 'selected' : '' }}>Rabu</option>
            <option value="4" {{ request('day') == '4' ? 'selected' : '' }}>Kamis</option>
            <option value="5" {{ request('day') == '5' ? 'selected' : '' }}>Jumat</option>
            <option value="6" {{ request('day') == '6' ? 'selected' : '' }}>Sabtu</option>
            <option value="7" {{ request('day') == '7' ? 'selected' : '' }}>Minggu</option>
        </select>
        <button type="submit" style="padding: 5px 15px; background-color: #0275d8; color: white; border: none; cursor: pointer; border-radius: 3px;">Filter</button>
    </form>

    <!-- Form Tambah -->
    <form action="{{ route('expenses.store') }}" method="POST" style="display: flex; gap: 10px; margin-bottom: 20px;">
        @csrf
        <input type="text" name="title" placeholder="Beli apa?" required style="flex: 2; padding: 8px;">
        <input type="number" name="amount" placeholder="Harga (Rp)" required style="flex: 1; padding: 8px;">
        <button type="submit" style="padding: 8px; background-color: #5cb85c; color: white; border: none; cursor: pointer; border-radius: 3px;">Tambah</button>
    </form>

    <hr>

    <!-- Daftar List -->
    <ul style="list-style-type: none; padding: 0;">
        @forelse($expenses as $expense)
            <li style="display: flex; justify-content: space-between; margin-bottom: 10px; padding: 10px; background-color: #f9f9f9;">
                <span>
                    <strong>{{ $expense->title }}</strong> <br>
                    <small style="color: gray;">{{ $expense->created_at->format('l, d M Y') }}</small>
                </span>
                <div style="display: flex; align-items: center; gap: 15px;">
                    <span>Rp {{ number_format($expense->amount, 0, ',', '.') }}</span>
                    <form action="{{ route('expenses.destroy', $expense->id) }}" method="POST">
                        @csrf @method('DELETE')
                        <button type="submit" style="color: red; border: none; background: none; cursor: pointer; font-weight: bold;">X</button>
                    </form>
                </div>
            </li>
        @empty
            <li style="text-align: center; color: gray; padding: 10px;">Tidak ada pengeluaran di hari ini.</li>
        @endforelse
    </ul>

</body>
</html>