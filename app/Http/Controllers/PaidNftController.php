<?php

namespace App\Http\Controllers;

use App\Models\PaidNft;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaidNftController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $paid_nfts = PaidNft::select('paid_nfts.*')->where('user_id', Auth::user()->id)->get();
        return $paid_nfts;
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
        $paid_nft = PaidNft::create([
            'user_id' => $request->user_id, 
            'paid_price' => $request->paid_price, 
            'datepaid' => date('Y-m-d'), 
            'token_id' => $request->token_id, 
            'wallet_address_from' => $request->wallet_address_from, 
            'wallet_address_to' => $request->wallet_address_to, 
        ]);

        return response()->noContent();
    }

    /**
     * Display the specified resource.
     */
    public function show(PaidNft $paidNft)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PaidNft $paidNft)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PaidNft $paidNft)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PaidNft $paidNft)
    {
        //
    }
}
