@extends('layouts.branch.app')

@section('title', translate('Chef New Add'))

@push('css_or_js')

@endpush

@section('content')
<div class="content container-fluid">
    <!-- Page Header -->
    <div class="d-flex flex-wrap gap-2 align-items-center mb-4">
        <h2 class="h1 mb-0 d-flex align-items-center gap-2">
            <img width="20" class="avatar-img" src="{{asset('public/assets/admin/img/icons/cooking.png')}}" alt="">
            <span class="page-header-title">
                {{translate('Add_New_Chef')}}
            </span>
        </h2>
    </div>
    <!-- End Page Header -->

    <!-- Content Row -->
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">{{translate('chef form')}}</h5>
                </div>
                <div class="card-body">
                    <form action="{{route('branch.kitchen.add-new')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-6  mb-3">
                                <label for="name">{{translate('First Name')}} <span class="text-danger">*</span></label>
                                <input type="text" name="f_name" class="form-control" id="f_name"
                                        placeholder="{{translate('Ex')}} : {{translate('John')}}" value="{{old('f_name')}}" required>
                            </div>
                            <div class="col-md-6  mb-3">
                                <label for="name">{{translate('Last Name')}} <span class="text-danger">*</span></label>
                                <input type="text" name="l_name" class="form-control" id="l_name"
                                        placeholder="{{translate('Ex')}} : {{translate('Doe')}}" value="{{old('l_name')}}" required>
                            </div>
                            <div class="col-md-6 mb-3">
                          <div class="content-row">
                                <div class="col-area-2">
                                <label for="name">{{translate('Code')}} <span class="text-danger">*</span></label>
                                    {{-- <input type="hidden" name="country_code" value="{{old('country_code')}}" class="form-control" id="country_code" 
                                           placeholder="{{translate('Ex')}} : +91" required> --}}
                                          
                                        <div  id="country-dropdown" class="form-control" style="z-index: 1;"></div>

                                        <input type="hidden"  id="hidden-country-code"  name="country_code">
                                        <input type="hidden"  id="hidden-country-code-string"  name="country_code_string">

                                            {{-- only for show store country code --}}
                                        <input type="hidden"  id="hidden-country-code-string-db" value="">
                                </div>
                                <div class="col-area-10">
                                <label for="name">{{translate('Phone')}} <span class="text-danger" >*</span></label>
                                <input type="number" name="phone" value="{{old('phone')}}" class="form-control" id="phone1"  placeholder="{{translate('Ex')}} : +88017********" style="border-radius:0 .3125rem  .3125rem 0" onkeyup="validateMobileNumber(this)" required>
                             </div>
                          </div>
                             </div>
                            <div class="col-md-6  mb-3">
                                <label for="name">{{translate('Email')}} <span class="text-danger">*</span></label>
                                <input type="email" name="email" value="{{old('email')}}" class="form-control" id="email"
                                        placeholder="{{translate('Ex')}} : ex@gmail.com" required>
                            </div>
                            
                          <div class="col-md-6 mb-3">
                                <label for="name">
                                    {{translate('password')}} 
                                    <span class="text-danger" >*</span> 
                                    <span class="badge badge-soft-danger" style="background:white;font-weight:400" >{{translate('(minimum length will be 6 characters)')}}<span>
                                </label>
                                <input type="password" name="password" class="form-control" id="password"
                                       placeholder="{{translate('Password')}}" required>
                                <span id="password-error" class="text-danger"></span>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="name">{{translate('image')}}</label> 
                                <span class="text-danger">*</span> 
                                <span class="badge badge-soft-danger" style="background:white;font-weight:400">( {{translate('ratio')}} 1:1 )</span>
                                <div class="form-group">
                                    <div class="custom-file text-left">
                                        <input type="file" name="image" id="customFileUpload" class="custom-file-input"
                                            accept=".jpg, .png, .jpeg, .gif, .bmp, .tif, .tiff|image/*" required>
                                        <label class="custom-file-label" for="customFileUpload">{{translate('choose')}} {{translate('file')}}</label>
                                    </div>
                                </div>
                                <div class="text-center">
                                    <img class="upload-img-view" id="viewer"
                                        src="{{asset('public\assets\admin\img\400x400\img2.jpg')}}" alt="image"/>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-end gap-3">
                            <button type="reset" class="btn btn-secondary">{{translate('Reset')}}</button>
                            <button type="submit" onclick="ValidateNo();" class="btn btn-primary">{{translate('submit')}}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
</div>
@endsection

@push('script')

    <script src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
    <script src="{{asset('public/assets/admin')}}/js/select2.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/5.0.6/jquery.inputmask.min.js"></script>

    <script>
        
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#viewer').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }

        $("#customFileUpload").change(function () {
            readURL(this);
        });

        $(".js-example-theme-single").select2({
            theme: "classic"
        });

        $(".js-example-responsive").select2({
            width: 'resolve'
        });
    </script>
@endpush
