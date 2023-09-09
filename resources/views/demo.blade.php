@php
    $staging_url = route('staging-api');
    $production_url = route('production-api');
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
<select 
    id="env-buttons-section"
    class="w-3/4 lg:w-1/4 mx-auto flex justify-center gap-x-10"
>
    <option value="staging" class="bg-blue-400 text-center p-3 text-white rounded-lg">Staging</option>
    <option value="production" class="bg-blue-400 text-center p-3 text-white rounded-lg">Production</option>
</select>
<div id="timeline-embed"></div>
<script src="https://cdn.knightlab.com/libs/timeline3/latest/js/timeline.js"></script>
<script>

const apiEnvs = {
    'staging' : "{{$staging_url}}",
    'production' : "{{$production_url}}"
}

const environmentSelection = document.querySelector('#env-buttons-section');

function renderTimeline(env){

    const apiURL = apiEnvs[`${env}`];    
    const timeline = new TL.Timeline('timeline-embed',`${apiURL}`); 
}


renderTimeline('staging');

environmentSelection.addEventListener('change', function(event){

    const env = event.target.value;

    renderTimeline(env);

});


</script>