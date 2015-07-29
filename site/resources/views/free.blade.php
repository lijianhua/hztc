@extends('app')

@section('content')
<div class="layout">
    <div class="content clearfix">
        <div class="spike-content">
            <span class="spike-title-text"><span>首页</span><i class="fa fa-angle-right"></i><span>免费广告</span><i class="fa fa-angle-right"></i><span>所有免费</span></span>
            <div class="spike clearfix">
                <div class="spike-left">
                    <div class="spike-recommend fl">
                        <div class="spike-recommend-title"><span>人气创意广告</span></div>
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
                    </div>
                </div>
                <div class="spike-main fl">
                   @foreach($adspaces as $adspace) 
                        <div class="spike-item clearfix" date-start="{{$adspace->start}}" date-end="{{$adspace->end}}">
                            <div class="spike-picture">
                                <img src="{{$adspace->adSpace->avatar->url()}}">
                                <div class="spike-mark {{$adspace->isProccessing()? '':'spike-wait'}}"></div>
                                <div class="spike-bottom">
                                    <span>{{$adspace->adSpace->description}}</span>
                                </div>
                            </div>
                            <div class="spike-info">
                                <div class="spike-info-bg">
                                    <div class="spike-info-title">【{{$adspace->title}}】</div>
                                    <div class="spike-info-date">
                                        <div class="spike-info-date-day fz16">
                                            距离<span>{{$adspace->isProccessing()?  '结束':'开抢'}}</span>时间还有 <i>20</i> 天
                                        </div>
                                        <div class="spike-info-date-count clearfix">
                                            <span class="spike_hour spike-info-date-write mr3">00</span>
                                            <span class="spike-info-date-write mr9">时</span>
                                            <span class="spike_minute spike-info-date-write mr3">00</span>
                                            <span class="spike-info-date-write mr9">分</span>
                                            <span class="spike_second spike-info-date-yellow mr3">00</span>
                                            <span class="spike-info-date-yellow mr9">秒</span>
                                        </div>
                                    </div>
                                    <div class="spike-bt">
                                        <a href="/ads/{{$adspace->ad_space_id}}">{{$adspace->isProccessing()?  '立即抢购':'敬请期待'}}</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                   @endforeach
                </div>
                <div class='page'>{!! $adspaces->render() !!}</div>
            </div>
        </div>
    </div>
</div>
@endsection
