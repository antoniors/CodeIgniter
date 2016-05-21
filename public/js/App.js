var menuLinks = $('.sidebar-nav-menu');
menuLinks.on('click', function (e) {
    var link = $(this);

    // If we are in mini sidebar mode

        if (link.hasClass('open')) {
            link.removeClass('open');
        }
        else {
            $('#sidebar .sidebar-nav-menu.open').removeClass('open');
            link.addClass('open');
        }


    return false;
});

AppConfig = {
    toogleSidebar : function() {

        var sidebar = $('#page-container');

        if ( sidebar.hasClass('sidebar-visible-xs') ) {
            sidebar.removeClass('sidebar-visible-xs');
        } else {
            sidebar.addClass('sidebar-visible-xs');
        }

    }
}


$('#sidebar-scroll').slimScroll({
        height: $('.sidebar-nav').outerHeight() - 100,
        color: '#71c5e8',
        size: '5px',
        touchScrollStep: 100,
        railVisible: false,
        opacity: .9
    });



var mq = window.matchMedia('all and (max-width: 700px)');
if(mq.matches) {
    // the width of browser is more then 700px
} else {
    // the width of browser is less then 700px
}

mq.addListener(function(changed) {
    if(changed.matches) {
        $('#sidebar-scroll').slimScroll({destroy: true});
        $('#sidebar-scroll').slimScroll({
            height: $('.sidebar-nav').outerHeight() + 100,
            color: '#71c5e8',
            size: '5px',
            touchScrollStep: 100,
            railVisible: false,
            opacity: .9
        });
    } else {
        // the width of browser is less then 700px
    }
});