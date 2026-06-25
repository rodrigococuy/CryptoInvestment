<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>CryptoInvestment Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-900 text-white p-8">
    <div class="max-w-4xl mx-auto">
        <h1 class="text-3xl font-bold mb-6 text-blue-400">CryptoInvestment Live</h1>
        
        <table class="w-full bg-slate-800 rounded-lg overflow-hidden">
            <thead class="bg-slate-700 text-left">
                <tr>
                    <th class="p-4">Moneda</th>
                    <th class="p-4">Precio (USD)</th>
                    <th class="p-4">Cambio 24h</th>
                </tr>
            </thead>
            <tbody>
                @foreach($cryptos as $crypto)
                <tr class="border-b border-slate-700">
                    <td class="p-4">{{ $crypto->name }} ({{ $crypto->symbol }})</td>
                    <td class="p-4">${{ number_format($crypto->price, 2) }}</td>
                    <td class="p-4 {{ $crypto->percent_change_24h >= 0 ? 'text-green-400' : 'text-red-400' }}">
                        {{ number_format($crypto->percent_change_24h, 2) }}%
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>
