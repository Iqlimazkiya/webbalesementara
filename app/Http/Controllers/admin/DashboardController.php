<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Unit;
use App\Models\Setting;
use App\Models\Visitor;
use App\Models\Activity;
use App\Models\ContactMessage;
use App\Models\BookingClick;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $settings = Setting::pluck('value', 'key')->toArray();

        $today          = Carbon::today();
        $yesterday      = Carbon::yesterday();
        $visitorsToday  = Visitor::where('visit_date', $today)->sum('count') ?: 0;
        $visitorsYest   = Visitor::where('visit_date', $yesterday)->sum('count') ?: 0;
        $visitorsIncrease = $visitorsYest > 0
            ? round((($visitorsToday - $visitorsYest) / $visitorsYest) * 100, 1)
            : ($visitorsToday > 0 ? 100 : 0);
        $bookingClicks      = BookingClick::count();
        $bookingClicksToday = BookingClick::where('click_date', $today)->count();
        $ctaNumber     = $settings['whatsapp_number'] ?? '-';
        $messagesCount = ContactMessage::where('is_read', false)->count();

        $recentActivities = Activity::latest()->take(5)->get();

        $chartDataDaily   = $this->getChartDataDaily();
        $chartDataWeekly  = $this->getChartDataWeekly();
        $chartDataMonthly = $this->getChartDataMonthly();

        $unitChartData = $this->getUnitChartData();

        return view('admin.dashboard', compact(
            'settings',
            'visitorsToday',
            'visitorsIncrease',
            'bookingClicks',
            'bookingClicksToday',
            'ctaNumber',
            'messagesCount',
            'recentActivities',
            'chartDataDaily',
            'chartDataWeekly',
            'chartDataMonthly',
            'unitChartData'
        ));
    }

    private function getChartDataDaily(): array
    {
        $dayNames    = ['Senin','Selasa','Rabu','Kamis','Jumat','Sabtu','Minggu'];
        $startOfWeek = Carbon::now()->startOfWeek(Carbon::MONDAY);
        $labels = $data = $dates = [];

        for ($i = 0; $i < 7; $i++) {
            $date     = $startOfWeek->copy()->addDays($i);
            $labels[] = $dayNames[$i] . ' (' . $date->format('d/m') . ')';
            $data[]   = Visitor::where('visit_date', $date->format('Y-m-d'))->sum('count') ?: 0;
            $dates[]  = $date->format('Y-m-d');
        }

        return compact('labels', 'data', 'dates');
    }

    private function getChartDataWeekly(): array
{
    $now   = Carbon::now();
    $end   = Carbon::createFromDate($now->year, $now->month, 1)->endOfMonth();
    $firstMonday = Carbon::createFromDate($now->year, $now->month, 1)->startOfWeek(Carbon::MONDAY);
    if ($firstMonday->month < $now->month) {
        $firstMonday->addWeek(); 
    }

    $labels = $data = $dates = [];
    $week   = 1;
    $current = $firstMonday->copy();

    while ($current->lte($end)) {
        $weekEnd  = $current->copy()->addDays(6); 
        $clampEnd = $weekEnd->gt($end) ? $end->copy() : $weekEnd->copy();

        $labels[] = 'Minggu ' . $week . ' (' . $current->format('d/m') . '-' . $clampEnd->format('d/m') . ')';
        $data[]   = Visitor::whereBetween('visit_date', [
            $current->format('Y-m-d'),
            $clampEnd->format('Y-m-d'),
        ])->sum('count') ?: 0;
        $dates[]  = $current->format('Y-m-d') . ' s/d ' . $clampEnd->format('Y-m-d');

        $week++;
        $current->addWeek();
    }

    return compact('labels', 'data', 'dates');
}

    private function getChartDataMonthly(): array
    {
        $year       = Carbon::now()->year;
        $monthNames = ['Jan','Feb','Mar','Apr','Mei','Jun','Jul','Agu','Sep','Okt','Nov','Des'];
        $labels = $data = $dates = [];

        for ($month = 1; $month <= 12; $month++) {
            $labels[] = $monthNames[$month - 1];
            $data[]   = Visitor::where('year', $year)->where('month', $month)->sum('count') ?: 0;
            $dates[]  = $monthNames[$month - 1] . ' ' . $year;
        }

        return compact('labels', 'data', 'dates');
    }

    private function getUnitChartData(): array
{
    $clicks = BookingClick::select('unit_nama', \DB::raw('count(*) as total'))
        ->whereNotNull('unit_nama')
        ->groupBy('unit_nama')
        ->orderByDesc('total')
        ->get();

    $labels = $clicks->pluck('unit_nama')->toArray();
    $data   = $clicks->pluck('total')->toArray();

    return compact('labels', 'data');
}
}