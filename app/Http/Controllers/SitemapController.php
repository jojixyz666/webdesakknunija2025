<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use App\Models\Peta;
use Illuminate\Http\Response;

class SitemapController extends Controller
{
    public function index()
    {
        $berita = Berita::where('tampilkan', true)
            ->orderBy('updated_at', 'desc')
            ->get();

        $peta = Peta::where('tampilkan', true)
            ->orderBy('updated_at', 'desc')
            ->get();

        $xml = '<?xml version="1.0" encoding="UTF-8"?>';
        $xml .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';
        
        // Homepage
        $xml .= '<url>';
        $xml .= '<loc>' . url('/') . '</loc>';
        $xml .= '<lastmod>' . now()->toIso8601String() . '</lastmod>';
        $xml .= '<changefreq>daily</changefreq>';
        $xml .= '<priority>1.0</priority>';
        $xml .= '</url>';
        
        // Berita Index
        $xml .= '<url>';
        $xml .= '<loc>' . route('berita.index') . '</loc>';
        $xml .= '<lastmod>' . now()->toIso8601String() . '</lastmod>';
        $xml .= '<changefreq>daily</changefreq>';
        $xml .= '<priority>0.9</priority>';
        $xml .= '</url>';
        
        // All Berita
        foreach ($berita as $item) {
            $xml .= '<url>';
            $xml .= '<loc>' . route('berita.show', $item->slug) . '</loc>';
            $xml .= '<lastmod>' . $item->updated_at->toIso8601String() . '</lastmod>';
            $xml .= '<changefreq>weekly</changefreq>';
            $xml .= '<priority>0.8</priority>';
            $xml .= '</url>';
        }
        
        // Other pages
        $pages = [
            ['url' => route('pengaduan.index'), 'priority' => '0.7'],
            ['url' => route('peta.index'), 'priority' => '0.7'],
            ['url' => route('profile.index'), 'priority' => '0.8'],
            ['url' => route('apbd.index'), 'priority' => '0.7'],
            ['url' => route('data-grafis.index'), 'priority' => '0.6'],
        ];
        
        foreach ($pages as $page) {
            $xml .= '<url>';
            $xml .= '<loc>' . $page['url'] . '</loc>';
            $xml .= '<lastmod>' . now()->toIso8601String() . '</lastmod>';
            $xml .= '<changefreq>monthly</changefreq>';
            $xml .= '<priority>' . $page['priority'] . '</priority>';
            $xml .= '</url>';
        }
        
        $xml .= '</urlset>';

        return response($xml, 200)
            ->header('Content-Type', 'application/xml');
    }
}
