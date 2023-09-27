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
                            <div class="card-header">
                                <h5>Change Password</h5>
                            </div>
                            <div class="card-body">

                    <form method="POST" action="{{ route('user.update.password') }}"  >
                    @csrf

                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @elseif(session('error'))
                    <div class="alert alert-danger" role="alert">
                        {{ session('error') }}
                    </div>
                    @endif

                    <div class="row">

                    <div class="form-group col-md-12">
                    <label>Old Password <span class="required">*</span></label>
                    <input type="password" name="old_password"
                    class="form-control @error('old_password') is-invalid @enderror"
                    id="current_password"   placeholder="Old Password"/>

                    @error('old_password')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror

                    </div>

                    <div class="form-group col-md-12">
                    <label>New Password <span class="required">*</span></label>
                    <input type="password" name="new_password"
                     class="form-control @error('new_password') is-invalid @enderror"
                      id="new_password"   placeholder="New Password" />

                    @error('new_password')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror

                    </div>
                    <div class="form-group col-md-12">
                    <label>Old Password <span class="required">*</span></label>
                    <input type="password" name="new_password_confirmation"
                    class="form-control @error('new_password_confirmation') is-invalid @enderror"
                     id="new_password_confirmation"   placeholder="Confirm New Password" />


                    @error('new_password_confirmation')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror

                    </div>

                    <div class="col-md-12">
                    <button type="submit" class="btn btn-fill-out submit font-weight-bold" name="submit" value="Submit">Save Change</button>
                    </div>
                    </div>
                    </form>
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



<script type="text/javascript">
	$(document).ready(function(){
		$('#images').change(function(e){
			var reader = new FileReader();
			reader.onload = function(e){
				$('#showImages').attr('src',e.target.result);
			}
			reader.readAsDataURL(e.target.files['0']);
		});
	});
</script>
@endsection
