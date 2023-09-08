@php
    $api_route = route('staging-api');    
@endphp
<link title="timeline-styles" rel="stylesheet" 
    href="https://cdn.knightlab.com/libs/timeline3/latest/css/timeline.css">
    <link
      rel="stylesheet"
      href="https://cccnewyork.org/app/themes/cccnewyork/dist/styles/main.css"
      type="text/css"
    />
<style>
    body {
        width: 100vw;
        height: 100vh;
        display:flex;
        flex-direction: column;
        justify-content: center;
    }
</style>

<div id="timeline-embed" class="w-screen h-[300px]"></div>
<script src="https://cdn.knightlab.com/libs/timeline3/latest/js/timeline.js"></script>
<script>
timeline = new TL.Timeline('timeline-embed',"{{$api_route}}"); 
</script>