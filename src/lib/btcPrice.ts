// BTC price fetcher with fallback
const FALLBACK_BTC_PRICE = 97850; // Reasonable fallback
const CACHE_KEY = 'vestexa_btc_price';
const CACHE_DURATION = 5 * 60 * 1000; // 5 minutes

interface CachedPrice {
  price: number;
  timestamp: number;
}

export async function getBtcPrice(): Promise<number> {
  // Check cache first
  try {
    const cached = localStorage.getItem(CACHE_KEY);
    if (cached) {
      const data: CachedPrice = JSON.parse(cached);
      if (Date.now() - data.timestamp < CACHE_DURATION) {
        return data.price;
      }
    }
  } catch {
    // cache miss, continue
  }

  // Try CoinGecko free API
  try {
    const res = await fetch(
      'https://api.coingecko.com/api/v3/simple/price?ids=bitcoin&vs_currencies=usd',
      { signal: AbortSignal.timeout(5000) }
    );
    if (res.ok) {
      const data = await res.json();
      const price = data.bitcoin?.usd;
      if (typeof price === 'number' && price > 0) {
        localStorage.setItem(CACHE_KEY, JSON.stringify({ price, timestamp: Date.now() }));
        return price;
      }
    }
  } catch {
    // API unavailable, use fallback
  }

  return FALLBACK_BTC_PRICE;
}

export function usdToBtc(usd: number, btcPrice: number): string {
  if (btcPrice <= 0) return '0.000000';
  return (usd / btcPrice).toFixed(6);
}
