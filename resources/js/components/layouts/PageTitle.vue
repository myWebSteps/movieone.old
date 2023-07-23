<template>
        <!-- Page Heading -->
        <div class="ml-3 d-sm-flex align-items-center justify-content-between pt-4 mb-4">
            <h1 class="h5 mb-0 text-gray-900">{{pageTitle.title}}</h1>
        </div>

</template>

<script>
    export default {
        name: "PageTitle",

        data(){
            return{
                pageTitle: {},
            }
        },

        mounted(){
            this.makePageTitle()
            this.pageTitle.title = null
        },


        methods: {
            makePageTitle() {
                axios.get(`/api/page_title/${this.$route.query.category}`)
                .then(response =>{
                    this.pageTitle = response.data
                })
            },
        }

    }
</script>

<style scoped>
    .content-wrapper{
        min-height: fit-content;
    }

</style>
