@extends('admin.admin_dashbord')
@section('admin')

{{--  jq/cdn image --}}
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>



<div class="page-content">

    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Add Product</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Add New Product</li>
                </ol>
            </nav>
        </div>
    </div>
    <!--end breadcrumb-->

  <div class="card">
      <div class="card-body p-4">
          <h5 class="card-title">Add New Product</h5>
          <hr/>

        <form id="myForm" method="POST" action="{{ route('store.product') }}" enctype="multipart/form-data" >
            @csrf
           <div class="form-body mt-4">
            <div class="row">

                <div class="col-lg-8">
                    <div class="border border-3 p-4 rounded">

                        <div class="form-group mb-3">
                            <label for="productname" class="form-label">Product Name</label>
                            <input type="text" name="product_name" id="product_name" class="form-control"  placeholder="Product name">
                        </div>

                        <div class="form-group mb-3">
                            <label for="tags" class="form-label">Tage</label>
                            <input type="text" name="product_tags" id="product_tags" class="form-control visually-hidden" data-role="tagsinput"  value="new product, top product">
                        </div>

                        <div class="form-group mb-3">
                            <label for="productsize" class="form-label">Product Size</label>
                            <input type="text" name="product_size" id="product_size" class="form-control visually-hidden" data-role="tagsinput" value="Small, Midium,Large">
                        </div>

                        <div class="form-group mb-3">
                            <label for="productcolor" class="form-label">Product Color</label>
                            <input type="text" name="product_color" id="product_color" class="form-control visually-hidden" data-role="tagsinput" value="Red, Blue,Black">
                        </div>

                        <div class="form-group mb-3">
                            <label for="shortdescription" class="form-label">Short Description</label>
                            <textarea class="form-control" name="short_descp" id="short_descp" rows="2"></textarea>
                        </div>


                        <div class="form-group mb-3" >
                            <label for="longdescription" {{ __('Long Description') }} class="form-label">Long Description</label>
                            <textarea class="form-control mytextarea"  name="long_descp" rows="3" required ></textarea>
                            @error('long_descp')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>

                        <div class="form-group mb-3  ">
                            <label for="longdescription" {{ __('Product Info') }} class="form-label">Product Info</label>
                            <textarea class="form-control mytextarea" name="product_info" rows="3" required  ></textarea>
                            @error('product_info')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>



                        {{--  main image  --}}
                        <div class="form-group mb-3">
                            <label for="formFile" class="form-label">Main Image</label>
                            <input class="form-control" type="file" name="product_thambnail" id="formFile" onchange="mainThamUrl(this)" >

                            <img src="" id="mainThmb">
                        </div>

                        <div class="form-group mb-3">
                            <label for="formFile" class="form-label">Images Gallery</label>
                            <input class="form-control " name="multi_img[]" type="file" id="multiImg" required multiple="">
                            <div class="row" id="preview_img"></div>
                        </div>

                    </div>

                </div>

               <div class="col-lg-4">
                <div class="border border-3 p-4 rounded">
                  <div class="row g-3">

                     <div class="form-group col-md-6">
                        <label for="inputPrice" class="form-label">Selling Price</label>
                        <input type="text" name="selling_price" class="form-control" id="selling_price" placeholder="Price">
                      </div>

                      <div class="form-group col-md-6">
                        <label for="inputCompareatprice" class="form-label">Discount Price</label>
                        <input type="text" name="discount_price" class="form-control" id="discount_price" placeholder="Discount">
                      </div>

                      <div class="form-group col-md-6">
                        <label for="inputCostPerPrice" class="form-label">Product Code</label>
                        <input type="text" name="product_code" class="form-control" id="product_code" placeholder="Product Code">
                      </div>

                      <div class="form-group col-md-6">
                        <label for="inputStarPoints" class="form-label">Product Quantity</label>
                        <input type="text" name="product_qty" class="form-control" id="product_qty" placeholder="Quantity">
                      </div>

                      <div class="form-group col-12">
                        <label for="inputProductType"  class="form-label">Product Brand</label>
                        <select class="form-select" name="brand_id"  >
                            <option></option>
                            @foreach ($brands as $brand)
                                <option value="{{ $brand->id }}">{{ $brand->brand_name }}</option>
                            @endforeach
                          </select>
                      </div>
                      <div class="form-group col-12">
                        <label for="inputVendor" class="form-label">Product Category</label>
                        <select class="form-select" name="category_id" id="inputVendor">
                            <option></option>
                            @foreach ($categories as $cat)
                                <option value="{{ $cat->id }}">{{ $cat->category_name }}</option>
                            @endforeach
                          </select>
                      </div>
                      <div class="form-group col-12">
                        <label for="inputCollection" class="form-label">Product Sub-category</label>
                        <select class="form-select" name="subcategory_id" id="inputCollection">
                            <option></option>

                          </select>
                      </div>

                        <div class="form-group col-12">
                            <label for="inputCollection"  class="form-label">Vendor Name</label>
                            <select class="form-select" name="vendor_id" id="inputCollection">
                                <option></option>
                                @foreach ($activeVendor as $vendor)
                                <option value="{{ $vendor->id }}">{{ $vendor->name }}</option>
                            @endforeach
                            </select>
                        </div>

                        <div class="col-md-6">
                            <div class="form-check">
                                <input class="form-check-input" name="hot_deals" type="checkbox" value="1" id="hot_deals">
                                <label class="form-check-label" for="flexCheckDefault">Hot Deals</label>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-check">
                                <input class="form-check-input" name="featured" type="checkbox" value="1" id="featured">
                                <label class="form-check-label" for="flexCheckDefault">	Feature</label>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-check">
                                <input class="form-check-input" name="special_offer" type="checkbox" value="1" id="special_offer">
                                <label class="form-check-label" for="flexCheckDefault">Special Offer</label>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-check">
                                <input class="form-check-input" name="special_deals" type="checkbox" value="1" id="special_deals">
                                <label class="form-check-label" for="flexCheckDefault">	Special Deals</label>
                            </div>
                        </div>

                      <div class="col-12">
                          <div class="d-grid">
                             <input type="submit" class="btn btn-primary px-4" value="Save Product" />
                          </div>
                      </div>
                  </div>
              </div>
              </div>
           </div><!--end row-->
        </div>
    </form>
      </div>
  </div>
</div>




{{--  validate --}}
<script type="text/javascript">
    $(document).ready(function (){
        $('#myForm').validate({
            rules: {
                product_name: {
                    required : true,
                },
                short_descp: {
                    required : true,
                },
                long_descp: {
                    required : true,
                },
                product_thambnail: {
                    required : true,
                },
                multi_img: {
                    required : true,
                },
                product_price: {
                    required : true,
                },
                product_code: {
                    required : true,
                },
                product_qty: {
                    required : true,
                },
                category_id: {
                    required : true,
                },
                subcategory_id: {
                    required : true,
                },


            },
            messages :{
                product_name: {
                    required : 'Please Enter Product Name',
                },
                short_descp: {
                    required : 'Please Enter Short Description ',
                },
                long_descp: {
                    required : 'Please Enter Long Description ',
                },
                product_thambnail: {
                    required : 'Please Enter Product Image',
                },
                multi_img: {
                    required : 'Please Enter Gallery Image ',
                },
                product_price: {
                    required : 'Please Enter Price ',
                },
                product_code: {
                    required : 'Please Enter Product Code ',
                },
                product_qty: {
                    required : 'Please Enter Product Quantity ',
                },
                category_id: {
                    required : 'Please Enter Category ',
                },
                subcategory_id: {
                    required : 'Please Enter Subcategory ',
                },


            },
            errorElement : 'span',
            errorPlacement: function (error,element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight : function(element, errorClass, validClass){
                $(element).addClass('is-invalid');
            },
            unhighlight : function(element, errorClass, validClass){
                $(element).removeClass('is-invalid');
            },
        });
    });

</script>
{{--  end validate --}}
<script>

    $(document).ready(function(){
     $('#multiImg').on('change', function(){ //on file input change
        if (window.File && window.FileReader && window.FileList && window.Blob) //check File API supported browser
        {
            var data = $(this)[0].files; //this file data

            $.each(data, function(index, file){ //loop though each file
                if(/(\.|\/)(gif|jpe?g|png|webp)$/i.test(file.type)){ //check supported file type
                    var fRead = new FileReader(); //new filereader
                    fRead.onload = (function(file){ //trigger function on successful read
                    return function(e) {
                        var img = $('<img/>').addClass('thumb').attr('src', e.target.result) .width(100)
                    .height(80); //create image element
                        $('#preview_img').append(img); //append image to output element
                    };
                    })(file);
                    fRead.readAsDataURL(file); //URL representing the file's data.
                }
            });

        }else{
            alert("Your browser doesn't support File API!"); //if File API is absent
        }
     });
    });

    </script>
{{--  End multiple image  --}}




{{--  main photo product  --}}
<script type="text/javascript">
    function mainThamUrl(input){
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e){
                $('#mainThmb').attr('src',e.target.result).width(80).height(80);
            };
            reader.readAsDataURL(input.files[0]);
        }
    }

</script>


{{--  subcategory option  --}}

<script type="text/javascript">
    $(document).ready(function(){
        $('select[name="category_id"]').on('change', function(){
            var category_id = $(this).val();
            if (category_id){
                $.ajax({
                    url: "{{ url('/subcategory/ajax') }}/"+category_id,
                    type: "GET",
                    datatype: 'json',
                    success:function(data){
                        $('select[name="subcategory_id"]').html('');
                        var d =$('select[name="subcategory_id"]').empty();
                        $.each(data, function(key, value){
                            $('select[name="subcategory_id"]').append('<option value=" '+ value.id +' " >' + value.subcategory_name + '</option>');
                        });
                    },
                });
            } else{
                alert('danger');
            }
        });
    });
</script>




@endsection
