<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function userInfo()
    {
        return response([
            'users' => User::select('id', 'name', 'email','accounttype','sex')->get()
        ], 200);

    }
    public function driverInfo()
    {
        $acctype = 'driver';
        $status = 'available';
        return response([
            'users' => User::select('id', 'name')
                        ->where('accounttype','=', $acctype)
                        ->where('status','=', $status)
                        ->get()
                ], 200);
    }
    public function userme(String $userId)
    {
        return response([
            'users' => User::select('id','name', 'email')
                    ->where('id','=', $userId)->get()
        ], 200);

    }

    public function unavailableStatus(Request $request, $id)
    {
    $status = 'not available';

    $users = User::find($id);

    // Use the update method to update the status
    $users->update([
        'status' => $status,
    ]);

    return response()->json($users, 200);
    }

    public function availableStatus(Request $request, $id)
    {
    $status = 'available';

    $users = User::find($id);

    // Use the update method to update the status
    $users->update([
        'status' => $status,
    ]);

    return response()->json($users, 200);
    }

    public function getMaleCount()
    {
        $maleCount = User::where('sex', 'male')->count();
        return response()->json(['maleCount' => $maleCount]);
    }

    public function getFemaleCount()
    {
        $femaleCount = User::where('sex', 'female')->count();
        return response()->json(['femaleCount' => $femaleCount]);
    }
    public function driveraccount()
    {
        $dCount = User::where('accounttype', 'driver')->count();
        return response()->json(['drivercount' => $dCount]);
    }

    public function studentaccount()
    {
        $sCount = User::where('accounttype', 'student')->count();
        return response()->json(['studentcount' => $sCount]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

    }

    /**
     * Display the specified resource.
     */
    public function show(User $transactions)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $transactions)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $transactions)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $transactions)
    {
        //
    }
}
