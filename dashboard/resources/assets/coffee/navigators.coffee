$ = jQuery

$ ->

  dangerAlert  = new TenderAlert 'danger'
  successAlert = new TenderAlert 'success'
  warningAlert = new TenderAlert 'warning'
  infoAlert    = new TenderAlert 'info'

  dangerConfirmAlert = new TenderConfirmAlert 'danger'

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

  ##
  # @description 初始化DataTable
  ##
  $('#navigatorsTable').dataTable
    dom: "<'row'<'col-sm-6'T><'col-sm-6'f>><'row'<'col-sm-12'tr>><'row'<'col-sm-5'i><'col-sm-7'p>>"
    order: [3, 'asc']
    columnDefs: [
      { orderable: false, targets: [0, 1] }
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
            alert 'edit'
        },
        {
          sButtonClass: "btn btn-flat btn-default disabled"
          sExtends: "text"
          sButtonText: "<i class='fa fa-remove'></i>"
          sToolTip: "删除"
          fnInit: initButtonToolTip
          fnSelect: toggleButtonStateOnSelect
          fnClick: ->
            dangerConfirmAlert.alert '危险！这个操作将无法逆转。确认删除吗？', ->
              console.log 'hello'
        },
        {
          sButtonClass: "btn btn-flat btn-default disabled"
          sExtends: "text"
          sButtonText: "<i class='fa fa-toggle-off'></i>"
          sToolTip: "停用/启用"
          fnInit: initButtonToolTip
          fnSelect: toggleButtonStateOnSelect
          fnClick: ->
            alert 'turn on / off'
        }
      ]
