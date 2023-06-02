<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param Request $request
     * @return UserResource
     */
    public function __invoke(Request $request): UserResource
    {
        return new UserResource(Auth::user());
    }
}
