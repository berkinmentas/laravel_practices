<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Http\Resources\UserWithCarsResource;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        //
//        $users = User::with('cars')->get();
//        return response($users);


        $data=User::with('cars')->paginate(5);
        return UserWithCarsResource::collection($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request, User $user)
    {
        //

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return UserResource
     */
    public function store(Request $request)
    {
        //
//        User::create($request->all());

//        $user = new User;
//        $user->name = $request->name;
//        $user->surname = $request->surname;
//        $user->apartment_no = $request->apartment_no;
//        $user->save();

//        return response([
//            'data'=> $user,
//            'message'=>'User Created'
//        ]);
        $userFind=User::where('apartment_no',$request->apartment_no)->first();
        if ($userFind){

            return UserResource::make($userFind);
        }
        else{

            $resource = User::create($request->all());
            return UserResource::make($resource);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return UserResource
     */
    public function show($id)
    {
        //            return \response($users, 200);
//        $users = User::find($id);
//        if ($users) {
//            return UserResource::make($users);
//        } else
//            $error = 'User Not Found';
//            return UserResource::make($error);

      return new UserResource(User::findOrFail($id));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return UserResource
     */
    public function update(Request $request, User $user)
    {
//      $input = $request->all();
//      $user->update($input);

        $user->name = $request->name;
        $user->surname = $request->surname;
        $user->apartment_no = $request->apartment_no;
        $user->save();

        return UserResource::make($user);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return UserResource
     */
    public function destroy(User $user)
    {

        $user->delete();
        return UserResource::make($user);
    }
}
