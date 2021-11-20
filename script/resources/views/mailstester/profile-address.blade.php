@extends('mailstester.layout')

<!-- <link href="/assets/css/vex.css" rel="stylesheet" type="text/css"> -->

@section('content')
<style>
.mailtester_cart_address_listing_item_actions {
    padding-left: 15px;
}
.sdata-error { 
    margin-top: 30px !important;
    margin-left: 50px !important;
    color: #CB5D65; 
}
.sdata-success {
    margin-top: 30px !important;
    margin-left: 50px !important;
    color: #48b11d; 
}
</style>

<div id="content_container" style="width:100%">
    <div class="row-fluid contentsize">

        <div id="system-message-container"></div>

        <div id="mailtester_cart_address_listing">
            <fieldset>
                <div class="header mailtester_cart_header_title">
                    <h1>Addresses</h1>
                </div>
                @if(session()->has('error'))
                <div class="mailtester_cart_header_title sdata-error">
                    <strong>{{ session()->get('error') }}</strong>
                </div>
                @endif

                @if(session()->has('success'))
                <div class="mailtester_cart_header_title sdata-success">
                    <strong>{{ session()->get('success') }}</strong>
                </div>
                @endif
                <div class="toolbar mailtester_cart_header_buttons" id="toolbar">
                    <table>
                        <tbody>
                            <tr>
                                <td>
                                    <a
                                        rel="nofollow"
                                        onclick="return showModal('0');"
                                        id="mailtester_cart_new_address_popup"
                                        data-hk-popup="vex"
                                        data-vex="{x:760, y:480}">
                                        <span class="icon-32-new" title="New"></span>New</a>
                                </td>
                                <td>
                                    <a href="{{route('account')}}">
                                        <span class="icon-32-back" title="Back"></span>
                                        Back
                                    </a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </fieldset>
            <div class="mailtester_cart_address_listing_div">
                <form
                    action="{{ route('set-default-address') }}"
                    name="mailtester_cart_user_address"
                    method="post">
                    @csrf
                    <table class="mailtester_cart_address_listing_table">
                        <tbody>
                            @foreach($addressdata as $row)
                                <tr class="mailtester_cart_address_listing_item">
                                    <td class="mailtester_cart_address_listing_item_default">
                                        <input type="radio" name="default_address" 
                                            value="{{$row->id}}" 
                                            {{ $row->default_address == '1'?'checked':''}}
                                            onclick="this.form.submit();"/></td>
                                    <td class="mailtester_cart_address_listing_item_details">
                                        <span>{{$row->firstname." ".$row->lastname}}<br/>
                                            {{$row->postcode." ".$row->city." ".$row->state}}<br/>
                                            {{$row->country}}</span>
                                    </td>
                                    <td class="mailtester_cart_address_listing_item_actions">
                                        <a
                                            onclick="if(!confirm('Are you sure you want to delete this address ?')){return false;}else{return deleteAddress('{{$row->id}}');}"
                                            title="Delete">
                                            <img src="/assets/images/icons/delete.png" alt="Delete"/></a>
                                        <a
                                            rel="nofollow"
                                            onclick="return showModal('{{$row->id}}');"
                                            id="mailtester_cart_edit_address_popup_44126"
                                            href="#"
                                            data-hk-popup="vex"
                                            data-vex="{x:760, y:480}">
                                            <img src="/assets/images/icons/edit.png" title="Edit" alt="Edit"/></a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <!-- <input type="hidden" name="option" value="com_mailtester_cart"/>
                    <input type="hidden" name="ctrl" value="address"/>
                    <input type="hidden" name="task" value="setdefault"/>
                    <input type="hidden" name="02da9f5c81fc9e643cc9b1546a6e1e60" value="1"/> -->
                </form>
            </div>
        </div>
        <div class="clear_both"></div>
    </div>
</div>
<script>
function deleteAddress(profile_id) {
    var url = "{{ route('delete-address') }}";
    var _token = $("input[name='_token']",".mailtester_cart_address_listing_div").val();
    if(profile_id != '0'){
        $.ajax({
            url: url,
            type:'POST',
            data: {_token:_token,profile_id:profile_id},
            success: function(data) {
                window.location.reload();
            },
            error: function (data) {
                  
            }
        });
    }
}
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


@include('mailstester.address')

@endsection

@section('addressjs')

<!-- <script src="/assets/js/mailtester_cart.js" type="text/javascript"></script>
<script src="/assets/js/vex.min.js" type="text/javascript"></script>
<script src="/assets/js/keepalive.js" type="text/javascript"></script> -->

@endsection
