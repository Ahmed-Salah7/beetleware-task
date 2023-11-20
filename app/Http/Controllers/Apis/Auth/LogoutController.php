<?php

namespace App\Http\Controllers\Apis\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LogoutController extends Controller
{
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return response()->ok(__('User Logout Successfully'));
    }
}
