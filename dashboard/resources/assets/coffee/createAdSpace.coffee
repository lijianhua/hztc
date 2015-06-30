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
      # ajax设置
      @$.ajaxSetup
        context: @
      @initAvatars()
      @initAddressSelects()

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

    ###
    # 初始化地址选择
    ###
    initAddressSelects: ->
      @clearProvinceOptions()
      @initProvinceOptions()
      @bindChangeEventOnProvinceSelect()
      @bindChangeEventOnCitySelect()
      @bindChangeEventOnAreaSelect()

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
