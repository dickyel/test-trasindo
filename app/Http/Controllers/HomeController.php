<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Car;

class HomeController extends Controller
{
    //

    public function index(Request $request)
    {

        $cars = Car::when(request()->keyword, function($cars) {
            $cars = $cars->where('merek', 'like', "%". request()->keyword . '%');
            
        })->latest()->paginate(10);

        return view('pages.home',[
            'cars' => $cars
        ]);
    }
}
