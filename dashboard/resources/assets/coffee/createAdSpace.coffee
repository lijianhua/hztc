$ = jQuery

$ ->
  form = document.getElementById 'createAdSpaceForm'

  return false unless form

  class CreateAdSpaceForm
    constructor: (@id) ->
      @$ = window.jQuery
      @get_address_url = '/addresses'
      @provinceSelect  = @$('#addr_province')
      @citySelect      = @$('#addr_city')
      @areaSelect      = @$('#addr_area')
      @addressIdInput  = @$('input[name=address_id]')
      @addPriceButton  = @$('#newPrice')
      @pricesContainer = @$('.prices')
      @imagesContainer = @$('.images')
      # ajax设置
      @$.ajaxSetup
        context: @

      # 初始化图片上传
      @initAvatars()
      # 初始化地址选择
      @initAddressSelects()
      # 初始化时间选择
      @initDateRange()
      # 初始化处理价格
      @initPriceProcessing()

    ###
    # 初始化文件上传
    ###
    initAvatars: ->
      @$('input[name=avatar]').fileinput
        language         : 'zh'
        previewFileType  : 'image'
        allowedFileTypes : [ 'image' ]
        showUpload       : false
        showCancel       : false

      @$("input[name='images[]']").fileinput
        language         : 'zh'
        previewFileType  : 'image'
        allowedFileTypes : [ 'image' ]
        uploadUrl        : '/avatars/upload'
        uploadAsync      : true

      @listenFileUploadedEventOnImages()
      @listenFileDeletedEventOnImages()

    listenFileUploadedEventOnImages: ->
      @$("input[name='images[]']").on 'fileuploaded', context: @, (e, data) ->
        context = e.data.context
        imgId   = data.response.initialPreviewConfig[0].key
        context.imagesContainer.append(
          """
          <input type="hidden" name="__images[]" value="#{imgId}">
          """
        )

    listenFileDeletedEventOnImages: ->
      @$("input[name='images[]']").on 'filedeleted', context: @, (e, imgId) ->
        context = e.data.context
        context.imagesContainer.find("input[value=#{imgId}]").remove()

    ###
    # 初始化地址选择
    ###
    initAddressSelects: ->
      @clearProvinceOptions()
      @initProvinceOptions()
      @bindChangeEventOnProvinceSelect()
      @bindChangeEventOnCitySelect()
      @bindChangeEventOnAreaSelect()

    initDateRange: ->
      @$('input[data-type=daterange]').daterangepicker
        format: 'YYYY/MM/DD'
        locale:
          applyLabel       : '确定'
          cancelLabel      : '取消'
          fromLabel        : '起始'
          toLabel          : '截止'
          customRangeLabel : '自定义'
          daysOfWeek       : ['日', '一', '二', '三', '四', '五', '六']
          monthNames       : [
            '一月', '二月', '三月', '四月',
            '五月', '六月', '七月', '八月',
            '九月', '十月', '十一月', '十二月'
          ]
          firstDay         : 1

    initPriceProcessing: ->
      @addClickEventOnAddPriceButton()
      @addRemovePriceEvent()

    addClickEventOnAddPriceButton: ->
      @addPriceButton.click context: @, (e) ->
        context = e.data.context

        context.pricesContainer.append context.priceForm()
        context.initDateRange()

    addRemovePriceEvent: ->
      @pricesContainer.delegate 'button[data-widget=remove]', 'click', context: @, (e) ->
        e.preventDefault()
        context = e.data.context
        $ = context.$
        $(@).closest('.price').slideUp 'normal', ->
          $(@).remove()

    priceForm: ->
      seed = Math.floor(Math.random() * 100000 + 1)
      """
        <div class="col-md-3 price">
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">广告价格</h3>
              <div class="box-tools pull-right">
                <button class="btn btn-box-tool" type="button" data-widget="remove">
                  <i class="fa fa-times"></i>
                </button>
              </div>
            </div>
            <div class="box-body">
              <div class="form-group">
                <label>原价</label>
                <input class="form-control" type="text" name="ad_prices[#{seed}][original_price]">
              </div>
              <div class="form-group">
                <label>单价</label>
                <input class="form-control" type="text" name="ad_prices[#{seed}][price]">
              </div>
              <div class="form-group">
                <label>积分</label>
                <input class="form-control" type="text" name="ad_prices[#{seed}][score]">
              </div>
              <div class="form-group">
                <label>投放时间段</label>
                <input class="form-control" type="text" data-type="daterange" name="ad_prices[#{seed}][daterange]">
              </div>
              <div class="form-group">
                <label>投放次数</label>
                <input class="form-control" type="text" name="ad_prices[#{seed}][send_count]">
              </div>
              <div class="form-group">
                <label>可销售次数</label>
                <input class="form-control" type="text" name="ad_prices[#{seed}][sale_count]">
              </div>
            </div>
          </div>
        </div>
      """

    clearProvinceOptions: ->
      @provinceSelect.empty()

    clearCityOptions: ->
      @citySelect.empty()

    clearAreaOptions: ->
      @areaSelect.empty()

    initProvinceOptions: ->
      @optionToProvince '请选择省份'

      @$.getJSON @get_address_url, column: 'province', (provinces) ->
        @optionToProvince province for province in provinces

    initCityOptions: (province) ->
      @optionToCity '请选择城市'
      return if province == '请选择省份'

      @$.getJSON @get_address_url, { column: 'city', province: province }, (cities) ->
        @optionToCity city for city in cities

    initAreaOptions: (province = null, city = null) ->
      @optionToArea '请选择地区'
      return unless province && city
      return if (province == '请选择省份') || (city == '请选择城市')

      @$.getJSON @get_address_url, {column : 'area', province: province, city: city}, (areas) ->
        @optionToArea area for area in areas

    bindChangeEventOnProvinceSelect: ->
      @provinceSelect.change context: @, (e) ->
        context = e.data.context
        context.clearCityOptions()
        context.clearAreaOptions()
        context.initCityOptions(context.provinceSelect.val())
        context.initAreaOptions()
        context.changeAddressId()

    bindChangeEventOnCitySelect: ->
      @citySelect.change context: @, (e) ->
        context = e.data.context
        context.clearAreaOptions()
        context.initAreaOptions(context.provinceSelect.val(), context.citySelect.val())
        context.changeAddressId()

    bindChangeEventOnAreaSelect: ->
      @areaSelect.change context: @, (e) ->
        context = e.data.context
        context.changeAddressId(
          context.provinceSelect.val(),
          context.citySelect.val(),
          context.areaSelect.val()
        )

    changeAddressId: (province = null, city = null, area = null) ->
      if province && city && area && province != '请选择省份' && city != '请选择城市' && area != '请选择地区'
        @$.getJSON @get_address_url, {column: 'id', province: province, city: city, area: area}, (ids) ->
          @addressIdInput.val ids[0] if ids.length > 0
      else
        @addressIdInput.val ''


    optionToProvince: (label) ->
      option = @option label
      @provinceSelect.append option

    optionToCity: (label) ->
      option = @option label
      @citySelect.append option

    optionToArea: (label) ->
      option = @option label
      @areaSelect.append option

    option: (label) ->
      "<option>#{label}</option>"

  form = new CreateAdSpaceForm 'createAdSpaceForm'
