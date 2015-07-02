<div class="carousel slide" data-ride="carousel" id="ad-carousel-{{ $ad->id }}">
  <ol class="carousel-indicators">
    @for($i = 0; $i < $ad->images()->count(); $i++)
      <li data-target="ad-carousel-{{ $ad->id }}" data-slide-to="{{ $i }}" class="{{ $i == 0 ? "active" : "" }}"></li>
    @endfor
  </ol>
  <div class="carousel-inner" role="listbox">
    @foreach($ad->images as $index => $image)
      <div class="item {{ $index == 0 ? "active" : "" }}">
        <img src="{{ $image->avatar->url() }}" alt="{{ $ad->title }}产品示意图-{{ $index }}">
      </div>
    @endforeach
  </div>
  <!-- Controls -->
    <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
      <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
      <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
    </a>
</div>
