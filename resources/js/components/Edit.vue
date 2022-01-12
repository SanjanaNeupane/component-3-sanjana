<template>

    <div class="grid-container">
        <HeaderComponent/>
        <div class="menu-icon active" id="menu-icon" >
            <i class="fas fa-bars"></i>
        </div>

        <!--
            Side menu content starts
        -->
        <Nav/>
        <!--
            Side menu content ends
        -->
         <!--MAIN CONTENTS THE CONTENTS-->
        <main class="main">
            <section class="container mt-20">
                <div class="mt-20 mb-20" v-if="message != null">
                    <div style="width: 100%; display:block;" class="msg_success">
                        {{message}}
                    </div>
                </div>
                <div class="item-container update-form">
                <div class="form-class">
                    <form id="form1" class="form1" action="" @submit.prevent="updateProduct">
                        <div class="item-type">

                            <span>UPDATE &nbsp; {{product.type.toUpperCase()}}</span>

                        </div>
                        <div class="item-content">
                            <input class="item-title" type="text" id="title" placeholder="title" name="title"  v-model="product.title">

                                <p style="color:red;margin-bottom:10px" v-if="errors.title">{{errors.title[0]}}</p>

                            <input class="item-title" type="text"  id="FirstName" placeholder="FirstName" name="FirstName" v-model="product.firstName">

                                <p style="color:red;margin-bottom:10px" v-if="errors.firstName">{{errors.firstName[0]}}</p>

                            <input class="item-title" type="text" id="MainName" placeholder="MainName" name="MainName" v-model="product.mainName">

                                <p style="color:red;margin-bottom:10px" v-if="errors.mainName">{{errors.mainName[0]}}</p>

                            <input class="item-title" type="number"  id="Price" placeholder="Price" name="Price" v-model="product.price">

                                <p style="color:red;margin-bottom:10px" v-if="errors.price">{{errors.price[0]}}</p>

                            <input class="item-title" type="number"  id="Length" placeholder="Length" name="Length" v-model="product.length">

                                <p style="color:red;margin-bottom:10px" v-if="errors.length">{{errors.length[0]}}</p>
                        </div>
                    </form>

                    <div class="item-select">
        
                        
                        <button form="form1" class="register_btn">UPDATE</button>
                    </div>
                    
                </div>

            </div>
            </section>
            </main>
        </div>

</template>

<script>

import Nav from './Nav';
import HeaderComponent from './Header-component.vue';

    export default {
        components: {
            Nav,
            HeaderComponent
        },
        data(){
            return{
                product: {},
                isActive: false,
                message: null,
                errors: []
            }
        },
        created() {
            console.log(`api/product/${this.$route.params.id}`);
                    let id = this.$route.params.id; 
                    axios.get(`/api/product/edit/${id}`).then((response) => {
                        this.product = response.data;
                    });

        },
        methods:{
            updateProduct() {
                axios.get('/sanctum/csrf-cookie').then(response => {
                    axios
                    .put(`/api/product/update/${this.$route.params.id}`, this.product)
                    .then((response) => {
                        this.message = "Product updated successfully!"
                        this.errors = [];
                    }).catch(error => this.errors = error.response.data.errors);
                });
            }

        }
    }
</script>