$ = jQuery
$ ->
  ele = document.getElementById 'editEnterpriseAccount'

  return false unless ele

  initCKEditor = ->
    CKEDITOR.basePath = '/editor/'
    CKEDITOR.replace 'ckeditor', {
      filebrowserImageUploadUrl: '/ckeditor/upload',
      contentsCss: '/editor/contents.css',
      height: 500
    }

  initCKEditor()
