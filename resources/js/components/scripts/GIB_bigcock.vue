<template>
    <div class="txt-script">
        <span class="has-tag">&lt;</span>
        <span class="has-name">script</span>
        <span class="has-tag">&gt;</span>
        <div class="text-p">
            <span class="has-string"> <br>
                <span class="has-attr">var</span> <span class="has_n">script</span> <span class="has-tag"> = </span>
                <span class="has-attr">document</span> . <span class="has_n">createElement</span>('script')<span class="has-tag"> ; </span> <br>
                <span class="has-attr">document</span>.<span class="has_n">getElementsByTagName</span>('head')[<span class="has-tag"> 0 </span>].<span class="has_n">appendChild</span>(script) <span class="has-tag"> ; </span> <br>
                <span class="has-attr">var</span> <span class="has_n">script</span> <span class="has-tag"> = </span>
                <span class="has_n">script</span> . <span class="has_n"> src </span> <span class="has-tag"> = </span> '//leadslabpixels.net/Pixel/studying?idClient=16&idCampaign=<span class="has-id">{{new_campaign}}</span>&password=htnfhutn&type=1&userData=$"."USERDATA"."'<span class="has-tag"> ; </span> <br>
                <span class="has-attr">document</span>.<span class="has_n">getElementsByTagName</span>('head')[<span class="has-tag"> 0 </span>].<span class="has_n">appendChild</span>(script) <span class="has-tag"> ; </span> <br>
                <span class="has-attr">document</span> . <span class="has_n">createElement</span>('script')<span class="has-tag"> ; </span> <br>
                <span class="has_n">script</span> . <span class="has_n"> src </span> <span class="has-tag"> = </span> '//leadslabpixels.net/Pixel/gib?idClient=16&idCampaign=<span class="has-id">{{new_campaign}}</span>&password=htnfhutn'<span class="has-tag"> ; </span> <br>
                <span class="has-attr">document</span>.<span class="has_n">getElementsByTagName</span>('head')[<span class="has-tag"> 0 </span>].<span class="has_n">appendChild</span>(script) <span class="has-tag"> ; </span> <br>
            </span>
        </div>
        <span class="has-tag">&lt;</span>
        <span class="has-name">/script</span>
        <span class="has-tag">&gt;</span>
    </div>
</template>

<script>
    export default {
        name: "GIB_bigcock",
        props:['new_campaign'],
    }
</script>

<style lang="scss" scoped>
    .has-tag {
        color: #89ddff;;
    }

    .has-name {
        color: #f07178;
    }

    .has-string {
        color: #bbdf88;
    }
    .has-attr {
        color: #bb8adb;
    }

    .txt-script {
        margin-left: 15px;
    }

    .text-p {
        padding-left: 20px;
        margin-top: -20px;
    }
    .has-id {
        color: red
    }
    .has_n {
        color: orange;
    }
</style>