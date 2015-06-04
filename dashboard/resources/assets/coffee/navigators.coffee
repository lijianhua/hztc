$ = jQuery

$ ->
  $('#navigatorsTable').dataTable
    dom: "<'row'<'col-sm-6'T><'col-sm-6'f>><'row'<'col-sm-12'tr>><'row'<'col-sm-5'i><'col-sm-7'p>>"
    order: [3, 'asc']
    columnDefs: [
      { orderable: false, targets: [0, 1] }
    ]
    language:
      url: '/dataTables_zh_CN.json'
    tableTools:
      sRowSelect: 'os'
      aButtons: [
        {
          sButtonClass: "btn btn-flat btn-default"
          sExtends: "text"
          sButtonText: "<i class='fa fa-plus'></i>"
          sToolTip: "新建"
          fnInit: (nButton, oConfig) ->
            $(nButton).attr
              'data-toggle': 'tooltip'
              'data-placement': 'bottom'
          fnClick: ->
            alert 'plus'
        },
        {
          sButtonClass: "btn btn-flat btn-default disabled"
          sExtends: "text"
          sButtonText: "<i class='fa fa-edit'></i>"
          sToolTip: "编辑"
          fnInit: (nButton, oConfig) ->
            $(nButton).attr
              'data-toggle': 'tooltip'
              'data-placement': 'bottom'
          fnClick: ->
            alert 'edit'
        },
        {
          sButtonClass: "btn btn-flat btn-default disabled"
          sExtends: "text"
          sButtonText: "<i class='fa fa-remove'></i>"
          sToolTip: "删除"
          fnInit: (nButton, oConfig) ->
            $(nButton).attr
              'data-toggle': 'tooltip'
              'data-placement': 'bottom'
          fnClick: ->
            alert 'remove'
        },
        {
          sButtonClass: "btn btn-flat btn-default disabled"
          sExtends: "text"
          sButtonText: "<i class='fa fa-toggle-off'></i>"
          sToolTip: "停用/启用"
          fnInit: (nButton, oConfig) ->
            $(nButton).attr
              'data-toggle': 'tooltip'
              'data-placement': 'bottom'
          fnClick: ->
            alert 'remove'
        }
      ]
