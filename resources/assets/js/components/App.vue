<template>
    <div class="page">
        <aside v-bind:class="{'open': menu.open}">
            <div class="aside-content" style="width:100%;display: flex; flex-direction: row">
                <div style="width: 100%; text-align: center; position: relative">
                   <div class="round" style="display: inline-block; background-image: url('/images/avatar.jpg'); background-size: cover"></div>   
                
                    <h3>Alecca</h3>
                <a class="fa fa-window-close close-button" @click="closeMenu" style="right: 12pt; top: 12pt; position: absolute; font-size: 15pt"></a>
                </div>
            </div> 
           
            <div class="menu">
               <section>
                   <ul>
                    <li><router-link to="/dashboard">{{ 'Dashboard' | translate }}</router-link></li>
                </ul><br>
                <label>{{ 'Casting' | translate }}</label>
                <ul>
                    <li><router-link to="/dashboard/opportunities">{{ 'Opportunities' | translate }}</router-link></li>
                    <li><router-link to="/dashboard/threats">{{ 'Threats' | translate }}</router-link></li>
                </ul>
                </section>
               <section>
                <label>{{ 'Health' | translate }}</label>
                <ul>
                    <li><router-link to="/dashboard/stats/cravings">{{ 'Cravings' | translate }}</router-link></li>
                </ul>
                </section>
               <section>
                <label>Books</label>
                <ul>
                    <li><router-link to="/dashboard/sales/books">{{ 'Sales' | translate }}</router-link></li>
               </ul>
                </section>
               <section>
               <label>{{ 'Music' | translate }}</label>
               <ul>
                    <li><router-link to="/dashboard/music/streams">{{ 'Streams' | translate }}</router-link></li>
               </ul>
                </section>
            </div>
               <div class="buddhalow-section" style="">
                   <div class="aside-content" style="text-align: center">
                   <i style="font-size: 60pt" class="icon-buddhalow"></i><br>
                   Buddhalow
               </div>
           </div>
        </aside>
       
        <header>
            <button class="menu-toggler" @click="toggleMenu"><i class="fa fa-bars"></i></button>
        </header>
        <main>
             <div class="main" style="width: 100%">
               
                <router-view
                    class="view"
                    keep-alive
                    transition
                    transition-mode="out-in">
                </router-view>
            </div>
            
        </main>
        <tab-bar>
            <tabbar-item icon="home" :label="'Dashboard '| translate" to="/dashboard/start"></tabbar-item>
            <tabbar-item icon="star" :label="'Cravings' | translate" to="/dashboard/cravity"></tabbar-item>
            <tabbar-item icon="bars" :label="'Account' | translate" to="/dashboard/opportunities"></tabbar-item>
        </tab-bar>
    </div>
</template>

<script>
    export default {
        components: {},

        ready () {
        },
            
        data () {
            return {
                menu: {
                    open: false
                },
                breadcrumbs: [],
                modalIsOpen: false,
                user: {},
                loggedIn: false
            }
        },
        watch: {
            '$route'() {
                this.menu.open = false
            }
        },
        methods: {
            closeMenu() {
                this.menu.open = false
            },  
            toggleMenu() {
                this.menu.open = !this.menu.open
            },
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
