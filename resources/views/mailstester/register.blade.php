@extends('mailstester.layout')

@section('content')
<script src='https://www.google.com/recaptcha/api.js' async defer></script>
<script> 
function checkRecaptcha() {
  var response = grecaptcha.getResponse();
  if(response.length == 0) { 
    //reCaptcha not verified
    alert("no pass"); 
  }
  else { 
    //reCaptch verified
    alert("pass"); 
  }
}

// implement on the backend
function backend_API_challenge() {
    var response = grecaptcha.getResponse();
    $.ajax({
        type: "POST",
        url: 'https://www.google.com/recaptcha/api/siteverify',
        data: {"secret" : "6LdRSisdAAAAAD-Kuo3O-HEwBYb_XwdmGdL1HBlM", "response" : response, "remoteip":"localhost"},
        contentType: 'application/x-www-form-urlencoded',
        success: function(data) { console.log(data); }
    });
}
</script>


<div id="content_container" style="width:100%">
    <div class="row-fluid contentsize">

        <div id="system-message-container"></div>

        <form
            action="/profile-save"
            method="post"
            name="hikashop_registration_form"
            enctype="multipart/form-data"
            onsubmit="hikashopSubmitForm('hikashop_registration_form'); return false;">
            @csrf
            <div class="hikashop_user_registration_page">
                <fieldset class="input">
                    <h2>Registration</h2>
                    <script>
                        jQuery(document).on('ready', function () {
                            jQuery('#register_username').on('change', function (evt) {
                                this.value = this
                                    .value
                                    .toLowerCase();
                                this.value = this
                                    .value
                                    .replace(/[^a-z0-9]/g, '');
                                jQuery('.message_username').remove();
                                errorMessage = jQuery('<div/>')
                                    .addClass('message_username')
                                    .html(
                                        'All your tests will have to be sent to ' + this.value + '-WhateverYouWant@mail' +
                                        '-tester.com'
                                    );
                                if (this.value.length > 0) 
                                    jQuery(this)
                                        .parent()
                                        .append(errorMessage);
                                }
                            );
                        });
                    </script>
                    <fieldset class="form-horizontal">
                        <div
                            class="control-group hikashop_registration_name_line"
                            id="hikashop_registration_name_line">
                            <div class="control-label">
                                <label id="namemsg" for="register_name" class="required" title="">Name</label>
                            </div>
                            <div class="controls">
                                <input
                                    type="text"
                                    name="data[register][name]"
                                    id="register_name"
                                    value=""
                                    class="required"
                                    size="30"
                                    maxlength="50"
                                    aria-required="true"
                                    required="required"/>
                                *
                            </div>
                        </div>
                        <div
                            class="control-group hikashop_registration_username_line"
                            id="hikashop_registration_username_line">
                            <div class="control-label">
                                <label id="usernamemsg" for="register_username" class="required" title="">Username</label>
                            </div>
                            <div class="controls">
                                <input
                                    type="text"
                                    name="data[register][username]"
                                    id="register_username"
                                    value=""
                                    class="required validate-username"
                                    maxlength="25"
                                    size="30"
                                    aria-required="true"
                                    required="required"/>
                                *
                                <div class="message_username">All your tests will have to be sent to chakouri-WhateverYouWant@mail-tester.com</div>
                            </div>
                        </div>
                        <div class="control-group hikashop_registration_email_line">
                            <div class="control-label">
                                <label id="emailmsg" for="register_email" class="required" title="">E-mail</label>
                            </div>
                            <div class="controls">
                                <input
                                    type="text"
                                    name="data[register][email]"
                                    id="register_email"
                                    value=""
                                    class="required validate-email"
                                    maxlength="100"
                                    size="30"
                                    aria-required="true"
                                    required="required"/>
                                *
                            </div>
                        </div>
                        <div
                            class="control-group hikashop_registration_password_line"
                            id="hikashop_registration_password_line">
                            <div class="control-label">
                                <label id="pwmsg" for="register_password" class="required" title="">Password</label>
                            </div>
                            <div class="controls">
                                <input
                                    autocomplete="off"
                                    type="password"
                                    name="data[register][password]"
                                    id="register_password"
                                    value=""
                                    class="required validate-password"
                                    size="30"
                                    aria-required="true"
                                    required="required"/>
                                *
                            </div>
                        </div>
                        <div
                            class="control-group hikashop_registration_password2_line"
                            id="hikashop_registration_password2_line">
                            <div class="control-label">
                                <label id="pw2msg" for="register_password2" class="required" title="">Verify Password</label>
                            </div>
                            <div class="controls">
                                <input
                                    autocomplete="off"
                                    type="password"
                                    name="data[register][password2]"
                                    id="register_password2"
                                    value=""
                                    class="required validate-password"
                                    size="30"
                                    aria-required="true"
                                    required="required"/>
                                *
                            </div>
                            <div class="recaptcha">
                                <label></label>
                                <script
                                    type="text/javascript"
                                    src="./Registration_files/api.js.download"
                                    async=""
                                    defer=""></script>
                                <div
                                    id="g-recaptcha"
                                    class="g-recaptcha"
                                    data-sitekey="6LdTlhsTAAAAAMRX7AdyzxpY8I8f0BcleOpi2OtA"
                                    data-theme="light"></div>
                                <input type="hidden" onclick="checkRecaptcha();" value="submit"></input>
                            </div>
                        </div>

                        <div class="hikashop_registration_address">
                            <legend>Address information</legend>
                        </div>
                        <div
                            class="control-group hikashop_registration_address_firstname_line"
                            id="hikashop_address_address_firstname">
                            <div class="control-label">
                                <label for="address_firstname">First name</label>
                            </div>
                            <div class="controls">
                                <input
                                    class="inputbox"
                                    id="address_firstname"
                                    aria-required="true"
                                    required="required"
                                    onchange="hikashopToggleFields(this.value,'address_firstname','address',0);"
                                    type="text"
                                    name="data[address][address_firstname]"
                                    value=""/>
                                <span class="hikashop_field_required">*</span>
                            </div>
                        </div>
                        <div
                            class="control-group hikashop_registration_address_lastname_line"
                            id="hikashop_address_address_lastname">
                            <div class="control-label">
                                <label for="address_lastname">Last name</label>
                            </div>
                            <div class="controls">
                                <input
                                    class="inputbox"
                                    id="address_lastname"
                                    aria-required="true"
                                    required="required"
                                    onchange="hikashopToggleFields(this.value,'address_lastname','address',0);"
                                    type="text"
                                    name="data[address][address_lastname]"
                                    value=""/>
                                <span class="hikashop_field_required">*</span>
                            </div>
                        </div>
                        <div
                            class="control-group hikashop_registration_address_company_line"
                            id="hikashop_address_address_company">
                            <div class="control-label">
                                <label for="address_company">Company</label>
                            </div>
                            <div class="controls">
                                <input
                                    class="inputbox"
                                    id="address_company"
                                    onchange="hikashopToggleFields(this.value,'address_company','address',0);"
                                    type="text"
                                    name="data[address][address_company]"
                                    value=""/></div>
                        </div>
                        <div
                            class="control-group hikashop_registration_address_vat_line"
                            id="hikashop_address_address_vat">
                            <div class="control-label">
                                <label for="address_vat">VAT number</label>
                            </div>
                            <div class="controls">
                                <input
                                    class="inputbox"
                                    id="address_vat"
                                    placeholder="For European Companies only"
                                    onchange="hikashopToggleFields(this.value,'address_vat','address',0);"
                                    type="text"
                                    name="data[address][address_vat]"
                                    value=""/></div>
                        </div>
                        <div
                            class="control-group hikashop_registration_address_street_line"
                            id="hikashop_address_address_street">
                            <div class="control-label">
                                <label for="address_street">Address</label>
                            </div>
                            <div class="controls">
                                <input
                                    class="inputbox"
                                    id="address_street"
                                    aria-required="true"
                                    required="required"
                                    onchange="hikashopToggleFields(this.value,'address_street','address',0);"
                                    type="text"
                                    name="data[address][address_street]"
                                    value=""/>
                                <span class="hikashop_field_required">*</span>
                            </div>
                        </div>
                        <div
                            class="control-group hikashop_registration_address_post_code_line"
                            id="hikashop_address_address_post_code">
                            <div class="control-label">
                                <label for="address_post_code">Post code</label>
                            </div>
                            <div class="controls">
                                <input
                                    class="inputbox"
                                    id="address_post_code"
                                    onchange="hikashopToggleFields(this.value,'address_post_code','address',0);"
                                    type="text"
                                    name="data[address][address_post_code]"
                                    value=""/></div>
                        </div>
                        <div
                            class="control-group hikashop_registration_address_city_line"
                            id="hikashop_address_address_city">
                            <div class="control-label">
                                <label for="address_city">City</label>
                            </div>
                            <div class="controls">
                                <input
                                    class="inputbox"
                                    id="address_city"
                                    aria-required="true"
                                    required="required"
                                    onchange="hikashopToggleFields(this.value,'address_city','address',0);"
                                    type="text"
                                    name="data[address][address_city]"
                                    value=""/>
                                <span class="hikashop_field_required">*</span>
                            </div>
                        </div>
                        <div
                            class="control-group hikashop_registration_address_telephone_line"
                            id="hikashop_address_address_telephone">
                            <div class="control-label">
                                <label for="address_telephone">Telephone</label>
                            </div>
                            <div class="controls">
                                <input
                                    class="inputbox"
                                    id="address_telephone"
                                    onchange="hikashopToggleFields(this.value,'address_telephone','address',0);"
                                    type="text"
                                    name="data[address][address_telephone]"
                                    value=""/></div>
                        </div>
                        <div
                            class="control-group hikashop_registration_address_country_line"
                            id="hikashop_address_address_country">
                            <div class="control-label">
                                <label for="address_country">Country</label>
                            </div>
                            <div class="controls">
                                <select
                                    id="address_country"
                                    name="data[address][address_country]"
                                    size="1"
                                    onchange="window.hikashop.changeState(this,'data_address_address_state','https://www.mail-tester.com/manager/index.php?option=com_hikashop&amp;ctrl=checkout&amp;task=state&amp;tmpl=component&amp;field_type=address&amp;field_id=data_address_address_state&amp;field_namekey=address_state&amp;namekey='+this.value);hikashopToggleFields(this.value,'address_country','address',0);"
                                    class="hikashop_field_dropdown">
                                    <option
                                        value="country_Afghanistan_1"
                                        id="address_country_country_Afghanistan_1">Afghanistan (افغانستان)</option>
                                    <option value="country_Albania_2" id="address_country_country_Albania_2">Albania (Shqipëria)</option>
                                    <option value="country_Algeria_3" id="address_country_country_Algeria_3">Algeria (الجزائر)</option>
                                    <option
                                        value="country_American_Samoa_4"
                                        id="address_country_country_American_Samoa_4">American Samoa</option>
                                    <option value="country_Andorra_5" id="address_country_country_Andorra_5">Andorra</option>
                                    <option value="country_Angola_6" id="address_country_country_Angola_6">Angola</option>
                                    <option value="country_Anguilla_7" id="address_country_country_Anguilla_7">Anguilla</option>
                                    <option value="country_Antarctica_8" id="address_country_country_Antarctica_8">Antarctica</option>
                                    <option
                                        value="country_Antigua_and_Barbuda_9"
                                        id="address_country_country_Antigua_and_Barbuda_9">Antigua and Barbuda</option>
                                    <option value="country_Argentina_10" id="address_country_country_Argentina_10">Argentina</option>
                                    <option value="country_Armenia_11" id="address_country_country_Armenia_11">Armenia (Հայաստան)</option>
                                    <option value="country_Aruba_12" id="address_country_country_Aruba_12">Aruba</option>
                                    <option value="country_Australia_13" id="address_country_country_Australia_13">Australia</option>
                                    <option value="country_Austria_14" id="address_country_country_Austria_14">Austria (Österreich)</option>
                                    <option
                                        value="country_Azerbaijan_15"
                                        id="address_country_country_Azerbaijan_15">Azerbaijan (Azərbaycan)</option>
                                    <option value="country_Bahamas_16" id="address_country_country_Bahamas_16">Bahamas</option>
                                    <option value="country_Bahrain_17" id="address_country_country_Bahrain_17">Bahrain (البحرين)</option>
                                    <option
                                        value="country_Bangladesh_18"
                                        id="address_country_country_Bangladesh_18">Bangladesh (বাংলাদেশ')</option>
                                    <option value="country_Barbados_19" id="address_country_country_Barbados_19">Barbados</option>
                                    <option value="country_Belarus_20" id="address_country_country_Belarus_20">Belarus (Беларусь)</option>
                                    <option value="country_Belgium_21" id="address_country_country_Belgium_21">Belgium (België • Belgique • Belgien)</option>
                                    <option value="country_Belize_22" id="address_country_country_Belize_22">Belize</option>
                                    <option value="country_Benin_23" id="address_country_country_Benin_23">Benin (Bénin)</option>
                                    <option value="country_Bermuda_24" id="address_country_country_Bermuda_24">Bermuda</option>
                                    <option value="country_Bhutan_25" id="address_country_country_Bhutan_25">Bhutan (འབྲུག་ཡུལ་)</option>
                                    <option value="country_Bolivia_26" id="address_country_country_Bolivia_26">Bolivia (Wuliwya • Volívia • Buliwya)</option>
                                    <option
                                        value="country_Bosnia_and_Herzegowina_27"
                                        id="address_country_country_Bosnia_and_Herzegowina_27">Bosnia and Herzegowina (Bosna i Hercegovina)</option>
                                    <option value="country_Botswana_28" id="address_country_country_Botswana_28">Botswana</option>
                                    <option
                                        value="country_Bouvet_Island_29"
                                        id="address_country_country_Bouvet_Island_29">Bouvet Island</option>
                                    <option value="country_Brazil_30" id="address_country_country_Brazil_30">Brazil</option>
                                    <option
                                        value="country_British_Indian_Ocean_Territory_31"
                                        id="address_country_country_British_Indian_Ocean_Territory_31">British Indian Ocean Territory</option>
                                    <option
                                        value="country_Brunei_Darussalam_32"
                                        id="address_country_country_Brunei_Darussalam_32">Brunei Darussalam</option>
                                    <option value="country_Bulgaria_33" id="address_country_country_Bulgaria_33">Bulgaria (България)</option>
                                    <option
                                        value="country_Burkina_Faso_34"
                                        id="address_country_country_Burkina_Faso_34">Burkina Faso</option>
                                    <option value="country_Burundi_35" id="address_country_country_Burundi_35">Burundi (Uburundi)</option>
                                    <option value="country_Cambodia_36" id="address_country_country_Cambodia_36">Cambodia (កម្ពុជា)</option>
                                    <option value="country_Cameroon_37" id="address_country_country_Cameroon_37">Cameroon (Cameroun)</option>
                                    <option value="country_Canada_38" id="address_country_country_Canada_38">Canada</option>
                                    <option
                                        value="country_Cape_Verde_39"
                                        id="address_country_country_Cape_Verde_39">Cape Verde (Cabo Verde)</option>
                                    <option
                                        value="country_Cayman_Islands_40"
                                        id="address_country_country_Cayman_Islands_40">Cayman Islands</option>
                                    <option
                                        value="country_Central_African_Republic_41"
                                        id="address_country_country_Central_African_Republic_41">Central African Republic (Centrafrique • Bêafrîka)</option>
                                    <option value="country_Chad_42" id="address_country_country_Chad_42">Chad (Tchad • تشاد)</option>
                                    <option value="country_Chile_43" id="address_country_country_Chile_43">Chile</option>
                                    <option value="country_China_44" id="address_country_country_China_44">China (中國 • 中国)</option>
                                    <option
                                        value="country_Christmas_Island_45"
                                        id="address_country_country_Christmas_Island_45">Christmas Island</option>
                                    <option
                                        value="country_Cocos__Keeling__Islands_46"
                                        id="address_country_country_Cocos__Keeling__Islands_46">Cocos (Keeling) Islands</option>
                                    <option value="country_Colombia_47" id="address_country_country_Colombia_47">Colombia</option>
                                    <option value="country_Comoros_48" id="address_country_country_Comoros_48">Comoros (Komori • Comores • جزر القمر)</option>
                                    <option value="country_Congo_49" id="address_country_country_Congo_49">Congo</option>
                                    <option
                                        value="country_Cook_Islands_50"
                                        id="address_country_country_Cook_Islands_50">Cook Islands</option>
                                    <option
                                        value="country_Costa_Rica_51"
                                        id="address_country_country_Costa_Rica_51">Costa Rica</option>
                                    <option
                                        value="country_Cote_D_Ivoire_52"
                                        id="address_country_country_Cote_D_Ivoire_52">Cote D'Ivoire</option>
                                    <option value="country_Croatia_53" id="address_country_country_Croatia_53">Croatia (Hrvatska)</option>
                                    <option value="country_Cuba_54" id="address_country_country_Cuba_54">Cuba</option>
                                    <option value="country_Cyprus_55" id="address_country_country_Cyprus_55">Cyprus (Κύπρος • Kıbrıs)</option>
                                    <option
                                        value="country_Czech_Republic_56"
                                        id="address_country_country_Czech_Republic_56">Czech Republic (Česko)</option>
                                    <option value="country_Denmark_57" id="address_country_country_Denmark_57">Denmark (Danmark)</option>
                                    <option value="country_Djibouti_58" id="address_country_country_Djibouti_58">Djibouti (جيبوتي)</option>
                                    <option value="country_Dominica_59" id="address_country_country_Dominica_59">Dominica</option>
                                    <option
                                        value="country_Dominican_Republic_60"
                                        id="address_country_country_Dominican_Republic_60">Dominican Republic (República Dominicana)</option>
                                    <option
                                        value="country_East_Timor_61"
                                        id="address_country_country_East_Timor_61">East Timor (Timór-Leste)</option>
                                    <option value="country_Ecuador_62" id="address_country_country_Ecuador_62">Ecuador</option>
                                    <option value="country_Egypt_63" id="address_country_country_Egypt_63">Egypt (مصر)</option>
                                    <option
                                        value="country_El_Salvador_64"
                                        id="address_country_country_El_Salvador_64">El Salvador</option>
                                    <option
                                        value="country_Equatorial_Guinea_65"
                                        id="address_country_country_Equatorial_Guinea_65">Equatorial Guinea (Guinée équatoriale)</option>
                                    <option value="country_Eritrea_66" id="address_country_country_Eritrea_66">Eritrea (ኤርትራ • إرتريا)</option>
                                    <option value="country_Estonia_67" id="address_country_country_Estonia_67">Estonia (Eesti)</option>
                                    <option value="country_Ethiopia_68" id="address_country_country_Ethiopia_68">Ethiopia (ኢትዮጵያ)</option>
                                    <option
                                        value="country_Falkland_Islands__Malvinas__69"
                                        id="address_country_country_Falkland_Islands__Malvinas__69">Falkland Islands (Malvinas)</option>
                                    <option
                                        value="country_Faroe_Islands_70"
                                        id="address_country_country_Faroe_Islands_70">Faroe Islands</option>
                                    <option value="country_Fiji_71" id="address_country_country_Fiji_71">Fiji (Viti • फ़िजी)</option>
                                    <option value="country_Finland_72" id="address_country_country_Finland_72">Finland (Suomi)</option>
                                    <option
                                        value="country_France_73"
                                        id="address_country_country_France_73"
                                        selected="selected">France</option>
                                    <option
                                        value="country_French_Guiana_75"
                                        id="address_country_country_French_Guiana_75">French Guiana</option>
                                    <option
                                        value="country_French_Polynesia_76"
                                        id="address_country_country_French_Polynesia_76">French Polynesia</option>
                                    <option
                                        value="country_French_Southern_Territories_77"
                                        id="address_country_country_French_Southern_Territories_77">French Southern Territories</option>
                                    <option value="country_Gabon_78" id="address_country_country_Gabon_78">Gabon</option>
                                    <option value="country_Gambia_79" id="address_country_country_Gambia_79">Gambia</option>
                                    <option value="country_Georgia_80" id="address_country_country_Georgia_80">Georgia (საქართველო)</option>
                                    <option value="country_Germany_81" id="address_country_country_Germany_81">Germany (Deutschland)</option>
                                    <option value="country_Ghana_82" id="address_country_country_Ghana_82">Ghana</option>
                                    <option value="country_Gibraltar_83" id="address_country_country_Gibraltar_83">Gibraltar</option>
                                    <option value="country_Greece_84" id="address_country_country_Greece_84">Greece (Ελλάδα)</option>
                                    <option value="country_Greenland_85" id="address_country_country_Greenland_85">Greenland</option>
                                    <option value="country_Grenada_86" id="address_country_country_Grenada_86">Grenada</option>
                                    <option value="country_Guam_88" id="address_country_country_Guam_88">Guam</option>
                                    <option value="country_Guatemala_89" id="address_country_country_Guatemala_89">Guatemala</option>
                                    <option value="country_Guinea_90" id="address_country_country_Guinea_90">Guinea (Guinée)</option>
                                    <option
                                        value="country_Guinea_Bissau_91"
                                        id="address_country_country_Guinea_Bissau_91">Guinea-Bissau (Guiné-Bissau)</option>
                                    <option value="country_Guyana_92" id="address_country_country_Guyana_92">Guyana</option>
                                    <option value="country_Haiti_93" id="address_country_country_Haiti_93">Haiti (Haïti • Ayiti)</option>
                                    <option
                                        value="country_Heard_and_McDonald_Islands_94"
                                        id="address_country_country_Heard_and_McDonald_Islands_94">Heard and McDonald Islands</option>
                                    <option value="country_Honduras_95" id="address_country_country_Honduras_95">Honduras</option>
                                    <option value="country_Hong_Kong_96" id="address_country_country_Hong_Kong_96">Hong Kong (香港)</option>
                                    <option value="country_Hungary_97" id="address_country_country_Hungary_97">Hungary (Magyarország)</option>
                                    <option value="country_Iceland_98" id="address_country_country_Iceland_98">Iceland (Ísland)</option>
                                    <option value="country_India_99" id="address_country_country_India_99">India (भारत)</option>
                                    <option
                                        value="country_Indonesia_100"
                                        id="address_country_country_Indonesia_100">Indonesia</option>
                                    <option value="country_Iran_101" id="address_country_country_Iran_101">Iran (ايران)</option>
                                    <option value="country_Iraq_102" id="address_country_country_Iraq_102">Iraq (عێراق • العراق)</option>
                                    <option value="country_Ireland_103" id="address_country_country_Ireland_103">Ireland (Éire)</option>
                                    <option value="country_Israel_104" id="address_country_country_Israel_104">Israel (إسرائيل • ישראל)</option>
                                    <option value="country_Italy_105" id="address_country_country_Italy_105">Italy (Italia)</option>
                                    <option value="country_Jamaica_106" id="address_country_country_Jamaica_106">Jamaica</option>
                                    <option value="country_Japan_107" id="address_country_country_Japan_107">Japan (日本)</option>
                                    <option value="country_Jordan_108" id="address_country_country_Jordan_108">Jordan (الأردنّ)</option>
                                    <option
                                        value="country_Kazakhstan_109"
                                        id="address_country_country_Kazakhstan_109">Kazakhstan (Қазақстан)</option>
                                    <option value="country_Kenya_110" id="address_country_country_Kenya_110">Kenya</option>
                                    <option value="country_Kiribati_111" id="address_country_country_Kiribati_111">Kiribati</option>
                                    <option
                                        value="country_Korea__North_112"
                                        id="address_country_country_Korea__North_112">Korea, North (북조선)</option>
                                    <option
                                        value="country_Korea__South_113"
                                        id="address_country_country_Korea__South_113">Korea, South (한국)</option>
                                    <option value="country_Kuwait_114" id="address_country_country_Kuwait_114">Kuwait (الكويت)</option>
                                    <option
                                        value="country_Kyrgyzstan_115"
                                        id="address_country_country_Kyrgyzstan_115">Kyrgyzstan (Кыргызстан)</option>
                                    <option value="country_Laos_116" id="address_country_country_Laos_116">Laos (ເມືອງລາວ)</option>
                                    <option value="country_Latvia_117" id="address_country_country_Latvia_117">Latvia (Latvija)</option>
                                    <option value="country_Lebanon_118" id="address_country_country_Lebanon_118">Lebanon (لبنان)</option>
                                    <option value="country_Lesotho_119" id="address_country_country_Lesotho_119">Lesotho</option>
                                    <option value="country_Liberia_120" id="address_country_country_Liberia_120">Liberia</option>
                                    <option
                                        value="country_Libyan_Arab_Jamahiriya_121"
                                        id="address_country_country_Libyan_Arab_Jamahiriya_121">Libyan Arab Jamahiriya</option>
                                    <option
                                        value="country_Liechtenstein_122"
                                        id="address_country_country_Liechtenstein_122">Liechtenstein</option>
                                    <option
                                        value="country_Lithuania_123"
                                        id="address_country_country_Lithuania_123">Lithuania (Lietuva)</option>
                                    <option
                                        value="country_Luxembourg_124"
                                        id="address_country_country_Luxembourg_124">Luxembourg (Luxemburg • Lëtzebuerg)</option>
                                    <option value="country_Macau_125" id="address_country_country_Macau_125">Macau (澳门 • 澳門)</option>
                                    <option
                                        value="country_Macedonia_126"
                                        id="address_country_country_Macedonia_126">Macedonia (Македонија)</option>
                                    <option
                                        value="country_Madagascar_127"
                                        id="address_country_country_Madagascar_127">Madagascar (Madagasikara)</option>
                                    <option value="country_Malawi_128" id="address_country_country_Malawi_128">Malawi (Malaŵi)</option>
                                    <option value="country_Malaysia_129" id="address_country_country_Malaysia_129">Malaysia</option>
                                    <option value="country_Maldives_130" id="address_country_country_Maldives_130">Maldives (ދިވެހިރާއްޖެ)</option>
                                    <option value="country_Mali_131" id="address_country_country_Mali_131">Mali</option>
                                    <option value="country_Malta_132" id="address_country_country_Malta_132">Malta</option>
                                    <option
                                        value="country_Marshall_Islands_133"
                                        id="address_country_country_Marshall_Islands_133">Marshall Islands (Aelōn̄ in M̧ajeļ)</option>
                                    <option
                                        value="country_Mauritania_135"
                                        id="address_country_country_Mauritania_135">Mauritania (موريتانيا • Mauritanie)</option>
                                    <option
                                        value="country_Mauritius_136"
                                        id="address_country_country_Mauritius_136">Mauritius (Maurice)</option>
                                    <option value="country_Mayotte_137" id="address_country_country_Mayotte_137">Mayotte</option>
                                    <option value="country_Mexico_138" id="address_country_country_Mexico_138">Mexico (México • Mēxihco)</option>
                                    <option
                                        value="country_Micronesia_139"
                                        id="address_country_country_Micronesia_139">Micronesia</option>
                                    <option value="country_Moldova_140" id="address_country_country_Moldova_140">Moldova</option>
                                    <option value="country_Monaco_141" id="address_country_country_Monaco_141">Monaco</option>
                                    <option value="country_Mongolia_142" id="address_country_country_Mongolia_142">Mongolia (Монгол улс)</option>
                                    <option
                                        value="country_Montenegro_19668"
                                        id="address_country_country_Montenegro_19668">Montenegro (Црна Гора)</option>
                                    <option
                                        value="country_Montserrat_143"
                                        id="address_country_country_Montserrat_143">Montserrat</option>
                                    <option value="country_Morocco_144" id="address_country_country_Morocco_144">Morocco (المغرب)</option>
                                    <option
                                        value="country_Mozambique_145"
                                        id="address_country_country_Mozambique_145">Mozambique (Moçambique)</option>
                                    <option value="country_Myanmar_146" id="address_country_country_Myanmar_146">Myanmar</option>
                                    <option value="country_Namibia_147" id="address_country_country_Namibia_147">Namibia</option>
                                    <option value="country_Nauru_148" id="address_country_country_Nauru_148">Nauru</option>
                                    <option value="country_Nepal_149" id="address_country_country_Nepal_149">Nepal (नेपाल)</option>
                                    <option
                                        value="country_Netherlands_150"
                                        id="address_country_country_Netherlands_150">Netherlands (Nederland)</option>
                                    <option
                                        value="country_Netherlands_Antilles_151"
                                        id="address_country_country_Netherlands_Antilles_151">Netherlands Antilles</option>
                                    <option
                                        value="country_New_Caledonia_152"
                                        id="address_country_country_New_Caledonia_152">New Caledonia (Nouvelle-Calédonie)</option>
                                    <option
                                        value="country_New_Zealand_153"
                                        id="address_country_country_New_Zealand_153">New Zealand (Aotearoa)</option>
                                    <option
                                        value="country_Nicaragua_154"
                                        id="address_country_country_Nicaragua_154">Nicaragua</option>
                                    <option value="country_Niger_155" id="address_country_country_Niger_155">Niger</option>
                                    <option value="country_Nigeria_156" id="address_country_country_Nigeria_156">Nigeria</option>
                                    <option value="country_Niue_157" id="address_country_country_Niue_157">Niue</option>
                                    <option
                                        value="country_Norfolk_Island_158"
                                        id="address_country_country_Norfolk_Island_158">Norfolk Island</option>
                                    <option
                                        value="country_Northern_Mariana_Islands_159"
                                        id="address_country_country_Northern_Mariana_Islands_159">Northern Mariana Islands</option>
                                    <option value="country_Norway_160" id="address_country_country_Norway_160">Norway (Norge / Noreg)</option>
                                    <option value="country_Oman_161" id="address_country_country_Oman_161">Oman (عمان)</option>
                                    <option value="country_Pakistan_162" id="address_country_country_Pakistan_162">Pakistan (پاکستان)</option>
                                    <option value="country_Palau_163" id="address_country_country_Palau_163">Palau (Belau)</option>
                                    <option value="country_Panama_164" id="address_country_country_Panama_164">Panama (Panamá)</option>
                                    <option
                                        value="country_Papua_New_Guinea_165"
                                        id="address_country_country_Papua_New_Guinea_165">Papua New Guinea (Papua Niugini)</option>
                                    <option value="country_Paraguay_166" id="address_country_country_Paraguay_166">Paraguay (Paraguái)</option>
                                    <option value="country_Peru_167" id="address_country_country_Peru_167">Peru (Perú)</option>
                                    <option
                                        value="country_Philippines_168"
                                        id="address_country_country_Philippines_168">Philippines (Pilipinas)</option>
                                    <option value="country_Pitcairn_169" id="address_country_country_Pitcairn_169">Pitcairn</option>
                                    <option value="country_Poland_170" id="address_country_country_Poland_170">Poland (Polska)</option>
                                    <option value="country_Portugal_171" id="address_country_country_Portugal_171">Portugal</option>
                                    <option
                                        value="country_Puerto_Rico_172"
                                        id="address_country_country_Puerto_Rico_172">Puerto Rico</option>
                                    <option value="country_Qatar_173" id="address_country_country_Qatar_173">Qatar (دولة قطر)</option>
                                    <option value="country_Romania_175" id="address_country_country_Romania_175">Romania (România)</option>
                                    <option value="country_Russia_176" id="address_country_country_Russia_176">Russia (Россия)</option>
                                    <option value="country_Rwanda_177" id="address_country_country_Rwanda_177">Rwanda</option>
                                    <option
                                        value="country_Saint_Kitts_and_Nevis_178"
                                        id="address_country_country_Saint_Kitts_and_Nevis_178">Saint Kitts and Nevis</option>
                                    <option
                                        value="country_Saint_Lucia_179"
                                        id="address_country_country_Saint_Lucia_179">Saint Lucia</option>
                                    <option
                                        value="country_Saint_Vincent_and_the_Grenadines_180"
                                        id="address_country_country_Saint_Vincent_and_the_Grenadines_180">Saint Vincent and the Grenadines</option>
                                    <option value="country_Samoa_181" id="address_country_country_Samoa_181">Samoa (Sāmoa)</option>
                                    <option
                                        value="country_San_Marino_182"
                                        id="address_country_country_San_Marino_182">San Marino</option>
                                    <option
                                        value="country_Sao_Tome_and_Principe_183"
                                        id="address_country_country_Sao_Tome_and_Principe_183">Sao Tome and Principe (São Tomé e Príncipe)</option>
                                    <option
                                        value="country_Saudi_Arabia_184"
                                        id="address_country_country_Saudi_Arabia_184">Saudi Arabia (العربية السعودية)</option>
                                    <option value="country_Senegal_185" id="address_country_country_Senegal_185">Senegal (Sénégal)</option>
                                    <option value="country_Serbia_4503" id="address_country_country_Serbia_4503">Serbia (Србија)</option>
                                    <option
                                        value="country_Seychelles_186"
                                        id="address_country_country_Seychelles_186">Seychelles (Sesel)</option>
                                    <option
                                        value="country_Sierra_Leone_187"
                                        id="address_country_country_Sierra_Leone_187">Sierra Leone</option>
                                    <option
                                        value="country_Singapore_188"
                                        id="address_country_country_Singapore_188">Singapore (新加坡 • Singapura • சிங்கப்பூர்)</option>
                                    <option value="country_Slovakia_189" id="address_country_country_Slovakia_189">Slovakia (Slovensko)</option>
                                    <option value="country_Slovenia_190" id="address_country_country_Slovenia_190">Slovenia (Slovenija)</option>
                                    <option
                                        value="country_Solomon_Islands_191"
                                        id="address_country_country_Solomon_Islands_191">Solomon Islands</option>
                                    <option value="country_Somalia_192" id="address_country_country_Somalia_192">Somalia (Soomaaliya • الصومال)</option>
                                    <option
                                        value="country_South_Africa_193"
                                        id="address_country_country_South_Africa_193">South Africa (Suid-Afrika)</option>
                                    <option value="country_Spain_195" id="address_country_country_Spain_195">Spain (España)</option>
                                    <option
                                        value="country_Sri_Lanka_196"
                                        id="address_country_country_Sri_Lanka_196">Sri Lanka (ශ්‍රී ලංකාව • இலங்கை)</option>
                                    <option
                                        value="country_St__Helena_197"
                                        id="address_country_country_St__Helena_197">St. Helena</option>
                                    <option
                                        value="country_St__Pierre_and_Miquelon_198"
                                        id="address_country_country_St__Pierre_and_Miquelon_198">St. Pierre and Miquelon</option>
                                    <option value="country_Sudan_199" id="address_country_country_Sudan_199">Sudan (السودان)</option>
                                    <option value="country_Suriname_200" id="address_country_country_Suriname_200">Suriname</option>
                                    <option
                                        value="country_Svalbard_and_Jan_Mayen_Islands_201"
                                        id="address_country_country_Svalbard_and_Jan_Mayen_Islands_201">Svalbard and Jan Mayen Islands</option>
                                    <option
                                        value="country_Swaziland_202"
                                        id="address_country_country_Swaziland_202">Swaziland (eSwatini)</option>
                                    <option value="country_Sweden_203" id="address_country_country_Sweden_203">Sweden (Sverige)</option>
                                    <option
                                        value="country_Switzerland_204"
                                        id="address_country_country_Switzerland_204">Switzerland (Schweiz • Suisse • Svizzera • Svizra)</option>
                                    <option
                                        value="country_Syrian_Arab_Republic_205"
                                        id="address_country_country_Syrian_Arab_Republic_205">Syrian Arab Republic (سورية‎)</option>
                                    <option value="country_Taiwan_206" id="address_country_country_Taiwan_206">Taiwan (臺灣 • 台灣)</option>
                                    <option
                                        value="country_Tajikistan_207"
                                        id="address_country_country_Tajikistan_207">Tajikistan (Тоҷикистон)</option>
                                    <option value="country_Tanzania_208" id="address_country_country_Tanzania_208">Tanzania</option>
                                    <option value="country_Thailand_209" id="address_country_country_Thailand_209">Thailand (ประเทศไทย)</option>
                                    <option value="country_Togo_210" id="address_country_country_Togo_210">Togo</option>
                                    <option value="country_Tokelau_211" id="address_country_country_Tokelau_211">Tokelau</option>
                                    <option value="country_Tonga_212" id="address_country_country_Tonga_212">Tonga</option>
                                    <option
                                        value="country_Trinidad_and_Tobago_213"
                                        id="address_country_country_Trinidad_and_Tobago_213">Trinidad and Tobago</option>
                                    <option value="country_Tunisia_214" id="address_country_country_Tunisia_214">Tunisia (تونس‎)</option>
                                    <option value="country_Turkey_215" id="address_country_country_Turkey_215">Turkey (Türkiye)</option>
                                    <option
                                        value="country_Turkmenistan_216"
                                        id="address_country_country_Turkmenistan_216">Turkmenistan (Türkmenistan)</option>
                                    <option
                                        value="country_Turks_and_Caicos_Islands_217"
                                        id="address_country_country_Turks_and_Caicos_Islands_217">Turks and Caicos Islands</option>
                                    <option value="country_Tuvalu_218" id="address_country_country_Tuvalu_218">Tuvalu</option>
                                    <option value="country_Uganda_219" id="address_country_country_Uganda_219">Uganda</option>
                                    <option value="country_Ukraine_220" id="address_country_country_Ukraine_220">Ukraine (Україна)</option>
                                    <option
                                        value="country_United_Arab_Emirates_221"
                                        id="address_country_country_United_Arab_Emirates_221">United Arab Emirates (الإمارات العربية المتحدة)</option>
                                    <option
                                        value="country_United_Kingdom_222"
                                        id="address_country_country_United_Kingdom_222">United Kingdom</option>
                                    <option
                                        value="country_United_States_Minor_Outlying_Islands_224"
                                        id="address_country_country_United_States_Minor_Outlying_Islands_224">United States Minor Outlying Islands</option>
                                    <option
                                        value="country_United_States_of_America_223"
                                        id="address_country_country_United_States_of_America_223">United States of America</option>
                                    <option value="country_Uruguay_225" id="address_country_country_Uruguay_225">Uruguay</option>
                                    <option
                                        value="country_Uzbekistan_226"
                                        id="address_country_country_Uzbekistan_226">Uzbekistan (Oʻzbekiston)</option>
                                    <option value="country_Vanuatu_227" id="address_country_country_Vanuatu_227">Vanuatu</option>
                                    <option
                                        value="country_Vatican_City_State__Holy_See__228"
                                        id="address_country_country_Vatican_City_State__Holy_See__228">Vatican City State (Vaticanum)</option>
                                    <option
                                        value="country_Venezuela_229"
                                        id="address_country_country_Venezuela_229">Venezuela</option>
                                    <option value="country_Vietnam_230" id="address_country_country_Vietnam_230">Vietnam (Việt Nam)</option>
                                    <option
                                        value="country_Virgin_Islands__British__231"
                                        id="address_country_country_Virgin_Islands__British__231">Virgin Islands (British)</option>
                                    <option
                                        value="country_Virgin_Islands__U_S___232"
                                        id="address_country_country_Virgin_Islands__U_S___232">Virgin Islands (U.S.)</option>
                                    <option
                                        value="country_Wallis_and_Futuna_Islands_233"
                                        id="address_country_country_Wallis_and_Futuna_Islands_233">Wallis and Futuna Islands</option>
                                    <option
                                        value="country_Western_Sahara_234"
                                        id="address_country_country_Western_Sahara_234">Western Sahara (الصحراء الغربية)</option>
                                    <option value="country_Yemen_235" id="address_country_country_Yemen_235">Yemen (اليمن)</option>
                                    <option value="country_Zaire_237" id="address_country_country_Zaire_237">Zaire</option>
                                    <option value="country_Zambia_238" id="address_country_country_Zambia_238">Zambia</option>
                                    <option value="country_Zimbabwe_239" id="address_country_country_Zimbabwe_239">Zimbabwe</option>
                                </select>
                                <span class="hikashop_field_required">*</span>
                            </div>
                        </div>
                        <div
                            class="control-group hikashop_registration_address_state_line"
                            id="hikashop_address_address_state">
                            <div class="control-label">
                                <label for="address_state">State</label>
                            </div>
                            <div class="controls">
                                <span id="data_address_address_state_container">
                                    <select
                                        id="data_address_address_state"
                                        name="data[address][address_state]"
                                        size="1"
                                        class="hikashop_field_dropdown">
                                        <option
                                            value="state_Ain_1306"
                                            id="data_address_address_state_state_Ain_1306"
                                            selected="selected">Ain</option>
                                        <option
                                            value="state_Aisne_1307"
                                            id="data_address_address_state_state_Aisne_1307">Aisne</option>
                                        <option
                                            value="state_Allier_1308"
                                            id="data_address_address_state_state_Allier_1308">Allier</option>
                                        <option
                                            value="state_Alpes_de_Haute_Provence_1309"
                                            id="data_address_address_state_state_Alpes_de_Haute_Provence_1309">Alpes-de-Haute-Provence</option>
                                        <option
                                            value="state_Alpes_Maritimes_1311"
                                            id="data_address_address_state_state_Alpes_Maritimes_1311">Alpes-Maritimes</option>
                                        <option
                                            value="state_Ard__che_1312"
                                            id="data_address_address_state_state_Ard__che_1312">Ardèche</option>
                                        <option
                                            value="state_Ardennes_1313"
                                            id="data_address_address_state_state_Ardennes_1313">Ardennes</option>
                                        <option
                                            value="state_Ari__ge_1314"
                                            id="data_address_address_state_state_Ari__ge_1314">Ariège</option>
                                        <option value="state_Aube_1315" id="data_address_address_state_state_Aube_1315">Aube</option>
                                        <option value="state_Aude_1316" id="data_address_address_state_state_Aude_1316">Aude</option>
                                        <option
                                            value="state_Aveyron_1317"
                                            id="data_address_address_state_state_Aveyron_1317">Aveyron</option>
                                        <option
                                            value="state_Bas_Rhin_1373"
                                            id="data_address_address_state_state_Bas_Rhin_1373">Bas-Rhin</option>
                                        <option
                                            value="state_Bouches_du_Rh__ne_1318"
                                            id="data_address_address_state_state_Bouches_du_Rh__ne_1318">Bouches-du-Rhône</option>
                                        <option
                                            value="state_Calvados_1319"
                                            id="data_address_address_state_state_Calvados_1319">Calvados</option>
                                        <option
                                            value="state_Cantal_1320"
                                            id="data_address_address_state_state_Cantal_1320">Cantal</option>
                                        <option
                                            value="state_Charente_1321"
                                            id="data_address_address_state_state_Charente_1321">Charente</option>
                                        <option
                                            value="state_Charente_Maritime_1322"
                                            id="data_address_address_state_state_Charente_Maritime_1322">Charente-Maritime</option>
                                        <option value="state_Cher_1323" id="data_address_address_state_state_Cher_1323">Cher</option>
                                        <option
                                            value="state_Corr__ze_1324"
                                            id="data_address_address_state_state_Corr__ze_1324">Corrèze</option>
                                        <option
                                            value="state_Corse_du_Sud_1334"
                                            id="data_address_address_state_state_Corse_du_Sud_1334">Corse-du-Sud</option>
                                        <option
                                            value="state_C__te_d_Or_1325"
                                            id="data_address_address_state_state_C__te_d_Or_1325">Côte-d'Or</option>
                                        <option
                                            value="state_C__tes_d_Armor_1326"
                                            id="data_address_address_state_state_C__tes_d_Armor_1326">Côtes-d'Armor</option>
                                        <option
                                            value="state_Creuse_1327"
                                            id="data_address_address_state_state_Creuse_1327">Creuse</option>
                                        <option
                                            value="state_Deux_S__vres_1385"
                                            id="data_address_address_state_state_Deux_S__vres_1385">Deux-Sèvres</option>
                                        <option
                                            value="state_Dordogne_1328"
                                            id="data_address_address_state_state_Dordogne_1328">Dordogne</option>
                                        <option
                                            value="state_Doubs_1329"
                                            id="data_address_address_state_state_Doubs_1329">Doubs</option>
                                        <option
                                            value="state_Dr__me_1330"
                                            id="data_address_address_state_state_Dr__me_1330">Drôme</option>
                                        <option
                                            value="state_Essonne_1397"
                                            id="data_address_address_state_state_Essonne_1397">Essonne</option>
                                        <option value="state_Eure_1331" id="data_address_address_state_state_Eure_1331">Eure</option>
                                        <option
                                            value="state_Eure_et_Loir_1332"
                                            id="data_address_address_state_state_Eure_et_Loir_1332">Eure-et-Loir</option>
                                        <option
                                            value="state_Finist__re_1333"
                                            id="data_address_address_state_state_Finist__re_1333">Finistère</option>
                                        <option value="state_Gard_1336" id="data_address_address_state_state_Gard_1336">Gard</option>
                                        <option value="state_Gers_1338" id="data_address_address_state_state_Gers_1338">Gers</option>
                                        <option
                                            value="state_Gironde_1339"
                                            id="data_address_address_state_state_Gironde_1339">Gironde</option>
                                        <option
                                            value="country_Guadeloupe_87"
                                            id="data_address_address_state_country_Guadeloupe_87">Guadeloupe</option>
                                        <option
                                            value="state_Haut_Rhin_1374"
                                            id="data_address_address_state_state_Haut_Rhin_1374">Haut-Rhin</option>
                                        <option
                                            value="state_Haute_Corse_1335"
                                            id="data_address_address_state_state_Haute_Corse_1335">Haute-Corse</option>
                                        <option
                                            value="state_Haute_Garonne_1337"
                                            id="data_address_address_state_state_Haute_Garonne_1337">Haute-Garonne</option>
                                        <option
                                            value="state_Haute_Loire_1349"
                                            id="data_address_address_state_state_Haute_Loire_1349">Haute-Loire</option>
                                        <option
                                            value="state_Haute_Marne_1358"
                                            id="data_address_address_state_state_Haute_Marne_1358">Haute-Marne</option>
                                        <option
                                            value="state_Haute_Sa__ne_1376"
                                            id="data_address_address_state_state_Haute_Sa__ne_1376">Haute-Saône</option>
                                        <option
                                            value="state_Haute_Savoie_1380"
                                            id="data_address_address_state_state_Haute_Savoie_1380">Haute-Savoie</option>
                                        <option
                                            value="state_Haute_Vienne_1393"
                                            id="data_address_address_state_state_Haute_Vienne_1393">Haute-Vienne</option>
                                        <option
                                            value="state_Hautes_Alpes_1310"
                                            id="data_address_address_state_state_Hautes_Alpes_1310">Hautes-Alpes</option>
                                        <option
                                            value="state_Hautes_Pyr__n__es_1371"
                                            id="data_address_address_state_state_Hautes_Pyr__n__es_1371">Hautes-Pyrénées</option>
                                        <option
                                            value="state_Hauts_de_Seine_1398"
                                            id="data_address_address_state_state_Hauts_de_Seine_1398">Hauts-de-Seine</option>
                                        <option
                                            value="state_H__rault_1340"
                                            id="data_address_address_state_state_H__rault_1340">Hérault</option>
                                        <option
                                            value="state_Ille_et_Vilaine_1341"
                                            id="data_address_address_state_state_Ille_et_Vilaine_1341">Ille-et-Vilaine</option>
                                        <option
                                            value="state_Indre_1342"
                                            id="data_address_address_state_state_Indre_1342">Indre</option>
                                        <option
                                            value="state_Indre_et_Loire_1343"
                                            id="data_address_address_state_state_Indre_et_Loire_1343">Indre-et-Loire</option>
                                        <option
                                            value="state_Is__re_1344"
                                            id="data_address_address_state_state_Is__re_1344">Isère</option>
                                        <option value="state_Jura_1345" id="data_address_address_state_state_Jura_1345">Jura</option>
                                        <option
                                            value="state_Landes_1346"
                                            id="data_address_address_state_state_Landes_1346">Landes</option>
                                        <option
                                            value="state_Loir_et_Cher_1347"
                                            id="data_address_address_state_state_Loir_et_Cher_1347">Loir-et-Cher</option>
                                        <option
                                            value="state_Loire_1348"
                                            id="data_address_address_state_state_Loire_1348">Loire</option>
                                        <option
                                            value="state_Loire_Atlantique_1350"
                                            id="data_address_address_state_state_Loire_Atlantique_1350">Loire-Atlantique</option>
                                        <option
                                            value="state_Loiret_1351"
                                            id="data_address_address_state_state_Loiret_1351">Loiret</option>
                                        <option value="state_Lot_1352" id="data_address_address_state_state_Lot_1352">Lot</option>
                                        <option
                                            value="state_Lot_et_Garonne_1353"
                                            id="data_address_address_state_state_Lot_et_Garonne_1353">Lot-et-Garonne</option>
                                        <option
                                            value="state_Loz__re_1354"
                                            id="data_address_address_state_state_Loz__re_1354">Lozère</option>
                                        <option
                                            value="state_Maine_et_Loire_1355"
                                            id="data_address_address_state_state_Maine_et_Loire_1355">Maine-et-Loire</option>
                                        <option
                                            value="state_Manche_1356"
                                            id="data_address_address_state_state_Manche_1356">Manche</option>
                                        <option
                                            value="state_Marne_1357"
                                            id="data_address_address_state_state_Marne_1357">Marne</option>
                                        <option
                                            value="country_Martinique_134"
                                            id="data_address_address_state_country_Martinique_134">Martinique</option>
                                        <option
                                            value="state_Mayenne_1359"
                                            id="data_address_address_state_state_Mayenne_1359">Mayenne</option>
                                        <option
                                            value="state_Mayotte_1406"
                                            id="data_address_address_state_state_Mayotte_1406">Mayotte</option>
                                        <option
                                            value="state_Meurthe_et_Moselle_1360"
                                            id="data_address_address_state_state_Meurthe_et_Moselle_1360">Meurthe-et-Moselle</option>
                                        <option
                                            value="state_Meuse_1361"
                                            id="data_address_address_state_state_Meuse_1361">Meuse</option>
                                        <option
                                            value="state_Morbihan_1362"
                                            id="data_address_address_state_state_Morbihan_1362">Morbihan</option>
                                        <option
                                            value="state_Moselle_1363"
                                            id="data_address_address_state_state_Moselle_1363">Moselle</option>
                                        <option
                                            value="state_Ni__vre_1364"
                                            id="data_address_address_state_state_Ni__vre_1364">Nièvre</option>
                                        <option value="state_Nord_1365" id="data_address_address_state_state_Nord_1365">Nord</option>
                                        <option value="state_Oise_1366" id="data_address_address_state_state_Oise_1366">Oise</option>
                                        <option value="state_Orne_1367" id="data_address_address_state_state_Orne_1367">Orne</option>
                                        <option
                                            value="state_Paris_1381"
                                            id="data_address_address_state_state_Paris_1381">Paris</option>
                                        <option
                                            value="state_Pas_de_Calais_1368"
                                            id="data_address_address_state_state_Pas_de_Calais_1368">Pas-de-Calais</option>
                                        <option
                                            value="state_Polyn__sie_Fran__aise_1403"
                                            id="data_address_address_state_state_Polyn__sie_Fran__aise_1403">Polynésie Française</option>
                                        <option
                                            value="state_Puy_de_D__me_1369"
                                            id="data_address_address_state_state_Puy_de_D__me_1369">Puy-de-Dôme</option>
                                        <option
                                            value="state_Pyr__n__es_Atlantiques_1370"
                                            id="data_address_address_state_state_Pyr__n__es_Atlantiques_1370">Pyrénées-Atlantiques</option>
                                        <option
                                            value="state_Pyr__n__es_Orientales_1372"
                                            id="data_address_address_state_state_Pyr__n__es_Orientales_1372">Pyrénées-Orientales</option>
                                        <option
                                            value="country_Reunion_174"
                                            id="data_address_address_state_country_Reunion_174">Reunion</option>
                                        <option
                                            value="state_Rh__ne_1375"
                                            id="data_address_address_state_state_Rh__ne_1375">Rhône</option>
                                        <option
                                            value="state_Saint_Pierre_et_Miquelon_1404"
                                            id="data_address_address_state_state_Saint_Pierre_et_Miquelon_1404">Saint-Pierre et Miquelon</option>
                                        <option
                                            value="state_Sa__ne_et_Loire_1377"
                                            id="data_address_address_state_state_Sa__ne_et_Loire_1377">Saône-et-Loire</option>
                                        <option
                                            value="state_Sarthe_1378"
                                            id="data_address_address_state_state_Sarthe_1378">Sarthe</option>
                                        <option
                                            value="state_Savoie_1379"
                                            id="data_address_address_state_state_Savoie_1379">Savoie</option>
                                        <option
                                            value="state_Seine_et_Marne_1383"
                                            id="data_address_address_state_state_Seine_et_Marne_1383">Seine-et-Marne</option>
                                        <option
                                            value="state_Seine_Maritime_1382"
                                            id="data_address_address_state_state_Seine_Maritime_1382">Seine-Maritime</option>
                                        <option
                                            value="state_Seine_Saint_Denis_1399"
                                            id="data_address_address_state_state_Seine_Saint_Denis_1399">Seine-Saint-Denis</option>
                                        <option
                                            value="state_Somme_1386"
                                            id="data_address_address_state_state_Somme_1386">Somme</option>
                                        <option value="state_Tarn_1387" id="data_address_address_state_state_Tarn_1387">Tarn</option>
                                        <option
                                            value="state_Tarn_et_Garonne_1388"
                                            id="data_address_address_state_state_Tarn_et_Garonne_1388">Tarn-et-Garonne</option>
                                        <option
                                            value="state_Terres_australes_et_antarctiques_fran__aises_1405"
                                            id="data_address_address_state_state_Terres_australes_et_antarctiques_fran__aises_1405">Terres australes et antarctiques françaises</option>
                                        <option
                                            value="state_Territoire_de_Belfort_1396"
                                            id="data_address_address_state_state_Territoire_de_Belfort_1396">Territoire de Belfort</option>
                                        <option
                                            value="state_Territoire_des___les_Wallis_et_Futuna_1407"
                                            id="data_address_address_state_state_Territoire_des___les_Wallis_et_Futuna_1407">Territoire des îles Wallis et Futuna</option>
                                        <option
                                            value="state_Territoire_des_Nouvelle_Cal__donie_et_Dependances_1402"
                                            id="data_address_address_state_state_Territoire_des_Nouvelle_Cal__donie_et_Dependances_1402">Territoire des Nouvelle-Calédonie et Dependances</option>
                                        <option
                                            value="state_Val_d_Oise_1401"
                                            id="data_address_address_state_state_Val_d_Oise_1401">Val-d'Oise</option>
                                        <option
                                            value="state_Val_de_Marne_1400"
                                            id="data_address_address_state_state_Val_de_Marne_1400">Val-de-Marne</option>
                                        <option value="state_Var_1389" id="data_address_address_state_state_Var_1389">Var</option>
                                        <option
                                            value="state_Vaucluse_1390"
                                            id="data_address_address_state_state_Vaucluse_1390">Vaucluse</option>
                                        <option
                                            value="state_Vend__e_1391"
                                            id="data_address_address_state_state_Vend__e_1391">Vendée</option>
                                        <option
                                            value="state_Vienne_1392"
                                            id="data_address_address_state_state_Vienne_1392">Vienne</option>
                                        <option
                                            value="state_Vosges_1394"
                                            id="data_address_address_state_state_Vosges_1394">Vosges</option>
                                        <option
                                            value="state_Yonne_1395"
                                            id="data_address_address_state_state_Yonne_1395">Yonne</option>
                                        <option
                                            value="state_Yvelines_1384"
                                            id="data_address_address_state_state_Yvelines_1384">Yvelines</option>
                                    </select>
                                </span>
                                <input
                                    type="hidden"
                                    id="data_address_address_state_default_value"
                                    name="data_address_address_state_default_value"
                                    value=""/></div>
                        </div>

                        <div class="control-group hikashop_registration_required_info_line">
                            <div class="controls">Fields marked with an asterisk (*) are required.</div>
                        </div>
                        <input type="hidden" name="data[register][id]" value="0"/>
                        <input type="hidden" name="data[register][gid]" value="0"/>
                        <div class="control-group">
                            <div class="controls">
                                <input
                                    type="submit"
                                    class="btn button hikashop_cart_input_button btn btn-primary"
                                    name="register"
                                    value="Register"
                                    onclick="var field=document.getElementById('hikashop_product_quantity_field_1'); hikashopSubmitForm('hikashop_registration_form', 'register'); return false;"
                                    id="hikashop_register_form_button"/></div>
                        </div>
                    </fieldset>
                </fieldset>
            </div>
        </form>
        <!-- HikaShop Component powered by http://www.hikashop.com -->
        <!-- version Business : 2.6.2 [1604182302] -->

    </div>
</div>
@endsection