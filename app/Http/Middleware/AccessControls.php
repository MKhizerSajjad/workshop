<?php

namespace App\Http\Middleware;

use Closure;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Symfony\Component\HttpFoundation\Response;

class AccessControls
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    // public function handle(Request $request, Closure $next): Response
    // {
    //     return $next($request);
    // }

    public function handle(Request $request, Closure $next)
    {
        // Assuming the user is authenticated
        $user = auth()->user();
        $clientIp = $request->ip(); // Get the client's IP address

        // Get user access control data from the child table
        $accessControl = $user->accessControl;

        // IP Address Check
        if (!empty($accessControl->assigned_ip) && $accessControl && $accessControl->assigned_ip && $accessControl->assigned_ip !== $clientIp) {
            Auth::logout();
            return redirect()->route('login')->withErrors(['error' => 'IP mismatch']);
        }

        $currentDay = Carbon::now()->format('l');
        $currentTime = Carbon::now()->format('H:i');

        if ($accessControl && !in_array($currentDay, json_decode($accessControl->days))) {
            Auth::logout();
            return redirect()->route('login')->withErrors(['error' => 'Outside working days']);
        }

        if ($accessControl && ($currentTime < $accessControl->hours_start || $currentTime >= $accessControl->hours_end)) {
            Auth::logout();
            return redirect()->route('login')->withErrors(['error' => 'Outside working hours']);
        }

        // If all checks pass, allow the request to proceed
        return $next($request);
    }
}
