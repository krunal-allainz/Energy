<template>
  <div class="root">
    <div class="wrapper-mains">
      <div class="left-align">
        <step-progress :length="4" :curstep="curstep"></step-progress>
      </div>
    </div>
  </div>
</template>
<script>
import stepProgress from './stepProgressSlider.vue'
export default {
  props:['curstep'],
  components:{
    stepProgress
  }
}
</script>
(html comment removed:  Add "scoped" attribute to limit CSS to this component only )
<style scoped>
.root {
         padding: 0px 0px 50px;
}
.wrapper-mains{
  width: 561px;
    height: auto;
    background: white;
    text-align: center;
    /*margin: auto;*/
    /*padding:auto;*/
}
.textarea{
    display: block;
    width: 100%;
    height: 70px;
    border-radius: 5px;
}
</style>