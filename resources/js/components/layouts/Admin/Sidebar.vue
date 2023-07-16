<template>
    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
        <div class="brand-link">
            <span class="brand-text font-weight-light">Admin Panel</span>
        </div>

        <!-- Sidebar -->
        <div class="sidebar">


            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                    <li class="nav-item">
                        <router-link :to="{name: 'admin'}" class="nav-link">
                            <i class="far fa-circle"></i>
                            <p>
                                Главная
                            </p>
                        </router-link>
                    </li>
                    <li class="nav-header">КАТЕГОРИИ</li>
                    <li class="nav-item">
                        <router-link :to="{name: 'admin.categories'}" class="nav-link">
                            <i class="far fa-circle"></i>
                            <p>
                                Категории
                            </p>
                        </router-link>
                    </li>
                    <li class="nav-item">
                        <router-link :to="{name: 'admin.subcategories'}" class="nav-link">
                            <i class="far fa-circle"></i>
                            <p>
                                Субкатегории
                            </p>
                        </router-link>
                    </li>
                    <li class="nav-header">СТРАНЫ</li>
                    <li class="nav-item">
                        <router-link :to="{name: 'countries'}" class="nav-link">
                            <i class="far fa-circle"></i>
                            <p>
                                Список стран
                            </p>
                        </router-link>
                    </li>
                    <li class="nav-header">ВИДЕО</li>
                    <li class="nav-item">
                        <router-link :to="{name: 'add_video'}" class="nav-link">
                            <i class="far fa-circle"></i>
                            <p>
                                Добавить видео
                            </p>
                        </router-link>
                    </li>

                    <li class="nav-item">
                        <router-link :to="{name: 'videos'}" class="nav-link">
                            <i class="far fa-circle"></i>
                            <p>
                                Список видео
                            </p>
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
        name: "Sidebar"
    }
</script>

<style scoped>

</style>
