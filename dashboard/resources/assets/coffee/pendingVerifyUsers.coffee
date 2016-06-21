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

  refuse: ->
    @method    = 'PUT'
    @actionUrl = "/users/#{@selectedRowData().id}/refuse"
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

  deleteSelectedRow: ->
    @actionUrl = "/users/#{@selectedRowData().id}"
    super


  selectedRowParentId: ->
    parent = @selectedRowData().parent
    if parent
      return parent.id
    else
      return undefined

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
     { data: 'name',  orderable: false, name: 'users.name'},
     { data: 'phone',   name: 'users.phone'},
     { data: 'user_type',   orderable: false, searchable: false  },
     { data: 'progress',     orderable: false, searchable: false  },
     { data: 'user_code',     orderable: false, searchable: false  },
    ]
    ajax: '/users/server-pending-verify'
    tableTools:
      sRowSelect: 'os'
      aButtons: [
        sButtonClass: "btn btn-flat btn-default"
        sExtends: "text"
        sButtonText: "<i class='fa fa-plus'></i>"
        sToolTip: "新建"
        fnInit: CommonDataTableObject.initButtonToolTip
        fnClick: ->
          window.location = '/users/create'
      ,
        sButtonClass: "btn btn-flat btn-default disabled"
        sExtends: "text"
        sButtonText: "<i class='fa fa-edit'></i>"
        sToolTip: "编辑"
        fnInit: CommonDataTableObject.initButtonToolTip
        fnSelect: toggleButtonStateOnSelect
        fnClick: ->
          ad = new PendingVerifyUser 'pending-verify-users-table'
          window.location = "/users/#{ad.selectedRowData().id}/edit"
      ,
        sButtonClass: "btn btn-flat btn-default disabled"
        sExtends: "text"
        sButtonText: "<i class='fa fa-trash-o'></i>"
        sToolTip: "删除"
        fnInit: CommonDataTableObject.initButtonToolTip
        fnSelect: toggleButtonStateOnSelect
        fnClick: ->
          ad = new PendingVerifyUser 'pending-verify-users-table'
          new TenderConfirmAlert('danger').alert '危险！这个操作将无法逆转。确认删除吗?', ->
            ad.deleteSelectedRow() if ad.isSelectedOne()
          , '危险'
      ]
