$ = jQuery

$ ->

  dangerAlert  = new TenderAlert 'danger'
  successAlert = new TenderAlert 'success'
  warningAlert = new TenderAlert 'warning'
  infoAlert    = new TenderAlert 'info'

  dangerConfirmAlert = new TenderConfirmAlert  'danger'
  warningConfirmAlert = new TenderConfirmAlert 'warning'

  $.ajaxSetup
    headers:
      'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')

  class Navigator
    constructor: (@tableTools) ->
      @row     = @tableTools.fnGetSelected()[0]
      @rowData = @tableTools.fnGetSelectedData()[0]

      @rowData = [undefined, '', '', '启用', 0] unless Boolean(@rowData)

      @id    = @rowData[0]
      @name  = @rowData[1]
      @url   = @rowData[2]
      @state = @rowData[3]
      @sort  = @rowData[4]

      if @state.match /启用/
        @stateValue = 1
        @alertLabel = '停用'
      else
        @stateValue = 0
        @alertLabel = '启用'

    ###
    # 和后台进行通信
    ###
    ajax: (successCallback) ->
      $.ajax
        url      : @actionUrl
        async    : false
        method   : @method
        dataType : 'json'
        context  : @
        success  : successCallback

    new: ->
      @actionUrl  = "navigators"
      @method     = "POST"
      @modalTitle = "新建"

      @popUpFormModal()

    edit: ->
      @actionUrl  = "navigators/#{@id}"
      @method     = "PUT"
      @modalTitle = "编辑"

      @popUpFormModal()

    # 弹出编辑窗口
    popUpFormModal: ->
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
                        <input type="hidden" name="id" value="#{@id}">
                        <div class="form-group">
                          <label>名称</label>
                          <input class="form-control" type="text" name="name" value="#{@name}">
                        </div>
                        <div class="form-group">
                          <label>链接</label>
                          <input class="form-control" type="text" name="url" value="#{@url}">
                        </div>
                        <div class="form-group">
                          <label>状态</label>
                          <p>
                            <label class="radio-inline">
                              <input type="radio" name="state" value="1"> 启用
                            </label>
                            <label class="radio-inline">
                              <input type="radio" name="state" value="0"> 停用
                            </label>
                          </p>
                        </div>
                        <div class="form-group">
                          <label>排序 <small>按从小到大排序</small></label>
                          <input class="form-control" type="number" min="0" name="sort" value="#{@sort}">
                        </div>
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
      $(modal).find("input[type=radio][value=#{@stateValue}]").attr("checked", "")
      @bindingSubmitEvent(modal, @)

      $(modal).on 'shown.bs.modal', ->
        $(modal).find('input[name=name]').focus()

      $(modal).appendTo($('body')).modal()

    # 绑定提交事件
    bindingSubmitEvent: (modal, context) ->
      form = modal.find 'form'

      # Submit form
      form.on 'submit', (e) ->
        e.preventDefault()

        $(@).ajaxSubmit
          async    : false
          dataType : 'json'
          context  : context
          success  : (result) ->
            modal.modal('hide')
            if result.state == 'OK'
              @stateValue = Number(result.data.state)
              @updateStateLabel()
              @rowData = [result.data.id, result.data.name, result.data.url, @state, result.data.sort]
              # 如果是更新则刷新这行，否则创建新行
              if @method == 'PUT'
                @rowRedraw()
              else
                @newRow()
              new TenderAlert('success').alert result.message
          error    : (jqXHR) ->
            if jqXHR.status == 422
              @invalidFormInModal jqXHR.responseJSON, modal

      modal.find('button[type=submit]').click ->
        button = $(@)
        button.html '<i class="fa fa-spinner fa-pulse"></i>'
        button.addClass 'disabled'
        setTimeout ->
          form.submit()
        , 300

    invalidFormInModal: (errors, modal) ->
      form = $(modal).find 'form'
      $(modal).find('button[type=submit]').removeClass('disabled').text('保存')
      for field, messages of errors
        @invalidFormField field, messages, form

    invalidFormField: (field, errors, form) ->
      if field && errors
        formGroup = form.find("input[name=#{field}]").parent '.form-group'
        formGroup.find('div.help-block').remove()
        helpBlock = $('<div class="help-block"></div>')
        helpBlock.append "<p>#{error}</p>" for error in errors
        formGroup.addClass('has-error').append helpBlock

    delete: ->
      @actionUrl    = "navigators/#{@id}"
      @method = 'DELETE'
      @ajax (response) ->
        alertType = 'success'
        alertType = 'danger' if response.state != 'OK'
        @updateDeleted()     if response.state == 'OK'
        new TenderAlert(alertType).alert response.message

    toggle: ->
      @actionUrl    = "navigators/#{@id}/toggle"
      @method = 'PUT'
      @ajax (response) ->
        @updateToggle() if response.state == 'OK'

    updateToggle: ->
      @stateValue = 1 - @stateValue
      @updateStateLabel()
      @rowData[3] = @state
      @rowRedraw()

    updateStateLabel: ->
      if @stateValue == 1
        @state = '<span class="label label-success"> 已启用 </span>'
      else
        @state = '<span class="label label-danger"> 已停用 </span>'

    rowRedraw: ->
      @row = @api().row(@row).data(@rowData).draw()

    newRow: ->
      @row = @api().row.add(@rowData).draw().node()
      $(@row).addClass('success')
      setTimeout (row) ->
        $(row).removeClass('success')
      , 3000, @row

    updateDeleted: ->
      @deleted = true
      @api().row(@row).remove().draw()

    api: ->
      $('#navigatorsTable').dataTable().api(true)

  ##
  # @description TableTools初始化按钮时，让它能够弹出ToolTip
  ##
  initButtonToolTip = (nButton, oConfig) ->
    $(nButton).attr
      'data-toggle'   : 'tooltip'
      'data-placement': 'bottom'

  toggleButtonStateOnSelect = (nButton, oConfig, nRow) ->
    tableTool = TableTools.fnGetInstance('navigatorsTable')

    if tableTool.fnGetSelected().length == 1
      $(nButton).removeClass 'disabled'
    else
      $(nButton).addClass 'disabled'

  isSelectedOne = ->
    selectedRows = TableTools.fnGetInstance('navigatorsTable').fnGetSelectedData()
    throw 'Only can toggle a navigator once' if selectedRows.length > 1
    throw 'Need a navigator to be toggle'    if selectedRows.length < 1

  getSelectedNavigator = ->
    isSelectedOne()
    tableTools = TableTools.fnGetInstance 'navigatorsTable'
    new Navigator tableTools

  ##
  # @description 初始化DataTable
  ##
  navigatorsDataTable = $('#navigatorsTable').dataTable
    dom: "<'row'<'col-sm-6'T><'col-sm-6'f>><'row'<'col-sm-12'tr>><'row'<'col-sm-5'i><'col-sm-7'p>>"
    order: [4, 'asc']
    columnDefs: [ { orderable: false, targets: [0, 1, 2] } ]
    language:
      url: '/dataTables_zh_CN.json'
    tableTools:
      sRowSelect: 'os'
      aButtons: [
        {
          sButtonClass: "btn btn-flat btn-default"
          sExtends: "text"
          sButtonText: "<i class='fa fa-plus'></i>"
          sToolTip: "新建"
          fnInit: initButtonToolTip
          fnClick: ->
            tableTool = TableTools.fnGetInstance('navigatorsTable')
            tableTool.fnSelectNone()
            navigator = new Navigator tableTool
            navigator.new()
        },
        {
          sButtonClass: "btn btn-flat btn-default disabled"
          sExtends: "text"
          sButtonText: "<i class='fa fa-edit'></i>"
          sToolTip: "编辑"
          fnInit: initButtonToolTip
          fnSelect: toggleButtonStateOnSelect
          fnClick: ->
            navigator = getSelectedNavigator()
            navigator.edit()
        },
        {
          sButtonClass: "btn btn-flat btn-default disabled"
          sExtends: "text"
          sButtonText: "<i class='fa fa-trash-o'></i>"
          sToolTip: "删除"
          fnInit: initButtonToolTip
          fnSelect: toggleButtonStateOnSelect
          fnClick: ->
            navigator = getSelectedNavigator()
            dangerConfirmAlert.alert '危险！这个操作将无法逆转。确认删除吗？', ->
              navigator.delete()
            , '危险'
        },
        {
          sButtonClass: "btn btn-flat btn-default disabled"
          sExtends: "text"
          sButtonText: "<i class='fa fa-toggle-off'></i>"
          sToolTip: "停用/启用"
          fnInit: initButtonToolTip
          fnSelect: toggleButtonStateOnSelect
          fnClick: (nButton, oConfig, oFlash) ->
            navigator = getSelectedNavigator()
            warningConfirmAlert.alert "确定要#{navigator.alertLabel}这个导航吗？",  ->
              navigator.toggle()
        }
      ]
