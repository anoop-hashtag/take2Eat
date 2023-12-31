@extends('layouts.branch.app')

@section('title', translate('Table Availability'))

@push('css_or_js')
<style>
    .bg-gray{
        background: #e4e4e4;
    }
    .bg-c1 {
        background-color: #FF6767 !important;
    }
    .c1 {
        color: #FF6767 !important;
    }
</style>
@endpush

@section('content')
    <div class="content container-fluid">
        <!-- Page Header -->
        <div class="d-flex flex-wrap gap-2 align-items-center mb-4">
            <h2 class="h1 mb-0 d-flex align-items-center gap-2">
                <img width="20" class="avatar-img" src="{{asset('public/assets/admin/img/icons/table.png')}}" alt="">
                <span class="page-header-title">
                    {{translate('Table_Availability_test')}}
                </span>
            </h2>
        </div>
        <!-- End Page Header -->

        <div class="card card-body">
            <div class="d-flex gap-3 flex-wrap align-items-center justify-content-between mb-4">
{{--                next release--}}
{{--                <div class="inline-page-menu">--}}
{{--                    <ul class="list-unstyled">--}}
{{--                        <li class="active"><a href="#">All</a></li>--}}
{{--                        <li><a href="#">Scheduled</a></li>--}}
{{--                        <li><a href="#">Currently Busy</a></li>--}}
{{--                    </ul>--}}
{{--                </div>--}}

{{--                <select name="branch_id" class="custom-select max-w220" id="select_branch" required>--}}
{{--                    <option value="" selected disabled>{{ translate('--Select_Branch--') }}</option>--}}
{{--                    @foreach($branches as $branch)--}}
{{--                        <option value="{{$branch['id']}}">{{$branch['name']}}</option>--}}
{{--                    @endforeach--}}
{{--                </select>--}}
            </div>
            <div class="table_box_list justify-content-center gap-2 gap-md-3" id="table_list">
                {{--@dd($tables)--}}
                @if($tables != null)
                    @foreach($tables as $table)
                        <div class="dropright">
                            <div class="card table_hover-btn py-4 {{ $table['order'] != null ? 'bg-card' : 'bg-gray'}} stopPropagation"
                                {{--             data-toggle="modal" data-target="#tableInfoModal"--}}
                            >
                                <div class="card-design mx-3 position-relative text-center ">
                                    {{--                next release--}}
                                    {{--                <i class="tio-alarm-alert position-absolute right-0 top-0 fz-18 text-primary"></i>--}}
                                    <!-- <h3 class="card-title mb-2">{{ translate('table') }}</h3> -->
                                    <h5 class="card-title mb-1 card-number"><span>{{ $table['number'] }}</span></h5>
                                    <h5 class="card-title mb-1">{{ translate('capacity') }}: {{ $table['capacity'] }}</h5>
                                    <button type="button" class="btn btn-primary btn-card" data-toggle="modal" data-target="#myModal{{ translate('table').$table['number'] }}">
                                        View Details
                                    </button>
                                </div>
                            </div>
                            <div class="modal fade" id="myModal{{ translate('table').$table['number'] }}">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                    
                                        <!-- Modal Header -->
                                        <div class="modal-header">
                                            <h4 class="modal-title">{{ translate('Table - ') }}{{ $table['number'] }}</h4>
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        </div>
                                        
                                        <!-- Modal body -->
                                        <div class="modal-body">
                                            @if(($table['order'] != null))
                                                <div style="width: 100%; height: auto; max-height: 500px; ">
                                                    <table class="table  table-bordered">
                                                        <thead>
                                                            <tr>
                                                                <th>S.No.</th>
                                                                <th>{{ translate('Order ID') }}</th>
                                                                <th>{{ translate('Order Amount') }}</th>
                                                                <th>{{ translate('Order Date') }}</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @php
                                                                $i = 1;
                                                            @endphp
                                                            @foreach($table['order'] as $order)
                                                                <tr>
                                                                    <td>{{ $i++ }}</td>
                                                                    <td>{{ $order['id'] }}</td>
                                                                    <td>{{\App\CentralLogics\Helpers::currency_symbol()}} {{ number_format((float)$order['order_amount'], 2, '.', '') }}</td>
                                                                    <td>{{ date('d-m-Y',strtotime($order['created_at'])) .' '. date(config('time_format'), strtotime($order['created_at'])) }}</td>
                                                                </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>                            
                                                </div>
                                            @else
                                                <div class="fz-14 mb-1">{{ translate('current status') }} - <strong>{{ translate('empty') }}</strong></div>
                                                <div class="fz-14 mb-1">{{ translate('any reservation') }} - <strong>{{ translate('N/A') }}</strong></div>
                                            @endif
                                        </div>
                                        
                                        <!-- Modal footer -->
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>
                            {{-- <div class="table_hover-menu px-3">
                                <h3 class="mb-3">{{ translate('Table -') }}{{ $table['number'] }}</h3>
                                @if(($table['order'] != null))
                                    @foreach($table['order'] as $order)
                                        <div class="fz-14 mb-1">{{ translate('order id') }}: <strong>{{ $order['id'] }}</strong></div>
                                    @endforeach
                                @else
                                    <div class="fz-14 mb-1">{{ translate('current status') }} - <strong>{{ translate('empty') }}</strong></div>
                                    <div class="fz-14 mb-1">{{ translate('any reservation') }} - <strong>{{ translate('N/A') }}</strong></div>
                                @endif --}}
                                {{-- next release--}}
                                {{--            <div class="d-flex flex-wrap gap-2 mt-3">--}}
                                {{--                <a href="#" data-dismiss="modal" class="btn btn-outline-primary text-nowrap stopPropagation" data-toggle="modal" data-target="#reservationModal"><i class="tio-alarm-alert"></i> {{ translate('Create_Reservation') }}</a>--}}
                                {{--                <a href="#" class="btn btn-primary text-nowrap">{{ translate('Place_Order') }}</a>--}}
                                {{--            </div>--}}
                            
                        </div>
                    @endforeach
                @else
                    <div class="col-md-12 text-center">
                        <div class="branch-no-data">
                            <div class="branch-image">
                                <img  class="" src="{{asset('public/assets/admin/img/slider-2.png')}}" alt="" />
                            </div>
                            <h3 class="mt-5">{{translate('This branch has no table')}}</h3>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script src="https://code.jquery.com/jquery-3.1.1.min.js" integrity="sha384-3ceskX3iaEnIogmQchP8opvBy3Mi7Ce34nWjpBIwVTHfGYWQS9jwHDVRnpKKHJg7" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function (){
            $('#select_branch').on('change', function (){
                var branch = this.value;
                console.log(branch);
                $('#table_list').html('');
                $('#table_title').html('');
                $.ajax({
                    url: "{{ url('admin/table/branch-table') }}",
                    type: "POST",
                    data: {
                        branch_id : branch,
                        _token : '{{ csrf_token() }}',
                    },
                    dataType : 'json',
                    success: function (result){
                        $('#table_list').html(result.view);
                    },
                });
            });
        });
    </script>
@endpush


