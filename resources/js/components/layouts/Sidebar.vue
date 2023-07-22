<template>

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
        <router-link :to="{name: 'home'}" class="brand-link">
            <img src="logo-icon.png" alt="AdminLTE Logo" class="brand-image pt-2" style="opacity: .8">
            <span class="brand-text font-weight-light">MovieOne</span>


        </router-link>

        <!-- Sidebar -->



        <div
            class="sidebar os-host os-theme-light os-host-resize-disabled os-host-transition os-host-scrollbar-horizontal-hidden os-host-overflow os-host-overflow-y">

            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                    data-accordion="false">
                    <!-- Add icons to the links using the .nav-icon class
                         with font-awesome or any other icon font library -->

<!--                    <li class="nav-item">-->
<!--                        <router-link :to="{name: 'home'}" class="nav-link">-->
<!--                            <i class="fas fa-fw fa-film"></i>-->
<!--                            <p class="pl-2">Главная</p>-->
<!--                        </router-link>-->
<!--                    </li>-->


                    <li v-for="category in categories" class="nav-item">
                        <router-link  class="nav-link" :to="{name: 'films',  query:
                                 {category: category.id,
                                  order: 'year',
                                  page: 1,
                                  }}">
                            <i :class="category.category_logo"></i>
                            <p class="pl-2">{{category.title}}</p>
                        </router-link>
                    </li>

                </ul>
            </nav>
            <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
    </aside>

</template>

<script>
    export default {
        name: "Sidebar",
        data(){
            return{
                categories: null
            }
        },

        mounted() {
            this.getCategories()
        },
        methods: {
            getCategories() {
                axios.get('/api/categories')
                    .then(response => {
                        this.categories = response.data.data

                    })
            },

        },


    }
</script>

<style scoped>

</style>
