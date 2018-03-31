<template>
<div class="col-md-9">
    <div>
        <div class="row" id="productMain">
            <div class="col-sm-6" v-if="productDiscounts.discount_percent">
                <div id="mainImage">
                    <img :src="image + productDiscounts.image_path " alt="" class="img-responsive">
                </div>
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
            </div>
            <div class="col-sm-6" v-else>
                <div id="mainImage">
                    <img :src="image + productDiscounts.image_path " alt="" class="img-responsive">
                </div>
            </div>
            <div class="col-sm-6">
                <div class="box" v-if="productDiscounts.discount_percent">
                    <h1 class="text-center">{{productDiscounts.product_name}}</h1>
                    <div style="text-align: center">
                        <button class="btn_color_img" 
                        v-for="attr in productAttributes" 
                        :style="{ background: attr.color_name, width:obj.width, height:obj.height}"
                        @click="getColorId(attr)"></button>
                    </div>
                    </p>
                    <p class="price">
                        <del>${{productDiscounts.original_price}}</del> 
                        ${{productDiscounts.original_price - 
                        (productDiscounts.original_price*productDiscounts.discount_percent)/100 }}
                    </p>
                    <p class="text-center buttons">
                        <a href="basket.html" class="btn btn-primary"><
                            i class="fa fa-shopping-cart"></i> Add to cart
                        </a> 
                        <a href="basket.html" class="btn btn-default"><i class="fa fa-heart"></i> Add to wishlist</a>
                    </p>
                </div>
                <div class="box" v-else>
                    <h1 class="text-center">{{productDiscounts.product_name}}</h1>
                    <div style="text-align: center">
                        <button class="btn_color_img" 
                        v-for="attr in productAttributes" 
                        :style="{ background: attr.color_name, width:obj.width, height:obj.height}"
                        @click="getColorId(attr)"></button>
                    </div>
                    </p>
                    <p class="price">
                        ${{productDiscounts.original_price}}
                    </p>
                    <p class="text-center buttons">
                        <a href="basket.html" class="btn btn-primary"><i class="fa fa-shopping-cart"></i> Add to cart</a> 
                        <a href="basket.html" class="btn btn-default"><i class="fa fa-heart"></i> Add to wishlist</a>
                    </p>
                </div>
                <div class="row" id="thumbs">
                    <div class="col-xs-4" v-for="images in productImages">
                        <a :href="image + images.image_path" class="thumb">
                        <img :src="image + images.image_path" alt="" class="img-responsive">
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="box" id="details">
            <p>
            <h4>Product details</h4>
            <p>{{ productDiscounts.description }}</p>
            <h4>Material & care</h4>
            <ul>
                <li>Polyester</li>
                <li>Machine wash</li>
            </ul>
            <h4>Size & Fit</h4>
            <ul>
                <li>Regular fit</li>
                <li>The model (height 5'8" and chest 33") is wearing a size S</li>
            </ul>
            <blockquote>
                <p>
                    <em>Define style this season with Armani's new range of trendy tops, 
                crafted with intricate details. 
                Create a chic statement look by teaming this lace number with skinny jeans and pumps.
                    </em>
                </p>
            </blockquote>
            <hr>
            <div class="social">
                <h4>Show it to your friends</h4>
                <p>
                    <a href="#" class="external facebook" data-animate-hover="pulse"><i class="fa fa-facebook"></i></a>
                    <a href="#" class="external gplus" data-animate-hover="pulse"><i class="fa fa-google-plus"></i></a>
                    <a href="#" class="external twitter" data-animate-hover="pulse"><i class="fa fa-twitter"></i></a>
                    <a href="#" class="email" data-animate-hover="pulse"><i class="fa fa-envelope"></i></a>
                </p>
            </div>
        </div>
    </div>
    <div class="row same-height-row">
        <div class="col-md-3 col-sm-6">
            <div class="box same-height">
                <h3>You may also like these products</h3>
            </div>
        </div>
        <div class="col-md-3 col-sm-6" v-for="relatedProduct in relatedProducts">
            <div class="product same-height" v-if="!relatedProduct.discount_percent">
                <div class="flip-container">
                    <div class="flipper">
                        <div class="front">
                            <a :href="route + relatedProduct.id">
                            <img :src="image + relatedProduct.image_path" alt="" class="img-responsive">
                            </a>
                        </div>
                        <div class="back">
                            <a :href="route + relatedProduct.id">
                            <img :src="image + relatedProduct.image_path" alt="" class="img-responsive">
                            </a>
                        </div>
                    </div>
                </div>
                <a :href="route + relatedProduct.id" class="invisible">
                <img :src="image + relatedProduct.image_path" alt="" class="img-responsive">
                </a>
                <div class="text">
                    <h3>{{relatedProduct.product_name}}</h3>
                    <p class="price">${{relatedProduct.original_price}}</p>
                </div>
            </div>
            <!-- /.product -->
            <div class="product same-height" v-else>
                <div class="flip-container">
                    <div class="flipper">
                        <div class="front">
                            <a :href="route + relatedProduct.id">
                            <img :src="image + relatedProduct.image_path" alt="" class="img-responsive">
                            </a>
                        </div>
                        <div class="back">
                            <a :href="route + relatedProduct.id">
                            <img :src="image + relatedProduct.image_path" alt="" class="img-responsive">
                            </a>
                        </div>
                    </div>
                </div>
                <a :href="route + relatedProduct.id" class="invisible">
                <img :src="image + relatedProduct.image_path" alt="" class="img-responsive">
                </a>
                <div class="text">
                    <h3>{{relatedProduct.product_name}}</h3>
                    <p class="price">
                        <del>${{relatedProduct.original_price}}</del> 
                        ${{relatedProduct.original_price - 
                        (relatedProduct.original_price*relatedProduct.discount_percent)/100 }}
                    </p>
                </div>
                <div class="ribbon sale">
                    <div class="theribbon">SALE</div>
                    <div class="ribbon-background"></div>
                </div>
                <!-- /.ribbon -->
                <div class="ribbon new">
                    <div class="theribbon">NEW</div>
                    <div class="ribbon-background"></div>
                </div>
            </div>
        </div>
    </div>
</div>
</template>

<script>
    export default{
        data(){
            return {
                productDiscounts: {},
                productAttributes : [],
                productImages : [],
                relatedProducts : [],
                productId : '',
                productColorId : '',
                obj: {
                    width: '80px',
                    height: '40px',
                },
                image : 'images/',
                route: 'http://localhost:8000/customer/products/',
            }
        },
        created(){
            this.productId = window.id;
            this.getDiscount();
            this.getAttribute();
            this.getRelatedProduct();
        },
        methods: {
            getDiscount(){
                axios.get('/customer/getDiscount/' + this.productId)
                .then(response => {
                    this.productDiscounts = response.data.productDiscount;
                })
                .catch(error=>{
                    console.log(error);
                })
            },

            getAttribute(){
                axios.get('/customer/getAttribute/' + this.productId)
                .then(response=>{
                    this.productAttributes = response.data.productAttribute;
                })
                .catch(error=>{
                    console.log(error);
                })
            },

            getColorId(attr){
                axios.get('/customer/getColor/'+this.productId+'/'+attr.color_id)
                .then(response=>{
                    this.productImages = response.data;
                })
                .catch(error=>{
                    console.log(error);
                })
            },

            getRelatedProduct(){
                axios.get('/customer/getRelatedProduct/'+this.productId)
                .then(response => {
                    this.relatedProducts = response.data.relatedProduct;
                    console.log(this.relatedProducts);
                })
                .catch(error=>{
                    console.log(error);
                })
            }
        }
    }
</script>