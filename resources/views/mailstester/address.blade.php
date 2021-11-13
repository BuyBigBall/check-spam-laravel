<div class="modal fade" id="practice_modal">
    <div class="modal-dialog">
        <form id="companydata">
            <div class="modal-content">
            <input type="hidden" id="color_id" name="color_id" value="">
            <div class="modal-body">
                <input type="text" name="name" id="name" value="" class="form-control">
            </div>
            <input type="submit" value="Submit" id="submit" class="btn btn-sm btn-outline-danger py-0" style="font-size: 0.8em;">
        </div>
        </form>
    </div>
</div>


<div class="contentpane modal" id="com_hikashop_address_form"  role="dialog" style='height:auto;'>
    <div class="modal-dialog" role="document" style='margin:1px;'>
        <div class="modal-header">
            <h1 id="hikashop_address_form_header_iframe"
                style='margin-bottom:0px; border:none;'>
                Address information</h1>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <!-- <span aria-hidden="true">&times;</span> -->
            </button>
        </div>
        <div class="modal-body">    
            <div id="system-message-container"></div>
            <div id="hikashop_address_form_span_iframe">
                <form
                    action="{{ route('save-address') }}"
                    method="post"
                    name="hikashop_address_form"
                    enctype="multipart/form-data">
                    @csrf
                    <table>
                        <tbody>
                            <tr
                                class="hikashop_address_address_firstname_line"
                                id="hikashop_address_address_firstname">
                                <td class="key">
                                    <label for="address_firstname">First name</label>
                                </td>
                                <td><input
                                    class="inputbox"
                                    id="address_firstname"
                                    onchange="hikashopToggleFields(this.value,'firstname','address',0);"
                                    type="text"
                                    name="firstname"
                                    value="Samir"/>
                                    <span class="hikashop_field_required">*</span>
                                </td>
                            </tr>
                            <tr
                                class="hikashop_address_address_lastname_line"
                                id="hikashop_address_address_lastname">
                                <td class="key">
                                    <label for="address_lastname">Last name</label>
                                </td>
                                <td><input
                                    class="inputbox"
                                    id="address_lastname"
                                    onchange="hikashopToggleFields(this.value,'lastname','address',0);"
                                    type="text"
                                    name="lastname"
                                    value="Chakouri"/>
                                    <span class="hikashop_field_required">*</span>
                                </td>
                            </tr>
                            <tr
                                class="hikashop_address_address_company_line"
                                id="hikashop_address_address_company">
                                <td class="key">
                                    <label for="address_company">Company</label>
                                </td>
                                <td><input
                                    class="inputbox"
                                    id="address_company"
                                    onchange="hikashopToggleFields(this.value,'company','address',0);"
                                    type="text"
                                    name="company"
                                    value=""/></td>
                            </tr>
                            <tr class="hikashop_address_address_vat_line" id="hikashop_address_address_vat">
                                <td class="key">
                                    <label for="address_vat">VAT number</label>
                                </td>
                                <td><input
                                    class="inputbox"
                                    id="address_vat"
                                    placeholder="For European Companies only"
                                    onchange="hikashopToggleFields(this.value,'vatnum','address',0);"
                                    type="text"
                                    name="vatnum"
                                    value=""/></td>
                            </tr>
                            <tr
                                class="hikashop_address_address_street_line"
                                id="hikashop_address_address_street">
                                <td class="key">
                                    <label for="address_street">Address</label>
                                </td>
                                <td><input
                                    class="inputbox"
                                    id="address_street"
                                    onchange="hikashopToggleFields(this.value,'address','address',0);"
                                    type="text"
                                    name="address"
                                    value="Calle julio colomer 29"/>
                                    <span class="hikashop_field_required">*</span>
                                </td>
                            </tr>
                            <tr
                                class="hikashop_address_address_post_code_line"
                                id="hikashop_address_address_post_code">
                                <td class="key">
                                    <label for="address_post_code">Post code</label>
                                </td>
                                <td><input
                                    class="inputbox"
                                    id="address_post_code"
                                    onchange="hikashopToggleFields(this.value,'postcode','address',0);"
                                    type="text"
                                    name="postcode"
                                    value="46910"/></td>
                            </tr>
                            <tr
                                class="hikashop_address_address_city_line"
                                id="hikashop_address_address_city">
                                <td class="key">
                                    <label for="address_city">City</label>
                                </td>
                                <td><input
                                    class="inputbox"
                                    id="address_city"
                                    onchange="hikashopToggleFields(this.value,'city','address',0);"
                                    type="text"
                                    name="city"
                                    value="Alfafar"/>
                                    <span class="hikashop_field_required">*</span>
                                </td>
                            </tr>
                            <tr
                                class="hikashop_address_address_telephone_line"
                                id="hikashop_address_address_telephone">
                                <td class="key">
                                    <label for="address_telephone">Telephone</label>
                                </td>
                                <td><input
                                    class="inputbox"
                                    id="address_telephone"
                                    onchange="hikashopToggleFields(this.value,'telephone','address',0);"
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
                                    <select
                                        id="address_country"
                                        name="country"
                                        size="1"
                                        onchange="changeCountry(this);hikashopToggleFields(this.value,'country','address',0);"
                                        class="hikashop_field_dropdown"></select>
                                </td>
                            </tr>
                            <tr
                                class="hikashop_address_address_state_line"
                                id="hikashop_address_address_state">
                                <td class="key">
                                    <label for="address_state">State</label>
                                </td>
                                <td>
                                    <span id="data_address_address_state_container">
                                        <select
                                            id="data_address_address_state"
                                            name="state"
                                            size="1"
                                            class="hikashop_field_dropdown"></select>
                                    </span>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <input type="hidden" name="Itemid" value="111"/>
                    <input type="hidden" name="ctrl" value="address"/>
                    <input type="hidden" name="tmpl" value="component"/>
                    <input type="hidden" name="task" value="save"/>
                    <input type="hidden" name="type" value=""/>
                    <input type="hidden" name="action" value="edit"/>
                    <input type="hidden" name="makenew" value="0"/>
                    <input type="hidden" name="redirect" value=""/>
                    <input type="hidden" name="step" value="-1"/>
                    <input type="hidden" name="data[address][address_user_id]" value="40095"/>
                    <input type="hidden" name="data[address][address_id]" value="44126"/>
                    <input type="hidden" name="address_id" value="44126"/>
                    <input type="hidden" name="02da9f5c81fc9e643cc9b1546a6e1e60" value="1"/>
                    <input
                        type="submit"
                        class="btn button hikashop_cart_input_button"
                        name="ok"
                        value="OK"
                        onclick="var field=document.getElementById('hikashop_product_quantity_field_1');if(hikashopCheckChangeForm('address','hikashop_address_form')) document.forms['hikashop_address_form'].submit(); return false;"/>
                </form>
            </div>
            <div class="clear_both"></div>
        </div>
    </div>
</div>

<script>
function hikashopToggleFields(new_value, namekey, field_type, id, prefix) {
	// if(!window.hikashop)
	// 	return false;
	// if(!window.hikashop.fields_data && window.hikashopFieldsJs)
	// 	window.hikashop.fields_data = window.hikashopFieldsJs;
	// return window.hikashop.toggleField(new_value, namekey, field_type, id, prefix);
}
    </script>