<?php

namespace App\Http\Controllers;

use App\Http\Resources\CarResource;
use App\Models\Car;
use Illuminate\Http\Request;

class CarTestController extends Controller
{
    public function index(){
        $cars = Car::all();
        return $cars;
    }

    public function show(Car $car){
        return new CarResource($car);
    }
}
