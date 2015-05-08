//
var tag = document.createElement('script');
tag.src = "https://www.youtube.com/iframe_api";
var firstScriptTag = document.getElementsByTagName('script')[0];
firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);
// 
var player;
var localhost = window.location.href.indexOf('localhost') != -1;
function onYouTubeIframeAPIReady() {
    player = new YT.Player('trailer', {
        width: 580,
        height: 290,
        videoId: 'TGuzU5K5w0w',
        // videoId: 'TGuzU5K5w0w&list=PLIwi1qP_HdMou9TR9mrXVg4xRgiH-rMop&index=1', //https://www.youtube.com/watch?v=TGuzU5K5w0w&list=PLIwi1qP_HdMou9TR9mrXVg4xRgiH-rMop&index=1
        playerVars: { autoplay: 0, controls: 1, rel:0, modestbranding:1 },
        events: {
            'onReady': onPlayerReady,
            'onStateChange': onPlayerStateChange
        }
    });
    
}
function onPlayerReady(event) {
    player.loadPlaylist({'list':'PLIwi1qP_HdMou9TR9mrXVg4xRgiH-rMop'});
    if(!localhost)
        player.playVideo();
    // event.target.playVideo();
}
function onPlayerStateChange(event) {
    // if (event.data == YT.PlayerState.PLAYING && !done) {
        
    // }
}
function stopVideo() {
    player.stopVideo();
}