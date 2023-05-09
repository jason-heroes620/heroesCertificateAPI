@component('mail::message')
<br>
<p>Hello,</p>
<br>
<div class="text-md py-4">
    <p>{{ $maildata['body'] }}</p>
</div>
<div>
    <p>
        As a token of appreciation for your continued support, we would like to offer you an exclusive discount code to use on your next purchase with us.
    </p>
    <p>
        At the checkout, simply enter the discount code provided below to enjoy RM 10 OFF <span class="sups">*</span>.
    </p>
</div>
<div class='content-center py-4'>
    <span class="text-xl">DISCOUNT CODE: </span> <span class="discount-code">HEROES10</span>
</div>
<div>
    <img src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('images/discount_voucher.png'))) }}" alt="discount-voucher" />
</div>
<br>
<div>
    <p> If you have any questions or need assistance, please don't hesitate to reach out to our customer support team at <a href="mailto:help@heroes.my" class="text-[#ff6b35]">help@heroes.my</a></p>
</div>
<div>
    <p class="content-center text-md">T&Cs apply.*</p>
</div>

<br>
<br>
<p class="text-lg">
    {{ config('app.name') }} Management
</p>
<br>
<ul class="tnc">
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
@endcomponent