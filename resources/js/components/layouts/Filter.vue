<template>
        <div class="row w-100 mb-3 pl-3 pr-3">

            <div class="col-xl-3 col-sm-8 d-inline">
                <label>Тип:</label>
                <select @change="makeQueryArr('type', inputArr.type)" v-model="inputArr.type" style="width: 100%" class="form-select">
                    <option value="">Кино и сериалы</option>
                    <option value="2">Кино</option>
                    <option value="3">Сериалы</option>
                    <option value="4">Мини сериалы</option>
                </select>
            </div>

            <div class="col-xl-3 col-sm-8 d-inline">
                <label for="genres">Жанр:</label>
                <select @change="makeQueryArr('subcategory', inputArr.subcategory)" v-model="inputArr.subcategory" id="genres" class="form-select mb-1" aria-label="Default select example">
                    <option value="">Все жанры</option>
                    <option v-for="subcategory in filter.subcategories" :value="subcategory.id">{{subcategory.title}}</option>

                </select>
            </div>

            <div class="col-xl-3 col-sm-8 d-inline">
                <label for="order">Сортировать по:</label>
                <select @change="makeQueryArr('order', inputArr.order)" v-model="inputArr.order" id="order" class="form-select mb-1" aria-label="Default select example">
                    <option value="year">Год</option>
                    <option value="rate">Рейтинг</option>
                </select>

            </div>
        </div>



</template>

<script>
    export default {
        name: "filter",

        data() {
            return {
                filter: {},
                inputArr: {},
                queryArr: {}
            }
        },


        mounted() {
            this.getSubcategories()
            this.applyInputArr()

        },

        methods: {
            getSubcategories() {
                axios.get(`/api/filterindex?category=${this.$route.query.category}`)
                    .then(response => {
                        this.filter.subcategories = response.data.data
                    })
            },

            applyInputArr(){
                if(this.$route.query.hasOwnProperty('category'))
                {
                    this.inputArr.category = this.$route.query.category
                }else{
                    this.inputArr.category = ''
                }

                if(this.$route.query.hasOwnProperty('subcategory'))
                {
                    this.inputArr.subcategory = this.$route.query.subcategory
                }else{
                    this.inputArr.subcategory = ''
                }

                if(this.$route.query.hasOwnProperty('type'))
                {
                    this.inputArr.type = this.$route.query.type
                }else{
                    this.inputArr.type = ''
                }

                if(this.$route.query.hasOwnProperty('order'))
                {
                    this.inputArr.order = this.$route.query.order
                }else{
                    this.inputArr.order = ''
                }
            },


            makeQueryArr(query, value){

                    this.inputArr[query] = value

                for(let key in this.inputArr){

                    if(this.inputArr[key] == ''){
                        if(this.queryArr.hasOwnProperty(key)){
                            delete this.queryArr[key]
                        }
                    }else{
                        this.queryArr[key] = this.inputArr[key]
                    }
                }

                this.$router.push({name: 'films', query: this.queryArr})
            }


        },


    }
</script>

<style scoped>
    .content-wrapper{
        min-height: fit-content;
    }
</style>
