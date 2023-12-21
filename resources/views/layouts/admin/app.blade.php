<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1"/>
    <meta name="csrf-token" content="{{csrf_token()}}">
    <!-- Title -->
    <title>@yield('title')</title>
    <!-- Favicon -->

    @php($icon = \App\Model\BusinessSetting::where(['key' => 'fav_icon'])->first()->value??'')
    <link rel="shortcut icon" href="">
    <link rel="icon" type="image/x-icon" href="{{ asset('storage/app/public/restaurant/' . $icon ?? '') }}">
    <!-- Font -->
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&amp;display=swap" rel="stylesheet">
    <!-- CSS Implementing Plugins -->
    <link rel="stylesheet" href="{{asset('public/assets/admin')}}/css/vendor.min.css">
    <link rel="stylesheet" href="{{asset('public/assets/admin')}}/vendor/icon-set/style.css">
    {{--Carousel Slider--}}
    <link rel="stylesheet" href="{{asset('public/assets/admin/css/owl.min.css')}}">
    <!-- CSS Front Template -->
    <link rel="stylesheet" href="{{asset('public/assets/admin')}}/css/theme.minc619.css?v=2.0">

    <link rel="stylesheet" href="{{asset('public/assets/admin')}}/css/style.css?v=1.0">  
  
    @stack('css_or_js')

    <script
        src="{{asset('public/assets/admin')}}/vendor/hs-navbar-vertical-aside/hs-navbar-vertical-aside-mini-cache.js"></script>
    <link rel="stylesheet" href="{{asset('public/assets/admin')}}/css/toastr.css">
</head>

<body class="footer-offset">
    <div class="direction-toggle">
        <i class="tio-settings"></i>
        <span></span>
    </div>

{{--loader--}}
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div id="loading" style="display: none;">
                <div style="position: fixed;z-index: 9999; left: 40%;top: 37% ;width: 100%">
                    <img width="200" src="{{asset('public/assets/admin/img/loader.gif')}}">
                </div>
            </div>
        </div>
    </div>
</div>
{{--loader--}}

<!-- Builder -->
@include('layouts.admin.partials._front-settings')
<!-- End Builder -->

<!-- JS Preview mode only -->
@include('layouts.admin.partials._header')
@include('layouts.admin.partials._sidebar')
<!-- END ONLY DEV -->

<main id="content" role="main" class="main pointer-event">
    <!-- Content -->
    @yield('content')
    <!-- End Content -->

    <!-- Footer -->
    @include('layouts.admin.partials._footer')
    <!-- End Footer -->

    <div class="modal fade" id="popup-modal">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12">
                            <center>
                                <h2 style="color: rgba(96,96,96,0.68)">
                                    <i class="tio-shopping-cart-outlined"></i> {{ translate('You have a new order, please check.') }}
                                </h2>
                                <hr>
                                <button onclick="check_order()" class="btn btn-primary">{{ translate('Ok, let me check') }}</button>
                            </center>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="toggle-status-modal">
        <div class="modal-dialog status-warning-modal">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">
                        <span aria-hidden="true" class="tio-clear"></span>
                    </button>
                </div>
                <div class="modal-body pb-5 pt-0">
                    <div class="max-349 mx-auto mb-20">
                        <div>
                            <div class="text-center">
                                <img id="toggle-status-image" alt="" class="mb-20">
                                <h5 class="modal-title" id="toggle-status-title"></h5>
                            </div>
                            <div class="text-center" id="toggle-status-message">
                            </div>
                        </div>
                        <div class="btn--container justify-content-center">
                            <button type="button" id="toggle-status-ok-button" class="btn btn-primary min-w-120" data-dismiss="modal" onclick="confirmStatusToggle()">{{translate('Ok')}}</button>
                            <button id="reset_btn" type="reset" class="btn btn-secondary min-w-120" data-dismiss="modal">
                                {{translate("Cancel")}}
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</main>
<!-- ========== END MAIN CONTENT ========== -->

<!-- ========== END SECONDARY CONTENTS ========== -->
<script src="{{asset('public/assets/admin')}}/js/custom.js"></script>
<!-- JS Implementing Plugins -->

@stack('script')

<!-- JS Front -->
<script src="{{asset('public/assets/admin')}}/js/vendor.min.js"></script>
<script src="{{asset('public/assets/admin')}}/js/theme.min.js"></script>
<script src="{{asset('public/assets/admin')}}/js/sweet_alert.js"></script>
<script src="{{asset('public/assets/admin')}}/js/toastr.js"></script>
    <script src="{{asset('public/assets/admin/js/owl.min.js')}}"></script>
{!! Toastr::message() !!}

@if ($errors->any())
    <script>
        @foreach($errors->all() as $error)
        toastr.error('{{$error}}', Error, {
            CloseButton: true,
            ProgressBar: true
        });
        @endforeach
    </script>
@endif

<script>
    $(document).on('ready', function() {
        $('#datatable').css('font-size', '13px');
        $('#datatable').css('padding-left', '10px');
    });
</script>


<!-- Toggle Direction Init -->
<script>
    $(document).on('ready', function(){

        $(".direction-toggle").on("click", function () {
            setDirection(localStorage.getItem("direction"));
        });

        function setDirection(direction) {
            if (direction == "rtl") {
                localStorage.setItem("direction", "ltr");
                $("html").attr('dir', 'ltr');
            $(".direction-toggle").find('span').text('Toggle RTL')
            } else {
                localStorage.setItem("direction", "rtl");
                $("html").attr('dir', 'rtl');
            $(".direction-toggle").find('span').text('Toggle LTR')
            }
        }

        if (localStorage.getItem("direction") == "rtl") {
            $("html").attr('dir', "rtl");
            $(".direction-toggle").find('span').text('Toggle LTR')
        } else {
            $("html").attr('dir', "ltr");
            $(".direction-toggle").find('span').text('Toggle RTL')
        }

    })
</script>
<!-- JS Plugins Init. -->
<script>
    // INITIALIZATION OF NAVBAR VERTICAL NAVIGATION
    // =======================================================
    var sidebar = $('.js-navbar-vertical-aside').hsSideNav();

    $(document).on('ready', function () {

        // BUILDER TOGGLE INVOKER
        // =======================================================
        $('.js-navbar-vertical-aside-toggle-invoker').click(function () {
            $('.js-navbar-vertical-aside-toggle-invoker i').tooltip('hide');
        });
        // INITIALIZATION OF UNFOLD
        // =======================================================
        $('.js-hs-unfold-invoker').each(function () {
            var unfold = new HSUnfold($(this)).init();
        });






        // INITIALIZATION OF TOOLTIP IN NAVBAR VERTICAL MENU
        // =======================================================
        $('.js-nav-tooltip-link').tooltip({boundary: 'window'})

        $(".js-nav-tooltip-link").on("show.bs.tooltip", function (e) {
            if (!$("body").hasClass("navbar-vertical-aside-mini-mode")) {
                return false;
            }
        });


    });
</script>


@stack('script_2')
<audio id="myAudio">
    <source src="{{asset('public/assets/admin/sound/notification.mp3')}}" type="audio/mpeg">
</audio>

<script>
    var audio = document.getElementById("myAudio");

    function playAudio() {
        audio.play();
    }

    function pauseAudio() {
        audio.pause();
    }

    //File Upload
    $(window).on('load', function() {
        $(".upload-file__input").on("change", function () {
        if (this.files && this.files[0]) {
            let reader = new FileReader();
            let img = $(this).siblings(".upload-file__img").find('img');

            reader.onload = function (e) {
            img.attr("src", e.target.result);
            console.log($(this).parent());
            };

            reader.readAsDataURL(this.files[0]);
        }
        });
    })
</script>
<script>
    @if(Helpers::module_permission_check('order_management'))
        setInterval(function () {
            $.get({
                url: '{{route('admin.get-restaurant-data')}}',
                dataType: 'json',
                success: function (response) {
                    let data = response.data;
                    if (data.new_order > 0) {
                        playAudio();
                        $('#popup-modal').appendTo("body").modal('show');
                    }
                },
            });
        }, 10000);
    @endif

    function check_order() {
        location.href = '{{route('admin.orders.list',['status'=>'all'])}}';
    }

    function route_alert(route, message) {
        Swal.fire({
            // title: '{{translate("Are you sure?")}}',
            text: message,
            type: 'warning',
            showCancelButton: true,
            cancelButtonColor: 'default',
            confirmButtonColor: '#FC6A57',
            cancelButtonText: '{{translate("No")}}',
            confirmButtonText:'{{translate("Yes")}}',
            reverseButtons: true
        }).then((result) => {
            if (result.value) {
                location.href = route;
            }
        })
    }

    function form_alert(id, message) {
        Swal.fire({
            // title: '{{translate("Are you sure?")}}',
            text: message,
            type: 'warning',
            showCancelButton: true,
            cancelButtonColor: 'default',
            confirmButtonColor: '#FC6A57',
            cancelButtonText: '{{translate("No")}}',
            confirmButtonText: '{{translate("Yes")}}',
            reverseButtons: true
        }).then((result) => {
            if (result.value) {
                $('#'+id).submit()
            }
        })
    }
</script>

<script>
    function call_demo(){
        toastr.info('Update option is disabled for demo!', {
            CloseButton: true,
            ProgressBar: true
        });
    }
</script>

{{-- Internet Status Check --}}
<script>
    @if(env('APP_MODE')=='live')
    // Internet Status Check
    window.addEventListener('online', function() {
        toastr.success("You're online");
    });
    window.addEventListener('offline', function() {
        toastr.error("You're offline");
    });

    // Internet Status Check (after any event)
    document.body.addEventListener("click", function(event) {
        if (window.navigator.onLine === false) {
            toastr.error("You are in offline");
            event.preventDefault();
        }
    }, false);
    @endif
</script>



<!-- IE Support -->
<script>
    if (/MSIE \d|Trident.*rv:/.test(navigator.userAgent)) document.write('<script src="{{asset('public/assets/admin')}}/vendor/babel-polyfill/polyfill.min.js"><\/script>');
</script>
<script>
    function status_change(t) {
        let url = $(t).data('url');
        let checked = $(t).prop("checked");
        let status = checked === true ? 1 : 0;

        Swal.fire({
            // title: 'Are you sure?',
            text: 'Want to change status',
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#FC6A57',
            cancelButtonColor: 'default',
            cancelButtonText: '{{translate("No")}}',
            confirmButtonText: '{{translate("Yes")}}',
            reverseButtons: true
        }).then((result) => {
                if (result.value) {
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                        }
                    });
                    $.ajax({
                        url: url,
                        data: {
                            status: status
                        },
                        success: function (data, status) {
                            toastr.success("{{translate('Status changed successfully')}}");
                        },
                        error: function (data) {
                            toastr.error("{{translate('Status changed failed')}}");
                        }
                    });
                }
                else if (result.dismiss) {
                    if (status == 1) {
                        $('#' + t.id).prop('checked', false)

                    } else if (status == 0) {
                        $('#'+ t.id).prop('checked', true)
                    }
                    toastr.info("{{translate("Status has not changed")}}");
                }
            }
        )
    }

</script>

<script>
    let initialImages = [];
    $(window).on('load', function() {
        $("form").find('img').each(function (index, value) {
            initialImages.push(value.src);
        })
    })

    $(document).ready(function() {
        $('form').on('reset', function(e) {
            $("form").find('img').each(function (index, value) {
                $(value).attr('src', initialImages[index]);
            })
            $('.js-select2-custom').val(null).trigger('change');

        });
    });
</script>

    <script>
        $(document).on('ready', function () {
            // INITIALIZATION OF SHOW PASSWORD
            // =======================================================
            $('.js-toggle-password').each(function () {
                new HSTogglePassword(this).init()
            });

            // INITIALIZATION OF FORM VALIDATION
            // =======================================================
            $('.js-validate').each(function () {
                $.HSCore.components.HSValidation.init($(this));
            });
        });
    </script>

<script>
    $('[data-toggle="tooltip"]').parent('label').addClass('label-has-tooltip')
</script>

    <script>
        $('.blinkings').on('mouseover', ()=> $('.blinkings').removeClass('active'))
        $('.blinkings').addClass('open-shadow')
        setTimeout(() => {
            $('.blinkings').removeClass('active')
        }, 10000);
        setTimeout(() => {
            $('.blinkings').removeClass('open-shadow')
        }, 5000);
    </script>
    <script>
        $(function(){
            var owl = $('.single-item-slider');
            owl.owlCarousel({
                autoplay: false,
                items:1,
                onInitialized  : counter,
                onTranslated : counter,
                autoHeight: true,
                dots: true,
            });

            function counter(event) {
                var element   = event.target;         // DOM element, in this example .owl-carousel
                var items     = event.item.count;     // Number of items
                var item      = event.item.index + 1;     // Position of the current item

                // it loop is true then reset counter from 1
                if(item > items) {
                    item = item - items
                }
                $('.slide-counter').html(+item+"/"+items)
            }
        });
    </script>

    <script>

        function toogleStatusModal(e, toggle_id, on_image, off_image, on_title, off_title, on_message, off_message) {
            // console.log($('#'+toggle_id).is(':checked'));
            e.preventDefault();
            if ($('#'+toggle_id).is(':checked')) {
                $('#toggle-status-title').empty().append(on_title);
                $('#toggle-status-message').empty().append(on_message);
                $('#toggle-status-image').attr('src', "{{asset('/public/assets/admin/img/modal')}}/"+on_image);
                $('#toggle-status-ok-button').attr('toggle-ok-button', toggle_id);
            } else {
                $('#toggle-status-title').empty().append(off_title);
                $('#toggle-status-message').empty().append(off_message);
                $('#toggle-status-image').attr('src', "{{asset('/public/assets/admin/img/modal')}}/"+off_image);
                $('#toggle-status-ok-button').attr('toggle-ok-button', toggle_id);
            }
            $('#toggle-status-modal').modal('show');
        }

        function confirmStatusToggle() {

            var toggle_id = $('#toggle-status-ok-button').attr('toggle-ok-button');
            if ($('#'+toggle_id).is(':checked')) {
                $('#'+toggle_id).prop('checked', false);
                $('#'+toggle_id).val(0);
            } else {
                $('#'+toggle_id).prop('checked', true);
                $('#'+toggle_id).val(1);
            }
            // console.log($('#'+toggle_id+'_form'));
            console.log(toggle_id);
            $('#'+toggle_id+'_form').submit();

        }

        function checkMailElement(id) {
            console.log(id);
            if ($('.'+id).is(':checked')) {
                $('#'+id).show();
            } else {
                $('#'+id).hide();
            }
        }

        function change_mail_route(value) {
            if(value == 'user'){
                var url= '{{url('/')}}/admin/business-settings/email-setup/'+value+'/new-order';
            }else if(value == 'dm'){
                var url= '{{url('/')}}/admin/business-settings/email-setup/'+value+'/registration';
            }
            location.href = url;
        }


        function checkedFunc() {
            $('.switch--custom-label .toggle-switch-input').each( function() {
                if(this.checked) {
                    $(this).closest('.switch--custom-label').addClass('checked')
                }else {
                    $(this).closest('.switch--custom-label').removeClass('checked')
                }
            })
        }
        checkedFunc()
        $('.switch--custom-label .toggle-switch-input').on('change', checkedFunc)

    </script>
    @php($date_format=\App\Model\BusinessSetting::where('key','date_format')->first()->value)
     <script>
              
        $(function () {

          
            $("#expire_date").datepicker({
                dateFormat: "dd-mm-yy", // Customize the date format
                changeMonth:true,
                changeYear:true, //
            });
           
            $("#start_date").datepicker({
                dateFormat: "dd-mm-yy", // Customize the date format
                changeMonth:true,
                changeYear:true, //
            });
            // Initialize the datepicker for the "from_date" input field
            $("#from_date").datepicker({
                dateFormat: "<?php echo $date_format ?>", // Customize the date format
                changeMonth:true,
                changeYear:true, //
            });
    
            // Initialize the datepicker for the "to_date" input field
            $("#to_date").datepicker({
                dateFormat: "<?php echo $date_format ?>", // Customize the date format
                changeMonth:true,
                changeYear:true,
            });
        });
        
    </script>
{{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> --}}

<!-- Include jQuery UI library -->
<!-- Include flatpickr CSS and JS from CDN -->

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/jquery-datetimepicker/build/jquery.datetimepicker.min.css">

<script src="https://cdn.jsdelivr.net/npm/jquery-datetimepicker/build/jquery.datetimepicker.full.min.js"></script>

<script>
    $(function () { 
        $('#datetimepicker1').datetimepicker({
            format: 'H:i', // Format for 24-hour time with seconds
            datepicker: false, // Disable the datepicker
            defaultTime: '10:30:00', // Default time for available_time_starts
            // You can set more options here
        });
        $('#datetimepicker2').datetimepicker({
            format: 'H:i', // Format for 24-hour time with seconds
            datepicker: false, // Disable the datepicker
            defaultTime: '10:30', // Default time for available_time_starts
            // You can set more options here
        });
    });
   
    
</script>



<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="https://www.jquery-az.com/jquery/js/intlTelInput/intlTelInput.js"></script>
<link rel="stylesheet" href="{{asset('public/assets/admin/css/demo.css')}}">
<link href="https://www.jquery-az.com/jquery/css/intlTelInput/intlTelInput.css" rel="stylesheet" />
<!-- Include jQuery UI CSS for styling -->
<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script type="text/javascript">
    $(document).ready(function() {
      var countryDropdown = $("#country-dropdown");
      var selectedCountryData = $("#selected-country-data");
      var hiddenInput = $("#hidden-country-code"); // Add this line to select the hidden input
  
      countryDropdown.intlTelInput({
        preferredCountries: [],
        // initialCountry: "in", // Default initial country (change as needed)
        separateDialCode: true,
        utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/11.0.9/js/utils.js",
      });

      // Set the initial country based on the value in the hidden input
      var initialCountryCode = hiddenInput.val();
      if (initialCountryCode) {
        countryDropdown.intlTelInput('setCountry', initialCountryCode);
      }

      // Manually trigger the 'countrychange' event to update the hidden input
      countryDropdown.trigger("countrychange");

      // Event listener for the change event
      countryDropdown.on("countrychange", function() {
        // Get selected country data
        var countryData = countryDropdown.intlTelInput('getSelectedCountryData');
        
        // Set the value of the hidden input field
        hiddenInput.val("+" + countryData.dialCode);
  
        // Display selected country data
        // selectedCountryData.text("Selected Country Data: " + JSON.stringify(countryData));
      });
    });
</script>



<script>
    // Function to validate the date input
    function validateDates() {
        var fromDate = new Date(document.getElementById("from_date").value);
        var toDate = new Date(document.getElementById("to_date").value);

        if (fromDate > toDate) {
            alert("End date cannot be less than the start date");
            return false; // Prevent form submission
        }
        return true; // Allow form submission
    }

    // Attach the validation function to the form submission
    document.querySelector("form").addEventListener("submit", validateDates);
    
</script>
<script>
    $('#from_date, #to_date').change(function () {
        let fr = $('#from_date').val();
        let to = $('#to_date').val();
        
        if (fr !== '' && to !== '') {
            // Parse dates in the format dd-mm-yy
            let fromDate = parseDate(fr);
            let toDate = parseDate(to);

            if (isNaN(fromDate) || isNaN(toDate) || fromDate >= toDate) {
                $('#from_date').val('');
                $('#to_date').val('');
                toastr.error('Invalid date range! Start date must be less than end date.', 'Error', {
                    closeButton: true,
                    progressBar: true
                });
            }
        }
    });

    $('#reset_btn').click(function () {
        $('#customer').val(null).trigger('change');
    });

    // Function to parse date in the format dd-mm-yy
    function parseDate(dateString) {
        let parts = dateString.split("-");
        return new Date(parts[2], parts[1] - 1, parts[0]);
    }
</script>
{{-- <script>
    $('#from_date, #to_date').change(function () {
        let from = $('#from_date').val();
        let to = $('#to_date').val();
        if(from != ''){
            $('#to_date').attr('required','required');
        }
        if(to != ''){
            $('#from_date').attr('required','required');
        }
        if (from != '' && to != '') {
            if (from > to) {
                $('#from_date').val('');
                $('#to_date').val('');
                toastr.error('{{\App\CentralLogics\translate('Invalid date range')}}!');
            }
        }

    })
</script> --}}
<script>
    // Function to disallow special characters
    function disallowSpecialCharacters(input) {
        // Remove special characters using a regular expression
        input.value = input.value.replace(/[^\d]/g, '');
    }

    // Get the input element
    var limitInput = document.getElementById('user-limit');
    limitInput.addEventListener('input', function () {
        disallowSpecialCharacters(this);
    });

    var min_purchase = document.getElementById('min_purchase');
    min_purchase.addEventListener('input', function () {
        disallowSpecialCharacters(this);
    });

    var discount_input = document.getElementById('discount_input');
    discount_input.addEventListener('input', function () {
        disallowSpecialCharacters(this);
    });

    var discount_input = document.getElementById('max_discount');
    discount_input.addEventListener('input', function () {
        disallowSpecialCharacters(this);
    });
</script>
</body>
</html>
