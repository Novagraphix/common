$(function() {
	$(window).load(function() {
	   skel.plugins.layers.create('navPanel', {
	       html: $('header nav').html(),
	       breakpoints: ['small'],
	       position: 'top-left',
	       width: '100%',
	       height: '100%',
	       orientation: 'vertical',
	       side: 'left',
	       hidden: true,
	       animation: 'pushX',
	       clickToHide: false,
	   });
	   skel.plugins.layers.create('titleBar', {
	       breakpoints: ['small'],
	       position: 'top-left',
	       width: '5em',
	       height: '2em',
	       html: '<div class="toggle" data-action="toggleLayer" data-args="navPanel">Menü</div>'
	   });
	});
});