@extends('layouts.user')
  
@section('test_result_css')
<link rel="stylesheet" href="{{ asset('assets/css/testresult.css?v1.0') }}">
@endsection		

@include('mailstester.simple_html_dom')

@section('content')

<body id="result-page">

    <div
        id="header"
        class="text-center pb-5 mh-33 mark-4"
        style='background-color: var(--main-color);'>
        <h1 class="title py-5 m-0 text-white">Wow! Perfect, you can send</h1>
        <div class="subtitle text-white my-3" id="score-label">Score :</div>
        <span class="score">{{$score}}/10</span>
    </div>

    <div id="separator" class="bg-primary py-2 clearfix">
        <div class="container text-white" id="mail-info">
            <a
                class="text-white btn btn-transparent btn-sm mr-2"
                href="{{ route('testresult' , $email) }}"
                title="Refresh">
                <i class="icon-refresh"></i>
            </a>
            Subject :
            {{ $message['subject'] }}
            <div class="float-right date-received">
                <i class="icon-clock"></i>Received 2 days ago</div>
        </div>
    </div>

    <div id="test-results" class="bg-white">
        <div class="container py-3">

            <!-- Content -->
            <div class="test-result message-content my-3 opened">
                <div class="header clearfix">
                    <div class="status success icon-check"></div>
                    <h2 class="title">
                        <i class="icon-down"></i>Click here to view your message</h2>
                </div>
                <div class="content">
                    <div class="result">
                        <b>From :</b>
                        {{ $message['from'] }}
                        &lt;{{ $message['from_email'] }}&gt;
                        <br/>
                        <b>Bounce address :
                        </b>{{ $message['from_email'] }}
                        <br/>
                        <b>Reply-To :</b>
                        {{ $message['from'] }}
                        &lt;{{ $message['from_email'] }}&gt;
                    </div>

                    <!-- HTML (with images) -->
                    <div class="test-result html-version opened">
                        <div class="header clearfix">
                            <h3 class="title">
                                <i class="icon-down"></i>HTML version</h3>
                        </div>
                        <div class="content">
                            <div class="result">
                                <div class="menu-responsive text-right my-1">
                                    <span class="btn btn-transparent" data-size="342px">
                                        <i class="icon-mobile"></i>
                                    </span>
                                    <span class="btn btn-transparent" data-size="662px">
                                        <i class="icon-tablet"></i>
                                    </span>
                                    <span class="btn btn-transparent active" data-size="100%">
                                        <i class="icon-desktop"></i>
                                    </span>
                                </div>

                                <iframe src="{{ route('mail_body_html') }}" style="width: 99%;
                                height: 600px; border: 1px solid rgb(204, 204, 204);"></iframe>
                            </div>
                        </div>
                    </div>

                    <!-- HTML (without images) -->
                    <div class="test-result html-version-imageless opened">
                        <div class="header clearfix">
                            <h3 class="title">
                                <i class="icon-down"></i>
                                HTML version (without external images)
                            </h3>
                        </div>
                        <div class="content">
                            <div class="result">
                                <div class="menu-responsive text-right my-1">
                                    <span class="btn btn-transparent" data-size="342px">
                                        <i class="icon-mobile"></i>
                                    </span>
                                    <span class="btn btn-transparent" data-size="662px">
                                        <i class="icon-tablet"></i>
                                    </span>
                                    <span class="btn btn-transparent active" data-size="100%">
                                        <i class="icon-desktop"></i>
                                    </span>
                                </div>

                                <iframe src="{{ route('mail_body_html_noimg') }}" style="width: 99%;
                                height: 600px; border: 1px solid rgb(204, 204, 204);"></iframe>

								<div id='mailtext_without_external_images' style='width:100%;'></div>

                                <div class="geniframe" data-source="#originalcontent" data-stripimages="1"></div>
                            </div>
                        </div>
                    </div>

                    <!-- Text -->
                    <div class="test-result text-version opened">
                        <div class="header clearfix">
                            <h3 class="title">
                                <i class="icon-down"></i>
                                Text version</h3>
                        </div>
                        <div class="content">
                            {{  str_get_html($message['content'])->plaintext }}
                        </div>
                    </div>

                    <!-- Raw -->
                    <div class="test-result raw-version opened">
                        <div class="header clearfix">
                            <h3 class="title">
                                <i class="icon-down"></i>
                                Source</h3>
                        </div>
                        <div class="content">
                            <pre class="result">Received: by {{ env('MAIL_HOST') }} ; {{date('l d M Y H:i:s P (T)', strtotime($message['receivedAt']))}} 
X-Spam-Checker-Version: SpamAssassin 3.4.2 (2018-09-13) on {{ env('MAIL_HOST') }}
X-Spam-Level: 
X-Spam-Report: 
{{ str_replace('\n', '*       ', $report) }}
{{ $message['header'] }}
							</pre>
						</div>
					</div>

				</div>
			</div>
			
			<!-- SpamAssassin -->
			<div class="test-result spamassassin opened">
				<div class="header clearfix">
					<div class="status warning">
						-{{10-$score}}					</div>
					<h2 class="title"><i class="icon-down"></i>SpamAssassin thinks you can improve</h2>
				</div>
				<div class="content">
					<div class="about">The famous spam filter 
							<a href="http://spamassassin.apache.org/" target="_blank">SpamAssassin</a>. Score: -{{10-$score}}.
						<br />A score below -5 is considered spam.</div>
					<div class="result">
						<table class="table"><tbody>
							<tr class="sa-test">
								@foreach ($rules as $rule)
								<td class="text-center sa-test-score @if($rule['score']-0>=1) status-warning @else status-success @endif">{{$rule['score']}}</td>
								<!-- <td class="sa-test-name"><samp>DKIM_SIGNED</samp></td> -->
								<td class="sa-test-description">{{$rule['description']}}</td>
								</tr>
								@endforeach
							<!--
							<tr class="sa-test">			<td class="text-center sa-test-score status-success">0.1</td>			<td class="sa-test-name"><samp>DKIM_VALID</samp></td>			<td class="sa-test-description">Message has at least one valid DKIM or DK signature<br /><b>Great! Your signature is valid</b></td></tr> 	
							
							<tr class="sa-test">			<td class="text-center sa-test-score status-success">0.1</td>			<td class="sa-test-name"><samp>DKIM_VALID_AU</samp></td>			<td class="sa-test-description">Message has a valid DKIM or DK signature from author's domain<br /><b>Great! Your signature is valid and it's coming from your domain name</b></td></tr> 	
							
							<tr class="sa-test">			<td class="text-center sa-test-score status-success">0.1</td>			<td class="sa-test-name"><samp>DKIM_VALID_EF</samp></td>			<td class="sa-test-description">Message has a valid DKIM or DK signature from envelope-from domain</td></tr> 	
							
							<tr class="sa-test">			<td class="text-center sa-test-score status-warning">-0.25</td>			<td class="sa-test-name"><samp>FREEMAIL_ENVFROM_END_DIGIT</samp></td>			<td class="sa-test-description">Envelope-from freemail username ends in digit</td></tr> 	
							
							<tr class="sa-test">			<td class="text-center sa-test-score status-warning">-0.001</td>			<td class="sa-test-name"><samp>FREEMAIL_FROM</samp></td>			<td class="sa-test-description">Sender email is freemail<br /><b>You're sending from a free email account</b></td></tr> 	
							
							<tr class="sa-test">			<td class="text-center sa-test-score status-warning">-0.25</td>			<td class="sa-test-name"><samp>FREEMAIL_REPLYTO_END_DIGIT</samp></td>			<td class="sa-test-description">Reply-To freemail username ends in digit</td></tr> 	
							
							<tr class="sa-test">			<td class="text-center sa-test-score status-warning">-0.001</td>			<td class="sa-test-name"><samp>FROM_EXCESS_BASE64</samp></td>			<td class="sa-test-description">From: base64 encoded unnecessarily</td></tr> 	
							
							<tr class="sa-test">			<td class="text-center sa-test-score status-warning">-0.001</td>			<td class="sa-test-name"><samp>HTML_MESSAGE</samp></td>			<td class="sa-test-description">HTML included in message<br /><b>No worry, that's expected if you send HTML emails</b></td></tr> 	
							
							<tr class="sa-test">			<td class="text-center sa-test-score status-success">0.001</td>			<td class="sa-test-name"><samp>SPF_HELO_PASS</samp></td>			<td class="sa-test-description">SPF: HELO matches SPF record</td></tr> 	
							
							<tr class="sa-test">			<td class="text-center sa-test-score status-success">0.001</td>			<td class="sa-test-name"><samp>SPF_PASS</samp></td>			<td class="sa-test-description">SPF: sender matches SPF record<br /><b>Great! Your SPF is valid</b></td></tr>
							-->
							</tbody></table>					</div>
				</div>
			</div>

			<!-- Signature -->
			<div class="test-result signature opened">
				<div class="header clearfix">
					<div class="status success icon-check">
											</div>
					<h2 class="title"><i class="icon-down"></i>
							@if ($server_auth[0]=='auth') You're properly authenticated 
							@else Your server don't properly authenticated  @endif</h2>
				</div>
				<div class="content">
					<div class="about">
						@if ($server_auth[0]=='auth') We check if the server you are sending from is authenticated
						@else We could not check if the server you are sending from is authenticated.  @endif
						</div>

					<!-- SPF -->
					<div class="test-result spf opened">
						<div class="header clearfix">
							<div class="status success icon-check">
															</div>
							<h3 class="title"><i class="icon-down"></i>
								[SPF] Your server <b>{{$server_auth[1]}}</b> is authorized to use <b>{{$message['from_email']}}</b></h3>
						</div>
						<div class="content">
							<div class="about">Sender Policy Framework (SPF) is an email validation system designed to prevent email spam by detecting email spoofing, a common vulnerability, by verifying sender IP addresses.</div>
							<div class="result"><p>What we retained as your current SPF record is:</p><pre>v=spf1 redirect=_spf.mail.ru</pre><br/><br/>
                            <p>Verification details:</p>
                            <pre>dig +short TXT mail.ru :<ul><li>"facebook-domain-verification=3ebp0vez7u8uabf5unafvjak2i6pm4"</li><li>"google-site-verification=3Pifghdk3UShd7gzYd0Bjfqrq8Mn3bQAVonGr3xb9qg"</li><li>"mailru-verification: 43e81e646c1675e5"</li><li>"v=spf1 redirect=_spf.mail.ru"</li></ul>dig +short TXT @ns2.mail.ru. mail.ru :<ul><li>"mailru-verification: 43e81e646c1675e5"</li><li>"v=spf1 redirect=_spf.mail.ru"</li><li>"facebook-domain-verification=3ebp0vez7u8uabf5unafvjak2i6pm4"</li><li>"google-site-verification=3Pifghdk3UShd7gzYd0Bjfqrq8Mn3bQAVonGr3xb9qg"</li></ul>spfquery --scope mfrom --id yasha3651@mail.ru --ip 185.5.136.54 --helo-id f383.i.mail.ru :<ul><li>pass</li><li>mail.ru ... _spf.mail.ru: 185.5.136.54 is authorized to use 'yasha3651@mail.ru' in 'mfrom' identity (mechanism 'ip4:185.5.136.0/22' matched)</li><li>mail.ru ... _spf.mail.ru: 185.5.136.54 is authorized to use 'yasha3651@mail.ru' in 'mfrom' identity (mechanism 'ip4:185.5.136.0/22' matched)</li><li>Received-SPF: pass (mail.ru ... _spf.mail.ru: 185.5.136.54 is authorized to use 'yasha3651@mail.ru' in 'mfrom' identity (mechanism 'ip4:185.5.136.0/22' matched)) receiver=ns303428.ip-94-23-206.eu; identity=mailfrom; envelope-from="yasha3651@mail.ru"; helo=f383.i.mail.ru; client-ip=185.5.136.54</li></ul></pre>
                        </div>
                    </div>
                </div>

                <!-- DKIM -->
                <div class="test-result dkim">
                    <div class="header clearfix">
                        <div class="status success icon-check"></div>
                        <h3 class="title">
                            <i class="icon-down"></i>
                            Your DKIM signature is valid</h3>
                    </div>
                    <div class="content">
                        <div class="about">DomainKeys Identified Mail (DKIM) is a method for associating
                            a domain name to an email message, thereby allowing a person, role, or
                            organization to claim some responsibility for the message.</div>
                        <div class="result">
                            <p>The DKIM signature of your message is:</p>
                            <pre>{{$dkim_auth[1]}}</pre>
							<!--
                            <p>Your public key is:</p>
                            <pre>"v=DKIM1;
k=rsa;
p=MIGfMA0GCSqGSIb3DQEBAQUAA4GNADCBiQKBgQDJYfguQ0IBnJSidZ9P0ANIN3rmotRGy+6zeq6QUIGu0ZTCQa/GcsJJdZtfxKAxgxiSoWhwNxrJuSOB7IINeTCoZdQ2tT5d63b8N5rNoipOLmBfO4iadKKa6uUNbN6D3zEHg8xwz5rZaNk2MIiX2r79I2F/wQQDiJHpwXmNsuudWwIDAQAB"</pre>
                            <p>Key length: 1024bits</p>
							-->
                        </div>
                    </div>
                </div>

                <!-- DMARC -->
                <div class="test-result dmarc opened">
                    <div class="header clearfix">
                        <div class="status success icon-check"></div>
                        <h3 class="title">
                            <i class="icon-down"></i>
                            Your message passed the DMARC test</h3>
                    </div>
                    <div class="content">
                        <div class="about">A DMARC policy allows a sender to indicate that their emails
                            are protected by SPF and/or DKIM, and give instruction if neither of those
                            authentication methods passes. Please be sure you have a DKIM and SPF set before
                            using DMARC.</div>
                        <div class="result">Your DMARC record is @if($dmarc_auth[0]!='auth') not @endif set correctly and your message passed the DMARC test
								<p>DMARC DNS entry found for the domain <b>_dmarc.{{env('MAIL_HOST')}}</b>:</p>
							<!--
                            <pre>"v=DMARC1;p=reject;rua=mailto:d@rua.agari.com,mai" "lto:dmarc_rua@corp.mail.ru"</pre>
                            <p></p>
                            <p>Verification details:</p>
                            <pre><ul><li>{{ env('MAIL_HOST') }}; dmarc=pass header.from=mail.ru</li><li>{{ env('MAIL_HOST') }}; dkim=pass (1024-bit key; unprotected) header.d=mail.ru header.i=@mail.ru header.b=RJs3khbV; dkim-atps=neutral</li><li>f383.i.mail.ru; auth=pass smtp.auth=yasha3651@mail.ru smtp.mailfrom=yasha3651@mail.ru</li><li>From Domain: mail.ru</li><li>DKIM Domain: mail.ru</li></ul></pre>
							-->
                        </div>
                    </div>
                </div>

                <!-- Reverse DNS -->
                <div class="test-result reverse-dns opened">
                    <div class="header clearfix">
                        <div class="status success icon-check"></div>
                        <h3 class="title">
                            <i class="icon-down"></i>
                            Your server
                            <b>{{$server_auth[1]}}</b>
                            is successfully associated with
                            <b>{{ empty($rdns_auth[1]) ? $rdns_auth[2] :$rdns_auth[1] }}</b>
                        </h3>
                    </div>
                    <div class="content">
                        <div class="about">Reverse DNS lookup or reverse DNS resolution (rDNS) is the
                            determination of a domain name that is associated with a given IP address.<br/>Some
                            companies such as AOL will reject any message sent from a server without rDNS,
                            so you must ensure that you have one.<br/>You cannot associate more than one domain name with a single IP address.</div>
                        <div class="result">
                            <p></p>
                        </div>
                        <pre class="result">Here are the tested values for this check:<br /><ul>
							<li>IP: {{$rdns_auth[0]}}</li><li>HELO: {{$rdns_auth[1]}}</li><li>rDNS: {{$rdns_auth[2]}}</li></ul></pre>
                    </div>
                </div>
                <!-- A Record Bounce DNS-->
                <div class="test-result mxrecord-dns opened">
                    <div class="header clearfix">
                        <div class="status success icon-check"></div>
                        <h3 class="title">
                            <i class="icon-down"></i>
                            Your domain name
                            <strong>{{explode('@', $message['from_email'])[1]}}</strong>
                            is assigned to a mail server.</h3>
                    </div>
                    <div class="content">
                        <div class="about">We check if there is a mail server (MX Record) behind your domain name
                            <strong>{{explode('@', $message['from_email'])[1]}}</strong>.</div>
                        <div class="result">
                            <p></p>
                        </div>
                        <pre class="result">MX records ({{explode('@', $message['from_email'])[1]}}) : <ul><li>10 mxs.{{explode('@', $message['from_email'])[1]}}.</li></ul></pre>
                    </div>
                </div>
                <!-- A Record DNS-->
                <div class="test-result arecord-dns opened">
                    <div class="header clearfix">
                        <div class="status success icon-check"></div>
                        <h3 class="title">
                            <i class="icon-down"></i>
                            Your hostname
                            <strong>{{ empty($rdns_auth[2]) ? $rdns_auth[1] : $rdns_auth[2]}}</strong>
                            is assigned to a server.</h3>
                    </div>
                    <div class="content">
                        <div class="about">We check if there is a server (A Record) behind your hostname
                            <strong>{{ empty($rdns_auth[2]) ? $rdns_auth[1] : $rdns_auth[2]}}</strong>.</div>
                        <div class="result">
                            <p></p>
                        </div>
                        <pre class="result">A records ({{ empty($rdns_auth[2]) ? $rdns_auth[1] : $rdns_auth[2]}}) : <ul><li>{{$server_auth[1]}}</li></ul></pre>
                    </div>
                </div>
            </div>
        </div>

        <!-- Structure and Content -->
        <div class="test-result structure-and-content opened">
            <div class="header clearfix">
                <div class="h-100 status warning icon-check"></div>
                <h2 class="title">
                    <i class="icon-down"></i>Your message could be improved</h2>
            </div>
            <div class="content">

                <div class="about">Checks whether your message is well formatted or not.</div>
                <div class="result">
                    <p class="message-weight">Weight of the HTML version of your message:
                        <b>{{  strlen(str_get_html($message['content'])->plaintext) }}B</b>.</p>
                    <p>Your message contains
                        <b>{{ strlen($message['content'])==0 ? '&nbsp;' : round(strlen(str_get_html($message['content'])->plaintext) / strlen($message['content']) * 100) }}</b>% of text.</p>
                </div>

                <!-- Alt attribute -->
                <div class="test-result alt-attribute opened">
                    <div class="header clearfix">
                        <div class="status success icon-check"></div>
                        <h3 class="title">
                            <i class="icon-down"></i>
                            You have no images in your message</h3>
                    </div>
                    <div class="content">
                        <div class="about">ALT attributes provide a textual alternative to your images.<br/>It
                            is a useful fallback for people who are blind or visually impaired and for cases
                            where your images cannot be displayed.</div>
                        <div class="result"></div>
                    </div>
                </div>

                <!-- Forbidden tags -->
                <div class="test-result forbidden-tags opened">
                    <div class="header clearfix">
                        <div class="status success icon-check"></div>
                        <h3 class="title">
                            <i class="icon-down"></i>
                            Your content is safe</h3>
                    </div>
                    <div class="content">
                        <div class="about">Checks whether your message contains dangerous html elements
                            such as javascript, iframes, embed content or applet.</div>
                        <div class="result"></div>
                    </div>
                </div>

                <!-- Short LINK -->
                <div class="test-result short-links opened">
                    <div class="header clearfix">
                        <div class="status success icon-check"></div>
                        <h3 class="title">
                            <i class="icon-down"></i>
                            We didn't find short URLs</h3>
                    </div>
                    <div class="content">
                        <div class="about">Checks whether your message uses URL shortener systems.</div>
                        <div class="result"></div>
                        <div class="result">
                            <pre></pre>
                        </div>
                    </div>
                </div>

                <!-- List-unsubscribe -->
                <div class="test-result list-unsubscribe opened">
                    <div class="header clearfix">
                        <div class="status warning icon-check"></div>
                        <h3 class="title">
                            <i class="icon-down"></i>
                            Your message does not contain a List-Unsubscribe header</h3>
                    </div>
                    <div class="content">
                        <div class="about">The List-Unsubscribe header is required if you send mass
                            emails, it enables the user to easily unsubscribe from your mailing list.</div>
                        <div class="result">Your message does not contain a List-Unsubscribe header</div>
                        <div class="result">
                            <pre></pre>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <!-- Blacklists -->
        <div class="test-result blacklists opened">
            <div class="header clearfix">
                <div class="h-100 status success icon-check"></div>
                <h2 class="title">
                    <i class="icon-down"></i>You're not blacklisted</h2>
            </div>
            <div class="content">
                <div class="about">Matches your server IP address (<b>{{$server_auth[1]}}</b>) against 24 of the most common IPv4 blacklists.</div>
                <div class="result">
                    <div class="row">
                        <div class="col-sm-6 col-md-4 bl-result">
                            <span class="status-success">Not listed</span>
                            in
                            <a target="_blank" href="https://www.spamhaus.org/sbl/">Spamhaus SBL Advisory</a>
                        </div>
                        <div class="col-sm-6 col-md-4 bl-result">
                            <span class="status-success">Not listed</span>
                            in
                            <a target="_blank" href="https://www.spamhaus.org/css/">Spamhaus CSS Advisory</a>
                        </div>
                        <div class="col-sm-6 col-md-4 bl-result">
                            <span class="status-success">Not listed</span>
                            in
                            <a target="_blank" href="https://www.spamhaus.org/xbl/">Spamhaus XBL Advisory</a>
                        </div>
                        <div class="col-sm-6 col-md-4 bl-result">
                            <span class="status-success">Not listed</span>
                            in
                            <a target="_blank" href="https://www.spamhaus.org/pbl/">Spamhaus PBL Advisory</a>
                        </div>
                        <div class="col-sm-6 col-md-4 bl-result">
                            <span class="status-success">Not listed</span>
                            in
                            <a target="_blank" href="http://barracudacentral.org/rbl">Barracuda</a>
                        </div>
                        <div class="col-sm-6 col-md-4 bl-result">
                            <span class="status-success">Not listed</span>
                            in
                            <a target="_blank" href="http://ipadmin.junkemailfilter.com/remove.php">Hostkarma</a>
                        </div>
                        <div class="col-sm-6 col-md-4 bl-result">
                            <span class="status-success">Not listed</span>
                            in
                            <a target="_blank" href="http://antispam.imp.ch/">IMP-SPAM</a>
                        </div>
                        <div class="col-sm-6 col-md-4 bl-result">
                            <span class="status-success">Not listed</span>
                            in
                            <a target="_blank" href="http://www.backscatterer.org/index.php">BACKSCATTERER</a>
                        </div>
                        <div class="col-sm-6 col-md-4 bl-result">
                            <span class="status-success">Not listed</span>
                            in
                            <a target="_blank" href="http://www.anti-spam.org.cn/">China Anti-Spam Alliance</a>
                        </div>
                        <div class="col-sm-6 col-md-4 bl-result">
                            <span class="status-success">Not listed</span>
                            in
                            <a target="_blank" href="http://blacklist.lashback.com/">LashBack</a>
                        </div>
                        <div class="col-sm-6 col-md-4 bl-result">
                            <span class="status-success">Not listed</span>
                            in
                            <a target="_blank" href="http://mailspike.net/">mailskipe</a>
                        </div>
                        <div class="col-sm-6 col-md-4 bl-result">
                            <span class="status-success">Not listed</span>
                            in
                            <a target="_blank" href="http://www.heise.de/ix/nixspam/dnsbl_en/">NiX Spam</a>
                        </div>
                        <div class="col-sm-6 col-md-4 bl-result">
                            <span class="status-success">Not listed</span>
                            in
                            <a target="_blank" href="https://www.redhawk.org/SpamHawk/">REDHAWK</a>
                        </div>
                        <div class="col-sm-6 col-md-4 bl-result">
                            <span class="status-success">Not listed</span>
                            in
                            <a target="_blank" href="http://www.sorbs.net/lookup.shtml">SORBS (Relay)</a>
                        </div>
                        <div class="col-sm-6 col-md-4 bl-result">
                            <span class="status-success">Not listed</span>
                            in
                            <a target="_blank" href="http://www.sorbs.net/lookup.shtml">SORBS (last 48 hours)</a>
                        </div>
                        <div class="col-sm-6 col-md-4 bl-result">
                            <span class="status-success">Not listed</span>
                            in
                            <a target="_blank" href="http://www.sorbs.net/lookup.shtml">SORBS (last 28 days)</a>
                        </div>
                        <div class="col-sm-6 col-md-4 bl-result">
                            <span class="status-success">Not listed</span>
                            in
                            <a target="_blank" href="http://spamcop.net/bl.shtml">SPAMCOP</a>
                        </div>
                        <div class="col-sm-6 col-md-4 bl-result">
                            <span class="status-success">Not listed</span>
                            in
                            <a target="_blank" href="http://spameatingmonkey.com/index.html">SEM-BACKSCATTER</a>
                        </div>
                        <div class="col-sm-6 col-md-4 bl-result">
                            <span class="status-success">Not listed</span>
                            in
                            <a target="_blank" href="http://spameatingmonkey.com/index.html">SEM-BLACK</a>
                        </div>
                        <div class="col-sm-6 col-md-4 bl-result">
                            <span class="status-success">Not listed</span>
                            in
                            <a target="_blank" href="http://www.spamrats.com/">RATS-ALL</a>
                        </div>
                        <div class="col-sm-6 col-md-4 bl-result">
                            <span class="status-success">Not listed</span>
                            in
                            <a target="_blank" href="http://psbl.surriel.com/">PSBL</a>
                        </div>
                        <div class="col-sm-6 col-md-4 bl-result">
                            <span class="status-success">Not listed</span>
                            in
                            <a target="_blank" href="{{ route('testresult' , $email) }}">SWINOG</a>
                        </div>
                        <div class="col-sm-6 col-md-4 bl-result">
                            <span class="status-success">Not listed</span>
                            in
                            <a target="_blank" href="http://www.gbudb.com/truncate/index.jsp">GBUdb Truncate</a>
                        </div>
                        <div class="col-sm-6 col-md-4 bl-result">
                            <span class="status-success">Not listed</span>
                            in
                            <a target="_blank" href="http://wpbl.pc9.org/">Weighted Private Block List</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Broken links -->
        <div class="test-result broken-links opened">
            <div class="header clearfix">
                <div class="status success icon-check"></div>
                <h2 class="title">
                    <i class="icon-down"></i>No broken links</h2>
            </div>
            <div class="content">
                <div class="about">Checks if your newsletter contains broken links.</div>
                <div class="result">No links found.</div>
            </div>
        </div>

        <div class="total text-right subtitle">Your lovely total: 9.7/10</div>
    </div>
</div>

<div id="share-me" class="bg-white pb-3">
    <div class="container clearfix">
        <div style="max-width:400px;" class="float-right input-group" title="Link">
            <input
                class="form-control text-center"
                value="{{ route('testresult' , $email) }}"
                id="permalink"/>
            <div class="input-group-append">
                <span class="input-group-text copy" data-target="permalink" title="Copy">
                    <i class="icon-copy"></i>
                </span>
            </div>

        </div>
    </div>
</div>

</body>
@endsection		