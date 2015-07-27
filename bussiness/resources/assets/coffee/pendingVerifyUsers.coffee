class @PendingVerifyUser extends CommonDataTableObject
  constructor: (@tableId) ->
    super @tableId

  aggree: ->
    @method    = 'PUT'
    @actionUrl = "/users/#{@selectedRowData().id}/aggree"
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
    tableTool = TableTools.fnGetInstance('pending-verify-users-table')

    if tableTool.fnGetSelected().length == 1
      $(nButton).removeClass 'disabled'
    else
      $(nButton).addClass 'disabled'

  $('#pending-verify-users-table').dataTable
    dom: "<'row'<'col-sm-6'T><'col-sm-6'f>><'row'<'col-sm-12'tr>><'row'<'col-sm-5'i><'col-sm-7'p>>"
    language:
      url: '/dataTables_zh_CN.json'
    processing: true
    serverSide: true
    columns: [
     { data: 'name',  orderable: false, name: 'users.name' },
     { data: 'truthname',  orderable: false, searchable: false },
     { data: 'telphone',   orderable: false, searchable: false  },
     { data: 'idcard',     orderable: false, searchable: false  },
     { data: 'is_verify',  orderable: false, searchable: false },
    ]
    ajax: '/users/server-pending-verify'
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
          pending = new PendingVerifyUser 'pending-verify-users-table'
          new TenderConfirmAlert('warning').alert '您确认同意用户认证申请吗？', ->
            pending.aggree() if pending.isSelectedOne()
      ]
