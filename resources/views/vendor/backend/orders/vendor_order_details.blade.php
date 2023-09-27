@extends('vendor.vendor_dashbord')
@section('vendor')

<div class="page-content">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Vendor Order Details</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Vendor Order Details</li>
                </ol>
            </nav>
        </div>
    </div>
    <!--end breadcrumb-->

    <hr/>


    <div class="row row-cols-1 row-cols-md-1 row-cols-lg-2 row-cols-xl-2">
        <div class="col">
            <div class="card">
                <div class="card-header"><h4>Shipping Details</h4></div>

                <hr>
                <div class="card-body">
                    <table class="table" style="background: #F4F6FA;font-weight:600;">
                        <tr>
                            <th>Shipping Name:</th>
                            <th>{{ $order->name }}</th>
                        </tr>
                        <tr>
                            <th>Shipping Phone:</th>
                            <th>{{ $order->phone }}</th>
                        </tr>
                        <tr>
                            <th>Shipping Email:</th>
                            <th>{{ $order->email }}</th>
                        </tr>
                        <tr>
                            <th>Address:</th>
                            <th>{{ $order->address }}</th>
                        </tr>
                        <tr>
                            <th>Division:</th>
                            <th>{{ $order->division->division_name }}</th>
                        </tr>
                        <tr>
                            <th>District:</th>
                            <th>{{ $order->district->district_name }}</th>
                        </tr>
                        <tr>
                            <th>State:</th>
                            <th>{{ $order->state->state_name }}</th>
                        </tr>
                        <tr>
                            <th>Post code:</th>
                            <th>{{ $order->post_code }}</th>
                        </tr>
                        <tr>
                            <th>Order Date:</th>
                            <th>{{ $order->order_date }}</th>
                        </tr>
                    </table>
                </div>
            </div>
        </div>


        <div class="col">
            <div class="card">
                <div class="card-header">
                    <h4>Order Details</h4>
                    <span class="text-danger">Invoice : {{ $order->invoice_no }}</span>
                </div>

                <hr>
                <div class="card-body">
                    <table class="table" style="background: #F4F6FA;font-weight:600;">
                        <tr>
                            <th> Name:</th>
                            <th>{{ $order->user->name }}</th>
                        </tr>
                        <tr>
                            <th>Phone:</th>
                            <th>{{ $order->user->phone }}</th>
                        </tr>
                        <tr>
                            <th>Payment Type:</th>
                            <th>{{ $order->payment_method }}</th>
                        </tr>
                        <tr>
                            <th>Transx Id:</th>
                            <th>{{ $order->transaction_id }}</th>
                        </tr>
                        <tr>
                            <th>Invoice:</th>
                            <th class="text-danger">{{ $order->invoice_no }}</th>
                        </tr>
                        <tr>
                            <th>Order Amonut:</th>
                            <th>${{ $order->amount }}</th>
                        </tr>
                        <tr>
                            <th>Ordr Status:</th>
                            <th><span class="badge bg-danger" style="font-size: 15px;">{{ $order->status }}</span></th>
                        </tr>



                    </table>
                </div>
            </div>
        </div>
    </div>






<div class="row row-cols-1 row-cols-md-1 row-cols-lg-2 row-cols-xl-1">
        <div class="col">
            <div class="card">
                <div class="table-responsive">
                    <table class="table">
                        <tbody>
                            <tr>

                                <td class="col-md-1">
                                    <label>Image</label>
                                </td>
                                <td class="col-md-1">
                                    <label>Product Name</label>
                                </td>
                                <td class="col-md-1">
                                    <label>Vendor Name</label>
                                </td>
                                <td class="col-md-1">
                                    <label>Product code</label>
                                </td>
                                <td class="col-md-1">
                                    <label>Color</label>
                                </td>
                                <td class="col-md-1">
                                    <label>Size</label>
                                </td>
                                <td class="col-md-1">
                                    <label>Quantity</label>
                                </td>
                                <td class="col-md-1">
                                    <label>Price</label>
                                </td>

                            </tr>

                            @foreach($orderItem as $item)
         <tr>
            <td class="col-md-1">
                <label><img src="{{ asset($item->product->product_thambnail) }}" style="width:50px; height:50px;" > </label>
            </td>
            <td class="col-md-2">
                <label>{{ $item->product->product_name }}</label>
            </td>
            @if($item->vendor_id == NULL)
             <td class="col-md-2">
                <label>Owner </label>
            </td>
            @else
                <td class="col-md-2">
                <label>{{ $item->product->vendor->name }} </label>
            </td>
            @endif

            <td class="col-md-2">
                <label>{{ $item->product->product_code }} </label>
            </td>
            @if($item->color == NULL)
             <td class="col-md-1">
                <label>.... </label>
            </td>
            @else
            <td class="col-md-1">
                <label>{{ $item->color }} </label>
            </td>
            @endif

            @if($item->size == NULL)
             <td class="col-md-1">
                <label>.... </label>
            </td>
            @else
            <td class="col-md-1">
                <label>{{ $item->size }} </label>
            </td>
            @endif
            <td class="col-md-1">
                <label>{{ $item->qty }} </label>
            </td>

            <td class="col-md-3">
                <label>${{ $item->price }} <br> Total = ${{ $item->price * $item->qty }}   </label>
            </td>

        </tr>
        @endforeach
                        </tbody>
                    </table>
                </div>
        </div>

    </div>






</div>

@endsection
