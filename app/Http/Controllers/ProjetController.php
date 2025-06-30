<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Projet;

class ProjetController extends Controller
{
    public function index()
    {
        $projets = Projet::all();
        return view('projets', compact('projets'));
    }
}
