<?php

namespace App\Http\Controllers\User;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Svg\Tag\Rect;

class AllUserController extends Controller
{
    public function UserAccount(){
        $id = Auth::user()->id;
        $userData = User::find($id);
        return view('frontend.userdashboard.account_details',compact('userData'));
    }//ENd Methods

    public function UserChangePassword(){
        return view('frontend.userdashboard.user_change_password');
    }//ENd Methods

    public function UserOrderPage(){
        $id = Auth::user()->id;
        $orders = Order::where('user_id',$id)->orderBy('id','DESC')->get();
        return view('frontend.userdashboard.user_order_page',compact('orders'));
    }//ENd Methods


    public function UserOrderDetails($order_id){

        $order = Order::with('division','district','state','user')->where('id',$order_id)->where('user_id',Auth::id())->first();

        $orderItem = OrderItem::with('product')->where('order_id',$order_id)->orderBy('id','DESC')->get();

        return view('frontend.order.order_details',compact('order','orderItem'));
    }//ENd Methods

    public function UserOrderInvoice($order_id){
        $order = Order::with('division','district','state','user')->where('id',$order_id)->where('user_id',Auth::id())->first();

        $orderItem = OrderItem::with('product')->where('order_id',$order_id)->orderBy('id','DESC')->get();

        $pdf = Pdf::loadView('frontend.order.order_invoice', compact('order','orderItem'))->setPaper('a4')->setOption([
            'tempDir' => public_path(),
            'chroot' => public_path(),
        ]);
        return $pdf->download('invoice.pdf');
    }//ENd Methods

    public function ReturnOrder(Request $request, $order_id){
        Order::findOrFail($order_id)->update([
            'return_date' => Carbon::now()->format('d F Y'),
            'return_reason' => $request->return_reason,
            'return_order' => 1,
        ]);
        $notification = array(
            'message' => 'Return Request Send Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('user.order.page')->with($notification);
    }//ENd Methods



    public function ReturnOrderPage(){
        $orders = Order::where('user_id',Auth::id())->where('return_reason','!=',NULL)->orderBy('id','DESC')->get();
        return view('frontend.order.return_order_view',compact('orders'));
    }//ENd Methods

    // Track Order----------------------------------------------------------------

    public function UserTrackOrder(){
        return view('frontend.userdashboard.user_track_order');
    }

    public function OrderTracking(Request $request){
        $invoice = $request->code;

        $track = Order::where('invoice_no',$invoice)->first();
        if ($track) {
            return view('frontend.traking.track_order',compact('track'));
        } else{

            $notification = array(
                'message' => 'Invoice Code is Invalide',
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        }
    }//ENd Methods








}