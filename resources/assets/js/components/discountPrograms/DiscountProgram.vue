<template>
<div>
    <form v-on:submit.prevent="createDiscountProgram" method="post" action="">
        <div v-bind:class="{ 'form-group': true, 'has-error' : errors.content }">
            <label for="">Program Name</label>
            <input type="text" v-model="discountProgram.content" class="form-control">
            <span v-if="errors.content" class="error">{{ errors.content[0] }}</span>
        </div>
        <div v-bind:class="{ 'form-group': true, 'has-error' : errors.startedAt }">
            <label for="">Started At</label>
            <input type="date" v-model="discountProgram.startedAt" class="form-control">
            <span v-if="errors.startedAt" class="error">{{ errors.startedAt[0] }}</span>
        </div>
        <div v-bind:class="{ 'form-group': true, 'has-error' : errors.endedAt }">
            <label for="">Ended At</label>
            <input type="date" v-model="discountProgram.endedAt" class="form-control">
            <span v-if="errors.endedAt" class="error">{{ errors.endedAt[0] }}</span>
        </div>
        <div v-bind:class="{ 'form-group': true, 'has-error' : errors.status }">
            <label for="">Status</label>
            <select name="" id="" v-model="discountProgram.status" class="form-control">
                <option v-bind:value="1" v-text="1"></option>
                <option v-bind:value="0" v-text="0"></option>
            </select>
            <span v-if="errors.status" class="error">{{ errors.status[0] }}</span>
        </div>
        <div class="form-group">
            <input type="submit" value="Create Discount Program" class="btn btn-primary">
        </div>
    </form>
    <table id="myTable" class=" table table-striped table-bordered table-condensed">
        <thead>
            <tr>
                <th>ID</th>
                <th>Program Name</th>
                <th>Created_at</th>
                <th>Ended_at</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="detailDiscountProgram in discountPrograms">
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
                                            <span>{{ discountProgram.content }}</span>
                                        </div>
                                        <br>
                                        <br>
                                        <div class="form-group">
                                            <label for="">Started_at:</label>
                                            <input type="date" class="form-control" 
                                                v-model="discountProgram.startAt">
                                            <span class="error text-danger"></span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Ended_at:</label>
                                            <input type="date" class="form-control" 
                                                v-model="discountProgram.endedAt">
                                            <span class="error text-danger"></span>
                                        </div>
                                        <br>
                                        <br>
                                        <div class="form-group">
                                            <label for="">Status:</label>
                                            <select name="" id="" class="form-control" 
                                                v-model="discountProgram.status">
                                                <option :value="1" v-text="1"></option>
                                                <option :value="0" v-text=0></option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <div class="form-group">
                                    <button  class="btn btn-success" @click.prevent="updateDiscount(detailDiscountProgram,discountProgram)">Update</button>
                                </div>
                                <div class="form-group">
                                    <button class="btn btn-default" @click.prevent="close">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <td>{{ detailDiscountProgram.id }}</td>
                <td>{{ detailDiscountProgram.discount_content }}</td>
                <td>{{ detailDiscountProgram.started_at }}</td>
                <td>{{ detailDiscountProgram.ended_at }}</td>
                <td>{{ detailDiscountProgram.status }}</td>
                <td>
                    <a href="#" @click.prevent="editDiscount(detailDiscountProgram)">
                    <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                    </a>
                    <a href="#" @click.prevent="deleteDiscount(detailDiscountProgram)">
                    <i class="fa fa-trash" aria-hidden="true"></i>
                    </a>        
                </td>
            </tr>
        </tbody>
    </table>
</div>
</template>

<script type="text/javascript">

    export default {
        data() {
            return {
                discountPrograms : [],
                discountProgram : {
                    content : '',
                    startedAt : '',
                    endedAt: '',
                    status : 1
                },
                errors : [],
            }
        },
        created(){
            this.getAlldiscountProgram();
        },
        methods : {
            createDiscountProgram(){
                axios.post('admin/discountProgram', this.discountProgram)
                .then(response => {
                    // console.log(response);
                    this.discountPrograms.unshift(response.data);
                    this.discountProgram = {
                        content: '',
                        startedAt: '',
                        endedAt: ''
                    }
                if (this.errors) {
                    this.errors = [];
                }
                }, )
                .catch(error => {
                    if (error.response.status == 422) {
                        this.errors = error.response.data.errors;
                    }
                })
            },

            getAlldiscountProgram(){
                axios.get('admin/discountProgram')
                .then(response => {
                    this.discountPrograms = response.data;
                })
                .catch(error => {
                    console.log(error)
                })
            },

            editDiscount(detailDiscountProgram){
                $("#edit-item").modal('show');
                this.discountProgram.content = detailDiscountProgram.discount_content;
                this.discountProgram.startedAt = detailDiscountProgram.started_at;
                this.discountProgram.endedAt = detailDiscountProgram.ended_at;
                this.discountProgram.status = detailDiscountProgram.status;
            },
            updateDiscount(oldValue, newValue){
                // console.log(oldValue);
                axios.put('admin/discountProgram/' + oldValue.id, newValue)
                .then(response => {
                    $("#edit-item").modal('hide');
                    this.getAlldiscountProgram();
                    toastr.success('the discount is updated successfully');
                })
                .catch(error => {
                    console.log(error);
                })
            },

            close(){
                $("#edit-item").modal('hide');
            },
            deleteDiscount(detailDiscountProgram){
                axios.delete('admin/discountProgram/' + detailDiscountProgram.id )
                .then(response => {
                    let index = this.discountPrograms.indexOf(detailDiscountProgram);
                    this.discountPrograms.splice(index, 1);
                    toastr.success('the discount is deleted successfully!');
                })
            }


        }
    }
</script>