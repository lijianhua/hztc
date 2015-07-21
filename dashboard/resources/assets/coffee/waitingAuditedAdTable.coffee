$ = jQuery

$ ->
  $('#waitingAuditedAdTable').dataTable
    dom: "<'row'<'col-sm-12'f>><'row'<'col-sm-12'tr>><'row'<'col-sm-5'i><'col-sm-7'p>>"
    language:
      url: '/dataTables_zh_CN.json'
    processing: true
    serverSide: true
    columns: [
     { data: 'title', name: 'title' },
     { data: 'type', searchable: false, orderable: false },
     { data: 'street_address',  searchable: false, orderable: false },
     { data: 'audited', searchable: false, orderable: false },
     { data: 'user.name', searchable: false, orderable: false },
     { data: 'user.enterprise.name', searchable: false, orderable: false },
     { data: 'created_at', name: 'created_at', searchable: false },
    ]
    order: [[6, 'desc']]
    ajax: '/ads/waiting-audited-server-proccessing'
