class @UnderwayRefund extends CommonDataTableObject
  constructor: (@tableId) ->
    super @tableId

  finish: ->
    @method    = 'PUT'
    @actionUrl = "/refunds/#{@selectedRowData().id}/finish"
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
    tableTool = TableTools.fnGetInstance('underway-refunds-table')

    if tableTool.fnGetSelected().length == 1
      $(nButton).removeClass 'disabled'
    else
      $(nButton).addClass 'disabled'

  $('#underway-refunds-table').dataTable
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
    ajax: '/refunds/server-underway'
    tableTools:
      sRowSelect: 'os'
      aButtons: [
        sButtonClass: "btn btn-flat btn-default disabled"
        sExtends: "text"
        sButtonText: "<i class='fa fa-paw fa-lg'></i>"
        sToolTip: "标记为完成退款"
        fnInit: CommonDataTableObject.initButtonToolTip
        fnSelect: toggleButtonStateOnSelect
        fnClick: ->
          underway = new UnderwayRefund 'underway-refunds-table'
          new TenderConfirmAlert('warning').alert '您确认已经完成退款？', ->
            underway.finish() if underway.isSelectedOne()
      ]


