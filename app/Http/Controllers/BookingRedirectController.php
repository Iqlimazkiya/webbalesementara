<?php

namespace App\Http\Controllers;

use App\Models\BookingClick;
use App\Models\Setting;
use Carbon\Carbon;
use Illuminate\Http\Request;

class BookingRedirectController extends Controller
{
    public function redirect(Request $request)
    {
        $unitId   = $request->query('unit_id');
        $unitNama = $request->query('unit_nama');
        $now      = Carbon::now();

        BookingClick::create([
            'unit_id'    => $unitId ?: null,
            'unit_nama'  => $unitNama ?: null,
            'click_date' => $now->toDateString(),
            'month'      => $now->month,
            'year'       => $now->year,
        ]);

        $rentalUrl = Setting::where('key', 'rental_url')->value('value')
            ?? 'https://dev.hotelify.id';

        return redirect()->away($rentalUrl);
    }
    public function contactRedirect(Request $request)
{
    $unitId   = $request->query('unit_id');
    $unitNama = $request->query('unit_nama');
    $now      = Carbon::now();

    BookingClick::create([
        'unit_id'    => $unitId ?: null,
        'unit_nama'  => $unitNama ?: null,
        'click_date' => $now->toDateString(),
        'month'      => $now->month,
        'year'       => $now->year,
        'type'       => 'hubungi',
    ]);

    $whatsapp = Setting::where('key', 'whatsapp_number')->value('value') ?? '6282334466773';
    $message  = Setting::where('key', 'whatsapp_message')->value('value') ?? 'Halo';

    return redirect()->away('https://wa.me/' . $whatsapp . '?text=' . urlencode($message));
}
}