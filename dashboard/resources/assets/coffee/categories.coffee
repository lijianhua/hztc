class @AdCategory extends CommonDataTableObject
  constructor: (@tableId) ->
    super @tableId

  deleteSelectedRow: ->
    @actionUrl = "/ad-categories/#{@selectedRowData().id}"
    super

  editSelectedRow: (fields) ->
    @actionUrl = "/ad-categories/#{@selectedRowData().id}"
    super fields

  new: (fields) ->
    @actionUrl = "/ad-categories"
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

  ###
  # 获取所有顶级分类
  ###
  roots: ->
    @__roots ||= []
    return @__roots if @__roots.length > 0

    @actionUrl = '/ad-categories/roots'
    @method    = 'GET'

    @ajax (result) ->
      for category in result
        @__roots.push
          label : category.name
          value : category.id

    @actionUrl = @method = undefined

    return @__roots

  options: ->
    options = @roots()
    options.unshift
      label : '未指定'
      value : null

    return options

$ = jQuery

$ ->
  toggleButtonStateOnSelect = (nButton, oConfig, nRow) ->
    tableTool = TableTools.fnGetInstance('adCategoriesTable')

    if tableTool.fnGetSelected().length == 1
      $(nButton).removeClass 'disabled'
    else
      $(nButton).addClass 'disabled'

  $('#adCategoriesTable').dataTable
    dom: "<'row'<'col-sm-6'T><'col-sm-6'f>><'row'<'col-sm-12'tr>><'row'<'col-sm-5'i><'col-sm-7'p>>"
    language:
      url: '/dataTables_zh_CN.json'
    processing: true
    serverSide: true
    columns: [
     { data: 'id', name: 'id', searchable: false },
     { data: 'name', name: 'name'},
     { data: 'parent.name', defaultContent: '', name: 'parent_id', searchable: false},
     { data: 'created_at', name: 'created_at', searchable: false}
    ]
    order: [[0, 'asc']]
    ajax: '/ad-categories/server-proccessing'
    tableTools:
      sRowSelect: 'os'
      aButtons: [
        sButtonClass: "btn btn-flat btn-default"
        sExtends: "text"
        sButtonText: "<i class='fa fa-plus'></i>"
        sToolTip: "新建"
        fnInit: CommonDataTableObject.initButtonToolTip
        fnClick: ->
          adCategory = new AdCategory 'adCategoriesTable'
          adCategory.new([
            name    : 'parent_id'
            label   : '上级分类'
            value   : null
            type    : 'select'
            options : adCategory.options()
            class   : 'form-control'
          ,
            name    : 'name'
            label   : '名称'
            value   : ''
            type    : 'text'
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
          adCategory = new AdCategory 'adCategoriesTable'
          if adCategory.isSelectedOne()
            adCategory.editSelectedRow([
              name    : 'parent_id'
              label   : '上级分类'
              value   : adCategory.selectedRowParentId()
              type    : 'select'
              options : adCategory.options()
              class   : 'form-control'
            ,
              name    : 'name'
              label   : '名称'
              value   : adCategory.selectedRowData().name
              type    : 'text'
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
          adCategory = new AdCategory 'adCategoriesTable'
          new TenderConfirmAlert('danger').alert '危险！这个操作将无法逆转。确认删除吗?', ->
            adCategory.deleteSelectedRow() if adCategory.isSelectedOne()
          , '危险'
      ]
