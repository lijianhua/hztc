@extends('app')

@section('content')
<div class="layout">
    <div class="personal clearfix">
      @include ('layouts.user_nav')
        <div class="single">
            <div class="single-title"><span>评价</span></div>
            <div class="single-table">
                <table class="single-table-th">
                    <tr>
                        <th>商品名称</th>
                        <th>下单时间</th>
                        <th>状态</th>
                    </tr>
                </table>
                <table class="single-table-td">
                    <tr>
                        <td>安德里广告牌</td>
                        <td>1023-10-10</td>
                        <td>未评价</td>
                    </tr>
                </table>
            </div>

            <div class="single-info">
                <div class="single-title"><span>我的评价</span></div>
                <ul>
                    <li class="single-star">
                        <strong>评分</strong>
                        <span class="single-star-click">
                            <i class="fa fa-heart"></i>
                            <i class="fa fa-heart"></i>
                            <i class="fa fa-heart"></i>
                            <i class="fa fa-heart"></i>
                            <i class="fa fa-heart"></i>
                        </span>
                    </li>
                    <li>
                        <table border="0">
                            <tr>
                                <td style="width: 45px"><strong>标签</strong></td>
                                <td>
                                    <span class="single-tag ">
                                        <span class="single-tag-item">这个套系很便宜(25)</span>
                                        <span class="single-tag-item">不错的一次回忆</span>
                                        <span class="single-tag-item">世间少有</span>
                                        <span class="single-tag-item">在这里可以找到真爱</span>
                                        <span class="single-tag-item">这个套系很便宜(25)</span>
                                        <span class="single-tag-item">不错的一次回忆</span>
                                        <span class="single-tag-item">世间少有</span>
                                        <span class="single-tag-item">在这里可以找到真爱</span>
                                    </span>
                                </td>
                            </tr>
                        </table>
                    </li>
                    <li>
                        <strong>评论</strong>
                        <div class="single-info-text">
                            <textarea></textarea>
                        </div>
                    </li>
                    <li class="single-personal-enter">
                        <button type="submit">提交</button>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection
