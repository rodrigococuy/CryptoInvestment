<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use App\Models\Crypto;

class CryptoController extends Controller
{
    public function index()
    {
        // 1. Llamar a la API
        $response = Http::withHeaders([
            'X-CMC_PRO_API_KEY' => config('services.coinmarketcap.key'),
            'Accept' => 'application/json'
        ])->get('https://pro-api.coinmarketcap.com/v1/cryptocurrency/listings/latest', [
            'limit' => 5
        ]);

        if ($response->successful()) {
            $data = $response->json()['data'];

            // 2. Persistir en la base de datos (Upsert)
            foreach ($data as $coin) {
                Crypto::updateOrCreate(
                    ['symbol' => $coin['symbol']],
                    [
                        'name' => $coin['name'],
                        'price' => $coin['quote']['USD']['price'],
                        'percent_change_24h' => $coin['quote']['USD']['percent_change_24h']
                    ]
                );
            }
        }

        // 3. Retornar vista con los datos guardados
        $cryptos = Crypto::all();
        return view('dashboard', compact('cryptos'));
    }
}
