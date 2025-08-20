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
                    $request->session()->put('currency_code',  "usd");
                    $request->session()->put('local_currency_rate', 1);
                    $request->session()->put('currency_symbol', '$');
                    $request->session()->put('currency_symbol_alignment', 0);
                }
            }
        } elseif (env('DEFAULT_CURRENCY') != null) {
            $request->session()->put('currency_code',  env('DEFAULT_CURRENCY'));
            $request->session()->put('local_currency_rate',  env('DEFAULT_CURRENCY_RATE'));
            $request->session()->put('currency_symbol',  env('DEFAULT_CURRENCY_SYMBOL'));
            $request->session()->put('currency_symbol_alignment', env('DEFAULT_CURRENCY_SYMBOL_ALIGNMENT'));
        } else {
            $request->session()->put('currency_code',  "usd");
            $request->session()->put('local_currency_rate', 1);
            $request->session()->put('currency_symbol', '$');
            $request->session()->put('currency_symbol_alignment', 0);
        }
        return $next($request);
    }
}
