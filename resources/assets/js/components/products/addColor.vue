<template>
<div>
    <form action="">
        <div class="col-md-6">
            <div class="form-group">
                <label for="">Color</label>
                <select v-model="product_attr.color_id" name="" class="form-control" id="">
                    <option v-for="color in colors" 
                        v-bind:value="color.id" 
                        v-text="color.color_name">1</option>
                </select>
                <span></span>
            </div>
            <div class="form-group">
                <label for="">Sizes</label>
                <select v-model="product_attr.size_id" name="" class="form-control" id="">
                    <option v-for="size in sizes" 
                        v-bind:value="size.id" 
                        v-text="size.size_name">1</option>
                </select>
                <span></span>
            </div>
            <div class="form-group">
                <label for="">Quantity</label>
                <input type="number" class="form-control" v-model="product_attr.quantity">
                <span></span>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="">Image 1</label>
                <input type="file" multiple class="form-control" @change="selectedImage">
                <span></span>
            </div>
            <div class="form-group">
                <label for="">Image 2</label>
                <input type="file" class="form-control">
                <span></span>
            </div>
            <div class="form-group">
                <label for="">Image 3</label>
                <input type="file" class="form-control">
                <span></span>
            </div>
        </div>
    </form>
</div>
</template>

<script>
export default {
    data() {
        return {
            product_attrs: [],
            errors: [],
            product_attr: {
                product_id: '',
                color_id: '',
                size_id: '',
                quantity: '',
                image: ''
            },
            categories: [],
            sizes: [],
            colors: []
        }
    },
    created() {
        this.product_attr.product_id = window.id;
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
            console.log(event);
            var fileReader = new FileReader();
            fileReader.readAsDataURL(event.target.files[0]);
            fileReader.onload = (event) => {
                this.product_attr.image = event.target.result;
                // console.log(event);
            }
        },


    }
}
</script>
