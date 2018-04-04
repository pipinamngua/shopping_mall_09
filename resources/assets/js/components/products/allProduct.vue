<template>
<div id="hot">
    <div class="box">
        <div class="container">
            <div class="col-md-12">
                <h2>All Products</h2>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="product-slider owl-carousel owl-theme" style="display: block;">
            <div class="item" v-for="product in products">
                <div class="product" v-if="!product.discount_percent">
                    <div class="flip-container">
                        <div class="flipper">
                            <div class="front">
                                <a :href="route+product.id">
                                <img :src="image + product.image_path" alt="" class="img-responsive">
                                </a>
                            </div>
                            <div class="back">
                                <a :href="route+product.id">
                                <img :src="image + product.image_path" alt="" class="img-responsive">
                                </a>
                            </div>
                        </div>
                    </div>
                    <a :href="route+product.id" class="invisible">
                    <img :src="image + product.image_path" alt="" class="img-responsive">
                    </a>
                    <div class="text">
                        <h3><a :href="route+product.id">{{product.product_name}}</a></h3>
                        <p class="price">${{product.original_price}}</p>
                    </div>
                    <!-- /.text -->
                </div>
                <!-- /.product -->
                <div class="product" v-else>
                    <div class="flip-container">
                        <div class="flipper">
                            <div class="front">
                                <a :href="route+product.id">
                                <img :src="image + product.image_path" alt="" class="img-responsive">
                                </a>
                            </div>
                            <div class="back">
                                <a :href="route+product.id">
                                <img :src="image + product.image_path" alt="" class="img-responsive">
                                </a>
                            </div>
                        </div>
                    </div>
                    <a :href="route+product.id" class="invisible">
                    <img :src="image + product.image_path" alt="" class="img-responsive">
                    </a>
                    <div class="text">
                        <h3><a :href="route+product.id">{{product.product_name}}</a></h3>
                        <p class="price">
                        <del>${{product.original_price}}</del> 
                        ${{product.original_price - (product.original_price*product.discount_percent)/100 }}
                        </p>
                    </div>
                    <!-- text -->
                    <div class="ribbon sale">
                        <div class="theribbon">SALE</div>
                        <div class="ribbon-background"></div>
                    </div>
                    <!-- /.ribbon -->
                    <div class="ribbon new">
                        <div class="theribbon">NEW</div>
                        <div class="ribbon-background"></div>
                    </div>
                    <!-- /.ribbon -->
                    <div class="ribbon gift">
                        <div class="theribbon">GIFT</div>
                        <div class="ribbon-background"></div>
                    </div>
                    <!-- /.ribbon -->
                </div>
            </div>
        </div>
        <!-- /.product-slider -->
    </div>
    <!-- /.container -->
</div>
</template>

<script>
    export default {
        data(){
            return {
                products : [],
                product: {
                    productName : '',
                    productOriginalPrice : '',
                    productFinalPrice : '',
                    productDiscount : '',
                    ProductImage : '',
                },
                image : 'images/',
                route: 'http://localhost:8000/customer/products/',
            }
        },
        created(){
            this.getAllProduct();
        },
        methods : {
            getAllProduct(){
                axios.get('customer/All')
                .then(response => {
                    this.products= response.data.allProducts;
                })
                .catch(error => {
                    console.log(error);
                })
            }
        }
    }
</script>