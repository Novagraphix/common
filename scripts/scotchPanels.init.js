$(function() {
    $(window).load(function() {
        var scotchPanel = $('#mobile-panel').scotchPanel({
            containerSelector: 'body',
            direction: 'left',
            duration: 300,
            transition: 'ease',
            clickSelector: '#mobile-menu-button',
            distanceX: '100%',
            enableEscapeKey: true
        });
    });
});