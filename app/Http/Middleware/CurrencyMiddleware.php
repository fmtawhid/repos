<?php

namespace App\Http\Middleware;

use App\Models\Currency;
use Closure;
use Session;
use Illuminate\Support\Facades\Route;

class CurrencyMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (Session::has('currency_code')) {
            if (Route::has('backend.changeCurrency')) {
                $currency_code = session('currency_code');
                $currency = Currency::where('code', $currency_code)->first();
                if (!is_null($currency)) {
                    $request->session()->put('currency_code',  $currency->code);
                    $request->session()->put('local_currency_rate', $currency->rate);
                    $request->session()->put('currency_symbol', $currency->symbol);
                    $request->session()->put('currency_symbol_alignment', $currency->alignment);
                } else {
                    $request->session()->put('currency_code',  "bdt");
                    $request->session()->put('local_currency_rate', 1);
                    $request->session()->put('currency_symbol', '৳');
                    $request->session()->put('currency_symbol_alignment', 0);
                }
            }
        } elseif (getSetting('default_currency') != null || env('DEFAULT_CURRENCY') != null) {
            // Prefer the system setting when set, otherwise fall back to .env
            $currency_code = strtolower(getSetting('default_currency') ?? env('DEFAULT_CURRENCY'));
            $currency = Currency::where('code', $currency_code)->first();
            if (!is_null($currency)) {
                $request->session()->put('currency_code',  $currency->code);
                $request->session()->put('local_currency_rate', $currency->rate);
                $request->session()->put('currency_symbol', $currency->symbol);
                $request->session()->put('currency_symbol_alignment', $currency->alignment);
            } else {
                // If DB doesn't have the currency, fall back to env values or safe defaults
                $request->session()->put('currency_code',  $currency_code ?? 'usd');
                $request->session()->put('local_currency_rate',  env('DEFAULT_CURRENCY_RATE') ?? 1);
                $request->session()->put('currency_symbol',  env('DEFAULT_CURRENCY_SYMBOL') ?? '$');
                $request->session()->put('currency_symbol_alignment', env('DEFAULT_CURRENCY_SYMBOL_ALIGNMENT') ?? 0);
            }
        } else {
            $request->session()->put('currency_code',  "usd");
            $request->session()->put('local_currency_rate', 1);
            $request->session()->put('currency_symbol', '$');
            $request->session()->put('currency_symbol_alignment', 0);
        }
        return $next($request);
    }
}
