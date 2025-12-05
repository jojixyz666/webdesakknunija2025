<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Pengaturan;
use Illuminate\Support\Facades\View;

class SharePengaturan
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Share pengaturan data ke semua views
        $pengaturan = Pengaturan::all()->pluck('nilai', 'kunci')->toArray();
        
        // Debug log
        \Log::info('SharePengaturan Middleware', [
            'count' => count($pengaturan),
            'jumlah_penduduk' => $pengaturan['jumlah_penduduk'] ?? 'not found',
            'jumlah_kk' => $pengaturan['jumlah_kk'] ?? 'not found',
        ]);
        
        View::share('pengaturan', $pengaturan);

        return $next($request);
    }
}
