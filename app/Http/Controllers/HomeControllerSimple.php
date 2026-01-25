<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;

class HomeControllerSimple extends BaseController
{
    public function index()
    {
        // Simple version without database queries for testing
        $articles = collect();
        $ekstrakurikulers = collect();
        $acceptedRegistrations = collect();
        $beritaSekolah = collect();

        return view('home', compact('articles', 'ekstrakurikulers', 'acceptedRegistrations', 'beritaSekolah'));
    }
}
