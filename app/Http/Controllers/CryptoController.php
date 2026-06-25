<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use App\Models\Crypto;

class CryptoController extends Controller
{
    public function index()
    {
        $response = Http::withHeaders([
            'X-CMC_PRO_API_KEY' => config('services.coinmarketcap.key'),
            'Accept' => 'application/json'
        ])->get('https://pro-api.coinmarketcap.com/v1/cryptocurrency/listings/latest', [
            'limit' => 5
        ]);

        if ($response->successful()) {
            $data = $response->json()['data'];
            foreach ($data as $coin) {
                Crypto::updateOrCreate(
                    ['symbol' => $coin['symbol']],
                    [
                        'name' => $coin['name'],
                        'price' => $coin['quote']['USD']['price'] ?? 0,
                        'percent_change_24h' => $coin['quote']['USD']['percent_change_24h'] ?? 0
                    ]
                );
            }
        }

        $cryptos = Crypto::all();
        return view('dashboard', compact('cryptos'));
    }
}
