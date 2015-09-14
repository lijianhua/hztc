class @Order extends CommonDataTableObject
  constructor: (@tableId) ->
    super @tableId

$ = jQuery

$ ->
  $('#ordersTable').dataTable
    dom: "<'row'<'col-sm-6'><'col-sm-6'f>><'row'<'col-sm-12'tr>><'row'<'col-sm-5'i><'col-sm-7'p>>"
    language:
      url: '/dataTables_zh_CN.json'
    processing: true
    serverSide: true
    columns: [
     { data: 'created_at', searchable: false, orderable: false },
     { data: 'order_detail', name: 'order_seq', orderable: false },
     { data: 'amount',  searchable: false, orderable: false },
     { data: 'user.name', searchable: false, orderable: false },
     { data: 'state', name: 'state' },
    ]
    order: [[0, 'desc']]
    ajax: '/orders/server-proccessing'
    initComplete: ->
      table  = @
      ele    = """
                <div id="ordersTable_state_filter" class="ordersTable_state_filter">
                  <label>
                  订单状态:
                  </label>
                  <select>
                    <option value="">全部订单</option>
                    <option value="0">未付款</option>
                    <option value="1">已付款</option>
                    <option value="2">待投放</option>
                    <option value="3">待确认</option>
                    <option value="4">已完成</option>
                  </select>
                </div>
                """
      $(ele).appendTo('#ordersTable_wrapper .col-sm-6:eq(0)').find('select')
        .on 'change', ->
          val = $(@).val()
          table.api().columns(4).search(val).draw()
