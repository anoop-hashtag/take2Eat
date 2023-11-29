<!DOCTYPE html>
<html>
  <head>
    <title>Page Title</title>
  </head>
  <body>
    <table class="main-table" style="width: 600px; background: #f4f4f4; margin: 0 auto; padding: 8px; font-family: Roboto, sans-serif;
 font-size: 11.5207px; line-height: 21px;  color: #737883;border: 1px solid #f4f4f4;">
      <tbody>
        <tr>
          <td class="main-table-td">
            <h2 class="mb-3" id="mail-title" style="color: #000;">HashTag Labs Order Placements</h2>
            <div class="mb-1" id="mail-body">
              <p>hello users,</p>
              <p>&nbsp;</p>
            </div>
            <span class="d-block text-center mb-3" style="text-align: center;display: block;">
              <a href="#" class="cmn-btn" id="mail-button" style="background: #ff7a00; color: #fff; padding: 8px 20px;  display: inline-block; text-decoration: none;">Order Now</a>
            </span>
            <table class="bg-section p-10 w-100" width="100%">
              <tbody>
                <tr>
                  <td style="height: 10px;"></td>
                </tr>
                <tr>
                  <td class="p-10" style="background-color: #e3f5f1;text-align: center; padding: 10px;">
                    <span class="d-block text-center"> @php($restaurant_logo = \App\Model\BusinessSetting::where(['key'=>'logo'])->first()->value) <img class="mb-2 mail-img-2" onerror="this.src='{{ asset('storage/app/public/restaurant/' . $restaurant_logo) }}'" src="{{ asset('storage/app/public/email_templatee/') }}/{{ $data['logo'] }}" id="logoViewer" alt=""> <?php echo $data['logo'];  ?> <h3 class="mb-3 mt-0" style="color: #000000;font-size: 18px;margin: 0 0 5px;">{{ translate('Order_Info') }}</h3>
                    </span>
                  </td>
                </tr>
                <tr>
                  <td>
                    <table class="order-table w-100" width="100%">
                      <tbody>
                        <tr>
                          <td>
                            <div class="pl-2">
                              <h3 class="subtitle" style="color: #000000;font-size: 18px;margin: 0 0 5px;">Order Summary</h3>
                              <span class="d-block">{{ translate('Order') }}# {{ $order->id  }}</span>
                              <span class="d-block">{{ $order->created_at  }}</span>
                            </div>
                          </td>
                          <td style="max-width:130px">
                            <h3 class="subtitle" style="color: #000000;font-size: 18px;margin: 0 0 5px;">Delivery Address</h3>
                            <span class="d-block">{{ $address['contact_person_name']  ?? $order->customer['f_name'] . ' ' . $order->customer['l_name'] }}</span>
                            <span class="d-block">{{ $address['contact_person_number'] ?? null }}</span>
                          </td>
                        </tr> @php($sub_total=0) @php($total_tax=0) @php($total_dis_on_pro=0) @php($add_ons_cost=0) @php($add_on_tax=0) @php($add_ons_tax_cost=0) <tr>
                          <td colspan="2">
                            <table class="order-table w-100" width="100%">
                              <thead class="bg-section-2" style="background-color: #cccccd;">
                                <tr>
                                  <th class="text-left p-1 px-3" style="text-align: left; padding-left: 5px; color: #000;">Product</th>
                                  <th class="text-right p-1 px-3" style="text-align: right;  padding-right: 5px; color: #000;">Price</th>
                                </tr>
                              </thead>
                                <tbody>
                                           <tr>
                                                @foreach($order->details as $detail)
                                                        @php($product_details = json_decode($detail['product_details'], true))
                                                       <td class="text-left p-2 px-3" width="65%">
                                                           {{$product_details['name']}}
                                                       </td>
                                                       <td class="text-right p-2 px-3" style="text-align: right;">
                                                           <h4 style="margin: 0;color: #000;font-size: 18px;"> {{\App\CentralLogics\Helpers::set_symbol($detail['price'])}}</h4>
                                                       </td>
                                                   </tr>  
                                            @php($sub_total=0)
                                            @php($total_tax=0)
                                            @php($total_dis_on_pro=0)
                                            @php($add_ons_cost=0)
                                            @php($add_on_tax=0)
                                            @php($add_ons_tax_cost=0)
                                            <td colspan="2">
                                               <table class="w-100">
                                                  <thead class="bg-section-2">
                                                     
                                                  </thead>
                                                  <tbody>
                                                     <tr>
                                                       
                                                        <td class="text-left p-2 px-3">
                                                           <!--  1. The school of life - emotional baggage tote bag - canvas tote bag (navy) x 1 -->
                                                           
                                                        </td>
                                                       
                                                        <td>
                                                           <div class="media gap-3 w-max-content">
                                                              
                                                              <div class="media-body text-dark fz-12">
                                                                 {{--                                                
                                                                 <h6 class="text-capitalize">{{$detail->product?->name}}</h6>
                                                                 --}}
                                                                 <!-- <h6 class="text-capitalize">{{$product_details['name']}}</h6> -->
                                                                 <div class="d-flex gap-2">
                                                                    @if (isset($detail['variation']))
                                                                    @foreach(json_decode($detail['variation'],true) as  $variation)
                                                                    @if (isset($variation['name'])  && isset($variation['values']))
                                                                    <span class="d-block text-capitalize">
                                                                    <strong>{{  $variation['name']}} -</strong>
                                                                    </span>
                                                                    @foreach ($variation['values'] as $value)
                                                                    <span class="d-block text-capitalize">
                                                                    {{ $value['label']}} :
                                                                    <!-- <strong>{{\App\CentralLogics\Helpers::set_symbol( $value['optionPrice'])}}</strong> -->
                                                                    </span>
                                                                    @endforeach
                                                                    @else
                                                                    @if (isset(json_decode($detail['variation'],true)[0]))
                                                                    <strong><u> {{  translate('Variation') }} : </u></strong>
                                                                    @foreach(json_decode($detail['variation'],true)[0] as $key1 =>$variation)
                                                                    <div class="font-size-sm text-body">
                                                                       <span>{{$key1}} :  </span>
                                                                       <span class="font-weight-bold">{{$variation}}</span>
                                                                    </div>
                                                                    @endforeach
                                                                    @endif
                                                                    @endif
                                                                    @endforeach
                                                                    @else
                                                                   <!--  <div class="font-size-sm text-body">
                                                                       <span class="text-dark">{{translate('price')}}  : {{\App\CentralLogics\Helpers::set_symbol($detail['price'])}}</span>
                                                                    </div> -->
                                                                    @endif
                                                                    <!-- <div class="d-flex gap-2">
                                                                       <span class="">{{translate('Qty')}} :  </span>
                                                                       <span>{{$detail['quantity']}}</span>
                                                                    </div> -->
                                                                    <br>
                                                                    @php($addon_ids = json_decode($detail['add_on_ids'],true))
                                                                    @if ($addon_ids)
                                                                    <span>
                                                                       <u><strong>{{translate('addons')}}</strong></u>
                                                                       @foreach($addon_ids as $key2 =>$id)
                                                                       @php($addon=\App\Model\AddOn::find($id))
                                                                       @php($add_on_qtys==null? $add_on_qty=1 : $add_on_qty=$add_on_qtys[$key2])
                                                                       <div class="font-size-sm text-body">
                                                                          <span>{{$addon ? $addon['name'] : translate('addon deleted')}} :  </span>
                                                                          <span class="font-weight-semibold">
                                                                         <!--  {{$add_on_qty}} x {{ \App\CentralLogics\Helpers::set_symbol($add_on_prices[$key2]) }} <br> -->
                                                                          </span>
                                                                       </div>
                                                                       @php($add_ons_cost+=$add_on_prices[$key2] * $add_on_qty)
                                                                       @php($add_ons_tax_cost +=  $add_on_taxes[$key2] * $add_on_qty)
                                                                       @endforeach
                                                                    </span>
                                                                    @endif
                                                                 </div>
                                                              </div>
                                                           </div>
                                                        </td>
                                                        <!-- <td>
                                                           @php($amount=$detail['price']*$detail['quantity'])
                                                           {{\App\CentralLogics\Helpers::set_symbol($amount)}}
                                                        </td>
                                                        <td>
                                                           @php($tot_discount = $detail['discount_on_product']*$detail['quantity'])
                                                           {{\App\CentralLogics\Helpers::set_symbol($tot_discount)}}
                                                        </td>
                                                        <td>
                                                           @php($product_tax = $detail['tax_amount']*$detail['quantity'])
                                                           {{\App\CentralLogics\Helpers::set_symbol($product_tax + $add_ons_tax_cost)}}
                                                        </td> -->
                                                        <td class="text-right">{{\App\CentralLogics\Helpers::set_symbol($amount-$tot_discount + $product_tax)}}</td>
                                                        @php($total_dis_on_pro += $tot_discount)
                                                        @php($sub_total += $amount)
                                                        @php($total_tax += $product_tax)
                                                        @endforeach
                                                     </tr>
                                                     <tr>
                                                       <td colspan="3"><hr class="mt-0"></td>
                                                     </tr>
                                                     <!-- <tr> -->
                                                           
                                                           <!-- <table class="order-table w-100" width="100%"> -->
                                                               <tr>
                                                                   <td style="width: 60%;"></td>
                                                                   <td style="width: 30%;"></td>
                                                                   <td style="width: 10%;"></td>
                                                               </tr>
                                                              <tr>
                                                                 <td></td>
                                                                 <td class="p-1 px-3">{{ translate('item_price') }}</td>
                                                                 <td class="text-right p-1 px-3">{{ \App\CentralLogics\Helpers::set_symbol($sub_total) }}</td>
                                                              </tr>
                                                              <tr>
                                                                 <td></td>
                                                                 <td class="p-1 px-3">{{translate('tax')}} / {{translate('vat')}}</td>
                                                                 <td class="text-right p-1 px-3">{{ \App\CentralLogics\Helpers::set_symbol($total_tax) }}</td>
                                                              </tr>
                                                              <tr>
                                                                 <td></td>
                                                                 <td class="p-1 px-3">{{ translate('discount') }}</td>
                                                                 <td class="text-right p-1 px-3">{{ \App\CentralLogics\Helpers::set_symbol($total_dis_on_pro) }}</td>
                                                              </tr>
                                                              <tr>
                                                                 <td></td>
                                                                 <td class="p-1 px-3">{{ translate('subtotal') }}</td>
                                                                 <td class="text-right p-1 px-3">{{ \App\CentralLogics\Helpers::set_symbol($sub_total =$sub_total+$total_tax+$add_ons_cost-$total_dis_on_pro + $add_ons_tax_cost) }}</td>
                                                              </tr>
                                                              <tr>
                                                                 <td></td>
                                                                 <td class="p-1 px-3">{{translate('coupon')}} {{translate('discount')}}</td>
                                                                 <td class="text-right p-1 px-3">{{ \App\CentralLogics\Helpers::set_symbol($order['coupon_discount_amount']) }}</td>
                                                              </tr>
                                                              <tr>
                                                                 <td></td>
                                                                 <td class="p-1 px-3"> {{translate('extra discount')}}</td>
                                                                 <td class="text-right p-1 px-3">{{ \App\CentralLogics\Helpers::set_symbol($order['extra_discount']) }}</td>
                                                              </tr>
                                                              <tr>
                                                                 <td></td>
                                                                 <td class="p-1 px-3"> {{translate('delivery fee')}}</td>
                                                                 @if($order['order_type']=='take_away')
                                                                 @php($del_c=0)
                                                                 @else
                                                                 @php($del_c=$order['delivery_charge'])
                                                                 @endif
                                                                 <td class="text-right p-1 px-3">{{ \App\CentralLogics\Helpers::set_symbol($del_c) }}</td>
                                                              </tr>
                                                              <tr>
                                                                 <td></td>
                                                                 <td class="p-1 px-3">
                                                                   <h4 style="font-size: 18px;margin: 5px 0;color: #000000;">Total</h4>
                                                                 </td>
                                                                 <td class="text-right p-1 px-3">
                                                                    <span class="text-base" style="font-size: 18px;color: #ff8a00;font-weight: 700;" >{{ \App\CentralLogics\Helpers::set_symbol($sub_total - $order['coupon_discount_amount'] - $order['extra_discount'] + $del_c) }}</span>
                                                                 </td>
                                                              </tr>
                                                          <!--  </table> -->
                                                     <!-- </tr> -->
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
                </tr>
              </tbody>
            </table>
            <hr>
            <div class="mb-2" id="mail-footer"> order Placement </div>
            <div> Thanks &amp; Regards, </div>
            <div class="mb-4"> Take2Eat </div>
          </td>
        </tr>
        <tr>
          <td>
            <span class="privacy" style="display: block;width: 100%;text-align: center;">
              <a href="#" id="privacy-check" style="color: #334257;text-decoration: none;padding: 0 5px;">Privacy Policy</a>
              <a href="#" id="refund-check" style="color: #334257;text-decoration: none;padding: 0 5px;">Refund Policy</a>
              <a href="#" id="cancelation-check" style="color: #334257;text-decoration: none;padding: 0 5px;">Cancelation Policy</a>
              <a href="#" id="contact-check" style="color: #334257;text-decoration: none;padding: 0 5px;">Contact us</a>
            </span>
          </td>
        </tr>
        <tr>
          <td style="text-align: center;">
            <span class="social" style="text-align:center">
              <a href="#" id="facebook-check" style="margin: 0 5px;text-decoration:none;">
                <img style="width:30px" src="https://food.progocrm.com/public/assets/admin/img/img/facebook.png" alt="">
              </a>
              <a href="#" id="instagram-check" style="margin: 0 5px;text-decoration:none;">
                <img style="width:30px" src="https://food.progocrm.com/public/assets/admin/img/img/instagram.png" alt="">
              </a>
              <a href="#" id="twitter-check" style="margin: 0 5px;text-decoration:none;">
                <img style="width:30px" src="https://food.progocrm.com/public/assets/admin/img/img/twitter.png" alt="">
              </a>
              <a href="#" id="linkedin-check" style="margin: 0 5px;text-decoration:none;">
                <img style="width:30px" src="https://food.progocrm.com/public/assets/admin/img/img/linkedin.png" alt="">
              </a>
              <a href="#" id="pinterest-check" style="margin: 0 5px;text-decoration:none;">
                <img style="width:30px" src="https://food.progocrm.com/public/assets/admin/img/img/pinterest.png" alt="">
              </a>
            </span>
          </td>
        </tr>
        <tr>
          <td style="text-align: center;">
            <span class="copyright" id="mail-copyright"> Copyright 2023 take2eat. All right reserved </span>
          </td>
        </tr>
      </tbody>
    </table>
  </body>
</html>