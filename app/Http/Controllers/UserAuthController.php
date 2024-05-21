<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserAuthController extends Controller
{
    public function register(Request $request) {

        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'email' => 'required|string|email|unique:users',
            'password'=>'required|min:8'
            // 'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'code' => 400,
                'text' => 'Validation Failed',
                'data' => $validator->errors(),
            ]);
        }

        $user = User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return response()->json([
            'code' => 201,
            'text' => 'User registered successfully',
            'data' => $user
        ]);
    }

    public function login(Request $request) {

        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'code' => 400,
                'text' => 'Validation Failed',
                'data' => $validator->errors(),
            ]);
        }

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json([
                'code' => 401,
                'text' => 'Invalid credentials',
                'data' => ''
            ]);
        }

        $data['token'] = $user->createToken('API Token', ['expires_at' => now()->addHours(3)])->plainTextToken;
        $data['user']   = $user;

        return response()->json([
            'code' => 200,
            'text' => 'Logged in Successfull',
            'data' => $data
        ]);
    }

    public function logout(Request $request) {

        $request->user()->tokens()->delete();

        return response()->json([
            'code' => 200,
            'text' => 'Logged out successfully',
            'data' => ''
        ]);

    }

    public function dashboard(Request $request) {

        $apiUrl = 'https://killnetswitch.com/monitor/stan/api/v1/stats.php';

        $apiResponse = file_get_contents($apiUrl);

        if ($apiResponse !== false) {
            $data = json_decode($apiResponse, true);

            return response()->json([
                'code' => 200,
                'text' => 'Success',
                'data' => $data
            ]);
        } else {
            return response()->json([
                'code' => 500,
                'text' => 'Failed to fetch data from the API',
                'data' => ''
            ]);
            return response()->json(['error' => 'Failed to fetch data from the API'], 500);
        }
    }
}
