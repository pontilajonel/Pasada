<?php

namespace App\Http\Controllers;

use App\Models\Locations;
use Illuminate\Http\Request;

use function Laravel\Prompts\select;

class LocationsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function location()
    {

        return response ([
            'locations' => Locations::select('id', 'destinations')->get()
        ],200);
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Locations $locations)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Locations $locations)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Locations $locations)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Locations $locations)
    {
        //
    }
}
