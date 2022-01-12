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
            <section class="container  mt-20 mb-20 bg pd-content">
                <div class="title-box mb-20"><span class="title-text">USER STATS</span></div>
                <div class="stats-container bg pd-content">

                        <div class="stats-box">
                        <div>
                            <h3 class="price" v-if="user.role == 1">Products Created:</h3>
                            <h3 class="price" v-if="user.role == 2">Total Products:</h3>

                        </div>
                        <div class="stat-data mt-20">
                            <span class="price">{{products.length}}</span>
                        </div> 
            
                        </div>
            
                        <div class="stats-box">
                        <div>
            
                            <h3>User Role:</h3>
                        </div>
                        <div class="stat-data mt-20">
                            <span class="price" v-if="user.role == 1">Editor</span>
                            <span class="price" v-if="user.role == 2">Admin</span>
                        </div> 
            
                        </div>
            
                        <div class="stats-box">
                        <div>
                            <h3>Status:</h3>
                        </div>
                        <div class="stat-data mt-20">
                            <span class="green" v-if="user.role != 0">Active</span>
                            <span class="red" v-if="user.role == 0">Deactive</span>
                        </div> 
            
                        </div>
                </div>
            
            
                </section>
            
                <section class="container mt-20 mb-20 bg pd-content">
                <div class="title-box mb-20">
                    <span class="title-text" v-if="user.role == 1">USER PRODUCTS</span>
                    <span class="title-text" v-if="user.role == 2">ALL PRODUCTS</span>

                </div>
                <table class="product-table" cellspacing="0">
                <thead>
                <tr class="w3-light-grey">
                    <th>Title</th>
                    <th>First Name</th>
                    <th >Main Name</th>
                    <th>Type</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="(product,index) in products" :key="index">
                    <td>{{product.title}}</td>
                    <td>{{product.firstName}}</td>
                    <td>{{product.mainName}}</td>
                    <td>{{product.type}}</td>
                    <td>
                        <router-link class="btn-edit" :to="{name: 'Edit', params: { id: product.id}}"><i class="fas fa-pencil-alt"></i></router-link>
                        <button class="btn-delete" @click.prevent="deleteProduct(product.id)"><i class="fas fa-trash-alt"></i></button>
                    </td>
                </tr>
                </tbody>
            </table>
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
                products: [],
                user: {
                    id: '',
                    firstName: '',
                    mainName: '',
                    role: ''
                },
                isActive: false,

            }
        },
        methods:{

            getProductsUser() {
                axios.get('/api/products').then(response => {
                    console.log(response.data);
                    this.products = response.data;

                });
            },
            getProductsAll() {
                axios.get('/api/products_all').then(response => {
                    console.log(response.data);
                    this.products = response.data;

                });
            },
            deleteProduct(id) {
                axios.get('/sanctum/csrf-cookie').then(response => {
                    // axios.post('/login', this.formData).then(response => {
                    //     this.getSecrets();
                    // });
                    
                    axios.delete(`/api/delete_product/${id}`)
                    .then((res) => {

                    this.products = res.data;

                    });


                });
            }

        },
        mounted(){

                axios.get('/api/user')
                .then((res)=>{

                    this.user = res.data //sets the user details
                    if(this.user.role == 2) this.getProductsAll(); //fetch products associated with the user.
                    else if(this.user.role == 1) this.getProductsUser();

                })
                .catch(error => console.log('Error: ', error));





            // axios.get('/sanctum/csrf-cookie').then(response => {
            //     // axios.post('/login', this.formData).then(response => {
            //     //     this.getSecrets();
            //     // });
                
            //     axios.post('api/login', this.formData)
            //     .then(() => {
            //         //login route checks for user and returns user if found

            //     //returned user is send to getProducts where products specific to the user is fetched.
            //     // this.getProducts();
            //     //redirect to editor and if admin is true redirect to admin
            //     this.$router.push({name: "Editor"})
            //     });


            // });
        }
    }
</script>