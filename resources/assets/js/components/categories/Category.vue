<template>
<tr>
                        
    <td>
        
        {{ category.id }}
    </td>
    <td>
        <input type="text" v-model="editForm.category_name" class="form-control" v-if="edit">
        <span>{{ category.category_name }}</span>
    </td>
    <td>
        <select v-model="editForm.parent_id" v-if="edit" class="form-control">
            <option v-for="cate in categories" 
                    v-bind:value="cate.id"  
                    v-text="cate.category_name"> 
            </option>
        </select>
        <span v-else>{{ category.parent_id }}</span>
    </td>
    <td>
        {{ category.user_id }}
    </td>
    <td>
        <button @click="editCategory" type="button" class="btn btn-info" 
            v-if="!edit">
            Edit</button>

            <button @click="cancelCategory" type="button" class="btn btn-default" 
            v-if="edit">
            Cancel</button>
    </td>
    <td>
        <button type="button" 
            class="btn btn-info" 
            @click="updateCategory(category, editForm)" 
            v-if="edit">
            Update
            </button>
        <button type="button" 
        @click="$emit('delete-category', category)" 
        class="btn btn-danger" 
        v-if="!edit">Delete</button>
    </td>
</tr>
</template>
<script>
export default {
    props: ['category'],
    data() {
        return {
            categories: '',
            edit: false,
            editForm: {
                category_name: '',
                user_id: '',
                parent_id: ''
            }

        }
    },

    methods: {
        editCategory() {
            this.edit = true;
            this.editForm.category_name = this.category.category_name;
            this.editForm.parent_id = this.category.parent_id;
            axios.get("admin/category").then(response => {

                this.categories = response.data.categories;
            });
        },
        cancelCategory() {
            this.edit = false;
            this.editForm.category_name = '';
            this.editForm.user_id = '';
            this.editForm.parent_id = '';
        },

        updateCategory(oldCategory, newCategory) {
            axios.patch("admin/category/" + oldCategory.id, newCategory).then(response => {
                this.$emit('update-category');
                this.cancelCategory();
                console.log(response.data);
            })
        },
        deleteCategory(oldCategory, newCategory) {
            axios.patch("admin/customer/" + oldCategory.id, newCategory).then(response => {
                this.$emit('update-category');
                this.cancelCategory();
                console.log(response.data);
            })
        }
    }
}
</script>
