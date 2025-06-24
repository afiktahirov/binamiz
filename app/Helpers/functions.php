<?php

use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Jenssegers\Agent\Agent;

if (!function_exists('readSvg')) {
    /**
     * Converts an SVG file to a base64 encoded data URI.
     *
     * @param string $svg_file_path The path to the SVG file.
     * @return string|false The base64 encoded data URI, or false on error.
     */
     function readSvg(string $svg_file_path)
     {
         
        $file_path = $svg_file_path;
        if (substr($file_path, 0, 7) !== '/assets' && substr($file_path, 0, 6) !== 'assets') {
            $file_path = 'assets/' . $file_path;
        }
        
        $file_path = $file_path . '.svg';
         
         
         if ($file_path === false || !file_exists($file_path)) {
             return false;
         }

         $svg_content = file_get_contents($file_path);

         if ($svg_content === false) {
             return false;
         }

         $base64_encoded = base64_encode($svg_content);
         $data_uri = 'data:image/svg+xml;base64,' . $base64_encoded;

         return $data_uri;
     }
}

if(!function_exists('userSessions')) {
    function userSessions()
    {
        $agent = new Agent();
        $currentSessionId = request()->session()->getId();

        $sessions = DB::table('sessions')
            ->where('user_id', auth()->user()->id)
            ->orderBy('last_activity', 'desc')
            ->get()
            ->map(function ($session) use($agent, $currentSessionId) {
                $userAgent = $session->user_agent;
                return [
                    'id' => $session->id,
                    'platform' => $agent->platform($userAgent),
                    'browser' => $agent->browser($userAgent),
                    'desktop' =>$agent->isDesktop($userAgent),
                    'phone' => $agent->isPhone($userAgent),
                    'ip_address' => $session->ip_address,
                    'is_current_device' => $currentSessionId == $session->id ? true : false,
                    'last_active' => Carbon::createFromTimestampMs($session->last_activity * 1000)->diffForHumans(),
                ];
            })->sortByDesc('is_current_device')->values();

        return $sessions;
    }
}