@extends('layouts.user')
  
@section('test_result_css')
<link rel="stylesheet" href="{{ asset('assets/css/testresult.css?v1.0') }}">
@endsection		

@include('mailstester.simple_html_dom')

@section('content')

<body id="result-page">

    <div
        id="header"
        class="text-center pb-5 mh-33 @if($total_score>=7) mark-4 @elseif($total_score>=5) mark-3 @elseif($total_score>=4) mark-2 @elseif($total_score>=3) mark-1 @else mark-0 @endif"
        style='background-color: var(--main-color);'>
        <h1 class="title py-5 m-0 text-white">
            @if    ($total_score>=7) {{ translate("Wow! Perfect, you can send") }}
            @elseif($total_score>=5) {{ translate("Good! you can send the mail")}}
            @elseif($total_score>=4) {{ translate("Warning! you cannot send the mail, but you can improve mail's content.")}}
            @elseif($total_score>=3) {{ translate("carefully! don't sen the mail.")}} 
            @else                    {{ translate("critical! This is a special spam mail.")}}
            @endif
            </h1>
        <div class="subtitle text-white my-3" id="score-label">Score :</div>
        <span class="score">{{$total_score}}/10</span>
    </div>

    <div id="separator" class="bg-primary py-2 clearfix">
        <div class="container text-white" id="mail-info">
            <a
                class="text-white btn btn-transparent btn-sm mr-2"
                href="javascript:NewLink()"
                title="Refresh">
                <i class="icon-refresh"></i>
            </a>
            {{ translate('Subject')}} :
            {{ $message['subject'] }}
            <div class="float-right date-received" title="{{date( 'l d M Y H:i:s P (T)', strtotime($message['receivedAt']) )}}">
                <i class="icon-clock"></i>Received {{$ago_time}}</div>
        </div>
    </div>

    <div id="test-results" class="bg-white">
        <div class="container py-3">

            <!-- Content -->
            <div class="test-result message-content my-3">
                <div class="header clearfix">
                    <div class="status success icon-check"></div>
                    <h2 class="title">
                        <i class="icon-down"></i>{{ translate('Click here to view your message')}}</h2>
                </div>
                <div class="content">
                    <div class="result">
                        <b>{{ translate('From :')}}</b>
                        {{ $message['from'] }}
                        &lt;{{ $message['from_email'] }}&gt;
                        <br/>
                        <b>{{ translate('Bounce address :')}}
                        </b>{{ $message['from_email'] }}
                        <br/>
                        <b>{{ translate('Reply-To :')}}</b>
                        {{ $message['from'] }}
                        &lt;{{ $message['from_email'] }}&gt;
                    </div>

                    <!-- HTML (with images) -->
                    <div class="test-result html-version">
                        <div class="header clearfix">
                            <h3 class="title">
                                <i class="icon-down"></i>{{ translate('HTML version')}}</h3>
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
                               min-height: 200px;  height: 600px; border: 1px solid rgb(204, 204, 204);"></iframe>
                            </div>
                        </div>
                    </div>

                    <!-- HTML (without images) -->
                    <div class="test-result html-version-imageless">
                        <div class="header clearfix">
                            <h3 class="title">
                                <i class="icon-down"></i>
                                {{ translate('HTML version (without external images)')}}
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
                                min-height: 200px;  height: 600px; border: 1px solid rgb(204, 204, 204);"></iframe>

								<div id='mailtext_without_external_images' style='width:100%;'></div>

                                <div class="geniframe" data-source="#originalcontent" data-stripimages="1"></div>
                            </div>
                        </div>
                    </div>

                    <!-- Text -->
                    <div class="test-result text-version">
                        <div class="header clearfix">
                            <h3 class="title">
                                <i class="icon-down"></i>
                                Text version</h3>
                        </div>
                        <div class="content">
							<pre>{{  \Soundasleep\Html2Text::convert( preg_replace("/ href=.*?>/",">",  $message['content'] ) ) }}</pre>
                        </div>
                    </div>

                    <!-- Raw -->
                    <div class="test-result raw-version">
                        <div class="header clearfix">
                            <h3 class="title">
                                <i class="icon-down"></i>
                                Source</h3>
                        </div>
                        <div class="content">
                            <pre class="result">{{ translate('Received: by')}} {{ env('MAIL_HOST') }} ; {{date('l d M Y H:i:s P (T)', strtotime($message['receivedAt']))}} 
{{ $message['header'] }}
							</pre>
						</div>
					</div>

				</div>
			</div>
			
			<!-- SpamAssassin -->
			<div class="test-result spamassassin">
				<div class="header clearfix">
					<div class="status warning">
						-{{10-$score}}					</div>
					<h2 class="title"><i class="icon-down"></i>{{ translate('SpamAssassin thinks you can improve')}}</h2>
				</div>
				<div class="content">
					<div class="about">{{ translate('The famous spam filter ')}}
							<a href="http://spamassassin.apache.org/" target="_blank">SpamAssassin</a>. {{ translate('Score :')}} -{{10-$score}}.
						<br />{{ translate('A score below -5 is considered spam.')}}</div>
					<div class="result">
						<table class="table"><tbody>
							<tr class="sa-test">
								@foreach ($score_rules as $rule)
								<td class="text-center sa-test-score @if($rule['score']-0<0) status-warning @else status-success @endif">{{$rule['score']}}</td>
								<td class="sa-test-name"><samp>{{$rule['key']}}</samp></td>
								<td class="sa-test-description">{{$rule['description']}}
                                    <?php echo (!empty($rule['recommended']) ? '<br />' : '' ) . '<strong>'.$rule['recommended'].'</strong>' ?></td>
								</tr>
								@endforeach
							
							</tbody></table>					</div>
				</div>
			</div>
			<?php $mail_server_domain = explode('@', $message['from_email'])[1]; ?>
			<!-- Signature -->
			<div class="test-result signature">
				<div class="header clearfix">
					<div class="status success icon-check">
											</div>
					<h2 class="title"><i class="icon-down"></i>
							@if ($server_auth['auth_result']=='auth') You're properly authenticated 
							@else Your server don't properly authenticated  @endif</h2>
				</div>
				<div class="content">
					<div class="about">
						@if ($server_auth['auth_result']=='auth') 
                        {{ translate('We check if the server you are sending from is authenticated')}}
						@else {{ translate('We could not check if the server you are sending from is authenticated.')}}  @endif
						</div>

					<!-- SPF -->
					<div class="test-result spf">
						<div class="header clearfix">
							<div class="status success icon-check">
															</div>
							<h3 class="title"><i class="icon-down"></i>
								[SPF] Your server <b>{{$server_auth['serverip']}}</b> is @if($spf_check['auth_result']!='pass') not @endif authorized to use <b>{{$message['from_email']}}</b></h3>
						</div>
						<div class="content">
							<div class="about">{{ translate('Sender Policy Framework (SPF) is an email validation system designed to prevent email spam by detecting email spoofing, a common vulnerability, by verifying sender IP addresses.')}}</div>
							<div class="result"><p>{{ translate('What we retained as your current SPF record is:')}}</p>
								@foreach( $spf_check['spf_record']  as $entry)
								<pre>{{$entry}}</pre>
								@endforeach
								<br/>
                            <p>{{ translate('Verification details:')}}</p>
							<pre>
@foreach( $spf_check['dig-query'] as  $entry) {{ $entry['cmd'].' :' }} 
@foreach( $entry['details'] as $line)
    {{$line}}
@endforeach

@endforeach
							</pre>
							
                        </div>
                    </div>
                </div>

                <!-- DKIM -->
                <div class="test-result dkim">
                    <div class="header clearfix">
                        <div class="status success icon-check"></div>
                        <h3 class="title">
                            <i class="icon-down"></i>
                            {{ translate('Your DKIM signature is valid')}}</h3>
                    </div>
                    <div class="content">
                        <div class="about">{{ translate('DomainKeys Identified Mail (DKIM) is a method for associating
                            a domain name to an email message, thereby allowing a person, role, or
                            organization to claim some responsibility for the message.')}}</div>
                        <div class="result">
                            <p>{{ translate('The DKIM signature of your message is:')}}</p>
                            <pre>{{$dkim_auth['dkim_sign']}}</pre>
                        </div>
                    </div>
                </div>

                <!-- DMARC -->
                <div class="test-result dmarc">
                    <div class="header clearfix">
                        <div class="status success icon-check"></div>
                        <h3 class="title">
                            <i class="icon-down"></i>
                            {{ translate('Your message passed the DMARC test')}}</h3>
                    </div>
                    <div class="content">
                        <div class="about">{{ translate('A DMARC policy allows a sender to indicate that their emails
                            are protected by SPF and/or DKIM, and give instruction if neither of those
                            authentication methods passes. Please be sure you have a DKIM and SPF set before
                            using DMARC.')}}</div>
                        <div class="result">Your DMARC record is @if($dmarc_auth['auth_result']!='auth') not @endif set correctly and your message passed the DMARC test
								<p>DMARC DNS entry found for the domain <b>_dmarc.{{$mail_server_domain}}</b>:</p>
							@foreach($dmarc_auth['dmarc_entries'] as $entry)
                            <pre>{{$entry}}</pre>
							@endforeach
                            <p></p>
                            <p>{{ translate('Verification details:')}}</p>
                            <pre><ul>
								@foreach($dmarc_auth['dmarc_rows'] as $entry) <li>{{ env('MAIL_HOST') }}; {{$entry}}</li> @endforeach <li>From Domain: {{$mail_server_domain}}</li> <li>DKIM Domain: {{$mail_server_domain}}</li>								
								</ul></pre>
							
                        </div>
                    </div>
                </div>

                <!-- Reverse DNS -->
                <div class="test-result reverse-dns">
                    <div class="header clearfix">
                        <div class="status success icon-check"></div>
                        <h3 class="title">
                            <i class="icon-down"></i>
                            Your server
                            <b>{{$server_auth['serverip']}}</b>
                            is successfully associated with
                            <b>{{ empty($rdns_auth['helo_domain']) ? $rdns_auth['rdns_domain'] :$rdns_auth['helo_domain'] }}</b>
                        </h3>
                    </div>
                    <div class="content">
                        <div class="about">{{ translate('Reverse DNS lookup or reverse DNS resolution (rDNS) is the
                            determination of a domain name that is associated with a given IP address.<br/>Some
                            companies such as AOL will reject any message sent from a server without rDNS,
                            so you must ensure that you have one.<br/>You cannot associate more than one domain name with a single IP address.')}}</div>
                        <div class="result">
                            <p></p>
                        </div>
                        <pre class="result">{{ translate('Here are the tested values for this check:')}}<br /><ul>
							<li>IP: {{$rdns_auth['server_ip']}}</li>
                            <li>HELO: {{$rdns_auth['helo_domain']}}</li>
                            <li>rDNS: {{$rdns_auth['rdns_domain']}}</li>
                        </ul></pre>
                    </div>
                </div>

                <!-- A Record Bounce DNS-->
                <?php 
                            $ii = 0;
                            $mxhosts = [];
                            $mxweight = [];
                            try{
                                getmxrr($mail_server_domain,$mxhosts,$mxweight); 
                            }
                            catch(Exception $except)
                            {

                            }
                            
                            ?>
                <div class="test-result mxrecord-dns">
                    <div class="header clearfix">
                        <div class="status success icon-check"></div>
                        <h3 class="title">
                            <i class="icon-down"></i>
                            Your domain name
                            <strong>{{$mail_server_domain}}</strong>
                            is assigned to a mail server.</h3>
                    </div>
                    <div class="content">
                        <div class="about">We check if there is a mail server (MX Record) behind your domain name
                            <strong>{{$mail_server_domain}}</strong>.</div>
                        <div class="result">
                            <p></p>
                        </div>
                        <pre class="result">MX records ({{$mail_server_domain}}) : <ul>
                            @foreach( $mxhosts as $host_domain)
                            <li> {{ $mxweight[$ii++] }} {{$host_domain}}.</li>
                            @endforeach
                        </ul></pre>
                    </div>
                </div>
                
                <!-- A Record DNS-->
                <div class="test-result arecord-dns">
                    <div class="header clearfix">
                        <div class="status success icon-check"></div>
                        <h3 class="title">
                            <i class="icon-down"></i>
                            Your hostname
                            <strong>{{ empty($rdns_auth['rdns_domain']) ? $rdns_auth['helo_domain'] : $rdns_auth['rdns_domain']}}</strong>
                            is assigned to a server.</h3>
                    </div>
                    <div class="content">
                        <div class="about">We check if there is a server (A Record) behind your hostname
                            <strong>{{ empty($rdns_auth['rdns_domain']) ? $rdns_auth['helo_domain'] : $rdns_auth['rdns_domain']}}</strong>.</div>
                        <div class="result">
                            <p></p>
                        </div>
                        <pre class="result">A records ({{ empty($rdns_auth['rdns_domain']) ? $rdns_auth['helo_domain'] : $rdns_auth['rdns_domain']}}) : <ul><li>{{$server_auth['serverip']}}</li></ul></pre>
                    </div>
                </div>
            </div>
        </div>

        <!-- Structure and Content -->
        <div class="test-result structure-and-content">
            <div class="header clearfix">
                <div class="h-100 status warning icon-check"></div>
                <h2 class="title">
                    <i class="icon-down"></i>{{ translate('Your message could be improved')}}</h2>
            </div>
            <div class="content">

                <div class="about">{{ translate('Checks whether your message is well formatted or not.')}}</div>
                <div class="result">
                    <p class="message-weight">{{ translate('Weight of the HTML version of your message:')}}
                        <b>{{  size(strlen($message['content']) ) }}</b>.</p>
                    <p>Your message contains
                        <b>{{ strlen($message['content'])==0 ? '&nbsp;' : round(strlen( \Soundasleep\Html2Text::convert( $message['content'] ) ) / strlen($message['content'])  * 100) }}</b>% of text.</p>
                </div>

                <!-- Alt attribute -->
                <div class="test-result alt-attribute">
                    <div class="header clearfix">
                        <div class="status success icon-check"></div>
                        <h3 class="title">
                            <i class="icon-down"></i>
                            {{ translate('You have no images in your message')}}</h3>
                    </div>
                    <div class="content">
                        <div class="about">{{ translate('ALT attributes provide a textual alternative to your images.<br/>It
                            is a useful fallback for people who are blind or visually impaired and for cases
                            where your images cannot be displayed.')}}</div>
                        <div class="result"></div>
                    </div>
                </div>

                <!-- Forbidden tags -->
                <div class="test-result forbidden-tags">
                    <div class="header clearfix">
                        <div class="status success icon-check"></div>
                        <h3 class="title">
                            <i class="icon-down"></i>
                            {{ translate('Your content is safe')}}</h3>
                    </div>
                    <div class="content">
                        <div class="about">{{ translate('Checks whether your message contains dangerous html elements such as javascript, iframes, embed content or applet.')}}</div>
                        <div class="result"></div>
                    </div>
                </div>

                <!-- Short LINK -->
                <div class="test-result short-links">
                    <div class="header clearfix">
                        <div class="status success icon-check"></div>
                        <h3 class="title">
                            <i class="icon-down"></i>
                            {{ translate("We didn't find short URLs")}}</h3>
                    </div>
                    <div class="content">
                        <div class="about">{{ translate('Checks whether your message uses URL shortener systems.')}}</div>
                        <div class="result"></div>
                        <div class="result">
                            <pre></pre>
                        </div>
                    </div>
                </div>

                <!-- List-unsubscribe -->
                <div class="test-result list-unsubscribe">
                    <div class="header clearfix">
                        <div class="status warning icon-check"></div>
                        <h3 class="title">
                            <i class="icon-down"></i>
                            {{ translate('Your message does not contain a List-Unsubscribe header')}}</h3>
                    </div>
                    <div class="content">
                        <div class="about"> {{ translate('The List-Unsubscribe header is required if you send mass emails, it enables the user to easily unsubscribe from your mailing list.')}}</div>
                        <div class="result">{{ translate('Your message does not contain a List-Unsubscribe header')}}</div>
                        <div class="result">
                            <pre></pre>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <!-- Blacklists -->
        <div class="test-result blacklists">
            <div class="header clearfix">
                <div class="h-100 status @if($black_list_score==0) success icon-check @else failure @endif">@if($black_list_score!=0) {{-$black_list_score}} @endif</div>
                <h2 class="title">
                    <i class="icon-down"></i>
                        @if($black_list_score==0)
                            {{ translate("You're not blacklisted")}}
                        @else
                            {{ translate("You're listed in blacklist")}} {{ $black_list_score/$bl_score_unit }} 
                        @endif
                    </h2>
            </div>
            <div class="content">
                <div class="about">{{ translate('Matches your server IP address')}} (<b>{{$server_auth['serverip']}}</b>) against {{ count($BL_results) }} of the most common IPv4 blacklists.</div>
                <div class="result">
                    <div class="row">
                        @foreach($BL_results as $key=>$row)
                        <div class="col-sm-6 col-md-4 bl-result">
                            <span class="{{$row['classname']}}">{{$row['label']}}</span>
                            in
                            <a target="_blank" href="https://{{ $row['url'] }}">{{ $key }}</a>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <!-- Broken links -->
        <div class="test-result broken-links">
            <div class="header clearfix">
            <div class="status @if($broken_score>=0.5) failure @elseif($broken_score>0) warning @else success icon-check @endif">@if(count($broken_urls)>0) 
                        {{ -$broken_score }}
                     @endif</div>
                <h2 class="title">
                    <i class="icon-down"></i>@if(count($broken_urls)>0) You have {{count($broken_urls)}} broken links @else No broken links @endif</h2>
            </div>
            <div class="content">
                <div class="about">{{ translate('Checks if your newsletter contains broken links.')}}</div>
                <div class="result">
                        @if(count($broken_urls)==0) {{ translate('No links found.')}} 
                        @else 
                        <ul>
                            @foreach($broken_urls as $broken)
                            <li>
                                <div class="col-sm-6 col-md-4 bl-result">
                                    <span class="status-success">{{ translate('broken link')}}</span> :
                                    <a target="_blank" href="<?php echo $broken['url']; ?>">{{$broken['url']}}</a>
                                </div>
                            </li>
                            @endforeach
                        </ul>
                    @endif</div>
            </div>
        </div>


        <div class="total text-right subtitle">{{ translate('Your lovely total:')}} {{$total_score}}/10</div>
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

@if( !empty($css))
    <style>
        {{ $css }}
    </style>
@endif
@endsection		


@section('testresultjs')
<script>
    var new_mail_id = '{{ $mail_id }}';
    setInterval(function() {
        
        $.ajax({
            url: wait_url,
            dataType: "text",
            cache: false,
            contentType: false,
            processData: false,
            type: "get",
            data:{
                
                message_id : new_mail_id,
                _token: $('meta[name="csrf-token"]').attr('content')
            },
            success:function(data) {
                data = JSON.parse(data);
                if(data.result=='ok')
                {
                    if(data.message_id!=new_mail_id)
                    {
                        new_mail_id = data.message_id;  
                        console.log("new mail has been received, id=" + new_mail_id);
                    }
                }
            }
        });
    
    }, 10000);
    function NewLink()
    {
        var added = '';
        @if(($request=Request::capture())->input('flag')=='whitelabel')
            added = '&flag=whitelabel';
        @endif
        window.location.href="{{ route('testresult') }}" + "?message_id=" + new_mail_id + added;
    }
</script>
@endsection		