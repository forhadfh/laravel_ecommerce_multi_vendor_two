@extends('admin.admin_dashbord')
@section('admin')

<div class="page-content">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">All Product</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">All Product
                         <span class="badge rounded-pill bg-danger"> {{ count($products) }} </span> </li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            <div class="btn-group">
                <a href="{{ route('add.product') }}">
                <button type="button" class="btn btn-primary">Add Product</button>
                </a>
            </div>
        </div>
    </div>
    <!--end breadcrumb-->

    <hr/>
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table id="example" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th>Sl</th>
                            <th>Img</th>
                            <th>Name</th>
                            <th>Price</th>
                            <th>Discount</th>
                            <th>QTy</th>
                            <th>Size</th>
                            <th>Color</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $key => $item)
                            <tr>
                                <td>{{ $key+1 }}</td>
                                <td> <img src="{{ asset($item->product_thambnail) }}" style="width: 70px; height:70px;" >  </td>
                                <td>{{ $item->product_name }}</td>
                                <td>{{ $item->selling_price }}</td>
                                <td>
                                    @if ($item->discount_price == NULL)
                                        <span class="badge rounded-pill bg-info">No Discount</span>
                                        @else
                                            @php
                                                $amount = $item->selling_price - $item->discount_price;
                                                $discount = ($amount/$item->selling_price) * 100;
                                            @endphp
                                        <span class="badge rounded-pill bg-danger">{{ round($discount) }}%</span>
                                    @endif
                                </td>
                                <td>{{ $item->product_qty }}</td>
                                <td>{{ $item->product_size }}</td>
                                <td>{{ $item->product_color }}</td>
                                <td>
                                    @if ($item->status == 1)
                                        <span class="badge rounded-pile bg-success">Active</span>
                                        @else
                                        <span class="badge rounded-pile bg-danger">Inactive</span>
                                     @endif
                                 </td>
                                <td>
                                    <a href="{{ route('product.details', $item->id) }}" class="btn btn-info btn-sm" title="Details"  ><i class="fa fa-eye"></i></a>
                                    <a href="{{ route('edit.product', $item->id) }}" class="btn btn-warning btn-sm " title="Edit" ><i class="fa fa-pencil"></i></a>


                                    @if ($item->status == 1)
                                    <a href="{{ route('product.inactive', $item->id) }}" class="btn btn-info btn-sm" title="Active" ><i class="lni lni-checkmark"></i></a>
                                    @else
                                    <a href="{{ route('product.active', $item->id) }}" class="btn btn-danger btn-sm" title="Inactive" ><i class="lni lni-close"></i></a>
                                    @endif
                                    <a href="{{ route('delete.product', $item->id) }}" class="btn btn-danger btn-sm" id="delete" title="Delete" ><i class="fa fa-trash"></i></a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>Sl</th>
                            <th>Img</th>
                            <th>Name</th>
                            <th>Price</th>
                            <th>Discount</th>
                            <th>QTy</th>
                            <th>Size</th>
                            <th>Color</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>

</div>

@endsection

