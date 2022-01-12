<template>
    <div class="registration-container">
    <div class="mt-20 mb-20" v-if="message != null">
        <div style="width: 100%; display:block;" class="msg_success">
            {{message}}
        </div>
    </div>
    <div class="item-container update-form">

        <div class="form-class">
            <div class="form1" >
                <div class="item-type mt-20">

                    <span>REGISTRATION FORM</span>
                    

                </div>
                <div class="item-content">
                    <input type="text" name="" class="form-control" v-model="formData.name" placeholder="Enter Your Name">
                        <p style="color:red" v-if="errors.name">{{errors.name[0]}}</p>
                    <input type="email" name="email" class="form-control" v-model="formData.email" placeholder="Email Address">
                        <p style="color:red" v-if="errors.email">{{errors.email[0]}}</p>
                    <input type="password" name="password" class="form-control" v-model="formData.password" placeholder="Password">
                        <p style="color:red" v-if="errors.password">{{errors.password[0]}}</p>
                    <input type="password" name="password" class="form-control" v-model="formData.password_confirmation" placeholder="Confirm Password">

                        <p style="color:red" v-if="errors.password_confirmation">{{errors.password_confirmation[0]}}</p>
                </div>
            </div>

            <div class="item-select">

                
                <button class="register_btn" @click.prevent="handleLogin()">REGISTER</button>
                <div>Back to <router-link to="/" class="green">Home</router-link></div>
            </div>
            
        </div>

    </div>

    </div>
</template>

<script>
export default {

    data() {
        return {
            formData: {
                email: '',
                password: '',
                name: '',
                password_confirmation: ''
            },
            errors: [],
            message: null
        }
    },
    methods: {
        handleLogin() {
                // send axios request to the login route
                axios.get('/sanctum/csrf-cookie').then(response => {
                    
                    axios.post('/api/register', this.formData)
                    .then(() => {
                    this.message = "Registration Successfull!";

                    }).catch(error=> {
                        this.errors = error.response.data.errors;
                    });



                });
            
         }
    }
}
</script>