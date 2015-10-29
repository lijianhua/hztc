class @AdCenter extends CommonDataTableObject
  constructor: (@tableId) ->
    super @tableId

  deleteSelectedRow: ->
    @actionUrl = "/ad-centers/#{@selectedRowData()[0]}"
    super

  editSelectedRow: (fields) ->
    @actionUrl = "/ad-centers/#{@selectedRowData()[0]}"
    super fields

  new: (fields) ->
    @actionUrl = "/ad-centers"
    super fields


  ###
  # 获取选中分类的父id
  ###
  selectedRowParentId: ->
    parent = @selectedRowData().parent
    if parent
      return parent.id
    else
      return undefined

$ = jQuery

$ ->
  toggleButtonStateOnSelect = (nButton, oConfig, nRow) ->
    tableTool = TableTools.fnGetInstance('adCentersTable')

    if tableTool.fnGetSelected().length == 1
      $(nButton).removeClass 'disabled'
    else
      $(nButton).addClass 'disabled'

  $('#adCentersTable').dataTable
    dom: "<'row'<'col-sm-6'T><'col-sm-6'>><'row'<'col-sm-12'tr>><'row'<'col-sm-5'i><'col-sm-7'p>>"
    language:
      url: '/dataTables_zh_CN.json'
    order: [[0, 'asc']]
    tableTools:
      sRowSelect: 'os'
      aButtons: [
        sButtonClass: "btn btn-flat btn-default"
        sExtends: "text"
        sButtonText: "<i class='fa fa-plus'></i>"
        sToolTip: "新建"
        fnInit: CommonDataTableObject.initButtonToolTip
        fnClick: ->
          adCenter = new AdCenter 'adCentersTable'
          adCenter.new([
            name    : 'name'
            label   : '名称'
            value   : ''
            type    : 'text'
            class   : 'form-control'
          ,
            name    : 'avatar'
            label   : '图标(145 x 100)'
            type    : 'image'
            class   : 'form-control'
          ])
      ,
        sButtonClass: "btn btn-flat btn-default disabled"
        sExtends: "text"
        sButtonText: "<i class='fa fa-edit'></i>"
        sToolTip: "编辑"
        fnInit: CommonDataTableObject.initButtonToolTip
        fnSelect: toggleButtonStateOnSelect
        fnClick: ->
          adCenter = new AdCenter 'adCentersTable'
          if adCenter.isSelectedOne()
            adCenter.editSelectedRow([
              name    : 'name'
              label   : '名称'
              value   : adCenter.selectedRowData()[1]
              type    : 'text'
              class   : 'form-control'
            ,
              name    : 'avatar'
              label   : '图标(145 x 100)'
              type    : 'image'
              class   : 'form-control'
            ])
      ,
        sButtonClass: "btn btn-flat btn-default disabled"
        sExtends: "text"
        sButtonText: "<i class='fa fa-trash-o'></i>"
        sToolTip: "删除"
        fnInit: CommonDataTableObject.initButtonToolTip
        fnSelect: toggleButtonStateOnSelect
        fnClick: ->
          adCenter = new AdCenter 'adCentersTable'
          new TenderConfirmAlert('danger').alert '危险！这个操作将无法逆转。确认删除吗?', ->
            adCenter.deleteSelectedRow() if adCenter.isSelectedOne()
          , '危险'
      ]

