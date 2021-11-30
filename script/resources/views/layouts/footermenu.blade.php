<nav class="navbar navbar-light navbar-expand-sm navbar-center">
    <ul class="navbar-nav mx-auto">
        <li class="nav-item">
            <a class="nav-link" href="{{ route('faq') }}" target="_blank">{{translate('FAQ')}}</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('contact', '#contactus' ) }}" target="_blank">{{translate('Give Feedback')}}</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('spf') }}" target="_blank">{{translate('SPF Guides')}}</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('spf-dkim-check') }}" target="_blank">{{translate('SPF & DKIM check')}}</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('json-api') }}" target="_blank">{{translate('API')}}</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('login') }}" target="_blank">{{translate('Log in')}}</a>
        </li>
    </ul>
</nav>