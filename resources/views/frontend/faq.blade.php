@extends('layouts.user')

@section('content')

<body id="faq">
    <div
        role="dialog"
        aria-live="polite"
        aria-label="cookieconsent"
        aria-describedby="cookieconsent:desc"
        class="cc-window cc-banner cc-type-info cc-theme-block cc-bottom cc-color-override-688238583 cc-invisible"
        style="display: none;">
        <!--googleoff: all-->
        <span id="cookieconsent:desc" class="cc-message">We use cookies to personalise ads and to analyse our traffic.<br/>We
            also share information about your use of our site with our social media,
            advertising and analytics partners who may combine it with other information
            that you've provided to them or that they've collected from your use of their
            services.<br/>
            <br/>We do not share tests performed on this platform with anyone.
            <a
                aria-label="learn more about cookies"
                role="button"
                tabindex="0"
                class="cc-link"
                href="http://cookiesandyou.com/"
                target="_blank">Learn more</a>
        </span>
        <div class="cc-compliance">
            <a
                aria-label="dismiss cookie message"
                role="button"
                tabindex="0"
                class="cc-btn cc-dismiss">Got it!</a>
        </div>
        <!--googleon: all-->
    </div>

    <div id="header">
        <div class="back">
            <a class="btn btn-transparent" href="/">
                <i class="icon-left"></i>
                Back to port</a>
        </div>
        <h1 class="title py-5 m-0 text-center" title="Frequently Asked Questions">Frequently Asked Questions</h1>

        <div class="container text-center">
            <div class="list-group list-group-flush pb-5">
                <a
                    class="list-group-item list-group-item-action list-group-item-transparent"
                    href="#why-mail-tester">The Story of mail-tester</a>
                <a
                    class="list-group-item list-group-item-action list-group-item-transparent"
                    href="#work">How does mail-tester work?</a>
                <a
                    class="list-group-item list-group-item-action list-group-item-transparent"
                    href="#ensure-emails-reception">How Can I Ensure that Everybody Gets my Emails?</a>
                <a
                    class="list-group-item list-group-item-action list-group-item-transparent"
                    href="#still-spam">Perfect Score, But Still in Spam!</a>
                <a
                    class="list-group-item list-group-item-action list-group-item-transparent"
                    href="#perfect-score">What's a perfect score?</a>
                <a
                    class="list-group-item list-group-item-action list-group-item-transparent"
                    href="#mail-not-received">My Emails Are Neither in the Inbox nor in Spam</a>
                <a
                    class="list-group-item list-group-item-action list-group-item-transparent"
                    href="#about-spamassassin">What's SpamAssassin?</a>
                <a
                    class="list-group-item list-group-item-action list-group-item-transparent"
                    href="#why-design">Why a boat?</a>
                <a
                    class="list-group-item list-group-item-action list-group-item-transparent"
                    href="#privacy">Your Privacy Is Precious</a>
                <a
                    class="list-group-item list-group-item-action list-group-item-transparent"
                    href="#api">Do you have an API?</a>
                <a
                    class="list-group-item list-group-item-action list-group-item-transparent"
                    href="#translate">Help Us Translate</a>
                <a
                    class="list-group-item list-group-item-action list-group-item-transparent"
                    href="#usage-restrictions">Usage Restrictions</a>
            </div>
        </div>
    </div>

    <div>
        <div class="container py-3 clearfix">
            <h2 id="why-mail-tester" class="question">The Story of mail-tester</h2>
            <div class="answer">
                <p>We needed a
                    <strong>cheap</strong>,
                    <strong>simple</strong>
                    and
                    <strong>efficient
                    </strong>way to quickly test the quality of our own newsletters.</p>
                <p>We simply built on our own tool. Now we're sharing it for free via our
                    web-interface and enable you to
                    <a href="https://www.mail-tester.com/manager" target="_blank">include our tests in your own app and whitelist our service</a>
                    by creating an account.</p>
                <p>We're geeky email software engineers.</p>
                <a
                    class="btn btn-transparent float-right"
                    href="#header">
                    <i class="icon-up"></i>Back to top</a>
            </div>
        </div>
    </div>

    <div class="bg-white">
        <div class="container py-3 clearfix">
            <h2 id="work" class="question">How does mail-tester work?</h2>
            <div class="answer">
                <p>We generate a random email address each time you access our
                    <a href="https://www.mail-tester.com/">port</a>.</p>
                <p>You should send a message from your favourite Newsletter/email software to
                    this email address.</p>
                <p>Once done, click on the
                    <b>Check your score</b>
                    button and as soon as we receive your message, our snail will stop to give you
                    your spam score.</p>
                <p>Mail-tester will analyze your message, your mail server, your sending IP...
                    and show you a detailed report of what's configured properly and what's not.</p>
                <p>Your result will be accessible for
                    <b>7 days</b>
                    with our free version or
                    <b>30 days</b>
                    if you created an account and used your own prefix.</p>
                <p>If you send a new message to the same testing address, your previous test
                    will be immediately deleted to be replaced by the new one.</p>
                <a
                    class="btn btn-transparent float-right"
                    href="#header">
                    <i class="icon-up"></i>Back to top</a>
            </div>
        </div>
    </div>

    <div>
        <div class="container py-3 clearfix">
            <h2 id="ensure-emails-reception" class="question">How Can I Ensure that Everybody Gets my Emails?</h2>
            <div class="answer">
                <p>
                    <strong>You can't.</strong>
                    But you can do a lot to improve your chances, like getting a perfect score on
                    mail-tester.</p>
                <a
                    class="btn btn-transparent float-right"
                    href="#header">
                    <i class="icon-up"></i>Back to top</a>
            </div>
        </div>
    </div>

    <div class="bg-white">
        <div class="container py-3 clearfix">
            <h2 id="still-spam" class="question">Perfect Score, But Still in Spam!</h2>
            <div class="answer">
                <p>All spam filters work differently. What may pass in mail-tester, might not in
                    your own office inbox.</p>
                <p>It also depends on user preferences. For example, I hit on "this is spam"
                    button in my Yahoo. But you don't. Yahoo will adapt to each person.</p>
                <a
                    class="btn btn-transparent float-right"
                    href="#header">
                    <i class="icon-up"></i>Back to top</a>
            </div>
        </div>
    </div>

    <div>
        <div class="container py-3 clearfix">
            <h2 id="perfect-score" class="question">What's a perfect score?</h2>
            <div class="answer">
                <p>Your Goal is to Score Perfect 10/10, use our tools to help you get there!</p>
                <p>We have 5 different drawings in total.</p>
                <div class="row justify-content-around py-3">
                    <div class="col-sm-6 col-md-4 my-2">
                        <img
                            alt="Score 0 to 3"
                            src="/uploads/score_1.svg"/></div>
                    <div class="col-sm-6 col-md-4 my-2">
                        <img
                            alt="Score 3 to 5"
                            src="/uploads/score_2.svg"/></div>
                    <div class="col-sm-6 col-md-4 my-2">
                        <img
                            alt="Score 5 to 7"
                            src="/uploads/score_3.svg"/></div>
                    <div class="col-sm-6 col-md-4 my-2">
                        <img
                            alt="Score 7 to 9"
                            src="/uploads/score_4.svg"/></div>
                    <div class="col-sm-6 col-md-4 my-2">
                        <img
                            alt="Score 9 to 10"
                            src="/uploads/score_5.svg"/></div>
                </div>
                <a
                    class="btn btn-transparent float-right"
                    href="#header">
                    <i class="icon-up"></i>Back to top</a>
            </div>
        </div>
    </div>

    <div class="bg-white">
        <div class="container py-3 clearfix">
            <h2 id="mail-not-received" class="question">My Emails Are Neither in the Inbox nor in Spam</h2>
            <div class="answer">
                <p>Did you know that more emails are blocked than caught in a spam filter ? That
                    means they disappear completely.
                </p>
                <p>If that's your case, the server you're sending from is most probably
                    blacklisted. It's time to change your sending method.</p>
                <a
                    class="btn btn-transparent float-right"
                    href="#header">
                    <i class="icon-up"></i>Back to top</a>
            </div>
        </div>
    </div>

    <div>
        <div class="container py-3 clearfix">
            <h2 id="about-spamassassin" class="question">What's SpamAssassin?</h2>
            <div class="answer">
                <p>It's a widely used spam filter. It's open source, free, pretty awesome and
                    they have a
                    <a
                        title="Kills the spam"
                        target="_blank"
                        href="http://spamassassin.apache.org/">website too</a>.
                </p>
                <p>We have a vanilla install. In other words,
                    <strong>it's an out of the box default installation</strong>.<br/>We reversed
                        the score so a positive score is a good score and a negative one is bad.</p>
                <p>Do note that there are plenty of other spam filters out there.</p>
                <a
                    class="btn btn-transparent float-right"
                    href="#header">
                    <i class="icon-up"></i>Back to top</a>
            </div>
        </div>
    </div>

    <div class="bg-white">
        <div class="container py-3 clearfix">
            <h2 id="why-design" class="question">Why a boat?</h2>
            <div class="answer">
                <p>After the treehouse designed by our first
                    <a href="https://dribbble.com/blackboozeillu" target="_blank">awesome designer</a>,
                    we wanted to discover new lands and to travel across the seas just like an email
                    travels across the web. This is our other
                    <a href="https://www.semillance.com/" target="_blank">awesome designer</a>'s idea!</p>
                <a
                    class="btn btn-transparent float-right"
                    href="#header">
                    <i class="icon-up"></i>Back to top</a>
            </div>
        </div>
    </div>

    <div>
        <div class="container py-3 clearfix">
            <h2 id="privacy" class="question">Your Privacy Is Precious</h2>
            <div class="answer">
                <ul>
                    <li>We do not share, resell nor disclose your emails or addresses to anyone.</li>
                    <li>All results are visible to anyone who has the exact address.</li>
                    <li>Search engine robots and evil spammers can't crawl your results.</li>
                    <li>Results (and your email) are automatically deleted from our servers after
                        <b>7 days</b>
                        with our free version and
                        <b>30 days</b>
                        if you created an account.</li>
                    <li>We use your data to create averages and anonymous stats.</li>
                </ul>
                <a
                    class="btn btn-transparent float-right"
                    href="#header">
                    <i class="icon-up"></i>Back to top</a>
            </div>
        </div>
    </div>

    <div class="bg-white">
        <div class="container py-3 clearfix">
            <h2 id="api" class="question">Do you have an API?</h2>
            <div class="answer">
                <p>We have an iframe and a JSON API which are both available with our paid plans
                    so you can
                    <a href="https://www.mail-tester.com/manager" target="_blank">integrate mail-tester results into your own software</a>.</p>
                <p>Need more information?
                    <a href="https://www.mail-tester.com/contact">Get in touch with us!</a>
                </p>
                <a
                    class="btn btn-transparent float-right"
                    href="#header">
                    <i class="icon-up"></i>Back to top</a>
            </div>
        </div>
    </div>

    <div>
        <div class="container py-3 clearfix">
            <h2 id="translate" class="question">Help Us Translate</h2>
            <div class="answer">
                <p>We'd like to see mail-tester in other languages.<br/>
                    Please
                    <a href="https://www.mail-tester.com/contact">contact us</a>
                    to receive the latest version of your language file and help us improve it!</p>
                <a
                    class="btn btn-transparent float-right"
                    href="#header">
                    <i class="icon-up"></i>Back to top</a>
            </div>
        </div>
    </div>

    <div class="bg-white">
        <div class="container py-3 clearfix">
            <h2 id="usage-restrictions" class="question">Usage Restrictions</h2>
            <div class="answer">
                <p>You are free to use mail-tester.com provided that:</p>
                <ol>
                    <li>You do not interfere or attempt to interfere with the proper working of the
                        service.</li>
                    <li>You do not take any action that imposes an unreasonable or
                        disproportionately large load on our infrastructure.</li>
                </ol>
                <a
                    class="btn btn-transparent float-right"
                    href="#header">
                    <i class="icon-up"></i>Back to top</a>
            </div>
        </div>
    </div>

</body>
@endsection