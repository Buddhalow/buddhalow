<template>
    <div class="centeric">
        <div class="box">
            <div class="logo" style="text-align: center">
                <img src="/images/logo.svg" style="width: 128pt; height: 128pt">
                <h3>Buddhalow </h3>
                <p>Internal Services</p>
            </div>
            <form>
                <label>User name</label>
                <input class="form-control" type="text" name="username">
                <label>Password</label>
                <input class="form-control" type="password" name="password"><br>
                <button class="btn btn-primary">Log in</button>
                <br>
                <p>
                    <i class="fa fa-warning"></i> REMEMBER! Always make sure you are on https://app.buddhalow.com.</p>
                    
                </p>
                <p>This resource is only intended for employees of BUDDHALOW.</p>
            </form>
        </div>
    </div>
</template>
<script>
    export default {
        data() {
            return {
                loggedIn
            }
        }
    }
</script>