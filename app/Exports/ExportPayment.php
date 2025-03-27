<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class ExportPayment implements FromView
{
    public $payments;

    public function __construct($payments)
    {
        $this->payments = $payments;
    }
    public function view(): View
    {
        return view('exports.payment', [
            'payments' => $this->payments
        ]);
    }
}