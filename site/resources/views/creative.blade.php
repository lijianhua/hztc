<div class="details-recommend fl">
    <div class="details-recommend-title"><span>人气新奇特广告</span></div>
    @if ($ideas)
    @foreach($ideas as $idea)
      <div class="filter-recommend-item">
          <a href="/ads/{{$idea->id}}">
              <img src="{{$idea->avatar->url()}}">
              <div class="filter-recommend-item-bg">
                {{$idea->description}}
              </div>
          </a>
      </div>
    @endforeach
    @endif
    <!--<div class="details-recommend-more">-->
        <!--<a href="#">发现更多<i class="fa fa-angle-right details-recommend-more-mark"></i></a>-->
    <!--</div>-->
    <div class="details-recommend-title"><span>APP、自媒体广告</span></div>
    @if ($app_medias)
    @foreach($app_medias as $idea)
      <div class="filter-recommend-item">
          <a href="/ads/{{$idea->id}}">
              <img src="{{$idea->avatar->url()}}">
              <div class="filter-recommend-item-bg">
                {{$idea->description}}
              </div>
          </a>
      </div>
    @endforeach
    @endif
    <!--<div class="details-recommend-more">-->
        <!--<a href="#">发现更多<i class="fa fa-angle-right details-recommend-more-mark"></i></a>-->
    <!--</div>-->
</div>
