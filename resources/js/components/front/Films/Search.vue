<template>
    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between p-4 mb-4">
            <h1 class="h5 mb-0 text-gray-900">Результаты поиска:"{{this.$route.query.key}}"</h1>
        </div>
        <!-- Content Row -->
        <div class="row">

            <div class="col-xl-12 col-lg-8">
                <div class="row">
                    <div v-for="movie in movies" class="col-xl-3 col-md-6 mb-4">
                        <div  class="card e-card shadow border-0">
                            <router-link :to="{path: `/films/${movie.id}`}">
                                <div class="m-card-cover">
                                    <img :src="movie.posterUrl" class="card-img-top" alt="...">
                                </div>
                                <div class="card-body p-0">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col-2 auto py-3 pl-3">
                                            <div class="bg-white rounded text-center">
                                                <h6 class="text-danger mb-0 font-weight-bold">{{movie.year}}</h6>
                                            </div>
                                        </div>
                                        <div class="col-10 p-3">
                                            <p class="card-text text-gray-900 mb-1">{{movie.nameRu}}</p>
                                            <p class="card-text text-gray-900 mb-1">{{movie.nameOriginal}}</p>
                                            <p class="card-text">
                                                <small v-for="subcategory in movie.subcategory_title" class="text-muted">{{subcategory.title}} &nbsp</small></p>
                                        </div>
                                    </div>
                                </div>
                            </router-link>
                        </div>
                    </div>

                </div>

            </div>
            <nav v-if="pagination.last_page > 1" aria-label="Page navigation example" class="d-grid justify-content-md-center">
                <ul class="pagination">

                    <li v-for="page in pagination.links" class="page-item">
                        <template v-if="Number(page.label)">
                            <a @click.prevent="makeQueryArr(page.label)" :class="page.label == this.$route.query.page ? 'active' : ''" class="page-link" href="#">{{page.label}}</a>
                        </template>
                    </li>


                </ul>
            </nav>

        </div>
    </div>
</template>

<script>
    export default {
        name: "Search",

        data(){
            return{
                requestArr: {},
                movies: null,
                pages: null,
                pagination: {},
            }
        },

        mounted(){
            document.getElementById('document_description').innerText= "MovieOne Онлайн поиск по базе данных фильмов, мультфильмов и аниме."

            this.send()
            this.pagination.links = []

        },

        methods:{

            makeQueryArr(value)
            {
                this.requestArr.key = this.$route.query.key
                this.requestArr.order = this.$route.query.order
                this.requestArr.page = value

                this.$router.push({name: 'search_by_key', query: this.requestArr})
            },

            send(){
                axios.get(`/api/movies`,
                    {params: this.$route.query})
                    .then(response=>{
                        this.movies = response.data.data
                        this.pagination = response.data.meta
                    })
            }

        },
    }
</script>

<style scoped>

</style>
