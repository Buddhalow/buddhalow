<template>
    <div>
        <nav class="navbar navbar-inverse navbar-static-top">
            <div class="container">
                <div class="navbar-header">
    
                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse" aria-expanded="false">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
    
                    <!-- Branding Image -->
                    <router-link class="navbar-brand" to="/">
                       <a>Buddhalow</a>
                    </router-link>
                </div>
    
                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                        &nbsp;
                    </ul>
    
                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right" v-if="!user.authenticated">
                        <!-- Authentication Links -->
                        <router-link tag="li" to="/login">Login</a></router-link>
                        <router-link tag="li"to="/register"><a>Register</a></router-link>
                    </ul>
                    <ul class="nav navbar-nav navbar-right" v-if="user.authenticated">
                    
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true">
                                Account <span class="caret"></span>
                            </a>
    
                            <ul class="dropdown-menu">
                                <router-link tag="li" to="/cravings"></router-link>
                                <router-link tag="li" to="/login">
                                    <a>Logout</a>
                                </router-link>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    
        <main>
            <router-view
                class="view"
                keep-alive
                transition
                transition-mode="out-in">
            </router-view>
        </main>
    </div>
</template>

<script>
    export default {
        components: {},

        ready () {
        },
            
        data () {
            return {
              breadcrumbs: [],
              modalIsOpen: false,
              user: {}
            }
        },
            
        methods: {
            showModal () {
                  this.modalIsOpen = true;
            },
                
            logout () {
            }
        },
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
