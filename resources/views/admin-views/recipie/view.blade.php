@extends('layouts.admin.app')

@section('title', translate('Recipe Details'))

@section('content')
<div class="content container-fluid">

    <!-- Page Header -->
    <div class="d-flex flex-wrap gap-2 align-items-center mb-4">
        <h2 class="h1 mb-0 d-flex align-items-center gap-2">
            <img width="20" class="avatar-img " src="{{asset('public/assets/admin/img/icons/attribute.png')}}" alt="">
            <span class="page-header-title">
                {{translate('Recipe Details')}}
            </span> 
        </h2>
    </div>

    <!-- End Page Header -->
    <div class="card mb-3 mb-lg-5">
        <div class="card-body bottom-new-line">
            <div class="row">
                <div class="col-lg-6">
                    <div class="vendor-data">
                        <span class="vendor-title">{{ translate('recipe_name') }} : </span>
                        <span>{{ json_decode($recipie[0]->product_details)->name }}</span>
                    </div>
                </div>       
                <div class="col-lg-6">
                    <div class="vendor-data">
                        <span class="vendor-title">{{ translate('variation') }} : </span>
                        <span>{{ $recipie[0]->variation }}</span>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="px-card">
            <div class="py-4 table-responsive">
                <table class="table-style table table-hover table-borderless table-thead-bordered table-nowrap table-align-middle card-table">
                    <thead class="thead-light">
                        <tr>
                            <th>{{ translate('SL') }}</th>
                            <th>{{ translate('ingredient') }}</th>
                            <th>{{ translate('quanity') }}</th>
                        </tr>
                    </thead>  
                    <tbody>
                        @foreach ($recipie[0]->recipieIngredients as $ingredients)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ json_decode($ingredients->ingredient_details)->name }}</td>
                                <td>{{ $ingredients->quantity }} {{ $ingredients->quantity_type }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    
</div>
@endsection