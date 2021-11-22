@extends('mailstester.layout')

@section('content')
<div id="content_container" style="width:100%">
    <div class="row-fluid contentsize">

        <div id="system-message-container"></div>

        <div
            id="mailtester_cart_checkout_page"
            class="mailtester_cart_checkout_page mailtester_cart_checkout_page_step0">
            <div class="mailtester_cart_wizardbar">
                <ul>
                    <li class="mailtester_cart_cart_step_current">
                        <span class="badge badge-info">1</span>
                        Address
                        <span class="mailtester_cart_chevron"></span>
                    </li>

                    <li class="">
                        <span class="badge badge-">2</span>
                        <a
                            href="{{ route('checkout', 'step2') }}">
                            Payment
                        </a>
                        <span class="mailtester_cart_chevron"></span>
                    </li>

                    <li class="">
                        <span class="badge badge-">3</span>
                        <a
                            href="{{ route('checkout', 'step3') }}">
                            Cart
                        </a>
                        <span class="mailtester_cart_chevron"></span>
                    </li>

                    <li class="">
                        <span class="badge badge-">4</span>
                        <a
                            href="{{ route('checkout', 'step4') }}">
                            End
                        </a>
                        <span class="mailtester_cart_chevron"></span>
                    </li>

                </ul>
            </div>
            <form
                action="{{ route('checkout', 'step2') }}"
                method="post"
                name="mailtester_cart_checkout_form"
                enctype="multipart/form-data"
                onsubmit="if('function' == typeof(mailtester_cartSubmitForm)) { mailtester_cartSubmitForm('mailtester_cart_checkout_form'); return false; } else { return true; }">
                <div
                    id="mailtester_cart_checkout_address_billing_only"
                    class="mailtester_cart_checkout_address_billing_only row-fluid">
                    <div
                        id="mailtester_cart_checkout_billing_address"
                        class="mailtester_cart_checkout_billing_address span6">
                        <fieldset class="mailtester_cart_address_listing_div hika_address_field" id="mailtester_cart_checkout_billing_address">
                            <legend>Billing address</legend>
                            @csrf
                            @if( !empty($userdata['user_profile']) )
                            <table class="table">
                                <tbody>
                                    <tr class="row0">
                                        <td>
                                            <input
                                                id="mailtester_cart_checkout_billing_address_radio_44126"
                                                type="hidden"
                                                name="mailtester_cart_address_billing"
                                                value="44126"/>
                                            <span class="mailtester_cart_checkout_billing_address_info">
                                                {{ $userdata['user_profile']->firstname }} {{ $userdata['user_profile']->lastname }}<br/>
                                                {{ $userdata['user_profile']->company }}<br/>
                                                {{ $userdata['user_profile']->address }} {{ $userdata['user_profile']->city }} {{ $userdata['user_profile']->vatnum }}<br/>
                                                {{ $userdata['user_profile']->postcode }}  {{ $userdata['user_profile']->state }} {{ $userdata['user_profile']->country }} <br/>
                                            </span>
                                        </td>
                                        <td>
                                            <span class="mailtester_cart_checkout_billing_address_buttons">
                                                <a
                                                    id="mailtester_cart_checkout_billing_address_edit_44126"
                                                    title="Edit"
                                                    style='cursor:pointer'
                                                    class="mailtester_cart_checkout_billing_address_edit"
                                                    rel="{handler: 'iframe', size: {x: 450, y: 480}}"
                                                    onclick="return showModal('{{$userdata['user_profile']->id}}');">
                                                    <img alt="Edit" src="{{asset('assets/images/icons/edit.png')}}" border="0"/></a>
                                            </span>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            @endif
                            <span
                                id="mailtester_cart_checkout_billing_address_new"
                                class="mailtester_cart_checkout_billing_address_new">
                                <a
                                    id="mailtester_cart_checkout_billing_address_new_link"
                                    class="btn button mailtester_checkout_input_button"
                                    onclick="return showModal('0');">
                                    New
                                </a>
                            </span>
                        </fieldset>
                    </div>
                </div>
                <div style="clear:both"></div>
                <!-- <input type="hidden" name="Itemid" value="168"/>
                <input type="hidden" name="option" value="com_mailtester_cart"/>
                <input type="hidden" name="ctrl" value="checkout"/>
                <input type="hidden" name="task" value="step"/>
                <input type="hidden" name="previous" value="0"/>
                <input type="hidden" name="step" value="1"/>
                <input type="hidden" id="mailtester_cart_validate" name="validate" value="0"/>
                <input type="hidden" name="45adedc08584ba24ea6f3e97d550bc4a" value="1"/>
                <input
                    type="hidden"
                    name="unique_id"
                    value="[04a41f3c14335bf17e4ae3d68cf4643e]"/> -->
                <br style="clear:both"/> 
                <a
                
                    class="btn button mailtester_checkout_input_button"
                    name="next"
                    href="{{ route('checkout', 'step2') }}"
                    id="mailtester_cart_checkout_next_button">Next</a>
            </form>
        </div>
        <div class="clear_both"></div>

    </div>
</div>

<script>
function showModal(profile_id) {
    var url = "{{ route('get-address-detail') }}";
    var _token = $("input[name='_token']",".mailtester_cart_address_listing_div").val();
    if(profile_id != '0'){
        $.ajax({
            url: url,
            type:'POST',
            data: {_token:_token,profile_id:profile_id},
            success: function(data) {
                var result = JSON.parse(data);
                var profile = result.detail;                
                $('#address_firstname').val('');
                $('#address_lastname').val('');
                $('#address_company').val('');
                $('#address_vat').val('');
                $('#address_street').val('');
                $('#address_post_code').val('');
                $('#address_city').val('');
                $('#address_telephone').val('');
                $('#address_country').val('');
                $('#data_address_address_state').val('');

                $('#profile_id').val(profile_id);
                if(profile.firstname && typeof profile.firstname!="undefined")        
                    $('#address_firstname').val(profile.firstname);
                if(profile.lastname && typeof profile.lastname!="undefined")          
                    $('#address_lastname').val(profile.lastname);
                if(profile.company && typeof profile.company!="undefined")            
                    $('#address_company').val(profile.company);
                if(profile.vatnum && typeof profile.vatnum!="undefined")              
                    $('#address_vat').val(profile.vatnum);
                if(profile.address && typeof profile.address!="undefined")            
                    $('#address_street').val(profile.address);
                if(profile.postcode && typeof profile.postcode!="undefined")          
                    $('#address_post_code').val(profile.postcode);
                if(profile.city && typeof profile.city!="undefined")                  
                    $('#address_city').val(profile.city);
                if(profile.telephone && typeof profile.telephone!="undefined")        
                    $('#address_telephone').val(profile.telephone);
                if(profile.country && typeof profile.country!="undefined")        
                    $('#address_country').val(profile.country);
                if(profile.state && typeof profile.state!="undefined")        
                    $('#address_state').val(profile.state);
                $('#practice_modal').modal('show');

            },
            error: function (data) {
                  
            }
        });
    } else {
        $('#profile_id').val('0');
        $('#address_firstname').val('');
        $('#address_lastname').val('');
        $('#address_company').val('');
        $('#address_vat').val('');
        $('#address_street').val('');
        $('#address_post_code').val('');
        $('#address_city').val('');
        $('#address_telephone').val('');
        $('#address_country').val('');
        $('#data_address_address_state').val('');
        $('#address_state').val('');
        $('#practice_modal').modal('show');
    }
}
</script>

<style>
a#mailtester_cart_checkout_next_button, a#mailtester_cart_checkout_billing_address_new_link
{
    color:#fff;
    padding-top : 1px !important;
    padding-bottom : 1px !important;
}

</style>
@include('mailstester.address')

@endsection

@section('addressjs')

@endsection

