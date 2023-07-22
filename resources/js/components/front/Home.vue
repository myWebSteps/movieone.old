<template>

    <!-- Content Wrapper. Contains page content -->
    <div>
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">

                <div id="carouselExampleFade" class="carousel slide carousel-fade " data-bs-ride="carousel">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img src="../../../assets/img/slider1.jpg" class="d-block w-100 rounded-3" alt="...">
                            <div class="carousel-caption d-none d-md-block">
                                <h5>MovieOne.ru</h5>
                                <p>Актуальные коллекции фильмов</p>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <img src="../../../assets/img/slider2.jpg" class="d-block w-100 rounded-3" alt="...">
                            <div class="carousel-caption d-none d-md-block">
                                <h5>MovieOne.ru</h5>
                                <p>Мультфильмы на любой вкус</p>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <img src="../../../assets/img/slider3.jpg" class="d-block w-100 rounded-3" alt="...">
                            <div class="carousel-caption d-none d-md-block">
                                <h5>MovieOne.ru</h5>
                                <p>Подборки фильмов по тематикам</p>
                            </div>
                        </div>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleFade" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleFade" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <template v-for="result in results">
                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mt-4 mb-3">
                        <h1 class="h5 mb-0 text-gray-900">{{result.category.title}}</h1>
                        <router-link
                            :to="{name: 'films',  query:
                                 {category: result.category.id,
                                  order: 'year',
                                  page: 1,
                                  }}"
                            class="d-none d-sm-inline-block text-xs">Перейти ко всем &nbsp<i class="fas fa-eye fa-sm"></i>
                        </router-link>
                    </div>
                    <!-- Content Row -->
                    <div class="row">

                        <div v-for="movie in result.movies" class="col-xl-3 col-md-6 mb-4">
                            <div  class="card e-card shadow border-0">
                                <router-link :to="{path: `films/${movie.id}`}">
                                    <div class="m-card-cover">
                                        <img :src="movie.poster_path" class="card-img-top" :alt="movie.nameOriginal">
                                    </div>
                                    <div class="card-body p-0">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col-2 auto py-3 pl-3">
                                                <div class="bg-white rounded text-center">
                                                    <h6 class="text-danger mb-0 font-weight-bold">{{movie.year}}</h6>
                                                </div>
                                            </div>
                                            <div class="col-10 p-3">
                                                <p v-if="movie.nameRu != null" class="card-text text-gray-900 mb-1">{{movie.nameRu}}</p>
                                                <p v-if="movie.nameOriginal != null" class="card-text text-gray-900 mb-1">{{movie.nameOriginal}}</p>
                                                <p class="card-text">
                                                    <small v-for="subcategory in movie.subcategories" class="text-muted">
                                                        {{subcategory.title}} &nbsp
                                                    </small></p>
                                            </div>
                                        </div>
                                    </div>
                                </router-link>
                            </div>
                        </div>

<!--                        <div v-for="movie in result.movies" class="col-xl-3 col-md-6 mb-4">-->
<!--                            <div  class="card m-card shadow border-0">-->
<!--                                <router-link :to="{path: `films/${movie.id}`}">-->
<!--                                    <div class="m-card-cover">-->
<!--&lt;!&ndash;                                        <div class="position-absolute bg-white shadow-sm rounded text-center p-2 m-2 love-box">&ndash;&gt;-->
<!--&lt;!&ndash;                                            <h6 class="text-gray-900 mb-0 font-weight-bold"><i class="fas fa-heart text-danger"></i> 88%</h6>&ndash;&gt;-->
<!--&lt;!&ndash;                                            <small class="text-muted">23,421</small>&ndash;&gt;-->
<!--&lt;!&ndash;                                        </div>&ndash;&gt;-->
<!--                                        <img :src="movie.poster_path" class="card-img-top" alt="...">-->
<!--                                    </div>-->
<!--                                    <div class="card-body p-3">-->
<!--                                        <h5 class="card-title text-gray-900 mb-1">{{movie.nameRu}}</h5>-->
<!--                                        <p class="card-text"><small class="text-muted">{{movie.nameOriginal}}</small></p>-->
<!--                                        <p><small class="text-danger"><i class="fas fa-calendar-alt fa-sm text-gray-400"></i>&nbsp{{movie.year}}</small></p>-->
<!--                                    </div>-->
<!--                                </router-link>-->
<!--                            </div>-->
<!--                        </div>-->

                    </div>
                    <!-- Page Heading -->
                </template>



            </div><!--/. container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->




</template>

<script>
    export default {
        name: "Home",

        data(){
            return{
                results: null,
            }
        },

    mounted() {
    this.send()

    document.getElementById('document_description').innerText= "MovieOne Онлайн кинотеатр с большим выбором фильмов, мультфильмов и аниме. У нас Вы всегда можете посмотреть любимые фильмы бесплатно и без регистрации"

    },

        methods:{
            send(){
                axios.get('/api/home')
                .then(response=>{
                    this.results = response.data.data
                    console.log(this.results)
                })
            },
        },

    }
</script>

<style scoped>

</style>
