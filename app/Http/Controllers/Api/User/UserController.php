<?php

namespace App\Http\Controllers\Api\User;

use App\Models\Acl\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Web\Auth\RegisterProfileUpdateRequest2;

/**
 * Class UserController
 * @package App\Http\Controllers\Api\User
 */
class UserController extends Controller
{
    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function emailExistence(Request $request) :JsonResponse
    {
        $email = $request->route()->parameter('email');

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return response()->json([
                'existence' => false,
            ]);
        }

        return response()->json([
            'existence' => User::where('email', $email)->exists()
        ]);
    }
}
