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
            @if    ($total_score>=7) {{ __("Wow! Perfect, you can send") }}
            @elseif($total_score>=5) {{ __("Good! you can send the mail")}}
            @elseif($total_score>=4) {{ __("Warning! you cannot send the mail, but you can improve mail's content.")}}
            @elseif($total_score>=3) {{ __("carefully! don't sen the mail.")}} 
            @else                    {{ __("critical! This is a special spam mail.")}}
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
            {{ __('Subject')}} :
            {{ $message->subject }}
            <div class="float-right date-received" title="{{date( 'l d M Y H:i:s P (T)', strtotime($message->dateReceived) )}}">
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
                        <i class="icon-down"></i>{{ __('Click here to view your message')}}</h2>
                </div>
                <div class="content">
                    <div class="result">
                        <b>{{ __('From :')}}</b>
                        {{ $message->fromAddress }}
                        <br/>
                        <b>{{ __('Bounce address :')}}
                        </b>{{ $message->bounceAddress }}
                        <br/>
                        <b>{{ __('Reply-To :')}}</b>
                            {{ $message->replyto[0] }}
                    </div>

                    <!-- HTML (with images) -->
                    <div class="test-result html-version">
                        <div class="header clearfix">
                            <h3 class="title">
                                <i class="icon-down"></i>{{ __('HTML version')}}</h3>
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
                                {{ __('HTML version (without external images)')}}
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
							<pre>{{  \Soundasleep\Html2Text::convert( preg_replace("/ href=.*?>/",">",  $content_body ), ['ignore_errors' => true] ) }}</pre>
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
                            <pre class="result">{{ __('Received: by')}} {{ env('MAIL_HOST') }} ; {{date('l d M Y H:i:s P (T)', strtotime($message->dateReceived))}} 
{{ $content_header }}
							</pre>
						</div>
					</div>

				</div>
			</div>
			
			<!-- SpamAssassin -->
			<div class="test-result spamassassin">
				<div class="header clearfix">
					<div class="status warning">{{-floatval($assassin_score)}}</div>
					<h2 class="title"><i class="icon-down"></i>{{ __('SpamAssassin thinks you can improve')}}</h2>
				</div>
				<div class="content">
					<div class="about">{{ __('The famous spam filter ')}}
							<a href="http://spamassassin.apache.org/" target="_blank">SpamAssassin</a>. {{ __('Score :')}} {{-$assassin_score}}.
						<br />{{ __('A score below -5 is considered spam.')}}</div>
					<div class="result">
						<table class="table"><tbody>
							<tr class="sa-test">
								@foreach ($score_rules as $key=>$rule)
								<td class="text-center sa-test-score   {{ $rule[4] }} ">{{$rule[1]}}</td>
								<td class="sa-test-name"><samp>{{$rule[0]}}</samp></td>
								<td class="sa-test-description">{{$rule[2]}}
                                    <?php echo (!empty($rule[3]) ? '<br />' : '' ) . '<strong>'.$rule[3].'</strong>' ?></td>
								</tr>
								@endforeach
							
							</tbody></table>					</div>
				</div>
			</div>
			<?php $mail_server_domain = explode('@', $message->bounceAddress)[1]; ?>
			<!-- Signature -->
			<div class="test-result signature">
				<div class="header clearfix">
					<div class="status success icon-check">
											</div>
					<h2 class="title"><i class="icon-down"></i>
							{{$server_auth->title}}</h2>
				</div>
				<div class="content">
					<div class="about">
                            {{$server_auth->description}}
						</div>

					<!-- SPF -->
					<div class="test-result spf">
						<div class="header clearfix">
							<div class="status success icon-check"> </div>
							<h3 class="title"><i class="icon-down"></i>
							    {{$server_auth->subtests->spf->title}}</h3>
						</div>
						<div class="content">
							<div class="about">{{ $server_auth->subtests->spf->description }}</div>
							<div class="result">
                                <?php /*
                                <p>{{ __('What we retained as your current SPF record is:')}}</p>
								@foreach( $spf_check['spf_record']  as $entry)
								<pre>{{$entry}}</pre>
								@endforeach
								<br/>
                            <p>{{ __('Verification details:')}}</p>
							<pre>
@foreach( $spf_check['dig-query'] as  $entry) {{ $entry['cmd'].' :' }} 
@foreach( $entry['details'] as $line)
    {{$line}}
@endforeach

@endforeach
							</pre>
							*/ ?>
                        </div>
                    </div>
                </div>

                <!-- DKIM -->
                <div class="test-result dkim">
                    <div class="header clearfix">
                        <div class="status success icon-check"></div>
                        <h3 class="title">
                            <i class="icon-down"></i>
                            {{ __($server_auth->subtests->dkim->title)}}</h3>
                    </div>
                    <div class="content">
                        <div class="about">{{ __($server_auth->subtests->dkim->description)}}</div>
                        <div class="result">
                            {{$server_auth->subtests->dkim->messages}}
                        </div>
                    </div>
                </div>

                <!-- DMARC -->
                <div class="test-result dmarc">
                    <div class="header clearfix">
                        <div class="status success icon-check"></div>
                        <h3 class="title">
                            <i class="icon-down"></i>
                            {{ __($server_auth->subtests->dmarc->title)}}</h3>
                    </div>
                    <div class="content">
                        <div class="about">{{ __($server_auth->subtests->dmarc->description)}}</div>
                        <div class="result">{{ $server_auth->subtests->dmarc->messages }}
                            <?php /*
							@foreach($dmarc_auth['dmarc_entries'] as $entry)
                            <pre>{{$entry}}</pre>
							@endforeach
                            <p></p>
                            <p>{{ __('Verification details:')}}</p>
                            <pre><ul>
								@foreach($dmarc_auth['dmarc_rows'] as $entry) <li>{{ env('MAIL_HOST') }}; {{$entry}}</li> @endforeach <li>From Domain: {{$mail_server_domain}}</li> <li>DKIM Domain: {{$mail_server_domain}}</li>								
								</ul></pre>
							*/ ?>
                        </div>
                    </div>
                </div>

                <!-- Reverse DNS -->
                <div class="test-result reverse-dns">
                    <div class="header clearfix">
                        <div class="status success icon-check"></div>
                        <h3 class="title">
                            <i class="icon-down"></i> {{$server_auth->subtests->rDns->title}}</h3>
                    </div>
                    <div class="content">
                        <div class="about">{{ __($server_auth->subtests->rDns->description)}}</div>
                        <div class="result">
                            <p>{{$server_auth->subtests->rDns->messages}}</p>
                        </div>
                        <pre class="result">{{$server_auth->subtests->rDns->tested }}</pre>
                    </div>
                </div>

                <!-- A Record Bounce DNS-->
                <?php 
                            // $ii = 0;
                            // $mxhosts = [];
                            // $mxweight = [];
                            // try{
                            //     getmxrr($mail_server_domain,$mxhosts,$mxweight); 
                            // }
                            // catch(Exception $except)
                            // {

                            // }
                            
                            ?>
                <div class="test-result mxrecord-dns">
                    <div class="header clearfix">
                        <div class="status success icon-check"></div>
                        <h3 class="title">
                            <i class="icon-down"></i>{{ $server_auth->subtests->aRecord->title }}</h3>
                    </div>
                    <div class="content">
                        <div class="about">{{ $server_auth->subtests->aRecord->description }}</div>
                        <div class="result">
                            <p>{{$server_auth->subtests->aRecord->messages}}</p>
                        </div>
                        <pre class="result">{{$server_auth->subtests->aRecord->tested}}</pre>
                    </div>
                </div>
                
                <!-- A Record DNS-->
                <div class="test-result arecord-dns">
                    <div class="header clearfix">
                        <div class="status success icon-check"></div>
                        <h3 class="title"><i class="icon-down"></i>{{$server_auth->subtests->mxRecord->title}}</h3>
                    </div>
                    <div class="content">
                        <div class="about">{{$server_auth->subtests->mxRecord->description}}</div>
                        <div class="result">
                            <p>$server_auth->subtests->mxRecord->messages</p>
                        </div>
                        <pre class="result">{{$server_auth->subtests->mxRecord->tested}}</pre>
                    </div>
                </div>
            </div>
        </div>

        <!-- Structure and Content -->
        <div class="test-result structure-and-content">
            <div class="header clearfix">
                <div class="status warning icon-check"></div>
                <h2 class="title"><i class="icon-down"></i>{{ __($BODY_check->title)}}</h2>
            </div>
            <div class="content">

                <div class="about">{{ $BODY_check->description }}</div>
                <div class="result">{{ $BODY_check->messages }}</div>

                <!-- Alt attribute -->
                <div class="test-result alt-attribute">
                    <div class="header clearfix">
                        <div class="status success icon-check"></div>
                        <h3 class="title"><i class="icon-down"></i>
                            {{ $BODY_check->subtests->altAttributes->title}}</h3>
                    </div>
                    <div class="content">
                        <div class="about">{{ $BODY_check->subtests->altAttributes->description}}</div>
                        <div class="result"></div>
                    </div>
                </div>

                <!-- Forbidden tags -->
                <div class="test-result forbidden-tags">
                    <div class="header clearfix">
                        <div class="status success icon-check"></div>
                        <h3 class="title"><i class="icon-down"></i>
                            {{ __($BODY_check->subtests->forbiddenTags->title)}}</h3>
                    </div>
                    <div class="content">
                        <div class="about">{{ $BODY_check->subtests->forbiddenTags->description }}</div>
                        <div class="result">{{$BODY_check->subtests->forbiddenTags->messages}}</div>
                    </div>
                </div>

                <!-- Short LINK -->
                <div class="test-result short-links">
                    <div class="header clearfix">
                        <div class="status success icon-check"></div>
                        <h3 class="title"><i class="icon-down"></i>
                            {{ $BODY_check->subtests->shorturl->title }}</h3>
                    </div>
                    <div class="content">
                        <div class="about">{{ $BODY_check->subtests->shorturl->description  }}</div>
                        <div class="result">{{$BODY_check->subtests->shorturl->messages}}</div>
                        <div class="result">
                            <pre>{{ $BODY_check->subtests->shorturl->tested }}</pre>
                        </div>
                    </div>
                </div>

                <!-- List-unsubscribe -->
                <div class="test-result list-unsubscribe">
                    <div class="header clearfix">
                        <div class="status warning icon-check"></div>
                        <h3 class="title"><i class="icon-down"></i>
                            {{ $BODY_check->subtests->listUnsubscribe->title  }}</h3>
                    </div>
                    <div class="content">
                        <div class="about"> {{ $BODY_check->subtests->listUnsubscribe->description }}</div>
                        <div class="result">{{ $BODY_check->subtests->listUnsubscribe->messages }}</div>
                        <div class="result">
                            <pre>{{$BODY_check->subtests->listUnsubscribe->tested}}</pre>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <!-- Blacklists -->
        <div class="test-result blacklists">
            @if( !empty($BL_results) )
            <div class="header clearfix">
                <div class="status {{ $BL_results->statusClass }}">{{ -$BL_results->mark }}</div>
                <h2 class="title"><i class="icon-down"></i>
                            {{ $BL_results->title}}
                    </h2>
            </div>
            <div class="content">
                <div class="about">{{ $BL_results->description }}</div>
                <div class="result">
                    <div class="row">
						@if(!empty($BL_results->blacklists))
                        @foreach($BL_results->blacklists as $key=>$row)
                        <div class="col-sm-6 col-md-4 bl-result">
                            <span class="{{!empty($row->classname) ? $row->classname : 'status-success' }}">{{$row->name}}</span>
                            in
                            <a target="_blank" href="{{ $row->url }}">{{ $key }}</a>
                        </div>
                        @endforeach
						@endif
                    </div>
                </div>
            </div>
            @endif
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
                <div class="about">{{ __('Checks if your newsletter contains broken links.')}}</div>
                <div class="result">
                        @if(count($broken_urls)==0) {{ __('No links found.')}} 
                        @else 
                        <ul>
                            @foreach($broken_urls as $broken)
                            <li>
                                <div class="col-sm-6 col-md-4 bl-result">
                                    <span class="status-success">{{ __('broken link')}}</span> :
                                    <a target="_blank" href="<?php echo $broken; ?>">{{$broken}}</a>
                                </div>
                            </li>
                            @endforeach
                        </ul>
                    @endif</div>
            </div>
        </div>


        <div class="total text-right subtitle">{{ __('Your lovely total:')}} {{$total_score}}/10</div>
    </div>
</div>

<div id="share-me" class="bg-white pb-3">
    <div class="container clearfix">
        <div style="max-width:400px;" class="float-right input-group" title="Link">
            <input
                class="form-control text-center"
                value="{{ $email }}"
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
    var email = "{{ explode('@', $email)[0] }}";
    setInterval(function() {
        
        $.ajax({
            url: wait_url + '?email={{ explode('@', $email)[0] }}' + '@' + "{{env('MAIL_HOST')}}" + '&message_id=' + new_mail_id,
            dataType: "text",
            cache: false,
            contentType: false,
            processData: false,
            type: "get",
            data:{
                //'message_id' : new_mail_id,
				//'email' : "{{ explode('@', $email)[0] }}" + '@' + "{{env('MAIL_HOST')}}",
                '_token': $('meta[name="csrf-token"]').attr('content')
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
    
    }, fetch_time * 1000);
    function NewLink()
    {
        var added = '&mailbox='+email;
        @if(($request=Request::capture())->input('flag')=='whitelabel')
            added += '&flag=whitelabel';
        @endif
        window.location.href="{{ route('testresult') }}" + "?message_id=" + new_mail_id + added;
    }
</script>
@endsection		