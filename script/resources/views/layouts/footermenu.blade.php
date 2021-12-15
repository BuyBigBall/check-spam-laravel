<nav class="navbar navbar-light navbar-expand-sm navbar-center">
    <ul class="navbar-nav mx-auto">
        <li class="nav-item">
            <a class="nav-link" href="{{ route('faq') }}" target="_blank">{{__('FAQ')}}</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('contact', '#contactus' ) }}" target="_blank">{{__('Give Feedback')}}</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('spf') }}" target="_blank">{{__('SPF Guides')}}</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('spf-dkim-check') }}" target="_blank">{{__('SPF & DKIM check')}}</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('json-api') }}" target="_blank">{{__('API')}}</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('login') }}" target="_blank">{{__('Log in')}}</a>
        </li>
    </ul>
</nav>