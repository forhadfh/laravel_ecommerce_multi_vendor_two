@extends('frontend.master_dashboard')
@section('main')


@section('title')
{{ $product->product_name }} Product
@endsection


<div class="page-header breadcrumb-wrap">
    <div class="container">
        <div class="breadcrumb">
            <a href="index.html" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>
            <span></span> <a href="s">
                {{ $product['category']['category_name'] }}</a>
                <span></span>{{ $product['subcategory']['subcategory_name'] }}
                <span>{{ $product->product_name }}</span>
        </div>
    </div>
</div>
<div class="container mb-30">
    <div class="row">
        <div class="col-xl-10 col-lg-12 m-auto">
            <div class="product-detail accordion-detail">
                <div class="row mb-50 mt-30">

{{--  Image  --}}
                    <div class="col-md-6 col-sm-12 col-xs-12 mb-md-0 mb-sm-5">
                        <div class="detail-gallery">
                            <span class="zoom-icon"><i class="fi-rs-search"></i></span>
                            <!-- MAIN SLIDES -->
                            <div class="product-image-slider">
                                @foreach($multiImage as $img)
                                <figure class="border-radius-10">
                                    <img src="{{ asset($img->photo_name) }} " alt="product image" />
                                </figure>
                                @endforeach
                            </div>
                            <!-- THUMBNAILS -->
                            <div class="slider-nav-thumbnails">
                                @foreach($multiImage as $img)
                                <div><img src="{{ asset($img->photo_name) }}" alt="product image" /></div>
                                @endforeach
                            </div>
                        </div>
                        <!-- End Gallery -->
                    </div>
{{--  END Image  --}}

                    <div class="col-md-6 col-sm-12 col-xs-12">
                        <div class="detail-info pr-30 pl-30">

                            {{--  stock in & out  --}}
                                @if ($product->product_qty > 0)
                                <span class="stock-status in-stock"> In Stock </span>
                                @else
                                <span class="stock-status out-stock"> Stok Out </span>
                                @endif
                            {{-- END stock in & out  --}}

                            <h2 class="title-detail" id="dpname">{{ $product->product_name }}</h2>
                            <div class="product-detail-rating">
                                <div class="product-rate-cover text-end">

@php
    $reviewcount = App\Models\Review::where('product_id', $product->id)->where('status',1)->latest()->get();
    $avarage = App\Models\Review::where('product_id', $product->id)->where('status',1)->avg('rating');
@endphp
                                    <div class="product-rate d-inline-block">
                                        @if ($avarage == 0)

                                            @elseif($avarage == 1 || $avarage < 2)
                                            <div class="product-rating" style="width: 20%"></div>
                                            @elseif($avarage == 2 || $avarage < 3)
                                            <div class="product-rating" style="width: 40%"></div>
                                            @elseif($avarage == 3 || $avarage < 4)
                                            <div class="product-rating" style="width: 60%"></div>
                                            @elseif($avarage == 4 || $avarage < 5)
                                            <div class="product-rating" style="width: 80%"></div>
                                            @elseif($avarage == 5 || $avarage < 5)
                                            <div class="product-rating" style="width: 100%"></div>
                                        @endif
                                    </div>


                                    <span class="font-small ml-5 text-muted"> ({{ count($reviewcount) }})</span>
                                </div>
                            </div>

                            {{--  product % & price  --}}
                            <div class="clearfix product-price-cover">
                                    @php
                                    $amount = $product->selling_price - $product->discount_price;
                                    $discount = ($amount/$product->selling_price) * 100;
                                @endphp

                                @if ($product->discount_price == NULL)
                                    <div class="product-price primary-color float-left">
                                        <span class="current-price text-brand">${{ $product->selling_price }}</span>
                                    </div>
                                @else
                                    <div class="product-price primary-color float-left">
                                        <span class="current-price text-brand">${{ $product->discount_price }}</span>
                                        <span>
                                            <span class="save-price font-md color3 ml-15">{{ round($discount) }}% Off</span>
                                            <span class="old-price font-md ml-15">${{ $product->selling_price }}</span>
                                        </span>
                                    </div>
                                @endif
                            </div>
                            {{-- END  product % & price  --}}

                            <div class="short-desc mb-30">
                                <p class="font-lg">{{ $product->short_descp }}</p>
                            </div>

        {{--  size $ color  --}}
                                @if($product->product_size == NULL)
                                @else

                            <div class="attr-detail attr-size mb-30">
                                    <strong class="mr-10" style="width:50px;">Size : </strong>
                                    <select class="form-control unicase-form-control" id="dsize">
                                        <option selected="" disabled="">--Choose Size--</option>
                                        @foreach($product_size as $size)
                                        <option value="{{ $size }}">{{ ucwords($size)  }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @endif



                                @if($product->product_color == NULL)
                                @else

                                <div class="attr-detail attr-size mb-30">
                                    <strong class="mr-10" style="width:50px;">Color : </strong>
                                    <select class="form-control unicase-form-control" id="dcolor">
                                        <option selected="" disabled="">--Choose Color--</option>
                                        @foreach($product_color as $color)
                                        <option value="{{ $color }}">{{ ucwords($color)  }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @endif
        {{-- End size $ color  --}}


                            <div class="detail-extralink mb-50">
                                <div class="detail-qty border radius">
                                    <a href="#" class="qty-down"><i class="fi-rs-angle-small-down"></i></a>
                    <input type="text" name="quantity" id="dqty" class="qty-val" value="1" min="1">
                                    <a href="#" class="qty-up"><i class="fi-rs-angle-small-up"></i></a>
                                </div>
                                <div class="product-extra-link2">

                                    <input type="hidden" id="dproduct_id" value="{{ $product->id }}">

                                    <input type="hidden" id="vproduct_id" value="{{ $product->vendor_id }}">

                                    <button type="submit" class="button button-add-to-cart" onclick="addToCartDetails()" ><i class="fi-rs-shopping-cart"></i>Add to cart</button>

                                    <a aria-label="Add To Wishlist" class="action-btn" id="{{ $product->id }}" onclick="addToWishlist(this.id)"><i class="fi-rs-heart"></i></a>

                                    <a aria-label="Compare" class="action-btn" id="{{ $product->id }}" onclick="addToCompare(this.id)"><i class="fi-rs-shuffle"></i></a>


                                </div>
                            </div>

{{--  Product all tag category qty   --}}

        @if ($product->	vendor_id == NULL)
        <h6>Solt By: <a href="#"> <span class="text-danger"> Owner</span></a></h6>
        @else
        <h6>Solt By: <a href="#"><span class="text-danger">{{ $product['vendor']['name'] }}</span></a></h6>
        @endif

        <hr>
                                <div class="font-xs">
                                    <ul class="mr-50 float-start">
                                        @if($product->brand_id == NULL)
                                            @else
                                            <li class="mb-5">Brand: <span class="text-brand">{{ $product['brand']['brand_name'] }}</span></li>
                                        @endif

                                    <li class="mb-5">Category:<span class="text-brand"> {{ $product['category']['category_name'] }}</span></li>
                                    <li>SubCategory: <span class="text-brand">{{ $product['subcategory']['subcategory_name'] }}</span></li>
                                    </ul>

                                    <ul class="float-start">
                                    <li class="mb-5">Product Code: <a href="#">{{ $product->product_code }}</a></li>
                                    <li class="mb-5">Tags: <a href="#" rel="tag">{{ $product->product_tags }}</a></li>
                                    <li>Stock:<span class="in-stock text-brand ml-5">({{ $product->product_qty }}) Items In Stock</span></li>
                                    </ul>
                                </div>
                        </div>
                        <!-- Detail Info -->

{{-- End Product all tag category qty   --}}
                    </div>



                </div>
                <div class="product-info">
                    <div class="tab-style3">
                        <ul class="nav nav-tabs text-uppercase">
                            <li class="nav-item">
                                <a class="nav-link active" id="Description-tab" data-bs-toggle="tab" href="#Description">Description</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="Additional-info-tab" data-bs-toggle="tab" href="#Additional-info">Additional info</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="Vendor-info-tab" data-bs-toggle="tab" href="#Vendor-info">Vendor</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="Reviews-tab" data-bs-toggle="tab" href="#Reviews">Reviews ({{ count($reviewcount) }})</a>
                            </li>
                        </ul>

                        <div class="tab-content shop_info_tab entry-main-content">
{{--  Description & info  --}}
                            <div class="tab-pane fade show active" id="Description">
                                <div class="">
                                    <p>{!! $product->long_descp !!}</p>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="Additional-info">
                                <table class="font-md">
                                    <tbody>

                                        <p>{!! $product->product_info !!}</p>


                                    </tbody>
                                </table>
                            </div>
{{-- END Description & info  --}}




                            <div class="tab-pane fade" id="Vendor-info">
                                <div class="vendor-logo d-flex mb-30">
                            {{--  img  --}}
                                    @if($product->vendor_id == NULL)
                                    @else
                                    <h6>
                                       <img src="{{ (!empty($product->vendor->photo)) ? url('upload/vendor_images/'.$product->vendor->photo):url('upload/no_image.jpg') }}" alt="" />
                                    </h6>
                                    @endif
                                    <div class="vendor-name ml-15">
                            {{--  img  --}}

                            {{--  name  --}}
                                        @if($product->vendor_id == NULL)
                                        <h6>
                                            <a href="vendor-details-2.html">Owner</a>
                                        </h6>
                                        @else
                                        <h6>
                                            <a href="vendor-details-2.html">{{ $product['vendor']['name'] }}</a>
                                        </h6>
                                        @endif
                            {{--  end name  --}}
                                        <div class="product-rate-cover text-end">
                                            <div class="product-rate d-inline-block">
                                                <div class="product-rating" style="width: 90%"></div>
                                            </div>
                                            <span class="font-small ml-5 text-muted"> (32 reviews)</span>
                                        </div>
                                    </div>
                                </div>
                            {{--  address  --}}
                                <ul class="contact-infor mb-50">
                                    @if($product->vendor_id == NULL)
                                        @else
                                        <h6>
                                            <li><img src="assets/imgs/theme/icons/icon-location.svg" alt="" />
                                        <strong>Address: </strong> <span>{{ $product['vendor']['address'] }}</span></li>
                                        <li><img src="assets/imgs/theme/icons/icon-contact.svg" alt="" />
                                        <strong>Contact Seller:</strong><span>{{ $product['vendor']['phone'] }}</span></li>
                                        </h6>
                                    @endif
                                </ul>
                            {{-- end address  --}}


                                {{--  <div class="d-flex mb-55">
                                    <div class="mr-30">
                                        <p class="text-brand font-xs">Rating</p>
                                        <h4 class="mb-0">92%</h4>
                                    </div>
                                    <div class="mr-30">
                                        <p class="text-brand font-xs">Ship on time</p>
                                        <h4 class="mb-0">100%</h4>
                                    </div>
                                    <div>
                                        <p class="text-brand font-xs">Chat response</p>
                                        <h4 class="mb-0">89%</h4>
                                    </div>
                                </div>  --}}

                            {{--  info  --}}
                                @if($product->vendor_id == NULL)
                                        @else
                                        <p>{{ $product['vendor']['vendor_short_info'] }}</p>
                                    @endif
                            {{-- end info  --}}
                        </div>


                            <div class="tab-pane fade" id="Reviews">
                                <!--Comments-->
                                <div class="comments-area">
                                    <div class="row">
                                        <div class="col-lg-8">
                                            <h4 class="mb-30">Customer questions & answers</h4>
                                            <div class="comment-list">
@php
    $reviews = App\Models\Review::where('product_id',$product->id)->latest()->limit(10)->get();
@endphp

                                            @foreach ($reviews as $item)

                                            @if ($item->status == 0)

                                            @else

                                            <div class="single-comment justify-content-between d-flex mb-30">
                                                <div class="user justify-content-between d-flex">
                                                    <div class="thumb text-center">
                                                        <img src="{{ (!empty($item->user->photo)) ? url('upload/user_images/'.$item->user->photo):url('upload/no_image.jpg') }}" alt="" />
                                                        <a href="#" class="font-heading text-brand">{{ $item->user->name }}</a>
                                                    </div>
                                                    <div class="desc">
                                                        <div class="d-flex justify-content-between mb-10">
                                                            <div class="d-flex align-items-center">
                                                                <span class="font-xs text-muted"> {{ Carbon\Carbon::parse($item->created_at)->diffForHumans() }} </span>
                                                            </div>
                                                            <div class="product-rate d-inline-block">

                                        @if($item->rating == NULL)
                                        @elseif($item->rating == 1)
                                         <div class="product-rating" style="width: 20%"></div>
                                        @elseif($item->rating == 2)
                                         <div class="product-rating" style="width: 40%"></div>
                                        @elseif($item->rating == 3)
                                        <div class="product-rating" style="width: 60%"></div>
                                        @elseif($item->rating == 4)
                                         <div class="product-rating" style="width: 80%"></div>
                                        @elseif($item->rating == 5)
                                         <div class="product-rating" style="width: 100%"></div>
                                        @endif
                                                            </div>
                                                        </div>
                                                        <p class="mb-10">{{ $item->comment }}</p>
                                                    </div>
                                                </div>
                                            </div>

                                             @endif


                                            @endforeach

                                            </div>
                                        </div>

                                        <div class="col-lg-4">
                                            <h4 class="mb-30">Customer reviews</h4>
                                            <div class="d-flex mb-30">
                                                <div class="product-rate d-inline-block mr-15">
                                                    @if ($avarage == 0)

                                                        @elseif($avarage == 1 || $avarage < 2)
                                                        <div class="product-rating" style="width: 20%"></div>
                                                        @elseif($avarage == 2 || $avarage < 3)
                                                        <div class="product-rating" style="width: 40%"></div>
                                                        @elseif($avarage == 3 || $avarage < 4)
                                                        <div class="product-rating" style="width: 60%"></div>
                                                        @elseif($avarage == 4 || $avarage < 5)
                                                        <div class="product-rating" style="width: 80%"></div>
                                                        @elseif($avarage == 5 || $avarage < 5)
                                                        <div class="product-rating" style="width: 100%"></div>
                                                    @endif
                                                </div>
                                            </div>




                                            {{--  <div class="progress">
                                                <span>5 star</span>
                                                <div class="progress-bar" id="five" role="progressbar" style="width: %" aria-valuenow="" aria-valuemin="" aria-valuemax="">%</div>
                                            </div>
                                            <div class="progress">
                                                <span>4 star</span>
                                                <div class="progress-bar" id="fore" role="progressbar" style="width: 58%" aria-valuenow="58" aria-valuemin="0" aria-valuemax="100">25%</div>
                                            </div>
                                            <div class="progress">
                                                <span>3 star</span>
                                                <div class="progress-bar" id="three" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">45%</div>
                                            </div>
                                            <div class="progress">
                                                <span>2 star</span>
                                                <div class="progress-bar" id="two" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">65%</div>
                                            </div>
                                            <div class="progress mb-30">
                                                <span>1 star</span>
                                                <div class="progress-bar" id="one" role="progressbar" style="width: 5%" aria-valuenow="5" aria-valuemin="0" aria-valuemax="100">85%</div>
                                            </div>
                                            <a href="#" class="font-xs text-muted">How are ratings calculated?</a>  --}}
                                        </div>

                                    </div>
                                </div>
                                <!--comment form-->
                                <div class="comment-form">
                                    <h4 class="mb-15">Add a review</h4>






                                    <div class="product-rate d-inline-block mb-30"></div>
                                    <div class="row">

             @guest
                <p><b>For Add Product Review. You Need To Login First <a href="{{ route('login') }}">Login Here</a></b></p>
            @else


                                    <div class="col-lg-8 col-md-12">

                                            <form class="form-contact comment_form" method="POST" action="{{ route('store.review') }}" id="commentForm">
                                                @csrf
                                                <input type="hidden" name="product_id"  value="{{ $product->id }}">
                                                @if ($product->vendor_id == NULL)
                                                <input type="hidden" name="vendor_id"  value="">
                                                @else
                                                <input type="hidden" name="vendor_id"  value="{{ $product->vendor_id }}">
                                                @endif

                                                            <div class="row">

                                                    <table class="table" style="width: 60%;">
                                                        <thead>
                                                            <tr>
                                                                <th class="cell-level">&star;</th>
                                                                <th class="fa fa-star checked">1 Star</th>
                                                                <th>2 Star</th>
                                                                <th>3 Star</th>
                                                                <th>4 Star</th>
                                                                <th>5 Star</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td class="cell-level">Quality</td>
                                                                <td><input type="radio" name="quality" class="radio-sm" value="1"></td>
                                                                <td><input type="radio" name="quality" class="radio-sm" value="2"></td>
                                                                <td><input type="radio" name="quality" class="radio-sm" value="3"></td>
                                                                <td><input type="radio" name="quality" class="radio-sm" value="4"></td>
                                                                <td><input type="radio" name="quality" class="radio-sm" value="5"></td>
                                                            </tr>
                                                        </tbody>
                                                    </table>

                                                    <div class="col-12">
                                                        <div class="form-group">
                                                            <textarea class="form-control w-100" name="comment"
                                                             id="comment" required cols="30" rows="9" placeholder="Write Comment"></textarea>
                                                        </div>
                                                    </div>



                                                </div>
                                                <div class="form-group">
                                                    <button type="submit" class="button button-contactForm">Submit Review</button>
                                                </div>
                                            </form>

                                        </div>
                                    </div>
                                </div>
        @endguest

                            </div>
                        </div>
                    </div>
                </div>



        {{--  relatedProduct  --}}

                <div class="row mt-60">
                    <div class="col-12">
                        <h2 class="section-title style-1 mb-30">Related products</h2>
                    </div>
                    <div class="col-12">
                        <div class="row related-products">

                        @foreach ($relatedProduct as $product)


                            <div class="col-lg-3 col-md-4 col-12 col-sm-6">
                                <div class="product-cart-wrap hover-up">
                                    <div class="product-img-action-wrap">

                                    {{--  img  --}}
                                        <div class="product-img product-img-zoom">
                                            <a href="{{ url('product/details/'.$product->id.'/'.$product->product_slug) }}" tabindex="0">
                                                <img class="default-img" src="{{ asset($product->product_thambnail) }}" alt="" />
                                            </a>
                                        </div>
                                    {{--End  img  --}}

                                        <div class="product-action-1">
                                            <a aria-label="Add To Wishlist" class="action-btn" id="{{ $product->id }}" onclick="addToWishlist(this.id)"><i class="fi-rs-heart"></i></a>

                                    <a aria-label="Compare" class="action-btn" id="{{ $product->id }}" onclick="addToCompare(this.id)"><i class="fi-rs-shuffle"></i></a>

                                    <a aria-label="Quick view" class="action-btn"  data-bs-toggle="modal" data-bs-target="#quickViewModal" id="{{ $product->id }}" onclick="productView(this.id)" ><i class="fi-rs-eye"></i></a>
                                        </div>

                          {{--  price  --}}
                                        <div class="product-badges product-badges-position product-badges-mrg">
                                            @php
                                            $amount = $product->selling_price - $product->discount_price;
                                            $discount = ($amount/$product->selling_price) * 100;
                                            @endphp

                                            @if ($product->discount_price == NULL)
                                    <span class="new">New</span>
                                    @else
                                    <span class="hot">{{ round($discount) }}%</span>
                                    @endif

                                        </div>
                                    </div>
                                    <div class="product-content-wrap">
                                        <h2><a href="{{ url('product/details/'.$product->id.'/'.$product->product_slug) }}" tabindex="0">{{ $product->product_name }}</a></h2>
                                        @php
                                        $reviewcount = App\Models\Review::where('product_id', $product->id)->where('status',1)->latest()->get();
                                        $avarage = App\Models\Review::where('product_id', $product->id)->where('status',1)->avg('rating');
                                    @endphp
                                                                        <div class="product-rate d-inline-block">
                                                                            @if ($avarage == 0)

                                                                                @elseif($avarage == 1 || $avarage < 2)
                                                                                <div class="product-rating" style="width: 20%"></div>
                                                                                @elseif($avarage == 2 || $avarage < 3)
                                                                                <div class="product-rating" style="width: 40%"></div>
                                                                                @elseif($avarage == 3 || $avarage < 4)
                                                                                <div class="product-rating" style="width: 60%"></div>
                                                                                @elseif($avarage == 4 || $avarage < 5)
                                                                                <div class="product-rating" style="width: 80%"></div>
                                                                                @elseif($avarage == 5 || $avarage < 5)
                                                                                <div class="product-rating" style="width: 100%"></div>
                                                                            @endif
                                                                        </div>

                                                                        <span class="font-small ml-5 text-muted"> ({{ count($reviewcount) }})</span>

                                        <div class="product-price">
                                            @if ($product->discount_price == NULL)
                                            <div class="product-price">
                                                <span>${{$product->selling_price}}</span>
                                            </div>
                                            @else
                                            <div class="product-price">
                                                <span>${{$product->discount_price}}</span>
                                                <span class="old-price">${{$product->selling_price}}</span>
                                            </div>
                                            @endif

                                        </div>

                                    </div>

                                {{--end  price  --}}
                                </div>
                            </div>
                        @endforeach

                    {{--  relatedProduct  --}}


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
