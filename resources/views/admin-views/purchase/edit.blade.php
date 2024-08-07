@extends('layouts.admin.app')

@section('title', translate('Edit Purchase'))


@section('content')
<div class="content container-fluid">
    <!-- Page Header -->
    <div class="d-flex flex-wrap gap-2 align-items-center mb-4">
        <h2 class="h1 mb-0 d-flex align-items-center gap-2">
            <img width="20" class="avatar-img" src="{{asset('public/assets/admin/img/inventory/purchase.png')}}" alt="">
            <span class="page-header-title">
                {{translate('Edit_Purchase')}} 
            </span>
        </h2>
    </div>
    <!-- End Page Header -->
    <div class="card">
        <form action="{{ route('admin.purchase.update', [$purchase[0]->id]) }}" method="post">
            @csrf
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="input-label">{{translate('vendor')}}<span class="text-danger">*</span></label>
                                <select name="vendor_id" class="custom-select">
                                    <option disabled>{{ translate('select_vendor') }}</option>
                                    @foreach ($vendors as $vendor)
                                        <option value="{{ $vendor->id }}" {{ $vendor->id == $purchase[0]->vendor_id ? "selected" : "" }}>{{ $vendor->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="input-label">{{translate('Purchase_Date')}}<span class="text-danger">*</span></label>
                                <input type="date" name="purchase_date" class="form-control" value="{{ $purchase[0]->purchase_date }}" required>
                            </div>
                            <div class="form-group">
                                <label class="input-label">{{translate('Note')}}</label>
                                <textarea name="note" class="form-control" placeholder="{{translate('Ex: ABC')}}" style="resize: none;">{{ $purchase[0]->note }}</textarea>
                            </div>
                        </div>       
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="input-label">{{translate('invoice')}} <span class="text-danger">*</span></label>
                                <input type="text" name="invoice" class="form-control" placeholder="{{translate('invoice')}}" value="{{ $purchase[0]->invoice }}" required>
                            </div>
                            <div class="form-group">
                                <label class="input-label">{{translate('payment_type')}} <span class="text-danger">*</span></label>
                                <select name="payment_type" class="custom-select" >
                                    <option selected disabled>{{ translate('select_payment_type') }}</option>
                                    <option value="cash" {{ $purchase[0]->payment_type == 'cash' ? "selected" : "" }}>{{translate('cash')}}</option>
                                    <option value="cheque" {{ $purchase[0]->payment_type == 'cheque' ? "selected" : "" }}>{{translate('cheque')}}</option>
                                    <option value="online" {{ $purchase[0]->payment_type == 'online' ? "selected" : "" }}>{{translate('online')}}</option>
                                    <option value="hold" {{ $purchase[0]->payment_type == 'hold' ? "selected" : "" }}>{{translate('hold')}}</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        
            <!-- Table -->
            <div class="set_table banner-tbl mt-4">
                <div class="table-responsive datatable_wrapper_row " >
                    <table id="datatable" class="table table-borderless table-thead-bordered table-nowrap table-align-middle card-table" >
                        <thead class="thead-light">
                            <tr>
                                <th class="width-inventory-secondary" style="width: 35%;">{{translate('item')}}</th>
                                <th class="width-inventory-primary" style="width: 15%;">{{translate('quantity')}}</th>
                                <th class="width-inventory-primary" style="width: 15%;">{{translate('quantity_type')}}</th>
                                <th class="width-inventory-primary" style="width: 15%;">{{translate('rate')}}</th>
                                <th class="width-inventory-primary" style="width: 15%;">{{translate('total')}}</th>
                                <th>
                                    <button  type="button" onclick="addPurchaseTbl({{count($purchase[0]->purchaseIngredientList)}});" class="btn btn-primary btn-sm delete square-btn"
                                    ><i class="tio-add"></i></button>
                                </th>
                            </tr>
                        </thead>
                        <tbody id="purchase-table">
                            @foreach ($purchase[0]->purchaseIngredientList as $purchaseIngredientList)
                                <tr id="addPurchase_row">
                                    <td>
                                        <select name="items[]" class="custom-select items">
                                            <option selected disabled>{{translate('select_item')}}</option>
                                            @foreach ($ingredients as $ingredient)
                                            <option value="{{ $ingredient->id }}" {{ $ingredient->id == json_decode($purchaseIngredientList->ingredient_details)->id ? "selected" : ""}}>{{ $ingredient->name }}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td>
                                        <input type="number" name="quantitys[]" step="0.1" min="0.1" class="form-control quantity" value="{{ $purchaseIngredientList->quantity }}" required>
                                    </td>
                                    <td>
                                        <input type="text" class="form-control quantity_type" value="{{ json_decode($purchaseIngredientList->ingredient_details)->quantity_type }}" readonly>
                                    </td>
                                    <td>
                                        <input type="number" name="rates[]" step="0.1" min="0.1" class="form-control rate" value="{{ $purchaseIngredientList->rate }}" required>
                                    </td>
                                    <td>
                                        <input type="text" class="form-control total" value="{{ $purchaseIngredientList->quantity * $purchaseIngredientList->rate }}" required readonly>
                                    </td>
                                    <td>
                                        <div class="d-flex gap-2">
                                            <button type="button" class="btn btn-outline-danger btn-sm delete square-btn" onclick="$('#addPurchase_row').remove();"><i class="tio-delete"></i></button>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
                    
            <!-- End Card -->
            <div class="d-flex justify-content-end gap-3 m-4">
                {{-- <button type="reset" id="reset" class="btn btn-secondary">{{translate('Reset')}}</button> --}}
                <button type="submit" class="btn btn-primary">{{translate('update')}}</button>
            </div>
        </form>
    </div>
</div>

@endsection

@push('script_2')
    <script>
        $(document).ready(function() {
            function updateTotal($row) {
                var quantity = $row.find('.quantity').val();
                var rate = $row.find('.rate').val();
                var total = quantity * rate;
                $row.find('.total').val(total);
            }

            $(document).on('input', '.quantity, .rate', function() {
                var $row = $(this).closest('tr');
                updateTotal($row);
            });
        });

        function addPurchaseTbl(addPurchase_row) {
            html = '<tr id="faqs-row' + addPurchase_row + '">';
            html += '<td>' + 
                        '<select name="items[]" class="custom-select items">' +
                                '<option selected disabled>Select item</option>' +
                                '@foreach ($ingredients as $ingredient)' +
                                    '<option value="{{ $ingredient->id }}">{{ $ingredient->name }}</option>' +
                                '@endforeach' +
                            '</select>' +
                    '</td>';
            html += '<td><input type="number" name="quantitys[]" step="0.1" min="0.1" class="form-control quantity" required></td>';
            html += '<td><input type="text" class="form-control quantity_type" required readonly></td>';
            html += '<td><input type="number" name="rates[]" step="0.1" min="0.1" class="form-control rate" required></td>';
            html += '<td><input type="text" class="form-control total" required readonly></td>';
            html += '<td>' +
                        '<div class="d-flex gap-2">' +
                            '<button type="button" class="btn btn-outline-danger btn-sm delete square-btn" onclick="$(\'#faqs-row' + addPurchase_row + '\').remove();"><i class="tio-delete"></i></button>' +
                        '</div>' +
                    '</td>';
            html += '</tr>';

            $('#datatable tbody').append(html);

            addPurchase_row++;
        }

        $(document).on('change', '.items', function() {
            var $row = $(this).closest('tr');
            var item_id = $(this).val();
            var url = '{{ route("admin.ingredient.quantity_type", ":id") }}';
            url = url.replace(':id', item_id);

            $.ajax({
                url: url,
                method: 'GET',
                cache: false,
                contentType: false,
                processData: false,
                success: function (response) {
                    if(response.status == 'success') {
                        $row.find('.quantity_type').val(response.data);
                    }
                }
            });
        });

    </script>
@endpush