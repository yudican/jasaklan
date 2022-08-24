<div class="my-4">
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Iklan Views') }}
            </h2>
            <x-button class="cursor-default"><span class="ctimercountdown">{{$view->package->benefits}} Detik</span></x-button>
        </div>
    </x-slot>
    <div class="max-w-full w-full md:h-[55vh] sm:h-[40vh] lg:h-[80vh] h-[30vh] inline-block border border-gray-300 justify-center text-center overflow-hidden m-1 rounded hover:bg-gray-100 transition duration-150 ease-in-out cursor-pointer">
        {{-- <iframe width="560" height="315" src="{{ $view->url }}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe> --}}
        <div id="vidplayer" class="w-full h-full"></div>
        </iframe>
    </div>

    @push('scripts')
    {{-- <script src="https://www.youtube.com/iframe_api"></script> --}}
    <script>
        // 2. This code loads the IFrame Player API code asynchronously.
            var tag = document.createElement('script');
            var view = @js($view);
            tag.src = "https://www.youtube.com/iframe_api";
            var firstScriptTag = document.getElementsByTagName('script')[0];
            firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);
        // $(document).ready(function(value) {
            var WaktuHitung = view?.package?.benefits || 0; 
            var IsRuntimer = 0;
            var cTimer;
            function runTimer(){ 
                distance = WaktuHitung--; 
                if(distance <= 0){
                    clearInterval(cTimer);
                    $(".ctimercountdown").html("0 Detik");   
                    @this.call('finishView');
                }else{ 
                    $(".ctimercountdown").html(distance+" Detik"); 
                }              
            }

            function startTimer(){
                IsRuntimer = 1;
                cTimer = setInterval(runTimer,1000);  
            }

            var vidplayer;
            function onYouTubePlayerAPIReady() {  
                vidplayer = new YT.Player('vidplayer', {
                height: '50vh',
                width: '100%',
                videoId: view?.youtube_id,
                playerVars:{'rel': 0},
                    events: {
                        'onReady': onPlayerReady,
                        'onStateChange': onPlayerStateChange
                    }
                });
            }


            function onPlayerReady(event) {
                console.log(event)
            // event.target.playVideo();          
            }


            function onPlayerStateChange(event) {      
                console.log(event,'event')  
                if(event.data == YT.PlayerState.PLAYING){        
                    startTimer();              
                }else{
                    if(event.data == YT.PlayerState.PAUSED){
                        clearInterval(cTimer);
                    }else{                     
                        if(event.data == YT.PlayerState.ENDED){
                            clearInterval(cTimer);      
                        }                    
                    }
                }
            } 
        // }); 
    </script>
    @endpush
</div>