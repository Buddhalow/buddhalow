<template>
    <div class="centeric">
        <div class="box">
            
            <div class="logo" style="text-align: center">
                <img src="/images/logo.svg" style="width: 128pt; height: 128pt">
                <h3>Buddhalow </h3>
                <p>Internal Services</p>
            </div>
            <form v-if="!processing" v-on:submit.prevent="onSubmit">
                <div v-if="success" class="alert alert-success">Login succeeed!</div>
                <div v-if="error" class="alert alert-error">Invalid username or password</div>
                <label>User name</label>
                <input class="form-control" type="text" v-model="form.username">
                <label>Password</label>
                <input class="form-control" type="password" v-model="form.password"><br>
                <button class="btn btn-primary">Log in</button>
                <br>
                <p>
                    <i class="fa fa-warning"></i> REMEMBER! Always make sure you are on https://app.buddhalow.com.</p>
                    
                </p>
                <p>This resource is only intended for employees of BUDDHALOW.</p>
            </form>
            <div class="spinner" v-if="processing"></div>
        </div>
    </div>
</template>
<script>
    export default {
        data() {
            return {
                success: false,
                error: false,
                processing: false,
                loggedIn: false,
                form: {
                    username: '',
                    password: ''
                }
            }
        },
        methods: {
            onSubmit() {
                this.processing = true
                axios.post('/api/login', this.form).then(
                    (response) => {
                        this.loggedIn = true
                        this.processing = false
                        this.success = true
                        self.location = '/dashboard'
                    }    
                ).catch((error) => {
                    this.error = true
                })
            }  
        }
    }
</script>