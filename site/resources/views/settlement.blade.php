@extends('app')

@section('content')
<div class="layout content">
    <div class="settlement">
        <div class="contract">
            <div class="contract-info">
                <div class="contract-info-title"><span>用户协议</span></div>

                <dl>
                    <dd style="text-indent: 2em">您在本站有任何消费前，请仔细阅读本条款。若您在本站已有任何消费，则默认已同意本页条款全部内容。（我们会在您最后提交订单时，提醒由您自是否完全同意本全部免责申明条款。如不接受本条款，您可以立即终止本次购物。）</dd>

                    <dt>免责声明  </dt>
                    <dd>魔媒网（momeiw.com）所售
产品为均为广告资源，具有特殊性，因内容不符合法律要求等不可抗力而造成的损失由买家承担，与本网站无关。魔媒网提供交易平台，如因其他原因造成的买卖双方纠纷，魔媒网具有最终裁决权。</dd>

                    <dt>广告发布  </dt>
                    <dd>广告发布是一项特殊性质服务，因不同时段、不同形式媒介情况不同。具体事宜请咨询商家QQ或电话。或者直接拨打全国热线400-831-9003
；注意：若因下单时未及时付款造成的商品未购买成功，本网站概不负责。</dd>
                    <dt>重要提示  </dt>
                    <dd>1、由于广告资源属于时效性特殊消费品，一旦制作、发布完成后，无法进行再次销售。如查询到您的订单状态若显示发布中，此时我们的服务商已经将您定制的广告服务此时一律不能撤单和更改订单信息。大额度交易因其特殊性一旦达成，一律不能撤单和更改订单状态。若因此造成的误会，本站不承担任何责任。</dd>
                    <dd>2、广告材料及时给予：因广告资源以媒介资源为体，具有时效性的特点，所以在下单前后，购买者应及时提供所要发布的广告资料（视频、音频、图片、文字等）。若因不符合发布要求等原因，造成损失，由魔媒网协商买卖双方解决。</dd>
                    <dt>关于支付  </dt>
                    <dd> 我们支持网上支付宝支付，如果您选择的是非网上支付方式，请仔细核对我们的对公账号信息，请您付款后务必及时通知我们，通知途径：电话、在线客服任选其一。如果未收到您的付款通知，我们将无法查实您的款项，订单将不会被确认支付，敬请支持。 </dd>
                    <dt>关于退款  </dt>
                    <dd>您的资金在支付到本站时，银行或支付宝已经扣除了1%手续费（此钱是银行或支付宝接口收取，本站不会收取任何中间费用）。因此在退补各种费用时，我们将会在您的订单总金额扣除1%退回到您的银行卡（因本站原因导致丢单、漏单除外，承诺全额退款到您的支付银行卡），一般会在7个工作日可以到账。因为广告属于特殊商品，无法二次销售。订单未显示广告发布中可以即时联系客服退款，商品显示在“广告发布中”的订单，请联系商家协商退款事宜。您在本站消费前敬请认真、仔细阅读本条款，以免造成误解。</dd>
                </dl>
            </div>
        </div>
        <div class="contract-agree">
            <div class="checkbox">
                <label>
                    <input type="checkbox" value='0'>是否同意本协议条款
                </label>
            </div>
        </div>
        <div class="settlement-list">
            <div class="settlement-list-title">
                支付产品清单
            </div>
            <table border="1">
                <tr>
                    <th>产品名称</th>
                    <th>价格</th>
                    <th>数量</th>
                </tr>
                <tr>
                    <form action='/pay' method='post' id="form_id">
                        <input type='hidden' name="aid_id" value='{{$id}}' class='aid'>
                        <input type="hidden" name="agree_checked" id="agree_checked">
                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                    </form>
                    <td>{{$shop->adSpacesCart->title}}</td>
                    <td>{{$shop->price}}</td>
                    <td>{{$shop->quantity}}</td>
                </tr>
            </table>
            <div class="settlement-list-submit">
                <span
class="settlement-list-submit-total">总计：<span>{{$shop->subtotal}}</span></span>
                <span class="settlement-list-submit-button"><button type="button">提交订单</button></span>
            </div>
        </div>
    </div>
</div>
@endsection
