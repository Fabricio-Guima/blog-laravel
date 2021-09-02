<?php

namespace App\Http\Controllers;

use App\Http\Requests\MeUpdateRequest;
use App\Http\Resources\UserResource;
use App\Services\UserService;
use App\User;
use Illuminate\Http\Request;

class MeController extends Controller
{
    public function __construct(){

        //preciso passar o token la nos headers - não esquecer
        $this->middleware('auth:api');
    }

    public function me(){

        return new UserResource(auth()->user());
    }

    public function update(MeUpdateRequest $request){
        
        $input = $request->validated();

        if(!empty($input['email']) && User::where('email', $input['email'])->exists() ) {

        }


        $user =  (new UserService)->update(auth()->user(), $input);

        return new UserResource($user);
    }
}
