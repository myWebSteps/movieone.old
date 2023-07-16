<template>

    <section class="content">
        <div class="container-fluid">
            <div class="row">

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Видео:</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body p-0">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th style="width: 10px">id</th>
                    <th>Kinopoisk_id</th>
                    <th>Year</th>
                    <th>NameRu</th>
                    <th>NameOriginal</th>
                    <th>Action</th>

                </tr>
                </thead>
                <tbody>
                <template v-for="movie in movies">
                    <tr>
                        <td>{{movie.id}}</td>
                        <td>{{movie.kinopoisk_id}}</td>
                        <td>{{movie.year}}</td>
                        <td>{{movie.nameRu}}</td>
                        <td>{{movie.nameOriginal}}</td>
                        <td>
                            <Router-link :to="{name: 'redact_video', params: {id: movie.id}}" type="button" class="btn btn-block btn-warning btn-sm w-50">Redact</Router-link>
                            <button @click="deleteMovie(movie.id)" type="button" class="btn btn-block btn-danger btn-sm w-50">Delete</button>
                        </td>
                    </tr>




                </template>





                </tbody>
            </table>
        </div>
        <!-- /.card-body -->
    </div>
        </div>
        </div>
    </section>
</template>

<script>
    export default {
        name: "Index",

        data(){
            return{
                movies: null,
            }
        },

        mounted(){
            this.moviesList()
        },

        methods:{
            moviesList(){
                axios.get('/api/movies/index')
                .then(response=>{
                    this.movies = response.data.data
                })
            },
            deleteMovie(id){
                axios.delete(`/api/movies/destroy/${id}`)
                    .then(response=>{
                        this.moviesList()
                    })
            },


        },

    }
</script>

<style scoped>

</style>
