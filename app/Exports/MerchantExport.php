<?php

namespace App\Exports;

use App\Models\User;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class MerchantExport implements FromView
{
    public function view(): View
    {
        $merchants = User::where('user_type', appStatic()::TYPE_VENDOR)->with('plan')->get();
        return view('exports.merchant_export', ['merchants' => $merchants]);
    }
    
}