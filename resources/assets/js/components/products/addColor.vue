<template>
<div>
    <form v-on:submit.prevent="createProductAttribute" method="post" action="">
        <div class="row">
            <div class="col-md-6">
                <div v-bind:class="{ 'form-group': true, 'has-error' : errors.color_id }">
                    <label for="">Color</label>
                    <select v-model="product_attr.color_id" name="" class="form-control" id="">
                        <option v-for="color in colors" 
                            v-bind:value="color.id" 
                            v-text="color.color_name">1</option>
                    </select>
                    <span v-if="errors.color_id" class="error">{{ errors.color_id[0] }}</span>
                </div>
                <div v-bind:class="{ 'form-group': true, 'has-error' : errors.size_id }">
                    <label for="">Sizes</label>
                    <select v-model="product_attr.size_id" name="" class="form-control" id="">
                        <option v-for="size in sizes" 
                            v-bind:value="size.id" 
                            v-text="size.size_name">1</option>
                    </select>
                    <span v-if="errors.size_id" class="error">{{ errors.size_id[0] }}</span>
                </div>
                <div v-bind:class="{ 'form-group': true, 'has-error' : errors.quantity }">
                    <label for="">Quantity</label>
                    <input type="number" class="form-control" v-model="product_attr.quantity">
                    <span v-if="errors.quantity" class="error">{{ errors.quantity[0] }}</span>
                </div>
            </div>
            <div class="col-md-6">
                <div v-bind:class="{ 'form-group': true, 'has-error' : errors.image }">
                    <label for="">Image 1</label>
                    <input type="file" class="form-control" @change="selectedImage">
                    <span v-if="errors.image" class="error">{{ errors.image[0] }}</span>
                </div>
                <div v-bind:class="{ 'form-group': true, 'has-error' : errors.image }">
                    <label for="">Image 2</label>
                    <input type="file" class="form-control" @change="selectedImage">
                    <span v-if="errors.image" class="error">{{ errors.image[0] }}</span>
                </div>
                <div v-bind:class="{ 'form-group': true, 'has-error' : errors.image }">
                    <label for="">Image 3</label>
                    <input type="file" class="form-control" @change="selectedImage">
                    <span v-if="errors.image" class="error">{{ errors.image[0] }}</span>
                </div>
            </div>
        </div>
        <div class="form-group">
            <input type="submit" class="btn btn-primary" value="Create">
        </div>
    </form>
    <table id="myTable" class=" table table-striped table-bordered table-condensed">
        <thead>
            <tr>
                <th>Id</th>
                <th>Product Name</th>
                <th>Color</th>
                <th>Size</th>
                <th>Original Price</th>
                <th>Quantity</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="productAttr in product_attrs">
                <div class="modal fade" id="view-item" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                <h4 class="modal-title modal-lg">Chỉnh sửa sản phẩm</h4>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <strong>Product Name : </strong>
                                        <span>{{product_attr.product_name}}</span>
                                        <br>
                                        <strong>Color Name : </strong>
                                        <span>{{product_attr.color_name}}</span>
                                        <br>
                                        <strong>Size Name : </strong>
                                        <span>{{product_attr.size_name}}</span>
                                    </div>
                                    <div class="col-md-6">
                                        <strong>Original Price</strong>
                                        <span>{{product_attr.original_price}}$</span>
                                        <br>
                                        <strong>Quantity</strong>
                                        <span>{{product_attr.quantity}}</span>
                                    </div>
                                </div>
                                <br>
                                <div class="row" >
                                    <div v-for="color_image in color_images" class="col-md-4" 
                                        v-bind:style="style">
                                        <img :src="config_path + color_image.image_path" alt="" v-bind:style="styleObj">
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-success" @click="close">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal fade" id="edit-item" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                <h4 class="modal-title">Chỉnh sửa sản phẩm</h4>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <strong>Color Name : </strong>
                                            <span>{{attr.color_name}}</span>
                                        </div>
                                        <div class="form-group">
                                            <label for="">Name Size:</label>
                                            <select name="" v-model="attr.size_id" 
                                                class="form-control" >
                                                <option v-for="size in sizes" 
                                                    v-bind:value="size.id" 
                                                    v-text="size.size_name"></option>
                                            </select>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Quantity:</label>
                                            <input type="number" class="form-control" v-model="attr.quantity">
                                            <span class="error text-danger"></span>
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <hr>
                                <br>
                                <div class="row">
                                    <div class="col-md-4" v-for="colorImage in color_images">
                                        <input type="file" @change="selectedImageEdit">
                                        <br>
                                        <img :src="config_path + colorImage.image_path" 
                                            class="form-control" alt="" v-bind:style="styleObj">
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <div class="form-group">
                                    <button @click.prevent="update_product(edit_attr,attr)" class="btn btn-success">Update</button>
                                </div>
                                <div class="form-group">
                                    <button @click="close" class="btn btn-default">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <td>{{productAttr.id}}</td>
                <td>{{productAttr.product_name}}</td>
                <td>{{productAttr.color_name}}</td>
                <td>{{productAttr.size_name}}</td>
                <td>{{productAttr.original_price}}$</td>
                <td>{{productAttr.quantity}}</td>
                <td>
                    <a href="" @click.prevent="getColor_images(productAttr)">
                    <i class="fa fa-eye" aria-hidden="true"></i>
                    </a>
                    <a href="" @click.prevent ="edit_product(productAttr)">
                    <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                    </a>
                    <a href="" @click.prevent ="delete_product(productAttr)"><i class="fa fa-trash" aria-hidden="true"></i></a>        
                </td>
            </tr>
        </tbody>
    </table>
</div>

</template>

<script>
export default {
    data() {
        return {
            product_attrs: [],
            errors: [],
            product_attr: {
                id : '',
                product_id: '',
                product_name: '',
                color_name: '',
                size_name: '',
                original_price: '',
                quantity: '',
                size_id: '',
                quantity: '',
                image: [],
            },
            edit_attr :{
                id : '',
                product_id: '',
                color_id: '',
            },
            attr: {
                id : '',
                product_attr_id : '',
                product_color_id : '',
                product_id : '',
                color_id: '',
                color_name: '',
                size_id: '',
                quantity: '',
                image: [],
                image_id : [],
            },
            fillProductAttr: {
                product_id: '',
                product_name: '',
                color_id: '',
                color_name: '',
                size_id: '',
                size_name: '',
                quantity: '',
                image: [],
            },
            color_images : [],
            categories: [],
            sizes: [],
            colors: [],
            styleObj : {
                width: '200px',
                height: '200px',
                background: 'white',
                padding: '5px',
                boxShadow: '0px 0px 5px grey'
            },
            style : {
                textAlign : 'center',
            },
            config_path: 'http://localhost:8000/images/',
        }
    },
    created() {
        this.product_attr.product_id = window.id;
        this.getAllProductAttributes(this.product_attr);
        this.getColors();
        this.getSizes();
    },
    computed: {
        server_data: function () {
            return window.id;
        }
    },
    methods: {
        getSizes() {
            axios.get('admin/getAllSizes').then(response => {
                this.sizes = response.data;
            })
        },

        getColors() {
            axios.get('admin/getAllColors').then(response => {
                this.colors = response.data;
            })
        },

        selectedImage(event) {
            var fileReader = new FileReader();
            fileReader.readAsDataURL(event.target.files[0]);
            fileReader.onload = (event) => {
                this.product_attr.image.push(event.target.result);
            }
        },
        selectedImageEdit(event) {
            var fileReader = new FileReader();
            fileReader.readAsDataURL(event.target.files[0]);
            fileReader.onload = (event) => {
                this.attr.image.push(event.target.result);
            }
        },

        createProductAttribute() {
            console.log(this.product_attr)
            axios.post('admin/productAttributes', this.product_attr)
                .then(response => {
                    if(response.data.fail) {
                        toastr.warning(response.data.fail);
                        this.product_attr = {
                                color_id: '',
                                size_id: '',
                                quantity: '',
                                image: [],
                            };
                    } else {
                          this.product_attrs.unshift(response.data.lastest);
                            this.product_attr = {
                                color_id: '',
                                size_id: '',
                                quantity: '',
                                image: [],
                            };
                            toastr.success('Sucsessfully');
                            this.product_attr.product_id = window.id;
                            if (this.errors) {
                                this.errors = []
                            }
                    }
                  
                })
                .catch(error => {
                    if (error.response.status == 422) {
                        this.errors = error.response.data.errors;
                    }
                })
        },

        getAllProductAttributes(product_attr) {
            axios.get('admin/productAttributes/'+product_attr.product_id, product_attr.product_id)
                .then(response => {
                    this.product_attrs = response.data.all;
                })
                .catch(error => {
                    console.log(error);
                })
        },

        getColor_images(product_attr){
            this.product_attr.product_name = product_attr.product_name;
            this.product_attr.color_name = product_attr.color_name;
            this.product_attr.size_name = product_attr.size_name;
            this.product_attr.quantity = product_attr.quantity;
            this.product_attr.original_price = product_attr.original_price;
            this.fillProductAttr.color_id = product_attr.color_id;

            $("#view-item").modal('show');

            axios.get('admin/productAttributes/'+this.product_attr.product_id+'/'+this.fillProductAttr.color_id)
            .then(response => {
                this.color_images = response.data.color_images;
                this.product_attr.product_id = window.id;
            })
            .catch(error => {
                console.log(error);
            })
        },
        close(){
            $(".modal").modal('hide');
        },
        edit_product(product_attr){
            this.edit_attr.id = product_attr.id;
            // this.edit_attr.color_id = product_attr.color_id;
            this.attr.color_id = product_attr.color_id;
            this.attr.color_name = product_attr.color_name;
            this.attr.size_id = product_attr.size_id;
            this.attr.quantity = product_attr.quantity;
            this.attr.product_attr_id = product_attr.id;
            axios.get('admin/productAttributes/'+product_attr.product_id+'/'+product_attr.color_id)
            .then(response => {
                this.color_images = response.data.color_images;
                this.product_attr.product_id = window.id;
            })
            .catch(error => {
                console.log(error);
            })
            $("#edit-item").modal('show');

        },
        update_product(edit_attr,NewValue){
            this.edit_attr.product_id = window.id;
            axios.put('admin/productAttributes/'+ edit_attr.id,NewValue)
                .then(response => {
                    $(".modal").modal('hide');
                    this.getAllProductAttributes(edit_attr);
                    toastr.success('the product is updated successfully');

                })
                .catch(error => {
                    console.log(error);
            })
        },
        delete_product(product_attr) {
            axios.post('admin/productAttributes/'+product_attr.id+'/'+product_attr.color_id)
            .then(response => {
                let index = this.product_attrs.indexOf(product_attr);
                    this.product_attrs.splice(index, 1);
                    toastr.success('the product is deleted successfully!');
            })
            .catch(error => {
                console.log(error);
            })
        }

    }
}
</script>
