<template>
    <div class="wrapper">

        <admin-header-component ref="admin-header"></admin-header-component>

        <admin-sidebar-component ref="admin-sidebar"></admin-sidebar-component>

        <div class="content-wrapper">

            <router-view></router-view>

        </div>


        <admin-footer-component ref="admin-footer"></admin-footer-component>

    </div>
</template>

<script>
    export default {
        name: "AdminComponent"
    }
</script>

<style scoped>

</style>
