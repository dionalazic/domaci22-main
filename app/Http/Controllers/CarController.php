<?php

namespace App\Http\Controllers;

use App\Http\Resources\CarResource;
use App\Models\Car;
use App\Models\Manufacturer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class CarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cars = Car::all();
        return CarResource::collection($cars);
    }

    public function show($car_id)
    {
        $car = Car::find($car_id);
        if(is_null($car)){
            return response()->json('Data not found', 404);
        }
        
        return new CarResource($car);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'model'=>'required|string|max:100',
            'doors_number'=>'required',
            'year'=>'required|max:4',
            'manufacturer_id'=>'required'
         ]);
         if($validator->fails()){
             return response()->json($validator->errors());
         }
 
         $car = Car::create([
             'model'=>$request->model,
             'doors_number'=>$request->doors_number,
             'year'=>$request->year,
             'manufacturer_id'=>$request->manufacturer_id,
             'user_id'=>Auth::user()->id,
         ]);
 
         return response()->json(['Car is created successfully', new CarResource($car)]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Car  $car
     * @return \Illuminate\Http\Response
     */
    

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Car  $car
     * @return \Illuminate\Http\Response
     */
    public function edit(Car $car)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Car  $car
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Car $car)
    {
        $validator = Validator::make($request->all(),[
            'model'=>'required|string|max:100',
            'doors_number'=>'required',
            'year'=>'required|max:4',
            'manufacturer_id'=>'required',

        ]);
        if($validator->fails()){
            return response()->json($validator->errors());
        }


        $car->model = $request->model;
        $car->doors_number = $request->doors_number;
        $car->year = $request->year;
        $car->manufacturer_id = $request->manufacturer_id;

        $car->save();

        return response()->json(['Car is updated successfully', new CarResource($car)]);


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Car  $car
     * @return \Illuminate\Http\Response
     */
    public function destroy(Car $car)
    {
        $car->delete();

        return response()->json('Car is deleted successfully.');
    }
}
