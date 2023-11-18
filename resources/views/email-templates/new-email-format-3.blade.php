<!DOCTYPE html>
<html lang="{{ $lang }}" class="">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ isset($title) ? $title : 'Email_Template' }}</title>

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,400;0,500;0,700;1,400&display=swap');

        /* ... (existing styles) ... */
    </style>
</head>

<body style="background-color: #e9ecef; padding: 15px;">

    <table dir="" class="main-table">
        <tbody>
            <tr>
                <td class="main-table-td">
                    <h2 class="mb-3" id="mail-title">{{ isset($title) ? $title : 'Main_Title_or_Subject_of_the_Mail' }}</h2>
                    <div class="mb-1" id="mail-body">{!! isset($body) ? $body : 'Hi_Sabrina,' !!}</div>
                    <span class="d-block text-center mb-3">
                        @if (isset($data['button_url']))
                            <a href="{{ $data['button_url'] }}" class="cmn-btn" id="mail-button">{{ isset($data['button_name']) ? $data['button_name'] : 'Submit' }}</a>
                        @endif
                    </span>

                    <!-- ... (existing content) ... -->

                    <hr>
                    <div class="mb-2" id="mail-footer">
                        {{ isset($footer_text) ? $footer_text : 'Please_contact_us_for_any_queries,_we’re_always_happy_to_help.' }}
                    </div>
                    <div>
                        Thanks_&_Regards,
                    </div>
                    <div class="mb-4">
                        {{ isset($company_name) ? $company_name : '' }}
                    </div>
                </td>
            </tr>
            <!-- ... (existing content) ... -->
        </tbody>
    </table>

</body>
</html>
