<?php

namespace App\Http\Controllers;

use App\Models\View_Aeropuerto;
use App\Models\View_Cliente;
use App\Models\View_Regional;

class HomeController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $aeropuertos = View_Aeropuerto::all();
        $regionales = View_Regional::all();
        $clientes = View_Cliente::all(); 
        return view('home', compact('aeropuertos','regionales','clientes'));
    }
}
