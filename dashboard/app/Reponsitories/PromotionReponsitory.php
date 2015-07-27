<?php

namespace App\Reponsitories;

use HTML;
use Datatables;

class PromotionReponsitory
{
  public function datatables($query)
  {
    return Datatables::of($query)
      ->addColumn('ad', function ($promotion) {
        return $this->promotionDetail($promotion);
      })
      ->addColumn('__price', function ($promotion) {
        return '￥' . money_format('%.2n', $promotion->price);
      })
      ->addColumn('state', function ($promotion) {
        if ($promotion->isProccessing()) {
          $style = 'bg-red';
          $label = '进行中';
        } else if ($promotion->isSoon()) {
          $style = 'bg-navy';
          $label = '未开始';
        } else {
          $style = 'label-default';
          $label = '已结束';
        }

        return sprintf("<span class=\"label %s\">%s</span>", $style, $label);
      })
      ->make(true);
  }

  public function promotionDetail($promotion)
  {
    return <<< EOF
      <p class="leading">
        {$promotion->start->format('Y/m/d H:i')} - {$promotion->end->format('Y/m/d H:i')} <br>
        {$promotion->title} <br>
        库存：{$promotion->stock}
      </p>
      <hr>
      <p class="text-muted">
        <small>
          {$this->linkToAd($promotion->adSpace)} <br>
          {$promotion->adSpace->address->province} &nbsp;
          {$promotion->adSpace->address->city} &nbsp;
          {$promotion->adSpace->address->area} &nbsp; <br>
          {$promotion->adSpace->street_address}
        </small>
      </p>
EOF;
  }

  public function linkToAd($ad)
  {
    return HTML::link(url('ads/'.$ad->id), $ad->title, [
      'title'       => '查看广告位`详情',
      'data-toggle' => 'tooltip',
    ]);
  }
}
