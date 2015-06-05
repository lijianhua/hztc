class @TenderAlert
  ###
  # @param type 通知的种类
  # @param autodismiss 是否自动消失
  # @param container 通知出现在的选择器
  ###
  constructor: (@type, @autodismiss = true, @container = 'section.content') ->
    @types = ['danger', 'success', 'info', 'warning']
    throw "TenderAlert require jQuery" unless window.jQuery
    throw "Unrecognizable type, the type of alert should be success, info, warning or danger" unless @type in @types

  alert: (message, title = '通知') ->
    throw "Message should not be empty" unless message && message.length > 0
    messageBody = window.jQuery(@messageBody(title, message))
    @display messageBody
    @autoDismiss messageBody if @autodismiss

  alertIconSign: ->
    switch @type
      when 'danger'  then 'ban'
      when 'success' then 'check'
      when 'info'    then 'info'
      when 'warning' then 'warning'

  messageBody: (title, message) ->
    """
    <div class="alert alert-#{@type} alert-dismissable">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
      <h4><i class="fa fa-#{@alertIconSign()}"></i>#{title}</h4>
      <p>#{message}</p>
    </div>
    """

  display: (message) ->
    window.jQuery(@container).prepend message

  autoDismiss: (message) ->
    setTimeout ->
      message.animate {opacity: 0}, 2000, ->
        message.remove()
    , 3000

class @TenderConfirmAlert extends @TenderAlert
  constructor: (@type) ->
    super @type, false

  alert: (message, callback, title) ->
    super message, title

    @alertMessage.on 'click', '.btn-action', {alertMessage: @alertMessage}, (event) ->
      self = @
      window.jQuery(self).html '<i class="fa fa-spinner fa-pulse"></i>'
      setTimeout ->
        callback() if callback
        event.data.alertMessage.alert 'close'
      , 200

  messageBody: (title, message) ->
    messageBody = super title, message
    actionBody  =
      """
      <p style="margin-top: 10px;">
        <button class="btn btn-defaul btn-flat btn-#{@type} btn-action" type="button">确认</button>
        <button class="btn btn-default btn-flat" data-dismiss="alert">取消</button>
      </p>
      """

    messageBody = window.jQuery(messageBody).append(actionBody).css
      position    : 'absolute'
      width       : 'auto'
      'max-width' : '100%'
      'z-index'   : '2'
      'box-shadow': '0 0 10px 5px rgba(0, 0, 0, 0.3)'
      left        : (window.jQuery(@container).innerWidth() - window.jQuery(messageBody).innerWidth()) / 2
      top         : (window.jQuery(@container).innerHeight() - window.jQuery(messageBody).innerHeight()) / 2

    @alertMessage = messageBody
    @alertMessage
