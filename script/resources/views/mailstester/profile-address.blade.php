@extends('mailstester.layout')

<!-- <link href="/assets/css/vex.css" rel="stylesheet" type="text/css"> -->

@section('content')

<div id="content_container" style="width:100%">
    <div class="row-fluid contentsize">

        <div id="system-message-container"></div>

        <div id="hikashop_address_listing">
            <fieldset>
                <div class="header hikashop_header_title">
                    <h1>Addresses</h1>
                </div>
                <div class="toolbar hikashop_header_buttons" id="toolbar">
                    <table>
                        <tbody>
                            <tr>
                                <td>
                                    <a
                                        rel="nofollow"
                                        onclick="return window.hikashop.openBox(this);"
                                        id="hikashop_new_address_popup"
                                        href="https://www.mail-tester.com/manager/account/address/add/tmpl-component.html"
                                        data-hk-popup="vex"
                                        data-vex="{x:760, y:480}">
                                        <span class="icon-32-new" title="New"></span>New</a>
                                </td>
                                <td>
                                    <a href="https://www.mail-tester.com/manager/account/user.html">
                                        <span class="icon-32-back" title="Back"></span>
                                        Back
                                    </a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </fieldset>
            <div class="hikashop_address_listing_div">
                <form
                    action="{{ route('save-address') }}"
                    name="hikashop_user_address"
                    method="post">
                    @csrf
                    <table class="hikashop_address_listing_table">
                        <tbody>
                            <tr class="hikashop_address_listing_item">
                                <td class="hikashop_address_listing_item_default">
                                    <input
                                        type="radio"
                                        name="address_default"
                                        value="44126"
                                        checked="checked"
                                        onclick="this.form.submit();"/></td>
                                <td class="hikashop_address_listing_item_details">
                                    <span>Samir Chakouri<br/>
                                        Calle julio colomer 29<br/>
                                        46910 Alfafar Valencia<br/>
                                        Spain</span>
                                </td>
                                <td class="hikashop_address_listing_item_actions">
                                    <a
                                        onclick="if(!confirm('Are you sure you want to delete this address ?')){return false;}else{return true;}"
                                        href="#"
                                        title="Delete">
                                        <img src="/assets/images/icons/delete.png" alt="Delete"/></a>
                                    <a
                                        rel="nofollow"
                                        onclick="return showModal();"
                                        id="hikashop_edit_address_popup_44126"
                                        href="#"
                                        data-hk-popup="vex"
                                        data-vex="{x:760, y:480}">
                                        <img src="/assets/images/icons/edit.png" title="Edit" alt="Edit"/></a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <input type="hidden" name="option" value="com_hikashop"/>
                    <input type="hidden" name="ctrl" value="address"/>
                    <input type="hidden" name="task" value="setdefault"/>
                    <input type="hidden" name="02da9f5c81fc9e643cc9b1546a6e1e60" value="1"/>
                </form>
            </div>
        </div>
        <div class="clear_both"></div>
    </div>
</div>
<script>
    function showModal()
    {
        var url = "{{ route('getmemInfo', $userdata['user_login']['id'])}}";
        $.ajax({
        url: url,
        dataType: "text",
        cache: false,
        contentType: false,
        processData: false,
        type: "get",
        success: function (data) {
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

            var ujson = JSON.parse(data);
            if(ujson.firstname && typeof ujson.firstname!="undefined")        $('#address_firstname').val(ujson.firstname);
            if(ujson.lastname && typeof ujson.lastname!="undefined")          $('#address_lastname').val(ujson.lastname);
            if(ujson.company && typeof ujson.company!="undefined")            $('#address_company').val(ujson.company);
            if(ujson.vatnum && typeof ujson.vatnum!="undefined")              $('#address_vat').val(ujson.vatnum);
            if(ujson.address && typeof ujson.address!="undefined")            $('#address_street').val(ujson.address);
            if(ujson.postcode && typeof ujson.postcode!="undefined")          $('#address_post_code').val(ujson.postcode);
            if(ujson.city && typeof ujson.city!="undefined")                  $('#address_city').val(ujson.city);
            if(ujson.telephone && typeof ujson.telephone!="undefined")        $('#address_telephone').val(ujson.telephone);
            //   if(ujson.country && typeof ujson.firstname!="undefined")       $('#address_country').val(ujson.country);
            //   if(ujson.state && typeof ujson.firstname!="undefined")         $('#data_address_address_state').val(ujson.state);
            $('#practice_modal').modal('show');
        
        },
      });
        
    }
</script>
@include('mailstester.address')

@endsection

@section('addressjs')

<!-- <script src="/assets/js/hikashop.js" type="text/javascript"></script>
<script src="/assets/js/vex.min.js" type="text/javascript"></script>
<script src="/assets/js/keepalive.js" type="text/javascript"></script> -->

@endsection