@extends('app')

@section('content')
<article>
    <div class="content">
        <div class="c_contrast">
            <div class="c_contrast_title">资源对比</div>
            <div class="c_contrast_position clearfix">
                <table class="c_contrast_key">
                    <tr>
                        <td class="c_contrast_height"><span>资源名称</span></td>
                    </tr>
                    <tr>
                        <td><span>价格</span></td>
                    </tr>
                    <tr>
                        <td><span>投放市场</span></td>
                    </tr>
                    <tr>
                        <td><span>传播媒介</span></td>
                    </tr>
                    <tr>
                        <td><span>媒体属性</span></td>
                    </tr>
                    <tr>
                        <td><span>受众收入水平</span></td>
                    </tr>
                    <tr>
                        <td><span>受众年龄</span></td>
                    </tr>
                    <tr>
                        <td><span>针对性别</span></td>
                    </tr>
                    <tr>
                        <td><span>目标受众</span></td>
                    </tr>
                    <tr>
                        <td><span>简介</span></td>
                    </tr>
                    <tr>
                        <td><span>关注度</span></td>
                    </tr>
                    <tr>
                        <td><span>影响人数</span></td>
                    </tr>
                    <tr>
                        <td class="c_contrast_height" style="border-bottom: 0;"><span>媒体信息</span></td>
                    </tr>
                </table>
                @if ($adspaces)
                @foreach ($adspaces as $adspace)
                <table class="c_contrast_value">
                    <tr>
                        <td class="c_contrast_height">
                            <div class="line"></div>
                            <div class="c_contrast_value_table">
                                <div class="c_contrast_delete" onclick='moveContrast({{ $adspace['id'] }})'></div>
                                <a href="#">
                                    <img src="{{ $adspace['image'] }}">
                                    <p>> {{ $adspace['name'] }}</p>
                                </a>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>刊例价：{{ $adspace['kprice']}}/{{ $adspace['dw']}}，
                        执行价：{{ $adspace['zprice']}}/{{ $adspace['dw']}}</td>
                    </tr>
                    <tr>
                        <td class="item">{{ $adspace['area']}}</td>
                    </tr>
                    <tr>
                        <td class="item">{{ $adspace['mj']}}</td>
                    </tr>
                    <tr>
                        <td class="item">{{ $adspace['mtsx']}}</td>
                    </tr>
                    <tr>
                        <td class="item">{{ $adspace['szsr']}}</td>
                    </tr>
                    <tr>
                        <td class="item">{{ $adspace['age']}}</td>
                    </tr>
                    <tr>
                        <td class="item">{{ $adspace['sex']}}</td>
                    </tr>
                    <tr>
                        <td class="item">{{ $adspace['szr']}} </td>
                    </tr>
                    <tr>
                        <td class="item">{{ $adspace['description']}}</td>
                    </tr>
                    <tr>
                        <td class="item">刊例价：100万/月，执行价：30万/月</td>
                    </tr>
                    <tr>
                        <td class="item">100万人/月</td>
                    </tr>
                    <tr>
                        <td class="c_contrast_height" style="border-bottom: 0">
                            <div class="clearfix">
                                <div class="c_contrast_info fl"></div>
                                <div class="c_contrast_text fl">
                                    <ul>
                                        <li>名称 {{ $adspace['gname']}}</li>
                                        <li>电话 {{ $adspace['gtelphone']}}</li>
                                        <li>邮箱 {{ $adspace['gemail']}}</li>
                                    </ul>
                                </div>
                            </div>
                        </td>
                    </tr>
                </table>
            @endforeach
            @endif
            </div>
        </div>
    </div>
</article>
<script>
function moveContrast(id)
{
  $.ajax({
    type:'post',
    url:'/delContrast',
    data:{'id':id},
    success:function(data){
      if(data.status == "fail"){
        alert("取消对比失败!");
      }else{
        window.location.reload();
      }
    }
  })
}
</script>
@endsection
