class @Promotion extends CommonDataTableObject
  new: (fileds) ->
    @actionUrl = '/promotions'
    super fileds
    @initDateTimePicker()

  initDateTimePicker: ->
    window.jQuery('input[type=datetime]').daterangepicker
      locale:
        applyLabel       : '确定'
        cancelLabel      : '取消'
        fromLabel        : '起始'
        toLabel          : '截止'
        customRangeLabel : '自定义'
        daysOfWeek       : ['日', '一', '二', '三', '四', '五', '六']
        monthNames       : [
          '一月', '二月', '三月', '四月',
          '五月', '六月', '七月', '八月',
          '九月', '十月', '十一月', '十二月'
        ]
        firstDay         : 1
      format             : 'YYYY/MM/DD HH:mm'
      timePicker         : true
      singleDatePicker   : true
      timePicker24Hour   : true
      drops              : 'up'

$ = jQuery

$ ->
  toggleButtonStateOnSelect = (nButton, oConfig, nRow) ->
    tableTool = TableTools.fnGetInstance('create-promotion-table')

    if tableTool.fnGetSelected().length == 1
      $(nButton).removeClass 'disabled'
    else
      $(nButton).addClass 'disabled'

  $('#create-promotion-table').dataTable
    dom: "<'row'<'col-sm-6'T><'col-sm-6'f>><'row'<'col-sm-12'tr>><'row'<'col-sm-5'i><'col-sm-7'p>>"
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
    ajax: '/ads/server-proccessing'
    tableTools:
      sRowSelect: 'os'
      aButtons: [
        sButtonClass: "btn btn-flat btn-default disabled"
        sExtends: "text"
        sButtonText: "<i class='fa fa-plus'></i>"
        sToolTip: "为选定的广告位创建秒杀"
        fnInit: CommonDataTableObject.initButtonToolTip
        fnSelect: toggleButtonStateOnSelect
        fnClick: ->
          promotion = new Promotion 'create-promotion-table'

          if promotion.isSelectedOne()
            promotion.new([
              name  : 'ad_space_id'
              value : promotion.selectedRowData().id
              type  : 'hidden'
            ,
              name  : 'title'
              label : '标题'
              type  : 'text'
              value : ''
            ,
              name  : 'stock'
              label : '库存'
              value : 1
              type  : 'number'
              class : 'form-control'
            ,
              name  : 'price'
              label : '价格'
              value : 0
              type  : 'text'
            ,
              name  : 'start'
              label : '开始时间'
              type  : 'datetime'
              class : 'form-control'
            ,
              name  : 'end'
              label : '结束时间'
              type  : 'datetime'
              class : 'form-control'
            ])
      ]

