<template>
    <div id="main">
        <div class="nav">
            <Nav />
        </div>
        <div class="content">
            <router-view />
        </div>
    </div>
</template>

<script>
import Nav from "./Nav";
import Footer from "./Footer";
export default {
    name: "Layout",
    components:{
        Nav, Footer
    }
}
</script>

<style scoped>
#main{
    background: #f4f7fa !important;
    float: left;
    width: 100%;
}
</style>
