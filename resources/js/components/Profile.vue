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
        <main class="main" v-if="user != null && products != null">
            <section class="container">

                <div class="mt-20">
                    <div style="width: 90%; margin: auto;display:block;" class="msg_success" v-if="message != null">
                        {{message}}
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
                user: null,
                isActive: false,
                products: null,
                errors: [],
                message: null

            }
        },
        methods:{
            getProductsUser() {
                axios.get('/api/products').then(response => {
                    console.log(response.data);
                    this.products = response.data;

                });
            },
            updateUser() {
                axios.get('/sanctum/csrf-cookie').then(response => {
                    console.log(this.user);
                    axios.put(`/api/user/update/${this.user.id}`, this.user)
                    .then((response) => {
                        this.user = response.data;
                        this.message = "Profile edited successfully!"
                    })
                    .catch(error => this.errors = error.response.data.errors);
                });
            }

        },
        mounted(){

                axios.get('/api/user')
                .then((res)=>{
                    this.user = res.data //sets the user details
                    this.products = this.getProductsUser();
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

