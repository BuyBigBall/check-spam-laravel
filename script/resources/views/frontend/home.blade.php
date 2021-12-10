<!-- Home Section Start -->
<script> var firstpage_flag = 'firstpage'; </script>
<section class="home d-flex align-items-center">
  <div class="effect-wrap">
    <i class="fas fa-plus effect effect-1"></i>
    <i class="fas fa-plus effect effect-2"></i>
    <i class="fas fa-circle-notch effect effect-3"></i>
  </div>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-7">
        <h1 class='main-title'>{{translate('Mailbox Small Title')}}</h1>
        <div class="home-text">
          <form method="POST" action="{{ route('spamtest') }}">
          @csrf
          <h1>{{translate('First, send your email to:')}}</h1>
          <div class="custom-email">
            <input type="text" class="custom-email-input" id="trsh_mail" name="trsh_mail" readonly>
            <input type="hidden" id="hFlag_MessageId" name="message_id" value=''>
            <button type="button" data-toggle="tooltip" data-placement="bottom" title="{{translate('Click To Copy!')}}"
              data-clipboard-target="#trsh_mail" class="custom-email-botton">
              <i class="fas fa-copy"></i>
            </button>
          </div>
          <div class="home-btn" style='display:none;'>
            <div class="row align-items-center">
              <div class="col text-center"><a href="{{route('home')}}" class="btn btn-1"><i class="fas fa-redo-alt"></i> {{translate('Refresh')}}</a></div>
              <div class="col text-center"><a href="{{route('change','#changeaccount')}}" class="btn btn-1"><i class="fas fa-pencil-alt"></i> {{translate('Change')}}</a></div>
              <div class="col text-center"><a 
                @if(Cookie::has('count') && Cookie::get('count') >= 5)
                  data-toggle="modal" data-target="#check_bot"
                @else
                  href="{{route('delete')}}" 
                @endif
                class="btn btn-1" ><i class="far fa-trash-alt"></i> {{translate('Delete')}}</a></div>
            </div>
          </div>
          
          <div class="counter">
            <button type="submit" class="btn btn-2"><b>{{translate('Then check your score')}}</b></button>
            <!-- 
            <span class=" count_ mail_count">
              <b>{{translate('Emails Created')}}</b>
              <em class="css_spirite">{{$setdata['emails_created'] + $setdata['total_emails_created']}}</em>
            </span>
            <span class=" count_ mail_count">
              <b>{{translate('Messages Received')}}</b>
              <em class="css_spirite">{{$setdata['messages_received'] + $setdata['total_messages_received']}}</em>
            </span>
            -->
          </div>
          </form>
        </div>
        <p>
          {{translate('Mailbox Description')}}
        </p>
      </div>
    </div>
  </div>
</section>
@if(!empty(session('error')))
  alert("session('error')");
@endif
<script>

</script>
<!-- Home Section End -->