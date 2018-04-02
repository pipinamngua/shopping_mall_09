<template>
	<tr>
		<td>
			{{product.id}}
		</td>
		<td>
	        <select name="" class="form-control" v-model="editForm.category" v-if="edit">
                <option v-for="category in categories" 
                v-bind:value="category.id" 
                v-text="category.category_name"></option>
            </select>
            <span>{{product.category_id}}</span>
		</td>
		<td>
			<input type="text" v-model="editForm.product_name" @keyup.enter="updateProduct(product, editForm)" class="form-control" v-if="edit">
        	<span>{{product.product_name}}</span>
			
		</td>
		<td>
			<input type="text" v-model="editForm.description" @keyup.enter="updateProduct(product, editForm)" class="form-control" v-if="edit">
        	<span>{{product.description}}</span>
			
		</td>
		<td>
			<input type="file" v-on:change="selectedImage" class="form-control" v-if="edit">
			<img :src="config_path + product.image_path" :style="styleObject">
		</td>
		<td>
			<input type="text" v-model="editForm.original_price" @keyup.enter="updateProduct(product, editForm)" class="form-control" v-if="edit">
        	<span>{{product.original_price}}</span>
			
		</td>
		<td>
			<input type="text" v-model="editForm.status" @keyup.enter="updateProduct(product, editForm)" class="form-control" v-if="edit">
        	<span>{{product.status}}</span>
		</td>
		<td>
			<a v-bind:href="url + editForm.id" class="btn btn-primary">Add Colors</a>
		</td>
		<td>
        <button @click="editProduct" type="button" class="btn btn-info" 
            v-if="!edit">
        Edit</button>
        <button @click="cancelProduct" type="button" class="btn btn-default" 
            v-if="edit">
        Cancel</button>
	    </td>
	    <td>
	    	<button type="button" 
            class="btn btn-info" 
            @click="updateProduct(product, editForm)" 
            v-if="edit">
	        Update
	        </button>
	        <button type="button" 
	            @click="$emit('delete-product', product)" 
	            class="btn btn-danger" 
	            v-if="!edit">
	            Delete
	        </button>
	    </td>
	</tr>
</template>

<script>
export default {
    props: ['product'],
    data() {
        return {
            products: '',
            edit: false,
            editForm: {
                id: '',
                category: '',
                product_name: '',
                description: '',
                image: '',
                original_price: '',
                status: 1
            },
            config_path: 'http://localhost:8000/images/',
            styleObject: {
                width: '70px',
                height: '70px'
            },
            url: 'admin/products/addColors/',
            categories: []
        };

    },
    created() {
        this.getCategories();
        this.bindId();
    },
    methods: {
        bindId() {
            this.editForm.id = this.product.id;
        },
        selectedImage(event) {
            var fileReader = new FileReader();
            fileReader.readAsDataURL(event.target.files[0]);
            fileReader.onload = (event) => {
                this.editForm.image = event.target.result;
            }
        },
        editProduct() {
            this.edit = true;
            this.editForm.product_name = this.product.product_name;
            this.editForm.category = this.product.category_id;
            this.editForm.description = this.product.description;
            this.editForm.original_price = this.product.original_price;
            this.editForm.status = this.product.status;
        },
        cancelProduct() {
            this.edit = false;
            this.editForm.product_name = '';
            this.editForm.category = '';
            this.editForm.description = '';
            this.editForm.original_price = '';
            this.editForm.status = '';
        },

        updateProduct(oldProduct, newProduct) {
            axios.patch("admin/products/" + oldProduct.id, newProduct).then(response => {
                this.$emit('update-product');
                toastr.success('successfully');
                this.cancelProduct();
            })
        },
        getCategories() {
            axios.get('admin/getAllCategory').then(response => {
                this.categories = response.data;
            });
        }
    }

}
</script>
