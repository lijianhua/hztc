$ = jQuery

class AdCategory extends CommonDataTableObject

$ ->
  toggleButtonStateOnSelect = (nButton, oConfig, nRow) ->
    tableTool = TableTools.fnGetInstance('adCategoriesTable')

  $('#adCategoriesTable').dataTable
    dom: "<'row'<'col-sm-6'T><'col-sm-6'f>><'row'<'col-sm-12'tr>><'row'<'col-sm-5'i><'col-sm-7'p>>"
    language:
      url: '/dataTables_zh_CN.json'
    processing: true
    serverSide: true
    columns: [
     { data: 'id', name: 'id' },
     { data: 'name', name: 'name'},
     { data: 'created_at', name: 'created_at'}
    ]
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
          alert 'hello'
      ,
        sButtonClass: "btn btn-flat btn-default disabled"
        sExtends: "text"
        sButtonText: "<i class='fa fa-edit'></i>"
        sToolTip: "编辑"
        fnInit: CommonDataTableObject.initButtonToolTip
        fnSelect: toggleButtonStateOnSelect
        fnClick: ->
          alert 'hello'
      ,
        sButtonClass: "btn btn-flat btn-default disabled"
        sExtends: "text"
        sButtonText: "<i class='fa fa-trash-o'></i>"
        sToolTip: "删除"
        fnInit: CommonDataTableObject.initButtonToolTip
        fnSelect: toggleButtonStateOnSelect
        fnClick: ->
          alert 'hello'
      ]
