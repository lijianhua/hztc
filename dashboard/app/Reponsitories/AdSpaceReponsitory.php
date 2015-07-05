<?php

namespace App\Reponsitories;

use DB;
use Auth;
use HTML;
use Carbon\Carbon;
use Datatables;
use Illuminate\Support\Arr;

use App\Models\AdSpace;
use App\Models\AdPrice;

/**
 * 保存编辑广告位
 **/
class AdSpaceReponsitory
{
  /**
   * 保存用户上传的广告位信息
   *
   * @var mixed $input
   * @return int
   **/
  public function store($input)
  {
    DB::transaction(function () use ($input) {
      // 保存广告位基本信息
      $adSpace = $this->parseAndCreateAdSpace($input);
      // 保存广告位分类信息
      $this->parseAndStoreCategoriesFor($adSpace, $input);
      // 保存产品图信息
      $this->parseAndStoreImagesFor($adSpace, $input);
      // 保存价格信息
      $this->parseAndStorePricesFor($adSpace, $input);
    });
  }

  /**
   * 返回DataTable需要的数据
   *
   * @var mixed $query
   * @return response for data tables
   **/
  public function datatables($query)
  {
    return Datatables::of($query)
      ->editColumn('title', function ($ad) {
        return HTML::decode(HTML::link(url('ads/' . $ad->id), $ad->title . '<br>' . HTML::image($ad->avatar->url('thumb')), [
          'title'          => '查看详情',
          'data-toggle'    => 'tooltip',
          'data-placement' => 'right'
        ]));
      })
      ->editColumn('type', function ($ad) {
        switch ($ad->type) {
          case 0:
            return '正常广告';
            break;
          case 1:
            return '免费广告';
            break;
          case 2:
            return '特价广告';
            break;
          case 3:
            return '创意广告';
            break;
        }
      })
      ->editColumn('street_address', function ($ad) {
        return $ad->address->province . '  ' .
               $ad->address->city . '  ' .
               $ad->address->area . '  ' .
               $ad->street_address;
      })
      ->editColumn('audited', function ($ad) {
        if ($ad->audited) {
          return '<span class="label label-success">通过审核</span>';
        } else {
          return '<span class="label label-danger">未通过审核</span>';
        }
      })
      ->setRowId('id')
      ->make(true);
  }

  public function parseAndCreateAdSpace($input)
  {
    $adSpace                 = new AdSpace();
    $adSpace->title          = Arr::get($input, 'title');
    $adSpace->description    = Arr::get($input, 'description', '暂无描述');
    $adSpace->address_id     = Arr::get($input, 'address_id');
    $adSpace->street_address = Arr::get($input, 'street_address');
    $adSpace->detail         = Arr::get($input, 'detail');
    $adSpace->type           = Arr::get($input, 'type');
    $adSpace->avatar         = Arr::get($input, 'avatar');
    $adSpace->user_id        = Auth::user()->id;
    $adSpace->save();

    return $adSpace;
  }

  public function parseAndStoreCategoriesFor($ad, $input)
  {
    $categoryIds = Arr::get($input, 'category_ids');
    $categoryIds = array_filter($categoryIds);
    foreach ($categoryIds as $categoryId)
      $ad->categories()->attach($categoryId);
  }

  public function parseAndStoreImagesFor($ad, $input)
  {
    $imageIds = Arr::get($input, '__images');

    foreach ($imageIds as $imageId)
      $ad->images()->attach($imageId);
  }

  public function parseAndStorePricesFor($ad, $input)
  {
    $prices = Arr::get($input, 'ad_prices');

    $prices = array_map([$this, 'parseDateRange'], $prices);

    $prices = array_map(function ($price) {
      return new AdPrice($price);
    }, $prices);

    $ad->adPrices()->saveMany($prices);
  }

  public function parseDateRange($price)
  {
    $daterange = Arr::get($price, 'daterange');
    $dates     = explode("-", $daterange);

    Arr::forget($price, 'daterange');
    $price['from'] = Carbon::parse($dates[0]);
    $price['to']   = Carbon::parse($dates[1]);

    return $price;
  }
}
