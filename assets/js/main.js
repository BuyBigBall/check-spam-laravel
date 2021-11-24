$(window).on("load", function () {
  $(".preloader").fadeOut("slow");
});

$(document).ready(function () {

  "use strict";

  /*--------------- Features Carousel ------------------ */
  $(".features-carousel").owlCarousel({
    loop: true,
    margin: 0,
    autoplay: true,
    responsiveClass: true,
    responsive: {
      0: {
        items: 1,
      },
      600: {
        items: 2,
      },
      1000: {
        items: 3,
      },
    },
  });

  /*--------------- Copy Email One Click ------------------ */

  let clipboard = new ClipboardJS(".custom-email-botton");

  $('[data-toggle="tooltip"]').tooltip();

    clipboard.on('success', function(e) {
      $(".custom-email-botton").attr('title', copied)
      .tooltip('dispose')
      .tooltip('show');
      $(e.trigger).html('<i class="fas fa-check"></i>');
      e.clearSelection();
      setTimeout(function() {
        $(".custom-email-botton").attr('title', click_to_copy)
        .tooltip('dispose')
        .tooltip('show');
        $(e.trigger).html('<i class="fas fa-copy"></i>');
      }, 1000);
    });


  $(".lang_dropdown").niceScroll({
    cursorcolor: color,
    zindex: 10000000000000,
    cursorborder:0,
    scrollspeed: 20,
    mousescrollstep: 20,
    railpadding: { top: 5, right: 0, left: 0, bottom: 1 },
});


  /*--------------- Fetch All Messages ------------------ */


  try {
    function ajax_email() {
      var email = $("#trsh_mail");
      var btn_copy = $(".custom-email-botton");

      if (email.val().length == 0) {
        btn_copy.attr("disabled", "disabled");
        email.val("landing");
        var myLand = setInterval(function () {
          var val = "";
          switch (email.val()) {
            case "landing":
              val = "landing.";
              break;

            case "landing.":
              val = "landing..";
              break;

            case "landing..":
              val = "landing...";
              break;
            case "landing...":
              val = "landing";
              break;
          }
          email.val(val);
        }, 300);
      }

      $.ajax({
        url: email_url,
        dataType: "text",
        cache: false,
        contentType: false,
        processData: false,
        type: "get",
        success: function (data) {

          clearInterval(myLand);
          btn_copy.removeAttr("disabled");

          Progress.configure({ color: [color] });
          Progress.configure({ speed: 0.8 });
          Progress.complete();
          var d = JSON.parse(data);
          $('#trsh_mail').val(d.email);
		  if(d.email=='')
		  {
			  alert("server error!");
		  }
		  else
		  {
	          messages();
		  }

        },
      });
    }

    function messages() {
      var email = $("#trsh_mail");
      var btn_copy = $(".custom-email-botton");

      // if (email.val().length == 0) {
      //   btn_copy.attr("disabled", "disabled");
      //   email.val("landing");
      //   var myLand = setInterval(function () {
      //     var val = "";
      //     switch (email.val()) {
      //       case "landing":
      //         val = "landing.";
      //         break;

      //       case "landing.":
      //         val = "landing..";
      //         break;

      //       case "landing..":
      //         val = "landing...";
      //         break;
      //       case "landing...":
      //         val = "landing";
      //         break;
      //     }
      //     email.val(val);
      //   }, 300);
      // }

      $.ajax({
        url: url,
        dataType: "text",
        cache: false,
        contentType: false,
        processData: false,
        type: "get",
        success: function (data) {

          //clearInterval(myLand);
          btn_copy.removeAttr("disabled");

          Progress.configure({ color: [color] });
          Progress.configure({ speed: 0.8 });
          Progress.complete();


          var d = JSON.parse(data);

          email.val(d.mailbox);

          if (d.messages.length == 0) {
            $(".mailbox-empty").css("display", "block");
            $("#mailbox").html("");
          }else{
            $(".mailbox-empty").css("display", "none");
            $("#mailbox").html("");
          }

          flag_unreadmail = false;
          $('#hFlag_MessageId').val('');
          var iLoop = 0;
          $.each(d.messages, function (key, value) {
            iLoop++;
            
            // for test --->
            // if(flag_unreadmail==false)
            // {
            //   flag_unreadmail = value.id;            $('#hFlag_MessageId').val(value.id);
            // }
            //<--- 

            var is_seen = "";
            if (!value.is_seen) {
              is_seen = '<span class="badge badge-success" >new</span>';
              //if(iLoop==1)
              {
                flag_unreadmail = value.id;
                $('#hFlag_MessageId').val(value.id);
              }
            }
            $("#mailbox").append(
              '<div class="message-item">' +
                is_seen +
                '<div class="row">' +
                '<div class="col-10 col-md-4 ov-h"><a href="view/' +
                value.id +
                '" class="sender_email">' +
                value.from +
                "<span>" +
                value.from_email +
                '</span><span class="d_show">'+ value.subject +'</span></a></div>' +
                '<div class="col-md-6 ov-h d_hide"><a href="view/' +
                value.id +
                '" class="subject_email">' +
                value.subject +
                "</div>" +
                '<div class="col-2  text-right"><a href="view/' +
                value.id +
                '" class="view_email"><i class="fas fa-chevron-right"></i></a></div>'
            );
          });
        },
      });
    }

    //messages();
    ajax_email();
    setInterval(messages, fetch_time * 1000);
  } catch (error) {}

  var flag_unreadmail = false;
  /*--------------- Navbar Collapse ------------------ */
  $(".nav-link").on("click", function () {
    $(".navbar-collapse").collapse("hide");
  });


  /*--------------- iframe height ------------------ */
  try {
    // Selecting the iframe element
    var iframe = document.getElementById("myIframe");
      
    // Adjusting the iframe height onload event
    $('iframe').on('load', function() {
		//alert(this);
      this.style.height = this.contentWindow.document.body.scrollHeight + 'px';
    });

  } catch (error) {}

});

function show_error_msg(msg)
{
    $('#system-message-container').css('color', 'red');
    $('#system-message-container').html(msg);
    setTimeout(() => {
        $('#system-message-container').fadeOut(1000, () => {
            $('#system-message-container').html('');
        });            
    }, 3000);
}

// Toggles a result details when clicking on div.header
jQuery( '.test-result .header' ).on('click',function() {
  jQuery(this).closest('.test-result').toggleClass('open');
});

jQuery('.copy').on('click',function(){
  const copyText = document.getElementById(jQuery(this).data('target'));

  /* Select the text field */
  copyText.select();
  copyText.setSelectionRange(0, 99999); /*For mobile devices*/

  /* Copy the text inside the text field */
  document.execCommand("copy");
});