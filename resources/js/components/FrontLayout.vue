<template>
    <div class="wrapper p-0 m-0">

        <sidebar-component ref="sidebar"></sidebar-component>

        <header-component ref="header"></header-component>

        <div class="content-wrapper">
            <page-title-component v-if="this.$route.meta.pageTitle == true" :key="this.$route.query.category"></page-title-component>
            <filter-component v-if="this.$route.meta.filter == true" :key="this.$route.query.category" ref="filter"></filter-component>

            <router-view :key="this.$route.fullPath" ref="router"></router-view>
        </div>
        <footer-component ref="footer"></footer-component>

    </div>


</template>

<script>
    import Filter from "./layouts/Filter.vue";
    import PageTitle from "./layouts/PageTitle.vue";

    export default {
        name: "FrontComponent",

        components:{Filter, PageTitle},

        mounted() {



        }


    }
</script>

<style scoped>

</style>
