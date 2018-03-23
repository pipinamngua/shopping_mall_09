<template>
<div>
    <form v-on:submit.prevent="createProduct()" methods="post" action="">
        <div class="row">
            <div class="col-md-6">
                <div v-bind:class="{ 'form-group': true, 'has-error' : errors.category }">
                    <label for="">Category</label>
                    <select name="" class="form-control" 
                        v-model="product.category">
                        <option v-for="category in categories" 
                        v-bind:value="category.id" 
                        v-text="category.category_name"></option>
                    </select>
                    <span v-if="errors.category" class="error">{{ errors.category[0] }}</span>
                </div>
                <div v-bind:class="{ 'form-group': true, 'has-error' : errors.product_name }">
                    <label for="">Product Name</label>
                    <input type="text" class="form-control" 
                        v-model="product.product_name">
                    <span v-if="errors.product_name" class="error">{{ errors.product_name[0] }}</span>
                </div>
                <div v-bind:class="{ 'form-group': true, 'has-error' : errors.description }">
                    <label for="">Description</label>
                    <input type="text" class="form-control" 
                        v-model="product.description">
                    <span v-if="errors.description" class="error">{{ errors.description[0] }}</span>
                </div>
            </div>
            <div class="col-md-6">
                <div v-bind:class="{ 'form-group': true, 'has-error' : errors.image }">
                    <label for="">Image</label>
                    <input type="file" class="form-control" 
                        @change="selectedImage">
                    <span v-if="errors.image" v-for="errors in errors.image" class="error">{{ errors }}</span>
                </div>
                <div v-bind:class="{ 'form-group': true, 'has-error' : errors.original_price }">
                    <label for="">Original Price</label>
                    <input type="text" class="form-control" 
                        v-model="product.original_price">
                    <span v-if="errors.original_price" class="error">{{ errors.original_price[0] }}</span>
                </div>
                <div v-bind:class="{ 'form-group': true, 'has-error' : errors.status }">
                    <label for="">Status</label>
                    <select name="" class="form-control" v-model="product.status">
                        <option v-bind:value="1" v-text="1"></option>
                        <option v-bind:value="0" v-text="0"></option>
                    </select>
                    <span v-if="errors.status" class="error">{{ errors.status[0] }}</span>
                </div>
            </div>
        </div>
        <div class="form-group">
            <input type="submit" class="btn btn-primary" value="Create New Product">
        </div>
    </form>
    <table class=" table table-striped table-bordered table-condensed">
        <thead>
            <tr>
                <th>STT</th>
                <th>Category</th>
                <th>Product Name</th>
                <th>Description</th>
                <th>Image</th>
                <th>Original Price</th>
                <th>Status</th>
                <th colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
            <product v-for="product in products" 
                v-bind:key="product.id" 
                v-bind:product="product"
                @update-product = 'getvueproduct'
                @delete-product = 'deleteProduct'></product>
        </tbody>
    </table>
    <div v-bind:style="styleObject">
        <nav v-if="pagination.last_page>1">
            <ul class="pagination">
                <li v-if="pagination.current_page > 1">
                    <a href="#" aria-label="Previous"
                        @click.prevent="changePage(pagination.current_page - 1)">
                    <span aria-hidden="true">«</span>
                    </a>
                </li>
                <li v-for="page of pagesNumber"
                    v-bind:class="[ page == isActived ? 'active' : '']">
                    <a href="#"
                        @click.prevent="changePage(page)">{{ page }}</a>
                </li>
                <li v-if="pagination.current_page < pagination.last_page">
                    <a href="#" aria-label="Next"
                        @click.prevent="changePage(pagination.current_page + 1)">
                    <span aria-hidden="true">»</span>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</div>
</template>
<script>
import product from "./Product.vue";
export default {
    components: {
        product
    },
    data() {
        return {
            products: [],
            categories: [],
            errors: [],
            product: {
                category: '',
                product_name: '',
                description: '',
                image: '',
                original_price: '',
                status: 1
            },
            pagination: {
                total: 0,
                per_page: 2,
                from: 1,
                to: 0,
                current_page: 1
            },
            offset: 4,
            styleObject: {
                textAlign: 'center'
            }
        };

    },
    created() {
        this.getCategories();
        this.getvueproduct(this.pagination.current_page);
    },
    computed: {
        isActived: function () {
            return this.pagination.current_page;
        },
        pagesNumber: function () {
            if (!this.pagination.to) {
                return [];
            }
            var from = this.pagination.current_page - this.offset;
            if (from < 1) {
                from = 1;
            }
            var to = from + (this.offset * 2);
            if (to >= this.pagination.current_page) {
                to = this.pagination.last_page;
            }
            var pagesArray = [];
            while (from <= to) {
                pagesArray.push(from);
                from++;
            }
            return pagesArray;
        }
    },
    methods: {
        getvueproduct: function (page) {
            axios.get('/admin/products?page=' + page).then((response) => {
                this.products = response.data.data.data;
                this.pagination = response.data.pagination;

            });
        },
        selectedImage(event) {
            var fileReader = new FileReader();
            fileReader.readAsDataURL(event.target.files[0]);
            fileReader.onload = (event) => {
                this.product.image = event.target.result;
            }
        },

        createProduct() {
            axios.post('admin/products', this.product)
                .then(response => {
                    this.products.unshift(response.data);
                    this.product = {
                        category: '',
                        product_name: '',
                        description: '',
                        image: '',
                        original_price: '',
                        status: 1
                    };
                    if (this.errors) {
                        this.errors = []
                    }
                })
                .catch(error => {
                    if (error.response.status == 422) {
                        this.errors = error.response.data.errors;
                    }
                })
        },
        getCategories() {
            axios.get('admin/getAllCategory').then(response => {
                this.categories = response.data;
            });
        },
        deleteProduct(product) {
            axios.delete("admin/products/" + product.id).then(response => {
                let index = this.products.indexOf(product);
                if (confirm('do you really want to delete this product?')) {
                    this.products.splice(index, 1);
                }

            })
        },
        changePage: function (page) {
            this.pagination.current_page = page;
            this.getvueproduct(page);
        },

    }
}
</script>
