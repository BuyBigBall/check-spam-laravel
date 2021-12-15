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
                    <a href="{{ route('get-started') }}">{{__('Get Started')}}</a>
                </li>
                @endif
                <li class="item-169 default @if ($userdata['uri']=='prices') {{ 'current active' }} @endif">
                    <a href="{{ route('prices') }}">{{__('Prices')}}</a>
                </li>
                @if (!empty($userdata['user_login']))
                <li class="item-111 @if ($userdata['uri']=='account') {{ 'current active' }} @endif">
                    <a href="{{ route('account') }}">{{__('Account')}}</a>
                </li>
                @endif
                <li class="item-109 @if ($userdata['uri']=='latest-tests') {{ 'current active' }} @endif">
                    <a href="{{ route('latest-tests') }}">{{__('Latest Tests')}}</a>
                </li>
                <li class="item-113 @if ($userdata['uri']=='design') {{ 'current active' }} @endif">
                    <a href="{{ route('design') }}">{{__('iFrame CSS')}}</a>
                </li>
                <li class="item-108 @if ($userdata['uri']=='json-api') {{ 'current active' }} @endif">
                    <a href="{{ route('json-api') }}">{{__('JSON API')}}</a>
                </li>
                <li class="item-181 @if ($userdata['uri']=='micro-payment') {{ 'current active' }} @endif">
                    <a href="{{ route('micro-payment') }}">{{__('Micro-payment')}}</a>
                </li>
                <li class="item-170 @if ($userdata['uri']=='terms-of-service') {{ 'current active' }} @endif">
                    <a href="{{ route('terms-of-service') }}">{{__('Terms of service')}}</a>
                </li>
                <li class="item-151">
                    <a href="{{ route('contact', '#contactus') }}" target="_blank" rel="noopener noreferrer">{{__('Contact us')}}</a>
                </li>
            </ul>

        </div>
    </div>
</div>