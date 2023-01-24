<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserFeedBackController extends Controller
{
    public function index(){

    }

    public function store(Request $request){
        $request->validate([
            
        ]);
    }
}
