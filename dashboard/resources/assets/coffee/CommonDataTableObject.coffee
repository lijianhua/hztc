###
# 对于 DataTable 中的数据对象封装
# 可以用来操作数据表格
###
class @CommonDataTableObject
  ###
  # @param tableId id of DataTable element
  ###
  constructor: (@tableId) ->
    throw "Requir table tools extension of data table." unless window.TableTools
    throw "Require jQuery" unless window.jQuery
    @tableTool = @getTableToolInstance()

  ###
  # 根据 tableId 获取TableTool对象
  ###
  getTableToolInstance: ->
    TableTools.fnGetInstance @tableId

  ###
  # 判断是不是只有一行被选中了
  ###
  isSelectedOne: ->
    @selectedRows().length == 1

  ###
  # 获取被选中的行
  ###
  selectedRowsData: ->
    @tableTool.fnGetSelectedData()

  selectedRowData: ->
    @selectedRowsData()[0]

  selectedRows: ->
    @tableTool.fnGetSelected()

  selectedRow: ->
    @tableTool.fnGetSelected()[0]

  redrawSelectedRow: (rowData) ->
    @api().row(@selectedRow()).data(rowData).draw false

  newRow: (rowData) ->
    row = @api().row.add(rowData).draw false
    $(row).addClass('success')
    setTimeout (row) ->
      $(row).removeClass('success')
    , 3000, row

  ###
  # 获取DataTable api
  ###
  api: ->
    window.jQuery("##{@tableId}").dataTable().api(true)

  ###
  # 创建新的 form
  ###
  new: (fields) ->
    @method     = 'POST'
    @modalTitle = '新建'
    throw 'Require to set actionUrl in subClass' unless @actionUrl

    # 弹出编辑窗口
    @popUpForm(fields)
    # 重置 actionUrl
    @actionUrl = null

  ###
  # 删除被选中的行
  # 需要子类提供 actionUrl
  ###
  deleteSelectedRow: ->
    @method   = 'DELETE'
    throw 'Require to set actionUrl in subclass' unless @actionUrl
    @ajax (response) ->
      if response.state == 'OK'
        @api().row(@selectedRow()).remove().draw false
        type = 'success'
      else
        type = 'danger'

      new TenderAlert(type).alert response.message
    , ->
      new TenderAlert('danger').alert '删除失败，请重试。'
    # 重置 actionUrl
    @actionUrl = null

  ###
  # 编辑被选中的类
  ###
  editSelectedRow: (fields) ->
    @method     = 'PUT'
    @modalTitle = '编辑'
    throw 'Require to set actionUrl in subClass' unless @actionUrl

    # 弹出编辑窗口
    @popUpForm(fields)
    # 重置 actionUrl
    @actionUrl = null

  popUpForm: (fields) ->
    modal = """
            <div class="modal fade">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <h4 class="modal-title">#{@modalTitle}</h4>
                  </div>
                  <div class="modal-body">
                    <form action="#{@actionUrl}" method="POST">
                      <input type="hidden" name="_method" value="#{@method}">
                      <input type="hidden" name="_token"  value="#{$('meta[name="csrf-token"]').attr('content')}">
                      #{@fields(fields)}
                    </form>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">取消</button>
                    <button type="submit" class="btn btn-primary">保存</button>
                  </div>
                </div>
              </div>
            </div>
            """
    modal = $(modal)
    modal.find('form').attr 'enctype', 'multipart/form-data' if @fileUpload
    # 异步提交
    @bindSubmitEventOn(modal, @)
    $(modal).appendTo($('body')).modal()

  ###
  # 生成Form 编辑域
  ###
  fields: (fields) ->
    result = ''
    for field in fields
      result += @field field
    result

  ###
  # 根据给定数据生成 input 表单
  # TODO 支持更多类型
  ###
  field: (field) ->
    switch field.type
      when 'hidden'
        @hiddenField field.name, field.value
      when 'text'
        @textField field.name, field.value, field.label
      when 'number'
        @numberField field
      when 'textarea'
        @textareaField field
      when 'image'
        @imageField field
      when 'select'
        @selectField field
      when 'datetime'
        @formGroupDateTimeField field

  selectField: (field) ->
    @formGroupSelectField field

  imageField: (field) ->
    @formGroupImageField field

  textareaField: (field) ->
    @formGroupTextArea field

  numberField: (field) ->
    @formGroupInputField field

  hiddenField: (name, value) ->
    @inputField
      name  : name
      value : value
      type  : 'hidden'

  textField: (name, value, label) ->
    @formGroupInputField
      name  : name
      value : value
      type  : 'text'
      label : label
      class : 'form-control'

  select: (attributes) ->
    # 选项
    options = attributes.options
    value   = attributes.value
    delete attributes.options
    delete attributes.value

    # 将值的选项设置到第一个，解决设置值的问题
    oldFirst = options[0]
    for option in options
      if option.value == value
        index = options.indexOf option
        options[0] = option
        options[index] = oldFirst
        break

    select = "<select "
    # Properties
    for key, value of attributes
      select += " #{key}='#{value}' "
    select += ">"
    # Options
    for option in options
      select += @option option
    select += "</select>"

    select

  option: (attributes) ->
    "<option value='#{attributes.value}'>#{attributes.label}</option>"

  formGroupSelectField: (field) ->
    """
    <div class="form-group">
      <label>#{field.label}</label>
      #{delete field.label && delete field.type  && @select field}
    </div>
    """

  formGroupImageField: (field) ->
    """
    <div class="form-group">
      <label>#{field.label}</label>
      #{delete field.label  && @fileField field}
    </div>
    """

  formGroupDateTimeField: (field) ->
    """
    <div class="form-group">
      <label>#{field.label}</label>
      #{delete field.label  && @datetimeField field}
    </div>
    """

  formGroupTextArea: (field) ->
    """
    <div class="form-group">
      <label>#{field.label}</label>
      #{delete field.label && delete field.type && @textarea field}
    </div>
    """

  formGroupInputField: (field) ->
    """
    <div class="form-group">
      <label>#{field.label}</label>
      #{delete field.label && @inputField field}
    </div>
    """

  fileField: (field) ->
    field.type  = 'file'
    @inputField field

  datetimeField: (field) ->
    field.type = 'datetime'
    @inputField field

  textarea: (attributes) ->
    textarea = "<textarea"
    for key, value of attributes
      textarea += " #{key}='#{value}' " if key != 'value'
    textarea += ">#{attributes.value}</textarea>"
    textarea

  inputField: (attributes) ->
    input = "<input"
    for key, value of attributes
      input += " #{key}='#{value}' "
    input += ">"
    input

  errorField: (field, errors, form) ->
    formGroup = form.find("[name=#{field}]").parent '.form-group'
    formGroup.find('div.help-block').remove()
    helpBlock = $('<div class="help-block"></div>')
    helpBlock.append "<p>#{error}</p>" for error in errors
    formGroup.addClass('has-error').append helpBlock

  ###
  # 进行 Ajax 同步请求
  ###
  ajax: (successCallback = null, errorCallback = null) ->
    $ = window.jQuery
    $.ajax
      url      : @actionUrl
      async    : false
      method   : @method
      dataType : 'json'
      context  : @
      success  : successCallback
      error    : errorCallback
      headers  :
        'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')

  ###
  # 异步提交 modal 中的表单
  ###
  bindSubmitEventOn: (modal, context) ->
    $ = window.jQuery

    form = modal.find 'form'

    # Bind submit event on submit button
    modal.find('button[type=submit]').click ->
      button = $(@)
      button.html '<i class="fa fa-spinner fa-pulse"></i>'
      button.addClass 'disabled'
      setTimeout ->
        form.submit()
      , 300

    # Submit
    form.on 'submit', (e) ->
      e.preventDefault()

      $(@).ajaxSubmit
        dataType : 'json'
        context  : context
        success  : (result) ->
          modal.modal 'hide'
          if result.state == 'OK' && result.data
            if @method == 'PUT'
              @redrawSelectedRow result.data
            else
              @newRow result.data
          new TenderAlert('success').alert result.message
        error    : (jqXHR) ->
          if jqXHR.status == 422
            @formInModalHasErrors jqXHR.responseJSON, modal
          else
            modal.modal 'hide'
            new TenderAlert('danger').alert '出现错误, 请重试。'

  formInModalHasErrors: (errors, modal) ->
    form = $(modal).find 'form'
    $(modal).find('button[type=submit]').removeClass('disabled').text('保存')
    for field, messages of errors
      @errorField field, messages, form

  ##
  # @description TableTools初始化按钮时，让它能够弹出ToolTip
  ##
  @initButtonToolTip: (button, config) ->
    $(button).attr
      'data-toggle'   : 'tooltip'
      'data-placement': 'bottom'
