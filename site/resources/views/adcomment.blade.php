<div class="introduction-consumer-block">
  @foreach ($comments as $comment)
    <div class="introduction-consumer-assess-item">
        <div class="introduction-consumer-assess-name">
          <span>{{ $comment->user->name }}</span>
          <span class="introduction-consumer-time fr">{{ $comment->created_at}}</span></div>
        <div class="introduction-consumer-assess-block">
            <div class="introduction-consumer-assess-heart">
        <span>评分：
            <i class="fa fa-heart active"></i>
            <i class="fa fa-heart active"></i>
            <i class="fa fa-heart active"></i>
            <i class="fa fa-heart active"></i>
            <i class="fa fa-heart"></i>
        </span>
            </div>
            <div class="introduction-consumer-assess-text">
               {{ $comment->body }}
            </div>
        </div>
    </div>
  @endforeach
</div>
<div class="page">
  <?php echo $comments->render(); ?>
</div>
