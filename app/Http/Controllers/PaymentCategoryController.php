<?php

namespace App\Http\Controllers;

use App\Models\PaymentCategory;
use Illuminate\Http\Request;

class PaymentCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $paymentcategories = PaymentCategory::all();
        return $paymentcategories;
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
        $request->validate([
            'category' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string', 'max:255'],
        ]);

        $paymentcategory = PaymentCategory::create([
            'category' => $request->category,
            'description' => $request->description,
            'is_active_category' => 1
        ]);

        return response()->noContent();
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $paymentcategory = PaymentCategory::find($id);
        return $paymentcategory;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $paymentcategory = PaymentCategory::find($id);
        return $paymentcategory;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $request->validate([
            'category' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string', 'max:255'],
        ]);

        $paymentcategory = PaymentCategory::find($request->paymentCategoryId)->update([
            'category' => $request->category,
            'description' => $request->description,
        ]);

        return response()->noContent();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PaymentCategory $paymentCategory)
    {
        //
    }

    public function getForOpt()
    {
        $paymentcategories = PaymentCategory::all();
        $result = [];

        if (!empty($paymentcategories)) {
            foreach ($paymentcategories as $paymentcategory) {
                $data = ['value'=>$paymentcategory->id, 'label'=>$paymentcategory->category];
                array_push($result, $data);
            }
        }
        return response()->json($result);
    }
}
