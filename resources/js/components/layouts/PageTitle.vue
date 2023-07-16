<template>
        <!-- Page Heading -->
        <div class="ml-3 d-sm-flex align-items-center justify-content-between mt-4 mb-3">
            <h1 class="h5 mb-0 text-gray-900">{{pageTitle}}</h1>
        </div>

</template>

<script>
    export default {
        name: "PageTitle",

        data(){
            return{
                pageTitle: null,
            }
        },

        mounted(){
            this.makePageTitle()
        },


        methods: {
            makePageTitle() {
                if (this.$route.query.type === 'FILM') {
                    this.pageTitle = 'Фильмы'
                } else if (this.$route.query.type === 'ALL') {
                    this.pageTitle = 'Все видео'
                } else if (this.$route.query.type === 'TV_SERIES') {
                    this.pageTitle = 'Сериалы'
                } else if (this.$route.query.type === 'MINI_SERIES') {
                    this.pageTitle = 'Мини сериалы'
                } else if (this.$route.query.type === 'TV_SHOW') {
                    this.pageTitle = 'Шоу'
                }
            },
        }

    }
</script>

<style scoped>
    .content-wrapper{
        min-height: fit-content;
    }

</style>
