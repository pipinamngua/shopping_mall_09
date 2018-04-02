<template>
    <div>
        <form v-on:submit.prevent="createCategory" action="post">
            <div class="form-group">
                <label for="">Parent Categories</label>
                <select class="form-control" v-model="category.parent_id">
                    <option value="" v-if="!categories.length">---have no parent category---</option>
                    <option v-for="cate in categories" 
                        v-bind:value="cate.id"  
                        v-text="cate.category_name" v-else> 
                    </option>
                </select>
            </div>
            <div class="form-group">
                <label for="">Category Name</label>
                <input type="text" class="form-control" v-model="category.category_name">
                <span class="help-block" 
                v-for= "error in errors.category_name" 
                v-text="error">
                {{ error }}
                </span>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Create New Category">
            </div>
        </form>
        <table class=" table table-striped table-bordered table-condensed">
            <thead>
                <tr>
                    <th>STT</th>
                    <th>Categories</th>
                    <th>Parent Categories</th>
                    <th colspan="2">Action</th>
                </tr>
            </thead>
            <tbody>
                <category v-for = "category in categories" 
                    :key="category.id"
                    v-bind:category="category"
                    @update-category="fetchAll"
                    @delete-category="deleteCategory">
                </category>
            </tbody>
        </table>
    </div>
</template>

<script>
	import category from './Category.vue';
export default {
    data() {
        return {
            categories: [],
            errors: [],
            category: {
                id: '',
                category_name: '',
                user_id: '',
                parent_id: '',
            }
        }
    },
    components: {
        category
    },
    created() {
        this.fetchAll();
    },
    methods: {
        fetchAll() {
            axios.get("admin/category").then(response => {
                this.categories = response.data.categories;
            });
        },
        createCategory() {
            axios.post('admin/category/', this.category).then(response => {
                if (response.data.fail) {
                    toastr.warning(response.data.fail);
                } else {
                    this.categories.unshift(response.data.category);
                    toastr.success('successfully');
                    this.category = {
                        category_name: '',
                        user_id: '',
                        parent_id: '',
                        id: ''
                    }
                    if (this.errors) {
                        this.errors = [];
                    }
                }
                
            }, response => {
                this.errors = response.data.errors;
            });
        },
        deleteCategory(category) {
            axios.delete("admin/category/" + category.id).then(response => {
                let index = this.categories.indexOf(category);
                if (confirm('do you really want to delete this category?')) {
                    this.categories.splice(index, 1);
                    console.log(response.data);
                }

            })
        }
    }
}
</script>
