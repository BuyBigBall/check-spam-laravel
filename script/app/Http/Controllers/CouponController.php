<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use App\Models\Settings;
use App\Models\Post;
use Illuminate\Http\Request;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\OpenGraph;
use Illuminate\Validation\Rule;

class CouponController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        return view('backend.coupons.index')->with('coupons', Coupon::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //validate the coupon fields
        $request->validate([
            'coupon_code' => ['required',
                Rule::unique('coupons')->where(function ($query){
                    return $query->where('state', 0); // 0:unused
                })],
            'coupon_amt' => 'required|max:100|min:0|numeric',
            'expiry_date' => 'required|date',
        ]);

        $coupon = new Coupon();
        $coupon->coupon_code = $request->coupon_code;
        $coupon->coupon_amt = $request->coupon_amt;
        $coupon->coupon_type = $request->coupon_type;
        $coupon->expiry_date = $request->expiry_date;
        $coupon->save();
        

        session()->flash('success', 'Coupon Created Successfuly');
        return redirect(route('coupons.index'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Coupon  $coupon
     * @return \Illuminate\Http\Response
     */
    public function edit(Coupon $coupon)
    {
        //dd($coupon);
        return view('backend.coupons.edit')->with('coupon', $coupon);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $coupon
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Coupon $coupon)
    {

        $request->validate([
            'coupon_code' => ['required',
                Rule::unique('coupons')->where(function ($query){
                    return $query->where('state', 0); // 0:unused
                })->ignore($coupon->id)],
            'coupon_amt' => 'required|max:100|min:0|numeric',
            'expiry_date' => 'required|date',
        ]);

        $coupon->update([
            'coupon_code' => $request->coupon_code,
            'coupon_type' => $request->coupon_type,
            'coupon_amt' => $request->coupon_amt,
            'expiry_date' => $request->expiry_date,
            'state' => $request->state
        ]);

        session()->flash('success', 'Coupon Updated Successfuly');
        return redirect(route('coupons.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Coupon  $coupon
     * @return \Illuminate\Http\Response
     */
    public function destroy(Coupon $coupon)
    {
        $coupon->delete();

        session()->flash('success', 'Coupon Deleted Successfuly');

        return redirect(route('coupons.index'));
    }
}
