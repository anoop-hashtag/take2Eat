<?php

namespace App\Mail;
use Illuminate\Support\Facades\DB;
use App\CentralLogics\Helpers;
use App\Model\BusinessSetting;
use App\Models\EmailTemplate;
use App\Model\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OrderPlaced extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    protected $order_id;

    public function __construct($order_id)
    {
        $this->order_id = $order_id;
        
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $order_id = $this->order_id;
       
        $order=Order::where('id', $order_id)->first();
        // echo '<pre>'; print_r($order); die();
        $company_name = BusinessSetting::where('key', 'restaurant_name')->first()->value;
        //  print_r($company_name); die();
         $data=EmailTemplate::with('translations')->where('type','user')->where('email_type', 'new_order')->first();
         $socialMediaData = DB::table('social_medias')->get();
        //  $data= EmailTemplate::with('translations')->where('type','user')->where('email_type', 'forget_password')->first();
        // print_r($data); die();
        $template=$data?$data->email_template:3;
        
        //   print_r($data); die();
        $user_name = $order->customer->f_name.' '.$order->customer->l_name;
        // print_r($user_name); die();
        $restaurant_name = $order->branch->name;
       
        $delivery_man_name = ($order->delivery_man) ? $order->delivery_man->f_name.' '.$order->delivery_man->l_name : "test";
       
        

       
        
        $local = $order->customer->language_code ?? 'en';
      

        $content = [
            'title' => $data->title,
            'body' => $data->body,
            'footer_text' => $data->footer_text,
            'copyright_text' => $data->copyright_text
        ];

        if ($local != 'en'){
            if (isset($data->translations)){
                foreach ($data->translations as $translation){
                    if ($local == $translation->locale){
                        $content[$translation->key] = $translation->value;
                    }
                }
            }
        }
        $url = '';
        $title = Helpers::text_variable_data_format( value:$data['title']??'',user_name:$user_name??'',restaurant_name:$restaurant_name??'',delivery_man_name:$delivery_man_name??'',order_id:$order_id??'');
        // print_r($title); die();
        
        $body = Helpers::text_variable_data_format( value:$data['body']??'',user_name:$user_name??'',restaurant_name:$restaurant_name??'',delivery_man_name:$delivery_man_name??'',order_id:$order_id??'');
       
        $footer_text = Helpers::text_variable_data_format( value:$data['footer_text']??'',user_name:$user_name??'',restaurant_name:$restaurant_name??'',delivery_man_name:$delivery_man_name??'',order_id:$order_id??'');
       
        $copyright_text = Helpers::text_variable_data_format( value:$data['copyright_text']??'',user_name:$user_name??'',restaurant_name:$restaurant_name??'',delivery_man_name:$delivery_man_name??'',order_id:$order_id??'');
        
        // $template_data = $this->subject(translate('Customer_Password_Reset_mail'))->view('email-templates.new-email-format-'.$template, ['company_name'=>$company_name,'data'=>$data,'title'=>$title,'body'=>$body,'footer_text'=>$footer_text,'copyright_text'=>$copyright_text,'url'=>"test.php", 'code'=>'678']);

        
        $this->subject(translate('Order_Place_Mail'))
        ->view('email-templates.new-email-format-' . $template, [
        'company_name' => $company_name,
        'data' => $data,
        'socialMediaData' => $socialMediaData,
        'title' => $title,
        'body' => $body,
        'footer_text' => $footer_text,
        'copyright_text' => $copyright_text,
        'order' => $order
        ]);
       
    }
}
