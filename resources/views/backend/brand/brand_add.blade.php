@extends('admin.admin_dashbord')
@section('admin')

{{--  jq/cdn  --}}
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
{{--  end  --}}

<div class="page-content">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Add Brand</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>

                    <li class="breadcrumb-item active" aria-current="page">Add Brand</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">

        </div>
    </div>
    <!--end breadcrumb-->
    <div class="container">
        <div class="main-body">
            <div class="row">



        <div class="col-lg-10">
            <form id="myForm" method="POST" action="{{ route('store.brand') }}" enctype="multipart/form-data" >
                @csrf

                    <div class="card">
                        <div class="card-body">
                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Brand Name</h6>
                                </div>
                                <div class=" form-group col-sm-9 text-secondary">
                                    <input type="text" name="brand_name" id="brand_name" class="form-control"  />

                                </div>
                            </div>

                            {{--  photo  --}}
                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Brand Image</h6>
                                </div>
                                <div class="  col-sm-9 text-secondary">
                                    <input type="file" name="brand_image"  class="form-control" id="image"  />

                                </div>
                            </div>
                            {{--    --}}
                            <div class="row mb-3">
                                <div class="col-sm-3">

                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <img id="showImage" src="{{  url('upload/no_image.jpg') }} "
                                          alt="Admin" class="rounded-circle p-1 bg-primary" width="100" height="100" />
                                </div>
                            </div>
                            {{--  end photo  --}}
                            <div class="row">
                                <div class="col-sm-3"></div>
                                <div class="col-sm-9 text-secondary">
                                    <input type="submit" class="btn btn-primary px-4" value="Save Changes" />
                                </div>
                            </div>
                        </div>
                    </div>
            </form>
        </div>

            </div>
        </div>
    </div>
</div>

{{--  validate --}}
<script type="text/javascript">
    $(document).ready(function (){
        $('#myForm').validate({
            rules: {
                brand_name: {
                    required : true,
                },
            },
            messages :{
                brand_name: {
                    required : 'Please Enter Brand Name',
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
{{--  validate --}}

<script type="text/javascript">
	$(document).ready(function(){
		$('#image').change(function(e){
			var reader = new FileReader();
			reader.onload = function(e){
				$('#showImage').attr('src',e.target.result);
			}
			reader.readAsDataURL(e.target.files['0']);
		});
	});
</script>

@endsection
