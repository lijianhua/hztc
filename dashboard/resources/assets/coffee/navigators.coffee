$ = jQuery

$ ->
  $('#navigatorsTable').dataTable
    dom: "<'row'<'col-sm-6'><'col-sm-6'f>><'row'<'col-sm-12'tr>><'row'<'col-sm-5'i><'col-sm-7'p>>"
    order: [3, 'asc']
    columnDefs: [
      { orderable: false, targets: [0, 1] }
    ]
    language:
      url: '/dataTables_zh_CN.json'

