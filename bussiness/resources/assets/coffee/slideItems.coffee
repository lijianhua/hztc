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
      @fileUpload = true
      super @tableId

    deleteSelectedRow: ->
      @actionUrl = "/slides/#{@selectedRowData()[5]}/slide-items/#{@selectedRowData()[0]}"
      super

    editSelectedRow: (fields) ->
      @actionUrl = "/slides/#{@selectedRowData()[5]}/slide-items/#{@selectedRowData()[0]}"
      super fields

    new: (fields) ->
      @actionUrl = "/slide-items"
      super fields

    slideId: ->
      $("##{@tableId}").attr('data-slide-id')

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
              name   : 'slide_id'
              value  : slideItem.slideId()
              type   : 'hidden'
            ,
              name   : 'picture'
              label  : '图片'
              type   : 'image'
              class  : 'form-control'
            ,
              name   : 'url'
              label  : '链接'
              value  : ''
              type   : 'text'
            ,
              name   : 'note'
              label  : '备注'
              value  : ''
              type   : 'textarea'
              class  : 'form-control'
              rows   : 3
            ,
              name   : 'sort'
              label  : '排序'
              value  : 0
              type   : 'number'
              min    : 0
              class  : 'form-control'
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
              name   : 'slide_id'
              value  : slideItem.selectedRowData()[5]
              type   : 'hidden'
            ,
              name   : 'picture'
              label  : '图片'
              type   : 'image'
              class  : 'form-control'
            ,
              name   : 'url'
              label  : '链接'
              value  : slideItem.selectedRowData()[2]
              type   : 'text'
            ,
              name   : 'note'
              label  : '备注'
              value  : slideItem.selectedRowData()[3]
              type   : 'textarea'
              class  : 'form-control'
              rows   : 3
            ,
              name   : 'sort'
              label  : '排序'
              value  : parseInt(slideItem.selectedRowData()[4])
              type   : 'number'
              min    : 0
              class  : 'form-control'
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

