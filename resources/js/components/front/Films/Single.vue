<template>

    <!-- Begin Page Content -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-12 col-lg-12">
                <div class="cover-pic">
                    <div class="position-absolute bg-white shadow-sm rounded text-center p-2 m-4 love-box">
                        <h6 class="text-gray-900 mb-0 font-weight-bold"><i class="fas fa-heart text-danger"></i> 50%</h6>
                        <small class="text-muted">8,784</small>
                    </div>
                    <!-- Постер Рекламы -->
<!--                    <img :src="movie.posterUrl" class="img-fluid" alt="...">-->
                </div>
            </div>
            <div class="col-xl-3 col-lg-3">
                <div class="bg-white p-3 widget shadow rounded mb-4">
                    <img :src="movie.posterUrl" class="img-fluid rounded" alt="...">
                    <h5 class="h6 mb-0 mt-3 font-weight-bold text-gray-900">Продолжительность:</h5>
                    <p>{{movie.filmLength}} мин</p>
<!--                    <h1 class="h6 mb-0 mt-3 font-weight-bold text-gray-900">Год выпуска:</h1>-->
<!--                    <p>{{movie.year}}</p>-->
                    <h5 v-if="movie.endYear != null" class="h6 mb-0 mt-3 font-weight-bold text-gray-900">Год окончания:</h5>
                    <p>{{movie.endYear}}</p>
                    <h5 class="h6 mb-0 mt-3 font-weight-bold text-gray-900">Рейтинг:</h5>
                    <p>{{movie.rate}}</p>
                    <h5 v-if="movie.endYear != null" class="h6 mb-0 mt-3 font-weight-bold text-gray-900">Страны:</h5>
                    <p>
                        <span v-for="country in movie.countries">
                        {{country.title}}&nbsp
                        </span>
                    </p>

                </div>
            </div>
            <div class="col-xl-9 col-lg-9">
                <div class="bg-white info-header shadow rounded mb-4">
                    <div class="row d-flex align-items-center justify-content-between p-3 border-bottom">
                        <div class="col-lg-7 m-b-4">
                            <h3 v-if="movie.nameRu != null" class="text-gray-900 mb-0 mt-0 font-weight-bold">{{movie.nameRu}}</h3>
                            <h3 v-if="movie.nameOriginal != null" class="text-gray-900 mb-0 mt-0 font-weight-bold">{{movie.nameOriginal}}</h3>
                            <h5 class="mt-0 mb-3 mt-2">{{movie.slogan}}</h5>

                            <p class="mb-0 text-gray-800">
                                <small class="text-muted"><i class="fas fa-film fa-fw fa-sm mr-1"></i>
                                    <span v-for="subcategory in movie.subcategories">
                                        {{subcategory.title}}&nbsp
                                    </span>
                                </small></p>
                        </div>
                        <div class="col-lg-5 text-right">
                            <a @click.prevent="copyUrl()" href="#" class="d-sm-inline-block btn btn-primary shadow-sm"><i class="fas fa-share-alt"></i></a>
                            <template v-if="!playlistIncludes(movie.id)">
                                <a @click.prevent="addToPlaylist(movie.id)" href="#" class="d-sm-inline-block btn btn-danger shadow-sm"> В избранное <i class="fas fa-plus fa-sm  ml-1"></i></a>
                            </template>
                            <template v-if="playlistIncludes(movie.id)">
                            <a @click.prevent="addToPlaylist(movie.id)" href="#" class="d-sm-inline-block btn btn-danger shadow-sm"> Убрать <i class="fas fa-minus fa-sm  ml-1"></i></a>
                            </template>
                        </div>
                    </div>
                </div>
                <div class="bg-white p-3 widget shadow rounded mb-4">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Видео</a>
                        </li>
                        <li @click="getStaff()" class="nav-item">
                            <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Актеры
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Рецензии<span class="badge badge-danger badge-counter">{{reviews.total}}</span></a>
                        </li>
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">

                            <div class="kinobox_player"></div>

                            <article class="mt-2">
                                <h1 class="text-gray-800">{{movie.nameRu}} / {{movie.nameOriginal}}</h1>
                                <p class="text-gray-800">{{movie.description}}</p>
                            </article>


                        </div>
                        <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                            <div class="row">
                                <div class="col-xl-4 col-lg-4">
                                    <h5 class="h6 mt-0 mb-3 font-weight-bold text-gray-900">Режиссеры:</h5>
                                    <div v-for="person in staff.directors" class="artist-list mb-3">
                                       <a class="d-flex align-items-center" href="#">
                                            <div class="dropdown-list-image mr-3">
                                                <img style="width: 50px; height: 70px" :src="person.posterUrl" alt="">
                                                <div class="status-indicator bg-success"></div>
                                            </div>
                                            <div class="font-weight-bold">
                                                <div class="text-truncate">{{person.nameRu}}</div>
                                                <div class="small text-gray-500">{{person.professionText}}</div>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                                <div class="col-xl-4 col-lg-4">
                                    <h5 class="h6 mt-0 mb-3 font-weight-bold text-gray-900">Актеры:</h5>
                                    <div v-for="person in staff.actors" class="artist-list mb-3">
                                        <a class="d-flex align-items-center" href="#">
                                            <div class="dropdown-list-image mr-3">
                                                <img style="width: 50px; height: 70px" :src="person.posterUrl" alt="">
                                                <div class="status-indicator bg-success"></div>
                                            </div>
                                            <div class="font-weight-bold">
                                                <div class="text-truncate">{{person.nameRu}}</div>
                                                <div class="small text-gray-500">{{person.professionText}}</div>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                                <div class="col-xl-4 col-lg-4">
                                    <h5 class="h6 mt-0 mb-3 font-weight-bold text-gray-900">Другие:</h5>
                                    <div v-for="person in staff.support" class="artist-list mb-3">
                                        <a class="d-flex align-items-center" href="#">
                                            <div class="dropdown-list-image mr-3">
                                                <img style="width: 50px; height: 70px" :src="person.posterUrl" alt="">
                                                <div class="status-indicator bg-success"></div>
                                            </div>
                                            <div class="font-weight-bold">
                                                <div class="text-truncate">{{person.nameRu}}</div>
                                                <div class="small text-gray-500">{{person.professionText}}</div>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                            <div class="card-body p-0 reviews-card">
                                <div v-for="review in reviews.items" class="media mb-4">
                                    <div class="media-body">
                                        <div class="mt-0 mb-2">
                                            <span class="h6 mr-2 text-muted text-gray-500">{{review.author}}</span>
                                        </div>
                                        <div class="mt-0 mb-2">
                                            <span class="h6 mr-2 font-weight-bold text-gray-900">{{review.title}}</span>
                                        </div>
                                        <div v-if="review.type == 'POSITIVE'" class="mt-0 mb-2">
                                            <span class="h6 mr-2 font-weight-bold text-success">+</span>
                                        </div>
                                        <div v-if="review.type == 'NEGATIVE'" class="mt-0 mb-2">
                                            <span class="h6 mr-2 font-weight-bold text-danger">-</span>
                                        </div>
                                        <p>{{review.description}}</p>
                                    </div>
                                </div>
                            </div>
                            <!--Comment Form-->
<!--                            <div class="p-4 bg-light rounded mt-4">-->
<!--                                <h5 class="card-title mb-4">Leave a Review</h5>-->
<!--                                <form name="sentMessage">-->
<!--                                    <div class="row">-->
<!--                                        <div class="control-group form-group col-lg-4 col-md-4">-->
<!--                                            <div class="controls">-->
<!--                                                <label>Your Name <span class="text-danger">*</span></label>-->
<!--                                                <input type="text" class="form-control" required="">-->
<!--                                            </div>-->
<!--                                        </div>-->
<!--                                        <div class="control-group form-group col-lg-4 col-md-4">-->
<!--                                            <div class="controls">-->
<!--                                                <label>Your Email <span class="text-danger">*</span></label>-->
<!--                                                <input type="email" class="form-control" required="">-->
<!--                                            </div>-->
<!--                                        </div>-->
<!--                                        <div class="control-group form-group col-lg-4 col-md-4">-->
<!--                                            <div class="controls">-->
<!--                                                <label>Rating <span class="text-danger">*</span></label>-->
<!--                                                <select class="form-control custom-select">-->
<!--                                                    <option>1 Star</option>-->
<!--                                                    <option>2 Star</option>-->
<!--                                                    <option>3 Star</option>-->
<!--                                                    <option>4 Star</option>-->
<!--                                                    <option>5 Star</option>-->
<!--                                                </select>-->
<!--                                            </div>-->
<!--                                        </div>-->
<!--                                    </div>-->
<!--                                    <div class="control-group form-group">-->
<!--                                        <div class="controls">-->
<!--                                            <label>Review <span class="text-danger">*</span></label>-->
<!--                                            <textarea rows="3" cols="100" class="form-control"></textarea>-->
<!--                                        </div>-->
<!--                                    </div>-->
<!--                                    <div class="text-right">-->
<!--                                        <button type="submit" class="btn btn-primary">Send Message</button>-->
<!--                                    </div>-->
<!--                                </form>-->
<!--                            </div>-->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->

</template>

<script>
    export default {
        name: "Single",

        data(){
            return{
                movie: {},
                staff: {},
                reviews: {},
                playlist: [],
                playlistRes: [],
                newFilter: []
            }
        },

        computed(){
            this.movie.posterUrl = "#"
            this.movie.kinopoisk_id = null
            this.movie.nameRu = null
            this.movie.nameOriginal = null
            this.movie.subcategories = null
            this.movie.slogan = null
            this.movie.description = null
            this.movie.filmLength = null
            this.movie.endYear = null
            this.movie.rate = null
            this.staff.directors = {}
            this.staff.actors = {}
            this.staff.support = {}

        },

        mounted() {
            this.send()
        },

        methods:{
            send(){

                axios.get(`/api/movie/${this.$route.params.id}`)
                    .then(response=>{
                        this.movie = response.data.data

                        document.getElementById('document_description').innerText= this.movie.nameRu + ' : ' + this.movie.description

                        this.getReviews()

                        new Kinobox('.kinobox_player', {
                            token: '099ff69cca3e4d669a111bc9e21d032a',
                            search: {
                                kinopoisk: this.movie.kinopoisk_id,
                            }
                        }).init();
                    }).catch(e=>{

                })

            },

            addToPlaylist(id){
                if(!localStorage.getItem('playlist')){
                    this.playlistRes.push(id)
                    localStorage.setItem('playlist', this.playlistRes)

                    this.$parent.$parent.$refs.header.PlayListCount()
                    this.$parent.$parent.$refs.header.makePlaylist()
                }else{
                    this.playlistRes = localStorage.getItem('playlist').split(',')
                    if(this.playlistRes.includes(String(id))){
                        this.playlistRes = this.playlistRes.filter(elem=>{
                            if(elem != id){
                                return elem
                            }
                        })

                        localStorage.setItem('playlist', this.playlistRes)
                        this.$parent.$parent.$refs.header.PlayListCount()
                        this.$parent.$parent.$refs.header.makePlaylist()
                    }else{
                        this.playlistRes.push(id)
                        localStorage.setItem('playlist', this.playlistRes)
                        this.$parent.$parent.$refs.header.PlayListCount()
                        this.$parent.$parent.$refs.header.makePlaylist()
                    }
                }
            },

            playlistIncludes(id){
                if(localStorage.getItem('playlist')) {
                    this.playlistRes = localStorage.getItem('playlist').split(',')
                    if (this.playlistRes.includes(String(id))) {
                        return true
                    }
                }else{
                    return false
                }
            },

            getStaff(){
                axios.get(`https://kinopoiskapiunofficial.tech/api/v1/staff?filmId=${this.movie.kinopoisk_id}`,
                    {headers: {
                            'X-API-KEY': 'e3409535-696e-40cb-8764-86dda0af9f48',
                            'Content-Type': 'application/json',
                            WithCredentials: false,
                        }}
                ).then(resp=>{

                    this.staff.directors = resp.data.filter((elem, index)=>{
                            return elem.professionKey == 'DIRECTOR'
                    })
                    this.staff.actors = resp.data.filter((elem, index)=>{
                        return elem.professionKey == 'ACTOR'
                    })
                    this.staff.support = resp.data.filter((elem, index)=>{
                        return elem.professionKey !== 'DIRECTOR' && elem.professionKey !== 'ACTOR'
                    })

                })
            },

            getReviews(){
                axios.get(`https://kinopoiskapiunofficial.tech/api/v2.2/films/${this.movie.kinopoisk_id}/reviews?page=1&order=DATE_DESC`,
                    {

                        headers: {
                            'X-API-KEY': 'e3409535-696e-40cb-8764-86dda0af9f48',
                            'Content-Type': 'application/json',
                        }

                    })
                .then(r=>{
                    this.reviews = r.data
                })
            },

            copyUrl(){
                navigator.clipboard.writeText(window.location.href)
            }

        },


    }
</script>

<style scoped>

</style>
