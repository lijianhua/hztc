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
     { data: 'state', name: 'state', searchable: false },
    ]
    order: [[0, 'desc']]
    ajax: '/orders/server-proccessing'
