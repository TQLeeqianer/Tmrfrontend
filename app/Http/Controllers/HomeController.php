<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
//        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        //get all event
        $events = Event::all();
        return view('welcome')->with(['events' => $events]);
    }


    public function checkHasLogin(): JsonResponse
    {
        return response()->json(['loggedIn' => auth()->check()]);
    }
}
