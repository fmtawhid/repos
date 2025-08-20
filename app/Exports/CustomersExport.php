<?php

namespace App\Exports;

use App\Models\User;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class CustomersExport implements FromView
{
    public function view(): View
    {
        $customers = User::where('user_type', appStatic()::TYPE_CUSTOMER)->with('plan')->get();
        return view('exports.customer_export', ['customers' => $customers]);
    }
    
}