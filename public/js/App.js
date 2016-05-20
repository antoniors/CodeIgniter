new Morris.Line({
    // ID of the element in which to draw the chart.
    element: 'myfirstchart',
    // Chart data records -- each entry in this array corresponds to a point on
    // the chart.
    data: [
        /*{ year: '2008', value: 20 },
         { year: '2009', value: 10 },
         { year: '2010', value: 5 },
         { year: '2011', value: 5 },
         { year: '2012', value: 20 }*/
        {fecha: '2016-05-15', diaFecha : 15,  dia : 'D', diaLargo: 'Domingo', value: 50},
        {fecha: '2016-05-16',diaFecha : 16, dia : 'L', diaLargo: 'Lunes', value: 20},
        {fecha: '2016-05-17',diaFecha : 17, dia : 'M', diaLargo: 'Martes', value: 25},
        {fecha: '2016-05-18',diaFecha : 18, dia : 'M', diaLargo: 'Miercoles', value:26},
        {fecha: '2016-05-19',diaFecha : 19, dia : 'J', diaLargo: 'Jueves', value: 21},
        {fecha: '2016-05-20',diaFecha : 20, dia : 'V', diaLargo: 'Viernes', value: 15},
        {fecha: '2016-05-21',diaFecha : 21, dia : 'S', diaLargo: 'Sabado', value: 23}
    ],
    // The name of the data record attribute that contains x-values.
    xkey: 'fecha',
    // A list of names of data record attributes that contain y-values.
    ykeys: ['value'],
    //xLabels : 'hour',
    //xLabelFormat :function (x) { return x.toString(); },
    // Labels for the ykeys -- will be displayed when you hover over the
    // chart.
    hoverCallback: function (index, options, content, row) {
        return '<div class="morris-hover-row-label">' + row.diaLargo + ' ' + row.diaFecha  +  '</div>' +
            '<div class="morris-hover-point">' + row.value + ' Ventas</div>';

    },
    labels: ['Venta'],
    pointStrokeWidths: [2],
    pointSize: 5,
    pointStrokeColors: ['#bad739'],
    pointFillColors: ['#ffffff'],

    behaveLikeLine: true,
    gridLineColor: '#ffffff',
    lineWidth: 3,
    hideHover: 'auto',
    lineColors: ['#71c5e8'],
    resize: true,
    gridTextColor : '#451f6b',
    gridTextWeight : 'bold'
});


App = {
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