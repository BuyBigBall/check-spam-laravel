$(function() {
	jQuery('.copy').on('click',function(){
		const copyText = document.getElementById(jQuery(this).data('target'));

		/* Select the text field */
		copyText.select();
		copyText.setSelectionRange(0, 99999); /*For mobile devices*/

		/* Copy the text inside the text field */
		document.execCommand("copy");
	});

	jQuery("#lang_select").on('click',function() {
		if (jQuery("#dropdown_content_lang").css("display") == "none") {
			jQuery("#dropdown_content_lang").fadeIn("slow");
			jQuery("#lang_select").addClass("active");
		} else {
			jQuery("#dropdown_content_lang").fadeOut("slow");
			jQuery("#lang_select").removeClass("active");
		}
	});

	jQuery(document).on('click',function(e) {
		const subject = jQuery("#lang_select");
		if(e.target.id != subject.attr("id") && !subject.has(e.target).length) {
			$("#dropdown_content_lang").fadeOut("slow");
			$("#lang_select").removeClass("active");
		}
	});

	let emailField = jQuery('#home #email');

	if(emailField.length){
		const r = /bot|googlebot|crawler|spider|robot|crawling/i;
		if(!r.test(navigator.userAgent)){
			emailField.val(emailField.data('prefix')+'-'+(Math.random().toString(36).substring(2,11))+String.fromCharCode(64)+emailField.data('domain'));
			jQuery("#submitbutton").on('click',function(){
				if(jQuery("#email").val().indexOf(String.fromCharCode(64)+emailField.data('domain')) == -1){
					alert("Please send your message to a xxx"+String.fromCharCode(64)+emailField.data('domain')+' address');
					return false;
				}else{
					return true;
				}
			});

		}
	}

	jQuery("#searchHost").on("keyup", function(){
		let textToSearch = jQuery(this).val().toUpperCase();
		jQuery("#hosts div").each(function(){
			if(textToSearch.length == 0 || jQuery(this).text().toUpperCase().indexOf(textToSearch) != -1){
				jQuery(this).css("display","");
			}else{
				jQuery(this).css("display","none");
			}
		});
	});



	// start for socket =============================================>
	
	// var conn = new WebSocket(WEBSOCKET_PROTOCAL+WEBSOCKET_SERVER+":"+WEBSOCKET_PORT);
	// var connected = false;
	// var received_state = 0;
	// var received_message = null;
    // var message_state = function(string, cname) {
    //     console.log(WEBSOCKET_PROTOCAL+WEBSOCKET_SERVER+":"+WEBSOCKET_PORT+" Status:",string);
    // }
    // // let us know we are live
    // conn.onopen = function(e) {
	// 	connected = true;
    //     message_state("Connection established!", 'success');
	// 	received_state = 1; //pending
		

	// 	var data = {email: $('.mailbox').html(), time: elapsedTime};
	// 	conn.send(JSON.stringify(data));
    // };

    // conn.onclose = function(e) {
    //     message_state("Connection closed!", 'error');
    //     connected = false;
    // };
    // // when a new message is created
    // conn.onmessage = function(e) {
    //     received_state = 2; //success

    //     received_message = JSON.parse(e.data);
    //     console.log(WEBSOCKET_PROTOCAL+WEBSOCKET_SERVER+":"+WEBSOCKET_PORT+" got message:", received_message);
	// 	if(isMine(received_message))
	// 	{
	// 		// ?? received_message ??							
	// 		// if(waitingTimeout!=null)clearInterval(waitingTimeout);
	// 		// conn.close();
	// 		// window.location.href = result_url + '?message_id=' + received_message.message_id;
	// 	}		
    // };
    // end for socket <==============================================

	var waitingTimeout = null;
	var progress = jQuery('#waiting-page .progress-bar');
	if(progress.length){
		var elapsedTime = 0,
			refreshRate = 1,
			reloadTime = WAIT_TIMEOUT_SECONDS-0,
			countdown = jQuery('.countdown');

		// Show the remaining time before reloading the page
		function showRemainingTime() {
			countdown.html( Math.max(reloadTime-elapsedTime,0));
			progress.css('width',Math.min((elapsedTime/reloadTime*100),100)+'%');

			if(elapsedTime > (reloadTime+(refreshRate*5))){
				//MMMmmm safe guard to force to refresh the page... but only once!
				//conn.close();
				window.location.reload();
				return;
			}
			else if(elapsedTime == reloadTime - 1 ){
				$.ajax({
					url: wait_url,
					dataType: "text",
					cache: false,
					contentType: false,
					processData: false,
					type: "get",
					success: function (data) {
						
					  var d = JSON.parse(data);
					  if(d.result=='ok')
					  {
						if(waitingTimeout!=null)clearInterval(waitingTimeout);
						window.location.href = result_url + '?message_id='+d.message_id;
			
					  }
					},
				  });
			}
			else
			{
				/*
				$.ajax({
					url: wait_url,
					dataType: "text",
					cache: false,
					contentType: false,
					processData: false,
					type: "get",
					success: function (data) {
						
					  var d = JSON.parse(data);
					  if(d.result=='ok')
					  {
						if(waitingTimeout!=null)clearInterval(waitingTimeout);
						window.location.href = result_url + '?message_id='+d.message_id;

					  }
					},
				  });
				// */
			}
			elapsedTime += refreshRate;
			waitingTimeout = setTimeout( showRemainingTime, refreshRate*1000 );
		}

		showRemainingTime();
		
	}

	function isMine(received_message){
		return true;
	}
	// ################## ---> to main.js
	// jQuery(".menu-responsive .btn").on('click', function() {
	// 	jQuery('.menu-responsive .btn',jQuery(this).closest('.result')).removeClass('active');
	// 	jQuery(this).addClass('active');
	// 	jQuery('iframe',jQuery(this).closest('.result')).css("width",jQuery(this).data('size'));
	// });

	// // Toggles a result details when clicking on div.header
	// jQuery( '.test-result .header' ).on('click',function() {
	// 	jQuery(this).closest('.test-result').toggleClass('open');
	// });


	// jQuery('.geniframe').each(function(){

	// 	let content = jQuery(this).data('raw');
	// 	if(!content) content = jQuery(jQuery(this).data('source')).data('raw');

	// 	if(jQuery(this).data('stripimages')){
	// 		const regex = /<img([^>]*)\ssrc=("(?!data:)[^"]+"|'(?!data:)[^']+')/gi;
	// 		content = content.replace( regex, '<img$1 src=""' );
	// 	}


	// 	const blob = new Blob([content], {'type':'text/html'});

	// 	const iframe = document.createElement('iframe');
	// 	iframe.src = URL.createObjectURL(blob);
	// 	iframe.style.width = '99%';
	// 	iframe.style.height = '600px';
	// 	iframe.style.border = '1px solid #ccc';

	// 	//Replace the current element by the iframe
	// 	jQuery(this).before(iframe);
	// });
	//<--- ####################
	
});