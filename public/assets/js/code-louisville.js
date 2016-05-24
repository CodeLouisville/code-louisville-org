var App = {
    attachHandlers: function () {

        $('[data-toggle="tooltip"]').tooltip()

        App.bubble.on('click', 'a[href^="#"]', function(e)
        {
            e.preventDefault()
            App.scrollTo($(this.hash))
        })

        $('body').on('affix.bs.affix', function(){

            var $subnav = $('.subnav'),
                $button = $subnav.find('.button'),
                width = $subnav.outerWidth()

            $subnav.css('width', width)
            $button.css('width', width)
        })

        $('body').on('affix-top.bs.affix', function(){

            var $subnav = $('.subnav'),
                $button = $subnav.find('.button')

            $subnav.css('width', 'auto')
            $button.css('width', '100%')
        })
    },
    bubble: $('body'),
    init: function () {
        App.attachHandlers()
    },
    scrollTo: function($t)
    {
        var top = $t.offset().top - 95
        console.log(top)
        $('html, body').stop().animate({
            'scrollTop': top
        }, 400, 'swing', function(){
            window.location.hash = $t.attr('id')
        })
    }
}

App.init()
