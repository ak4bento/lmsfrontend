var player = videojs('videoPlayer',{
    autoplay : 'muted',
    controls:true,
    loop:true,
    plugins:{
        hotkeys:{
            seekStep:10
        }
    }
})