<template>
    <div class="card" :class={dNone:isActive}>
        <div class="card-header">
            <h3 class="card-title" v-html="title"></h3>
            <span class="float-right">
                <i class="fa fa-fw ti-angle-up" :class={rotate:show} @click="show = !show"></i>
                <i class="fa fa-fw ti-close removecard" @click="hide" ></i>
            </span>
        </div>
        <div class="card-body" v-show="show">
<slot></slot>
        </div>
    </div>
</template>
<script>
    export default{
        name:'card',
        data(){
            return{
                show: true,
                isActive:false,
            }
        },
        methods:{
            hide(){
                this.isActive=true
            }
        },
        mounted:function(){
        },
        props:{
            title:{
                required:false
            }
        },
        destroy:function () {

        }
    }
</script>
<style>
    .dNone{
        display: none;
    }
    .rotate{
        transform:rotate(180deg);
    }
</style>