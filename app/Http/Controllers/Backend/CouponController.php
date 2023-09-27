<?php

namespace App\Http\Controllers\Backend;

use Carbon\Carbon;
use App\Models\Coupon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CouponController extends Controller
{
    public function AllCoupon(){
        $coupon = Coupon::latest()->get();
        return view('backend.coupon.coupon_all', compact('coupon'));
    }//End Method

    public function AddCoupon(){
        return view('backend.coupon.coupon_add');
    }//End Method

    public function StoreCoupon(Request $request){

        Coupon::insert([
            'coupon_name' => strtoupper($request->coupon_name),
            'coupon_discount' => $request->coupon_discount,
            'coupon_validity' => $request->coupon_validity,
            'created_at' => Carbon::now(),
        ]);

       $notification = array(
            'message' => 'Coupon Inserted Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('all.coupon')->with($notification);
    }// End Method

    public function EditCoupon($id){
        $coupon = Coupon::findOrFail($id);
        return view('backend.coupon.coupon_edit',compact('coupon'));
    }// End Method

    public function UpdateCoupon(Request $request){

       $coupon_id = $request->id;
       Coupon::findOrFail($coupon_id)->update([
        'coupon_name' => strtoupper($request->coupon_name),
        'coupon_discount' => $request->coupon_discount,
        'coupon_validity' => $request->coupon_validity,
        'created_at' => Carbon::now(),
    ]);


       $notification = array(
            'message' => 'Coupon Update Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('all.coupon')->with($notification);

    }// End Method

    public function DeleteCoupon($id){
        Coupon::findOrFail($id)->delete();

        $notification = array(
            'message' => 'Category Delete Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }// End Method

}