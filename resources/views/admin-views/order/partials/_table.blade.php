@foreach($orders as $key=>$order)

    <tr class="status-{{$order['order_status']}} class-all">
        <td class="">
            {{$key+1}}
        </td>
        <td class="">
            <a href="{{route('admin.orders.details',['id'=>$order['id']])}}">{{$order['id']}}</a>
        </td>
        <td>{{date('d M Y',strtotime($order['created_at']))}}</td>
        <td>
            @if($order->customer)
                <a class="text-body text-capitalize"
                   href="{{route('admin.customer.view',[$order['user_id']])}}">{{$order->customer['f_name'].' '.$order->customer['l_name']}}</a>
            @else
                <label class="badge badge-danger">{{translate('invalid')}} {{translate('customer')}} {{translate('data')}}</label>
            @endif
        </td>
        <td>
            <label class="badge badge-soft-primary">{{$order->branch?$order->branch->name:'Branch deleted!'}}</label>
        </td>
        <td>{{ \App\CentralLogics\Helpers::set_symbol($order['order_amount']) }}</td>
        <td class="text-capitalize">
            @if($order['order_status']=='pending')
                <span class="badge badge-soft-info ml-2 ml-sm-3">
                                      <span class="legend-indicator bg-info"></span>{{translate('pending')}}
                                    </span>
            @elseif($order['order_status']=='confirmed')
                <span class="badge badge-soft-info ml-2 ml-sm-3">
                                      <span class="legend-indicator bg-info"></span>{{translate('confirmed')}}
                                    </span>
            @elseif($order['order_status']=='processing')
                <span class="badge badge-soft-warning ml-2 ml-sm-3">
                                      <span class="legend-indicator bg-warning"></span>{{translate('processing')}}
                                    </span>
            @elseif($order['order_status']=='out_for_delivery')
                <span class="badge badge-soft-warning ml-2 ml-sm-3">
                                      <span class="legend-indicator bg-warning"></span>{{translate('out_for_delivery')}}
                                    </span>
            @elseif($order['order_status']=='delivered')
                <span class="badge badge-soft-success ml-2 ml-sm-3">
                                      <span class="legend-indicator bg-success"></span>{{translate('delivered')}}
                                    </span>
            @else
                <span class="badge badge-soft-danger ml-2 ml-sm-3">
                                      <span class="legend-indicator bg-danger"></span>{{str_replace('_',' ',$order['order_status'])}}
                                    </span>
            @endif
        </td>
        
        <td>
            <div class="d-flex justify-content gap-2">
                <a class="btn btn-outline-info btn-sm square-btn"
                   href="{{ route('admin.orders.details', ['id' => $order['id']]) }}">
                    <i class="tio-visible"></i>
                </a>
        
                <a class="btn btn-outline-info btn-sm square-btn" target="_blank"
                   href="{{ route('admin.orders.generate-invoice', [$order['id']]) }}">
                    <i class="tio-download"></i> 
                </a>
            </div>
        </td>
    </tr>

@endforeach

