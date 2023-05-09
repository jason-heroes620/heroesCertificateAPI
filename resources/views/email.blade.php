<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <title>Heroes</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/js/app.js')
</head>

<body>
    <div class="flex w-full justify-center">
        <div class="flex flex-col px-10 w-[80%] place-content-center bg-cyan-100">
            <div class="flex justify-center content-center py-4">
                <img src="{{ Vite::asset('resources/images/heroes_logo.png')}}" alt="" width="200px">
            </div>

            <div class="flex content-start pb-8">
                <p>Hello {{ $name }},</p>
            </div>
            <div class="flex content-start">
                <p>{{ $body }}</p>
            </div>


            <div class="flex flex-col content-start py-4">
                <p>
                    As a token of appreciation for your continued support, we would like to offer you an exclusive discount code to use on your next purchase with us.
                </p>
                <p class="pt-4">
                    At the checkout, simply enter the discount code provided below to enjoy RM 10 off <span class="sups">*</span>.
                </p>
            </div>
            <div class="flex justify-center content-center text-2xl text-[#ff6b35] font-bold py-4">
                Discount Code: {{ $voucher_code }}
            </div>

            <div class="flex justify-center content-center py-4">
                <div class="w-[80%]">
                    <img src=" {{ Vite::asset('resources/images/discount_voucher.png')}}" alt="voucher">
                </div>
            </div>

            <div class="py-4">
                <p> If you have any questions or need assistance, please don't hesitate to reach out to our customer support team at <a href="mailto:help@heroes.my" class="text-[#ff6b35]">help@heroes.my</a></p>
            </div>
            <div class="flex justify-center content-center text-sm py-4">
                <p>T&Cs apply.*</p>
            </div>
            <div class="py-4">
                Thank you
            </div>
            <div>
                Heroes Management
            </div>

            <br>


            <ul class="list-disc pt-8 text-xs">
                <b>TERMS & CONDITIONS</b>
                <li>
                    This voucher can be used only in the purchase of trial classes.
                </li>
                <li>
                    Only 1 voucher may be used for 1 purchase.
                </li>
                <li>
                    Voucher canot be exchanged for cash.
                </li>
                <li>
                    This offer cannot be used in conjunction with other promotions.
                </li>
                <li>
                    The management reserves the right to amend the Terms & Conditions without prior notice.
                </li>
            </ul>
        </div>
    </div>
</body>

</html>