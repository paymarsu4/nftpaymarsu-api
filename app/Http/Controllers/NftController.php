<?php

namespace App\Http\Controllers;

use App\Models\Nft;
use Illuminate\Http\Request;

class NftController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
        $paymentcategory = Nft::create([
            'user_id' => $request->user_id, 
            'college_id' => $request->college_id, 
            'category_id' => $request->category_id, 
            'name' => $request->name, 
            'description' => $request->description, 
            'price' => $request->price, 
            'image_url' => $request->image_url, 
            'pinata_url' => $request->pinata_url,
            'marketplace_address' => $request->marketplace_address,
        ]);

        return response()->noContent();
    }

    /**
     * Display the specified resource.
     */
    public function show(Nft $nft)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Nft $nft)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Nft $nft)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Nft $nft)
    {
        //
    }
}
