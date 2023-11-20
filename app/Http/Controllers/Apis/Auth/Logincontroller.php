<?php

namespace App\Http\Controllers\Apis\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Auth\LoginRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class Logincontroller extends Controller
{

    public function login(LoginRequest $request)
    {
        try {
            $user = User::where('email', $request->email)->first();
            if(!$user || !Auth::attempt($request->safe()->all())){
                return response()->forbidden();
            }
            return response()->ok(__('User Logged In Successfully'),['user'=>new UserResource($user),'token'=> $user->createToken("API TOKEN")->plainTextToken]);
        } catch (\Throwable $th) {
            return response()->internalServerError([$th->getMessage()]);
        }
    }
}
