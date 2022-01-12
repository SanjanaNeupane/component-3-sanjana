<template>
        <header class="header">
        <div class="header__search">

            </div>
            <div class="profile_container" onclick="subnavtoggle(this)">

                    <div class="header__avatar"><img :src="user.img" alt=""><span>&#x25BC;</span></div>

            </div>
            <div class="header__dropdown">
                    <ul class="user__option">
                        <li><router-link to="/profile">Profile</router-link></li>
                        <li><a href="#" @click.prevent="logout">Logout</a></li>
                    </ul>
            </div>

        </header>
</template>

<script>
export default {

        data(){
            return{
                user: {
                    img:''
                }

            }
        },
        methods:{
            logout(){
                axios.post('/api/logout').then(()=>{
                    this.$router.push({ name: "Index"})
                })
            }

        },
        mounted(){

                axios.get('/api/user')
                .then((response) => {
                    this.user = response.data;
                    console.log("msg from header-comp " + this.user.img);
                });

        }
}
</script>