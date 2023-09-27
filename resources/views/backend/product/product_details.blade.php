@extends('admin.admin_dashbord')
@section('admin')

{{--  jq/cdn image --}}
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>



<div class="page-content">

    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Product Details</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>


                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            <div class="btn-group">
                <a href="{{ route('all.product') }}">
                <button type="button" class="btn btn-primary">BACK PAGE</button>
                </a>
            </div>
        </div>
    </div>
    <!--end breadcrumb-->

  <div class="card">
      <div class="card-body p-4">
          <h5 class="card-title">Product Details</h5>
          <hr/>



           <div class="form-body mt-4">
            <div class="row">

                <div class="col-lg-8">
                    <div class="border border-3 p-4 rounded">

                        <div class="form-group mb-3">
                            <label for="productname" class="form-label">Product Name</label>
                            <input type="text" name="product_name" id="product_name" class="form-control" value="{{ $products->product_name }}"  placeholder="Product name">
                        </div>

                        <div class="form-group mb-3">
                            <label for="tags" class="form-label">Tage</label>
                            <input type="text" name="product_tags" id="product_tags" class="form-control visually-hidden" data-role="tagsinput"  value="{{ $products->product_tags }}">
                        </div>

                        <div class="form-group mb-3">
                            <label for="productsize" class="form-label">Product Size</label>
                            <input type="text" name="product_size" id="product_size" class="form-control visually-hidden" data-role="tagsinput" value="{{ $products->product_size }}">
                        </div>

                        <div class="form-group mb-3">
                            <label for="productcolor" class="form-label">Product Color</label>
                            <input type="text" name="product_color" id="product_color" class="form-control visually-hidden" data-role="tagsinput" value="{{ $products->product_color }}">
                        </div>

                        <div class="form-group mb-3">
                            <label for="shortdescription" class="form-label">Short Description</label>
                            <textarea class="form-control" name="short_descp" id="short_descp" rows="2">{{ $products->short_descp }}</textarea>
                        </div>
                    </div>

                </div>

               <div class="col-lg-4">
                <div class="border border-3 p-4 rounded">
                  <div class="row g-3">

                     <div class="form-group col-md-6">
                        <label for="inputPrice" class="form-label">Product Price</label>
                        <input type="text" name="selling_price" class="form-control" id="selling_price" value="{{ $products->selling_price }}" placeholder="Price">
                      </div>

                      <div class="form-group col-md-6">
                        <label for="inputCompareatprice" class="form-label">Discount Price</label>
                        <input type="text" name="discount_price" class="form-control" id="discount_price" value="{{ $products->discount_price }}" placeholder="Discount">
                      </div>

                      <div class="form-group col-md-6">
                        <label for="inputCostPerPrice" class="form-label">Product Code</label>
                        <input type="text" name="product_code" class="form-control" id="product_code" value="{{ $products->product_code }}" placeholder="Product Code">
                      </div>

                      <div class="form-group col-md-6">
                        <label for="inputStarPoints" class="form-label">Product Quantity</label>
                        <input type="text" name="product_qty" class="form-control" id="product_qty" value="{{ $products->product_qty }}" placeholder="Quantity">
                      </div>

                      <div class="form-group col-12">
                        <label for="inputProductType"  class="form-label">Product Brand</label>
                        <select class="form-select" name="brand_id" disabled >
                            <option></option>
                            @foreach ($brands as $brand)
                                <option value="{{ $brand->id }}" {{ $brand->id == $products->brand_id ? 'selected' : '' }}>{{ $brand->brand_name }}</option>
                            @endforeach
                          </select>
                      </div>

                      <div class="form-group col-12">
                        <label for="inputVendor" class="form-label">Product Category</label>
                        <select class="form-select" name="category_id" id="inputVendor" disabled>
                            <option></option>
                            @foreach ($categories as $cat)
                                <option value="{{ $cat->id }}" {{ $cat->id == $products->category_id ? 'selected' : '' }} >{{ $cat->category_name }}</option>
                            @endforeach
                          </select>
                      </div>

                      <div class="form-group col-12">
                        <label for="inputCollection" class="form-label">Product Sub-category</label>
                        <select class="form-select" name="subcategory_id" id="inputCollection" disabled>
                            <option></option>
                            @foreach ($subcategories as $subcat)
                            <option value="{{ $subcat->id }}" {{ $subcat->id == $products->subcategory_id ? 'selected' : '' }} >{{ $subcat->subcategory_name }}</option>
                            @endforeach
                          </select>
                      </div>

                        <div class="form-group col-12">
                            <label for="inputCollection"  class="form-label">Vendor Name</label>
                            <select class="form-select" name="vendor_id" id="inputCollection" disabled>
                                <option></option>
                                @foreach ($activeVendor as $vendor)
                                <option value="{{ $vendor->id }}" {{ $vendor->id == $products->vendor_id ? 'selected' : '' }} >{{ $vendor->name }}</option>
                            @endforeach
                            </select>
                        </div>

                        <hr>

                        <div class="col-md-6">
                            <div class="form-check">
                                <input class="form-check-input" name="hot_deals" type="checkbox" value="1" id="flexCheckDefault" {{ $products->hot_deals == 1 ? 'checked' : '' }} >
                                <label class="form-check-label" for="flexCheckDefault">Hot Deals</label>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-check">
                                <input class="form-check-input" name="featured" type="checkbox" value="1" id="flexCheckDefault" {{ $products->featured == 1 ? 'checked' : '' }}>
                                <label class="form-check-label" for="flexCheckDefault">	Feature</label>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-check">
                                <input class="form-check-input" name="special_offer" type="checkbox" value="1" id="special_offer" {{ $products->special_offer == 1 ? 'checked' : '' }}>
                                <label class="form-check-label" for="flexCheckDefault">Special Offer</label>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-check">
                                <input class="form-check-input" name="special_deals" type="checkbox" value="1" id="special_deals" {{ $products->special_deals == 1 ? 'checked' : '' }}>
                                <label class="form-check-label" for="flexCheckDefault">	Special Deals</label>
                            </div>
                        </div>

                  </div>
              </div>
              </div>

              <div class="form-group mb-3">
                <label for="longdescription"  class="form-label">Long Description</label>
                <textarea class="form-control"   id="mytextarea" name="long_descp"rows="3"  >{!! $products->long_descp !!}</textarea>



           </div><!--end row-->
        </div>


    </div>
  </div>
</div>


{{--  Main image update part  --}}
<div class="page-content">
    <h6 class="mb-0 text-uppercase"> Main Image Thambnail </h6>
    <hr>
    <div class="card">



            <div class="card-body">

                <div class="mb-3">


                    <img id="mainThmb" src="{{ asset($products->product_thambnail) }}" style="width:100Px; height:100px">
                </div>

            </div>
        </form>
    </div>
</div>
{{--    --}}



<!-- /// Update Multi Image  ////// -->

<div class="page-content">
        <h6 class="mb-0 text-uppercase"> Multi Image </h6>
        <br>

        <hr>
    <div class="card">
        <div class="card-body">
            <table class="table mb-0 table-striped">
                    <thead>
                        <tr>
                            <th scope="col">Sl</th>
                            <th scope="col">Image</th>
                        </tr>
                    </thead>

                    <tbody>

                                    @foreach($multiImgs as $key => $img)
                                        <tr>
                                            <th scope="row">{{ $key+1 }}</th>
                                            <td> <img src="{{ asset($img->photo_name) }}" style="width:100; height: 100px;"> </td>
                                        </tr>
                                    @endforeach
                            </form>
                    </tbody>
            </table>
        </div>
    </div>
</div>

<!-- /// End Update Multi Image  ////// -->


@endsection
