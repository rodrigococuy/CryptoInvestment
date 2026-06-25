<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class TestApiConnection extends Command
{
    // Esta es la firma que hará que el comando aparezca en el 'list'
    protected $signature = 'test:api';
    protected $description = 'Prueba de conexion con CoinMarketCap';

    public function handle()
    {
        $this->info('Conectando con CoinMarketCap...');
        
        // Pega aquí tu API Key real
        $apiKey = 'eb0f46645f834894a980ca86ce338c0a'; 
        
        $response = Http::withHeaders([
            'X-CMC_PRO_API_KEY' => $apiKey,
            'Accept' => 'application/json'
        ])->get('https://pro-api.coinmarketcap.com/v1/cryptocurrency/listings/latest', [
            'limit' => 1
        ]);

        if ($response->successful()) {
            $this->info('¡ÉXITO! La API responde.');
            $this->line('Nombre de la moneda: ' . $response->json()['data'][0]['name']);
        } else {
            $this->error('Error de API: ' . $response->status());
        }
    }
}
