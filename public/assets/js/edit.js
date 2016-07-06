var Edit = {
    attachHandlers: function () {

        Edit.bubble.on('click', '[data-editable]:not([contenteditable])', function(e)
        {
            Edit.edit($(this), e.metaKey)
        })

        Edit.bubble.on('focusout', '[data-editable][contenteditable]', function()
        {
            Edit.save($(this))
        })

        Edit.bubble.on('click', '.save', function(e)
        {
            Edit.save($('#ace-editor'))
        })

        Edit.bubble.on('click', '.create', function(e)
        {
            e.preventDefault()
            Edit.createContent($(this))
        })

        Edit.bubble.on('click', '.delete', function(e)
        {
            Edit.delete($('[name="content"]'))
        })

        Edit.bubble.on('shown.bs.modal', function(){
            var $editor = $('<div/>').attr('id', 'ace-editor').data('key', Edit.editorKey).data('group', Edit.editorGroup)
            $('.modal-body').append($editor)
            Edit.editor = ace.edit("ace-editor")
            Edit.editor.getSession().setMode("ace/mode/html")
            Edit.editor.getSession().setUseWrapMode(true)
            Edit.editor.setValue(Edit.editorContent)
        })

        Edit.bubble.on('hidden.bs.modal', function(){
            Edit.editor.destroy()
            Edit.editor.container.remove()
        })
    },
    bubble: $('body'),
    createContent: function($_)
    {
        var g = $_.data('group'),
            t = $('[name="_token"]').val()

        $.ajax({
            type: 'PUT',
            url: '/api/content/create',
            data: 'group=' + g + '&_token=' + t,
            dataType: 'json',
            success: function(){
                window.location.reload()
            }
        })
    },
    delete: function($_)
    {
        var k = $_.data('key'),
            t = $('[name="_token"]').val()

        $('.modal').modal('hide')
        $('[data-editable][data-key="' + k + '"]').detach()

        $.ajax({
            type: 'DELETE',
            url: '/api/content',
            data: 'key=' + k + '&_token=' + t,
            dataType: 'json'
        })
    },
    edit: function($_, m)
    {
        var key = $_.data('key'),
            group = $_.data('group'),
            $modal = $('.modal'),
            $screen = $('<div/>').addClass('screen'),
            content = $_.html()

        if(m)
        {
            if(group)
            {
                $modal.find('.delete').show();
            }
            else
            {
                $modal.find('.delete').hide();
            }

            Edit.editorKey = key
            Edit.editorGroup = group
            Edit.editorContent = content.replace(/\s\s+/g,'')
            $modal.modal('show')
        }
        else
        {
            $('body').append($screen)
            $_.attr('contenteditable', true)
            $_.focus()
        }
    },
    init: function () {
        Edit.attachHandlers()
    },
    putContent: function(k, v, g, t)
    {
        g = typeof g !== 'undefined' ? g : ''

        $.ajax({
            type: 'PUT',
            url: '/api/content',
            data: 'key=' + k + '&content=' + v + '&group=' + g + '&_token=' + t,
            dataType: 'json'
        })
    },
    save: function($_)
    {
        var t = $('[name="_token"]').val(),
            k = $_.data('key'),
            v = Edit.editor.getValue(),
            g = $_.data('group')

        Edit.putContent(k, v, g, t)

        $('[data-editable][data-key="' + k + '"]').html(v)

        $('.screen').remove()
        $_.removeAttr('contenteditable')
        $('.modal').modal('hide');

    }
}

Edit.init()
