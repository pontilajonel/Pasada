<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Laravel\Passport\PersonalAccessTokenFactory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;


class AuthController extends Controller{


    public function register(Request $request)
{
    $attrs = $request->validate([
        'name' => 'required|string|max:20',
        'email' => 'required|string|email|unique:users|max:20',
        'password' => 'required|string|min:6',
        'phonenumber' => 'required|string|max:15',
        'accounttype' => 'required|string|max:8',
        'sex' => 'required|string|max:7',
        'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Adjust file size and types as needed
    ]);

    // Handle image upload
    $imagePath = null;
    if ($request->hasFile('image')) {
        $image = $request->file('image');
        $filename = 'user_' . time() . '.' . $image->getClientOriginalExtension(); // Generate a unique filename
        $imagePath = $image->storeAs('images', $filename); // Store the image in the specified directory with the specified filename
    }

    // Create user
    User::create([
        'name' => $attrs['name'],
        'email' => $attrs['email'],
        'password' => bcrypt($attrs['password']),
        'phonenumber' => $attrs['phonenumber'],
        'accounttype' => $attrs['accounttype'],
        'sex' => $attrs['sex'],
        'image_path' => $imagePath, // Store the image path in the database
    ]);

    return response([
        'response' => 'You can now Login'
    ], 200);
}

    public function login(Request $request){

        $attrs = $request->validate([
            'email' => 'required|email|max:20',
            'password' => 'required|min:6|max:15'
        ]);

        if(!Auth::attempt($attrs)){
            return Response([
                'message' => 'Invalid credentials.'
            ], 403);
        }

        return response([
            'user' => auth()->user(),
            'token' => auth()->user()->createToken('secret')->plainTextToken
        ], 200);

}
}
