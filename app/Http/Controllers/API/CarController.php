<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Car;
use App\Http\Resources\Car as CarResource;

class CarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Get Cars
        $cars = Car::paginate(15);

        // Return Collection of cars
        return CarResource::collection($cars);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $car = $request->isMethod('put') ? Car::findOrFAil($request->car_id) : new Car;

        $car->id   = $request->input('car_id');
        $car->name = $request->input('name');
        $car->email = $request->input('email');
        $car->model = $request->input('model');
        $car->license = $request->input('license');
        $car->color = $request->input('color');
        $car->company = $request->input('company');

        if($car->save()){
          return new CarResource($car);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $car = Car::findOrFAil($id);
      //  var_dump($request->all());

        $car->name = $request->input('name');
        $car->email = $request->input('email');
        $car->model = $request->input('model');
        $car->license = $request->input('license');
        $car->color = $request->input('color');
        $car->company = $request->input('company');

        if($car->save()){
          return new CarResource($car);
        }
        
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $car = Car::findOrFAil($id);

        return new CarResource($car);
    }




    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $car = Car::findOrFAil($id);

      if($car->delete()){
        return new CarResource($car);
      }

    }
}
