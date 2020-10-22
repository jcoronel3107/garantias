<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Clave;
use App\Http\Requests\CreateClaveRequest;

class PagesController extends Controller
{
    public function __construct(){
        $this->middleware('auth');

    }

    public function index()
    {
    	return view("welcome");
    }
}
