$ = jQuery

$ ->
  toggleButtonStateOnSelect = (nButton, oConfig, nRow) ->
    tableTool = TableTools.fnGetInstance('slideItemsTable')

    if tableTool.fnGetSelected().length == 1
      $(nButton).removeClass 'disabled'
    else
      $(nButton).addClass 'disabled'

  class SlideItem extends CommonDataTableObject
    constructor: (@tableId) ->
      super @tableId

    deleteSelectedRow: ->
      @actionUrl = "/slides/#{@selectedRowData()[5]}/slide-items/#{@selectedRowData()[0]}"
      super

    editSelectedRow: (fields) ->
      @actionUrl = "slide-items/#{@selectedRowData()[0]}"
      super fields

    new: (fields) ->
      @actionUrl = "slide-items"
      super fields

  $('#slideItemsTable').dataTable
    dom: "<'row'<'col-sm-12'T>><'row'<'col-sm-12'tr>><'row'<'col-sm-5'i><'col-sm-7'p>>"
    order: [4, 'asc']
    language:
      url: '/dataTables_zh_CN.json'
    columnDefs: [ { orderable: false, targets: [1, 2, 3] }, { visible: false, targets: [5]} ]
    tableTools:
      sRowSelect: 'os'
      aButtons: [
        sButtonClass: "btn btn-flat btn-default"
        sExtends: "text"
        sButtonText: "<i class='fa fa-plus'></i>"
        sToolTip: "新建"
        fnInit: SlideItem.initButtonToolTip
        fnClick: ->
          slideItem = new SlideItem 'slideItemsTable'
          slideItem.new([
            name   : 'belongs_page'
            label  : '属于'
            value  : ''
            type   : 'text'
          ])
      ,
        sButtonClass: "btn btn-flat btn-default disabled"
        sExtends: "text"
        sButtonText: "<i class='fa fa-edit'></i>"
        sToolTip: "编辑"
        fnInit: SlideItem.initButtonToolTip
        fnSelect: toggleButtonStateOnSelect
        fnClick: ->
          slideItem = new SlideItem 'slideItemsTable'
          if slideItem.isSelectedOne()
            slideItem.editSelectedRow([
              name   : 'id'
              value  : slideItem.selectedRowData()[0]
              type   : 'hidden'
            ,
              name   : 'belongs_page'
              label  : '属于'
              value  : $(slideItem.selectedRowData()[1]).text().trim()
              type   : 'text'
            ])
      ,
        sButtonClass: "btn btn-flat btn-default disabled"
        sExtends: "text"
        sButtonText: "<i class='fa fa-trash-o'></i>"
        sToolTip: "删除"
        fnInit: SlideItem.initButtonToolTip
        fnSelect: toggleButtonStateOnSelect
        fnClick: ->
          slideItem = new SlideItem 'slideItemsTable'
          new TenderConfirmAlert('danger').alert '危险！这个操作将无法逆转。确认删除吗?', ->
            slideItem.deleteSelectedRow() if slideItem.isSelectedOne()
          , '危险'
      ]

