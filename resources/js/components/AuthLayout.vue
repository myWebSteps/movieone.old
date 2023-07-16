<template>
    <div class="wrapper">

        <auth-header-component ref="header"></auth-header-component>

            <router-view ref="router"></router-view>

        <auth-footer-component ref="footer"></auth-footer-component>

    </div>


</template>

<script>


    export default {
        name: "FrontComponent",
        mounted() {



        }


    }
</script>

<style scoped>

</style>
