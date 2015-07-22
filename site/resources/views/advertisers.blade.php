@extends('app')

@section('content')
<div class="layout">
    <div class="personal clearfix">
      @include ('layouts.user_nav')
        <div class="advertisers">
            <div class="advertisers-tab">
                <span><a class="active" href="#">个人认证</a><a href="#">公司认证</a> </span>
            </div>
            <div class='login-error'
style='position:absolute;font-size:12px;margin-top:200px;margin-left:500px;color:red'>
              @if (count($errors) > 0)
                  @foreach ($errors->all() as $error)
                    {{(new App\Helpers\ErrorHelper)->str_en_cn($error)}}
                  @endforeach
              @endif
            </div>
            <div class="advertisers-personal">
                <div class="personal-title">
                    <span class="personal-prompt">广告主信息<span
class="personal-prompt-color">{{$enterprise && $enterprise->is_audited == 1 ? '(已认证)':'(未认证)'}}</span></span>
                    <span class="personal-prompt-text">{{$enterprise && $enterprise->is_audited == 1? '':'<sub>*</sub>请补充信息完成认证'}}</span>
                </div>
                <?= Form::open(['url' => action('UserController@store_user_auth'), 'method' => 'POST', 'files' => true ]) ?>
						        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <ul class="login-right-info">
                    <div class="advertisers-personal-info">
                        <input type='hidden' name='id' value="{{$user->id}}"/>
                        <div class="advertisers-personal-enter">
                            <strong>用户名</strong><br/>
                            <span><div><label>{{$user->name}}</label></div></span>
                        </div>
                        <div class="advertisers-personal-enter">
                            <strong>真实姓名</strong><br/>
                            <span><input type="text" name='truthname'
value='{{isset($truthname)? $truthname->note:''}}'></span>
                        </div>
                        <div class="advertisers-personal-enter">
                            <strong>身份证号码</strong><br/>
                            <span><input type="text" name='idcard'
value='{{isset($idcard)? $idcard->note:''}}'></span>
                        </div>
                        <div class="advertisers-personal-enter">
                            <strong>手机号</strong><br/>
                            <span><input type="text" name='telphone'
value='{{isset($telphone)? $telphone->note: ''}}'></span>
                        </div>
                        <div class="advertisers-personal-enter">
                            <strong>邮箱</strong><br/>
                            <span><div><label>{{$user->email}}</label></div></span>
                        </div>
                        <div class="advertisers-personal-block">
                            <div class="advertisers-personal-enter">
                                <strong>从属公司</strong><br/>
                                <span><input type="text" name='enterprise'
value='{{$enterprise? $enterprise->name:''}}'></span>
                            </div>
                        </div>
                        <div class="advertisers-personal-enter">
                            <button type="submit">提交</button>
                        </div>
                    </div>
               <?= Form::close() ?>
            </div>
            <div class="advertisers-company display" id='#ppp'>
                <div class="personal-title">
                    <span class="personal-prompt">公司信息认证
                      <span class="personal-prompt-color">{{$enterprise && $enterprise->is_verify==1? '(已认证)':'(未认证)'}}</span>
                    </span>
                    <span class="personal-prompt-text">
                      {{$enterprise && $enterprise->is_verify==1?'':'<sub>*</sub> 请补充信息完成认证'}}
                    </span>
                </div>
                <?= Form::open(['url' => action('UserController@store_company_auth'), 'method' => 'POST', 'files' => true, 'id' => 'upload' ]) ?>
                    <div class="advertisers-company">
                        <div class="advertisers-company-block clearfix">
                            <div class="advertisers-company-item">
                                <div class="advertisers-company-bg">
                                    <div class="advertisers-company-info" id="imgdiv"><img id="imgShow" src={{ isset($license)? $license->avatar->url(): ''}}></div>
                                    <div class="advertisers-company-upload">
                                        <span class="advertisers-company-upload-name">营业执照</span>
                                        <input type="file" id="up_img" name='license'>
                                    </div>
                                </div>
                            </div>
                            <div class="advertisers-company-item ml13">
                                <div class="advertisers-company-bg">
                                    <div class="advertisers-company-info" id="imgdiv2"><img id="imgShow2" src={{isset($tax)? $tax->avatar->url():''}}></div>
                                    <div class="advertisers-company-upload">
                                        <span class="advertisers-company-upload-name">税务登记</span>
                                        <input type="file" id="up_img2" name='tax'>
                                    </div>
                                </div>
                            </div>
                            <div class="advertisers-company-item ml13">
                                <div class="advertisers-company-bg">
                                    <div class="advertisers-company-info" id="imgdiv3"><img id="imgShow3" src={{isset($organizing)? $organizing->avatar->url():''}}></div>
                                    <div class="advertisers-company-upload">
                                        <span class="advertisers-company-upload-name">组织机构代码</span>
                                        <input type="file" id="up_img3" name='organizing'>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="advertisers-company-submit">
                            <button type="submit">提交</button>
                        </div>
                    </div>
                </div>
               <?= Form::close() ?>
        </div>
    </div>
</div>
@endsection
