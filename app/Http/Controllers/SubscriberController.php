<?php

namespace App\Http\Controllers;

use App\Subscriber;
use Illuminate\Http\Request;

class SubscriberController extends Controller
{
    public function index()
    {
        return view('subscribe_form');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'email'        => 'required',
        ]);

        Subscriber::create([
            'email'        => request('email'),
        ]);

        return response()->json(1, 200);
    }
}
