class @PendingRefund extends CommonDataTableObject
  constructor: (@tableId) ->
    super @tableId

  aggree: ->
    @method    = 'PUT'
    @actionUrl = "/refunds/#{@selectedRowData().id}/aggree"
    @ajax (response) ->
      if response.state == 'OK'
        @api().row(@selectedRow()).remove().draw false
        type = 'success'
      else
        type = 'danger'

      new TenderAlert(type).alert response.message
    , ->
      new TenderAlert('danger').alert '操作失败，请重试。'

    @actionUrl = null

  refuse: ->
    @method    = 'PUT'
    @actionUrl = "/refunds/#{@selectedRowData().id}/refuse"
    @ajax (response) ->
      if response.state == 'OK'
        @api().row(@selectedRow()).remove().draw false
        type = 'success'
      else
        type = 'danger'

      new TenderAlert(type).alert response.message
    , ->
      new TenderAlert('danger').alert '操作失败，请重试。'

    @actionUrl = null

$ = jQuery

$ ->
  toggleButtonStateOnSelect = (nButton, oConfig, nRow) ->
    tableTool = TableTools.fnGetInstance('pending-refunds-table')

    if tableTool.fnGetSelected().length == 1
      $(nButton).removeClass 'disabled'
    else
      $(nButton).addClass 'disabled'

  $('#pending-refunds-table').dataTable
    dom: "<'row'<'col-sm-6'T><'col-sm-6'f>><'row'<'col-sm-12'tr>><'row'<'col-sm-5'i><'col-sm-7'p>>"
    language:
      url: '/dataTables_zh_CN.json'
    processing: true
    serverSide: true
    columns: [
     { data: 'apply_at', searchable: false, orderable: false },
     { data: 'order_detail', name: 'order_seq', orderable: false },
     { data: 'amount',  searchable: false, orderable: false },
     { data: 'confirmed', searchable: false, orderable: false },
     { data: 'state', searchable: false, orderable: false },
    ]
    order: [[0, 'desc']]
    ajax: '/refunds/server-pending'
    tableTools:
      sRowSelect: 'os'
      aButtons: [
        sButtonClass: "btn btn-flat btn-default disabled"
        sExtends: "text"
        sButtonText: "<i class='fa fa-check fa-lg'></i>"
        sToolTip: "同意申请"
        fnInit: CommonDataTableObject.initButtonToolTip
        fnSelect: toggleButtonStateOnSelect
        fnClick: ->
          pending = new PendingRefund 'pending-refunds-table'
          new TenderConfirmAlert('warning').alert '您确认同意退款申请吗？', ->
            pending.aggree() if pending.isSelectedOne()
      ,
        sButtonClass: "btn btn-flat btn-default disabled"
        sExtends: "text"
        sButtonText: "<i class='fa fa-close fa-lg'></i>"
        sToolTip: "拒绝申请"
        fnInit: CommonDataTableObject.initButtonToolTip
        fnSelect: toggleButtonStateOnSelect
        fnClick: ->
          pending = new PendingRefund 'pending-refunds-table'
          new TenderConfirmAlert('warning').alert '您确认拒绝退款申请吗？', ->
            pending.refuse() if pending.isSelectedOne()
      ]

