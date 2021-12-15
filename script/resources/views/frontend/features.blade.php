@if($features->count() > 0)
<!-- Features Section Start -->
<section class="features section-padding" data-scroll-index="1">
  <div class="container">
    <div class="row justify-content-center ">
      <div class="col-md-8">
        <div class="section-title">
          <h2>
            @php
            $f = explode(' ', __('Awesome Features'))
            @endphp
            {{$f[0]}}
            <span>{{@$f[1] . ''. @$f[2]}}</span>
          </h2>
          <p>{{__('Features Description')}}</p>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="owl-carousel features-carousel">
        @foreach ($features as $feature)
        <div class="features-item">
          <div class="icon">{!! $feature->icon !!}</div>
          <h3>{{$feature->title}}</h3>
          <p>{{$feature->description}}</p>
        </div>
        @endforeach
      </div>
    </div>
  </div>
</section>
<!-- Features Section End -->
@endif


@if ($setdata['enable_blog'])
<!-- Popular Posts Section Start -->
<section class="popular-posts section-padding" data-scroll-index="1">
  <div class="container">
    <div class="row justify-content-center ">
      <div class="col-md-8">
        <div class="section-title">
          <h2>
            @php
            $f = explode(' ', __('Popular Posts'))
            @endphp
            {{$f[0]}}
            <span>{{@$f[1] . ''. @$f[2]}}</span>
          </h2>
        </div>
      </div>
    </div>
    <div class="row">
      @foreach ($popular_posts as $post)

      <div class="col-sm-6 col-md-4">
        <div class="blog-grid">
          <div class="blog-img">
            <a href="{{route('post' , $post->slug)}}">
              <img src="{{asset($post->image)}}" title="{{$post->title}}" alt="{{$post->title}}">
            </a>
          </div>
          <div class="blog-info">
            <h5><a href="{{route('post' , $post->slug)}}">{{ Str::limit($post->title, 40) }}</a></h5>
            <p>{{ Str::limit($post->description, 100) }}</p>
          </div>
        </div>
      </div>
      @endforeach
    </div>
  </div>
</section>
<!-- Popular Posts Section End -->
@endif