<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;
use App\Models\User;
use Carbon\Carbon;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        try {
            $attributes = request()->validate([
                'name'      => 'required|string|min:3|max:255',
                'email'     => 'required|email|max:255|unique:users,email',
                'password'  => 'required|min:6|max:255|confirmed',
                'status'    => 'required|string',
                'role'      => 'required|string|exists:roles,name'
            ]);

            $role = array_pop($attributes);

            $user = User::create($attributes);

            $user->assignRole($role);

            return $this->login($request);

            // return redirect('/')->with('success', 'Your account has been created.');
        } catch (\Throwable $th) {
            return response()->json([
                'status_code' => Response::HTTP_INTERNAL_SERVER_ERROR,
                'message'     => 'Something went wrong.',
                'error'       => $th
            ]);
        }
    }

    public function login(Request $request)
    {
        try {
            $attributes = $request->validate([
                'email'     => 'email|required',
                'password'  => 'string|required',
            ]);

            if (!Auth::attempt($attributes)) {

                return response()->json([
                    'status_code' => Response::HTTP_UNAUTHORIZED,
                    'message' => 'Email or Password is not valid.'
                ]);
            }

            $user = Auth::user();

            if (!$user->status) {

                Auth::logout();

                return response()->json([
                    'status_code' => Response::HTTP_UNAUTHORIZED,
                    'message' => 'Account is not active.'
                ]);
            }


            $token = $user->createToken('authToken')->plainTextToken;

            $user->update([
                'last_login_at' => Carbon::now()->toDateTimeString(),
                'last_login_ip' => $request->getClientIp()
            ]);


            return response()->json([
                'status_code'  => Response::HTTP_OK,
                'access_token' => $token,
                'token_type'   => 'Bearer'
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status_code' => Response::HTTP_INTERNAL_SERVER_ERROR,
                'message'     => 'Something went wrong.',
                'error'       => $th
            ]);
        }
    }

    public function logout(Request $request)
    {
        try {
            $user = $request->user();
            $user->tokens()->delete();
            Auth::guard('web')->logout();
            return response()->json([
                'status_code' => Response::HTTP_OK,
                'message'     => 'User logged out.'
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status_code' => Response::HTTP_INTERNAL_SERVER_ERROR,
                'message'     => 'Something went wrong.',
                'error'       => $th
            ]);
        }
    }
}
