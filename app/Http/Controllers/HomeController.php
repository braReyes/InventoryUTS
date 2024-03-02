<?php

namespace App\Http\Controllers;
use Inertia\Inertia;
use App\Models\Department;
use Illuminate\Support\Facades\Redirect;


use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function welcome()
    {
        return Redirect::route('dashboard');
    }
}

