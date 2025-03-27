<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class ExportCustomer implements FromView
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public $customers;

    public function __construct($customers)
    {
        // dd($customer);
        $this->customers = $customers;
    }
    public function view(): View
    {
        return view('exports.customer', [
            'customers' => $this->customers
        ]);
    }
}
