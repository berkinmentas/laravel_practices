<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CarResource;
use App\Http\Resources\UserResource;
use App\Models\Car;
use http\Env\Response;
use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;

class CarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index(Request $request)
    {
        //
//        $cars = Car::all();
//        return response()->json($cars);
//        $searchQuerey = $request->query('user_id');
//
//        $posts = Car::query()->where('user_id', 'LIKE', $searchQuerey)->take(10)->get();
//        return response()->json($posts);
        return  CarResource::collection(Car::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return CarResource
     */
    public function store(Request $request)
    {

        $carcount=Car::where('user_id', $request->get('user_id'))->count();

        if ($carcount < 3){
            $car = Car::create($request->all());
            return CarResource::make($car);
        }
//            $usersCar = Car::find($request->user_id);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Car  $car
     * @return CarResource
     */
    public function show($id)
    {
//        $cars = Car::find($id);
       return new CarResource(Car::findOrFail($id));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Car  $car
     * @return CarResource
     */
    public function update(Request $request, Car $car)
    {
        //
        $car->plaque_number = $request->plaque_number;
        $car->user_id = $request->user_id;
        $car->save();

        return CarResource::make($car);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Car  $car
     * @return CarResource
     */
    public function destroy(Car $car)
    {
        //
       $car->delete();
       return CarResource::make($car);
    }
}
