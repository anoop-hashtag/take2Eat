@extends('layouts.admin.app')

@section('title', translate('Add new category'))

@push('css_or_js')
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.1/css/jquery.dataTables.min.css">

    <meta name="csrf-token" content="{{ csrf_token() }}">
@endpush

@section('content')
    <div class="content container-fluid">
        <!-- Page Header -->
        <div class="d-flex flex-wrap gap-2 align-items-center mb-4">
            <h2 class="h1 mb-0 d-flex align-items-center gap-2">
                <img width="20" class="avatar-img" src="{{asset('public/assets/admin/img/icons/category.png')}}" alt="">
                <span class="page-header-title">
                    {{translate('add_New_Category')}}
                </span>
            </h2>
        </div>
        <!-- End Page Header -->


        <div class="row g-3">
            <div class="col-12">
                <div class="card card-body">
                    <form action="{{route('admin.category.store')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        @php($data = Helpers::get_business_settings('language'))
                        @php($default_lang = Helpers::get_default_language())

                        @if ($data && array_key_exists('code', $data[0]))
                        <ul class="nav w-fit-content nav-tabs mb-4">
                            @foreach ($data as $lang)
                                <li class="nav-item">
                                    <a class="nav-link lang_link {{ $lang['default'] == true ? 'active' : '' }}" href="#"
                                    id="{{ $lang['code'] }}-link">{{ \App\CentralLogics\Helpers::get_language_name($lang['code']) . '(' . strtoupper($lang['code']) . ')' }}</a>
                                </li>
                            @endforeach
                        </ul>

                        <div class="row align-items-end">
                            <div class="col-12">
                                @foreach ($data as $lang)
                                    <div class="form-group {{ $lang['default'] == false ? 'd-none' : '' }} lang_form"
                                        id="{{ $lang['code'] }}-form">
                                        <label class="input-label" >{{ translate('name') }} ({{ strtoupper($lang['code']) }})</label>
                                        <input type="text" name="name[]" class="form-control" placeholder="{{ translate('New Category') }}" maxlength="255"
                                            {{$lang['status'] == true ? 'required':''}}
                                            @if($lang['status'] == true) oninvalid="document.getElementById('{{$lang['code']}}-link').click()" @endif>
                                    </div>
                                    <input type="hidden" name="lang[]" value="{{ $lang['code'] }}">
                                @endforeach
                                @else
                                <div class="row gy-4">
                                    <div class="col-md-6 mb-4">
                                        <div class="form-group lang_form" id="{{ $default_lang }}-form">
                                            <label class="input-label"
                                                for="exampleFormControlInput1">{{ translate('name') }}
                                                ({{ strtoupper($default_lang) }})</label>
                                            <input type="text" name="name[]"  onchange="readURL(this)" class="form-control" maxlength="255"
                                                placeholder="{{ translate('New Category') }}" required>
                                        </div>
                                        <input type="hidden" name="lang[]" value="{{ $default_lang }}">
                                        @endif
                                        <input name="position" value="0" class="d--none">
                                    </div>
                                    <div class="col-md-6 mb-4">
                                        <div class="from_part_2 mt-2">
                                            <div class="form-group">
                                                <div class="text-center">
                                                    <img width="105" class="rounded-10 border" id="img2"
                                                        src="{{ asset('public/assets/admin/img/400x400/img2.jpg') }}" alt="image" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="from_part_2">
                                            <label>{{ translate('category_Image') }}</label>
                                            <small class="text-danger">* ( {{ translate('ratio') }} 1:1 )</small>
                                            <div class="custom-file">
                                                <input type="file" name="image" id="customFileEg1" onchange="readURL2(this)" class="custom-file-input"
                                                    accept=".jpg, .png, .jpeg, .gif, .bmp, .tif, .tiff|image/*" required
                                                    oninvalid="document.getElementById('en-link').click()">
                                                <label class="custom-file-label" for="customFileEg1">{{ translate('choose file') }}</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-4">
                                        <div class="from_part_2 mb-4 px-4">
                                            <div class="form-group">
                                                <div class="text-center">
                                                    <img width="500" class="rounded-10 border" id="img"
                                                        src="{{ asset('public/assets/admin/img/900x400/img1.jpg') }}" alt="image" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="from_part_2">
                                            <label>{{ translate('banner image') }}</label>
                                            <small class="text-danger">* ( {{ translate('ratio') }} 8:1 )</small>
                                            <div class="custom-file">
                                                <input type="file" name="banner_image" id="customFileEg2" onchange="readURL(this)" class="custom-file-input"
                                                    accept=".jpg, .png, .jpeg, .gif, .bmp, .tif, .tiff|image/*" required
                                                    oninvalid="document.getElementById('en-link').click()">
                                                <label class="custom-file-label" for="customFileEg2">{{ translate('choose file') }}</label>
                                            </div>
                                            <script>
                                                function readURL(input) {
                                                  if (input.files && input.files[0]) {
                                                  
                                                    var reader = new FileReader();
                                                    reader.onload = function (e) { 
                                                      document.querySelector("#img").setAttribute("src",e.target.result);
                                                     
                                                    };
                                              
                                                    reader.readAsDataURL(input.files[0]); 
                                                  }
                                                }
                                                function readURL2(input) {
                                                  if (input.files && input.files[0]) {
                                                  
                                                    var reader = new FileReader();
                                                    reader.onload = function (e) { 
                                                      document.querySelector("#img2").setAttribute("src",e.target.result);
                                                     
                                                    };
                                              
                                                    reader.readAsDataURL(input.files[0]); 
                                                  }
                                                }
                                                </script>
                                        </div>
                                    </div>
                                </div>

                                <div class="d-flex justify-content-end gap-3">
                                    <button type="reset" id="reset" class="btn btn-secondary">{{translate('reset')}}</button>
                                    <button type="submit" class="btn btn-primary">{{translate('submit')}}</button>
                                </div>
                            </div>
                        </div>
                    </form>

            <div class="col-12 mb-3">
                <div class="card">
                    <div class="new-top px-card ">
                        <div class="row justify-content-between align-items-center gy-2">
                            <div class="col-sm-4 col-md-6 col-lg-8">
                                <h5 class="d-flex gap-1 mb-0">
                                    {{translate('Category_Table')}}
                                    <span class="badge badge-soft-dark rounded-50 fz-12">{{ $categories->total() }}</span>
                                </h5>
                            </div>
                            <div class="col-sm-8 col-md-6 col-lg-4">
                                <form action="{{url()->current()}}" method="GET">
                                    {{-- <div class="input-group">
                                        <input id="datatableSearch_" type="search" name="search"
                                            class="form-control"
                                            placeholder="{{translate('Search by category name')}}" aria-label="Search"
                                            value="{{$search}}" required autocomplete="off">
                                        <div class="input-group-append">
                                            <button type="submit" class="btn btn-primary">{{translate('Search')}}</button>
                                        </div>
                                    </div> --}}
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- Table -->
                    <div class="set_table new-responsive">
                        <div class="table-responsive datatable_wrapper_row "  style="padding-right: 10px;">
                            <table id="datatable" class="table table-borderless table-thead-bordered table-nowrap table-align-middle card-table">
                                <thead class="thead-light">
                                    <tr>
                                        <th>{{translate('SL')}}</th>
                                        <th>{{translate('Category_Name')}}</th>
                                        
                                        <th>{{translate('status')}}</th>
                                        <th>{{translate('priority')}}</th>
                                        <th>{{translate('action')}}</th>
                                    </tr>
                                </thead>

                                <tbody>
                                @foreach($categories as $key=>$category)
                                    <tr>
                                        <td>{{$categories->firstitem()+$key}}</td>
                                        <td>
                                            <div class="media gap-3 align-items-center ">
                                                <div class="avatar">
                                                <img width="50" class="avatar-img rounded " src="{{asset('storage/app/public/category')}}/{{$category['image']}}" onerror="this.src='{{asset('public/assets/admin/img/icons/category_img.png')}}'" alt="" style="height:50px;">
                                                </div>
                                                <div class="text-capitalize name-width ">{{$category['name']}}</div>
                                            </div>
                                        </td>
                                        <td>
                                                <div class="category-mid ">
                                                    <label class="switcher ">
                                                        <input class="switcher_input" type="checkbox" {{$category['status']==1? 'checked' : ''}} id="{{$category['id']}}"
                                                        onchange="status_change(this)" data-url="{{route('admin.category.status',[$category['id'],1])}}"
                                                        >
                                                        <span class="switcher_control"></span>
                                                    </label>
                                                </div>

                                        </td>
                                        <td>
                                            <div class="">
                                                <select name="priority" class="custom-select category-select"
                                                        onchange="location.href='{{ route('admin.category.priority', ['id' => $category['id'], 'priority' => '']) }}' + this.value">
                                                    @for($i = 1; $i <= 10; $i++)
                                                        <option value="{{ $i }}" {{ $category->priority == $i ? 'selected' : '' }}>{{ $i }}</option>
                                                    @endfor
                                                </select>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex  gap-2">
                                                <a class="btn btn-outline-info btn-sm edit square-btn"
                                                href="{{route('admin.category.edit',[$category['id']])}}">
                                                    <i class="tio-edit"></i>
                                                </a>
                                                <button type="button" class="btn btn-outline-danger btn-sm delete square-btn"
                                                    onclick="form_alert('category-{{$category['id']}}','{{translate("Want to delete this")}}')">
                                                    <i class="tio-delete"></i>
                                                </button>
                                            </div>
                                            <form action="{{route('admin.category.delete',[$category['id']])}}"
                                                method="post" id="category-{{$category['id']}}">
                                                @csrf @method('delete')
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="table-responsive mt-4 px-3 pagination-style">
                            <div class="d-flex justify-content-lg-end justify-content-sm-end">
                                <!-- Pagination -->
                                {!! $categories->links() !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Table -->
        </div>
    </div>

@endsection

@push('script_2')
    <script>
        $(".lang_link").click(function(e){
            e.preventDefault();
            $(".lang_link").removeClass('active');
            $(".lang_form").addClass('d-none');
            $(this).addClass('active');

            let form_id = this.id;
            let lang = form_id.split("-")[0];
            console.log(lang);
            $("#"+lang+"-form").removeClass('d-none');
            if(lang == '{{$default_lang}}')
            {
                $(".from_part_2").removeClass('d-none');
            }
            else
            {
                $(".from_part_2").addClass('d-none');
            }
        });
    </script>
    <script>
        $(document).on('ready', function () {
            // INITIALIZATION OF DATATABLES
            // =======================================================
            // var datatable = $.HSCore.components.HSDatatables.init($('#columnSearchDatatable'));

            var datatable = $('.table').DataTable({
                "paging": false
            });

            $('#column1_search').on('keyup', function () {
                datatable
                    .columns(1)
                    .search(this.value)
                    .draw();
            });


            $('#column3_search').on('change', function () {
                datatable
                    .columns(2)
                    .search(this.value)
                    .draw();
            });


            // INITIALIZATION OF SELECT2
            // =======================================================
            $('.js-select2-custom').each(function () {
                var select2 = $.HSCore.components.HSSelect2.init($(this));
            });
        });
    </script>

<script>
    $(document).ready(function () {
        // Function to show selected image
        function readURL(input, targetId) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $(targetId).attr('src', e.target.result);
                };

                reader.readAsDataURL(input.files[0]);
            }
        }

        // Trigger when a file is selected for category image
        $('#customFileEg1').on('change', function () {
            readURL(this, '#viewer');
        });

        // Trigger when a file is selected for banner image
        $('#customFileEg2').on('change', function () {
            readURL(this, '#viewer2');
        });
    });
</script>


    <script>

       function change_priority(id, priority, message) {
           console.log(id);
           console.log(priority);
           console.log(message);
           Swal.fire({
            //    title: '{{translate("Are you sure?")}}',
               text: message,
               type: 'warning',
               showCancelButton: true,
               cancelButtonColor: 'default',
               confirmButtonColor: '#FC6A57',
               cancelButtonText: '{{translate("No")}}',
               confirmButtonText: '{{translate("Yes")}}',
               reverseButtons: true
           }).then((result) => {
               if (result.value) {
                   const csrfToken = $('meta[name="csrf-token"]').attr('content');

                   // Create a FormData object to pass data to the backend
                   const formData = new FormData();
                   formData.append('_token', csrfToken);
                   formData.append('id', id); // Append category ID
                   formData.append('priority', priority); // Append selected priority

                   $.ajax({
                       url: "{{ route('admin.category.priority') }}",
                       method: "POST",
                       data: formData,
                       processData: false,
                       contentType: false,
                       success: function(response) {
                           toastr.success("{{translate('Priority changed successfully')}}");
                           setTimeout(function() {
                               location.reload();
                           }, 2000);
                       },
                       error: function(xhr) {
                           toastr.error("{{translate('Priority changed failed')}}");
                       }
                   });
               }
           })
       }
    </script>
 @push('script_2')
  <script>
      $(document).on('ready', function () {
          // INITIALIZATION OF NAV SCROLLER
          // =======================================================
          $('.js-nav-scroller').each(function () {
              new HsNavScroller($(this)).init()
          });
  
          // INITIALIZATION OF SELECT2
          // =======================================================
          $('.js-select2-custom').each(function () {
              var select2 = $.HSCore.components.HSSelect2.init($(this));
          });
  
  
          // INITIALIZATION OF DATATABLES
          // =======================================================
          var datatable = $.HSCore.components.HSDatatables.init($('#datatable'), {
              dom: 'Bfrtip',
              buttons: [
                  {
                      extend: 'copy',
                      className: 'd-none'
                  },
                  {
                      extend: 'excel',
                      className: 'd-none'
                  },
                  {
                      extend: 'csv',
                      className: 'd-none'
                  },
                  {
                      extend: 'pdf',
                      className: 'd-none'
                  },
                  {
                      extend: 'print',
                      className: 'd-none'
                  },
                  
              ],
             
              select: {
                  style: 'multi',
                  selector: 'td:first-child input[type="checkbox"]',
                  classMap: {
                      checkAll: '#datatableCheckAll',
                      counter: '#datatableCounter',
                      counterInfo: '#datatableCounterInfo'
                  }
              },
                    info: false,
                    paging: false,
              language: {
                  zeroRecords: '<div class="text-center p-4">' +
                      '<img class="mb-3" src="{{asset('public/assets/admin')}}/svg/illustrations/sorry.svg" alt="Image Description" style="width: 7rem;">' +
                      '<p class="mb-0">{{translate('No data to show')}}</p>' +
                      '</div>'
              }
          });
  
          // INITIALIZATION OF TAGIFY
          // =======================================================
          $('.js-tagify').each(function () {
              var tagify = $.HSCore.components.HSTagify.init($(this));
          });
      });
  
      function filter_branch_orders(id) {
          location.href = '{{url('/')}}/admin/orders/branch-filter/' + id;
      }
     
  </script>
@endpush
