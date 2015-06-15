$ = jQuery

$ ->
  ##
  # @description TableTools初始化按钮时，让它能够弹出ToolTip
  ##
  initButtonToolTip = (nButton, oConfig) ->
    $(nButton).attr
      'data-toggle'   : 'tooltip'
      'data-placement': 'bottom'

  toggleButtonStateOnSelect = (nButton, oConfig, nRow) ->
    tableTool = TableTools.fnGetInstance('slidesTable')

    if tableTool.fnGetSelected().length == 1
      $(nButton).removeClass 'disabled'
    else
      $(nButton).addClass 'disabled'

  class Slide extends CommonDataTableObject
    constructor: (@tableId) ->
      super @tableId

    deleteSelectedRow: ->
      @actionUrl = "slides/#{@selectedRowData()[0]}"
      super

  $('#slidesTable').dataTable
    dom: "<'row'<'col-sm-6'T><'col-sm-6'f>><'row'<'col-sm-12'tr>><'row'<'col-sm-5'i><'col-sm-7'p>>"
    language:
      url: '/dataTables_zh_CN.json'
    columnDefs: [ { orderable: false, targets: [2, 3] } ]
    tableTools:
      sRowSelect: 'os'
      aButtons: [
        sButtonClass: "btn btn-flat btn-default"
        sExtends: "text"
        sButtonText: "<i class='fa fa-plus'></i>"
        sToolTip: "新建"
        fnInit: initButtonToolTip
      ,
        sButtonClass: "btn btn-flat btn-default disabled"
        sExtends: "text"
        sButtonText: "<i class='fa fa-edit'></i>"
        sToolTip: "编辑"
        fnInit: initButtonToolTip
        fnSelect: toggleButtonStateOnSelect
        fnClick: ->
          slide = new Slide 'slidesTable'
          slide.editSelectedRow() if slide.isSelectedOne()
      ,
        sButtonClass: "btn btn-flat btn-default disabled"
        sExtends: "text"
        sButtonText: "<i class='fa fa-trash-o'></i>"
        sToolTip: "删除"
        fnInit: initButtonToolTip
        fnSelect: toggleButtonStateOnSelect
        fnClick: ->
          slide = new Slide 'slidesTable'
          new TenderConfirmAlert('danger').alert '危险！这个操作将无法逆转。确认删除吗?', ->
            slide.deleteSelectedRow() if slide.isSelectedOne()
          , '危险'
      ]

