<template>

    <section class="content">
        <div class="container-fluid">
            <div class="row">

                <div class="col-md-6">
                    <!-- general form elements -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Add category</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="categoryTitle">Category Title</label>
                                    <input v-model="newCategoryTitle" type="text" class="form-control" id="categoryTitle" placeholder="Название категории">
                                </div>
                                <div class="form-group">
                                    <label for="categoryLogo">CategoryLogo</label>
                                    <input v-model="newCategoryLogo" type="text" class="form-control" id="categoryLogo" placeholder="Logo категории">
                                </div>
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <button @click.prevent="newCategory()" type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                    <!-- /.card -->


                </div>

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Категории:</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body p-0">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th style="width: 10px">#</th>
                    <th>Title</th>
                    <th>Category logo</th>
                    <th>Action</th>
                    <th></th>

                </tr>
                </thead>
                <tbody>
                <template v-for="category in categories">
                    <tr :class="isEdit(category.id)? 'd-none' : ''">
                        <td>{{category.id}}</td>
                        <td>{{category.title}}</td>
                        <td> <i :class="category.category_logo"></i></td>
                        <td>
                            <button @click="getChangeInfo(category.id, category.title, category.category_logo)" type="button" class="btn btn-block btn-warning btn-sm w-50"><i class="fa-solid fa-pen-to-square"></i></button>
                        </td>
                        <td>
                            <button @click="deleteCategory(category.id)" type="button" class="btn btn-block btn-danger btn-sm w-50"><i class="fa-solid fa-trash"></i></button>
                        </td>
                    </tr>

                    <tr :class="isEdit(category.id)? '' : 'd-none'">
                        <td>{{category.id}}</td>
                        <td><input type="text" v-model="categoryTitle"></td>
                        <td><input type="text" v-model="logo"></td>
                        <td>
                            <button @click="send(category.id, categoryTitle, logo)" type="button" class="btn btn-block btn-success btn-sm w-50"><i class="fa-solid fa-check"></i></button>
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
                categories: null,
                editId: null,
                categoryTitle: null,
                logo: null,
                newCategoryTitle: null,
                newCategoryLogo: null,
            }
        },

        mounted(){
            this.getCategories()
        },

        methods:{
            getCategories(){
                axios.get('/api/categories')
                .then(response=>{
                    this.categories = response.data.data
                })
            },
            isEdit(itemId) {
                return this.editId === itemId
            },
            getChangeInfo(id, title, logo){
                this.editId = id
                this.categoryTitle = title
                this.logo = logo
            },

            send(id, title, logo){
                axios.patch(`/api/categories/update/${id}`, {title: title, category_logo: logo})
                .then(response=>{
                        this.editId = null
                        this.categoryTitle = null
                        this.logo = null
                    this.getCategories()
                })
            },

            deleteCategory(id){
                axios.delete(`/api/categories/destroy/${id}`)
                .then(response=>{
                    this.getCategories()
                })

            },

            newCategory(){
                axios.post('/api/categories/create_category', {title: this.newCategoryTitle, category_logo: this.newCategoryLogo})
                .then(response=>{
                    this.getCategories()
                })
            },

        },

    }
</script>

<style scoped>

</style>
