$ = jQuery

$ ->
  toggleButtonStateOnSelect = (nButton, oConfig, nRow) ->
    tableTool = TableTools.fnGetInstance('promotions-table')

    if tableTool.fnGetSelected().length == 1
      $(nButton).removeClass 'disabled'
    else
      $(nButton).addClass 'disabled'

  $('#promotions-table').dataTable
    dom: "<'row'<'col-sm-6'T><'col-sm-6'f>><'row'<'col-sm-12'tr>><'row'<'col-sm-5'i><'col-sm-7'p>>"
    language:
      url: '/dataTables_zh_CN.json'
    processing: true
    serverSide: true
    columns: [
     { data: 'created_at', 'name': 'created_at' , searchable: false },
     { data: 'ad',  name: 'title', orderable: false },
     { data: 'state', searchable: false, orderable: false },
    ]
    order: [[0, 'desc']]
    ajax: '/promotions/server'
    tableTools:
      sRowSelect: 'os'
      aButtons: [
        sButtonClass: "btn btn-flat btn-default"
        sExtends: "text"
        sButtonText: "<i class='fa fa-plus'></i>"
        sToolTip: "创建秒杀"
        fnInit: CommonDataTableObject.initButtonToolTip
        fnClick: ->
          window.location = '/promotions/create'
      ,

        sButtonClass: "btn btn-flat btn-default disabled"
        sExtends: "text"
        sButtonText: "<i class='fa fa-edit'></i>"
        sToolTip: "编辑"
        fnInit: CommonDataTableObject.initButtonToolTip
        fnSelect: toggleButtonStateOnSelect
        fnClick: ->
          promotion = new Promotion 'promotions-table'

          if promotion.isSelectedOne()
            promotion.editSelectedRow([
              name  : 'ad_space_id'
              value : promotion.selectedRowData().ad_space_id
              type  : 'hidden'
            ,
              name  : 'title'
              label : '标题'
              type  : 'text'
              value : promotion.selectedRowData().title
            ,
              name  : 'stock'
              label : '库存'
              value : promotion.selectedRowData().stock
              type  : 'hidden'
            ,
              name  : 'price'
              label : '价格'
              value : promotion.selectedRowData().price
              type  : 'hidden'
            ,
              name  : 'start'
              label : '开始时间'
              type  : 'datetime'
              class : 'form-control'
              value : promotion.selectedRowData().start
            ,
              name  : 'end'
              label : '结束时间'
              type  : 'datetime'
              class : 'form-control'
              value : promotion.selectedRowData().end
            ])
      ,
        sButtonClass: "btn btn-flat btn-default disabled"
        sExtends: "text"
        sButtonText: "<i class='fa fa-trash-o'></i>"
        sToolTip: "删除"
        fnInit: CommonDataTableObject.initButtonToolTip
        fnSelect: toggleButtonStateOnSelect
        fnClick: ->
          promotion = new Promotion 'promotions-table'
          new TenderConfirmAlert('danger').alert '危险！这个操作将无法逆转。确认删除吗?', ->
            promotion.deleteSelectedRow() if promotion.isSelectedOne()
          , '危险'
      ]


