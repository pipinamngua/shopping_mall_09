<template>
<div>
    <form v-on:submit.prevent="createDiscountProduct" action="">
        <div v-bind:class="{ 'form-group': true, 'has-error' : errors.productName }">
            <label for="">Product Name</label>
            <select  multiple v-model="discountProduct.productName" class="form-control">
                <option 
                    v-for="product in products" 
                    :value="product.id" 
                    v-text="product.product_name"></option>
            </select>
            <span v-if="errors.productName" class="error">{{ errors.productName[0] }}</span>
        </div>
        <div v-bind:class="{ 'form-group': true, 'has-error' : errors.discountProgram }">
            <label for="">Discount Program</label>
            <select name="" id="" v-model="discountProduct.discountProgram" class="form-control">
                <option value="">---choose event---</option>
                <option v-for="discountProgram in discountPrograms" :value="discountProgram.id" v-text="discountProgram.discount_content"></option>
            </select>
            <span v-if="errors.discountProgram" class="error">{{ errors.discountProgram[0] }}</span>
        </div>
        <div v-bind:class="{ 'form-group': true, 'has-error' : errors.discountPercent }">
            <label for="">Discount Percent</label>
            <input type="number" v-model="discountProduct.discountPercent" class="form-control">
            <span v-if="errors.discountPercent" class="error">{{ errors.discountPercent[0] }}</span>
        </div>
        <div class="form-group">
            <button class="btn btn-primary">Create Discount</button>
        </div>
    </form>
    <table id="myTable" class=" table table-striped table-bordered table-condensed">
        <thead>
            <tr>
                <th>ID</th>
                <th>Program Name</th>
                <th>Discount Program</th>
                <th>Percentage</th>
                <th>Started_at</th>
                <th>Ended_at</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="detailDiscount in discountProducts">
                <div class="modal fade" id="edit-item" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                <h4 class="modal-title">Edit discount</h4>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <strong>Program Name : </strong>
                                            <select  v-model="editDiscountProduct.productName">
                                                <option 
                                                    v-for="product in products" 
                                                    :value="product.id" 
                                                    v-text="product.product_name"></option>
                                            </select>
                                            <span>{{  }}</span>
                                        </div>
                                        <br>
                                        <br>
                                        <div class="form-group">
                                            <label for="">Discount Program</label>
                                            <select v-model="editDiscountProduct.discountProgram">
                                                <option 
                                                    v-for="discountProgram in discountPrograms" 
                                                    :value="discountProgram.id" 
                                                    v-text="discountProgram.discount_content"></option>
                                            </select>
                                            <span class="error text-danger"></span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Percentage</label>
                                            <input 
                                                type="number" 
                                                v-model="editDiscountProduct.discountPercent" 
                                                class="form-control" >
                                            <span class="error text-danger"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <div class="form-group">
                                    <button  class="btn btn-success" @click.prevent="updateDiscount(detailDiscount,editDiscountProduct)">Update</button>
                                </div>
                                <div class="form-group">
                                    <button class="btn btn-default" @click.prevent="close">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <td>{{detailDiscount.id}}</td>
                <td>{{detailDiscount.product_name}}</td>
                <td>{{detailDiscount.discount_content}}</td>
                <td>{{detailDiscount.discount_percent}}</td>
                <td>{{detailDiscount.started_at}}</td>
                <td>{{detailDiscount.ended_at}}</td>
                <td>
                    <a href="#" @click.prevent="editDiscount(detailDiscount)" >
                    <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                    </a>
                    <a href="#">
                    <i class="fa fa-trash" @click.prevent="deleteDiscount(detailDiscount)" aria-hidden="true"></i>
                    </a>        
                </td>
            </tr>
        </tbody>
    </table>
</div>
</template>

<script>
    export default {
        data(){
            return {
                discountProducts: [],
                discountProduct : {
                    productName : [],
                    discountProgram : '',
                    discountPercent : '',
                },
                editDiscountProduct : {
                    productName : '',
                    discountProgram : '',
                    discountPercent : '',
                },
                products : [],
                discountPrograms : [],
                errors : []
            }
            
        },
        created(){
            this.getAllProduct();
            this.getAllDiscountProgram();
            this.getAlldiscountProduct();
        },
        methods : {

            getAlldiscountProduct() {
                axios.get('admin/discountProduct')
                .then(response =>{
                    this.discountProducts = response.data;
                })
                .catch(error=>{
                    console.log(error);
                })
            },
            createDiscountProduct(){
                axios.post('admin/discountProduct', this.discountProduct)
                .then(response=>{
                    if (response.data.fail) {
                        toastr.warning(response.data.fail);
                        this.discountProduct = {
                        productName: '',
                        discountProgram: '',
                        discountPercent: ''
                        }
                    } else {
                        this.getAlldiscountProduct();
                        toastr.success('successfully');
                        this.discountProduct = {
                        productName: '',
                        discountProgram: '',
                        discountPercent: ''
                        }
                    }
                    

                })
                .catch(error=>{
                    if (error.response.status == 422) {
                        this.errors = error.response.data.errors;
                    }
                })
            },

            getAllProduct(){
                axios.get('admin/getAllProduct')
                .then(response => {
                    this.products = response.data;
                })
                .catch(error=> {
                    console.log(error);
                })
            },

            getAllDiscountProgram(){
                axios.get('admin/getAllDiscountProgram')
                .then(response=>{
                    this.discountPrograms = response.data;
                })
                .catch(error => {
                    console.log(error);
                })
            },

            close(){
                $('#edit-item').modal('hide');
            },

            editDiscount(detailDiscount) {
                $('#edit-item').modal('show');
                this.editDiscountProduct.productName = detailDiscount.product_id;
                this.editDiscountProduct.discountProgram = detailDiscount.discount_program_id;
                this.editDiscountProduct.discountPercent = detailDiscount.discount_percent;
            },
            updateDiscount(oldValue, newValue) {
                axios.put('admin/discountProduct/'+oldValue.id, newValue)
                .then(response=>{
                    if (response.data.fail) {
                        $('#edit-item').modal('hide');
                        toastr.warning(response.data.fail);
                    } else {
                        $('#edit-item').modal('hide');
                        this.getAlldiscountProduct();
                    }
                })
                .catch(error => {
                    console.log(error);
                })
            },
            deleteDiscount(detailDiscount) {
                axios.delete('admin/discountProduct/'+detailDiscount.id)
                .then(response => {
                    let index = this.discountProducts.indexOf(detailDiscount);
                    this.discountProducts.splice(index, 1);
                    toastr.success('the discount is deleted successfully!');
                })
            }
        }
    }
</script>