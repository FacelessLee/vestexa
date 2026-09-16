<?php
namespace App\Traits;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;

trait Apitrait
{
    public function get_rate($coin, $currency = 'usd')
    {
        try {
            // Cache the rate for 2 minutes to avoid API limits
            $cacheKey = "crypto_rate_{$coin}_{$currency}";
            
            return Cache::remember($cacheKey, 120, function() use ($coin, $currency) {
                // Convert coin symbol to CoinGecko ID
                $coinId = $this->getCoinGeckoId($coin);
                
                // Fetch from CoinGecko (free, reliable API)
                $response = Http::timeout(10)->get("https://api.coingecko.com/api/v3/simple/price", [
                    'ids' => $coinId,
                    'vs_currencies' => $currency,
                    'precision' => 8
                ]);
                
                if ($response->successful()) {
                    $data = $response->json();
                    return $data[$coinId][$currency] ?? 0;
                }
                
                // Fallback: return cached value or 0
                return Cache::get($cacheKey . '_fallback', 0);
            });
            
        } catch (\Exception $e) {
            \Log::error('Crypto rate API error: ' . $e->getMessage());
            // Return cached fallback or reasonable default
            return Cache::get("crypto_rate_{$coin}_{$currency}_fallback", 0);
        }
    }
    
    private function getCoinGeckoId($symbol)
    {
        $mapping = [
            'btc' => 'bitcoin',
            'eth' => 'ethereum', 
            'usdt' => 'tether',
            'link' => 'chainlink',
            'ltc' => 'litecoin',
            'bch' => 'bitcoin-cash',
            'xrp' => 'ripple',
            'bnb' => 'binancecoin',
            'ada' => 'cardano',
            'xlm' => 'stellar',
            'aave' => 'aave',
        ];
        
        return $mapping[strtolower($symbol)] ?? strtolower($symbol);
    }
}