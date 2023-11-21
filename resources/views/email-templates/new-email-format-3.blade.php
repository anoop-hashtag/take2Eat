<!DOCTYPE html>
<?php
    $lang = \App\CentralLogics\Helpers::get_default_language();
    //$site_direction = \App\CentralLogics\Helpers::system_default_direction();
?>
{{--<html lang="{{ $lang }}" class="{{ $site_direction === 'rtl'?'active':'' }}">--}}
<html lang="{{ $lang }}" class="">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ translate('Email_Template') }}</title>

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,400;0,500;0,700;1,400&display=swap');

        body {
            margin: 0;
            font-family: 'Roboto', sans-serif;
            font-size: 13px;
            line-height: 21px;
            color: #737883;
            background-color: #e9ecef;
            padding: 0;
            display: flex;align-items: center;justify-content: center;
            min-height: 100vh;
        }
        h1,h2,h3,h4,h5,h6 {
            color: #334257;
            margin: 0;
        }
        * {
            box-sizing: border-box
        }

        :root {
            --base: #ffa726
        }

        .main-table {
            width: 500px;
            background: #FFFFFF;
            margin: 0 auto;
            padding: 40px;
        }
        .main-table-td {
        }
        img {
            max-width: 100%;
        }
        .cmn-btn{
            background: var(--base);
            color: #fff;
            padding: 8px 20px;
            display: inline-block;
            text-decoration: none;
        }
        .mb-1 {
            margin-bottom: 5px;
        }
        .mb-2 {
            margin-bottom: 10px;
        }
        .mb-3 {
            margin-bottom: 15px;
        }
        .mb-4 {
            margin-bottom: 20px;
        }
        .mb-5 {
            margin-bottom: 25px;
        }
        hr {
            border-color : rgba(0, 170, 109, 0.3);
            margin: 16px 0
        }
        .border-top {
            border-top: 1px solid rgba(0, 170, 109, 0.3);
            padding: 15px 0 10px;
            display: block;
        }
        .d-block {
            display: block;
        }
        .privacy {
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            justify-content: center;
        }
        .privacy a {
            text-decoration: none;
            color: #334257;
            position: relative;
            margin-left: auto;
            margin-right: auto;
        }
        .privacy a span {
            width: 6px;
            height: 6px;
            border-radius: 50%;
            background: #334257;
            display: inline-block;
            margin: 0 7px;
        }
        .social {
            margin: 15px 0 8px;
            display: block;
        }
        .copyright{
            text-align: center;
            display: block;
        }
        div {
            display: block;
        }
        .text-center {
            text-align: center;
        }
        .text-base {
            color: var(--base);
            font-weight: 700
        }
        .font-medium {
            font-weight: 500;
        }
        .font-bold {
            font-weight: 700;
        }
        a {
            text-decoration: none;
        }
        .bg-section {
            background: #E3F5F1;
        }
        .p-10 {
            padding: 10px;
        }
        .mt-0{
            margin-top: 0;
        }
        .w-100 {
            width: 100%;
        }
        .order-table {
            padding: 10px;
            background: #fff;
        }
        .order-table tr td {
            vertical-align: top
        }
        .order-table .subtitle {
            margin: 0;
            margin-bottom: 10px;
        }
        .text-left {
            text-align: left;
        }
        .text-right {
            text-align: right;
        }
        .bg-section-2 {
            background: #F8F9FB;
        }
        .p-1 {
            padding: 5px;
        }
        .p-2 {
            padding: 10px;
        }
        .px-3 {
            padding-inline: 15px
        }
        .mb-0 {
            margin-bottom: 0;
        }
        .m-0 {
            margin: 0;
        }
        .text-base {
            color: var(--base);
            font-weight: 700
        }
        .mail-img-1 {
            width: 140px;
            height: 60px;
            object-fit: contain
        }
        .mail-img-2 {
            width: 130px;
            height: 45px;
            object-fit: contain
        }
        .mail-img-3 {
            width: 100%;
            height: 172px;
            object-fit: cover
        }
        .social img {
        width: 24px;
        }
    </style>

</head>


<body style="background-color: #e9ecef;padding:15px">

{{--    <table dir="{{ $site_direction }}" class="main-table">--}}
    <table dir="" class="main-table">
        <tbody>
            <tr>
                <td class="main-table-td">
                    <h2 class="mb-3" id="mail-title">{{ $title?? translate('Main_Title_or_Subject_of_the_Mail') }}</h2>
                    <div class="mb-1" id="mail-body">{!! $body?? translate('Hi_Sabrina,') !!}</div>
                    <span class="d-block text-center mb-3">
                        @if ($data?->button_url)
                        <a href="{{ $data['button_url']??'#' }}" class="cmn-btn" id="mail-button">{{ $data['button_name']??'Submit' }}</a>
                        @endif                    </span>


                    <table class="bg-section p-10 w-100">
                        
                                                <td colspan="2">
    <table class="w-100">
        <thead class="bg-section-2">
           <!--  <tr>
                <th class="text-left p-1 px-3">{{ translate('Product') }}</th>
                <th class="text-right p-1 px-3">{{ translate('Price') }}</th>
            </tr> -->
        </thead>
        <tbody>
                        <tr>
                            <td class="p-10">
                                <span class="d-block text-center">
                                    @php($restaurant_logo = \App\Model\BusinessSetting::where(['key'=>'logo'])->first()->value)
                                    <img class="mb-2 mail-img-2" onerror="this.src='{{ asset('storage/app/public/restaurant/' . $restaurant_logo) }}'"
                                    src="{{ asset('storage/app/public/email_templatee/') }}/{{ $data['logo']??'' }}" id="logoViewer" alt="">
                                    <h3 class="mb-3 mt-0">{{ translate('Order_Info') }}</h3>
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <table class="order-table w-100">
                                    <tbody>
                                        <tr>
                                            <td>
                                                <div class="pl-2">
                                                    <h3 class="subtitle">{{ translate('Order_Summary') }}</h3>
                                                    <span class="d-block">{{ translate('Order') }}# {{ $order->id  }}</span>
                                                    <span class="d-block">{{ $order->created_at  }}</span>
                                                </div>

                                            </td>
                                            <td style="max-width:130px">
                                                <h3 class="subtitle">{{ translate('Delivery_Address') }}</h3>
                                                <span class="d-block">{{ $address['contact_person_name']  ?? $order->customer['f_name'] . ' ' . $order->customer['l_name'] }}</span>
                                                <span class="d-block" >{{ $address['contact_person_number'] ?? null }}</span>
                                            </td>
                                        </tr>
                                        <td colspan="2">
                                            <table class="w-100">
                                                <thead class="bg-section-2">
                                                    <tr>
                                                        <th class="text-left p-1 px-3">{{ translate('Product') }}</th>
                                                        <th class="text-right p-1 px-3">{{ translate('Price') }}</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    
                                                    <tr>
                                                        <td class="text-left p-2 px-3">
                                                            1. The school of life - emotional baggage tote bag - canvas tote bag (navy) x 1
                                                        </td>
                                                        <td class="text-right p-2 px-3">
                                                            <h4>
                                                            ₹5,465
                                                            </h4>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-left p-2 px-3">
                                                            2. 3USB Head Phone x 1
                                                        </td>
                                                        <td class="text-right p-2 px-3">
                                                            <h4>
                                                            ₹354
                                                            </h4>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="2">
                                                            <hr class="mt-0">
                                                            <table class="w-100">
                                                                <tr>
                                                                    <td style="width: 40%"></td>
                                                                    <td class="p-1 px-3">Item Price</td>
                                                                    <td class="text-right p-1 px-3">₹85</td>
                                                                </tr>
                                                                <tr>
                                                                    <td style="width: 40%"></td>
                                                                    <td class="p-1 px-3">Addon</td>
                                                                    <td class="text-right p-1 px-3">₹85</td>
                                                                </tr>
                                                                <tr>
                                                                    <td style="width: 40%"></td>
                                                                    <td class="p-1 px-3">Sub total</td>
                                                                    <td class="text-right p-1 px-3">₹90</td>
                                                                </tr>
                                                                <tr>
                                                                    <td style="width: 40%"></td>
                                                                    <td class="p-1 px-3">Discount</td>
                                                                    <td class="text-right p-1 px-3">₹10</td>
                                                                </tr>
                                                                <tr>
                                                                    <td style="width: 40%"></td>
                                                                    <td class="p-1 px-3">Coupon Discount</td>
                                                                    <td class="text-right p-1 px-3">₹00</td>
                                                                </tr>
                                                                <tr>
                                                                    <td style="width: 40%"></td>
                                                                    <td class="p-1 px-3">GST / Tax</td>
                                                                    <td class="text-right p-1 px-3">₹15</td>
                                                                </tr>
                                                                <tr>
                                                                    <td style="width: 40%"></td>
                                                                    <td class="p-1 px-3">Delivery Charge</td>
                                                                    <td class="text-right p-1 px-3">₹20</td>
                                                                </tr>
                                                                <tr>
                                                                    <td style="width: 40%"></td>
                                                                    <td class="p-1 px-3">
                                                                        <h4>Total</h4>
                                                                    </td>
                                                                    <td class="text-right p-1 px-3">
                                                                        <span class="text-base">₹105</span>
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </td>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                    </tbody>
    </table>
</td>

                    </table>


                    <hr>
                    <div class="mb-2" id="mail-footer">
                        {{ $footer_text ?? translate('Please_contact_us_for_any_queries,_we’re_always_happy_to_help.') }}
                    </div>
                    <div>
                        {{ translate('Thanks_&_Regards') }},
                    </div>
                    <div class="mb-4">
                        {{ $company_name }}
                    </div>
                </td>
            </tr>
            <tr>
                <td>
                    <span class="privacy">
                    @if(isset($data['privacy']) && $data['privacy'] == 1)
                            <a href="{{ route('privacy-policy') }}" id="privacy-check">{{ translate('Privacy_Policy')}}</a>
                        @endif
                        @if(isset($data['contact']) && $data['contact'] == 1)
                            <a href="{{ route('about-us') }}" id="contact-check">{{ translate('About_Us')}}</a>
                        @endif
                </span>
                   
                    <span class="copyright" id="mail-copyright">
                        {{ $copyright_text ?? translate('Copyright_2023_eFood._All_right_reserved') }}
                    </span>
                </td>
            </tr>
        </tbody>
    </table>


</body>
</html>
