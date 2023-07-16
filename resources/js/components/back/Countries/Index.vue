<template>

    <section class="content">
        <div class="container-fluid">
            <div class="row">

                <div class="col-md-6">
                    <!-- general form elements -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Add country</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="countryTitle">Country Title</label>
                                    <input v-model="newCountryTitle" type="text" class="form-control" id="countryTitle" placeholder="Название страны">
                                </div>
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <button @click.prevent="newCountry()" type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                    <!-- /.card -->


                </div>

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Страны:</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body p-0">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th style="width: 10px">#</th>
                    <th>Title</th>
                    <th>Action</th>

                </tr>
                </thead>
                <tbody>
                <template v-for="country in countries">
                    <tr :class="isEdit(country.id)? 'd-none' : ''">
                        <td>{{country.id}}</td>
                        <td>{{country.title}}</td>
                        <td>
                            <button @click="getChangeInfo(country.id, country.title)" type="button" class="btn btn-block btn-warning btn-sm w-50">Redact</button>
                            <button @click="deleteCountry(country.id)" type="button" class="btn btn-block btn-danger btn-sm w-50">Delete</button>

                        </td>
                    </tr>

                    <tr :class="isEdit(country.id)? '' : 'd-none'">
                        <td>{{country.id}}</td>
                        <td><input type="text" v-model="countryTitle"></td>
                        <td>
                            <button @click="send(country.id, countryTitle)" type="button" class="btn btn-block btn-warning btn-sm w-50">Submit</button>
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
                countries: null,
                editId: null,
                countryTitle: null,
                newCountryTitle: null,
            }
        },

        mounted(){
            this.getCountries()
        },

        methods:{
            getCountries(){
                axios.get('/api/countries')
                .then(response=>{
                    this.countries = response.data.data
                })
            },
            isEdit(itemId) {
                return this.editId === itemId
            },
            getChangeInfo(id, title){
                this.editId = id
                this.countryTitle = title
            },

            send(id, title){
                axios.patch(`/api/countries/update/${id}`, {title: title})
                .then(response=>{
                        this.editId = null
                        this.countryTitle = null
                    this.getCountries()
                })
            },

            deleteCountry(id){
                axios.delete(`/api/countries/destroy/${id}`)
                .then(response=>{
                    this.getCountries()
                })

            },

            newCountry(){
                axios.post('/api/countries/create_country', {title: this.newCountryTitle})
                .then(response=>{
                    this.newCountryTitle = null,
                    this.getCountries()
                })
            },

        },

    }
</script>

<style scoped>

</style>
