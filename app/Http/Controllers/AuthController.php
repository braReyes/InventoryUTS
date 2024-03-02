<?php

namespace App\Http\Controllers;

use Dcblogdev\MsGraph\Facades\MsGraph;
use Illuminate\Http\Request;


class AuthController extends Controller
{
    public function inicio()
    {
        return view('botonemail');
    }

    public function connect()
    {
        return MsGraph::connect();
    }

    public function cerrar()
    {
        return MsGraph::disconnect('/');
    }
}
