@extends('layouts.admin.app')

@section('title', translate('Add_Return_Purchase'))

@section('content')
<div class="content container-fluid">
    <!-- Page Header -->
    <div class="d-flex flex-wrap gap-2 align-items-center mb-4">
        <h2 class="h1 mb-0 d-flex align-items-center gap-2">
            <img width="20" class="avatar-img" src="{{asset('public/assets/admin/img/inventory/return.png')}}" alt="">
            <span class="page-header-title">
                {{translate('Add_Return_Purchase')}} 
            </span>
        </h2>
    </div>
    <!-- End Page Header -->

    <div class="row g-2">
        <div class="col-sm-12 col-lg-12 mb-3 mb-lg-2">
            <div class="card">
                <form action="{{ route('admin.return-purchase.edit') }}" method="post">
                    @csrf
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-5 col-sm-5">
                                    <div class="form-group">
                                        <label class="input-label">{{translate('vendor')}}<span class="text-danger">*</span></label>
                                        <select name="vendor_id" id="vendor_id" class="custom-select" >
                                            <option selected disabled>{{ translate('select_vendor') }}</option>
                                            @foreach ($vendors as $vendor)
                                                @if (isset($vendor_id))
                                                    @if ($vendor_id == $vendor->id)
                                                        <option value="{{ $vendor->id }}" selected>{{ $vendor->name }}</option>
                                                    @endif
                                                @else
                                                    <option value="{{ $vendor->id }}">{{ $vendor->name }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-5 col-sm-5">
                                    <div class="form-group">
                                        <label class="input-label">{{translate('Invoice')}}<span class="text-danger">*</span></label>
                                        <select class="form-control" name="invoice" id="invoice">
                                            @if (isset($invoice))
                                                <option value="{{$invoice}}" selected>{{$invoice}}</option>
                                            @endif
                                        </select>
                                        {{-- <input type="number" name="invoice" class="form-control" placeholder="{{ translate('Ex: ABC123') }}" value="{{ isset($invoice) ? $invoice : '' }}" required> --}}
                                    </div>
                                </div>
                                <div class="col-lg-2 col-sm-2">
                                    <div class="form-group mt-5">
                                        <button type="submit" class="btn btn-primary">{{translate('Search')}}</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                <!-- Table -->
                <div class="set_table banner-tbl mt-4" >
                    <div class="table-responsive datatable_wrapper_row">
                        <table id="datatable"  class="table table-borderless table-thead-bordered table-nowrap table-align-middle card-table">
                            <thead class="thead-light">
                            <tr>
                                <th><input type="checkbox" name="text" required></th>
                                <th style="width: 35%;">{{translate('Item')}}</th>
                                <th style="width: 15%;">{{translate('quantity')}}</th>
                                <th style="width: 15%;">{{translate('quantity_type')}}</th>
                                <th style="width: 15%;">{{translate('rate')}}</th>
                                <th style="width: 15%;">{{translate('total')}}</th>
                            </tr>
                            </thead>
                            @if (isset($purchaseIngredients))
                                <form action="{{ route('admin.return-purchase.store') }}" method="post">
                                    <tbody>
                                        @csrf
                                        <input type="hidden" name="purchase_id" value="{{ $purchaseIngredients[0]->id }}" />

                                        @foreach ($purchaseIngredients as $key => $purchaseIngredient)
                                            <tr>
                                                <td>
                                                    <input type="checkbox" name="return_ingredients[{{$key}}]" class="form-control" value="{{ $purchaseIngredient->purchases_ingredient_items_id }}">
                                                </td>
                                                <td>
                                                    <select name="items[{{$key}}]" class="custom-select items">
                                                        <option selected disabled>{{translate('select_item')}}</option>
                                                        @foreach ($ingredients as $ingredient)
                                                            <option value="{{ $ingredient->id }}"
                                                                {{ $ingredient->id == json_decode($purchaseIngredient->ingredient_details)->id ? 'selected' : '' }}
                                                            >{{ $ingredient->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                                <td>
                                                    <input type="number" name="quantitys[{{$key}}]" class="form-control quantity" value="{{ $purchaseIngredient->quantity }}" required>
                                                    <input type="hidden" class="main_quantity" value="{{ $purchaseIngredient->quantity }}" />
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control quantity_type" value="{{ json_decode($purchaseIngredient->ingredient_details)->quantity_type }}" readonly>
                                                </td>
                                                <td>
                                                    <input type="number" class="form-control rate" value="{{ $purchaseIngredient->rate }}" readonly>
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control total" value="{{ $purchaseIngredient->rate * $purchaseIngredient->quantity }}" readonly>
                                                </td>
                                            </tr>
                                        @endforeach

                                    </tbody>
                                </table>
                                <div class="d-flex justify-content-end gap-3 m-4">
                                    <button type="reset" id="reset" class="btn btn-secondary">{{translate('reset')}}</button>
                                    <button type="submit" class="btn btn-primary">{{translate('return')}}</button>
                                </div>
                            </form>
                            @else
                                <tbody>
                                    <tr>
                                        <td>
                                            <input type="checkbox" name="text" class="form-control">
                                        </td>
                                        <td>
                                            <select name="items[]" class="custom-select items">
                                                <option selected disabled>{{translate('select_item')}}</option>
                                                {{-- @foreach ($ingredients as $ingredient)
                                                    <option value="{{ $ingredient->id }}">{{ $ingredient->name }}</option>
                                                @endforeach --}}
                                            </select>
                                        </td>
                                        <td>
                                            <input type="number" name="quantitys[]" class="form-control quantity" required>
                                        </td>
                                        <td>
                                            <input type="text" class="form-control quantity_type" readonly>
                                        </td>
                                        <td>
                                            <input type="number" name="rates[]" class="form-control rate" required>
                                        </td>
                                        <td>
                                            <input type="text" class="form-control total" required readonly>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        @endif
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
        $('#vendor_id').on('change', function() {
            let vendor_id = $(this).val();
            var url = '{{ route("admin.vendor.list", ":id") }}';
            url = url.replace(':id', vendor_id);

            $("#invoice").empty();

            $.ajax({
                url: url,
                method: 'GET',
                cache: false,
                contentType: false,
                processData: false,
                success: function (response) {
                    response = JSON.parse(response);
                    console.log(response);
                    if(response.status == 200) {
                        $('#invoice').append('<option selected disable>Select invoice</option>');
                        response.data.forEach(function(value) {
                            $('#invoice').append('<option value="'+ value +'">'+ value +'</option>');
                        });
                    } else {
                        alert(response.message);
                    }
                }
            });
        });
    </script>
@endpush