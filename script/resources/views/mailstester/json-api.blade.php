@extends('mailstester.layout')

@section('content')
<div id="content_container" style="width:100%">
    <div class="row-fluid contentsize">
        <div id="system-message-container"></div>
        <div class="item-page" itemscope="" itemtype="https://schema.org/Article">
            <div class="page-header">
                <h2 itemprop="headline">
                    JSON API Documentation
                </h2>
            </div>

            <div itemprop="articleBody">
                <hr />
                <ul class="toc">
                    <li>
                        <a href="#how-to">How to use the Mail-Tester JSON API?</a>
                    </li>
                    <li>
                        <a href="#dbug">Visualize your data with dBug</a>
                    </li>
                    <li>
                        <a href="#structure">Structure and examples</a>
                    </li>
                </ul>
                <h2 id="how-to" class="question">How to use the Mail-Tester JSON API?</h2>
                <div class="answer">
                    <p>First send an email to
                        <em>yourusername</em>-whateveryouwant[at]{{ ($request=Request::capture())->gethttphost() }} (<em>yourusername</em>
                        should be replaced by your own username!)</p>
                    <p>Then to use our API, call Mail-tester with this url:</p>
                    <p style="text-align: center;">
                        <strong>{{ Request::root() }}/yourusername-</strong>
                        <strong>whateveryouwant&amp;format=json</strong>
                    </p>
                    <p>You can obviously replace "whateveryouwant" by everything you want... Please
                        make sure it's an unique string so one test does not override another.</p>
                    <p>Basically, after calling this url, Mail-tester will process the mail sent to
                        the given email address and return a JSON object than you can exploit.</p>
                    <p>Here is a short example of what you should execute to get the API result.
                        This given example uses
                        <strong>jQuery's function getJson</strong>
                        but you can use whatever you prefer:</p>
                    <pre style="margin: auto; max-width: 644px;">
<!-- this code must be no indent -->
$.getJSON("{{ Request::root() }}/aaweb-pDrqwp&amp;format=json", function(data){
    if(data.status==false){
        document.write(data.title);
        return;
    }
    $.each(data, function(key, value){
        document.write(key+": "+value+"&lt;br/&gt;"); 
        });
    });
                    </pre>
                    <p>If you don't want to waste time performing tests you don't need, you can add
                        <strong>&amp;test=key</strong>
                        to get only specific tests. key must be replaced by one of our 5 main tests that
                        are described
                        <a href="#structure">
                            in the structure part</a>
                        (for example &amp;test=signature).</p>
                    <p>Also note that you can add
                        <strong>&amp;lang=fr-fr</strong>
                        (for example) if you want to change the language.</p>
                    <p class="top">
                        <a
                            href="#content_container">Back to top</a>
                    </p>
                </div>
                <h2 id="dbug" class="question">Visualize your data with dBug</h2>
                <div class="answer">
                    <p>Since Mail-Tester is providing a lot of information and we don't want you to
                        be lost, we added a little that developers will love.</p>
                    <p>If you replace
                        <strong>&amp;format=json</strong>
                        by
                        <strong>&amp;format=dbug</strong>, you will indeed be able to visualize
                        everything we return concerning your newsletter through a flexible interface.
                        Want an example?
                        <a href="{{ Request::root() }}/dbug-example">Check this out!</a>
                    </p>
                    <p>With this visualization, you can also click on the name of the variables (for
                        example spamAssassin), to hide or display this part of the object. You can thus
                        focus on certain aspects of the object that interest you. I told you, you're
                        gonna love this.</p>
                    <p>Note that this feature uses dBug.php, a free tool that you can
                        <a href="http://dbug.ospinto.com/">download here</a>
                    </p>
                    <p class="top">
                        <a
                            href="#content_container">Back to top</a>
                    </p>
                </div>
                <h2 id="structure" class="question">Structure and examples</h2>
                <div class="answer">
                    <p>As you may have noticed, Mail-Tester provides quite a lot of information
                        about your emails. Well the API includes everything on the result page and even
                        more.</p>
                    <p>Since we have implemented dBug in our API, the best way to have a good vision
                        of what the API returns is to look at an example processed with dBug.
                        <a href="{{ Request::root() }}/dbug-example">So here is the result for one of our fabulous mail.</a>
                    </p>
                    <p>If the variables' name are not clear enough for you, you can still take a
                        look at our short sum-up about it.</p>
                    <h3 style="text-align: center;">Structure</h3>
                    <p>Six main sub-objects can be identified inside the main object. These
                        sub-object are the same as the main categories on a classic Mail-Tester result
                        page:</p>
                    <ul>
                        <li>
                            <strong>Main object:</strong>
                            Contain the main information about the test such as the id of the address you
                            mailed, the final score and our short comment about it.</li>
                        <li>
                            <strong>messageInfo:</strong>
                            This sub-object contain few information about the message itself such as the
                            subject, the reception date (MySQL format) and the bounce Address.</li>
                        <li>
                            <strong>spamAssassin:</strong>
                            You will find here every information related to the spamAssassin test. The most
                            interesting is the array rule which includes every notable test made by
                            spamAssassin with the code, the score and our suggestions.</li>
                        <li>
                            <strong>signature:</strong>
                            This one is a big one! It includes every authentification test as SPF, SenderId,
                            DKIM and rDNS. You should find here every information related to these methods,
                            including score, comments and suggestions.</li>
                        <li>
                            <strong>body:</strong>
                            Here you can find multiple version of your email (HTML, Text, raw version) as
                            well as the results of our tests on the boby like the HTML to text ratio, the
                            forbidden tags or the alt attributes.</li>
                        <li>
                            <strong>blacklists:</strong>
                            This object contain an array with every blacklist we tested and the answer for
                            your newsletter.</li>
                        <li>
                            <strong>links:</strong>
                            This last one gives you the broken links we found.</li>
                    </ul>
                    <p>More generally, you will almost always find these variables inside of any
                        variable related to a test (such as spf, texToHtmlRatio or blacklists):</p>
                    <ul>
                        <li>
                            <strong>title:</strong>
                            The title sums up the test, telling you what's good or wrong for this specific
                            test.</li>
                        <li>
                            <strong>mark:</strong>
                            The mark you got for this specific test, always less than or equal to 0.</li>
                        <li>
                            <strong>displayedMark:</strong>
                            The mark we actually display. If it is superior or equal to zero, we replace it
                            by &amp;#10003 to display something nice.</li>
                        <li>
                            <strong>status:</strong>
                            The status of the test</li>
                        <li>
                            <strong>statusClass:</strong>
                            The name of the class we use for our own design. Either failure, warning,
                            neutral or success.</li>
                        <li>
                            <strong>description:</strong>
                            A short description of the test itself.</li>
                        <li>
                            <strong>messages:</strong>
                            A HTML formatted message with our suggestions about the test and it results.</li>
                    </ul>
                    <h3 style="text-align: center;">Errors</h3>
                    <p>If, for any reason, the Mail-tester test didn't work, you will still receive
                        a formatted object in json or with a dBug. The variable $object-&gt;status
                        should then be false and $object-&gt;title will give you an error message.</p>
                    <p class="top">
                        <a
                            href="#content_container">Back to top</a>
                    </p>
                </div>
                <p>&nbsp;</p>
            </div>

        </div>

    </div>
</div>
@endsection