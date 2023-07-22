<template>
        <div class="row m-3">
            <div class="card card-warning">
                <div class="card-header">

                    <h3 class="card-title">Редактирование видео</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <form>
                        <div class="row">
                            <div class="col-sm-6">
                                <!-- Kinopoisk ID -->
                                <div class="form-group">
                                    <label for="KinopoiskId">Кинопоиск ID:</label>
                                    <input v-model="inputArr.kinopoisk_id" type="number" class="form-control" id="KinopoiskId" placeholder="Введите Кинопоиск ID">
                                </div>
                            </div>

                        </div>
                        <div class="row">

                            <!-- NameRu -->
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="nameRu">Русское название:</label>
                                    <input v-model="inputArr.nameRu" type="text" class="form-control" id="nameRu" placeholder="Введите русское название">
                                </div>
                            </div>

                            <!-- NameOriginal -->
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="nameOriginal">Оригинальное название:</label>
                                    <input v-model="inputArr.nameOriginal" type="text" class="form-control" id="nameOriginal" placeholder="Введите русское название">
                                </div>
                            </div>

                            <!-- PosterPrew -->
                            <div class="col-sm-6" >
                                <div class="form-group w-50" style="height: fit-content">
                                    <label for="posterPrev">Постер:</label>
                                    <img :src="inputArr.posterUrl" class="form-control" id="posterPrev" style="height: fit-content">
                                </div>
                            </div>


                            <!--poster Upload -->
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="posterUpload">Постер:</label>
                                    <div id="posterUpload" ref="dropZone"
                                         class="form-group btn-control w-100 btn btn-success pt-5 pb-5">
                                        <i class="fas fa-plus align-self-center"></i>
                                        <span class="align-self-center">Click or drag files here</span>
                                    </div>
                                    <!--                            <div v-if="errors.files">-->
                                    <!--                                <p class="text-danger" v-for="error in errors.files">{{error}}</p>-->
                                    <!--                            </div>-->
                                </div>
                            </div>




                        <!-- Cat Select -->
                        <div class="col-sm-6">
                        <div class="form-group">
                            <label>Категория</label>
                            <select @change="getSubcateroiesList()" v-model="inputArr.category" class="form-select">
                                <option disabled value="null">Выберите категорию</option>
                                <template v-for="category in resultCategories">
                                    <option  :value="category.id">{{category.title}}</option>
                                </template>
                            </select>
                        </div>
                        </div>

                            <!--SubCat Select -->
                            <div class="col-sm-6">
                            <div class="form-group">
                                <label>Субкатегории</label>
                                <select v-model="subcategoriesArr" multiple placeholder="Можно выбрать несколько" style="width: 100%" class="form-select">
                                    <option v-for="subCategory in resultSubcategories" :value="subCategory.id">{{subCategory.title}}</option>
                                </select>
                            </div>
                        </div>


                            <!--Type Select -->
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Тип:</label>
                                    <select v-model="inputArr.type" style="width: 100%" class="form-select">
                                        <option value="" disabled>Выберите Тип</option>
                                        <option value="2">Кино</option>
                                        <option value="3">Сериалы</option>
                                        <option value="4">Мини сериалы</option>
                                    </select>
                                </div>
                            </div>

                            <!-- Country Select -->
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Страны</label>
                                    <select v-model="countriesArr" class="form-select" multiple>
                                        <option disabled value="null">Выберите страны</option>
                                        <template v-for="country in resultCountries">
                                            <option  :value="country.id">{{country.title}}</option>
                                        </template>
                                    </select>
                                </div>
                            </div>

                            <!-- Year -->
                            <div class="col-sm-6">
                            <div class="form-group">
                                <label>Год:</label>
                                <input v-model="inputArr.endYear" type="text" placeholder="Выберите год" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
                            </div>
                            </div>


                            <!-- Duration Parse -->
                            <div class="col-sm-6">
                            <div class="form-group">
                                <label for="filmLength">Продолжительность:</label>
                                <input v-model="inputArr.filmLength" type="text" class="form-control" id="filmLength" placeholder="В минутах">
                            </div>
                            </div>

                            <!-- Rate Parse -->
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="ratingKinopoisk">Рейтинг:</label>
                                    <input v-model="inputArr.rate" type="text" class="form-control" id="ratingKinopoisk" placeholder="Рейтинг">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group">
                                <label for="slogan">Слоган:</label>
                                <input v-model="inputArr.slogan" type="text" class="form-control" id="slogan" placeholder="Слоган">
                            </div>

                            <div class="form-group">
                                <label class="d-block" for="description">Описание:</label>

                                <textarea class="w-100" v-model="inputArr.description" id="description" rows="10" placeholder="Вставьте описание"></textarea>
                            </div>


                        </div>

                        <div class="card-footer">
                            <button @click.prevent="updateMovie()" type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>

                <!-- /.card-body -->
            </div>

            <template v-if="errors !== null">
                <div class="form-group" v-for="error in errors">
                    <div class="alert alert-danger" v-for="item in error">{{item}}</div>
                </div>
            </template>

        </div>

</template>

<script>

    import Dropzone from 'dropzone'

    export default {
        name: "Admin",

        data(){
            return{
                inputArr: {},
                countriesArr: [],
                subcategoriesArr: [],

                resultCategories: null,
                resultSubcategories: null,
                resultCountries: null,

                dropZone: null,

                errors: null,
            }
        },

        mounted(){
            this.getCategory()
            this.getCountriesList()
            this.takeMovie()

            this.inputArr.category = null
            this.inputArr.subcategories = []
            this.inputArr.countries = []
            this.inputArr.type = ''

            this.dropZone = new Dropzone(this.$refs.dropZone, {
                url: "/api/account/store_user_certificates",
                autoProcessQueue: false,
                addRemoveLinks: true,
                thumbnailWidth: 300,
                thumbnailMethod: 'contain',
                uploadMultiple: false,
            })

        },



        methods:{

            takeMovie(){
                axios.get(`/api/movie/${this.$route.params.id}`)
                .then(response=>{
                    this.inputArr = response.data.data

                    response.data.data.countries.forEach(elem=>{
                        this.countriesArr.push(elem.id)
                    })

                    response.data.data.subcategories.forEach(elem=>{
                        this.subcategoriesArr.push(elem.id)
                    })
                    this.getSubcateroiesList()
                })
            },

            getCategory(){
                axios.get(`/api/categories`)
                    .then(response=>{

                        this.resultCategories = response.data.data

                    })
            },

            getSubcateroiesList(){
                axios.get(`/api/subcategories?category=${this.inputArr.category}`)
                    .then(response=>{
                     this.resultSubcategories = response.data.data
                    })
            },
            getCountriesList(){
                axios.get(`/api/countries`)
                    .then(response=>{

                        this.resultCountries = response.data.data
                    })
            },

            updateMovie(){
                const data = new FormData()
                const files = this.dropZone.getAcceptedFiles()
                    files.forEach(file => {
                        data.append('files[]', file);
                    })
                data.append('kinopoisk_id', this.inputArr.kinopoisk_id)
                data.append('nameRu', this.inputArr.nameRu)
                data.append('nameOriginal', this.inputArr.nameOriginal)
                data.append('countries', this.countriesArr)
                data.append('category_id', this.inputArr.category)
                data.append('subcategories', this.subcategoriesArr)
                data.append('year', this.inputArr.endYear)
                data.append('duration', this.inputArr.filmLength)
                data.append('rate', this.inputArr.rate)
                data.append('slogan', this.inputArr.slogan)
                data.append('description', this.inputArr.description)
                data.append('type', this.inputArr.type)

                    axios.post(`/api/movies/update/${this.$route.params.id}`, data)
                        .then(resp => {

                            files.forEach(file => {
                                this.dropZone.removeFile(file)
                            })

                            this.$router.push({name: 'videos'})

                        }).catch(e => {
                        this.errors = e.response.data.errors
                        console.log(this.errors)
                        setTimeout(this.errorsDismiss, 4000)
                    })

            },
            errorsDismiss(){
                this.errors = {}
            },

        },
    }
</script>

<style scoped>

</style>
