<?php

namespace App\Mail;

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

    protected $order_id;

    public function __construct($order_id)
    {
        $this->order_id = $order_id;
    }

    public function build()
    {
        $order_id = $this->order_id;
        $order = Order::findOrFail($order_id); // Use findOrFail to throw an exception if the order is not found
        $company_name = BusinessSetting::where('key', 'restaurant_name')->first()->value;

        // Retrieve the email template data
        $data = EmailTemplate::where('type', 'user')->where('email_type', 'new_order')->first();

        // If no template is found, you might want to handle this case

        $template = $data ? $data->email_template : 3;
        $local = $order->customer->language_code ?? 'en';

        // Get translation data
        $translations = $data ? $data->translations : [];

        $content = [
            'title' => $data->title,
            'body' => $data->body,
            'footer_text' => $data->footer_text,
            'copyright_text' => $data->copyright_text
        ];

        // Check if translations exist and match the user's locale
        if ($local != 'en' && !empty($translations)) {
            foreach ($translations as $translation) {
                if ($local == $translation->locale) {
                    $content[$translation->key] = $translation->value;
                }
            }
        }

        // Use the data directly in the text_variable_data_format method
        $title = Helpers::text_variable_data_format($content['title'], $order);
        $body = Helpers::text_variable_data_format($content['body'], $order);
        $footer_text = Helpers::text_variable_data_format($content['footer_text'], $order);
        $copyright_text = Helpers::text_variable_data_format($content['copyright_text'], $order);

        return $this->subject(translate('Order_Place_Mail'))
            ->view('email-templates.new-email-format-' . $template, [
                'company_name' => $company_name,
                'data' => $data,
                'title' => $title,
                'body' => $body,
                'footer_text' => $footer_text,
                'copyright_text' => $copyright_text,
                'order' => $order
            ]);
    }
}
