<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class LogAdminActivity
{
    /**
     * Handle an incoming request untuk logging aktivitas admin.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        // Log hanya untuk admin yang sudah login
        if (auth()->check()) {
            $user = auth()->user();
            $method = $request->method();
            $path = $request->path();
            $ip = $request->ip();
            $userAgent = $request->userAgent();

            // Log untuk operasi POST, PUT, PATCH, DELETE (data modification)
            if (in_array($method, ['POST', 'PUT', 'PATCH', 'DELETE'])) {
                $logData = [
                    'user_id' => $user->id,
                    'user_email' => $user->email,
                    'method' => $method,
                    'path' => $path,
                    'ip' => $ip,
                    'user_agent' => $userAgent,
                    'status_code' => $response->getStatusCode(),
                ];

                // Log berbeda berdasarkan path
                if (str_contains($path, 'berita')) {
                    Log::channel('daily')->info('Admin Berita Activity', $logData);
                } elseif (str_contains($path, 'pengaduan')) {
                    Log::channel('daily')->info('Admin Pengaduan Activity', $logData);
                } elseif (str_contains($path, 'warga')) {
                    Log::channel('daily')->info('Admin Warga Activity', $logData);
                } elseif (str_contains($path, 'apbd')) {
                    Log::channel('daily')->info('Admin APBD Activity', $logData);
                } elseif (str_contains($path, 'password')) {
                    Log::channel('daily')->warning('Password Change Activity', $logData);
                } else {
                    Log::channel('daily')->info('Admin Activity', $logData);
                }
            }

            // Log khusus untuk login
            if ($path === 'admin/login' && $method === 'POST') {
                Log::channel('daily')->notice('Admin Login Attempt', [
                    'email' => $request->input('email'),
                    'ip' => $ip,
                    'user_agent' => $userAgent,
                    'status' => $response->getStatusCode() === 302 ? 'success' : 'failed',
                ]);
            }
        }

        return $response;
    }
}
