@extends('dashboard')

@section('user')
{{--  jq/cdn  --}}
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
{{--  end  --}}

<div class="page-header breadcrumb-wrap">
    <div class="container">
        <div class="breadcrumb">
            <a href="index.html" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>
            <span></span> My Account
        </div>
    </div>
</div>
<div class="page-content pt-50 pb-50">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 m-auto">
    <div class="row">

        {{--  start col md-3   --}}

        @include('frontend.body.dashboard_sidebar_menu')

         {{--  end col md-3   --}}




            <div class="col-md-9">
                <div class="tab-content account dashboard-content pl-50">
                    <div class="tab-pane fade active show" id="dashboard" role="tabpanel" aria-labelledby="dashboard-tab">
                        <div class="card">
                            {{--  profile  --}}
                            <div class="card-header">
                                <h3 class="mb-0">Hello {{ Auth::user()->name }}</h3><br>
                                <img  src="{{ (!empty($userData->photo))
                                    ? url('upload/user_images/'.$userData->photo)
                                    :url('upload/no_image.jpg') }}" alt="User"
                                    class="rounded-circle p-1 bg-primary" style="height: 100px;
                                    width: 100px; ">
                            </div>
                            {{--  end profile  --}}
                            <div class="card-body">
                                <p>
                                    From your account dashboard. you can easily check &amp; view your <a href="#">recent orders</a>,<br />
                                    manage your <a href="#">shipping and billing addresses</a> and <a href="#">edit your password and account details.</a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>













                </div>
            </div>
        </div>
    </div>
</div>




@endsection
