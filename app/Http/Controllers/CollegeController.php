<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\College;

class CollegeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $_college = new College;

        $colleges = $_college->getColleges();

        return $colleges;
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
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function getColleges()
    {
        $_college = new College;

        $colleges = $_college->getColleges();
        $result = [];

        if (!empty($colleges)) {
            foreach ($colleges as $college) {
                $data = ['value'=>$college->id, 'label'=>$college->college_name];
                array_push($result, $data);
            }
        }
        // return $colleges;
        return response()->json($result);
    }
}
