<template>
        <div class="row m-3">
            <div class="accordion accordion-flush col-sm-6 m-3">
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                            Parser
                        </button>
                    </h2>
                    <div id="flush-collapseOne" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                        <div class="accordion-body">
                            <div class="input-group mb-3">
                                <input v-model="kinopoiskId" type="number" class="form-control" placeholder="Введите номер видео по Кинопоиску" aria-label="Recipient's username" aria-describedby="basic-addon2" wfd-id="id1">
                                <span @click.prevent="parse()" type="button" class="input-group-text" id="basic-addon2">Parse</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card card-warning">
                <div class="card-header">
                    <h3 class="card-title">Добавление видео</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <form>
                        <div class="row">
                            <div class="col-sm-6">
                                <!-- Kinopoisk ID -->
                                <div class="form-group">
                                    <label for="KinopoiskId">Кинопоиск ID:</label>
                                    <input v-model="parseResult.kinopoiskId" type="number" class="form-control" id="KinopoiskId" placeholder="Введите Кинопоиск ID">
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <!-- Kinopoisk ID -->
                                <div class="form-group">
                                    <label for="testId">Наличие в БД:</label>
                                    <button @click="checkInBD(parseResult.kinopoiskId)" type="button" class="btn btn-block btn-info" id="testId">Тест</button>
                                    <div v-if="testId != null">
                                        <div v-if="testId === 1" class="alert alert-danger" role="alert">
                                            Present in Database
                                        </div>
                                        <div v-if="testId === 2"  class="alert alert-info" role="alert">
                                            Absent in Database
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <!-- Video Test -->
                            <div class="col-sm-6">
                                <div class="form-group mt-3" v-if="parseResult.kinopoiskId != null">
                                    <div class="accordion accordion-flush">
                                        <div class="accordion-item">
                                            <h2 class="accordion-header">
                                                <button @click.prevent="testVideo()" class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
                                                    Тест Видео
                                                </button>
                                            </h2>
                                            <div id="flush-collapseTwo" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                                                <div class="accordion-body alert alert-info">
                                                    <div class="kinobox_player"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">

                            <!-- NameRu -->
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="nameRu">Русское название:</label>
                                    <input v-model="parseResult.nameRu" type="text" class="form-control" id="nameRu" placeholder="Введите русское название">
                                </div>
                            </div>

                            <!-- NameOriginal -->
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="nameOriginal">Оригинальное название:</label>
                                    <input v-model="parseResult.nameOriginal" type="text" class="form-control" id="nameOriginal" placeholder="Введите русское название">
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

                            <!--poster Upload Parse -->
                            <div class="col-sm-6">
                                <div class="form-group" v-if="parseResult.posterUrlPreview != null">
                                    <label for="posterUpload">Пример Постера на Кинопоиск:</label>
                                    <div class="alert alert-info">
                                        <a :href="parseResult.posterUrlPreview" target="_blank">Перейти к постеру</a>
                                    </div>
                                </div>
                            </div>

                            <!-- Country Select -->
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Страны</label>
                                    <select v-model="inputArr.countries" class="form-select" multiple>
                                        <option disabled value="null">Выберите страны</option>
                                        <template v-for="country in resultCountries">
                                            <option  :value="country.id">{{country.title}}</option>
                                        </template>
                                    </select>
                                </div>
                            </div>
                            <!-- Countries Select Parse -->
                            <div class="col-sm-6">
                                <div class="form-group" v-if="parseResult.countries != null">
                                    <div class="alert alert-info">
                                        <label>Страны по версии Кинопоиска:</label>
                                        <p>
                                            <span v-for="country in parseResult.countries">
                                                {{country.country}}&nbsp
                                            </span>

                                        </p>
                                    </div>
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
                            <!-- Cat Select Parse -->
                            <div class="col-sm-6">
                            <div class="form-group" v-if="parseResult.type != null">
                                <div class="alert alert-info">
                                    <label>Категории по версии Кинопоиска:</label>
                                    <p>
                                        {{parseResult.type}}

                                    </p>
                                </div>
                            </div>
                            </div>

                            <!--SubCat Select -->
                            <div class="col-sm-6">
                            <div class="form-group" v-if="resultSubcategories != null">
                                <label>Субкатегории</label>
                                <select v-model="inputArr.subcategories" multiple placeholder="Можно выбрать несколько" style="width: 100%" class="form-select">
                                    <option v-for="subCategory in resultSubcategories" :value="subCategory.id">{{subCategory.title}}</option>
                                </select>
                            </div>
                        </div>

                            <!--SubCat Select Parse-->
                            <div class="col-sm-6">
                            <div class="form-group" v-if="parseResult.genres != null">
                                <div class="alert alert-info">
                                    <label>Субкатегории по версии Кинопоиска:</label>
                                    <p>
                                    <span v-for="genre in parseResult.genres">
                                        {{genre.genre}} &nbsp
                                    </span>

                                    </p>
                                </div>
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

                            <!--Type Select Parse-->
                            <div class="col-sm-6">
                                <div class="form-group" v-if="parseResult.type != null">
                                    <label>Тип по версии Кинопоиска:</label>
                                    <div class="alert alert-info">
                                        <p>
                                            {{parseResult.type}}
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <!-- Year -->
                            <div class="col-sm-6">
                            <div class="form-group">
                                <label>Год:</label>
                                <input v-model="parseResult.year" type="text" placeholder="Выберите год" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
                            </div>
                            </div>

                            <!-- Year Parse -->
                            <div class="col-sm-6">
                            <div class="form-group" v-if="parseResult.year != null">
                                <div class="alert alert-info" >
                                    <label>Год по версии Кинопоиска:</label>
                                    <p>
                                        {{parseResult.year}}
                                    </p>
                                </div>
                            </div>
                            </div>

                            <!-- Duration Parse -->
                            <div class="col-sm-6">
                            <div class="form-group">
                                <label for="filmLength">Продолжительность:</label>
                                <input v-model="parseResult.filmLength" type="text" class="form-control" id="filmLength" placeholder="В минутах">
                            </div>
                            </div>

                            <!-- Rate Parse -->
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="ratingKinopoisk">Рейтинг:</label>
                                    <input v-model="parseResult.ratingKinopoisk" type="text" class="form-control" id="ratingKinopoisk" placeholder="Рейтинг">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group">
                                <label for="slogan">Слоган:</label>
                                <input v-model="parseResult.slogan" type="text" class="form-control" id="slogan" placeholder="Слоган">
                            </div>

                            <div class="form-group">
                                <label class="d-block" for="description">Описание:</label>

                                <textarea class="w-100" v-model="parseResult.description" id="description" rows="10" placeholder="Вставьте описание"></textarea>
                            </div>


                        </div>

                        <div class="card-footer">
                            <button @click.prevent="store()" type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>

                <!-- /.card-body -->
            </div>

        </div>

</template>

<script>

    import Dropzone from 'dropzone'

    export default {
        name: "Admin",

        data(){
            return{
                kinopoiskId: null,
                parseResult: {},

                inputArr: {},

                resultCategories: null,
                resultSubcategories: null,
                resultCountries: null,

                dropZone: null,

                testId: null,
            }
        },

        mounted(){
            this.getCategory()
            this.getCountriesList()


            this.parseResult.kinopoiskId = null
            this.parseResult.genres = null
            this.parseResult.nameRu = null
            this.parseResult.nameOriginal = null
            this.parseResult.filmLength = null
            this.parseResult.type = null
            this.parseResult.ratingKinopoisk = null
            this.parseResult.slogan = null
            this.parseResult.description = null
            this.parseResult.ratingKinopoisk = null
            this.parseResult.posterUrlPreview = null
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
            parse()
            {
                axios.get(`https://kinopoiskapiunofficial.tech/api/v2.2/films/${this.kinopoiskId}`,
                    {headers: {
                            'X-API-KEY': 'e3409535-696e-40cb-8764-86dda0af9f48',
                            'Content-Type': 'application/json',
                        }})
                    .then(response=>{
                    this.parseResult = response.data
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

            checkInBD(id){
                axios.post('/api/movies/test_in_bd',{kinopoisk_id: String(id)})
                .then(response=>{
                    if(response.data.length > 0){
                        this.testId = 1
                    }else{
                        this.testId = 2
                    }
                })
            },

            testVideo(){
                new Kinobox('.kinobox_player', {
                    'X-Settings': {
                        "Alloha" : {
                            "enable": true,
                            "position": 1,
                            "token": "",
                        },
                        "Ashdi": {
                            "enable": true,
                            "position": 2,
                            "token": "",
                        },
                        "Bazon": {
                            "enable": true,
                            "position": 3,
                            "token": "",
                        },
                        "Cdnmovies": {
                            "enable": true,
                            "position": 4,
                            "token": "",
                        },
                        "Collaps":{
                            "enable": true,
                            "position": 5,
                            "token": "",
                        },
                        "Hdvb":{
                            "enable": true,
                            "position": 6,
                            "token": "",
                        },
                        "Iframe":{
                            "enable": true,
                            "position": 7,
                            "token": "",
                        },
                        "Kodik":{
                            "enable": true,
                            "position": 8,
                            "token": "",
                        },
                        "Videocdn": {
                            "enable": true,
                            "position": 9,
                            "token": "",
                        },
                        "Voidboost": {
                            "enable": true,
                            "position": 10,
                            "token": "",
                        },

                    },
                    search: {
                        kinopoisk: this.parseResult.kinopoiskId,
                        title: this.parseResult.nameOriginal
                    }
                }).init();
            },

            store() {
                const data = new FormData()
                const files = this.dropZone.getAcceptedFiles()
                files.forEach(file => {
                    data.append('files[]', file);
                })

                data.append('kinopoisk_id', this.parseResult.kinopoiskId)
                data.append('nameRu', this.parseResult.nameRu)
                data.append('nameOriginal', this.parseResult.nameOriginal)
                data.append('countries', this.inputArr.countries)
                data.append('category_id', this.inputArr.category)
                data.append('subcategories', this.inputArr.subcategories)
                data.append('year', this.parseResult.year)
                data.append('duration', this.parseResult.filmLength)
                data.append('rate', this.parseResult.ratingKinopoisk)
                data.append('slogan', this.parseResult.slogan)
                data.append('description', this.parseResult.description)
                data.append('type', this.inputArr.type)



                axios.post('/api/movies/store', data)
                    .then(resp => {
                        this.kinopoiskId = null
                        this.parseResult.kinopoiskId = null
                        this.parseResult.nameRu = null
                        this.parseResult.nameOriginal = null
                        this.inputArr.category = null
                        this.inputArr.subcategories = []
                        this.parseResult.year = null
                        this.parseResult.filmLength = null
                        this.parseResult.ratingKinopoisk = null
                        this.parseResult.slogan = null
                        this.parseResult.description = null
                        this.inputArr.type = ''
                        this.resultSubcategories = null
                        this.inputArr.countries = null

                        files.forEach(file => {
                            this.dropZone.removeFile(file)
                        })

                    }).catch(e => {
                    // this.errors = e.response.data.errors
                    // setTimeout(this.errorsDismiss, 4000)
                })
            },




        },
    }
</script>

<style scoped>

</style>
