<style>
#practice_modal {
    height: 600px;
    top: 20px;
    padding-right: 0px !important;
    opacity: 1;
}
.pac-container {
    /* put Google geocomplete list on top of Bootstrap modal */
    z-index: 9999;
}
.address-input {
    width: 350px;
    height: 30px !important;
}
</style>

<div class="modal fade" id="practice_modal" style='opacity:1'>
    <div class="modal-dialog">
        <div class="modal-header" style='border:none;'>
            <h3 id="hikashop_address_form_header_iframe"
                style='margin-bottom:0px; border:none;'>
                Address information</h1>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            </button>
        </div>
        <div class="modal-content">
            <div id="system-message-container"></div>
            <div id="hikashop_address_form_span_iframe" class="geo-details" style="padding:20px;">
                <form
                    action="{{ route('save-address') }}"
                    method="post"
                    id="hikashop_address_form"
                    name="hikashop_address_form"
                    onsubmit="return validation();"
                    enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" id="profile_id" name="profile_id" value="0">
                    <table>
                        <tbody>
                            <tr
                                class="hikashop_address_address_firstname_line"
                                id="hikashop_address_address_firstname">
                                <td class="key">
                                    <label for="address_firstname">First name</label>
                                    <span class="hikashop_field_required">*</span>
                                </td>
                                <td><input
                                    class="inputbox address-input required"
                                    id="address_firstname"
                                    type="text"
                                    name="firstname"
                                    required="required"
                                    value="Samir"/>
                                    
                                </td>
                            </tr>
                            <tr
                                class="hikashop_address_address_lastname_line"
                                id="hikashop_address_address_lastname">
                                <td class="key">
                                    <label for="address_lastname">Last name</label>
                                    <span class="hikashop_field_required">*</span>
                                </td>
                                <td><input
                                    class="inputbox address-input required"
                                    id="address_lastname"
                                    type="text"
                                    name="lastname"
                                    required="required"
                                    value="Chakouri"/>
                                </td>
                            </tr>
                            <tr
                                class="hikashop_address_address_company_line"
                                id="hikashop_address_address_company">
                                <td class="key">
                                    <label for="address_company">Company</label>
                                </td>
                                <td><input
                                    class="inputbox address-input"
                                    id="address_company"
                                    type="text"
                                    name="company"
                                    value=""/></td>
                            </tr>
                            <tr class="hikashop_address_address_vat_line" id="hikashop_address_address_vat">
                                <td class="key">
                                    <label for="address_vat">VAT number</label>
                                </td>
                                <td><input
                                    class="inputbox address-input"
                                    id="address_vat"
                                    placeholder="For European Companies only"
                                    type="text"
                                    name="vatnum"
                                    value=""/></td>
                            </tr>
                            <tr
                                class="hikashop_address_address_street_line"
                                id="hikashop_address_address_street">
                                <td class="key">
                                    <label for="address_street">Address</label>
                                    <span class="hikashop_field_required">*</span>
                                </td>
                                <td><input
                                    class="inputbox address-input required"
                                    id="address_street"
                                    type="text"
                                    name="address"
                                    required="required"
                                    value="Calle julio colomer 29"/>
                                </td>
                            </tr>
                            <tr
                                class="hikashop_address_address_post_code_line"
                                id="hikashop_address_address_post_code">
                                <td class="key">
                                    <label for="address_post_code">Post code</label>
                                </td>
                                <td><input
                                    class="inputbox address-input"
                                    data-geo="postal_code"
                                    id="address_post_code"
                                    type="text"
                                    name="postcode"
                                    value=""/></td>
                            </tr>
                            <tr
                                class="hikashop_address_address_city_line"
                                id="hikashop_address_address_city">
                                <td class="key">
                                    <label for="address_city">City</label>
                                    <span class="hikashop_field_required">*</span>
                                </td>
                                <td><input
                                    class="inputbox address-input required"
                                    data-geo="administrative_area_level_2"
                                    id="address_city"
                                    type="text"
                                    name="city"
                                    required="required"
                                    value="Alfafar"/>
                                </td>
                            </tr>
                            <tr
                                class="hikashop_address_address_telephone_line"
                                id="hikashop_address_address_telephone">
                                <td class="key">
                                    <label for="address_telephone">Telephone</label>
                                </td>
                                <td><input
                                    class="inputbox address-input"
                                    id="address_telephone"
                                    type="text"
                                    name="telephone"
                                    value=""/></td>
                            </tr>
                            <tr 
                                class="hikashop_address_address_country_line"
                                id="hikashop_address_address_country">
                                <td class="key">
                                    <label for="address_country">Country</label>
                                </td>
                                <td>
                                    <input
                                        class="inputbox address-input"
                                        data-geo="country"
                                        id="address_country"
                                        type="text"
                                        name="country"
                                        value=""/>
                                </td>
                            </tr>
                            <tr
                                class="hikashop_address_address_state_line"
                                id="hikashop_address_address_state">
                                <td class="key">
                                    <label for="address_state">State</label>
                                </td>
                                <td>
                                    <input
                                        class="inputbox address-input"
                                        data-geo="administrative_area_level_1_short"
                                        id="address_state"
                                        type="text"
                                        name="state"
                                        value=""/>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    
                    <input
                        type="submit"
                        class="btn button hikashop_cart_input_button"
                        name="ok"
                        value="OK"
                        onclick="var field=document.getElementById('hikashop_product_quantity_field_1');if(hikashopCheckChangeForm('address','hikashop_address_form')) document.forms['hikashop_address_form'].submit(); return false;"/>
                     <button class="btn button close"  data-dismiss="modal" aria-label="Close">
                         Cancel
                    </button>
                </form>
            </div>    
        </div>
    </div>
</div>
<script>
function validation() {
    // if($('#address_firstname').val()=='') {
    //     alert('Enter first name.');
    //     $('#address_firstname').focus();
    //     return false;
    // }    
    return true;        
}
</script>
