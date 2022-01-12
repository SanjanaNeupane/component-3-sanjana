<template>

        <aside class="sidenav" id="side-nav" v-on:click="isActive=!isActive" v-bind:class="{active: isActive}">
                <div class="logo"><a href="#"><img class="ignite-logo" :src="user.img"></a></div>
                <div class="sidenav__close-icon" v-on:click="isActive = !isActive">
                    <i class="fas fa-times"></i>
                </div>

                
                <ul class="sidenav__list">
                    <li class="sidenav__list-item">
                        <router-link to="/">Home</router-link>
                    </li>
                    <li class="sidenav__list-item">
                        <router-link to="/editor">Dashboard</router-link>
                    </li>


                    <!-- <li class="sidenav__list-item" onclick="subnavtoggle(this)">
                        <a href="#">My Shops</a> <span>&#x25BC;</span>
                    </li>-->
                        <!--sub nav-->
                        <!--<ul class="sub-nav " >

                            <li class="sub-nav-item" onclick="subnavtoggle(this)"><a>Shop Name here<span>&#x25BC;</span></a></li>
                            <ul class="sub-nav">
                                <li class="sub-nav-item"><a href="">Product Listing</a></li>
                                <li class="sub-nav-item"><a href="">Edit Shop</a></li>
                                <li class="sub-nav-item"><a href="">Discount product</a></li>
                            </ul>

                            <li class="sub-nav-item " ><a>NO SHOPS!</a></li>

                        </ul> -->




                    
                    <li class="sidenav__list-item" v-if="user.role != 0"><router-link to="/create">Create Product</router-link></li>
                    <li class="sidenav__list-item" v-if="user.role == 2"><router-link to="/user">Manage Users</router-link></li>
                   
                </ul>
                    
        </aside>

    <!--THIS IS NAV FOR REGISTERED USERES-->
</template>

<script>
export default {
    data() {
        return {
            isLoggedIn: false, //keep this true for now
            isActive: false,
            user: {
              firstName: '',
              role: '',
              id: '',
              mainName: '',
              img: ''
            }
        }
    },
    mounted(){
        axios.get('/api/user')
        .then((res)=>{
            console.log("msg from nav-comp");
            this.user = res.data //sets the user details
            this.isLoggedIn = true;

        })
        .catch(error => console.log('Error: ', error));
    }    
}
</script>