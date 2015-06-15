###
# 对于 DataTable 中的数据对象封装
# 可以用来操作数据表格
###
class @CommonDataTableObject
  ###
  # @param tableId id of DataTable element
  ###
  constructor: (@tableId) ->
    throw "Requir table tools extension of data table." unless window.TableTools
    throw "Require jQuery" unless window.jQuery
    @tableTool = @getTableToolInstance()

  ###
  # 根据 tableId 获取TableTool对象
  ###
  getTableToolInstance: ->
    TableTools.fnGetInstance @tableId

  ###
  # 判断是不是只有一行被选中了
  ###
  isSelectedOne: ->
    @selectedRows().length == 1

  ###
  # 获取被选中的行
  ###
  selectedRowsData: ->
    @tableTool.fnGetSelectedData()

  selectedRowData: ->
    @isSelectedOne() && @selectedRowsData()[0]

  selectedRows: ->
    @tableTool.fnGetSelected()

  selectedRow: ->
    @tableTool.fnGetSelected()[0]

  ###
  # 获取DataTable api
  ###
  api: ->
    window.jQuery("##{@tableId}").dataTable().api(true)

  ###
  # 删除被选中的行
  # 需要子类提供 actionUrl
  ###
  deleteSelectedRow: ->
    @method   = 'DELETE'
    @dataType = 'json'
    throw 'Require to set actionUrl in subclass' unless @actionUrl
    @ajax (response) ->
      @api().row(@selectedRow()).remove().draw()
      new TenderAlert('success').alert response.message
    , ->
      new TenderAlert('danger').alert '删除失败，请重试。'
    # 重置 actionUrl
    @actionUrl = null

  editSelectedRow: ->
    @method     = 'PUT'
    @dataType   = 'json'
    @modalTitle = '编辑'
    throw 'Require to set actionUrl in subClass' unless @actionUrl

    # 弹出编辑窗口
    @popUpForm()

  ###
  # 进行 Ajax 同步请求
  ###
  ajax: (successCallback = null, errorCallback = null) ->
    $ = window.jQuery
    $.ajax
      url      : @actionUrl
      async    : false
      method   : @method
      dataType : @dataType
      context  : @
      success  : successCallback
      error    : errorCallback
      headers  :
        'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')

