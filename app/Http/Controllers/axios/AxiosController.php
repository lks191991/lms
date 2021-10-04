<?php

namespace App\Http\Controllers\axios;

use Illuminate\Http\Request;

class AxiosController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index($page = ''){
		return view('/axios/' . $page);
		
    }
}
