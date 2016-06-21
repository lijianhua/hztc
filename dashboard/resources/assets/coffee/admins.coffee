class @Admin extends CommonDataTableObject
  constructor: (@tableId) ->
    @dangerAlert  = new TenderAlert 'danger'
    @successAlert = new TenderAlert 'success'
    super @tableId

  appointed: ->
    return @dangerAlert.alert '该用户已经是管理员' if @selectedRowData().admin == 1

    @actionUrl = "/admins/#{@selectedRowData().id}/appointed"
    @method    = 'PUT'
    @ajax (response) ->
      if response.state == 'OK'
        @api().draw()
        @successAlert.alert response.message
      else
        @dangerAlert.alert response.message
    ,
      ->
        @dangerAlert.alert '出现未知错误，请重试。'

  unappointed: ->
    return @dangerAlert.alert '该用户已经不是管理员' if @selectedRowData().admin == 0

    @actionUrl = "/admins/#{@selectedRowData().id}/unappointed"
    @method    = 'PUT'
    @ajax (response) ->
      if response.state == 'OK'
        @api().draw()
        @successAlert.alert response.message
      else
        @dangerAlert.alert response.message
    ,
      ->
        @dangerAlert.alert '出现未知错误，请重试。'

$ = jQuery

$ ->
  toggleButtonStateOnSelect = (nButton, oConfig, nRow) ->
    tableTool = TableTools.fnGetInstance('admins-table')

    if tableTool.fnGetSelected().length == 1
      $(nButton).removeClass 'disabled'
    else
      $(nButton).addClass 'disabled'

  $('#admins-table').dataTable
    dom: "<'row'<'col-sm-6'T><'col-sm-6'f>><'row'<'col-sm-12'tr>><'row'<'col-sm-5'i><'col-sm-7'p>>"
    language:
      url: '/dataTables_zh_CN.json'
    processing: true
    serverSide: true
    columns: [
     { data: 'user_name',  name: 'users.name' },
     { data: 'email', name: 'email' },
     { data: 'phone', name: 'users.phone' },
     { data: 'status', orderable: false, searchable: false },
     { data: 'created_at',  name: 'created_at', searchable: false }
    ]
    order: [[4, 'desc']]
    ajax: '/admins/server'
    tableTools:
      sRowSelect: 'os'
      aButtons: [
        sButtonClass: "btn btn-flat btn-default disabled"
        sExtends: "text"
        sButtonText: "<i class='fa fa-link'></i>"
        sToolTip: "设为管理员"
        fnInit: CommonDataTableObject.initButtonToolTip
        fnSelect: toggleButtonStateOnSelect
        fnClick: ->
          admin = new Admin 'admins-table'
          new TenderConfirmAlert('warning').alert '确定设该用户为管理员吗？', ->
            admin.appointed() if admin.isSelectedOne()
      ,
        sButtonClass: "btn btn-flat btn-default disabled"
        sExtends: "text"
        sButtonText: "<i class='fa fa-unlink'></i>"
        sToolTip: "撤销管理员"
        fnInit: CommonDataTableObject.initButtonToolTip
        fnSelect: toggleButtonStateOnSelect
        fnClick: ->
          admin = new Admin 'admins-table'
          new TenderConfirmAlert('warning').alert '确定撤销该管理员吗？', ->
            admin.unappointed() if admin.isSelectedOne()
      ]


