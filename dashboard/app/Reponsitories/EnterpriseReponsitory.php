<?php

namespace App\Reponsitories;

use HTML;
use Datatables;

use App\Models\Enterprise;

class EnterpriseReponsitory
{
  public function datatables($query)
  {
    return Datatables::of($query)
      ->editColumn('is_verify', function ($enterprise) {
        if ($enterprise->is_verify == 0) {
          return " <span class=\"label label-warning\">等待认证</span>";
        } else if ($enterprise->is_verify == 1) {
          return " <span class=\"label label-success\">申请通过</span>";
        } else {
          return " <span class=\"label label-danger\">申请驳回</span>";
        }
      })
      ->addColumn('tax', function ($enterprise) {
        $material = $enterprise->reviewMaterials()->whereName('tax')->first();
        if ($material) {
          $url         = $this->imageUrl($material, 'thumb');
          $originalUrl = $this->imageUrl($material);
          return HTML::decode(HTML::link($originalUrl, HTML::image($url), [
            'title'          => '点击查看大图',
            'data-toggle'    => 'tooltip',
            'data-placement' => 'right',
            'target'         => '_blank'
          ]));
        }
        return '未上传';
      })
      ->addColumn('license', function ($enterprise) {
        $material = $enterprise->reviewMaterials()->whereName('tax')->first();
        if ($material) {
          $url         = $this->imageUrl($material, 'thumb');
          $originalUrl = $this->imageUrl($material);
          return HTML::decode(HTML::link($originalUrl, HTML::image($url), [
            'title'          => '点击查看大图',
            'data-toggle'    => 'tooltip',
            'data-placement' => 'right',
            'target'         => '_blank'
          ]));
        }
        return '未上传';
      })
      ->addColumn('organizing', function ($enterprise) {
        $material = $enterprise->reviewMaterials()->whereName('tax')->first();
        if ($material) {
          $url         = $this->imageUrl($material, 'thumb');
          $originalUrl = $this->imageUrl($material);
          return HTML::decode(HTML::link($originalUrl, HTML::image($url), [
            'title'          => '点击查看大图',
            'data-toggle'    => 'tooltip',
            'data-placement' => 'right',
            'target'         => '_blank'
          ]));
        }
        return '未上传';
      })
      ->make(true);
  }

  public function imageUrl($material, $tag = '')
  {
    $avatar = $material->avatar;
    $path   = $avatar->url($tag);

    return $path;
  }
}
