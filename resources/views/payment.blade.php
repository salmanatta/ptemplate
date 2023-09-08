<script>
    var wpwlOptions = {
        style:"card",
        locale:{{$lang}},
        paymentTarget: "_top",
    }
    wpwlOptions.applePay = {
        merchantCapabilities:["supports3DS"],
        supportedNetworks: ["amex","masterCard","visa","mada"],
        displayName: "داول",
        currencyCode: 'SAR',
        checkAvailability: "canMakePayments",
        merchantIdentifier: "merchant.dawul.net.life",
        countryCode: "SA",
        total: { label: "داول, INC." },
    }
</script>
@if($card == 'APPLEPAY')
    <script src="https://oppwa.com/v1/paymentWidgets.js?checkoutId={{$checkout}}"></script>
    @else
    <script src="{{config('hyperpay.web_endpoint')}}v1/paymentWidgets.js?checkoutId={{$checkout}}"></script>
@endif
<style>
    body
    {
        margin-left:auto;margin-right:auto;width: 700px;height: auto;
    }
</style>
    <table style="margin-left:auto;margin-right:auto;width: 700px;padding: 5px;box-shadow: 0px 2px 2px lightgrey;border-radius: 10px;line-height: 50px">
        <thead></thead>
        @if($lang == 'ar')
        <tbody>
            <tr>
                <td style="border-bottom: 1px lightgrey dotted;">
                    <b style="font-size: 25px; font-family: Tajawal;color: #515151">
                        {{ date('Y-m-d') }}
                    </b>
                </td>
                <td style="border-bottom: 1px lightgrey dotted;text-align: right;">
                    <label style="font-size: 25px;font-family: Tajawal; color: #989898;">
                      التاريخ
                    </label>
                </td>
            </tr>
            <tr>
                <td style="border-bottom: 1px lightgrey dotted;">
                    <b style="font-size: 25px; font-family: Tajawal;color: #515151">
                        {{$card}}
                    </b>
                </td>
                <td style="border-bottom: 1px lightgrey dotted;text-align: right;">
                    <label style="font-size: 25px;font-family: Tajawal;color: #989898">
                       نوع الدفع
                    </label>
                </td>

            </tr>
            <tr>
                <td style="border-bottom: 1px lightgrey dotted;">
                    <b style="font-size: 25px; font-family: Tajawal;color: #515151">
                        {{$id}}
                    </b>
                </td>
                <td style="border-bottom: 1px lightgrey dotted;text-align: right;">
                    <label style="font-size: 25px;font-family: Tajawal;color: #989898">
                        رقم المعاملة
                    </label>
                </td>

            </tr>
            <tr>
                <td style="border-bottom: 1px lightgrey dotted;">
                    <b style="font-size: 25px; font-family: Tajawal;color: #515151">
                        {{$amount}}ريال
                    </b>
                </td>
                <td style="border-bottom: 1px lightgrey dotted;text-align: right;">
                    <label style="font-size: 25px;font-family: Tajawal;color: #989898">
                        مقدار الدفع
                    </label>
                </td>
            </tr>
        </tbody>
            @else
            <tbody>
            <tr>

                <td style="border-bottom: 1px lightgrey dotted;">
                    <label style="font-size: 25px;font-family: Tajawal; color: #989898">
                        Date
                    </label>
                </td>
                <td style="border-bottom: 1px lightgrey dotted;text-align: right;">
                    <b style="font-size: 25px; font-family: Tajawal;color: #515151">
                        {{ date('Y-m-d') }}
                    </b>
                </td>
            </tr>
            <tr>
                <td style="border-bottom: 1px lightgrey dotted;">
                    <label style="font-size: 25px;font-family: Tajawal;color: #989898">
                       Payment Type
                    </label>
                </td>
                <td style="border-bottom: 1px lightgrey dotted;text-align: right;">
                    <b style="font-size: 25px; font-family: Tajawal;color: #515151">
                        {{$card}}
                    </b>
                </td>
            </tr>
            <tr>
                <td style="border-bottom: 1px lightgrey dotted;">
                    <label style="font-size: 25px;font-family: Tajawal;color: #989898">
                        Transaction Number
                    </label>
                </td>
                <td style="border-bottom: 1px lightgrey dotted;text-align: right;">
                    <b style="font-size: 25px; font-family: Tajawal;color: #515151">
                        {{$id}}
                    </b>
                </td>
            </tr>
            <tr>
                <td style="border-bottom: 1px lightgrey dotted;">
                    <label style="font-size: 25px;font-family: Tajawal;color: #989898">
                        Amount
                    </label>
                </td>
                <td style="border-bottom: 1px lightgrey dotted;text-align: right;">
                    <b style="font-size: 25px; font-family: Tajawal;color: #515151">
                        {{$amount}} SAR
                    </b>
                </td>
            </tr>
            </tbody>
        @endif
    </table>
    <br>
<form
        action="{{ url('/finalize') }}"
        class="paymentWidgets"
        data-brands="{{$card}}"
></form>
