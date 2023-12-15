@extends('layouts.admin.app')

@section('title', translate('Business Settings'))
@push('css_or_js')
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.1/css/jquery.dataTables.min.css">
    <meta name="csrf-token" content="{{ csrf_token() }}" />

@endpush

@section('content')
    <div class="content container-fluid">
        <!-- Page Header -->
        <div class="d-flex flex-wrap gap-2 align-items-center mb-4">
            <h2 class="h1 mb-0 d-flex align-items-center gap-2">
                <img width="20" class="avatar-img" src="{{asset('public/assets/admin/img/icons/business_setup2.png')}}" alt="">
                <span class="page-header-title">
                    {{translate('Add Offline Payment Method Setup')}}
                </span>
            </h2>
        </div>
        <!-- End Page Header -->

        <div class="row g-2">
            <div class="col-12">
                <!-- Card -->
                <div class="card ">
                
                        <div class="justify-content-start card-top px-card">
                        <div>
                            <a href="{{ route('admin.business-settings.web-app.third-party.offline-payment.add') }}" type="button" class="btn btn-primary btn-attribute"><i class="tio-add"></i>{{translate('Add New Method')}}</a>
                        </div>
                            <form action="{{ url()->current() }}" method="GET">
                                {{-- <div class="input-group">
                                    <input id="datatableSearch_" type="search" name="search" class="form-control" placeholder="{{translate('Search_by_method_name')}}" aria-label="Search" value="{{ $search }}" required="" autocomplete="off">
                                    <div class="input-group-append">
                                        <button type="submit" class="btn btn-primary">
                                            {{translate('Search')}}
                                        </button>
                                    </div>
                                </div> --}}
                            </form>
                        </div>
                        
                

                    <!-- Table -->
                    <div class="set_table">
                        <div class="table-responsive datatable_wrapper_row employee_style"  style="padding-right:10px;">
                            <table id="datatable" class="table table-borderless table-thead-bordered table-nowrap table-align-middle card-table">
                                <thead class="thead-light">
                                <tr>
                                    <th>{{translate('SL')}}</th>
                                    <th>{{translate('Payment Method Name')}}</th>
                                    <th>{{translate('Payment Info')}}</th>
                                    <th>{{translate('Required Info from Customer')}}</th>
                                    <th>{{translate('status')}}</th>
                                    <th class="text-center">{{translate('action')}}</th>
                                </tr>
                                </thead>

                                <tbody>
                                @foreach($methods as $key=>$method)
                                    <tr>
                                        <td>{{$methods->firstitem()+$key}}</td>
                                        <td>
                                            <div class="max-w300 text-wrap">
                                                {{$method['method_name']}}
                                            </div>
                                        </td>
                                        <td>
                                            @foreach($method['method_fields'] as $key=>$fields)
                                                <span class="border border-white max-w300 text-wrap text-left">
                                                    {{$fields['field_name']}} : {{translate($fields['field_data'])}}
                                                </span><br/>
                                            @endforeach
                                        </td>
                                        <td>
                                            @foreach($method['method_informations'] as $key=>$informations)
                                                <span class="border border-white max-w300 text-wrap text-left">
                                                     {{translate($informations['information_name'])}} |
                                                </span>
                                            @endforeach
                                            <div class="max-w300 text-wrap">
                                                Payment note
                                            </div>
                                        </td>
                                        <td>
                                            <div>
                                                <label class="switcher">
                                                    <input class="switcher_input" type="checkbox" {{$method['status']==1? 'checked' : ''}} id="{{$method['id']}}"
                                                           onchange="status_change(this)" data-url="{{route('admin.business-settings.web-app.third-party.offline-payment.status',[$method['id'],1])}}">
                                                    <span class="switcher_control"></span>
                                                </label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex justify-content-center gap-2">
                                                <a class="btn btn-outline-info btn-sm edit square-btn"
                                                   href="{{ route('admin.business-settings.web-app.third-party.offline-payment.edit', [$method['id']]) }}"><i class="tio-edit"></i>
                                                </a>
                                                <button class="btn btn-outline-danger btn-sm delete square-btn" onclick="deleteItem({{ $method->id }})">
                                                    <i class="tio-delete"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="table-responsive mt-4 px-3">
                            <div class="d-flex justify-content-lg-end pagination-style">
                                <!-- Pagination -->
                                {!! $methods->links() !!}
                            </div>
                        </div>
                    </div>
                    <!-- End Table -->
                </div>
                <!-- End Card -->
            </div>
        </div>
    </div>
@endsection

@push('script_2')

    <script>
        function deleteItem(id) {
            Swal.fire({
                // title: '{{translate('Are you sure')}}?',
                text: "{{translate('You will not be able to revert this')}}!",
                showCancelButton: true,
                confirmButtonColor: '#FC6A57',
                cancelButtonColor: '#EA295E',
                confirmButtonText: '{{translate('Yes, delete it')}}!'
            }).then((result) => {
                if (result.value) {

                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                        }
                    });
                    $.ajax({
                        url: "{{route('admin.business-settings.web-app.third-party.offline-payment.delete')}}",
                        method: 'POST',
                        data: {
                                id: id,
                                "_token": "{{ csrf_token() }}",
                            },
                        success: function () {
                            toastr.success('{{translate('Removed successfully')}}');
                            location.reload();
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
                         info: false,
                   paging: false,
                         select: {
                             style: 'multi',
                             selector: 'td:first-child input[type="checkbox"]',
                             classMap: {
                                 checkAll: '#datatableCheckAll',
                                 counter: '#datatableCounter',
                                 counterInfo: '#datatableCounterInfo'
                             }
                         },
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
