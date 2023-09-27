@extends('admin.admin_dashbord')
@section('admin')

{{--  jq/from tabel validate  --}}
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

{{--  end  --}}

<div class="page-content">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Add Blog Post</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>

                    <li class="breadcrumb-item active" aria-current="page">Add Blog Post</li>
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
            <form id="myForm" method="POST" action="{{ route('store.blog.post') }}" enctype="multipart/form-data" >
                @csrf

                    <div class="card">
                        <div class="card-body">


                            <div class=" row mb-3">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Blog Category</h6>
                                </div>
                                <div class=" col-sm-9 text-secondary">
                                    <select name="category_id" class="form-select" id="inputVendor" required>
                                        <option></option>
                                        @foreach($blogcategory as $cat)
                                        <option value="{{ $cat->id }}">{{ $cat->blog_category_name }}</option>
                                         @endforeach
                                      </select>
                                </div>
                            </div>


                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Blog Post</h6>
                                </div>
                                <div class="form-group col-sm-9 text-secondary">
                                    <input type="text" name="post_title" class="form-control" required  />
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Blog Short Decs</h6>
                                </div>
                                <div class="form-group col-sm-9 text-secondary">
                                    <textarea name="post_short_description" class="form-control" id="inputProductDescription" required rows="3"></textarea>
                                </div>
                            </div>



                            <div class="row mb-3 form-group">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Blog Long Decs</h6>
                                </div>
                                <div class="form-group col-sm-9 text-secondary" {{ __('post_long_description') }}>
                                    <textarea class="form-control mytextarea"  name="post_long_description" required> </textarea>
                                    @error('post_long_description')<span class="text-danger">{{ $message }}</span>@enderror
                                </div>
                            </div>

                            {{--  photo  --}}
                            <div class=" row mb-3">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Blog Post Image </h6>
                                </div>
                                <div class=" col-sm-9 text-secondary">
                                    <input type="file" name="post_image" class="form-control"  id="image" required  />
                                </div>
                            </div>



                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <h6 class="mb-0"> </h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                     <img id="showImage" src="{{ url('upload/no_image.jpg') }}" alt="Admin" style="width:100px; height: 100px;"  >
                                </div>
                            </div>
                            {{--  end photo  --}}
                            <div class="row">
                                <div class="col-sm-3"></div>
                                <div class="col-sm-9 text-secondary">
                                    <input type="submit" class="btn btn-primary px-4" value="Save " />
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
                category_id: {
                    required : true,
                },
                post_title: {
                    required : true,
                },
                post_short_description: {
                    required : true,
                },
                post_long_description: {
                    required : true,
                },
                post_image: {
                    required : true,
                },
            },
            messages :{
                category_id: {
                    required : 'Please select Category Name',
                },
                post_title: {
                    required : 'Please Inter Post Title',
                },
                post_short_description: {
                    required : 'Please Inter Post Short Description',
                },
                post_long_description: {
                    required : 'Please Inter Post Long Description',
                },
                post_image: {
                    required : 'Please Inter Post Image',
                },
                v
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
