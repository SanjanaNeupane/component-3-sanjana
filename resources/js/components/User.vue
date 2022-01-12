<template>

    <div class="grid-container">
        <HeaderComponent />
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
            
                <section class="container mt-20 mb-20 bg pd-content">
                <div class="title-box mb-20"><span class="title-text">USER LISTING</span></div>
                <table class="product-table" cellspacing="0">
                <thead>
                <tr class="w3-light-grey">
                    <th class="img-column">Image</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th >Role</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="(user,index) in users" :key="index">
                    <td><img class="product-img" v-bind:src="user.img" alt="product image"></td>
                    <td>{{user.name}}</td>
                    <td>{{user.email}}</td>
                    <td v-if="user.role == 0">User</td>
                    <td v-if="user.role == 1">Editor</td>
                    <td>
                        <span  v-if="user.role == 1" >Active</span>
                        <span  v-if="user.role == 0" >Deactive</span>
                    </td>
                    <td>
                        <button class="btn-edit" v-if="user.role == 1" @click="Deactivate(user.id)"><i class="fas fa-trash-alt"></i></button>
                        <button class="btn-delete" v-if="user.role == 0" @click="Deactivate(user.id)"><i class="fas fa-trash-alt"></i></button>
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
                users: []

            }
        },
        methods: {
            Deactivate($id) {
                axios.get('/sanctum/csrf-cookie').then(response => {
                console.log($id);
                axios.put(`/api/user/deactive/${$id}`).then((response) => {
                    console.log(response.data);
                    this.users = response.data;
                });
                });

                     
            }  
        }
        ,
        mounted(){

                axios.get('/api/users_all')
                .then((response) => {
                    this.users = response.data;
                    console.log(response.data);
                });

        }
    }
</script>