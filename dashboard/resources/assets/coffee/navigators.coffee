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
        url      : @url
        async    : false
        method   : @method
        dataType : 'json'
        context  : @
        success  : successCallback

    edit: ->
      @url = "navigators/#{@id}"
      @method = "PUT"

    delete: ->
      @url    = "navigators/#{@id}"
      @method = 'DELETE'
      @ajax (response) ->
        alertType = 'success'
        alertType = 'danger' if response.state != 'OK'
        @updateDeleted()     if response.state == 'OK'
        new TenderAlert(alertType).alert response.message

    toggle: ->
      @url    = "navigators/#{@id}/toggle"
      @method = 'PUT'
      @ajax (response) ->
        @updateToggle() if response.state == 'OK'

    updateToggle: ->
      @stateValue = 1 - @stateValue
      if @stateValue == 1
        @state = '<span class="label label-success"> 已启用 </span>'
      else
        @state = '<span class="label label-danger"> 已停用 </span>'
      @rowData[3] = @state
      $('#navigatorsTable').dataTable().api(true).row(@row).data(@rowData).draw()

    updateDeleted: ->
      @deleted = true
      $('#navigatorsTable').dataTable().api(true).row(@row).remove().draw()

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
    columnDefs: [
      { orderable: false, targets: [0, 1, 2] }
    ]
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
            alert 'plus'
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
          sButtonText: "<i class='fa fa-remove'></i>"
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
