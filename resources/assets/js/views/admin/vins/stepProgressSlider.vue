<template>
  <div class="root">
     <div class="container">
          <ul class="progressbar">
            <li :class="{ active: activeSteps(i)}" v-for="i in length" :key="i"> </li>
          </ul>
      </div>
  </div>
</template>
<script>
export default {
  props:['length','curstep'],
  data () {
    return {
      // 'curStep': this.$store.state.Patient.curStep,
    }
  },
  methods: {
      activeSteps:function(i){
        if(i <= this.curstep) {
          return true;
        }
        return false;
      }
  },
}
</script>

(html comment removed:  Add "scoped" attribute to limit CSS to this component only )
<style scoped>
.container{
     width: 100%;
    position: absolute;
    z-index: 1;
    margin-top: 20px;
}
.progressbar{
  counter-reset: step;
}
.progressbar li{
  float: left;
  width: 25%;
  position: relative;
  text-align: center;
}
.progressbar li:before{
  content:counter(step);
  counter-increment: step;
  width: 30px;
  height: 30px;
  border: 2px solid #bebebe;
  display: block;
  margin: 0 auto 10px auto;
  border-radius: 50%;
  line-height: 27px;
  background: white;
  color: #bebebe;
  text-align: center;
  font-weight: bold;
}
.progressbar li:after{
  content: '';
  position: absolute;
  width:100%;
  height: 3px;
  background: #979797;
  top: 15px;
  left: -50%;
  z-index: -1;
}
.progressbar li.active:before{
 border-color: #3aac5d;
 background: #3aac5d;
 color: white
}
.progressbar li.active:after{
 background: #3aac5d;
}
.progressbar li.active - li:after{
 background: #3aac5d;
}
.progressbar li.active - li:before{
border-color: #3aac5d;
background: #3aac5d;
color: white
}
.progressbar li:first-child:after{
 content: none;
}
</style>