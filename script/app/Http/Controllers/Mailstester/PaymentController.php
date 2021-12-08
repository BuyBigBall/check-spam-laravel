<?php

namespace App\Http\Controllers\Mailstester;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Session;
use App\Models\Settings;
use App\Models\Profile;
use App\Models\TestResult;
use App\Models\WhiteLabel;
use App\Models\Transaction;
use App\Models\Balance;
use App\Models\TrashMail;
use App\Models\Coupon;
use App\Models\MicroPayment;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Cache;
use Vinkla\Hashids\Facades\Hashids;
use Carbon\Carbon;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\OpenGraph;

use App\Models\Menu;
use \Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use App\Models\Language;
use Illuminate\Support\Facades\Auth;
use Srmklive\PayPal\Services\PayPal as PayPalClient;
use Stripe\Checkout\Session as StripeSession;
use Stripe\Stripe;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Validation\Rule;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use DB;

class PaymentController extends Controller
{
    protected $price_count = [50=>500, 80=>1000, 250=>5000, 700=>20000, 2500=>100000, 20000=>1000000];
    public static $micropay_plans = [
        1=>['amount'=>1, 'unit'=>'€', 'limit'=>1, 'expire'=>null, 'description'=>'Get access to the result of this test only'],
        2=>['amount'=>3, 'unit'=>'€', 'limit'=>5, 'expire'=>null, 'description'=>'Get access to the next 5 tests you perform'],
        3=>['amount'=>3, 'unit'=>'€', 'limit'=>10, 'expire'=>null, 'description'=>'Get access to the next 10 tests you perform'],
        4=>['amount'=>5, 'unit'=>'€', 'limit'=>20, 'expire'=>null, 'description'=>'Get access to the next 20 tests you perform'],
        5=>['amount'=>5, 'unit'=>'€', 'limit'=>30, 'expire'=>null, 'description'=>'Get access to the next 30 tests you perform'],
        6=>['amount'=>5, 'unit'=>'€', 'limit'=>null, 'expire'=>48, 'description'=>'Get Perform as many tests as you want in the next 48 hours'],
        7=>['amount'=>10, 'unit'=>'€', 'limit'=>null, 'expire'=>168, 'description'=>'Perform as many tests as you want during the next 7 days'],
        8=>['amount'=>25, 'unit'=>'€', 'limit'=>null, 'expire'=>720, 'description'=>'Perform as many tests as you want during the next 30 days'],
        9=>['amount'=>200, 'unit'=>'€', 'limit'=>null, 'expire'=>8760, 'description'=>'Perform as many tests as you want during a year'],
    ];

    public static $countries = [
	        "country_Afghanistan_1" => "Afghanistan (افغانستان)" ,
	        "country_Albania_2" => "Albania (Shqipëria)" ,
	        "country_Algeria_3" => "Algeria (الجزائر)" ,
	        "country_American_Samoa_4" => "American Samoa" ,
	        "country_Andorra_5" => "Andorra" ,
	        "country_Angola_6" => "Angola" ,
	        "country_Anguilla_7" => "Anguilla" ,
	        "country_Antarctica_8" => "Antarctica" ,
	        "country_Antigua_and_Barbuda_9" => "Antigua and Barbuda" ,
	        "country_Argentina_10" => "Argentina" ,
	        "country_Armenia_11" => "Armenia (Հայաստան)" ,
	        "country_Aruba_12" => "Aruba" ,
	        "country_Australia_13" => "Australia" ,
	        "country_Austria_14" => "Austria (Österreich)" ,
	        "country_Azerbaijan_15" => "Azerbaijan (Azərbaycan)" ,
	        "country_Bahamas_16" => "Bahamas" ,
	        "country_Bahrain_17" => "Bahrain (البحرين)" ,
	        "country_Bangladesh_18" => "Bangladesh (বাংলাদেশ')" ,
	        "country_Barbados_19" => "Barbados" ,
	        "country_Belarus_20" => "Belarus (Беларусь)" ,
	        "country_Belgium_21" => "Belgium (België • Belgique • Belgien)" ,
	        "country_Belize_22" => "Belize" ,
	        "country_Benin_23" => "Benin" ,
	        "country_Bermuda_24" => "Bermuda" ,
	        "country_Bhutan_25" => "Bhutan (འབྲུག་ཡུལ་)" ,
	        "country_Bolivia_26" => "Bolivia (Wuliwya • Volívia • Buliwya)" ,
	        "country_Bosnia_and_Herzegowina_27" => "Bosnia and Herzegowina (Bosna i Hercegovina)" ,
	        "country_Botswana_28" => "Botswana" ,
	        "country_Bouvet_Island_29" => "Bouvet Island" ,
	        "country_Brazil_30" => "Brazil" ,
	        "country_British_Indian_Ocean_Territory_31" => "British Indian Ocean Territory" ,
	        "country_Brunei_Darussalam_32" => "Brunei Darussalam" ,
	        "country_Bulgaria_33" => "Bulgaria (България)" ,
	        "country_Burkina_Faso_34" => "Burkina Faso" ,
	        "country_Burundi_35" => "Burundi (Uburundi)" ,
	        "country_Cambodia_36" => "Cambodia (កម្ពុជា)" ,
	        "country_Cameroon_37" => "Cameroon (Cameroun)" ,
	        "country_Canada_38" => "Canada" ,
	        "country_Cape_Verde_39" => "Cape Verde (Cabo Verde)" ,
	        "country_Cayman_Islands_40" => "Cayman Islands" ,
	        "country_Central_African_Republic_41" => "Central African Republic (Centrafrique • Bêafrîka)" ,
	        "country_Chad_42" => "Chad (Tchad • تشاد)" ,
	        "country_Chile_43" => "Chile" ,
	        "country_China_44" => "China (中國 • 中国)" ,
	        "country_Christmas_Island_45" => "Christmas Island" ,
	        "country_Cocos__Keeling__Islands_46" => "Cocos (Keeling) Islands" ,
	        "country_Colombia_47" => "Colombia" ,
	        "country_Comoros_48" => "Comoros (Komori • Comores • جزر القمر)" ,
	        "country_Congo_49" => "Congo" ,
	        "country_Cook_Islands_50" => "Cook Islands" ,
	        "country_Costa_Rica_51" => "Costa Rica" ,
	        "country_Cote_D_Ivoire_52" => "Cote D'Ivoire" ,
	        "country_Croatia_53" => "Croatia (Hrvatska)" ,
	        "country_Cuba_54" => "Cuba" ,
	        "country_Cyprus_55" => "Cyprus (Κύπρος • Kıbrıs)" ,
	        "country_Czech_Republic_56" => "Czech Republic (Česko)" ,
	        "country_Denmark_57" => "Denmark (Danmark)" ,
	        "country_Djibouti_58" => "Djibouti (جيبوتي)" ,
	        "country_Dominica_59" => "Dominica" ,
	        "country_Dominican_Republic_60" => "Dominican Republic (República Dominicana)" ,
	        "country_East_Timor_61" => "East Timor (Timór-Leste)" ,
	        "country_Ecuador_62" => "Ecuador" ,
	        "country_Egypt_63" => "Egypt (مصر)" ,
	        "country_El_Salvador_64" => "El Salvador" ,
	        "country_Equatorial_Guinea_65" => "Equatorial Guinea (Guinée équatoriale)" ,
	        "country_Eritrea_66" => "Eritrea (ኤርትራ • إرتريا)" ,
	        "country_Estonia_67" => "Estonia (Eesti)" ,
	        "country_Ethiopia_68" => "Ethiopia (ኢትዮጵያ)" ,
	        "country_Falkland_Islands__Malvinas__69" => "Falkland Islands (Malvinas)" ,
	        "country_Faroe_Islands_70" => "Faroe Islands" ,
	        "country_Fiji_71" => "Fiji (Viti • फ़िजी)" ,
	        "country_Finland_72" => "Finland (Suomi)" ,
	        "country_France_73" => "France" ,
	        "country_French_Guiana_75" => "French Guiana" ,
	        "country_French_Polynesia_76" => "French Polynesia" ,
	        "country_French_Southern_Territories_77" => "French Southern Territories" ,
	        "country_Gabon_78" => "Gabon" ,
	        "country_Gambia_79" => "Gambia" ,
	        "country_Georgia_80" => "Georgia (საქართველო)" ,
	        "country_Germany_81" => "Germany (Deutschland)" ,
	        "country_Ghana_82" => "Ghana" ,
	        "country_Gibraltar_83" => "Gibraltar" ,
	        "country_Greece_84" => "Greece (Ελλάδα)" ,
	        "country_Greenland_85" => "Greenland" ,
	        "country_Grenada_86" => "Grenada" ,
	        "country_Guam_88" => "Guam" ,
	        "country_Guatemala_89" => "Guatemala" ,
	        "country_Guinea_90" => "Guinea (Guinée)" ,
	        "country_Guinea_Bissau_91" => "Guinea-Bissau (Guiné-Bissau)" ,
	        "country_Guyana_92" => "Guyana" ,
	        "country_Haiti_93" => "Haiti (Haïti • Ayiti)" ,
	        "country_Heard_and_McDonald_Islands_94" => "Heard and McDonald Islands" ,
	        "country_Honduras_95" => "Honduras" ,
	        "country_Hong_Kong_96" => "Hong Kong (香港)" ,
	        "country_Hungary_97" => "Hungary (Magyarország)" ,
	        "country_Iceland_98" => "Iceland (Ísland)" ,
	        "country_India_99" => "India (भारत)" ,
	        "country_Indonesia_100" => "Indonesia" ,
	        "country_Iran_101" => "Iran (ايران)" ,
	        "country_Iraq_102" => "Iraq (عێراق • العراق)" ,
	        "country_Ireland_103" => "Ireland (Éire)" ,
	        "country_Israel_104" => "Israel (إسرائيل • ישראל)" ,
	        "country_Italy_105" => "Italy (Italia)" ,
	        "country_Jamaica_106" => "Jamaica" ,
	        "country_Japan_107" => "Japan (日本)" ,
	        "country_Jordan_108" => "Jordan (الأردنّ)" ,
	        "country_Kazakhstan_109" => "Kazakhstan (Қазақстан)" ,
	        "country_Kenya_110" => "Kenya" ,
	        "country_Kiribati_111" => "Kiribati" ,
	        "country_Korea__North_112" => "Korea, North (북조선)" ,
	        "country_Korea__South_113" => "Korea, South (한국)" ,
	        "country_Kuwait_114" => "Kuwait (الكويت)" ,
	        "country_Kyrgyzstan_115" => "Kyrgyzstan (Кыргызстан)" ,
	        "country_Laos_116" => "Laos (ເມືອງລາວ)" ,
	        "country_Latvia_117" => "Latvia (Latvija)" ,
	        "country_Lebanon_118" => "Lebanon (لبنان)" ,
	        "country_Lesotho_119" => "Lesotho" ,
	        "country_Liberia_120" => "Liberia" ,
	        "country_Libyan_Arab_Jamahiriya_121" => "Libyan Arab Jamahiriya" ,
	        "country_Liechtenstein_122" => "Liechtenstein" ,
	        "country_Lithuania_123" => "Lithuania (Lietuva)" ,
	        "country_Luxembourg_124" => "Luxembourg (Luxemburg • Lëtzebuerg)" ,
	        "country_Macau_125" => "Macau (澳门 • 澳門)" ,
	        "country_Macedonia_126" => "Macedonia (Македонија)" ,
	        "country_Madagascar_127" => "Madagascar (Madagasikara)" ,
	        "country_Malawi_128" => "Malawi" ,
	        "country_Malaysia_129" => "Malaysia" ,
	        "country_Maldives_130" => "Maldives (ދިވެހިރާއްޖެ)" ,
	        "country_Mali_131" => "Mali" ,
	        "country_Malta_132" => "Malta" ,
	        "country_Marshall_Islands_133" => "Marshall Islands (Aelōn̄ in M̧ajeļ)" ,
	        "country_Mauritania_135" => "Mauritania (موريتانيا • Mauritanie)" ,
	        "country_Mauritius_136" => "Mauritius (Maurice)" ,
	        "country_Mayotte_137" => "Mayotte" ,
	        "country_Mexico_138" => "Mexico (México • Mēxihco)" ,
	        "country_Micronesia_139" => "Micronesia" ,
	        "country_Moldova_140" => "Moldova" ,
	        "country_Monaco_141" => "Monaco" ,
	        "country_Mongolia_142" => "Mongolia (Монгол улс)" ,
	        "country_Montenegro_19668" => "Montenegro (Црна Гора)" ,
	        "country_Montserrat_143" => "Montserrat" ,
	        "country_Morocco_144" => "Morocco (المغرب)" ,
	        "country_Mozambique_145" => "Mozambique (Moçambique)" ,
	        "country_Myanmar_146" => "Myanmar" ,
	        "country_Namibia_147" => "Namibia" ,
	        "country_Nauru_148" => "Nauru" ,
	        "country_Nepal_149" => "Nepal (नेपाल)" ,
	        "country_Netherlands_150" => "Netherlands (Nederland)" ,
	        "country_Netherlands_Antilles_151" => "Netherlands Antilles" ,
	        "country_New_Caledonia_152" => "New Caledonia (Nouvelle-Calédonie)" ,
	        "country_New_Zealand_153" => "New Zealand (Aotearoa)" ,
	        "country_Nicaragua_154" => "Nicaragua" ,
	        "country_Niger_155" => "Niger" ,
	        "country_Nigeria_156" => "Nigeria" ,
	        "country_Niue_157" => "Niue" ,
	        "country_Norfolk_Island_158" => "Norfolk Island" ,
	        "country_Northern_Mariana_Islands_159" => "Northern Mariana Islands" ,
	        "country_Norway_160" => "Norway (Norge / Noreg)" ,
	        "country_Oman_161" => "Oman (عمان)" ,
	        "country_Pakistan_162" => "Pakistan (پاکستان)" ,
	        "country_Palau_163" => "Palau (Belau)" ,
	        "country_Panama_164" => "Panama" ,
	        "country_Papua_New_Guinea_165" => "Papua New Guinea (Papua Niugini)" ,
	        "country_Paraguay_166" => "Paraguay (Paraguái)" ,
	        "country_Peru_167" => "Peru" ,
	        "country_Philippines_168" => "Philippines (Pilipinas)" ,
	        "country_Pitcairn_169" => "Pitcairn" ,
	        "country_Poland_170" => "Poland (Polska)" ,
	        "country_Portugal_171" => "Portugal" ,
	        "country_Puerto_Rico_172" => "Puerto Rico" ,
	        "country_Qatar_173" => "Qatar (دولة قطر)" ,
	        "country_Romania_175" => "Romania" ,
	        "country_Russia_176" => "Russia (Россия)" ,
	        "country_Rwanda_177" => "Rwanda" ,
	        "country_Saint_Kitts_and_Nevis_178" => "Saint Kitts and Nevis" ,
	        "country_Saint_Lucia_179" => "Saint Lucia" ,
	        "country_Saint_Vincent_and_the_Grenadines_180" => "Saint Vincent and the Grenadines" ,
	        "country_Samoa_181" => "Samoa" ,
	        "country_San_Marino_182" => "San Marino" ,
	        "country_Sao_Tome_and_Principe_183" => "Sao Tome and Principe (São Tomé e Príncipe)" ,
	        "country_Saudi_Arabia_184" => "Saudi Arabia (العربية السعودية)" ,
	        "country_Senegal_185" => "Senegal" ,
	        "country_Serbia_4503" => "Serbia (Србија)" ,
	        "country_Seychelles_186" => "Seychelles (Sesel)" ,
	        "country_Sierra_Leone_187" => "Sierra Leone" ,
	        "country_Singapore_188" => "Singapore (新加坡 • Singapura • சிங்கப்பூர்)" ,
	        "country_Slovakia_189" => "Slovakia (Slovensko)" ,
	        "country_Slovenia_190" => "Slovenia (Slovenija)" ,
	        "country_Solomon_Islands_191" => "Solomon Islands" ,
	        "country_Somalia_192" => "Somalia (Soomaaliya • الصومال)" ,
	        "country_South_Africa_193" => "South Africa (Suid-Afrika)" ,
	        "country_Spain_195" => "Spain (España)" ,
	        "country_Sri_Lanka_196" => "Sri Lanka (ශ්‍රී ලංකාව • இலங்கை)" ,
	        "country_St__Helena_197" => "St. Helena" ,
	        "country_St__Pierre_and_Miquelon_198" => "St. Pierre and Miquelon" ,
	        "country_Sudan_199" => "Sudan (السودان)" ,
	        "country_Suriname_200" => "Suriname" ,
	        "country_Svalbard_and_Jan_Mayen_Islands_201" => "Svalbard and Jan Mayen Islands" ,
	        "country_Swaziland_202" => "Swaziland (eSwatini)" ,
	        "country_Sweden_203" => "Sweden (Sverige)" ,
	        "country_Switzerland_204" => "Switzerland (Schweiz • Suisse • Svizzera • Svizra)" ,
	        "country_Syrian_Arab_Republic_205" => "Syrian Arab Republic (سورية)" ,
	        "country_Taiwan_206" => "Taiwan (臺灣 • 台灣)" ,
	        "country_Tajikistan_207" => "Tajikistan (Тоҷикистон)" ,
	        "country_Tanzania_208" => "Tanzania" ,
	        "country_Thailand_209" => "Thailand (ประเทศไทย)" ,
	        "country_Togo_210" => "Togo" ,
	        "country_Tokelau_211" => "Tokelau" ,
	        "country_Tonga_212" => "Tonga" ,
	        "country_Trinidad_and_Tobago_213" => "Trinidad and Tobago" ,
	        "country_Tunisia_214" => "Tunisia (تونس)" ,
	        "country_Turkey_215" => "Turkey (Türkiye)" ,
	        "country_Turkmenistan_216" => "Turkmenistan" ,
	        "country_Turks_and_Caicos_Islands_217" => "Turks and Caicos Islands" ,
	        "country_Tuvalu_218" => "Tuvalu" ,
	        "country_Uganda_219" => "Uganda" ,
	        "country_Ukraine_220" => "Ukraine (Україна)" ,
	        "country_United_Arab_Emirates_221" => "United Arab Emirates (الإمارات العربية المتحدة)" ,
	        "country_United_Kingdom_222" => "United Kingdom" ,
	        "country_United_States_Minor_Outlying_Islands_224" => "United States Minor Outlying Islands" ,
	        "cuntry_United_States_of_America_223" => "United States of America" ,
	        "country_Uruguay_225" => "Uruguay" ,
	        "country_Uzbekistan_226" => "Uzbekistan (Oʻzbekiston)" ,
	        "country_Vanuatu_227" => "Vanuatu" ,
	        "country_Vatican_City_State__Holy_See__228" => "Vatican City State (Vaticanum)" ,
	        "country_Venezuela_229" => "Venezuela" ,
	        "country_Vietnam_230" => "Vietnam (Việt Nam)" ,
	        "country_Virgin_Islands__British__231" => "Virgin Islands (British)" ,
	        "country_Virgin_Islands__U_S___232" => "Virgin Islands (U.S.)" ,
	        "country_Wallis_and_Futuna_Islands_233" => "Wallis and Futuna Islands" ,
	        "country_Western_Sahara_234" => "Western Sahara (الصحراء الغربية)" ,
	        "country_Yemen_235" => "Yemen (اليمن)" ,
	        "country_Zaire_237" => "Zaire" ,
	        "country_Zambia_238" => "Zambia" ,
	        "country_Zimbabwe_239" => "Zimbabwe" ,
    ];

    // show prices page 
    public function index()
    {
        $left_count = 0;
        $guard = null;
        $userdata = [];
        if (Auth::guard($guard)->check()) {
            $role = Auth::user()->role; 
            $userdata['user_login'] = Auth::user();
            $balance = Balance::where('user_id', $userdata['user_login']->id)
            ->select(DB::raw('SUM(supply-used) as leftcount'))
            ->get()->first();
            if($balance!=null)  $left_count = $balance->leftcount;
        }
        return view('mailstester.prices')
                ->with('left_count', $left_count)
                ->with('userdata' ,$userdata);
        
    }
    // goto Payment site page
    public function micropay_sitepay(Request $request){
        $request->validate([
            'firstname' => 'required|max:255|min:2',
            'lastname'  => 'required|max:255|min:2',
            'country'   => 'required|max:255|min:2',
            'guest_email'   => 'email|required|max:255|min:2',
        ]);
        
        session()->put('Micro_payment_', $request->request);

        $profile_id = 0;    // must be positive
        $payment_method = $request->payment_method;
        $pay_amount = $price = $request->pay_price;
        $qty = 1;

        if($payment_method == 'paybox_paypal'){ 
            // paypal ---------------------------------------
            $provider = new PayPalClient([]);
            $provider->getAccessToken();

            $result = $provider->createOrder([
                "intent"=> "CAPTURE",
                "purchase_units"=> [
                    0 => [
                        "amount"=> [
                            "currency_code"=> "EUR",
                            "value"=> strval(round($pay_amount,2))
                        ]
                    ]
                ],
                "application_context" => [
                    "cancel_url" => route('home'),
                    "return_url" => route( env('MICROPAYMENT_RETURN_URL') )
                ] 
            ]);

            session()->put('Order_method_', $payment_method);
            session()->put('Order_id_',     $result['id']);
            session()->put('Order_qty_',    $pay_amount);
            session()->put('Order_price_',  $price);
            session()->put('Order_count_',  $qty);
            session()->put('Order_userid_',  $profile_id);
            
            //dd($result['links']);
            foreach($result['links'] as $l){
                if($l['rel'] == 'approve'){
                    //dd($l['href']);
                    return redirect($l['href']);
                }            
            }
            session()->flash('error', translate('Some error occur, sorry for inconvenient.'));
            return redirect(route('prices'));
        }else if($payment_method == 'paybox_stripe'){ 
            // stripe -----------------------------------------
            Stripe::setApiKey(env('STRIPE_SECRET'));

            $Checkout = StripeSession::create([
                'payment_method_types' => ['card'],
                'line_items' => [[
                    'price_data' => [
                        'currency' => 'EUR',
                        'unit_amount' => $pay_amount * 100,
                        'product_data' => [
                            'name' => 'micropay_' . $request->guest_email,
                        ],
                    ],
                    'quantity' => 1,
                ]],
                'mode' => 'payment',
                'cancel_url' => route('home'),
                'success_url' => route( env('MICROPAYMENT_RETURN_URL')) . '?session_id={CHECKOUT_SESSION_ID}',
            ]);

            session()->put('Order_method_',$payment_method);
            session()->put('Order_qty_',    $pay_amount);
            session()->put('Order_price_',  $price);
            session()->put('Order_count_',  $qty);
            session()->put('Order_userid_',  $profile_id);
            
            if(isset($Checkout->id)){
                session()->put('Order_id_',     $Checkout->id);
                $Html = '<script src="https://js.stripe.com/v3/"></script>';
                $Html.= '<script type="text/javascript">let stripe = Stripe("'.env('STRIPE_KEY').'");';
                $Html.= 'stripe.redirectToCheckout({ sessionId: "'.$Checkout->id.'" }); </script>';
                echo $Html;
            }else{
                return redirect(route('prices'));
            }
        }
        else{
            abort(419);
        }
    }
    // goto Payment site page
    public function buy_mail_test(Request $request){
        $guard = null;
        $userdata = [];
        if (Auth::guard($guard)->check()) {
            $userdata = Auth::user();
        }else{
            return redirect(route('login'));
        }
        $request->validate([
            'firstname' => 'required|max:255|min:2',
            'lastname'  => 'required|max:255|min:2',
            'country'   => 'required|max:255|min:2',
            'address'   => 'required|max:255|min:2',
            'city'      => 'required|max:255|min:2',
            'state'     => 'required|max:255|min:2',
            'mail_addr' => 'email|required|max:255|min:2',
            'telephone' => 'required|max:12|min:8|regex:/[0-9]/', //|regex:/(01)[0-9]{9}/
            'state'     => 'required|max:255|min:2',
            'postcode'  => 'required|max:255|min:6',
        ]);

        $profile_id = $this->SaveAndGetProfile($userdata['id'], $request);
        $payment_method = $request->payment_method;
        $price = $request->pay_price;
        $qty = $request->pay_qty;
        $coupon = $request->pay_coupon;
        if(!empty($coupon) && !empty($request->coupon_code) )
        {
            coupon::where('coupon_code',$request->coupon_code)->update(['state' => 1, 'user_id' => $userdata['id']]);
        }
        $pay_amount = ($price * $qty - $coupon)* (100+ env('VAT_FEE') )/100.0 ;

        if($payment_method == 'paybox_paypal'){ 
            // paypal ---------------------------------------
            $provider = new PayPalClient([]);
            $provider->getAccessToken();

            $result = $provider->createOrder([
                "intent"=> "CAPTURE",
                "purchase_units"=> [
                    0 => [
                        "amount"=> [
                            "currency_code"=> "EUR",
                            "value"=> strval(round($pay_amount,2))
                        ]
                    ]
                ],
                "application_context" => [
                    "cancel_url" => route('prices'),
                    "return_url" => route( env('PAYPAL_RETURN_URL') )
                ] 
            ]);
            session()->put('Order_method_'.$userdata['id'], $payment_method);
            session()->put('Order_id_'.$userdata['id'],     $result['id']);
            session()->put('Order_qty_'.$userdata['id'],    $pay_amount);
            session()->put('Order_price_'.$userdata['id'],  $price);
            session()->put('Order_count_'.$userdata['id'],  $qty);
            session()->put('Order_userid_'.$userdata['id'],  $profile_id);
            if(!empty($coupon) && !empty($request->coupon_code) )
            {
                session()->put('Order_CouponCode_'.$userdata['id'],  $request->coupon_code);
                session()->put('Order_CouponAmount_'.$userdata['id'],  $coupon);
            }            
            foreach($result['links'] as $l){
                if($l['rel'] == 'approve'){
                    return redirect($l['href']);
                }            
            }
            session()->flash('error', translate('Some error occur, sorry for inconvenient.'));
            return redirect(route('prices'));
        }else if($payment_method == 'paybox_stripe'){ 
            // stripe -----------------------------------------
            Stripe::setApiKey(env('STRIPE_SECRET'));

            $Checkout = StripeSession::create([
                'payment_method_types' => ['card'],
                'line_items' => [[
                    'price_data' => [
                        'currency' => 'EUR',
                        'unit_amount' => $pay_amount * 100,
                        'product_data' => [
                            'name' => 'mail test',
                        ],
                    ],
                    'quantity' => 1,
                ]],
                'mode' => 'payment',
                'success_url' => route( env('STRIPE_RETURN_URL')) . '?session_id={CHECKOUT_SESSION_ID}',
                'cancel_url' => route('prices'),
            ]);

            session()->put('Order_method_'.$userdata['id'],$payment_method);
            session()->put('Order_qty_'.$userdata['id'],    $pay_amount);
            session()->put('Order_price_'.$userdata['id'],  $price);
            session()->put('Order_count_'.$userdata['id'],  $qty);
            session()->put('Order_userid_'.$userdata['id'],  $profile_id);
            if(!empty($coupon) && !empty($request->coupon_code) )
            {
                session()->put('Order_CouponCode_'.$userdata['id'],  $request->coupon_code);
                session()->put('Order_CouponAmount_'.$userdata['id'],  $coupon);
            }            
            
            if(isset($Checkout->id)){
                session()->put('Order_id_'.$userdata['id'],     $Checkout->id);
                $Html = '<script src="https://js.stripe.com/v3/"></script>';
                $Html.= '<script type="text/javascript">let stripe = Stripe("'.env('STRIPE_KEY').'");';
                $Html.= 'stripe.redirectToCheckout({ sessionId: "'.$Checkout->id.'" }); </script>';
                echo $Html;
            }else{
                return redirect(route('prices'));
            }
        }
        else{
            abort(419);
        }
    }
    # payment return url
    public function micropayment_status(Request $request){
        
        $pay_request = session()->get('Micro_payment_');
        //dd($pay_request->get('mail_id'));
        
        if(empty( $pay_request) )
        {
            session()->flash('error', translate('Payment failed.'));
            return redirect(route('home'));
        }
        
        $mail_id = $pay_request->get('mail_id');
        $payment_method = $pay_request->get('payment_method');
        
        if($payment_method == 'paybox_paypal'){ 
            // paypal status ---------------------------------
            $profile_id = session()->get('Order_userid_');
            $orderID = session()->get('Order_id_');
            $qty = session()->get('Order_qty_');
            $provider = new PayPalClient([]);
            $provider->getAccessToken();
            $response = $provider->capturePaymentOrder($orderID);
            
            if($response['status'] == 'COMPLETED'){
                $inserted_id = $this->save_micro_payment_history($pay_request, $qty , $response);
                return redirect(route('testresult').'?message_id='.$mail_id);
            }else{
                session()->flash('error', translate('Payment failed.'));
                return redirect(route('home'));
            } 
        }else if($payment_method == 'paybox_stripe'){ 
            // stripe status ---------------------------------
            $profile_id = session()->get('Order_userid_');
            $orderID = session()->get('Order_id_');
            $qty = session()->get('Order_qty_');
            if(isset($orderID) && isset($request->session_id)){
                Stripe::setApiKey(env('STRIPE_SECRET'));
                $session = StripeSession::retrieve($request->session_id);
                if($session && $session->payment_status == 'paid'){
                    $inserted_id = $this->save_micro_payment_history($pay_request, $qty , $session);
                    return redirect(route('testresult').'?message_id='.$mail_id);
                }
            }
            session()->flash('error', translate('Payment failed.'));
            return redirect(route('home'));
        }         
        else
        {
            abort(419);
        }
    }

    # payment return url
    public function payment_status(Request $request){
        $guard = null;
        $userdata = [];
        if (Auth::guard($guard)->check()) {
            $userdata = Auth::user();
        }else{
            return redirect(route('prices'));
        }
        $payment_method = session()->get('Order_method_'.$userdata['id']);

        if($payment_method == 'paybox_paypal'){ 
            // paypal status ---------------------------------
            $profile_id = session()->get('Order_userid_'.$userdata['id']);
            $orderID = session()->get('Order_id_'.$userdata['id']);
            $qty = session()->get('Order_qty_'.$userdata['id']);
            $provider = new PayPalClient([]);
            $provider->getAccessToken();
            $response = $provider->capturePaymentOrder($orderID);
            if($response['status'] == 'COMPLETED'){
                $inserted_id = $this->save_Paypal_payment_history($qty , $response);
                $balance_id = $this->create_balance($inserted_id);
                return redirect(route('checkout', 'step4'));
            }else{
                session()->flash('error', translate('Payment failed.'));
                return redirect(route('prices'));
            } 
        }else if($payment_method == 'paybox_stripe'){ 
            // stripe status ---------------------------------
            $profile_id = session()->get('Order_userid_'.$userdata['id']);
            $orderID = session()->get('Order_id_'.$userdata['id']);
            $qty = session()->get('Order_qty_'.$userdata['id']);
            if(isset($orderID) && isset($request->session_id)){
                Stripe::setApiKey(env('STRIPE_SECRET'));
                $session = StripeSession::retrieve($request->session_id);
                if($session && $session->payment_status == 'paid'){
                    $inserted_id = $this->save_Stripe_payment_history($qty , $session);
                    $balance_id = $this->create_balance($inserted_id);
                    return redirect(route('checkout', 'step4'));
                }
            }
            session()->flash('error', translate('Payment failed.'));
            return redirect(route('latest-tests'));
        }         
        else
        {
            abort(419);
        }
    }

    public function micropay(Request $request)
    {
        $guard = null;
        $email_receiver = TestResult::where('mail_id', $request->message_id)->first();
        if($email_receiver==null || $email_receiver->user==null)
        {
            return redirect(route('home'));
        }

        return view('mailstester.checkout-micropay')
                ->with('mail_id' , $request->message_id)
                ->with('owner' , $email_receiver->user);
    }

    
    public function micropay_address(Request $request)
    {
        $owner = User::find($request->owner_id);
        if($owner==null || $request->mailbox==null || $request->plan_id==null)
        {
            return redirect(route('home'));
        }

        return view('mailstester.checkout-micropay-address')
                ->with('mailbox'  , $request->mailbox)
                ->with('plan_id'  , $request->plan_id)
                ->with('mail_id'  , $request->mail_id)
                ->with('owner' ,    $owner);
    }

    
    // show micro-payment page 
    public function micro_payment_note()
    {
        $guard = null;
        $userdata = [];
        if (Auth::guard($guard)->check()) {
            $role = Auth::user()->role; 
            $userdata['user_login'] = Auth::user();
        }
        return view('mailstester.micro-payment')
                ->with('userdata' ,$userdata);
    }

    # view order hist
    public function order(){
        $guard = null;
        $userdata = [];
        if (Auth::guard($guard)->check()) {
            $role = Auth::user()->role; 
            $userdata['user_login'] = Auth::user();
        }
        else
        {
            redirect(route('login'));
        }
        $profile_ids = [];
        $profiles = Profile::where('user_id', $userdata['user_login']->id)->get();
        foreach($profiles as $row)
        {
            $profile_ids[] = $row->id;
        }

        $order_rows = Transaction::wherein('user_id', $profile_ids)
                    ->orderBy('created_at', 'DESC')->get();
        
        //print($order_rows[0]->balance->supply); die;
        //print_r($order_rows[0]); die;
        // $lists = Requests::where('user_id', $user->id)
        //     ->orWhere('requester_id', $user->id)
        //     ->with(['category', 'requester', 'suggestions' => function ($q) {
        //         $q->with(['content', 'user']);
        //     }])
        //     ->get();



        //print_r($order_rows); die;
        return view('mailstester.orders')
                ->with('order_rows', $order_rows)
                ->with('userdata' ,$userdata);
    }
    
    public function order_detail($orderid){
        $guard = null;
        $userdata = [];
        if (Auth::guard($guard)->check()) {
            $role = Auth::user()->role; 
            $userdata['user_login'] = Auth::user();
        }
        else
        {
            redirect(route('login'));
        }
        $order_detail = Transaction::where('pay_id', $orderid)->get()->first();
        return view('mailstester.order_detail')
                ->with('details', $order_detail)
                ->with('userdata' ,$userdata);
    }
    
    public function checkout($price=null){ 
        $guard = null;
        $userdata = [];
        if (Auth::guard($guard)->check()) {
            $role = Auth::user()->role; 
            $userdata['user_login'] = Auth::user();
        }
        else
        {
            redirect(route('login'));
        }
        return redirect( route('checkout', 'step1') );
    }

    public function checkout_step(Request $request, $step){ 
        $guard = null;
        $userdata = [];
        if (Auth::guard($guard)->check()) {
            $role = Auth::user()->role; 
            $userdata['user_login'] = Auth::user();
            $user_id = Auth::user()->id;
            $addressdata = Profile::where([ 'user_id'=>$user_id, 'default_address'=>1 ])->get();
            if(!$addressdata->isEmpty())
            {
                $userdata['user_profile'] = $addressdata->first();
            }
            else
            {
                redirect( route('profile', 'address') );
            }
        }
        else
        {
            redirect(route('login'));
        }

        $checkout_payment_mode = 'paybox_stripe';
        $checkout_payment_coupon = '';
        $pay_price = 50;
        $pay_qty = 1;
        $pay_name = '500 tests';

      //  print($step . $request->input('pay_qty')); die;
        if($step=='step3')
        {
            //print($request->input('mailtester_payment')); die;
            if(     !empty($request->input('mailtester_payment'))  )
            {
                $coupon_code = $request->input('coupon');
                $mailtester_payment_mode = $request->input('mailtester_payment');
                Session::put('checkout_payment_mode',   $mailtester_payment_mode);
                Session::put('checkout_payment_coupon', $coupon_code );
                $checkout_payment_mode = Session::get('checkout_payment_mode');
                $checkout_payment_coupon = Session::get('checkout_payment_coupon');
            }
            if(     $request->input('pay_qty')!==null )
            {
                $pay_qty = $request->input('pay_qty');
                $pay_price = $request->input('pay_price');
                Session::put('pay_qty',   $pay_qty);
                Session::put('pay_price', $pay_price );
            }
        }

        if($step=='step1')
        {
            if(     !empty($request->input('price'))  )
            {
                $pay_price = $request->input('price');
                $pay_qty = $request->input('qty');
                $pay_name = $request->input('name');
                Session::put('pay_price',   $pay_price);
                Session::put('pay_qty',   $pay_qty);
                Session::put('pay_name',   $pay_name);
            }
        }
        
        #---------------------------------------------step1
        if(Session::has('pay_price'))
            $pay_price = Session::get('pay_price');
        if(Session::has('pay_qty'))
            $pay_qty = Session::get('pay_qty');
        if(Session::has('pay_name'))
            $pay_name = Session::get('pay_name');
        #---------------------------------------------step2
        if(Session::has('checkout_payment_mode'))
            $checkout_payment_mode = Session::get('checkout_payment_mode');
        if(Session::has('checkout_payment_mode'))
            $checkout_payment_coupon = Session::get('checkout_payment_coupon');
        #---------------------------------------------
        $pay_amount = $pay_qty * $pay_price;
        $charge_date = date('d-n-Y H:i:s');
        $email = '';
        $price_type = '';
        
        if($step=='step4')
        {
            if(empty(session()->get('summery-email')))
            {
                abort(419); return;
            }
            $email = session()->get('summery-email');
            $charge_date = session()->get('summery-date');
            $price_type = session()->get('summery-type');
            $pay_qty = session()->get('summery-qty');
            $pay_amount = session()->get('summery-amount');
            $pay_name = session()->get('summery-mode');
            #  $pay_price <== from session on prev block
        }

       // print($pay_qty); die;
        return view('mailstester.checkout-' . substr($step, -1))
                    ->with('pay_price' ,$pay_price)
                    ->with('email' ,$email)
                    ->with('price_type', $price_type)
                    ->with('pay_qty' ,$pay_qty)
                    ->with('pay_name' ,$pay_name)
                    ->with('pay_amount' ,$pay_amount)
                    ->with('charge_date', $charge_date)
                    ->with('checkout_payment_mode' ,$checkout_payment_mode)
                    ->with('checkout_payment_coupon' ,$checkout_payment_coupon)
                    ->with('userdata' ,$userdata);
    }

    public function paypal_notify(Request $request)
    {
        return [];
    }

    private function create_balance($transaction_id)
    {
        $trans = Transaction::where('id', $transaction_id)->get()->first();
        $user_id = Auth::user()->id;
        $email_id = $trans->email_id;
        $price_type= $trans->price_type;
        $price= $trans->price;
        $qty= $trans->qty;
        $supply = empty($this->price_count[$price]) ? 0 : $this->price_count[$price];

        $balance = new Balance();
        $balance->user_id = $user_id;
        $balance->email_id = $email_id;
        $balance->price_type = $price_type;
        $balance->price = $price;
        $balance->qty = $qty;
        $balance->supply = $supply;
        $balance->save();
        $balance_id = $balance->id;

        Transaction::find($transaction_id)->update(['balance_id'=>$balance_id]);

        if( !empty(TrashMail::where('id',$email_id)->get()) &&
            !empty(TrashMail::where('id',$email_id)->get()->first())
            )
            $email = TrashMail::where('id',$email_id)->get()->first()->email;
        else if (Cookie::has('email')) 
            $email =  Cookie::get('email');
        else
            $email = TrashMailController::generateRandomEmail();
        session()->put('summery-email',$email);
        session()->put('summery-date', $trans->created_at);
        session()->put('summery-type', $price_type);
        session()->put('summery-qty',  $qty);
        session()->put('summery-amount',  $trans->amount);
        session()->put('summery-mode',  $trans->bank);
        return $balance_id;
    }
    
    private function save_micro_payment_history($pay_request, $pay_amount, $payment_response)
    {
        $mail_id = $pay_request->get('mail_id');
        $payment_method = $pay_request->get('payment_method');  //session/request/inputbag
        $user_email = $pay_request->get('mailbox');
        $owner_id = $pay_request->get('owner_id');

        $email_id = 0;
        $email_obj = TrashMail::where(['email'=>$user_email])->first();
        if(!empty($email_obj)) 
            $email_id = $email_obj->id;

        $price = session()->get('Order_price_');
        $pay_qty = session()->get('Order_count_');
        $price_type = $pay_request->get('plan_id');
        $profile_id = session()->get('Order_userid_');

        
        if($payment_method == 'paybox_paypal')
        {
            $deal_id = $payment_response['id'];
            $pay_id = '';
            $pay_mode = '';
            foreach($payment_response['purchase_units'] as $purchase)
            {
                foreach($purchase['payments']['captures'] as $pay_row)
                {
                    $pay_id = $pay_row['id'];
                    $pay_mode = $pay_row['status'];
                }
            }
            $authority = $payment_response['payer']['payer_id'];
            $bank = 'paypal';
            $type = 'micropay';
            $income = round($pay_amount * env('MICROPAY_PROFIT') / 100.0 ,2);
    
        }
        else if($payment_method == 'paybox_stripe')
        {
            $payment_response = $payment_response->toArray();
            $deal_id = $payment_response['id'];
            $pay_id = $payment_response['customer'];
            $pay_mode = $payment_response['payment_method_types'][0];
    
            $authority = $payment_response['payment_intent'];
            $bank = 'stripe';
            $type = 'micropay';
            $income = round($pay_amount * env('MICROPAY_PROFIT') / 100.0 ,2);
        }

        if($payment_method == 'paybox_paypal' || $payment_method == 'paybox_stripe' )
        {
            $tranc = new Transaction();
            $tranc->user_id = $owner_id;
            $tranc->email_id = $email_id;
            $tranc->price_type = $price_type;
            $tranc->price = $price;
            $tranc->qty = $pay_qty;
            $tranc->amount = $pay_amount;
            $tranc->deal_id = $deal_id;
            $tranc->pay_id = $pay_id;
            $tranc->mode = $pay_mode;
            $tranc->authority = $authority;
            $tranc->bank = $bank;
            $tranc->type = $type;
            $tranc->income = $income;
            $tranc->fee = env('VAT_FEE');
            $tranc->save();
 
            $microPay = new MicroPayment();
            $microPay->user_id = $owner_id;
            $microPay->email_id = $email_id;

            $microPay->guest_email = $pay_request->get('guest_email');
            $microPay->firstname   = $pay_request->get('firstname');
            $microPay->lastname    = $pay_request->get('lastname');
            $microPay->country     = $pay_request->get('country');


            $microPay->profit_ratio = env('MICROPAY_PROFIT') / 100.0;
            $microPay->payed_email = $user_email;
            $microPay->pay_type = $pay_request->get('plan_id');
            $microPay->pay_amount = $price;
            //$microPay->qty = $pay_qty;
            $microPay->expire_date = PaymentController::$micropay_plans[$pay_request->get('plan_id')]['expire'];
            $microPay->supply_count = PaymentController::$micropay_plans[$pay_request->get('plan_id')]['limit'];
            $microPay->fee = env('VAT_FEE');
            $microPay->income = $price * (100-env('VAT_FEE')) / 100.0;
            $microPay->bank = $bank;
            $microPay->mode = $pay_mode;
            $microPay->type = $type;
            $microPay->deal_id = $deal_id;
            $microPay->pay_id = $pay_id;
            $microPay->authority = $authority;
            $microPay->save();
            return $microPay->id;
        }
        return null;
    }
    private function save_Paypal_payment_history($pay_amount, $payment_response)
    {
        $user_id = Auth::user()->id;

        $email_id = 0;
        $user_email = TrashMail::where(['user_id'=>$user_id])->orderBy('updated_at','DESC')->get();
        if(!empty($user_email) && !empty($user_email->first())) 
            $email_id = $user_email->first()->id;

        $price = session()->get('Order_price_'.$user_id);
        $pay_qty = session()->get('Order_count_'.$user_id);
        $price_type = empty($this->price_count[$price]) ? -1 : $this->price_count[$price];
        $profile_id = session()->get('Order_userid_'.$user_id);

        $deal_id = $payment_response['id'];
        $pay_id = '';
        $pay_mode = '';
        foreach($payment_response['purchase_units'] as $purchase)
        {
            foreach($purchase['payments']['captures'] as $pay_row)
            {
                $pay_id = $pay_row['id'];
                $pay_mode = $pay_row['status'];
            }
        }
        $authority = $payment_response['payer']['payer_id'];
        $bank = 'paypal';
        $type = 'peding';
        $income = round($pay_amount * 100.0 / (100+env('VAT_FEE')),2);

        $tranc = new Transaction();
        $tranc->user_id = $profile_id;
        $tranc->email_id = $email_id;
        $tranc->price_type = $price_type;
        $tranc->price = $price;
        $tranc->qty = $pay_qty;
        $tranc->amount = $pay_amount;
        $tranc->deal_id = $deal_id;
        $tranc->pay_id = $pay_id;
        $tranc->mode = $pay_mode;
        $tranc->authority = $authority;
        $tranc->bank = $bank;
        $tranc->type = $type;
        $tranc->income = $income;
        
        $tranc->fee = env('VAT_FEE');
        if(!empty($coupon) && !empty($request->coupon_code) )
        {
            $couponcode = session()->get('Order_CouponCode_'.$user_id);
            $couponamount = session()->get('Order_CouponAmount_'.$user_id);
            $tranc->coupon_code = $couponcode;
            $tranc->coupon_amount = $couponamount;
    
        }            

        $tranc->save();

        return $tranc->id;
    }
    
    private function save_Stripe_payment_history($pay_amount, $payment_response)
    {
        $payment_response = $payment_response->toArray();

        $user_id = Auth::user()->id;

        $email_id = 0;
        $user_email = TrashMail::where(['user_id'=>$user_id])->orderBy('updated_at','DESC')->get();
        if(!empty($user_email) && !empty($user_email->first())) 
            $email_id = $user_email->first()->id;

        $price = session()->get('Order_price_'.$user_id);
        $pay_qty = session()->get('Order_count_'.$user_id);
        $price_type = empty($this->price_count[$price]) ? -1 : $this->price_count[$price];

        $deal_id = $payment_response['id'];
        $pay_id = $payment_response['customer'];
        $pay_mode = $payment_response['payment_method_types'][0];

        $authority = $payment_response['payment_intent'];
        $bank = 'stripe';
        $type = $payment_response['payment_status'];
        $income = round($pay_amount * 100.0 / (100+env('VAT_FEE')),2);

        $tranc = new Transaction();
        $tranc->user_id = $user_id;
        $tranc->email_id = $email_id;
        $tranc->price_type = $price_type;
        $tranc->price = $price;
        $tranc->qty = $pay_qty;
        $tranc->amount = $pay_amount;
        $tranc->deal_id = $deal_id;
        $tranc->pay_id = $pay_id;
        $tranc->mode = $pay_mode;
        $tranc->authority = $authority;
        $tranc->bank = $bank;
        $tranc->type = $type;
        $tranc->income = $income;

        $tranc->fee = env('VAT_FEE');
        if(!empty($coupon) && !empty($request->coupon_code) )
        {
            $couponcode = session()->get('Order_CouponCode_'.$user_id);
            $couponamount = session()->get('Order_CouponAmount_'.$user_id);
            $tranc->coupon_code = $couponcode;
            $tranc->coupon_amount = $couponamount;
        }            

        $tranc->save();

        return $tranc->id;
    }

    public function onepage(Request $request)
    {

        $guard = null;
        $userdata = [];
        if (Auth::guard($guard)->check()) {
            $role = Auth::user()->role; 
            $userdata['user_login'] = Auth::user();
            $user_id = Auth::user()->id;
            $addressdata = Profile::where([ 'user_id'=>$user_id, 'default_address'=>1 ])->get();
            if(!$addressdata->isEmpty())
            {
                $userdata['user_profile'] = $addressdata->first();
            }
            else
            {
                redirect( route('profile', 'address') );
            }
        }
        else
        {
            redirect(route('login'));
        }

        $error_message = [];
        //print_r($request->price); die;
        $checkout_payment_mode = 'paybox_stripe';
        $checkout_payment_coupon = '';
        $coupon = 0;
        $pay_price = $request->price;
        $pay_qty   = $request->qty;
        $pay_name  = $request->name;

        if(!empty($request->coupon_code))
        {
            $checkout_payment_coupon = $request->coupon_code;
            $coupon = Coupon::where('coupon_code', $checkout_payment_coupon)
                        ->where('state', 0)
                        ->where(DB::raw("DATEDIFF('expiry_date', now())>0"))
                        ->get()->first();
            
            $pay_price = session()->get('pay_price_'.$userdata['user_login']['id']);
            $pay_qty    = session()->get('pay_qty_'.$userdata['user_login']['id']);
            $pay_name  = session()->get('pay_name_'.$userdata['user_login']['id']);
            if($coupon!=null)
            {
                $coupon = round($coupon->coupon_amt * $pay_price / 100.0,1);
            }
            else
            {
                $checkout_payment_coupon = '';
                $coupon = 0;
                $error_message['coupon'] = 'The Coupon you entered could not be found.';
            }
        }
        session()->put('pay_price_'.$userdata['user_login']['id'], $pay_price);
        session()->put('pay_qty_'.$userdata['user_login']['id'],   $pay_qty);
        session()->put('pay_name_'.$userdata['user_login']['id'],  $pay_name);

        $pay_amount = ($pay_qty * $pay_price - $coupon) * (100 + env('VAT_FEE') )/100.0 ;
        $charge_date = date('d-n-Y H:i:s');
        $email = '';
        $price_type = '';

        return view('mailstester.payment-page' )
                    ->with('error_message', $error_message)
                    ->with('pay_price'  ,$pay_price)
                    ->with('pay_qty'    ,$pay_qty)
                    ->with('pay_name'   ,$pay_name)
                    ->with('pay_amount' ,$pay_amount)
                    ->with('charge_date',$charge_date)
                    ->with('checkout_payment_mode' ,$checkout_payment_mode)
                    ->with('checkout_payment_coupon' ,$checkout_payment_coupon)
                    ->with('coupon', $coupon)
                    ->with('userdata' ,$userdata);
    }

    private function SaveAndGetProfile($user_id, $request)
    {
        
        $user_profile = Profile::where(['user_id'=>$user_id,
                    'firstname'=>$request->firstname,
                    'lastname'=>$request->lastname
                    ])->get()->first();
        $data = [
            'user_id'   => $user_id,
            'firstname' => $request->firstname ,
            'lastname'  => $request->lastname ,
            'company'   => $request->company ,
            'country'   => $request->country   ,
            'address'   => $request->address   ,
            'city'      => $request->city      ,
            'state'     => $request->state     ,
            'mail_addr' => $request->mail_addr ,
            'telephone' => $request->telephone ,
            'state'     => $request->state     ,
            'postcode'  => $request->postcode  ,
            'default_address' => 1
        ];
        
        if($user_profile==null)
        {
            $profile = new Profile();
            $profile->user_id        = $user_id;
            $profile->firstname      = $request->firstname;
            $profile->lastname       = $request->lastname;
            $profile->company        = $request->company;
            $profile->country        = $request->country;
            $profile->address        = $request->address;
            $profile->city           = $request->city;
            $profile->state          = $request->state;
            $profile->mail_addr      = $request->mail_addr;
            $profile->telephone      = $request->telephone;
            $profile->state          = $request->state;
            $profile->postcode       = $request->postcode;
            $profile->default_address= 1;
            $profile->save();
            $profile_id = $user_profile->id;
        }
        else
        {
            $result = Profile::where('id', $user_profile->id)->update($data);
            $profile_id = $user_profile->id;
        }
        
        return $profile_id;
    }
}