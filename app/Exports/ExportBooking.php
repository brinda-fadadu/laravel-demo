<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class ExportBooking implements FromView
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public $bookings;
    public $role_id;

    public function __construct($bookings)
    {
        // dd($bookings);
        $this->bookings = $bookings;
    }
    public function view(): View
    {
        return view('exports.booking', [
            'bookings' => $this->bookings,
            'role_id' => $this->role_id
        ]);
    }
}
