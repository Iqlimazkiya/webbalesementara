<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Visitor;
use Carbon\Carbon;

class TrackVisitors
{
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);
        if (!$request->routeIs('admin.*')) {
            try {
                $today      = Carbon::today()->toDateString();
                $sessionKey = 'visited_' . $today;
                if (!session()->has($sessionKey)) {
                    session()->put($sessionKey, true);

                    $now = Carbon::now();
                    Visitor::create([
                        'visit_date'   => $today,
                        'hour'         => $now->hour,
                        'day_of_week'  => $now->dayOfWeek,
                        'week_of_year' => $now->weekOfYear,
                        'month'        => $now->month,
                        'year'         => $now->year,
                        'count'        => 1,
                    ]);
                }
            } catch (\Exception $e) {
            }
        }

        return $response;
    }
}