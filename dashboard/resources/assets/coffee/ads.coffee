class @Ad extends CommonDataTableObject
  constructor: (@tableId) ->
    super @tableId

  deleteSelectedRow: ->
    @actionUrl = "/ads/#{@selectedRowData().id}"
    super

$ = jQuery

$ ->
  toggleButtonStateOnSelect = (nButton, oConfig, nRow) ->
    tableTool = TableTools.fnGetInstance('adsTable')

    if tableTool.fnGetSelected().length == 1
      $(nButton).removeClass 'disabled'
    else
      $(nButton).addClass 'disabled'

  $('#adsTable').dataTable
    dom: "<'row'<'col-sm-6'T><'col-sm-6'f>><'row'<'col-sm-12'tr>><'row'<'col-sm-5'i><'col-sm-7'p>>"
    language:
      url: '/dataTables_zh_CN.json'
    processing: true
    serverSide: true
    columns: [
     { data: 'title', name: 'title' },
     { data: 'type', searchable: false, orderable: false },
     { data: 'street_address',  searchable: false, orderable: false },
     { data: 'audited', searchable: false, orderable: false },
     { data: 'user.name', searchable: false, orderable: false },
     { data: 'user.enterprise.name', searchable: false, orderable: false },
     { data: 'created_at', name: 'created_at', searchable: false },
    ]
    order: [[6, 'desc']]
    ajax: '/ads/server-proccessing'
    tableTools:
      sRowSelect: 'os'
      aButtons: [
        sButtonClass: "btn btn-flat btn-default"
        sExtends: "text"
        sButtonText: "<i class='fa fa-plus'></i>"
        sToolTip: "新建"
        fnInit: CommonDataTableObject.initButtonToolTip
        fnClick: ->
          window.location = '/ad-spaces/create'
      ,
        sButtonClass: "btn btn-flat btn-default disabled"
        sExtends: "text"
        sButtonText: "<i class='fa fa-edit'></i>"
        sToolTip: "编辑"
        fnInit: CommonDataTableObject.initButtonToolTip
        fnSelect: toggleButtonStateOnSelect
        fnClick: ->
          ad = new Ad 'adsTable'
          window.location = "/ad-spaces/#{ad.selectedRowData().id}/edit"
      ,
        sButtonClass: "btn btn-flat btn-default disabled"
        sExtends: "text"
        sButtonText: "<i class='fa fa-trash-o'></i>"
        sToolTip: "删除"
        fnInit: CommonDataTableObject.initButtonToolTip
        fnSelect: toggleButtonStateOnSelect
        fnClick: ->
          ad = new Ad 'adsTable'
          new TenderConfirmAlert('danger').alert '危险！这个操作将无法逆转。确认删除吗?', ->
            ad.deleteSelectedRow() if ad.isSelectedOne()
          , '危险'
      ]
