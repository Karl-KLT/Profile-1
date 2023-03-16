<template>
    <sideBar></sideBar>
    <!-- main page -->
    <div>
        <router-view></router-view>
    </div>

</template>


<script>
    import sideBar from './sideBar.vue' 
    export default {
        name:'App',
        components:{sideBar}
    }
</script>
