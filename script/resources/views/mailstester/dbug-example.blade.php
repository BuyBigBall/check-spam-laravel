<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<!-- saved from url=(0040) -->
<html xmlns="http://www.w3.org/1999/xhtml" lang="en"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	
	<title>API Example - Mail-Tester.com</title>
	<meta name="keywords" content="mail,tester,API, example, dbug, structure">
	<meta name="description" content="Example object returned by the Mail-Tester API">
	<meta name="viewport" content="width=device-width">
	<link rel="icon" type="image/png" href="/public/upload/favicon.png">
<script language="JavaScript">
			/* code modified from ColdFusion's cfdump code */
				function dBug_toggleRow(source) {
					var target = (document.all) ? source.parentElement.cells[1] : source.parentNode.lastChild;
					dBug_toggleTarget(target,dBug_toggleSource(source));
				}
				
				function dBug_toggleSource(source) {
					if (source.style.fontStyle=='italic') {
						source.style.fontStyle='normal';
						source.title='click to collapse';
						return 'open';
					} else {
						source.style.fontStyle='italic';
						source.title='click to expand';
						return 'closed';
					}
				}
			
				function dBug_toggleTarget(target,switchToState) {
					target.style.display = (switchToState=='open') ? '' : 'none';
				}
			
				function dBug_toggleTable(source) {
					var switchToState=dBug_toggleSource(source);
					if(document.all) {
						var table=source.parentElement.parentElement;
						for(var i=1;i<table.rows.length;i++) {
							target=table.rows[i];
							dBug_toggleTarget(target,switchToState);
						}
					}
					else {
						var table=source.parentNode.parentNode;
						for (var i=1;i<table.childNodes.length;i++) {
							target=table.childNodes[i];
							if(target.style) {
								dBug_toggleTarget(target,switchToState);
							}
						}
					}
				}
			</script><style type="text/css">
				table.dBug_array,table.dBug_object,table.dBug_resource,table.dBug_resourceC,table.dBug_xml {
					font-family:Verdana, Arial, Helvetica, sans-serif; color:#000000; font-size:12px;
				}
				
				.dBug_arrayHeader,
				.dBug_objectHeader,
				.dBug_resourceHeader,
				.dBug_resourceCHeader,
				.dBug_xmlHeader 
					{ font-weight:bold; color:#FFFFFF; cursor:pointer; }
				
				.dBug_arrayKey,
				.dBug_objectKey,
				.dBug_xmlKey 
					{ cursor:pointer; }
					
				/* array */
				table.dBug_array { background-color:#006600; }
				table.dBug_array td { background-color:#FFFFFF; }
				table.dBug_array td.dBug_arrayHeader { background-color:#009900; }
				table.dBug_array td.dBug_arrayKey { background-color:#CCFFCC; }
				
				/* object */
				table.dBug_object { background-color:#0000CC; }
				table.dBug_object td { background-color:#FFFFFF; }
				table.dBug_object td.dBug_objectHeader { background-color:#4444CC; }
				table.dBug_object td.dBug_objectKey { background-color:#CCDDFF; }
				
				/* resource */
				table.dBug_resourceC { background-color:#884488; }
				table.dBug_resourceC td { background-color:#FFFFFF; }
				table.dBug_resourceC td.dBug_resourceCHeader { background-color:#AA66AA; }
				table.dBug_resourceC td.dBug_resourceCKey { background-color:#FFDDFF; }
				
				/* resource */
				table.dBug_resource { background-color:#884488; }
				table.dBug_resource td { background-color:#FFFFFF; }
				table.dBug_resource td.dBug_resourceHeader { background-color:#AA66AA; }
				table.dBug_resource td.dBug_resourceKey { background-color:#FFDDFF; }
				
				/* xml */
				table.dBug_xml { background-color:#888888; }
				table.dBug_xml td { background-color:#FFFFFF; }
				table.dBug_xml td.dBug_xmlHeader { background-color:#AAAAAA; }
				table.dBug_xml td.dBug_xmlKey { background-color:#DDDDDD; }
			</style></head>

			
			
			
			
		<body style="background-color:white !important;" bgcolor="#e4e3e3">
			<table cellspacing="2" cellpadding="3" class="dBug_object">
				<tbody><tr>
					<td class="dBug_objectHeader" colspan="2" onclick="dBug_toggleTable(this)">$c (object)</td>
				</tr><tr>
				<td valign="top" onclick="dBug_toggleRow(this)" class="dBug_objectKey">title</td>
				<td>Wow! Perfect, you can send</td></tr>
<tr>
				<td valign="top" onclick="dBug_toggleRow(this)" class="dBug_objectKey">mark</td>
				<td>-0.5</td></tr>
<tr>
				<td valign="top" onclick="dBug_toggleRow(this)" class="dBug_objectKey">displayedMark</td>
				<td>9.5/10</td></tr>
<tr>
				<td valign="top" onclick="dBug_toggleRow(this)" class="dBug_objectKey">maxMark</td>
				<td>0</td></tr>
<tr>
				<td valign="top" onclick="dBug_toggleRow(this)" class="dBug_objectKey">commentedMark</td>
				<td>Your lovely total: 9.5/10</td></tr>
<tr>
				<td valign="top" onclick="dBug_toggleRow(this)" class="dBug_objectKey">success</td>
				<td>TRUE</td></tr>
<tr>
				<td valign="top" onclick="dBug_toggleRow(this)" class="dBug_objectKey">redirect</td>
				<td>[empty string]</td></tr>
<tr>
				<td valign="top" onclick="dBug_toggleRow(this)" class="dBug_objectKey">mailboxId</td>
				<td>api-example</td></tr>
<tr>
				<td valign="top" onclick="dBug_toggleRow(this)" class="dBug_objectKey">messageId</td>
				<td>821101</td></tr>
<tr>
				<td valign="top" onclick="dBug_toggleRow(this)" class="dBug_objectKey">markClass</td>
				<td>mark-4</td></tr>
<tr>
				<td valign="top" onclick="dBug_toggleRow(this)" class="dBug_objectKey">messageInfo</td>
				<td><table cellspacing="2" cellpadding="3" class="dBug_object">
				<tbody><tr>
					<td class="dBug_objectHeader" colspan="2" onclick="dBug_toggleTable(this)">object</td>
				</tr><tr>
				<td valign="top" onclick="dBug_toggleRow(this)" class="dBug_objectKey">subject</td>
				<td>Subject: Tell us how to make Acy better</td></tr>
<tr>
				<td valign="top" onclick="dBug_toggleRow(this)" class="dBug_objectKey">dateReceivedDisplayed</td>
				<td>Received 0 minutes ago</td></tr>
<tr>
				<td valign="top" onclick="dBug_toggleRow(this)" class="dBug_objectKey">dateReceived</td>
				<td>2013-12-10 20:20:10</td></tr>
<tr>
				<td valign="top" onclick="dBug_toggleRow(this)" class="dBug_objectKey">bounceAddress</td>
				<td>no-reply@acyba.com</td></tr>
<tr>
				<td valign="top" onclick="dBug_toggleRow(this)" class="dBug_objectKey">bounceAddressDisplayed</td>
				<td>Bounce address: no-reply@acyba.com</td></tr>
</tbody></table></td></tr>
<tr>
				<td valign="top" onclick="dBug_toggleRow(this)" class="dBug_objectKey">spamAssassin</td>
				<td><table cellspacing="2" cellpadding="3" class="dBug_object">
				<tbody><tr>
					<td class="dBug_objectHeader" colspan="2" onclick="dBug_toggleTable(this)">object</td>
				</tr><tr>
				<td valign="top" onclick="dBug_toggleRow(this)" class="dBug_objectKey">title</td>
				<td>SpamAssassin likes you</td></tr>
<tr>
				<td valign="top" onclick="dBug_toggleRow(this)" class="dBug_objectKey">score</td>
				<td>0.1</td></tr>
<tr>
				<td valign="top" onclick="dBug_toggleRow(this)" class="dBug_objectKey">threshold</td>
				<td>-5</td></tr>
<tr>
				<td valign="top" onclick="dBug_toggleRow(this)" class="dBug_objectKey">mark</td>
				<td>0</td></tr>
<tr>
				<td valign="top" onclick="dBug_toggleRow(this)" class="dBug_objectKey">diplayedMark</td>
				<td>0</td></tr>
<tr>
				<td valign="top" onclick="dBug_toggleRow(this)" class="dBug_objectKey">statusClass</td>
				<td>success</td></tr>
<tr>
				<td valign="top" onclick="dBug_toggleRow(this)" class="dBug_objectKey">rules</td>
				<td><table cellspacing="2" cellpadding="3" class="dBug_array">
				<tbody><tr>
					<td class="dBug_arrayHeader" colspan="2" onclick="dBug_toggleTable(this)">array</td>
				</tr><tr>
				<td valign="top" onclick="dBug_toggleRow(this)" class="dBug_arrayKey">DKIM_SIGNED</td>
				<td><table cellspacing="2" cellpadding="3" class="dBug_object">
				<tbody><tr>
					<td class="dBug_objectHeader" colspan="2" onclick="dBug_toggleTable(this)">object</td>
				</tr><tr>
				<td valign="top" onclick="dBug_toggleRow(this)" class="dBug_objectKey">code</td>
				<td>DKIM_SIGNED</td></tr>
<tr>
				<td valign="top" onclick="dBug_toggleRow(this)" class="dBug_objectKey">score</td>
				<td>-0.1</td></tr>
<tr>
				<td valign="top" onclick="dBug_toggleRow(this)" class="dBug_objectKey">description</td>
				<td>Message has a DKIM or DK signature, not necessarily valid</td></tr>
<tr>
				<td valign="top" onclick="dBug_toggleRow(this)" class="dBug_objectKey">solution</td>
				<td>[empty string]</td></tr>
<tr>
				<td valign="top" onclick="dBug_toggleRow(this)" class="dBug_objectKey">status</td>
				<td>status-warning</td></tr>
</tbody></table></td></tr>
<tr>
				<td valign="top" onclick="dBug_toggleRow(this)" class="dBug_arrayKey">DKIM_VALID</td>
				<td><table cellspacing="2" cellpadding="3" class="dBug_object">
				<tbody><tr>
					<td class="dBug_objectHeader" colspan="2" onclick="dBug_toggleTable(this)">object</td>
				</tr><tr>
				<td valign="top" onclick="dBug_toggleRow(this)" class="dBug_objectKey">code</td>
				<td>DKIM_VALID</td></tr>
<tr>
				<td valign="top" onclick="dBug_toggleRow(this)" class="dBug_objectKey">score</td>
				<td>0.1</td></tr>
<tr>
				<td valign="top" onclick="dBug_toggleRow(this)" class="dBug_objectKey">description</td>
				<td>Message has at least one valid DKIM or DK signature</td></tr>
<tr>
				<td valign="top" onclick="dBug_toggleRow(this)" class="dBug_objectKey">solution</td>
				<td>[empty string]</td></tr>
<tr>
				<td valign="top" onclick="dBug_toggleRow(this)" class="dBug_objectKey">status</td>
				<td>status-success</td></tr>
</tbody></table></td></tr>
<tr>
				<td valign="top" onclick="dBug_toggleRow(this)" class="dBug_arrayKey">DKIM_VALID_AU</td>
				<td><table cellspacing="2" cellpadding="3" class="dBug_object">
				<tbody><tr>
					<td class="dBug_objectHeader" colspan="2" onclick="dBug_toggleTable(this)">object</td>
				</tr><tr>
				<td valign="top" onclick="dBug_toggleRow(this)" class="dBug_objectKey">code</td>
				<td>DKIM_VALID_AU</td></tr>
<tr>
				<td valign="top" onclick="dBug_toggleRow(this)" class="dBug_objectKey">score</td>
				<td>0.1</td></tr>
<tr>
				<td valign="top" onclick="dBug_toggleRow(this)" class="dBug_objectKey">description</td>
				<td>Message has a valid DKIM or DK signature from author's domain</td></tr>
<tr>
				<td valign="top" onclick="dBug_toggleRow(this)" class="dBug_objectKey">solution</td>
				<td>[empty string]</td></tr>
<tr>
				<td valign="top" onclick="dBug_toggleRow(this)" class="dBug_objectKey">status</td>
				<td>status-success</td></tr>
</tbody></table></td></tr>
<tr>
				<td valign="top" onclick="dBug_toggleRow(this)" class="dBug_arrayKey">	HTML_MESSAGE</td>
				<td><table cellspacing="2" cellpadding="3" class="dBug_object">
				<tbody><tr>
					<td class="dBug_objectHeader" colspan="2" onclick="dBug_toggleTable(this)">object</td>
				</tr><tr>
				<td valign="top" onclick="dBug_toggleRow(this)" class="dBug_objectKey">code</td>
				<td>	HTML_MESSAGE</td></tr>
<tr>
				<td valign="top" onclick="dBug_toggleRow(this)" class="dBug_objectKey">score</td>
				<td>-0.001</td></tr>
<tr>
				<td valign="top" onclick="dBug_toggleRow(this)" class="dBug_objectKey">description</td>
				<td>HTML included in message</td></tr>
<tr>
				<td valign="top" onclick="dBug_toggleRow(this)" class="dBug_objectKey">solution</td>
				<td>[empty string]</td></tr>
<tr>
				<td valign="top" onclick="dBug_toggleRow(this)" class="dBug_objectKey">status</td>
				<td>status-warning</td></tr>
</tbody></table></td></tr>
<tr>
				<td valign="top" onclick="dBug_toggleRow(this)" class="dBug_arrayKey">RP_MATCHES_RCVD</td>
				<td><table cellspacing="2" cellpadding="3" class="dBug_object">
				<tbody><tr>
					<td class="dBug_objectHeader" colspan="2" onclick="dBug_toggleTable(this)">object</td>
				</tr><tr>
				<td valign="top" onclick="dBug_toggleRow(this)" class="dBug_objectKey">code</td>
				<td>RP_MATCHES_RCVD</td></tr>
<tr>
				<td valign="top" onclick="dBug_toggleRow(this)" class="dBug_objectKey">score</td>
				<td>0.001</td></tr>
<tr>
				<td valign="top" onclick="dBug_toggleRow(this)" class="dBug_objectKey">description</td>
				<td>Envelope sender domain matches handover relay domain</td></tr>
<tr>
				<td valign="top" onclick="dBug_toggleRow(this)" class="dBug_objectKey">solution</td>
				<td>[empty string]</td></tr>
<tr>
				<td valign="top" onclick="dBug_toggleRow(this)" class="dBug_objectKey">status</td>
				<td>status-success</td></tr>
</tbody></table></td></tr>
<tr>
				<td valign="top" onclick="dBug_toggleRow(this)" class="dBug_arrayKey">SPF_PASS</td>
				<td><table cellspacing="2" cellpadding="3" class="dBug_object">
				<tbody><tr>
					<td class="dBug_objectHeader" colspan="2" onclick="dBug_toggleTable(this)">object</td>
				</tr><tr>
				<td valign="top" onclick="dBug_toggleRow(this)" class="dBug_objectKey">code</td>
				<td>SPF_PASS</td></tr>
<tr>
				<td valign="top" onclick="dBug_toggleRow(this)" class="dBug_objectKey">score</td>
				<td>0.001</td></tr>
<tr>
				<td valign="top" onclick="dBug_toggleRow(this)" class="dBug_objectKey">description</td>
				<td>SPF: sender matches SPF record</td></tr>
<tr>
				<td valign="top" onclick="dBug_toggleRow(this)" class="dBug_objectKey">solution</td>
				<td>[empty string]</td></tr>
<tr>
				<td valign="top" onclick="dBug_toggleRow(this)" class="dBug_objectKey">status</td>
				<td>status-success</td></tr>
</tbody></table></td></tr>
</tbody></table></td></tr>
<tr>
				<td valign="top" onclick="dBug_toggleRow(this)" class="dBug_objectKey">description</td>
				<td>The famous spam filter <a href="http://spamassassin.apache.org/" target="_blank">SpamAssassin</a>. Score: 0.1.<br>A score below -5 is considered spam.</td></tr>
<tr>
				<td valign="top" onclick="dBug_toggleRow(this)" class="dBug_objectKey">displayedMark</td>
				<td>✓</td></tr>
</tbody></table></td></tr>
<tr>
				<td valign="top" onclick="dBug_toggleRow(this)" class="dBug_objectKey">signature</td>
				<td><table cellspacing="2" cellpadding="3" class="dBug_object">
				<tbody><tr>
					<td class="dBug_objectHeader" colspan="2" onclick="dBug_toggleTable(this)">object</td>
				</tr><tr>
				<td valign="top" onclick="dBug_toggleRow(this)" class="dBug_objectKey">title</td>
				<td>You're properly authenticated</td></tr>
<tr>
				<td valign="top" onclick="dBug_toggleRow(this)" class="dBug_objectKey">mark</td>
				<td>0</td></tr>
<tr>
				<td valign="top" onclick="dBug_toggleRow(this)" class="dBug_objectKey">displayedMark</td>
				<td>✓</td></tr>
<tr>
				<td valign="top" onclick="dBug_toggleRow(this)" class="dBug_objectKey">status</td>
				<td>[empty string]</td></tr>
<tr>
				<td valign="top" onclick="dBug_toggleRow(this)" class="dBug_objectKey">statusClass</td>
				<td>success</td></tr>
<tr>
				<td valign="top" onclick="dBug_toggleRow(this)" class="dBug_objectKey">description</td>
				<td>We check if the server you are sending from is authenticated</td></tr>
<tr>
				<td valign="top" onclick="dBug_toggleRow(this)" class="dBug_objectKey">subtests</td>
				<td><table cellspacing="2" cellpadding="3" class="dBug_object">
				<tbody><tr>
					<td class="dBug_objectHeader" colspan="2" onclick="dBug_toggleTable(this)">object</td>
				</tr><tr>
				<td valign="top" onclick="dBug_toggleRow(this)" class="dBug_objectKey">spf</td>
				<td><table cellspacing="2" cellpadding="3" class="dBug_object">
				<tbody><tr>
					<td class="dBug_objectHeader" colspan="2" onclick="dBug_toggleTable(this)">object</td>
				</tr><tr>
				<td valign="top" onclick="dBug_toggleRow(this)" class="dBug_objectKey">title</td>
				<td>[SPF] Your server 46.105.17.43 is authorized to use no-reply@acyba.com</td></tr>
<tr>
				<td valign="top" onclick="dBug_toggleRow(this)" class="dBug_objectKey">mark</td>
				<td>0</td></tr>
<tr>
				<td valign="top" onclick="dBug_toggleRow(this)" class="dBug_objectKey">displayedMark</td>
				<td>✓</td></tr>
<tr>
				<td valign="top" onclick="dBug_toggleRow(this)" class="dBug_objectKey">status</td>
				<td>pass</td></tr>
<tr>
				<td valign="top" onclick="dBug_toggleRow(this)" class="dBug_objectKey">statusClass</td>
				<td>success</td></tr>
<tr>
				<td valign="top" onclick="dBug_toggleRow(this)" class="dBug_objectKey">description</td>
				<td>Sender Policy Framework (SPF) is an email validation system designed to prevent email spam by detecting email spoofing, a common vulnerability, by verifying sender IP addresses.</td></tr>
<tr>
				<td valign="top" onclick="dBug_toggleRow(this)" class="dBug_objectKey">messages</td>
				<td><p>What we retained as your current SPF record is:</p><pre>"v=spf1 a mx include:_spf.google.com include:helpscoutemail.com ~all"</pre></td></tr>
<tr>
				<td valign="top" onclick="dBug_toggleRow(this)" class="dBug_objectKey">record</td>
				<td>"v=spf1 a mx include:_spf.google.com include:helpscoutemail.com ~all"</td></tr>
<tr>
				<td valign="top" onclick="dBug_toggleRow(this)" class="dBug_objectKey">newrecord</td>
				<td>"v=spf1 a mx include:_spf.google.com include:helpscoutemail.com ~all"</td></tr>
</tbody></table></td></tr>
<tr>
				<td valign="top" onclick="dBug_toggleRow(this)" class="dBug_objectKey">senderId</td>
				<td><table cellspacing="2" cellpadding="3" class="dBug_object">
				<tbody><tr>
					<td class="dBug_objectHeader" colspan="2" onclick="dBug_toggleTable(this)">object</td>
				</tr><tr>
				<td valign="top" onclick="dBug_toggleRow(this)" class="dBug_objectKey">title</td>
				<td>[Sender ID] Your server 46.105.17.43 is authorized to use info@acyba.com</td></tr>
<tr>
				<td valign="top" onclick="dBug_toggleRow(this)" class="dBug_objectKey">mark</td>
				<td>0</td></tr>
<tr>
				<td valign="top" onclick="dBug_toggleRow(this)" class="dBug_objectKey">displayedMark</td>
				<td>✓</td></tr>
<tr>
				<td valign="top" onclick="dBug_toggleRow(this)" class="dBug_objectKey">status</td>
				<td>pass</td></tr>
<tr>
				<td valign="top" onclick="dBug_toggleRow(this)" class="dBug_objectKey">statusClass</td>
				<td>success</td></tr>
<tr>
				<td valign="top" onclick="dBug_toggleRow(this)" class="dBug_objectKey">description</td>
				<td>Sender ID is like SPF, but it checks the FROM address, not the bounce address.</td></tr>
<tr>
				<td valign="top" onclick="dBug_toggleRow(this)" class="dBug_objectKey">messages</td>
				<td><p>What we retained as your current SPF record is:</p><pre>"v=spf1 a mx include:_spf.google.com include:helpscoutemail.com ~all"</pre></td></tr>
<tr>
				<td valign="top" onclick="dBug_toggleRow(this)" class="dBug_objectKey">pra</td>
				<td>info@acyba.com</td></tr>
<tr>
				<td valign="top" onclick="dBug_toggleRow(this)" class="dBug_objectKey">record</td>
				<td>"v=spf1 a mx include:_spf.google.com include:helpscoutemail.com ~all"</td></tr>
</tbody></table></td></tr>
<tr>
				<td valign="top" onclick="dBug_toggleRow(this)" class="dBug_objectKey">dkim</td>
				<td><table cellspacing="2" cellpadding="3" class="dBug_object">
				<tbody><tr>
					<td class="dBug_objectHeader" colspan="2" onclick="dBug_toggleTable(this)">object</td>
				</tr><tr>
				<td valign="top" onclick="dBug_toggleRow(this)" class="dBug_objectKey">title</td>
				<td>Your DKIM signature is valid</td></tr>
<tr>
				<td valign="top" onclick="dBug_toggleRow(this)" class="dBug_objectKey">mark</td>
				<td>0</td></tr>
<tr>
				<td valign="top" onclick="dBug_toggleRow(this)" class="dBug_objectKey">displayedMark</td>
				<td>✓</td></tr>
<tr>
				<td valign="top" onclick="dBug_toggleRow(this)" class="dBug_objectKey">status</td>
				<td>pass</td></tr>
<tr>
				<td valign="top" onclick="dBug_toggleRow(this)" class="dBug_objectKey">statusClass</td>
				<td>success</td></tr>
<tr>
				<td valign="top" onclick="dBug_toggleRow(this)" class="dBug_objectKey">description</td>
				<td>DomainKeys Identified Mail (DKIM) is a method for associating a domain name to an email message, thereby allowing a person, role, or organization to claim some responsibility for the message.</td></tr>
<tr>
				<td valign="top" onclick="dBug_toggleRow(this)" class="dBug_objectKey">messages</td>
				<td><p>The DKIM signature of your message is:</p><pre>	v=1;
	a=rsa-sha256;
	c=simple/simple;
	d=acyba.com;
	s=mail;
	t=1386703224;
	bh=ILt+oovPOcamnKrEXdJQYwbzLT8I9t6cPk5DmGx3YaU=;
	h=To:Subject:Date:From:Reply-To:Message-ID:List-Unsubscribe:MIME-Version:Content-Type:Content-Transfer-Encoding;
	b=uRFWMmCV3kKzlXARm/2c4q45eQyCSWT/eoOEFZVSenV/+f+Khz3k58WjPVX/r51YR20JAb1C+V7x22PxFp7BoRY3GlJ+PGh7o3fo7phB5xlF/v+7aUGf4H6BRScvFr0ur1zBiZGBOkIpWnWJTpEBRkR2xFcv+dKmGC9aaNGPl2Y=</pre><p>Your public key is:</p><pre>"v=DKIM1;
s=email;
t=s;
p=MIGfMA0GCSqGSIb3DQEBAQUAA4GNADCBiQKBgQDi2m73mDOdhd3jOxC7G/c89EjVRU2Oe/zYjoEA49svJMk7Jd0sRdvNltOKWCSR5hkgIuMd/rG9zcxenbPC1PBV2a8GsnVvtnVFY9vcLOXoaN9+eE3H+1OeJ7NdvJ8cadGw6BXjTF9EcFd5Qv6ykIi8xHij91K0QvWDfWoNzNenwwIDAQAB"</pre><p>Key length: 1024bits</p></td></tr>
</tbody></table></td></tr>
<tr>
				<td valign="top" onclick="dBug_toggleRow(this)" class="dBug_objectKey">rDns</td>
				<td><table cellspacing="2" cellpadding="3" class="dBug_object">
				<tbody><tr>
					<td class="dBug_objectHeader" colspan="2" onclick="dBug_toggleTable(this)">object</td>
				</tr><tr>
				<td valign="top" onclick="dBug_toggleRow(this)" class="dBug_objectKey">title</td>
				<td>Your server 46.105.17.43 is successfully associated with vps.acyba.com</td></tr>
<tr>
				<td valign="top" onclick="dBug_toggleRow(this)" class="dBug_objectKey">mark</td>
				<td>0</td></tr>
<tr>
				<td valign="top" onclick="dBug_toggleRow(this)" class="dBug_objectKey">displayedMark</td>
				<td>✓</td></tr>
<tr>
				<td valign="top" onclick="dBug_toggleRow(this)" class="dBug_objectKey">status</td>
				<td>pass</td></tr>
<tr>
				<td valign="top" onclick="dBug_toggleRow(this)" class="dBug_objectKey">statusClass</td>
				<td>success</td></tr>
<tr>
				<td valign="top" onclick="dBug_toggleRow(this)" class="dBug_objectKey">description</td>
				<td>Reverse DNS lookup or reverse DNS resolution (rDNS) is the determination of a domain name that is associated with a given IP address.<br>Some companies such as AOL will reject any message sent from a server without rDNS, so you must ensure that you have one.<br>You cannot associate more than one domain name with a single IP address.</td></tr>
<tr>
				<td valign="top" onclick="dBug_toggleRow(this)" class="dBug_objectKey">messages</td>
				<td>[empty string]</td></tr>
<tr>
				<td valign="top" onclick="dBug_toggleRow(this)" class="dBug_objectKey">tested</td>
				<td>Here are the tested values for this check:<br><ul><li>IP: 46.105.17.43</li><li>HELO: vps.acyba.com</li><li>rDNS: vps.acyba.com</li></ul></td></tr>
</tbody></table></td></tr>
</tbody></table></td></tr>
</tbody></table></td></tr>
<tr>
				<td valign="top" onclick="dBug_toggleRow(this)" class="dBug_objectKey">body</td>
				<td><table cellspacing="2" cellpadding="3" class="dBug_object">
				<tbody><tr>
					<td class="dBug_objectHeader" colspan="2" onclick="dBug_toggleTable(this)">object</td>
				</tr><tr>
				<td valign="top" onclick="dBug_toggleRow(this)" class="dBug_objectKey">title</td>
				<td>The body of your message contains errors</td></tr>
<tr>
				<td valign="top" onclick="dBug_toggleRow(this)" class="dBug_objectKey">mark</td>
				<td>-0.5</td></tr>
<tr>
				<td valign="top" onclick="dBug_toggleRow(this)" class="dBug_objectKey">displayedMark</td>
				<td>-0.5</td></tr>
<tr>
				<td valign="top" onclick="dBug_toggleRow(this)" class="dBug_objectKey">status</td>
				<td>[empty string]</td></tr>
<tr>
				<td valign="top" onclick="dBug_toggleRow(this)" class="dBug_objectKey">statusClass</td>
				<td>warning</td></tr>
<tr>
				<td valign="top" onclick="dBug_toggleRow(this)" class="dBug_objectKey">description</td>
				<td>Checks whether your message is well formatted or not.</td></tr>
<tr>
				<td valign="top" onclick="dBug_toggleRow(this)" class="dBug_objectKey">messages</td>
				<td><p class="message-weight">Weight of the HTML version of your message: <b>20KB</b>.</p><p>Your message contains <b>14</b>% of text.</p></td></tr>
<tr>
				<td valign="top" onclick="dBug_toggleRow(this)" class="dBug_objectKey">subtests</td>
				<td><table cellspacing="2" cellpadding="3" class="dBug_object">
				<tbody><tr>
					<td class="dBug_objectHeader" colspan="2" onclick="dBug_toggleTable(this)">object</td>
				</tr><tr>
				<td valign="top" onclick="dBug_toggleRow(this)" class="dBug_objectKey">textToHtmlRatio</td>
				<td><table cellspacing="2" cellpadding="3" class="dBug_object">
				<tbody><tr>
					<td class="dBug_objectHeader" colspan="2" onclick="dBug_toggleTable(this)">object</td>
				</tr><tr>
				<td valign="top" onclick="dBug_toggleRow(this)" class="dBug_objectKey">title</td>
				<td>Your message contains <b>14</b>% of text.</td></tr>
<tr>
				<td valign="top" onclick="dBug_toggleRow(this)" class="dBug_objectKey">mark</td>
				<td>0</td></tr>
<tr>
				<td valign="top" onclick="dBug_toggleRow(this)" class="dBug_objectKey">statusClass</td>
				<td>success</td></tr>
<tr>
				<td valign="top" onclick="dBug_toggleRow(this)" class="dBug_objectKey">description</td>
				<td>[empty string]</td></tr>
<tr>
				<td valign="top" onclick="dBug_toggleRow(this)" class="dBug_objectKey">ratio</td>
				<td>0.13992205167685</td></tr>
</tbody></table></td></tr>
<tr>
				<td valign="top" onclick="dBug_toggleRow(this)" class="dBug_objectKey">altAttributes</td>
				<td><table cellspacing="2" cellpadding="3" class="dBug_object">
				<tbody><tr>
					<td class="dBug_objectHeader" colspan="2" onclick="dBug_toggleTable(this)">object</td>
				</tr><tr>
				<td valign="top" onclick="dBug_toggleRow(this)" class="dBug_objectKey">title</td>
				<td>We found 4 images without alt attribute in your message body</td></tr>
<tr>
				<td valign="top" onclick="dBug_toggleRow(this)" class="dBug_objectKey">mark</td>
				<td>-0.5</td></tr>
<tr>
				<td valign="top" onclick="dBug_toggleRow(this)" class="dBug_objectKey">displayedMark</td>
				<td>-0.5</td></tr>
<tr>
				<td valign="top" onclick="dBug_toggleRow(this)" class="dBug_objectKey">statusClass</td>
				<td>warning</td></tr>
<tr>
				<td valign="top" onclick="dBug_toggleRow(this)" class="dBug_objectKey">description</td>
				<td>alt attributes provide a textual alternative to your images.<br>It is a useful fallback for people suffering from sight problems and for cases where your images cannot be displayed.</td></tr>
<tr>
				<td valign="top" onclick="dBug_toggleRow(this)" class="dBug_objectKey">imagesWithoutAlt</td>
				<td><table cellspacing="2" cellpadding="3" class="dBug_array">
				<tbody><tr>
					<td class="dBug_arrayHeader" colspan="2" onclick="dBug_toggleTable(this)">array</td>
				</tr><tr>
				<td valign="top" onclick="dBug_toggleRow(this)" class="dBug_arrayKey">0</td>
				<td>&lt;img
src="https://www.acyba.com/media/com_acymailing/templates/acymailing/images/footer.jpg" border="0" width="600" height="40" name="footer" /&gt;</td></tr>
<tr>
				<td valign="top" onclick="dBug_toggleRow(this)" class="dBug_arrayKey">1</td>
				<td>&lt;img
src="https://www.acyba.com/media/com_acymailing/templates/acymailing/images/footer1.jpg" border="0" width="173" height="43" name="footer1" /&gt;</td></tr>
<tr>
				<td valign="top" onclick="dBug_toggleRow(this)" class="dBug_arrayKey">2</td>
				<td>&lt;img
src="https://www.acyba.com/media/com_acymailing/templates/acymailing/images/footer2.jpg" border="0" width="250" height="43" name="footer2" /&gt;</td></tr>
<tr>
				<td valign="top" onclick="dBug_toggleRow(this)" class="dBug_arrayKey">3</td>
				<td>&lt;img
src="https://www.acyba.com/media/com_acymailing/templates/acymailing/images/footer3.jpg" border="0" width="15" height="43" name="footer3" /&gt;</td></tr>
</tbody></table></td></tr>
<tr>
				<td valign="top" onclick="dBug_toggleRow(this)" class="dBug_objectKey">messages</td>
				<td><ul><li>&lt;img
src="https://www.acyba.com/media/com_acymailing/templates/acymailing/images/footer.jpg" border="0" width="600" height="40" name="footer" /&gt;</li><li>&lt;img
src="https://www.acyba.com/media/com_acymailing/templates/acymailing/images/footer1.jpg" border="0" width="173" height="43" name="footer1" /&gt;</li><li>&lt;img
src="https://www.acyba.com/media/com_acymailing/templates/acymailing/images/footer2.jpg" border="0" width="250" height="43" name="footer2" /&gt;</li><li>&lt;img
src="https://www.acyba.com/media/com_acymailing/templates/acymailing/images/footer3.jpg" border="0" width="15" height="43" name="footer3" /&gt;</li></ul><p><b>If you don't want to add an alt attribute, add an empty one: alt=\"\"</b></p></td></tr>
</tbody></table></td></tr>
<tr>
				<td valign="top" onclick="dBug_toggleRow(this)" class="dBug_objectKey">forbiddenTags</td>
				<td><table cellspacing="2" cellpadding="3" class="dBug_object">
				<tbody><tr>
					<td class="dBug_objectHeader" colspan="2" onclick="dBug_toggleTable(this)">object</td>
				</tr><tr>
				<td valign="top" onclick="dBug_toggleRow(this)" class="dBug_objectKey">title</td>
				<td>Your content is safe</td></tr>
<tr>
				<td valign="top" onclick="dBug_toggleRow(this)" class="dBug_objectKey">mark</td>
				<td>0</td></tr>
<tr>
				<td valign="top" onclick="dBug_toggleRow(this)" class="dBug_objectKey">displayedmark</td>
				<td>0</td></tr>
<tr>
				<td valign="top" onclick="dBug_toggleRow(this)" class="dBug_objectKey">statusClass</td>
				<td>success</td></tr>
<tr>
				<td valign="top" onclick="dBug_toggleRow(this)" class="dBug_objectKey">description</td>
				<td>Checks whether your message contains dangerous html elements such as javascript, iframes, embed content or applet.</td></tr>
<tr>
				<td valign="top" onclick="dBug_toggleRow(this)" class="dBug_objectKey">matches</td>
				<td>0</td></tr>
<tr>
				<td valign="top" onclick="dBug_toggleRow(this)" class="dBug_objectKey">messages</td>
				<td>[empty string]</td></tr>
<tr>
				<td valign="top" onclick="dBug_toggleRow(this)" class="dBug_objectKey">rules</td>
				<td><table cellspacing="2" cellpadding="3" class="dBug_array">
				<tbody><tr>
					<td class="dBug_arrayHeader" colspan="2" onclick="dBug_toggleTable(this)">array</td>
				</tr></tbody></table></td></tr>
<tr>
				<td valign="top" onclick="dBug_toggleRow(this)" class="dBug_objectKey">html</td>
				<td>



<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Tell us how to make Acy better</title>
<style type="text/css">
.ReadMsgBody{width: 100%;}
.ExternalClass{width: 100%;}
div, p, a, li, td { -webkit-text-size-adjust:none; }
h2{ color: #6b6a6a ;   font-size: 14px;   font-weight: bold;   text-align:left;   margin-bottom:10px;   border-bottom:1px solid #921212;  
letter-spacing:3px;   margin-top:30px; }
h3{ color:#921212 ;   margin-bottom:20px;   margin:0px;   letter-spacing:3px;   text-align:right;   margin-top:5px;   margin-right:5px;  
font-size:13px; }
a:visited{color:#575757;   font-size:11px;   text-decoration:underline;   cursor:pointer;}
</style>


<div style="font-family:Arial, Helvetica, sans-serif;font-size:12px;text-align:center;background-color:#e4e3e3;padding:20px 0px;">
<table style="margin: auto; width: 600px;" border="0" cellspacing="0" cellpadding="0" align="center"><tbody><tr>
<td style="font-family: Arial, Helvetica, sans-serif;font-size:12px;">
<table style="width: 600px;" border="0" cellspacing="0" cellpadding="0"><tbody><tr>
<td style="font-family:Arial, Helvetica, sans-serif;font-size:12px;line-height:0px;" width="138"><img src="{{ asset('/assets/examples') . 'acymailing_logo.jpg' }}" border="0" alt="AcyMailing" width="138" height="173" name="AcyMailing" style="border: 0;"></td>
<td style="font-family: Arial, Helvetica, sans-serif;font-size:12px;">
<table style="width: 462px;" border="0" cellspacing="0" cellpadding="0">
<tbody><tr style="line-height: 0px;">
<td style="font-family:Arial, Helvetica, sans-serif;font-size:12px;line-height:0px;" colspan="2"><img src="{{ asset('/assets/examples') . 'acymailing.jpg' }}" border="0" alt="Newsletter and email marketing" width="462" height="94" name="title" style="border: 0;"></td>
</tr>
<tr>
<td style="font-family:Arial, Helvetica, sans-serif;font-size:12px;background-color:#f9f9f9;text-align:left;" width="264" height="79"><span style="color:#921212;font-weight:bold;">Hi Api,</span></td>
<td style="font-family:Arial, Helvetica,
sans-serif;font-size:12px;color:#575757;padding-right:10px;letter-spacing:2px;background-color:#f9f9f9;text-align:right;" width="198" height="79" valign="top">2011, July<br>
</td>
</tr>
</tbody></table>
</td>
</tr></tbody></table>
<table style="background-color: #f9f9f9; width: 600px;" border="0" cellspacing="0" cellpadding="0"><tbody><tr>
<td width="42" style="font-family: Arial, Helvetica, sans-serif;font-size:12px;"><br></td>
<td width="244" style="font-family:Arial, Helvetica, sans-serif;font-size:12px;color:#000;text-align:justify;">
<p style="font-family: Arial, Helvetica, sans-serif;font-size:12px;">A rare email from us!<br>We rarely take the time to email our users although we
help millions of emails being sent everyday.<br>Ironic you say? Well, we do what we preach: only email your subscribers when you really have
something new or important to say. Find both of these below.</p>
</td>
<td width="44" style="font-family: Arial, Helvetica, sans-serif;font-size:12px;"><br></td>
<td style="font-family:Arial, Helvetica, sans-serif;font-size:12px;text-align:left;background-color:#FFF;border-right:2px solid
#e5e5e5;border-bottom:2px solid #e5e5e5;border-top:1px solid #e5e5e5;border-left:1px solid #ededed;" width="250" valign="top">
<h3 style="color:#921212 !important;   margin-bottom:20px;   margin:0px;   letter-spacing:3px;   text-align:right;   margin-top:5px;  
margin-right:5px;   font-size:13px;">What's new</h3>
<br><img src="{{ asset('/assets/examples') . 'arrow.jpg' }}" border="0" alt="-" width="51" height="6"><a href="#dkim" style="color:#575757;   font-size:11px;   text-decoration:underline;   cursor:pointer;"><span style="color:#575757;">DKIM</span></a><br><img src="{{ asset('/assets/examples') . 'arrow.jpg' }}" border="0" alt="-" width="51" height="6"><a href="#permission" style="color:#575757;   font-size:11px;   text-decoration:underline;   cursor:pointer;"><span style="color:#575757;">Permission
per groups</span></a><br><img src="{{ asset('/assets/examples') . 'arrow.jpg' }}" border="0" alt="-" width="51" height="6"><span style="color:#575757;"><a href="#comm" style="color:#575757;   font-size:11px;   text-decoration:underline;  
cursor:pointer;">Conditional display</a></span><br><img src="{{ asset('/assets/examples') . 'arrow.jpg' }}" border="0" alt="-" width="51" height="6"><a href="#plugin" style="color:#575757;   font-size:11px;   text-decoration:underline;  
cursor:pointer;"><span style="color:#575757;">New plugins</span></a><br>
</td>
<td width="20" style="font-family: Arial, Helvetica, sans-serif;font-size:12px;"><br></td>
</tr></tbody></table>
<table style="background-color: #f9f9f9; width: 600px;" border="0" cellspacing="0" cellpadding="0"><tbody><tr>
<td width="42" style="font-family: Arial, Helvetica, sans-serif;font-size:12px;"><br></td>
<td width="516" style="font-family: Arial, Helvetica, sans-serif;font-size:12px;">
<div style="font-family:Arial, Helvetica, sans-serif;font-size:12px;color:#000000;text-align:justify;padding-bottom:30px;">
<h2 style="color: #6b6a6a !important;   font-size: 14px;   font-weight: bold;   text-align:left;   margin-bottom:10px;   border-bottom:1px solid
#921212;   letter-spacing:3px;   margin-top:30px;">10 Questions to Help Us Improve</h2>
<br><img src="{{ asset('/assets/examples') . 'acyuser.png' }}" border="0" alt="acy user" align="right" hspace="5" style="float: right; padding-left: 15px;"><br>It’s already been two years since we’ve launched AcyMailing and we’ve
never taken the time to poll our users! This is your chance to quickly help shape the upcoming features.<br><a href="https://www.acyba.com/index.php?subid=137457&amp;option=com_acymailing&amp;ctrl=user&amp;task=modify&amp;key=4cebe6890bb0f3d3e8d47f5441c3d673&amp;Itemid=72" style="color:#575757;   font-size:11px;   text-decoration:underline;   cursor:pointer;">Take me to the poll</a>.</div>
<div style="font-family:Arial, Helvetica, sans-serif;font-size:12px;color:#000000;text-align:justify;padding-bottom:30px;">
<h2 style="color: #6b6a6a !important;   font-size: 14px;   font-weight: bold;   text-align:left;   margin-bottom:10px;   border-bottom:1px solid
#921212;   letter-spacing:3px;   margin-top:30px;">
<a name="dkim" style="color:#575757;   font-size:11px;   text-decoration:underline;   cursor:pointer;"></a>Improve your deliverability with DomainKeys
Identified Mail (DKIM)</h2>
<p style="font-family: Arial, Helvetica, sans-serif;font-size:12px;"><img src="{{ asset('/assets/examples') . 'dkim.png' }}" border="0" alt="dkim" align="left" hspace="5" style="float:
left; padding-right: 15px; border: 0pt none;">DKIM is an industry standard to authenticate&nbsp; the sender of an email. This greatly improves
delivery rates by avoiding spam filters.</p>
<p style="font-family: Arial, Helvetica, sans-serif;font-size:12px;">AcyMailing integrates this encrypted technology in all of its commercial
versions.</p>
<p style="font-family: Arial, Helvetica, sans-serif;font-size:12px;">&nbsp;</p>
<p style="font-family: Arial, Helvetica, sans-serif;font-size:12px;"><a href="https://www.acyba.com/en/support/documentation/156-acymailing-dkim.html" style="color:#575757;   font-size:11px;   text-decoration:underline;   cursor:pointer;"><img src="{{ asset('/assets/examples') . 'readmore.jpg' }}" border="0" alt="read more" width="79" height="14" align="right" hspace="5" style="border:0pt none;text-decoration:none;float:right;"></a></p>
<p style="font-family: Arial, Helvetica, sans-serif;font-size:12px;">&nbsp;</p>
<h2 style="color: #6b6a6a !important;   font-size: 14px;   font-weight: bold;   text-align:left;   margin-bottom:10px;   border-bottom:1px solid
#921212;   letter-spacing:3px;   margin-top:30px;">
<a name="permission" style="color:#575757;   font-size:11px;   text-decoration:underline;   cursor:pointer;"></a>Total Control with Group
Permissions</h2>
<p style="font-family:Arial, Helvetica, sans-serif;font-size:12px;text-align:left;">You can now configure which groups can do what.</p>
<p style="font-family:Arial, Helvetica, sans-serif;font-size:12px;text-align:left;"><img src="{{ asset('/assets/examples') . 'tableau.png' }}" border="0" alt="tableau" align="right" hspace="5" style="float:right;padding-left:15px;"></p>
<p style="font-family: Arial, Helvetica, sans-serif;font-size:12px;">For example, you can deny Managers access to the configuration page or  allow
Administrators the exclusive rights to manage your lists.<br><br> Group permissions is available with AcyMailing Enterprise.</p>
<p style="font-family:Arial, Helvetica, sans-serif;font-size:12px;text-align:left;"><a href="https://www.acyba.com/en/support/documentation/160-permissions.html" style="color:#575757;   font-size:11px;   text-decoration:underline;  
cursor:pointer;"><img src="{{ asset('/assets/examples') . 'readmore.jpg' }}" border="0" alt="read more" width="79" height="14" align="right" hspace="5" style="border:0pt none;text-decoration:none;float:right;"></a></p>
<p style="font-family:Arial, Helvetica, sans-serif;font-size:12px;text-align:left;">&nbsp;</p>
<h2 style="color: #6b6a6a !important;   font-size: 14px;   font-weight: bold;   text-align:left;   margin-bottom:10px;   border-bottom:1px solid
#921212;   letter-spacing:3px;   margin-top:30px;">
<a name="comm" style="color:#575757;   font-size:11px;   text-decoration:underline;   cursor:pointer;"></a>Personalize Your Content Based On User
Profile</h2>
Say hello to bullseye emailing. Leverage your custom profile fields to target content to specific users. For example, you can easily add content to an
email for subscribers in a specific country or to women only. What else? Include an invitation to register to your site for your AcyMailing
subscribers only.<br><p style="font-family: Arial, Helvetica, sans-serif;font-size:12px;"><a href="https://www.acyba.com/en/support/documentation/159-acymailing-plugin-ifstatements.html" style="color:#575757;   font-size:11px;  
text-decoration:underline;   cursor:pointer;"><img src="{{ asset('/assets/examples') . 'readmore.jpg' }}" border="0" alt="read more" width="79" height="14" align="right" hspace="5" style="border:0pt none;text-decoration:none;float:right;"></a></p>
<p style="font-family: Arial, Helvetica, sans-serif;font-size:12px;">&nbsp;</p>
<h2 style="color: #6b6a6a !important;   font-size: 14px;   font-weight: bold;   text-align:left;   margin-bottom:10px;   border-bottom:1px solid
#921212;   letter-spacing:3px;   margin-top:30px;">
<a name="plugin" style="color:#575757;   font-size:11px;   text-decoration:underline;   cursor:pointer;"></a>13 New Plugins for Seamless
Integration</h2>
<div style="font-family:Arial, Helvetica, sans-serif;font-size:12px;color:#000000;text-align:justify;padding-bottom:30px;">Filter your user or add
custom content with tags from other extensions.<br>Below are 13 news plugins which are all available for free.</div>
<div style="font-family:Arial, Helvetica, sans-serif;font-size:12px;color:#000000;text-align:justify;padding-bottom:30px;">
<strong>Download component :</strong><br> Plugin: jDownloads<br> Plugin: Docman<br> Plugin: PhocaDownload<br> Plugin: RokDownloads<br>
Plugin: Remository<img src="{{ asset('/assets/examples') . 'acymailing-integrations.pn' }}g" border="0" alt="integrations" align="right" hspace="5" style="float:right; padding-left:15px;"><br> Plugin: Joomdoc<br><br><strong>Event component
:</strong><br> Plugin: RsEvents<br><br><strong>Content component :</strong><br> Plugin: Mighty Resources<br> Plugin: ListBingo<br> Plugin:
SobiPro<br> Plugin: Lyften Bloggie<br><br><strong>User management :</strong><br> Plugin: Mighty Membership<br> Plugin: Mighty
Registration</div>
<div style="font-family:Arial, Helvetica, sans-serif;font-size:12px;text-align:right;"><a href="https://www.acyba.com/en/download/plugins-modules.html" style="color:#575757;   font-size:11px;   text-decoration:underline;  
cursor:pointer;">See complete list of plugins</a></div>
</div>
</td>
<td width="42" style="font-family: Arial, Helvetica, sans-serif;font-size:12px;"><br></td>
</tr></tbody></table>
<table style="background-color: #f9f9f9; width: 600px;" border="0" cellspacing="0" cellpadding="0"><tbody><tr>
<td width="20" style="font-family: Arial, Helvetica, sans-serif;font-size:12px;"><br></td>
<td style="font-family:Arial, Helvetica, sans-serif;font-size:12px;background-color:#FFF;border-right:2px solid #e5e5e5;border-top:1px solid
#e5e5e5;border-left:1px solid #ededed;" width="560">
<table style="width: 560px;" border="0" cellspacing="0" cellpadding="0">
<tbody><tr>
<td colspan="2" style="font-family: Arial, Helvetica, sans-serif;font-size:12px;">
<h3 style="color:#921212 !important;   margin-bottom:20px;   margin:0px;   letter-spacing:3px;   text-align:right;   margin-top:5px;  
margin-right:5px;   font-size:13px;">Useful links</h3>
</td>
</tr>
<tr>
<td style="font-family:Arial, Helvetica, sans-serif;font-size:12px;text-align:left;" width="280" valign="top">
<img src="{{ asset('/assets/examples') . 'arrow2.jpg' }}" border="0" alt="-" width="47" height="16"><span style="color:#575757;"><a href="https://www.acyba.com/en/support/documentation.html" style="color:#575757;   font-size:11px;  
text-decoration:underline;   cursor:pointer;">Documentation</a></span><br><img src="{{ asset('/assets/examples') . 'arrow2.jpg' }}" border="0" alt="-" width="47" height="16"><span style="color:#575757;"><a href="https://www.acyba.com/en/support/documentation/66-how-to-install-acymailing.html#update" style="color:#575757;  
font-size:11px;   text-decoration:underline;   cursor:pointer;">How to upgrade?</a></span><br><img src="{{ asset('/assets/examples') . 'arrow2.jpg' }}" border="0" alt="-" width="47" height="16"><span style="color:#575757;"><a href="https://www.acyba.com/en/support/documentation/68-acymailing-changelog.html" style="color:#575757;   font-size:11px;  
text-decoration:underline;   cursor:pointer;">Change Log</a></span><br>
</td>
<td style="font-family:Arial, Helvetica, sans-serif;font-size:12px;text-align:left;" width="280" valign="top">
<img src="{{ asset('/assets/examples') . 'arrow2.jpg' }}" border="0" alt="-" width="47" height="16"><span style="color:#575757;"><a href="https://www.acyba.com/en/products.html?page=shop.product_details&amp;product_id=17&amp;flypage=flypage.tpl&amp;pop=0&amp;category_id=6" style="color:#575757;  
font-size:11px;   text-decoration:underline;   cursor:pointer;">Buy AcyMailing Essential</a></span><br><img src="{{ asset('/assets/examples') . 'arrow2.jpg' }}" border="0" alt="-" width="47" height="16"><span style="color:#575757;"><a href="https://www.acyba.com/en/products.html?page=shop.product_details&amp;product_id=18&amp;flypage=flypage.tpl&amp;pop=0&amp;category_id=6" style="color:#575757;  
font-size:11px;   text-decoration:underline;   cursor:pointer;">Buy AcyMailing Business</a></span><br><img src="{{ asset('/assets/examples') . 'arrow2.jpg' }}" border="0" alt="-" width="47" height="16"><span style="color:#575757;"><a href="https://www.acyba.com/en/products.html?page=shop.product_details&amp;product_id=19&amp;flypage=flypage.tpl&amp;pop=0&amp;category_id=6" style="color:#575757;  
font-size:11px;   text-decoration:underline;   cursor:pointer;">Buy AcyMailing Enterprise</a></span><br>
</td>
</tr>
</tbody></table>
</td>
<td width="20" style="font-family: Arial, Helvetica, sans-serif;font-size:12px;"><br></td>
</tr></tbody></table>
<table style="background-color: #f9f9f9; width: 600px;" border="0" cellspacing="0" cellpadding="0">
<tbody><tr style="line-height: 0px;">
<td style="font-family:Arial, Helvetica, sans-serif;font-size:12px;line-height:0px;" colspan="6"><img src="{{ asset('/assets/examples') . 'footer.jpg' }}" border="0" width="600" height="40" name="footer"></td>
</tr>
<tr>
<td style="font-family:Arial, Helvetica, sans-serif;font-size:12px;line-height:0px;" width="173"><img src="{{ asset('/assets/examples') . 'footer1.jpg' }}" border="0" width="173" height="43" name="footer1"></td>
<td style="font-family:Arial, Helvetica, sans-serif;font-size:12px;line-height:0px;" width="45"><a href="https://www.acyba.com/index.php?subid=137457&amp;option=com_acymailing&amp;ctrl=user&amp;task=out&amp;mailid=75&amp;key=4cebe6890bb0f3d3e8d47f5441c3d673&amp;Itemid=72" style="color:#575757;font-size:11px;text-decoration:underline;cursor:pointer;line-height:0px;"><img src="{{ asset('/assets/examples') . 'unsubscribe1.jpg' }}" border="0" alt="unsubscribe" width="45" height="43" name="unsubscribe1" style="border:0px;text-decoration:none;"></a></td>
<td style="font-family:Arial, Helvetica, sans-serif;font-size:12px;line-height:0px;" width="250"><img src="{{ asset('/assets/examples') . 'footer2.jpg' }}" border="0" width="250" height="43" name="footer2"></td>
<td style="font-family:Arial, Helvetica, sans-serif;font-size:12px;line-height:0px;" width="61"><a href="http://twitter.com/#%21/acyba" style="color:#575757;font-size:11px;text-decoration:underline;cursor:pointer;line-height:0px;"><img src="{{ asset('/assets/examples') . 'twitter1.jpg' }}" border="0" alt="twitter" width="61" height="43" name="twitter1" style="border:0px;text-decoration:none;"></a></td>
<td style="font-family:Arial, Helvetica, sans-serif;font-size:12px;line-height:0px;" width="56"><a href="http://www.facebook.com/pages/AcyMailing/120374104713871" style="color:#575757;font-size:11px;text-decoration:underline;cursor:pointer;line-height:0px;"><img src="{{ asset('/assets/examples') . 'facebook1.jpg' }}" border="0" alt="facebook" width="56" height="43" name="facebook1" style="border:0px;text-decoration:none;"></a></td>
<td style="font-family:Arial, Helvetica, sans-serif;font-size:12px;line-height:0px;" width="15"><img src="{{ asset('/assets/examples') . 'footer3.jpg' }}" border="0" width="15" height="43" name="footer3"></td>
</tr>
<tr>
<td style="font-family:Arial, Helvetica, sans-serif;font-size:12px;background-color:#e4e3e3;" width="173" valign="top"><a href="https://www.acyba.com/index.php?subid=137457&amp;option=com_acymailing&amp;ctrl=user&amp;task=out&amp;mailid=75&amp;key=4cebe6890bb0f3d3e8d47f5441c3d673&amp;Itemid=72" style="color:#575757;   font-size:11px;   text-decoration:underline;   cursor:pointer;"><span style="font-size:11px;   color:#000;  
text-decoration:none;">Unsubscribe Newsletter</span></a></td>
<td style="font-family:Arial, Helvetica, sans-serif;font-size:12px;line-height:0px;" width="45"><img src="{{ asset('/assets/examples') . 'unsubscribe2.jpg' }}" border="0" alt="unsubscribe" width="45" height="37" name="unsubscribe2"></td>
<td style="font-family:Arial, Helvetica, sans-serif;font-size:12px;background-color:#e4e3e3;" width="250"><br></td>
<td style="font-family:Arial, Helvetica, sans-serif;font-size:12px;line-height:0px;" width="61"><img src="{{ asset('/assets/examples') . 'twitter2.jpg' }}" border="0" alt="twitter" width="61" height="37" name="twitter2"></td>
<td style="font-family:Arial, Helvetica, sans-serif;font-size:12px;line-height:0px;" width="56"><img src="{{ asset('/assets/examples') . 'facebook2.jpg' }}" border="0" alt="facebook" width="56" height="37" name="facebook2"></td>
<td style="font-family:Arial, Helvetica, sans-serif;font-size:12px;background-color:#e4e3e3;" width="15"><br></td>
</tr>
</tbody></table>
</td>
</tr></tbody></table>
</div>
<img alt="" src="{{ asset('/assets/examples') . 'index.php' }}" border="0" height="2" width="180">




</td></tr>
<tr>
				<td valign="top" onclick="dBug_toggleRow(this)" class="dBug_objectKey">displayedMark</td>
				<td>✓</td></tr>
</tbody></table></td></tr>
</tbody></table></td></tr>
<tr>
				<td valign="top" onclick="dBug_toggleRow(this)" class="dBug_objectKey">content</td>
				<td><table cellspacing="2" cellpadding="3" class="dBug_object">
				<tbody><tr>
					<td class="dBug_objectHeader" colspan="2" onclick="dBug_toggleTable(this)">object</td>
				</tr><tr>
				<td valign="top" onclick="dBug_toggleRow(this)" class="dBug_objectKey">title</td>
				<td>Click here to view your message</td></tr>
<tr>
				<td valign="top" onclick="dBug_toggleRow(this)" class="dBug_objectKey">statusClass</td>
				<td>success</td></tr>
<tr>
				<td valign="top" onclick="dBug_toggleRow(this)" class="dBug_objectKey">description</td>
				<td>[empty string]</td></tr>
</tbody></table></td></tr>
<tr>
				<td valign="top" onclick="dBug_toggleRow(this)" class="dBug_objectKey">raw</td>
				<td><table cellspacing="2" cellpadding="3" class="dBug_object">
				<tbody><tr>
					<td class="dBug_objectHeader" colspan="2" onclick="dBug_toggleTable(this)">object</td>
				</tr><tr>
				<td valign="top" onclick="dBug_toggleRow(this)" class="dBug_objectKey">title</td>
				<td>Source</td></tr>
<tr>
				<td valign="top" onclick="dBug_toggleRow(this)" class="dBug_objectKey">content</td>
				<td>Received: by mail-tester.com (Postfix, from userid 500)	id 9253C1C80D1;
	Tue, 10 Dec 2013 20:20:10 +0100 (CET)
X-Spam-Checker-Version: SpamAssassin 3.3.2 (2011-06-06) on mail-tester.com
X-Spam-Level: 
X-Spam-Status: No/-0.1/5.0
X-Spam-Test-Scores: DKIM_SIGNED=0.1,DKIM_VALID=-0.1,DKIM_VALID_AU=-0.1,
	HTML_MESSAGE=0.001,RP_MATCHES_RCVD=-0.001,SPF_PASS=-0.001
X-Spam-Last-External-IP: 46.105.17.43
X-Spam-Last-External-HELO: vps.acyba.com
X-Spam-Last-External-RDNS: vps.acyba.com
X-Spam-Date-of-Scan: Tue, 10 Dec 2013 20:20:10 +0100
Received: from vps.acyba.com (vps.acyba.com [46.105.17.43])
	by mail-tester.com (Postfix) with ESMTP id 422FD1C80B8
	for &lt;api-example@mail-tester.com&gt;; Tue, 10 Dec 2013 20:20:07 +0100 (CET)
Received: by vps.acyba.com (Postfix, from userid 33)	id DAB7A198255D;
	Tue, 10 Dec 2013 20:20:24 +0100 (CET)
DKIM-Signature: v=1; a=rsa-sha256; c=simple/simple; d=acyba.com; s=mail;
	t=1386703224; bh=ILt+oovPOcamnKrEXdJQYwbzLT8I9t6cPk5DmGx3YaU=;
	h=To:Subject:Date:From:Reply-To:Message-ID:List-Unsubscribe:
	MIME-Version:Content-Type:Content-Transfer-Encoding;
	b=uRFWMmCV3kKzlXARm/2c4q45eQyCSWT/eoOEFZVSenV/+f+Khz3k58WjPVX/r51YR
	20JAb1C+V7x22PxFp7BoRY3GlJ+PGh7o3fo7phB5xlF/v+7aUGf4H6BRScvFr0ur1z
	BiZGBOkIpWnWJTpEBRkR2xFcv+dKmGC9aaNGPl2Y=
To: Api Example &lt;api-example@mail-tester.com&gt;
Subject: Tell us how to make Acy better
X-PHP-Originating-Script: 1001:class.phpmailer.php
Date: Tue, 10 Dec 2013 20:20:24 +0100
From: Acyba &lt;info@acyba.com&gt;
Reply-To: Acyba &lt;info@acyba.com&gt;
Message-ID: &lt;NzAwODg2MAAC137457Y75BAMTM4NjcwMzIyNDk5MTcx@www.acyba.com&gt;
X-Priority: 3
X-Mailer: PHPMailer 5.2.6 (https://github.com/PHPMailer/PHPMailer/)
List-Unsubscribe: &lt;https://www.acyba.com/index.php?subid=137457&amp;option=com_acymailing&amp;ctrl=user&amp;task=out&amp;mailid=75&amp;key=4cebe6890bb0f3d3e8d47f5441c3d673&amp;Itemid=72&gt;,
	&lt;mailto:info@acyba.com?subject=unsubscribe_user_137457&amp;body=Please%20unsubscribe%20user%20ID%20137457&gt;
Return-Path: no-reply@acyba.com
MIME-Version: 1.0
Content-Type: multipart/alternative;
	boundary=b1_a54f899e69f9e62a16ad60cc23439633
Content-Transfer-Encoding: 7bit

--b1_a54f899e69f9e62a16ad60cc23439633
Content-Type: text/plain; charset=utf-8
Content-Transfer-Encoding: quoted-printable

Hi Api,
2011, July

A rare email from us!
We rarely take the time to email our users although we help millions of e=
mails being sent everyday.
Ironic you say? Well, we do what we preach: only email your subscribers w=
hen you really have something new or important to say. Find both of these
below.

What's new

DKIM
 Permission per groups
 Conditional display
 New plugins

10 Questions to Help Us Improve

It=E2=80=99s already been two years since we=E2=80=99ve launched AcyMaili=
ng and we=E2=80=99ve never taken the time to poll our users! This is your=
 chance to quickly
help shape the upcoming features.
 Take me to the poll (
https://www.acyba.com/index.php?subid=3D137457&amp;option=3Dcom_acymailing&amp;ct=
rl=3Duser&amp;task=3Dmodify&amp;key=3D4cebe6890bb0f3d3e8d47f5441c3d673&amp;Itemid=3D7=
2 ).

Improve your deliverability with DomainKeys Identified Mail (DKIM)

DKIM is an industry standard to authenticate the sender of an email. This=
 greatly improves delivery rates by avoiding spam filters.
AcyMailing integrates this encrypted technology in all of its commercial =
versions.

Total Control with Group Permissions

You can now configure which groups can do what.

For example, you can deny Managers access to the configuration page or al=
low Administrators the exclusive rights to manage your lists.

Group permissions is available with AcyMailing Enterprise.

Personalize Your Content Based On User Profile
Say hello to bullseye emailing. Leverage your custom profile fields to ta=
rget content to specific users. For example, you can easily add content t=
o an
email for subscribers in a specific country or to women only. What else? =
Include an invitation to register to your site for your AcyMailing
subscribers only.

13 New Plugins for Seamless Integration

Filter your user or add custom content with tags from other extensions.
Below are 13 news plugins which are all available for free.
Download component :
 Plugin: jDownloads
 Plugin: Docman
 Plugin: PhocaDownload
 Plugin: RokDownloads
 Plugin: Remository
 Plugin: Joomdoc

Event component :
 Plugin: RsEvents

Content component :
 Plugin: Mighty Resources
 Plugin: ListBingo
 Plugin: SobiPro
 Plugin: Lyften Bloggie

User management :
 Plugin: Mighty Membership
 Plugin: Mighty Registration
See complete list of plugins ( https://www.acyba.com/en/download/plugins-=
modules.html )

Useful links

Documentation ( https://www.acyba.com/en/support/documentation.html )
 How to upgrade? ( https://www.acyba.com/en/support/documentation/66-how-=
to-install-acymailing.html#update )
 Change Log ( https://www.acyba.com/en/support/documentation/68-acymailin=
g-changelog.html )

Buy AcyMailing Essential ( https://www.acyba.com/en/products.html?page=3D=
shop.product_details&amp;product_id=3D17&amp;flypage=3Dflypage.tpl&amp;pop=3D0&amp;catego=
ry_id=3D6 )
 Buy AcyMailing Business ( https://www.acyba.com/en/products.html?page=3D=
shop.product_details&amp;product_id=3D18&amp;flypage=3Dflypage.tpl&amp;pop=3D0&amp;catego=
ry_id=3D6 )
 Buy AcyMailing Enterprise ( https://www.acyba.com/en/products.html?page=3D=
shop.product_details&amp;product_id=3D19&amp;flypage=3Dflypage.tpl&amp;pop=3D0&amp;catego=
ry_id=3D6 )

Unsubscribe Newsletter (
https://www.acyba.com/index.php?subid=3D137457&amp;option=3Dcom_acymailing&amp;ct=
rl=3Duser&amp;task=3Dout&amp;mailid=3D75&amp;key=3D4cebe6890bb0f3d3e8d47f5441c3d673&amp;I=
temid=3D72 )


--b1_a54f899e69f9e62a16ad60cc23439633
Content-Type: text/html; charset=utf-8
Content-Transfer-Encoding: quoted-printable

&lt;!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://ww=
w.w3.org/TR/html4/loose.dtd"&gt;
&lt;html&gt;
&lt;head&gt;
&lt;meta http-equiv=3D"Content-Type" content=3D"text/html; charset=3Dutf-8"&gt;
&lt;meta name=3D"viewport" content=3D"width=3Ddevice-width, initial-scale=3D=
1.0"&gt;
&lt;title&gt;Tell us how to make Acy better&lt;/title&gt;
&lt;style type=3D"text/css"&gt;
.ReadMsgBody{width: 100%;}
.ExternalClass{width: 100%;}
div, p, a, li, td { -webkit-text-size-adjust:none; }
h2{ color: #6b6a6a ;   font-size: 14px;   font-weight: bold;   text-align=
:left;   margin-bottom:10px;   border-bottom:1px solid #921212; =20
letter-spacing:3px;   margin-top:30px; }
h3{ color:#921212 ;   margin-bottom:20px;   margin:0px;   letter-spacing:=
3px;   text-align:right;   margin-top:5px;   margin-right:5px; =20
font-size:13px; }
a:visited{color:#575757;   font-size:11px;   text-decoration:underline;  =
 cursor:pointer;}
&lt;/style&gt;
&lt;/head&gt;
&lt;body bgcolor=3D"#e4e3e3" style=3D"background-color:#e4e3e3;font-family:A=
rial, Helvetica, sans-serif;font-size:12px;"&gt;
&lt;div style=3D"font-family:Arial, Helvetica, sans-serif;font-size:12px;tex=
t-align:center;background-color:#e4e3e3;padding:20px 0px;"&gt;
&lt;table style=3D"margin: auto; width: 600px;" border=3D"0" cellspacing=3D"=
0" cellpadding=3D"0" align=3D"center"&gt;&lt;tr&gt;
&lt;td style=3D"font-family: Arial, Helvetica, sans-serif;font-size:12px;"&gt;
&lt;table style=3D"width: 600px;" border=3D"0" cellspacing=3D"0" cellpadding=
=3D"0"&gt;&lt;tr&gt;
&lt;td style=3D"font-family:Arial, Helvetica, sans-serif;font-size:12px;line=
-height:0px;" width=3D"138"&gt;&lt;img
src=3D"https://www.acyba.com/media/com_acymailing/templates/acymailing/im=
ages/acymailing_logo.jpg" border=3D"0" alt=3D"AcyMailing" width=3D"138" h=
eight=3D"173"
name=3D"AcyMailing" style=3D"border: 0;" /&gt;&lt;/td&gt;
&lt;td style=3D"font-family: Arial, Helvetica, sans-serif;font-size:12px;"&gt;
&lt;table style=3D"width: 462px;" border=3D"0" cellspacing=3D"0" cellpadding=
=3D"0"&gt;
&lt;tr style=3D"line-height: 0px;"&gt;
&lt;td style=3D"font-family:Arial, Helvetica, sans-serif;font-size:12px;line=
-height:0px;" colspan=3D"2"&gt;&lt;img
src=3D"https://www.acyba.com/media/com_acymailing/templates/acymailing/im=
ages/acymailing.jpg" border=3D"0" alt=3D"Newsletter and email marketing"
width=3D"462" height=3D"94" name=3D"title" style=3D"border: 0;" /&gt;&lt;/td&gt;
&lt;/tr&gt;
&lt;tr&gt;
&lt;td style=3D"font-family:Arial, Helvetica, sans-serif;font-size:12px;back=
ground-color:#f9f9f9;text-align:left;" width=3D"264" height=3D"79"&gt;&lt;span=20
style=3D"color:#921212;font-weight:bold;"&gt;Hi Api,&lt;/span&gt;&lt;/td&gt;
&lt;td  style=3D"font-family:Arial, Helvetica,
sans-serif;font-size:12px;color:#575757;padding-right:10px;letter-spacing=
:2px;background-color:#f9f9f9;text-align:right;" width=3D"198" height=3D"=
79"
valign=3D"top"&gt;2011, July&lt;br /&gt;
&lt;/td&gt;
&lt;/tr&gt;
&lt;/table&gt;
&lt;/td&gt;
&lt;/tr&gt;&lt;/table&gt;
&lt;table style=3D"background-color: #f9f9f9; width: 600px;" border=3D"0" ce=
llspacing=3D"0" cellpadding=3D"0"&gt;&lt;tr&gt;
&lt;td width=3D"42" style=3D"font-family: Arial, Helvetica, sans-serif;font-=
size:12px;"&gt;&lt;br /&gt;&lt;/td&gt;
&lt;td  width=3D"244" style=3D"font-family:Arial, Helvetica, sans-serif;font=
-size:12px;color:#000;text-align:justify;"&gt;
&lt;p style=3D"font-family: Arial, Helvetica, sans-serif;font-size:12px;"&gt;A =
rare email from us!&lt;br /&gt;We rarely take the time to email our users altho=
ugh we
help millions of emails being sent everyday.&lt;br /&gt;Ironic you say? Well, w=
e do what we preach: only email your subscribers when you really have
something new or important to say. Find both of these below.&lt;/p&gt;
&lt;/td&gt;
&lt;td width=3D"44" style=3D"font-family: Arial, Helvetica, sans-serif;font-=
size:12px;"&gt;&lt;br /&gt;&lt;/td&gt;
&lt;td style=3D"font-family:Arial, Helvetica, sans-serif;font-size:12px;text=
-align:left;background-color:#FFF;border-right:2px solid
#e5e5e5;border-bottom:2px solid #e5e5e5;border-top:1px solid #e5e5e5;bord=
er-left:1px solid #ededed;" width=3D"250" valign=3D"top"&gt;
&lt;h3 style=3D"color:#921212 !important;   margin-bottom:20px;   margin:0px=
;   letter-spacing:3px;   text-align:right;   margin-top:5px; =20
margin-right:5px;   font-size:13px;"&gt;What's new&lt;/h3&gt;
&lt;br /&gt;&lt;img src=3D"https://www.acyba.com/media/com_acymailing/templates/ac=
ymailing/images/arrow.jpg" border=3D"0" alt=3D"-" width=3D"51" height=3D"=
6" /&gt;&lt;a
href=3D"#dkim" style=3D"color:#575757;   font-size:11px;   text-decoratio=
n:underline;   cursor:pointer;"&gt;&lt;span  style=3D"color:#575757;"&gt;DKIM&lt;/spa=
n&gt;&lt;/a&gt;&lt;br
/&gt;&lt;img src=3D"https://www.acyba.com/media/com_acymailing/templates/acymai=
ling/images/arrow.jpg" border=3D"0" alt=3D"-" width=3D"51" height=3D"6" /=
&gt;&lt;a
href=3D"#permission" style=3D"color:#575757;   font-size:11px;   text-dec=
oration:underline;   cursor:pointer;"&gt;&lt;span  style=3D"color:#575757;"&gt;Per=
mission
per groups&lt;/span&gt;&lt;/a&gt;&lt;br /&gt;&lt;img src=3D"https://www.acyba.com/media/com_ac=
ymailing/templates/acymailing/images/arrow.jpg" border=3D"0" alt=3D"-" wi=
dth=3D"51"
height=3D"6" /&gt;&lt;span  style=3D"color:#575757;"&gt;&lt;a href=3D"#comm" style=3D=
"color:#575757;   font-size:11px;   text-decoration:underline; =20
cursor:pointer;"&gt;Conditional display&lt;/a&gt;&lt;/span&gt;&lt;br /&gt;&lt;img src=3D"https://=
www.acyba.com/media/com_acymailing/templates/acymailing/images/arrow.jpg"
border=3D"0" alt=3D"-" width=3D"51" height=3D"6" /&gt;&lt;a href=3D"#plugin" st=
yle=3D"color:#575757;   font-size:11px;   text-decoration:underline; =20
cursor:pointer;"&gt;&lt;span  style=3D"color:#575757;"&gt;New plugins&lt;/span&gt;&lt;/a&gt;&lt;b=
r /&gt;
&lt;/td&gt;
&lt;td width=3D"20" style=3D"font-family: Arial, Helvetica, sans-serif;font-=
size:12px;"&gt;&lt;br /&gt;&lt;/td&gt;
&lt;/tr&gt;&lt;/table&gt;
&lt;table style=3D"background-color: #f9f9f9; width: 600px;" border=3D"0" ce=
llspacing=3D"0" cellpadding=3D"0"&gt;&lt;tr&gt;
&lt;td width=3D"42" style=3D"font-family: Arial, Helvetica, sans-serif;font-=
size:12px;"&gt;&lt;br /&gt;&lt;/td&gt;
&lt;td width=3D"516" style=3D"font-family: Arial, Helvetica, sans-serif;font=
-size:12px;"&gt;
&lt;div  style=3D"font-family:Arial, Helvetica, sans-serif;font-size:12px;co=
lor:#000000;text-align:justify;padding-bottom:30px;"&gt;
&lt;h2 style=3D"color: #6b6a6a !important;   font-size: 14px;   font-weight:=
 bold;   text-align:left;   margin-bottom:10px;   border-bottom:1px solid
#921212;   letter-spacing:3px;   margin-top:30px;"&gt;10 Questions to Help U=
s Improve&lt;/h2&gt;
&lt;br /&gt;&lt;img src=3D"https://www.acyba.com/media/com_acymailing/templates/ac=
ymailing/images/acyuser.png" border=3D"0" alt=3D"acy user"  align=3D"righ=
t"
hspace=3D"5" style=3D"float: right; padding-left: 15px;" /&gt;&lt;br /&gt;It&amp;rsquo=
;s already been two years since we&amp;rsquo;ve launched AcyMailing and we&amp;rs=
quo;ve
never taken the time to poll our users! This is your chance to quickly he=
lp shape the upcoming features.&lt;br /&gt;&lt;a
href=3D"https://www.acyba.com/index.php?subid=3D137457&amp;option=3Dcom_acyma=
iling&amp;ctrl=3Duser&amp;task=3Dmodify&amp;key=3D4cebe6890bb0f3d3e8d47f5441c3d673&amp;It=
emid=3D72"
style=3D"color:#575757;   font-size:11px;   text-decoration:underline;   =
cursor:pointer;"&gt;Take me to the poll&lt;/a&gt;.&lt;/div&gt;
&lt;div  style=3D"font-family:Arial, Helvetica, sans-serif;font-size:12px;co=
lor:#000000;text-align:justify;padding-bottom:30px;"&gt;
&lt;h2 style=3D"color: #6b6a6a !important;   font-size: 14px;   font-weight:=
 bold;   text-align:left;   margin-bottom:10px;   border-bottom:1px solid
#921212;   letter-spacing:3px;   margin-top:30px;"&gt;
&lt;a name=3D"dkim" style=3D"color:#575757;   font-size:11px;   text-decorat=
ion:underline;   cursor:pointer;"&gt;&lt;/a&gt;Improve your deliverability with Do=
mainKeys
Identified Mail (DKIM)&lt;/h2&gt;
&lt;p style=3D"font-family: Arial, Helvetica, sans-serif;font-size:12px;"&gt;&lt;i=
mg
src=3D"https://www.acyba.com/media/com_acymailing/templates/acymailing/im=
ages/dkim.png" border=3D"0" alt=3D"dkim"  align=3D"left" hspace=3D"5" sty=
le=3D"float:
left; padding-right: 15px; border: 0pt none;" /&gt;DKIM is an industry stand=
ard to authenticate&amp;nbsp; the sender of an email. This greatly improves
delivery rates by avoiding spam filters.&lt;/p&gt;
&lt;p style=3D"font-family: Arial, Helvetica, sans-serif;font-size:12px;"&gt;Ac=
yMailing integrates this encrypted technology in all of its commercial
versions.&lt;/p&gt;
&lt;p style=3D"font-family: Arial, Helvetica, sans-serif;font-size:12px;"&gt;&amp;n=
bsp;&lt;/p&gt;
&lt;p style=3D"font-family: Arial, Helvetica, sans-serif;font-size:12px;"&gt;&lt;a=
 href=3D"https://www.acyba.com/en/support/documentation/156-acymailing-dk=
im.html"
style=3D"color:#575757;   font-size:11px;   text-decoration:underline;   =
cursor:pointer;"&gt;&lt;img
src=3D"https://www.acyba.com/media/com_acymailing/templates/acymailing/im=
ages/readmore.jpg" border=3D"0" alt=3D"read more" width=3D"79" height=3D"=
14"=20
align=3D"right" hspace=3D"5" style=3D"border:0pt none;text-decoration:non=
e;float:right;" /&gt;&lt;/a&gt;&lt;/p&gt;
&lt;p style=3D"font-family: Arial, Helvetica, sans-serif;font-size:12px;"&gt;&amp;n=
bsp;&lt;/p&gt;
&lt;h2 style=3D"color: #6b6a6a !important;   font-size: 14px;   font-weight:=
 bold;   text-align:left;   margin-bottom:10px;   border-bottom:1px solid
#921212;   letter-spacing:3px;   margin-top:30px;"&gt;
&lt;a name=3D"permission" style=3D"color:#575757;   font-size:11px;   text-d=
ecoration:underline;   cursor:pointer;"&gt;&lt;/a&gt;Total Control with Group
Permissions&lt;/h2&gt;
&lt;p style=3D"font-family:Arial, Helvetica, sans-serif;font-size:12px;text-=
align:left;"&gt;You can now configure which groups can do what.&lt;/p&gt;
&lt;p style=3D"font-family:Arial, Helvetica, sans-serif;font-size:12px;text-=
align:left;"&gt;&lt;img
src=3D"https://www.acyba.com/media/com_acymailing/templates/acymailing/im=
ages/tableau.png" border=3D"0" alt=3D"tableau"  align=3D"right" hspace=3D=
"5"
style=3D"float:right;padding-left:15px;" /&gt;&lt;/p&gt;
&lt;p style=3D"font-family: Arial, Helvetica, sans-serif;font-size:12px;"&gt;Fo=
r example, you can deny Managers access to the configuration page or  all=
ow
Administrators the exclusive rights to manage your lists.&lt;br /&gt;&lt;br /&gt; Gro=
up permissions is available with AcyMailing Enterprise.&lt;/p&gt;
&lt;p style=3D"font-family:Arial, Helvetica, sans-serif;font-size:12px;text-=
align:left;"&gt;&lt;a
href=3D"https://www.acyba.com/en/support/documentation/160-permissions.ht=
ml" style=3D"color:#575757;   font-size:11px;   text-decoration:underline=
; =20
cursor:pointer;"&gt;&lt;img src=3D"https://www.acyba.com/media/com_acymailing/t=
emplates/acymailing/images/readmore.jpg" border=3D"0" alt=3D"read more" w=
idth=3D"79"
height=3D"14"  align=3D"right" hspace=3D"5" style=3D"border:0pt none;text=
-decoration:none;float:right;" /&gt;&lt;/a&gt;&lt;/p&gt;
&lt;p style=3D"font-family:Arial, Helvetica, sans-serif;font-size:12px;text-=
align:left;"&gt;&amp;nbsp;&lt;/p&gt;
&lt;h2 style=3D"color: #6b6a6a !important;   font-size: 14px;   font-weight:=
 bold;   text-align:left;   margin-bottom:10px;   border-bottom:1px solid
#921212;   letter-spacing:3px;   margin-top:30px;"&gt;
&lt;a name=3D"comm" style=3D"color:#575757;   font-size:11px;   text-decorat=
ion:underline;   cursor:pointer;"&gt;&lt;/a&gt;Personalize Your Content Based On U=
ser
Profile&lt;/h2&gt;
Say hello to bullseye emailing. Leverage your custom profile fields to ta=
rget content to specific users. For example, you can easily add content t=
o an
email for subscribers in a specific country or to women only. What else? =
Include an invitation to register to your site for your AcyMailing
subscribers only.&lt;br /&gt;&lt;p style=3D"font-family: Arial, Helvetica, sans-se=
rif;font-size:12px;"&gt;&lt;a
href=3D"https://www.acyba.com/en/support/documentation/159-acymailing-plu=
gin-ifstatements.html" style=3D"color:#575757;   font-size:11px; =20
text-decoration:underline;   cursor:pointer;"&gt;&lt;img src=3D"https://www.acy=
ba.com/media/com_acymailing/templates/acymailing/images/readmore.jpg"
border=3D"0" alt=3D"read more" width=3D"79" height=3D"14"  align=3D"right=
" hspace=3D"5" style=3D"border:0pt none;text-decoration:none;float:right;=
" /&gt;&lt;/a&gt;&lt;/p&gt;
&lt;p style=3D"font-family: Arial, Helvetica, sans-serif;font-size:12px;"&gt;&amp;n=
bsp;&lt;/p&gt;
&lt;h2 style=3D"color: #6b6a6a !important;   font-size: 14px;   font-weight:=
 bold;   text-align:left;   margin-bottom:10px;   border-bottom:1px solid
#921212;   letter-spacing:3px;   margin-top:30px;"&gt;
&lt;a name=3D"plugin" style=3D"color:#575757;   font-size:11px;   text-decor=
ation:underline;   cursor:pointer;"&gt;&lt;/a&gt;13 New Plugins for Seamless
Integration&lt;/h2&gt;
&lt;div  style=3D"font-family:Arial, Helvetica, sans-serif;font-size:12px;co=
lor:#000000;text-align:justify;padding-bottom:30px;"&gt;Filter your user or =
add
custom content with tags from other extensions.&lt;br /&gt;Below are 13 news pl=
ugins which are all available for free.&lt;/div&gt;
&lt;div  style=3D"font-family:Arial, Helvetica, sans-serif;font-size:12px;co=
lor:#000000;text-align:justify;padding-bottom:30px;"&gt;
&lt;strong&gt;Download component :&lt;/strong&gt;&lt;br /&gt; Plugin: jDownloads&lt;br /&gt; Plug=
in: Docman&lt;br /&gt; Plugin: PhocaDownload&lt;br /&gt; Plugin: RokDownloads&lt;br /&gt;
Plugin: Remository&lt;img src=3D"https://www.acyba.com/media/com_acymailing/=
templates/acymailing/images/acymailing-integrations.png" border=3D"0"
alt=3D"integrations"  align=3D"right" hspace=3D"5" style=3D"float:right; =
padding-left:15px;" /&gt;&lt;br /&gt; Plugin: Joomdoc&lt;br /&gt;&lt;br /&gt;&lt;strong&gt;Event com=
ponent
:&lt;/strong&gt;&lt;br /&gt; Plugin: RsEvents&lt;br /&gt;&lt;br /&gt;&lt;strong&gt;Content component :&lt;=
/strong&gt;&lt;br /&gt; Plugin: Mighty Resources&lt;br /&gt; Plugin: ListBingo&lt;br /&gt; Plu=
gin:
SobiPro&lt;br /&gt; Plugin: Lyften Bloggie&lt;br /&gt;&lt;br /&gt;&lt;strong&gt;User management :=
&lt;/strong&gt;&lt;br /&gt; Plugin: Mighty Membership&lt;br /&gt; Plugin: Mighty
Registration&lt;/div&gt;
&lt;div style=3D"font-family:Arial, Helvetica, sans-serif;font-size:12px;tex=
t-align:right;"&gt;&lt;a
href=3D"https://www.acyba.com/en/download/plugins-modules.html" style=3D"=
color:#575757;   font-size:11px;   text-decoration:underline; =20
cursor:pointer;"&gt;See complete list of plugins&lt;/a&gt;&lt;/div&gt;
&lt;/div&gt;
&lt;/td&gt;
&lt;td width=3D"42" style=3D"font-family: Arial, Helvetica, sans-serif;font-=
size:12px;"&gt;&lt;br /&gt;&lt;/td&gt;
&lt;/tr&gt;&lt;/table&gt;
&lt;table style=3D"background-color: #f9f9f9; width: 600px;" border=3D"0" ce=
llspacing=3D"0" cellpadding=3D"0"&gt;&lt;tr&gt;
&lt;td width=3D"20" style=3D"font-family: Arial, Helvetica, sans-serif;font-=
size:12px;"&gt;&lt;br /&gt;&lt;/td&gt;
&lt;td style=3D"font-family:Arial, Helvetica, sans-serif;font-size:12px;back=
ground-color:#FFF;border-right:2px solid #e5e5e5;border-top:1px solid
#e5e5e5;border-left:1px solid #ededed;" width=3D"560"&gt;
&lt;table style=3D"width: 560px;" border=3D"0" cellspacing=3D"0" cellpadding=
=3D"0"&gt;
&lt;tr&gt;
&lt;td colspan=3D"2" style=3D"font-family: Arial, Helvetica, sans-serif;font=
-size:12px;"&gt;
&lt;h3 style=3D"color:#921212 !important;   margin-bottom:20px;   margin:0px=
;   letter-spacing:3px;   text-align:right;   margin-top:5px; =20
margin-right:5px;   font-size:13px;"&gt;Useful links&lt;/h3&gt;
&lt;/td&gt;
&lt;/tr&gt;
&lt;tr&gt;
&lt;td style=3D"font-family:Arial, Helvetica, sans-serif;font-size:12px;text=
-align:left;" width=3D"280" valign=3D"top"&gt;
&lt;img src=3D"https://www.acyba.com/media/com_acymailing/templates/acymaili=
ng/images/arrow2.jpg" border=3D"0" alt=3D"-" width=3D"47" height=3D"16" /=
&gt;&lt;span=20
style=3D"color:#575757;"&gt;&lt;a href=3D"https://www.acyba.com/en/support/docu=
mentation.html" style=3D"color:#575757;   font-size:11px; =20
text-decoration:underline;   cursor:pointer;"&gt;Documentation&lt;/a&gt;&lt;/span&gt;&lt;br=
 /&gt;&lt;img
src=3D"https://www.acyba.com/media/com_acymailing/templates/acymailing/im=
ages/arrow2.jpg" border=3D"0" alt=3D"-" width=3D"47" height=3D"16" /&gt;&lt;spa=
n=20
style=3D"color:#575757;"&gt;&lt;a href=3D"https://www.acyba.com/en/support/docu=
mentation/66-how-to-install-acymailing.html#update" style=3D"color:#57575=
7; =20
font-size:11px;   text-decoration:underline;   cursor:pointer;"&gt;How to up=
grade?&lt;/a&gt;&lt;/span&gt;&lt;br /&gt;&lt;img
src=3D"https://www.acyba.com/media/com_acymailing/templates/acymailing/im=
ages/arrow2.jpg" border=3D"0" alt=3D"-" width=3D"47" height=3D"16" /&gt;&lt;spa=
n=20
style=3D"color:#575757;"&gt;&lt;a href=3D"https://www.acyba.com/en/support/docu=
mentation/68-acymailing-changelog.html" style=3D"color:#575757;   font-si=
ze:11px; =20
text-decoration:underline;   cursor:pointer;"&gt;Change Log&lt;/a&gt;&lt;/span&gt;&lt;br /&gt;
&lt;/td&gt;
&lt;td style=3D"font-family:Arial, Helvetica, sans-serif;font-size:12px;text=
-align:left;" width=3D"280" valign=3D"top"&gt;
&lt;img src=3D"https://www.acyba.com/media/com_acymailing/templates/acymaili=
ng/images/arrow2.jpg" border=3D"0" alt=3D"-" width=3D"47" height=3D"16" /=
&gt;&lt;span=20
style=3D"color:#575757;"&gt;&lt;a
href=3D"https://www.acyba.com/en/products.html?page=3Dshop.product_detail=
s&amp;product_id=3D17&amp;flypage=3Dflypage.tpl&amp;pop=3D0&amp;category_id=3D6" style=3D=
"color:#575757; =20
font-size:11px;   text-decoration:underline;   cursor:pointer;"&gt;Buy AcyMa=
iling Essential&lt;/a&gt;&lt;/span&gt;&lt;br /&gt;&lt;img
src=3D"https://www.acyba.com/media/com_acymailing/templates/acymailing/im=
ages/arrow2.jpg" border=3D"0" alt=3D"-" width=3D"47" height=3D"16" /&gt;&lt;spa=
n=20
style=3D"color:#575757;"&gt;&lt;a
href=3D"https://www.acyba.com/en/products.html?page=3Dshop.product_detail=
s&amp;product_id=3D18&amp;flypage=3Dflypage.tpl&amp;pop=3D0&amp;category_id=3D6" style=3D=
"color:#575757; =20
font-size:11px;   text-decoration:underline;   cursor:pointer;"&gt;Buy AcyMa=
iling Business&lt;/a&gt;&lt;/span&gt;&lt;br /&gt;&lt;img
src=3D"https://www.acyba.com/media/com_acymailing/templates/acymailing/im=
ages/arrow2.jpg" border=3D"0" alt=3D"-" width=3D"47" height=3D"16" /&gt;&lt;spa=
n=20
style=3D"color:#575757;"&gt;&lt;a
href=3D"https://www.acyba.com/en/products.html?page=3Dshop.product_detail=
s&amp;product_id=3D19&amp;flypage=3Dflypage.tpl&amp;pop=3D0&amp;category_id=3D6" style=3D=
"color:#575757; =20
font-size:11px;   text-decoration:underline;   cursor:pointer;"&gt;Buy AcyMa=
iling Enterprise&lt;/a&gt;&lt;/span&gt;&lt;br /&gt;
&lt;/td&gt;
&lt;/tr&gt;
&lt;/table&gt;
&lt;/td&gt;
&lt;td width=3D"20" style=3D"font-family: Arial, Helvetica, sans-serif;font-=
size:12px;"&gt;&lt;br /&gt;&lt;/td&gt;
&lt;/tr&gt;&lt;/table&gt;
&lt;table style=3D"background-color: #f9f9f9; width: 600px;" border=3D"0" ce=
llspacing=3D"0" cellpadding=3D"0"&gt;
&lt;tr style=3D"line-height: 0px;"&gt;
&lt;td style=3D"font-family:Arial, Helvetica, sans-serif;font-size:12px;line=
-height:0px;" colspan=3D"6"&gt;&lt;img
src=3D"https://www.acyba.com/media/com_acymailing/templates/acymailing/im=
ages/footer.jpg" border=3D"0" width=3D"600" height=3D"40" name=3D"footer"=
 /&gt;&lt;/td&gt;
&lt;/tr&gt;
&lt;tr&gt;
&lt;td style=3D"font-family:Arial, Helvetica, sans-serif;font-size:12px;line=
-height:0px;" width=3D"173"&gt;&lt;img
src=3D"https://www.acyba.com/media/com_acymailing/templates/acymailing/im=
ages/footer1.jpg" border=3D"0" width=3D"173" height=3D"43" name=3D"footer=
1" /&gt;&lt;/td&gt;
&lt;td style=3D"font-family:Arial, Helvetica, sans-serif;font-size:12px;line=
-height:0px;" width=3D"45"&gt;&lt;a
href=3D"https://www.acyba.com/index.php?subid=3D137457&amp;option=3Dcom_acyma=
iling&amp;ctrl=3Duser&amp;task=3Dout&amp;mailid=3D75&amp;key=3D4cebe6890bb0f3d3e8d47f5441=
c3d673&amp;Itemid=3D72"
style=3D"color:#575757;font-size:11px;text-decoration:underline;cursor:po=
inter;line-height:0px;"&gt;&lt;img
src=3D"https://www.acyba.com/media/com_acymailing/templates/acymailing/im=
ages/unsubscribe1.jpg" border=3D"0" alt=3D"unsubscribe" width=3D"45" heig=
ht=3D"43"
name=3D"unsubscribe1" style=3D"border:0px;text-decoration:none;" /&gt;&lt;/a&gt;&lt;/=
td&gt;
&lt;td style=3D"font-family:Arial, Helvetica, sans-serif;font-size:12px;line=
-height:0px;" width=3D"250"&gt;&lt;img
src=3D"https://www.acyba.com/media/com_acymailing/templates/acymailing/im=
ages/footer2.jpg" border=3D"0" width=3D"250" height=3D"43" name=3D"footer=
2" /&gt;&lt;/td&gt;
&lt;td style=3D"font-family:Arial, Helvetica, sans-serif;font-size:12px;line=
-height:0px;" width=3D"61"&gt;&lt;a href=3D"http://twitter.com/#%21/acyba"
style=3D"color:#575757;font-size:11px;text-decoration:underline;cursor:po=
inter;line-height:0px;"&gt;&lt;img
src=3D"https://www.acyba.com/media/com_acymailing/templates/acymailing/im=
ages/twitter1.jpg" border=3D"0" alt=3D"twitter" width=3D"61" height=3D"43=
"
name=3D"twitter1" style=3D"border:0px;text-decoration:none;" /&gt;&lt;/a&gt;&lt;/td&gt;
&lt;td style=3D"font-family:Arial, Helvetica, sans-serif;font-size:12px;line=
-height:0px;" width=3D"56"&gt;&lt;a
href=3D"http://www.facebook.com/pages/AcyMailing/120374104713871"
style=3D"color:#575757;font-size:11px;text-decoration:underline;cursor:po=
inter;line-height:0px;"&gt;&lt;img
src=3D"https://www.acyba.com/media/com_acymailing/templates/acymailing/im=
ages/facebook1.jpg" border=3D"0" alt=3D"facebook" width=3D"56" height=3D"=
43"
name=3D"facebook1" style=3D"border:0px;text-decoration:none;" /&gt;&lt;/a&gt;&lt;/td&gt;
&lt;td style=3D"font-family:Arial, Helvetica, sans-serif;font-size:12px;line=
-height:0px;" width=3D"15"&gt;&lt;img
src=3D"https://www.acyba.com/media/com_acymailing/templates/acymailing/im=
ages/footer3.jpg" border=3D"0" width=3D"15" height=3D"43" name=3D"footer3=
" /&gt;&lt;/td&gt;
&lt;/tr&gt;
&lt;tr&gt;
&lt;td style=3D"font-family:Arial, Helvetica, sans-serif;font-size:12px;back=
ground-color:#e4e3e3;" width=3D"173" valign=3D"top"&gt;&lt;a
href=3D"https://www.acyba.com/index.php?subid=3D137457&amp;option=3Dcom_acyma=
iling&amp;ctrl=3Duser&amp;task=3Dout&amp;mailid=3D75&amp;key=3D4cebe6890bb0f3d3e8d47f5441=
c3d673&amp;Itemid=3D72"
style=3D"color:#575757;   font-size:11px;   text-decoration:underline;   =
cursor:pointer;"&gt;&lt;span  style=3D"font-size:11px;   color:#000; =20
text-decoration:none;"&gt;Unsubscribe Newsletter&lt;/span&gt;&lt;/a&gt;&lt;/td&gt;
&lt;td style=3D"font-family:Arial, Helvetica, sans-serif;font-size:12px;line=
-height:0px;" width=3D"45"&gt;&lt;img
src=3D"https://www.acyba.com/media/com_acymailing/templates/acymailing/im=
ages/unsubscribe2.jpg" border=3D"0" alt=3D"unsubscribe" width=3D"45" heig=
ht=3D"37"
name=3D"unsubscribe2" /&gt;&lt;/td&gt;
&lt;td style=3D"font-family:Arial, Helvetica, sans-serif;font-size:12px;back=
ground-color:#e4e3e3;" width=3D"250"&gt;&lt;br /&gt;&lt;/td&gt;
&lt;td style=3D"font-family:Arial, Helvetica, sans-serif;font-size:12px;line=
-height:0px;" width=3D"61"&gt;&lt;img
src=3D"https://www.acyba.com/media/com_acymailing/templates/acymailing/im=
ages/twitter2.jpg" border=3D"0" alt=3D"twitter" width=3D"61" height=3D"37=
"
name=3D"twitter2" /&gt;&lt;/td&gt;
&lt;td style=3D"font-family:Arial, Helvetica, sans-serif;font-size:12px;line=
-height:0px;" width=3D"56"&gt;&lt;img
src=3D"https://www.acyba.com/media/com_acymailing/templates/acymailing/im=
ages/facebook2.jpg" border=3D"0" alt=3D"facebook" width=3D"56" height=3D"=
37"
name=3D"facebook2" /&gt;&lt;/td&gt;
&lt;td style=3D"font-family:Arial, Helvetica, sans-serif;font-size:12px;back=
ground-color:#e4e3e3;" width=3D"15"&gt;&lt;br /&gt;&lt;/td&gt;
&lt;/tr&gt;
&lt;/table&gt;
&lt;/td&gt;
&lt;/tr&gt;&lt;/table&gt;
&lt;/div&gt;
&lt;img  alt=3D"" src=3D"https://www.acyba.com/index.php?option=3Dcom_acymai=
ling&amp;ctrl=3Dstats&amp;mailid=3D75&amp;subid=3D137457&amp;no_html=3D1&amp;Itemid=3D72" bor=
der=3D"0" height=3D"2"
width=3D"180" /&gt;
&lt;/body&gt;
&lt;/html&gt;



--b1_a54f899e69f9e62a16ad60cc23439633--

</td></tr>
</tbody></table></td></tr>
<tr>
				<td valign="top" onclick="dBug_toggleRow(this)" class="dBug_objectKey">text</td>
				<td><table cellspacing="2" cellpadding="3" class="dBug_object">
				<tbody><tr>
					<td class="dBug_objectHeader" colspan="2" onclick="dBug_toggleTable(this)">object</td>
				</tr><tr>
				<td valign="top" onclick="dBug_toggleRow(this)" class="dBug_objectKey">title</td>
				<td>Text version</td></tr>
<tr>
				<td valign="top" onclick="dBug_toggleRow(this)" class="dBug_objectKey">content</td>
				<td>Hi Api,
2011, July

A rare email from us!
We rarely take the time to email our users although we help millions of emails being sent everyday.
Ironic you say? Well, we do what we preach: only email your subscribers when you really have something new or important to say. Find both of these
below.

What's new

DKIM
 Permission per groups
 Conditional display
 New plugins

10 Questions to Help Us Improve

It�s already been two years since we�ve launched AcyMailing and we�ve never taken the time to poll our users! This is your chance to quickly
help shape the upcoming features.
 Take me to the poll (
https://www.acyba.com/index.php?subid=137457&amp;option=com_acymailing&amp;ctrl=user&amp;task=modify&amp;key=4cebe6890bb0f3d3e8d47f5441c3d673&amp;Itemid=72 ).

Improve your deliverability with DomainKeys Identified Mail (DKIM)

DKIM is an industry standard to authenticate the sender of an email. This greatly improves delivery rates by avoiding spam filters.
AcyMailing integrates this encrypted technology in all of its commercial versions.

Total Control with Group Permissions

You can now configure which groups can do what.

For example, you can deny Managers access to the configuration page or allow Administrators the exclusive rights to manage your lists.

Group permissions is available with AcyMailing Enterprise.

Personalize Your Content Based On User Profile
Say hello to bullseye emailing. Leverage your custom profile fields to target content to specific users. For example, you can easily add content to an
email for subscribers in a specific country or to women only. What else? Include an invitation to register to your site for your AcyMailing
subscribers only.

13 New Plugins for Seamless Integration

Filter your user or add custom content with tags from other extensions.
Below are 13 news plugins which are all available for free.
Download component :
 Plugin: jDownloads
 Plugin: Docman
 Plugin: PhocaDownload
 Plugin: RokDownloads
 Plugin: Remository
 Plugin: Joomdoc

Event component :
 Plugin: RsEvents

Content component :
 Plugin: Mighty Resources
 Plugin: ListBingo
 Plugin: SobiPro
 Plugin: Lyften Bloggie

User management :
 Plugin: Mighty Membership
 Plugin: Mighty Registration
See complete list of plugins ( https://www.acyba.com/en/download/plugins-modules.html )

Useful links

Documentation ( https://www.acyba.com/en/support/documentation.html )
 How to upgrade? ( https://www.acyba.com/en/support/documentation/66-how-to-install-acymailing.html#update )
 Change Log ( https://www.acyba.com/en/support/documentation/68-acymailing-changelog.html )

Buy AcyMailing Essential ( https://www.acyba.com/en/products.html?page=shop.product_details&amp;product_id=17&amp;flypage=flypage.tpl&amp;pop=0&amp;category_id=6 )
 Buy AcyMailing Business ( https://www.acyba.com/en/products.html?page=shop.product_details&amp;product_id=18&amp;flypage=flypage.tpl&amp;pop=0&amp;category_id=6 )
 Buy AcyMailing Enterprise ( https://www.acyba.com/en/products.html?page=shop.product_details&amp;product_id=19&amp;flypage=flypage.tpl&amp;pop=0&amp;category_id=6 )

Unsubscribe Newsletter (
https://www.acyba.com/index.php?subid=137457&amp;option=com_acymailing&amp;ctrl=user&amp;task=out&amp;mailid=75&amp;key=4cebe6890bb0f3d3e8d47f5441c3d673&amp;Itemid=72 )

</td></tr>
</tbody></table></td></tr>
<tr>
				<td valign="top" onclick="dBug_toggleRow(this)" class="dBug_objectKey">html</td>
				<td><table cellspacing="2" cellpadding="3" class="dBug_object">
				<tbody><tr>
					<td class="dBug_objectHeader" colspan="2" onclick="dBug_toggleTable(this)">object</td>
				</tr><tr>
				<td valign="top" onclick="dBug_toggleRow(this)" class="dBug_objectKey">title</td>
				<td>HTML version</td></tr>
<tr>
				<td valign="top" onclick="dBug_toggleRow(this)" class="dBug_objectKey">content</td>
				<td>



<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Tell us how to make Acy better</title>
<style type="text/css">
.ReadMsgBody{width: 100%;}
.ExternalClass{width: 100%;}
div, p, a, li, td { -webkit-text-size-adjust:none; }
h2{ color: #6b6a6a ;   font-size: 14px;   font-weight: bold;   text-align:left;   margin-bottom:10px;   border-bottom:1px solid #921212;  
letter-spacing:3px;   margin-top:30px; }
h3{ color:#921212 ;   margin-bottom:20px;   margin:0px;   letter-spacing:3px;   text-align:right;   margin-top:5px;   margin-right:5px;  
font-size:13px; }
a:visited{color:#575757;   font-size:11px;   text-decoration:underline;   cursor:pointer;}
</style>


<div style="font-family:Arial, Helvetica, sans-serif;font-size:12px;text-align:center;background-color:#e4e3e3;padding:20px 0px;">
<table style="margin: auto; width: 600px;" border="0" cellspacing="0" cellpadding="0" align="center"><tbody><tr>
<td style="font-family: Arial, Helvetica, sans-serif;font-size:12px;">
<table style="width: 600px;" border="0" cellspacing="0" cellpadding="0"><tbody><tr>
<td style="font-family:Arial, Helvetica, sans-serif;font-size:12px;line-height:0px;" width="138"><img src="{{ asset('/assets/examples') . 'acymailing_logo.jpg' }}" border="0" alt="AcyMailing" width="138" height="173" name="AcyMailing" style="border: 0;"></td>
<td style="font-family: Arial, Helvetica, sans-serif;font-size:12px;">
<table style="width: 462px;" border="0" cellspacing="0" cellpadding="0">
<tbody><tr style="line-height: 0px;">
<td style="font-family:Arial, Helvetica, sans-serif;font-size:12px;line-height:0px;" colspan="2"><img src="{{ asset('/assets/examples') . 'acymailing.jpg' }}" border="0" alt="Newsletter and email marketing" width="462" height="94" name="title" style="border: 0;"></td>
</tr>
<tr>
<td style="font-family:Arial, Helvetica, sans-serif;font-size:12px;background-color:#f9f9f9;text-align:left;" width="264" height="79"><span style="color:#921212;font-weight:bold;">Hi Api,</span></td>
<td style="font-family:Arial, Helvetica,
sans-serif;font-size:12px;color:#575757;padding-right:10px;letter-spacing:2px;background-color:#f9f9f9;text-align:right;" width="198" height="79" valign="top">2011, July<br>
</td>
</tr>
</tbody></table>
</td>
</tr></tbody></table>
<table style="background-color: #f9f9f9; width: 600px;" border="0" cellspacing="0" cellpadding="0"><tbody><tr>
<td width="42" style="font-family: Arial, Helvetica, sans-serif;font-size:12px;"><br></td>
<td width="244" style="font-family:Arial, Helvetica, sans-serif;font-size:12px;color:#000;text-align:justify;">
<p style="font-family: Arial, Helvetica, sans-serif;font-size:12px;">A rare email from us!<br>We rarely take the time to email our users although we
help millions of emails being sent everyday.<br>Ironic you say? Well, we do what we preach: only email your subscribers when you really have
something new or important to say. Find both of these below.</p>
</td>
<td width="44" style="font-family: Arial, Helvetica, sans-serif;font-size:12px;"><br></td>
<td style="font-family:Arial, Helvetica, sans-serif;font-size:12px;text-align:left;background-color:#FFF;border-right:2px solid
#e5e5e5;border-bottom:2px solid #e5e5e5;border-top:1px solid #e5e5e5;border-left:1px solid #ededed;" width="250" valign="top">
<h3 style="color:#921212 !important;   margin-bottom:20px;   margin:0px;   letter-spacing:3px;   text-align:right;   margin-top:5px;  
margin-right:5px;   font-size:13px;">What's new</h3>
<br><img src="{{ asset('/assets/examples') . 'arrow.jpg' }}" border="0" alt="-" width="51" height="6"><a href="#dkim" style="color:#575757;   font-size:11px;   text-decoration:underline;   cursor:pointer;"><span style="color:#575757;">DKIM</span></a><br><img src="{{ asset('/assets/examples') . 'arrow.jpg' }}" border="0" alt="-" width="51" height="6"><a href="#permission" style="color:#575757;   font-size:11px;   text-decoration:underline;   cursor:pointer;"><span style="color:#575757;">Permission
per groups</span></a><br><img src="{{ asset('/assets/examples') . 'arrow.jpg' }}" border="0" alt="-" width="51" height="6"><span style="color:#575757;"><a href="#comm" style="color:#575757;   font-size:11px;   text-decoration:underline;  
cursor:pointer;">Conditional display</a></span><br><img src="{{ asset('/assets/examples') . 'arrow.jpg' }}" border="0" alt="-" width="51" height="6"><a href="#plugin" style="color:#575757;   font-size:11px;   text-decoration:underline;  
cursor:pointer;"><span style="color:#575757;">New plugins</span></a><br>
</td>
<td width="20" style="font-family: Arial, Helvetica, sans-serif;font-size:12px;"><br></td>
</tr></tbody></table>
<table style="background-color: #f9f9f9; width: 600px;" border="0" cellspacing="0" cellpadding="0"><tbody><tr>
<td width="42" style="font-family: Arial, Helvetica, sans-serif;font-size:12px;"><br></td>
<td width="516" style="font-family: Arial, Helvetica, sans-serif;font-size:12px;">
<div style="font-family:Arial, Helvetica, sans-serif;font-size:12px;color:#000000;text-align:justify;padding-bottom:30px;">
<h2 style="color: #6b6a6a !important;   font-size: 14px;   font-weight: bold;   text-align:left;   margin-bottom:10px;   border-bottom:1px solid
#921212;   letter-spacing:3px;   margin-top:30px;">10 Questions to Help Us Improve</h2>
<br><img src="{{ asset('/assets/examples') . 'acyuser.png' }}" border="0" alt="acy user" align="right" hspace="5" style="float: right; padding-left: 15px;"><br>It’s already been two years since we’ve launched AcyMailing and we’ve
never taken the time to poll our users! This is your chance to quickly help shape the upcoming features.<br><a href="https://www.acyba.com/index.php?subid=137457&amp;option=com_acymailing&amp;ctrl=user&amp;task=modify&amp;key=4cebe6890bb0f3d3e8d47f5441c3d673&amp;Itemid=72" style="color:#575757;   font-size:11px;   text-decoration:underline;   cursor:pointer;">Take me to the poll</a>.</div>
<div style="font-family:Arial, Helvetica, sans-serif;font-size:12px;color:#000000;text-align:justify;padding-bottom:30px;">
<h2 style="color: #6b6a6a !important;   font-size: 14px;   font-weight: bold;   text-align:left;   margin-bottom:10px;   border-bottom:1px solid
#921212;   letter-spacing:3px;   margin-top:30px;">
<a name="dkim" style="color:#575757;   font-size:11px;   text-decoration:underline;   cursor:pointer;"></a>Improve your deliverability with DomainKeys
Identified Mail (DKIM)</h2>
<p style="font-family: Arial, Helvetica, sans-serif;font-size:12px;"><img src="{{ asset('/assets/examples') . 'dkim.png' }}" border="0" alt="dkim" align="left" hspace="5" style="float:
left; padding-right: 15px; border: 0pt none;">DKIM is an industry standard to authenticate&nbsp; the sender of an email. This greatly improves
delivery rates by avoiding spam filters.</p>
<p style="font-family: Arial, Helvetica, sans-serif;font-size:12px;">AcyMailing integrates this encrypted technology in all of its commercial
versions.</p>
<p style="font-family: Arial, Helvetica, sans-serif;font-size:12px;">&nbsp;</p>
<p style="font-family: Arial, Helvetica, sans-serif;font-size:12px;"><a href="https://www.acyba.com/en/support/documentation/156-acymailing-dkim.html" style="color:#575757;   font-size:11px;   text-decoration:underline;   cursor:pointer;"><img src="{{ asset('/assets/examples') . 'readmore.jpg' }}" border="0" alt="read more" width="79" height="14" align="right" hspace="5" style="border:0pt none;text-decoration:none;float:right;"></a></p>
<p style="font-family: Arial, Helvetica, sans-serif;font-size:12px;">&nbsp;</p>
<h2 style="color: #6b6a6a !important;   font-size: 14px;   font-weight: bold;   text-align:left;   margin-bottom:10px;   border-bottom:1px solid
#921212;   letter-spacing:3px;   margin-top:30px;">
<a name="permission" style="color:#575757;   font-size:11px;   text-decoration:underline;   cursor:pointer;"></a>Total Control with Group
Permissions</h2>
<p style="font-family:Arial, Helvetica, sans-serif;font-size:12px;text-align:left;">You can now configure which groups can do what.</p>
<p style="font-family:Arial, Helvetica, sans-serif;font-size:12px;text-align:left;"><img src="{{ asset('/assets/examples') . 'tableau.png' }}" border="0" alt="tableau" align="right" hspace="5" style="float:right;padding-left:15px;"></p>
<p style="font-family: Arial, Helvetica, sans-serif;font-size:12px;">For example, you can deny Managers access to the configuration page or  allow
Administrators the exclusive rights to manage your lists.<br><br> Group permissions is available with AcyMailing Enterprise.</p>
<p style="font-family:Arial, Helvetica, sans-serif;font-size:12px;text-align:left;"><a href="https://www.acyba.com/en/support/documentation/160-permissions.html" style="color:#575757;   font-size:11px;   text-decoration:underline;  
cursor:pointer;"><img src="{{ asset('/assets/examples') . 'readmore.jpg' }}" border="0" alt="read more" width="79" height="14" align="right" hspace="5" style="border:0pt none;text-decoration:none;float:right;"></a></p>
<p style="font-family:Arial, Helvetica, sans-serif;font-size:12px;text-align:left;">&nbsp;</p>
<h2 style="color: #6b6a6a !important;   font-size: 14px;   font-weight: bold;   text-align:left;   margin-bottom:10px;   border-bottom:1px solid
#921212;   letter-spacing:3px;   margin-top:30px;">
<a name="comm" style="color:#575757;   font-size:11px;   text-decoration:underline;   cursor:pointer;"></a>Personalize Your Content Based On User
Profile</h2>
Say hello to bullseye emailing. Leverage your custom profile fields to target content to specific users. For example, you can easily add content to an
email for subscribers in a specific country or to women only. What else? Include an invitation to register to your site for your AcyMailing
subscribers only.<br><p style="font-family: Arial, Helvetica, sans-serif;font-size:12px;"><a href="https://www.acyba.com/en/support/documentation/159-acymailing-plugin-ifstatements.html" style="color:#575757;   font-size:11px;  
text-decoration:underline;   cursor:pointer;"><img src="{{ asset('/assets/examples') . 'readmore.jpg' }}" border="0" alt="read more" width="79" height="14" align="right" hspace="5" style="border:0pt none;text-decoration:none;float:right;"></a></p>
<p style="font-family: Arial, Helvetica, sans-serif;font-size:12px;">&nbsp;</p>
<h2 style="color: #6b6a6a !important;   font-size: 14px;   font-weight: bold;   text-align:left;   margin-bottom:10px;   border-bottom:1px solid
#921212;   letter-spacing:3px;   margin-top:30px;">
<a name="plugin" style="color:#575757;   font-size:11px;   text-decoration:underline;   cursor:pointer;"></a>13 New Plugins for Seamless
Integration</h2>
<div style="font-family:Arial, Helvetica, sans-serif;font-size:12px;color:#000000;text-align:justify;padding-bottom:30px;">Filter your user or add
custom content with tags from other extensions.<br>Below are 13 news plugins which are all available for free.</div>
<div style="font-family:Arial, Helvetica, sans-serif;font-size:12px;color:#000000;text-align:justify;padding-bottom:30px;">
<strong>Download component :</strong><br> Plugin: jDownloads<br> Plugin: Docman<br> Plugin: PhocaDownload<br> Plugin: RokDownloads<br>
Plugin: Remository<img src="{{ asset('/assets/examples') . 'acymailing-integrations.pn' }}g" border="0" alt="integrations" align="right" hspace="5" style="float:right; padding-left:15px;"><br> Plugin: Joomdoc<br><br><strong>Event component
:</strong><br> Plugin: RsEvents<br><br><strong>Content component :</strong><br> Plugin: Mighty Resources<br> Plugin: ListBingo<br> Plugin:
SobiPro<br> Plugin: Lyften Bloggie<br><br><strong>User management :</strong><br> Plugin: Mighty Membership<br> Plugin: Mighty
Registration</div>
<div style="font-family:Arial, Helvetica, sans-serif;font-size:12px;text-align:right;"><a href="https://www.acyba.com/en/download/plugins-modules.html" style="color:#575757;   font-size:11px;   text-decoration:underline;  
cursor:pointer;">See complete list of plugins</a></div>
</div>
</td>
<td width="42" style="font-family: Arial, Helvetica, sans-serif;font-size:12px;"><br></td>
</tr></tbody></table>
<table style="background-color: #f9f9f9; width: 600px;" border="0" cellspacing="0" cellpadding="0"><tbody><tr>
<td width="20" style="font-family: Arial, Helvetica, sans-serif;font-size:12px;"><br></td>
<td style="font-family:Arial, Helvetica, sans-serif;font-size:12px;background-color:#FFF;border-right:2px solid #e5e5e5;border-top:1px solid
#e5e5e5;border-left:1px solid #ededed;" width="560">
<table style="width: 560px;" border="0" cellspacing="0" cellpadding="0">
<tbody><tr>
<td colspan="2" style="font-family: Arial, Helvetica, sans-serif;font-size:12px;">
<h3 style="color:#921212 !important;   margin-bottom:20px;   margin:0px;   letter-spacing:3px;   text-align:right;   margin-top:5px;  
margin-right:5px;   font-size:13px;">Useful links</h3>
</td>
</tr>
<tr>
<td style="font-family:Arial, Helvetica, sans-serif;font-size:12px;text-align:left;" width="280" valign="top">
<img src="{{ asset('/assets/examples') . 'arrow2.jpg' }}" border="0" alt="-" width="47" height="16"><span style="color:#575757;"><a href="https://www.acyba.com/en/support/documentation.html" style="color:#575757;   font-size:11px;  
text-decoration:underline;   cursor:pointer;">Documentation</a></span><br><img src="{{ asset('/assets/examples') . 'arrow2.jpg' }}" border="0" alt="-" width="47" height="16"><span style="color:#575757;"><a href="https://www.acyba.com/en/support/documentation/66-how-to-install-acymailing.html#update" style="color:#575757;  
font-size:11px;   text-decoration:underline;   cursor:pointer;">How to upgrade?</a></span><br><img src="{{ asset('/assets/examples') . 'arrow2.jpg' }}" border="0" alt="-" width="47" height="16"><span style="color:#575757;"><a href="https://www.acyba.com/en/support/documentation/68-acymailing-changelog.html" style="color:#575757;   font-size:11px;  
text-decoration:underline;   cursor:pointer;">Change Log</a></span><br>
</td>
<td style="font-family:Arial, Helvetica, sans-serif;font-size:12px;text-align:left;" width="280" valign="top">
<img src="{{ asset('/assets/examples') . 'arrow2.jpg' }}" border="0" alt="-" width="47" height="16"><span style="color:#575757;"><a href="https://www.acyba.com/en/products.html?page=shop.product_details&amp;product_id=17&amp;flypage=flypage.tpl&amp;pop=0&amp;category_id=6" style="color:#575757;  
font-size:11px;   text-decoration:underline;   cursor:pointer;">Buy AcyMailing Essential</a></span><br><img src="{{ asset('/assets/examples') . 'arrow2.jpg' }}" border="0" alt="-" width="47" height="16"><span style="color:#575757;"><a href="https://www.acyba.com/en/products.html?page=shop.product_details&amp;product_id=18&amp;flypage=flypage.tpl&amp;pop=0&amp;category_id=6" style="color:#575757;  
font-size:11px;   text-decoration:underline;   cursor:pointer;">Buy AcyMailing Business</a></span><br><img src="{{ asset('/assets/examples') . 'arrow2.jpg' }}" border="0" alt="-" width="47" height="16"><span style="color:#575757;"><a href="https://www.acyba.com/en/products.html?page=shop.product_details&amp;product_id=19&amp;flypage=flypage.tpl&amp;pop=0&amp;category_id=6" style="color:#575757;  
font-size:11px;   text-decoration:underline;   cursor:pointer;">Buy AcyMailing Enterprise</a></span><br>
</td>
</tr>
</tbody></table>
</td>
<td width="20" style="font-family: Arial, Helvetica, sans-serif;font-size:12px;"><br></td>
</tr></tbody></table>
<table style="background-color: #f9f9f9; width: 600px;" border="0" cellspacing="0" cellpadding="0">
<tbody><tr style="line-height: 0px;">
<td style="font-family:Arial, Helvetica, sans-serif;font-size:12px;line-height:0px;" colspan="6"><img src="{{ asset('/assets/examples') . 'footer.jpg' }}" border="0" width="600" height="40" name="footer"></td>
</tr>
<tr>
<td style="font-family:Arial, Helvetica, sans-serif;font-size:12px;line-height:0px;" width="173"><img src="{{ asset('/assets/examples') . 'footer1.jpg' }}" border="0" width="173" height="43" name="footer1"></td>
<td style="font-family:Arial, Helvetica, sans-serif;font-size:12px;line-height:0px;" width="45"><a href="https://www.acyba.com/index.php?subid=137457&amp;option=com_acymailing&amp;ctrl=user&amp;task=out&amp;mailid=75&amp;key=4cebe6890bb0f3d3e8d47f5441c3d673&amp;Itemid=72" style="color:#575757;font-size:11px;text-decoration:underline;cursor:pointer;line-height:0px;"><img src="{{ asset('/assets/examples') . 'unsubscribe1.jpg' }}" border="0" alt="unsubscribe" width="45" height="43" name="unsubscribe1" style="border:0px;text-decoration:none;"></a></td>
<td style="font-family:Arial, Helvetica, sans-serif;font-size:12px;line-height:0px;" width="250"><img src="{{ asset('/assets/examples') . 'footer2.jpg' }}" border="0" width="250" height="43" name="footer2"></td>
<td style="font-family:Arial, Helvetica, sans-serif;font-size:12px;line-height:0px;" width="61"><a href="http://twitter.com/#%21/acyba" style="color:#575757;font-size:11px;text-decoration:underline;cursor:pointer;line-height:0px;"><img src="{{ asset('/assets/examples') . 'twitter1.jpg' }}" border="0" alt="twitter" width="61" height="43" name="twitter1" style="border:0px;text-decoration:none;"></a></td>
<td style="font-family:Arial, Helvetica, sans-serif;font-size:12px;line-height:0px;" width="56"><a href="http://www.facebook.com/pages/AcyMailing/120374104713871" style="color:#575757;font-size:11px;text-decoration:underline;cursor:pointer;line-height:0px;"><img src="{{ asset('/assets/examples') . 'facebook1.jpg' }}" border="0" alt="facebook" width="56" height="43" name="facebook1" style="border:0px;text-decoration:none;"></a></td>
<td style="font-family:Arial, Helvetica, sans-serif;font-size:12px;line-height:0px;" width="15"><img src="{{ asset('/assets/examples') . 'footer3.jpg' }}" border="0" width="15" height="43" name="footer3"></td>
</tr>
<tr>
<td style="font-family:Arial, Helvetica, sans-serif;font-size:12px;background-color:#e4e3e3;" width="173" valign="top"><a href="https://www.acyba.com/index.php?subid=137457&amp;option=com_acymailing&amp;ctrl=user&amp;task=out&amp;mailid=75&amp;key=4cebe6890bb0f3d3e8d47f5441c3d673&amp;Itemid=72" style="color:#575757;   font-size:11px;   text-decoration:underline;   cursor:pointer;"><span style="font-size:11px;   color:#000;  
text-decoration:none;">Unsubscribe Newsletter</span></a></td>
<td style="font-family:Arial, Helvetica, sans-serif;font-size:12px;line-height:0px;" width="45"><img src="{{ asset('/assets/examples') . 'unsubscribe2.jpg' }}" border="0" alt="unsubscribe" width="45" height="37" name="unsubscribe2"></td>
<td style="font-family:Arial, Helvetica, sans-serif;font-size:12px;background-color:#e4e3e3;" width="250"><br></td>
<td style="font-family:Arial, Helvetica, sans-serif;font-size:12px;line-height:0px;" width="61"><img src="{{ asset('/assets/examples') . 'twitter2.jpg' }}" border="0" alt="twitter" width="61" height="37" name="twitter2"></td>
<td style="font-family:Arial, Helvetica, sans-serif;font-size:12px;line-height:0px;" width="56"><img src="{{ asset('/assets/examples') . 'facebook2.jpg' }}" border="0" alt="facebook" width="56" height="37" name="facebook2"></td>
<td style="font-family:Arial, Helvetica, sans-serif;font-size:12px;background-color:#e4e3e3;" width="15"><br></td>
</tr>
</tbody></table>
</td>
</tr></tbody></table>
</div>
<img alt="" src="{{ asset('/assets/examples') . 'index.php' }}" border="0" height="2" width="180">




</td></tr>
</tbody></table></td></tr>
<tr>
				<td valign="top" onclick="dBug_toggleRow(this)" class="dBug_objectKey">imageLess</td>
				<td><table cellspacing="2" cellpadding="3" class="dBug_object">
				<tbody><tr>
					<td class="dBug_objectHeader" colspan="2" onclick="dBug_toggleTable(this)">object</td>
				</tr><tr>
				<td valign="top" onclick="dBug_toggleRow(this)" class="dBug_objectKey">title</td>
				<td>HTML version (without images)</td></tr>
<tr>
				<td valign="top" onclick="dBug_toggleRow(this)" class="dBug_objectKey">content</td>
				<td>[empty string]</td></tr>
</tbody></table></td></tr>
</tbody></table></td></tr>
<tr>
				<td valign="top" onclick="dBug_toggleRow(this)" class="dBug_objectKey">blacklists</td>
				<td><table cellspacing="2" cellpadding="3" class="dBug_object">
				<tbody><tr>
					<td class="dBug_objectHeader" colspan="2" onclick="dBug_toggleTable(this)">object</td>
				</tr><tr>
				<td valign="top" onclick="dBug_toggleRow(this)" class="dBug_objectKey">title</td>
				<td>You're not blacklisted</td></tr>
<tr>
				<td valign="top" onclick="dBug_toggleRow(this)" class="dBug_objectKey">mark</td>
				<td>0</td></tr>
<tr>
				<td valign="top" onclick="dBug_toggleRow(this)" class="dBug_objectKey">displayedMark</td>
				<td>✓</td></tr>
<tr>
				<td valign="top" onclick="dBug_toggleRow(this)" class="dBug_objectKey">statusClass</td>
				<td>success</td></tr>
<tr>
				<td valign="top" onclick="dBug_toggleRow(this)" class="dBug_objectKey">description</td>
				<td>Matches your server IP address (46.105.17.43) against 26 of the most common ipv4 blacklists.</td></tr>
<tr>
				<td valign="top" onclick="dBug_toggleRow(this)" class="dBug_objectKey">messages</td>
				<td><div class="bl-result"><span class="status-success">Not listed</span> in <a target="_blank" href="http://www.ahbl.org/">AHBL</a></div><div class="bl-result"><span class="status-success">Not listed</span> in <a target="_blank" href="http://www.backscatterer.org/index.php">BACKSCATTERER</a></div><div class="bl-result"><span class="status-success">Not listed</span> in <a target="_blank" href="http://barracudacentral.org/rbl">BARRACUDA</a></div><div class="bl-result"><span class="status-success">Not listed</span> in <a target="_blank" href="http://dnsbl.burnt-tech.com/">BURNT-TECH</a></div><div class="bl-result"><span class="status-success">Not listed</span> in <a target="_blank" href="http://www.anti-spam.org.cn/CID/17">CASA-CBLPLUS</a></div><div class="bl-result"><span class="status-success">Not listed</span> in <a target="_blank" href="http://antispam.imp.ch/?lng=1">IMP-SPAM</a></div><div class="bl-result"><span class="status-success">Not listed</span> in <a target="_blank" href="http://dnsbl.inps.de/index.cgi?lang=en">INPS_DE</a></div><div class="bl-result"><span class="status-success">Not listed</span> in <a target="_blank" href="http://ls.lashback.com/blacklist/">LASHBACK</a></div><div class="bl-result"><span class="status-success">Not listed</span> in <a target="_blank" href="http://mailspike.net/">MAILSPIKE-BL</a></div><div class="bl-result"><span class="status-success">Not listed</span> in <a target="_blank" href="http://www.heise.de/ix/nixspam/dnsbl_en/">NIXSPAM</a></div><div class="bl-result"><span class="status-success">Not listed</span> in <a target="_blank" href="http://psbl.surriel.com/">PSBL</a></div><div class="bl-result"><span class="status-success">Not listed</span> in <a target="_blank" href="http://www.spamrats.com/">RATS-ALL</a></div><div class="bl-result"><span class="status-neutral">Timeout</span> for <a target="_blank" href="http://www.redhawk.org/">REDHAWK</a></div><div class="bl-result"><span class="status-success">Not listed</span> in <a target="_blank" href="http://spameatingmonkey.com/index.html">SEM-BACKSCATTER</a></div><div class="bl-result"><span class="status-success">Not listed</span> in <a target="_blank" href="http://spameatingmonkey.com/index.html">SEM-BLACK</a></div><div class="bl-result"><span class="status-success">Not listed</span> in <a target="_blank" href="http://www.sorbs.net/lookup.shtml">SORBS-DUHL</a></div><div class="bl-result"><span class="status-success">Not listed</span> in <a target="_blank" href="http://www.sorbs.net/lookup.shtml">SORBS-SPAM</a></div><div class="bl-result"><span class="status-success">Not listed</span> in <a target="_blank" href="http://www.spamcannibal.org/">SPAMCANNIBAL</a></div><div class="bl-result"><span class="status-success">Not listed</span> in <a target="_blank" href="http://spamcop.net/bl.shtml">SPAMCOP</a></div><div class="bl-result"><span class="status-success">Not listed</span> in <a target="_blank" href="http://www.spamhaus.org/">SPAMHAUS-ZEN</a></div><div class="bl-result"><span class="status-success">Not listed</span> in <a target="_blank" href="http://antispam.imp.ch/?lng=1">SWINOG</a></div><div class="bl-result"><span class="status-success">Not listed</span> in <a target="_blank" href="http://www.gbudb.com/truncate/index.jsp">TRUNCATE</a></div><div class="bl-result"><span class="status-success">Not listed</span> in <a target="_blank" href="http://www.uceprotect.net/">UCEPROTECTL1</a></div><div class="bl-result"><span class="status-success">Not listed</span> in <a target="_blank" href="http://www.uceprotect.net/">UCEPROTECTL2</a></div><div class="bl-result"><span class="status-success">Not listed</span> in <a target="_blank" href="http://www.uceprotect.net/">UCEPROTECTL3</a></div><div class="bl-result"><span class="status-success">Not listed</span> in <a target="_blank" href="http://wpbl.pc9.org/">WPBL</a></div></td></tr>
<tr>
				<td valign="top" onclick="dBug_toggleRow(this)" class="dBug_objectKey">blacklists</td>
				<td><table cellspacing="2" cellpadding="3" class="dBug_array">
				<tbody><tr>
					<td class="dBug_arrayHeader" colspan="2" onclick="dBug_toggleTable(this)">array</td>
				</tr><tr>
				<td valign="top" onclick="dBug_toggleRow(this)" class="dBug_arrayKey">dnsbl.ahbl.org.</td>
				<td><table cellspacing="2" cellpadding="3" class="dBug_object">
				<tbody><tr>
					<td class="dBug_objectHeader" colspan="2" onclick="dBug_toggleTable(this)">object</td>
				</tr><tr>
				<td valign="top" onclick="dBug_toggleRow(this)" class="dBug_objectKey">name</td>
				<td>AHBL</td></tr>
<tr>
				<td valign="top" onclick="dBug_toggleRow(this)" class="dBug_objectKey">url</td>
				<td>http://www.ahbl.org/</td></tr>
<tr>
				<td valign="top" onclick="dBug_toggleRow(this)" class="dBug_objectKey">dns</td>
				<td>dnsbl.ahbl.org.</td></tr>
<tr>
				<td valign="top" onclick="dBug_toggleRow(this)" class="dBug_objectKey">statusCode</td>
				<td>0</td></tr>
</tbody></table></td></tr>
<tr>
				<td valign="top" onclick="dBug_toggleRow(this)" class="dBug_arrayKey">ips.backscatterer.org.</td>
				<td><table cellspacing="2" cellpadding="3" class="dBug_object">
				<tbody><tr>
					<td class="dBug_objectHeader" colspan="2" onclick="dBug_toggleTable(this)">object</td>
				</tr><tr>
				<td valign="top" onclick="dBug_toggleRow(this)" class="dBug_objectKey">name</td>
				<td>BACKSCATTERER</td></tr>
<tr>
				<td valign="top" onclick="dBug_toggleRow(this)" class="dBug_objectKey">url</td>
				<td>http://www.backscatterer.org/index.php</td></tr>
<tr>
				<td valign="top" onclick="dBug_toggleRow(this)" class="dBug_objectKey">dns</td>
				<td>ips.backscatterer.org.</td></tr>
<tr>
				<td valign="top" onclick="dBug_toggleRow(this)" class="dBug_objectKey">statusCode</td>
				<td>0</td></tr>
</tbody></table></td></tr>
<tr>
				<td valign="top" onclick="dBug_toggleRow(this)" class="dBug_arrayKey">b.barracudacentral.org.</td>
				<td><table cellspacing="2" cellpadding="3" class="dBug_object">
				<tbody><tr>
					<td class="dBug_objectHeader" colspan="2" onclick="dBug_toggleTable(this)">object</td>
				</tr><tr>
				<td valign="top" onclick="dBug_toggleRow(this)" class="dBug_objectKey">name</td>
				<td>BARRACUDA</td></tr>
<tr>
				<td valign="top" onclick="dBug_toggleRow(this)" class="dBug_objectKey">url</td>
				<td>http://barracudacentral.org/rbl</td></tr>
<tr>
				<td valign="top" onclick="dBug_toggleRow(this)" class="dBug_objectKey">dns</td>
				<td>b.barracudacentral.org.</td></tr>
<tr>
				<td valign="top" onclick="dBug_toggleRow(this)" class="dBug_objectKey">statusCode</td>
				<td>0</td></tr>
</tbody></table></td></tr>
<tr>
				<td valign="top" onclick="dBug_toggleRow(this)" class="dBug_arrayKey">dnsbl.burnt-tech.com.</td>
				<td><table cellspacing="2" cellpadding="3" class="dBug_object">
				<tbody><tr>
					<td class="dBug_objectHeader" colspan="2" onclick="dBug_toggleTable(this)">object</td>
				</tr><tr>
				<td valign="top" onclick="dBug_toggleRow(this)" class="dBug_objectKey">name</td>
				<td>BURNT-TECH</td></tr>
<tr>
				<td valign="top" onclick="dBug_toggleRow(this)" class="dBug_objectKey">url</td>
				<td>http://dnsbl.burnt-tech.com/</td></tr>
<tr>
				<td valign="top" onclick="dBug_toggleRow(this)" class="dBug_objectKey">dns</td>
				<td>dnsbl.burnt-tech.com.</td></tr>
<tr>
				<td valign="top" onclick="dBug_toggleRow(this)" class="dBug_objectKey">statusCode</td>
				<td>0</td></tr>
</tbody></table></td></tr>
<tr>
				<td valign="top" onclick="dBug_toggleRow(this)" class="dBug_arrayKey">cblplus.anti-spam.org.cn.</td>
				<td><table cellspacing="2" cellpadding="3" class="dBug_object">
				<tbody><tr>
					<td class="dBug_objectHeader" colspan="2" onclick="dBug_toggleTable(this)">object</td>
				</tr><tr>
				<td valign="top" onclick="dBug_toggleRow(this)" class="dBug_objectKey">name</td>
				<td>CASA-CBLPLUS</td></tr>
<tr>
				<td valign="top" onclick="dBug_toggleRow(this)" class="dBug_objectKey">url</td>
				<td>http://www.anti-spam.org.cn/CID/17</td></tr>
<tr>
				<td valign="top" onclick="dBug_toggleRow(this)" class="dBug_objectKey">dns</td>
				<td>cblplus.anti-spam.org.cn.</td></tr>
<tr>
				<td valign="top" onclick="dBug_toggleRow(this)" class="dBug_objectKey">statusCode</td>
				<td>0</td></tr>
</tbody></table></td></tr>
<tr>
				<td valign="top" onclick="dBug_toggleRow(this)" class="dBug_arrayKey">spamrbl.imp.ch.</td>
				<td><table cellspacing="2" cellpadding="3" class="dBug_object">
				<tbody><tr>
					<td class="dBug_objectHeader" colspan="2" onclick="dBug_toggleTable(this)">object</td>
				</tr><tr>
				<td valign="top" onclick="dBug_toggleRow(this)" class="dBug_objectKey">name</td>
				<td>IMP-SPAM</td></tr>
<tr>
				<td valign="top" onclick="dBug_toggleRow(this)" class="dBug_objectKey">url</td>
				<td>http://antispam.imp.ch/?lng=1</td></tr>
<tr>
				<td valign="top" onclick="dBug_toggleRow(this)" class="dBug_objectKey">dns</td>
				<td>spamrbl.imp.ch.</td></tr>
<tr>
				<td valign="top" onclick="dBug_toggleRow(this)" class="dBug_objectKey">statusCode</td>
				<td>0</td></tr>
</tbody></table></td></tr>
<tr>
				<td valign="top" onclick="dBug_toggleRow(this)" class="dBug_arrayKey">dnsbl.inps.de.</td>
				<td><table cellspacing="2" cellpadding="3" class="dBug_object">
				<tbody><tr>
					<td class="dBug_objectHeader" colspan="2" onclick="dBug_toggleTable(this)">object</td>
				</tr><tr>
				<td valign="top" onclick="dBug_toggleRow(this)" class="dBug_objectKey">name</td>
				<td>INPS_DE</td></tr>
<tr>
				<td valign="top" onclick="dBug_toggleRow(this)" class="dBug_objectKey">url</td>
				<td>http://dnsbl.inps.de/index.cgi?lang=en</td></tr>
<tr>
				<td valign="top" onclick="dBug_toggleRow(this)" class="dBug_objectKey">dns</td>
				<td>dnsbl.inps.de.</td></tr>
<tr>
				<td valign="top" onclick="dBug_toggleRow(this)" class="dBug_objectKey">statusCode</td>
				<td>0</td></tr>
</tbody></table></td></tr>
<tr>
				<td valign="top" onclick="dBug_toggleRow(this)" class="dBug_arrayKey">ubl.unsubscore.com.</td>
				<td><table cellspacing="2" cellpadding="3" class="dBug_object">
				<tbody><tr>
					<td class="dBug_objectHeader" colspan="2" onclick="dBug_toggleTable(this)">object</td>
				</tr><tr>
				<td valign="top" onclick="dBug_toggleRow(this)" class="dBug_objectKey">name</td>
				<td>LASHBACK</td></tr>
<tr>
				<td valign="top" onclick="dBug_toggleRow(this)" class="dBug_objectKey">url</td>
				<td>http://ls.lashback.com/blacklist/</td></tr>
<tr>
				<td valign="top" onclick="dBug_toggleRow(this)" class="dBug_objectKey">dns</td>
				<td>ubl.unsubscore.com.</td></tr>
<tr>
				<td valign="top" onclick="dBug_toggleRow(this)" class="dBug_objectKey">statusCode</td>
				<td>0</td></tr>
</tbody></table></td></tr>
<tr>
				<td valign="top" onclick="dBug_toggleRow(this)" class="dBug_arrayKey">bl.mailspike.net.</td>
				<td><table cellspacing="2" cellpadding="3" class="dBug_object">
				<tbody><tr>
					<td class="dBug_objectHeader" colspan="2" onclick="dBug_toggleTable(this)">object</td>
				</tr><tr>
				<td valign="top" onclick="dBug_toggleRow(this)" class="dBug_objectKey">name</td>
				<td>MAILSPIKE-BL</td></tr>
<tr>
				<td valign="top" onclick="dBug_toggleRow(this)" class="dBug_objectKey">url</td>
				<td>http://mailspike.net</td></tr>
<tr>
				<td valign="top" onclick="dBug_toggleRow(this)" class="dBug_objectKey">dns</td>
				<td>bl.mailspike.net.</td></tr>
<tr>
				<td valign="top" onclick="dBug_toggleRow(this)" class="dBug_objectKey">statusCode</td>
				<td>0</td></tr>
</tbody></table></td></tr>
<tr>
				<td valign="top" onclick="dBug_toggleRow(this)" class="dBug_arrayKey">ix.dnsbl.manitu.net.</td>
				<td><table cellspacing="2" cellpadding="3" class="dBug_object">
				<tbody><tr>
					<td class="dBug_objectHeader" colspan="2" onclick="dBug_toggleTable(this)">object</td>
				</tr><tr>
				<td valign="top" onclick="dBug_toggleRow(this)" class="dBug_objectKey">name</td>
				<td>NIXSPAM</td></tr>
<tr>
				<td valign="top" onclick="dBug_toggleRow(this)" class="dBug_objectKey">url</td>
				<td>http://www.heise.de/ix/nixspam/dnsbl_en/</td></tr>
<tr>
				<td valign="top" onclick="dBug_toggleRow(this)" class="dBug_objectKey">dns</td>
				<td>ix.dnsbl.manitu.net.</td></tr>
<tr>
				<td valign="top" onclick="dBug_toggleRow(this)" class="dBug_objectKey">statusCode</td>
				<td>0</td></tr>
</tbody></table></td></tr>
<tr>
				<td valign="top" onclick="dBug_toggleRow(this)" class="dBug_arrayKey">psbl.surriel.com.</td>
				<td><table cellspacing="2" cellpadding="3" class="dBug_object">
				<tbody><tr>
					<td class="dBug_objectHeader" colspan="2" onclick="dBug_toggleTable(this)">object</td>
				</tr><tr>
				<td valign="top" onclick="dBug_toggleRow(this)" class="dBug_objectKey">name</td>
				<td>PSBL</td></tr>
<tr>
				<td valign="top" onclick="dBug_toggleRow(this)" class="dBug_objectKey">url</td>
				<td>http://psbl.surriel.com/</td></tr>
<tr>
				<td valign="top" onclick="dBug_toggleRow(this)" class="dBug_objectKey">dns</td>
				<td>psbl.surriel.com.</td></tr>
<tr>
				<td valign="top" onclick="dBug_toggleRow(this)" class="dBug_objectKey">statusCode</td>
				<td>0</td></tr>
</tbody></table></td></tr>
<tr>
				<td valign="top" onclick="dBug_toggleRow(this)" class="dBug_arrayKey">all.spamrats.com.</td>
				<td><table cellspacing="2" cellpadding="3" class="dBug_object">
				<tbody><tr>
					<td class="dBug_objectHeader" colspan="2" onclick="dBug_toggleTable(this)">object</td>
				</tr><tr>
				<td valign="top" onclick="dBug_toggleRow(this)" class="dBug_objectKey">name</td>
				<td>RATS-ALL</td></tr>
<tr>
				<td valign="top" onclick="dBug_toggleRow(this)" class="dBug_objectKey">url</td>
				<td>http://www.spamrats.com</td></tr>
<tr>
				<td valign="top" onclick="dBug_toggleRow(this)" class="dBug_objectKey">dns</td>
				<td>all.spamrats.com.</td></tr>
<tr>
				<td valign="top" onclick="dBug_toggleRow(this)" class="dBug_objectKey">statusCode</td>
				<td>0</td></tr>
</tbody></table></td></tr>
<tr>
				<td valign="top" onclick="dBug_toggleRow(this)" class="dBug_arrayKey">access.redhawk.org.</td>
				<td><table cellspacing="2" cellpadding="3" class="dBug_object">
				<tbody><tr>
					<td class="dBug_objectHeader" colspan="2" onclick="dBug_toggleTable(this)">object</td>
				</tr><tr>
				<td valign="top" onclick="dBug_toggleRow(this)" class="dBug_objectKey">name</td>
				<td>REDHAWK</td></tr>
<tr>
				<td valign="top" onclick="dBug_toggleRow(this)" class="dBug_objectKey">url</td>
				<td>http://www.redhawk.org</td></tr>
<tr>
				<td valign="top" onclick="dBug_toggleRow(this)" class="dBug_objectKey">dns</td>
				<td>access.redhawk.org.</td></tr>
<tr>
				<td valign="top" onclick="dBug_toggleRow(this)" class="dBug_objectKey">statusCode</td>
				<td>-1</td></tr>
</tbody></table></td></tr>
<tr>
				<td valign="top" onclick="dBug_toggleRow(this)" class="dBug_arrayKey">backscatter.spameatingmonkey.net.</td>
				<td><table cellspacing="2" cellpadding="3" class="dBug_object">
				<tbody><tr>
					<td class="dBug_objectHeader" colspan="2" onclick="dBug_toggleTable(this)">object</td>
				</tr><tr>
				<td valign="top" onclick="dBug_toggleRow(this)" class="dBug_objectKey">name</td>
				<td>SEM-BACKSCATTER</td></tr>
<tr>
				<td valign="top" onclick="dBug_toggleRow(this)" class="dBug_objectKey">url</td>
				<td>http://spameatingmonkey.com/index.html</td></tr>
<tr>
				<td valign="top" onclick="dBug_toggleRow(this)" class="dBug_objectKey">dns</td>
				<td>backscatter.spameatingmonkey.net.</td></tr>
<tr>
				<td valign="top" onclick="dBug_toggleRow(this)" class="dBug_objectKey">statusCode</td>
				<td>0</td></tr>
</tbody></table></td></tr>
<tr>
				<td valign="top" onclick="dBug_toggleRow(this)" class="dBug_arrayKey">bl.spameatingmonkey.net.</td>
				<td><table cellspacing="2" cellpadding="3" class="dBug_object">
				<tbody><tr>
					<td class="dBug_objectHeader" colspan="2" onclick="dBug_toggleTable(this)">object</td>
				</tr><tr>
				<td valign="top" onclick="dBug_toggleRow(this)" class="dBug_objectKey">name</td>
				<td>SEM-BLACK</td></tr>
<tr>
				<td valign="top" onclick="dBug_toggleRow(this)" class="dBug_objectKey">url</td>
				<td>http://spameatingmonkey.com/index.html</td></tr>
<tr>
				<td valign="top" onclick="dBug_toggleRow(this)" class="dBug_objectKey">dns</td>
				<td>bl.spameatingmonkey.net.</td></tr>
<tr>
				<td valign="top" onclick="dBug_toggleRow(this)" class="dBug_objectKey">statusCode</td>
				<td>0</td></tr>
</tbody></table></td></tr>
<tr>
				<td valign="top" onclick="dBug_toggleRow(this)" class="dBug_arrayKey">dnsbl.sorbs.net.</td>
				<td><table cellspacing="2" cellpadding="3" class="dBug_object">
				<tbody><tr>
					<td class="dBug_objectHeader" colspan="2" onclick="dBug_toggleTable(this)">object</td>
				</tr><tr>
				<td valign="top" onclick="dBug_toggleRow(this)" class="dBug_objectKey">name</td>
				<td>SORBS-DUHL</td></tr>
<tr>
				<td valign="top" onclick="dBug_toggleRow(this)" class="dBug_objectKey">url</td>
				<td>http://www.sorbs.net/lookup.shtml</td></tr>
<tr>
				<td valign="top" onclick="dBug_toggleRow(this)" class="dBug_objectKey">dns</td>
				<td>dnsbl.sorbs.net.</td></tr>
<tr>
				<td valign="top" onclick="dBug_toggleRow(this)" class="dBug_objectKey">statusCode</td>
				<td>0</td></tr>
</tbody></table></td></tr>
<tr>
				<td valign="top" onclick="dBug_toggleRow(this)" class="dBug_arrayKey">spam.dnsbl.sorbs.net.</td>
				<td><table cellspacing="2" cellpadding="3" class="dBug_object">
				<tbody><tr>
					<td class="dBug_objectHeader" colspan="2" onclick="dBug_toggleTable(this)">object</td>
				</tr><tr>
				<td valign="top" onclick="dBug_toggleRow(this)" class="dBug_objectKey">name</td>
				<td>SORBS-SPAM</td></tr>
<tr>
				<td valign="top" onclick="dBug_toggleRow(this)" class="dBug_objectKey">url</td>
				<td>http://www.sorbs.net/lookup.shtml</td></tr>
<tr>
				<td valign="top" onclick="dBug_toggleRow(this)" class="dBug_objectKey">dns</td>
				<td>spam.dnsbl.sorbs.net.</td></tr>
<tr>
				<td valign="top" onclick="dBug_toggleRow(this)" class="dBug_objectKey">statusCode</td>
				<td>0</td></tr>
</tbody></table></td></tr>
<tr>
				<td valign="top" onclick="dBug_toggleRow(this)" class="dBug_arrayKey">bl.spamcannibal.org.</td>
				<td><table cellspacing="2" cellpadding="3" class="dBug_object">
				<tbody><tr>
					<td class="dBug_objectHeader" colspan="2" onclick="dBug_toggleTable(this)">object</td>
				</tr><tr>
				<td valign="top" onclick="dBug_toggleRow(this)" class="dBug_objectKey">name</td>
				<td>SPAMCANNIBAL</td></tr>
<tr>
				<td valign="top" onclick="dBug_toggleRow(this)" class="dBug_objectKey">url</td>
				<td>http://www.spamcannibal.org/</td></tr>
<tr>
				<td valign="top" onclick="dBug_toggleRow(this)" class="dBug_objectKey">dns</td>
				<td>bl.spamcannibal.org.</td></tr>
<tr>
				<td valign="top" onclick="dBug_toggleRow(this)" class="dBug_objectKey">statusCode</td>
				<td>0</td></tr>
</tbody></table></td></tr>
<tr>
				<td valign="top" onclick="dBug_toggleRow(this)" class="dBug_arrayKey">bl.spamcop.net.</td>
				<td><table cellspacing="2" cellpadding="3" class="dBug_object">
				<tbody><tr>
					<td class="dBug_objectHeader" colspan="2" onclick="dBug_toggleTable(this)">object</td>
				</tr><tr>
				<td valign="top" onclick="dBug_toggleRow(this)" class="dBug_objectKey">name</td>
				<td>SPAMCOP</td></tr>
<tr>
				<td valign="top" onclick="dBug_toggleRow(this)" class="dBug_objectKey">url</td>
				<td>http://spamcop.net/bl.shtml</td></tr>
<tr>
				<td valign="top" onclick="dBug_toggleRow(this)" class="dBug_objectKey">dns</td>
				<td>bl.spamcop.net.</td></tr>
<tr>
				<td valign="top" onclick="dBug_toggleRow(this)" class="dBug_objectKey">statusCode</td>
				<td>0</td></tr>
</tbody></table></td></tr>
<tr>
				<td valign="top" onclick="dBug_toggleRow(this)" class="dBug_arrayKey">zen.spamhaus.org.</td>
				<td><table cellspacing="2" cellpadding="3" class="dBug_object">
				<tbody><tr>
					<td class="dBug_objectHeader" colspan="2" onclick="dBug_toggleTable(this)">object</td>
				</tr><tr>
				<td valign="top" onclick="dBug_toggleRow(this)" class="dBug_objectKey">name</td>
				<td>SPAMHAUS-ZEN</td></tr>
<tr>
				<td valign="top" onclick="dBug_toggleRow(this)" class="dBug_objectKey">url</td>
				<td>http://www.spamhaus.org</td></tr>
<tr>
				<td valign="top" onclick="dBug_toggleRow(this)" class="dBug_objectKey">dns</td>
				<td>zen.spamhaus.org.</td></tr>
<tr>
				<td valign="top" onclick="dBug_toggleRow(this)" class="dBug_objectKey">statusCode</td>
				<td>0</td></tr>
</tbody></table></td></tr>
<tr>
				<td valign="top" onclick="dBug_toggleRow(this)" class="dBug_arrayKey">dnsrbl.swinog.ch.</td>
				<td><table cellspacing="2" cellpadding="3" class="dBug_object">
				<tbody><tr>
					<td class="dBug_objectHeader" colspan="2" onclick="dBug_toggleTable(this)">object</td>
				</tr><tr>
				<td valign="top" onclick="dBug_toggleRow(this)" class="dBug_objectKey">name</td>
				<td>SWINOG</td></tr>
<tr>
				<td valign="top" onclick="dBug_toggleRow(this)" class="dBug_objectKey">url</td>
				<td>http://antispam.imp.ch/?lng=1</td></tr>
<tr>
				<td valign="top" onclick="dBug_toggleRow(this)" class="dBug_objectKey">dns</td>
				<td>dnsrbl.swinog.ch.</td></tr>
<tr>
				<td valign="top" onclick="dBug_toggleRow(this)" class="dBug_objectKey">statusCode</td>
				<td>0</td></tr>
</tbody></table></td></tr>
<tr>
				<td valign="top" onclick="dBug_toggleRow(this)" class="dBug_arrayKey">truncate.gbudb.net.</td>
				<td><table cellspacing="2" cellpadding="3" class="dBug_object">
				<tbody><tr>
					<td class="dBug_objectHeader" colspan="2" onclick="dBug_toggleTable(this)">object</td>
				</tr><tr>
				<td valign="top" onclick="dBug_toggleRow(this)" class="dBug_objectKey">name</td>
				<td>TRUNCATE</td></tr>
<tr>
				<td valign="top" onclick="dBug_toggleRow(this)" class="dBug_objectKey">url</td>
				<td>http://www.gbudb.com/truncate/index.jsp</td></tr>
<tr>
				<td valign="top" onclick="dBug_toggleRow(this)" class="dBug_objectKey">dns</td>
				<td>truncate.gbudb.net.</td></tr>
<tr>
				<td valign="top" onclick="dBug_toggleRow(this)" class="dBug_objectKey">statusCode</td>
				<td>0</td></tr>
</tbody></table></td></tr>
<tr>
				<td valign="top" onclick="dBug_toggleRow(this)" class="dBug_arrayKey">dnsbl-1.uceprotect.net.</td>
				<td><table cellspacing="2" cellpadding="3" class="dBug_object">
				<tbody><tr>
					<td class="dBug_objectHeader" colspan="2" onclick="dBug_toggleTable(this)">object</td>
				</tr><tr>
				<td valign="top" onclick="dBug_toggleRow(this)" class="dBug_objectKey">name</td>
				<td>UCEPROTECTL1</td></tr>
<tr>
				<td valign="top" onclick="dBug_toggleRow(this)" class="dBug_objectKey">url</td>
				<td>http://www.uceprotect.net/</td></tr>
<tr>
				<td valign="top" onclick="dBug_toggleRow(this)" class="dBug_objectKey">dns</td>
				<td>dnsbl-1.uceprotect.net.</td></tr>
<tr>
				<td valign="top" onclick="dBug_toggleRow(this)" class="dBug_objectKey">statusCode</td>
				<td>0</td></tr>
</tbody></table></td></tr>
<tr>
				<td valign="top" onclick="dBug_toggleRow(this)" class="dBug_arrayKey">dnsbl-2.uceprotect.net.</td>
				<td><table cellspacing="2" cellpadding="3" class="dBug_object">
				<tbody><tr>
					<td class="dBug_objectHeader" colspan="2" onclick="dBug_toggleTable(this)">object</td>
				</tr><tr>
				<td valign="top" onclick="dBug_toggleRow(this)" class="dBug_objectKey">name</td>
				<td>UCEPROTECTL2</td></tr>
<tr>
				<td valign="top" onclick="dBug_toggleRow(this)" class="dBug_objectKey">url</td>
				<td>http://www.uceprotect.net/</td></tr>
<tr>
				<td valign="top" onclick="dBug_toggleRow(this)" class="dBug_objectKey">dns</td>
				<td>dnsbl-2.uceprotect.net.</td></tr>
<tr>
				<td valign="top" onclick="dBug_toggleRow(this)" class="dBug_objectKey">statusCode</td>
				<td>0</td></tr>
</tbody></table></td></tr>
<tr>
				<td valign="top" onclick="dBug_toggleRow(this)" class="dBug_arrayKey">dnsbl-3.uceprotect.net.</td>
				<td><table cellspacing="2" cellpadding="3" class="dBug_object">
				<tbody><tr>
					<td class="dBug_objectHeader" colspan="2" onclick="dBug_toggleTable(this)">object</td>
				</tr><tr>
				<td valign="top" onclick="dBug_toggleRow(this)" class="dBug_objectKey">name</td>
				<td>UCEPROTECTL3</td></tr>
<tr>
				<td valign="top" onclick="dBug_toggleRow(this)" class="dBug_objectKey">url</td>
				<td>http://www.uceprotect.net/</td></tr>
<tr>
				<td valign="top" onclick="dBug_toggleRow(this)" class="dBug_objectKey">dns</td>
				<td>dnsbl-3.uceprotect.net.</td></tr>
<tr>
				<td valign="top" onclick="dBug_toggleRow(this)" class="dBug_objectKey">statusCode</td>
				<td>0</td></tr>
</tbody></table></td></tr>
<tr>
				<td valign="top" onclick="dBug_toggleRow(this)" class="dBug_arrayKey">db.wpbl.info.</td>
				<td><table cellspacing="2" cellpadding="3" class="dBug_object">
				<tbody><tr>
					<td class="dBug_objectHeader" colspan="2" onclick="dBug_toggleTable(this)">object</td>
				</tr><tr>
				<td valign="top" onclick="dBug_toggleRow(this)" class="dBug_objectKey">name</td>
				<td>WPBL</td></tr>
<tr>
				<td valign="top" onclick="dBug_toggleRow(this)" class="dBug_objectKey">url</td>
				<td>http://wpbl.pc9.org/</td></tr>
<tr>
				<td valign="top" onclick="dBug_toggleRow(this)" class="dBug_objectKey">dns</td>
				<td>db.wpbl.info.</td></tr>
<tr>
				<td valign="top" onclick="dBug_toggleRow(this)" class="dBug_objectKey">statusCode</td>
				<td>0</td></tr>
</tbody></table></td></tr>
</tbody></table></td></tr>
<tr>
				<td valign="top" onclick="dBug_toggleRow(this)" class="dBug_objectKey">hits</td>
				<td>0</td></tr>
<tr>
				<td valign="top" onclick="dBug_toggleRow(this)" class="dBug_objectKey">timeout</td>
				<td>1</td></tr>
</tbody></table></td></tr>
<tr>
				<td valign="top" onclick="dBug_toggleRow(this)" class="dBug_objectKey">links</td>
				<td><table cellspacing="2" cellpadding="3" class="dBug_object">
				<tbody><tr>
					<td class="dBug_objectHeader" colspan="2" onclick="dBug_toggleTable(this)">object</td>
				</tr><tr>
				<td valign="top" onclick="dBug_toggleRow(this)" class="dBug_objectKey">statusClass</td>
				<td>neutral</td></tr>
<tr>
				<td valign="top" onclick="dBug_toggleRow(this)" class="dBug_objectKey">mark</td>
				<td>0</td></tr>
<tr>
				<td valign="top" onclick="dBug_toggleRow(this)" class="dBug_objectKey">title</td>
				<td>Error checking links</td></tr>
<tr>
				<td valign="top" onclick="dBug_toggleRow(this)" class="dBug_objectKey">description</td>
				<td>Checks if your newsletter contains broken links.</td></tr>
<tr>
				<td valign="top" onclick="dBug_toggleRow(this)" class="dBug_objectKey">messages</td>
				<td>[empty string]</td></tr>
<tr>
				<td valign="top" onclick="dBug_toggleRow(this)" class="dBug_objectKey">urls</td>
				<td><table cellspacing="2" cellpadding="3" class="dBug_array">
				<tbody><tr>
					<td class="dBug_arrayHeader" colspan="2" onclick="dBug_toggleTable(this)">array</td>
				</tr></tbody></table></td></tr>
<tr>
				<td valign="top" onclick="dBug_toggleRow(this)" class="dBug_objectKey">brokenLinks</td>
				<td>0</td></tr>
<tr>
				<td valign="top" onclick="dBug_toggleRow(this)" class="dBug_objectKey">notFound</td>
				<td>0</td></tr>
<tr>
				<td valign="top" onclick="dBug_toggleRow(this)" class="dBug_objectKey">timeouts</td>
				<td>0</td></tr>
<tr>
				<td valign="top" onclick="dBug_toggleRow(this)" class="dBug_objectKey">imagesWeight</td>
				<td>0</td></tr>
<tr>
				<td valign="top" onclick="dBug_toggleRow(this)" class="dBug_objectKey">displayedMark</td>
				<td>✓</td></tr>
</tbody></table></td></tr>
</tbody></table>

</body></html>