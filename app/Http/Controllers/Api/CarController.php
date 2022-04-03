<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Car;
use http\Env\Response;
use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;

class CarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        //
//        $cars = Car::all();
//        return response()->json($cars);
        $searchQuerey = $request->query('user_id');

        $posts = Car::query()->where('user_id', 'LIKE', $searchQuerey)->take(10)->get();
        return response()->json($posts);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //


        $carcount=Car::where('user_id', $request->get('user_id'))->count();

        if ($carcount >= 3){
            return response('Maksimum arac sayısına sahipsiniz.');
        }

        echo 'Arac sayısı = '.$carcount;
        Car::create([
            "plaque_number" => $request->get('plaque_number'),
            "user_id" => $request->get('user_id')
        ]);
        return response(['message'=>'Yeni arac eklenmistir.']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Car  $car
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
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
        //
        $car->plaque_number = $request->plaque_number;
        $car->user_id = $request->user_id;
        $car->save();

        return response([
            'data'=> $car,
            'message'=>'Car Updated'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Car  $car
     * @return \Illuminate\Http\Response
     */
    public function destroy(Car $car)
    {
        //
        $car->delete();
        return response('Arac Silindi');
    }
}
