class @NewestOrder extends CommonDataTableObject
  constructor: (@tableId) ->
    super @tableId

  confirm: ->
    @method    = 'PUT'
    @actionUrl = "/orders/confirm/#{@selectedRowData().id}"
    @ajax (response) ->
      if response.state == 'OK'
        @api().row(@selectedRow()).remove().draw false
        type = 'success'
      else
        type = 'danger'

      new TenderAlert(type).alert response.message
    , ->
      new TenderAlert('danger').alert '标记失败，请重试。'

    @actionUrl = null

$ = jQuery

$ ->
  toggleButtonStateOnSelect = (nButton, oConfig, nRow) ->
    tableTool = TableTools.fnGetInstance('newestOrdersTable')

    if tableTool.fnGetSelected().length == 1
      $(nButton).removeClass 'disabled'
    else
      $(nButton).addClass 'disabled'

  $('#newestOrdersTable').dataTable
    dom: "<'row'<'col-sm-6'T><'col-sm-6'f>><'row'<'col-sm-12'tr>><'row'<'col-sm-5'i><'col-sm-7'p>>"
    language:
      url: '/dataTables_zh_CN.json'
    processing: true
    serverSide: true
    columns: [
     { data: 'created_at', searchable: false, orderable: false },
     { data: 'order_detail', name: 'order_seq', orderable: false },
     { data: 'amount',  searchable: false, orderable: false },
     { data: 'user.name', searchable: false, orderable: false },
     { data: 'state', searchable: false, orderable: false },
    ]
    order: [[0, 'desc']]
    ajax: '/orders/server-newest'
    tableTools:
      sRowSelect: 'os'
      aButtons: [
        sButtonClass: "btn btn-flat btn-default disabled"
        sExtends: "text"
        sButtonText: "<i class='fa fa-paw fa-lg'></i>"
        sToolTip: "标记为已接单"
        fnInit: CommonDataTableObject.initButtonToolTip
        fnSelect: toggleButtonStateOnSelect
        fnClick: ->
          newest = new NewestOrder 'newestOrdersTable'
          new TenderConfirmAlert('warning').alert '您确认标记为已接单吗？', ->
            newest.confirm() if newest.isSelectedOne()
      ]

