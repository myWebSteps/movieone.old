<template>

    <section class="content">
        <div class="container-fluid">
            <div class="row">

                <div class="col-md-6">
                    <!-- general form elements -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Choose category</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form>
                            <div class="card-body">
                                <div class="form-group">

                                    <select @change.prevent="subcategoriesOfCategory()" class="form-select" v-model="requestedCategory">
                                        <option :value="null">Choose category</option>
                                        <option v-for="category in categories" :value="category.id">{{category.title}}</option>
                                    </select>

                                </div>
                            </div>
                            <!-- /.card-body -->
                        </form>
                    </div>
                    <!-- /.card -->
                </div>

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Субкатегории:</h3>
        </div>
        <!-- /.card-header -->
        <div v-if="subcategories != null" class="card-body p-0">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th style="width: 10px">#</th>
                    <th>Title</th>
                    <th>Action</th>

                </tr>
                </thead>
                <tbody>
                <template v-for="subcategory in subcategories">
                    <tr :class="isEdit(subcategory.id)? 'd-none' : ''">
                        <td>{{subcategory.id}}</td>
                        <td>{{subcategory.title}}</td>
                        <td>
                            <button @click="getChangeInfo(subcategory.id, subcategory.title)" type="button" class="btn btn-block btn-warning btn-sm w-50">Redact</button>
                            <button @click="deleteSubCategory(subcategory.id)" type="button" class="btn btn-block btn-danger btn-sm w-50">Delete</button>

                        </td>
                    </tr>

                    <tr :class="isEdit(subcategory.id)? '' : 'd-none'">
                        <td>{{subcategory.id}}</td>
                        <td><input type="text" v-model="subcategory.title"></td>
                        <td>
                            <button @click="updateSubcategory(subcategory.id, this.requestedCategory, subcategory.title)" type="button" class="btn btn-block btn-warning btn-sm w-50">Submit</button>
                        </td>
                    </tr>


                </template>
                </tbody>
            </table>



        </div>
        <!-- /.card-body -->
    </div>

                <div class="col-md-6" v-if="requestedCategory != null">
                    <!-- general form elements -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Add Subcategory</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="addSubcategoryTitle">Title</label>
                                    <input v-model="newSubcategory" type="text" class="form-control" id="addSubcategoryTitle" placeholder="Add subcategory title">
                                </div>

                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                <button @click.prevent="createSubcategory()" type="submit" class="btn btn-primary">Add subcategory</button>
                            </div>
                        </form>
                    </div>
                    <!-- /.card -->
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
                editId: null,
                categories: null,
                subcategories: null,
                requestedCategory: null,
                newSubcategory: null,
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

            subcategoriesOfCategory(){
                axios.get(`/api/subcategories?category=${this.requestedCategory}`)
                .then(response=>{
                    this.subcategories = response.data.data
                })
            },

            isEdit(itemId) {
                return this.editId === itemId
            },

            getChangeInfo(id, title){
                this.editId = id
                this.categoryTitle = title
            },

            updateSubcategory(subcategoryId, categoryId, categoryTitle){
                axios.patch(`/api/subcategories/update/${subcategoryId}`, {category_id: categoryId, title: categoryTitle})
                .then(response=>{
                    this.editId = null
                    this.subcategoriesOfCategory()
                })
            },

            deleteSubCategory(id){
                axios.delete(`/api/subcategories/destroy/${id}`)
                .then(response=>{
                    this.subcategoriesOfCategory()
                })

            },

            createSubcategory(){
                axios.post('/api/subcategories/create', {category_id: this.requestedCategory, title: this.newSubcategory})
                .then(response=>{
                    this.newSubcategory = null
                    this.subcategoriesOfCategory()
                })
            },
        },

    }
</script>

<style scoped>

</style>
