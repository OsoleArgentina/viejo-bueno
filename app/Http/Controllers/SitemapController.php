<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SitemapController extends Controller
{
    public function index()
    {
        $urls = [
            url('/'),
            url('/nosotros'),
            url('/productos'),
            url('/marcas'),
            url('/capacitaciones'),
            url('/contacto'),
            url('/presupuesto'),
            url('/novedades'),
        ];

        $xml = view('sitemap', compact('urls'));

        return response($xml, 200)->header('Content-Type', 'application/xml');
    }
}
