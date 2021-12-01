<div
    id="menu_container"
    style=" width:100%; z-index: 12;"
    data="data"
    -="-"
    spy="affix"
    offset="offset"
    top="100"
    class="affix-top">
    <div class="row-fluid contentsize">
        <div class="span12 affix-top">
            <ul class="nav menu">
                @if (!empty($userdata['user_login']))
                <li class="item-101 @if ($userdata['uri']=='get-started') {{ 'current active' }} @endif">
                    <a href="{{ route('get-started') }}">{{translate('Get Started')}}</a>
                </li>
                @endif
                <li class="item-169 default @if ($userdata['uri']=='prices') {{ 'current active' }} @endif">
                    <a href="{{ route('prices') }}">{{translate('Prices')}}</a>
                </li>
                @if (!empty($userdata['user_login']))
                <li class="item-111 @if ($userdata['uri']=='account') {{ 'current active' }} @endif">
                    <a href="{{ route('account') }}">{{translate('Account')}}</a>
                </li>
                @endif
                <li class="item-109 @if ($userdata['uri']=='latest-tests') {{ 'current active' }} @endif">
                    <a href="{{ route('latest-tests') }}">{{translate('Latest Tests')}}</a>
                </li>
                <li class="item-113 @if ($userdata['uri']=='design') {{ 'current active' }} @endif">
                    <a href="{{ route('design') }}">{{translate('iFrame CSS')}}</a>
                </li>
                <li class="item-108 @if ($userdata['uri']=='json-api') {{ 'current active' }} @endif">
                    <a href="{{ route('json-api') }}">{{translate('JSON API')}}</a>
                </li>
                <li class="item-181 @if ($userdata['uri']=='micro-payment') {{ 'current active' }} @endif">
                    <a href="{{ route('micro-payment') }}">{{translate('Micro-payment')}}</a>
                </li>
                <li class="item-170 @if ($userdata['uri']=='terms-of-service') {{ 'current active' }} @endif">
                    <a href="{{ route('terms-of-service') }}">{{translate('Terms of service')}}</a>
                </li>
                <li class="item-151">
                    <a href="{{ route('contact', '#contactus') }}" target="_blank" rel="noopener noreferrer">{{translate('Contact us')}}</a>
                </li>
            </ul>

        </div>
    </div>
</div>