<template>
    <div class="page">
        <aside>
            <div class="aside-content">
                <div class="round" style="background-image: url('/images/avatar.jpg'); background-size: cover"></div>   
                
                <h3>Alecca</h3>
                <b>Health</b>
                <ul>
                    <li><router-link to="/dashboard/stats/cravings">Cravings</router-link></li>
                </ul>
                <b>Books</b>
                <ul>
                    <li><router-link to="/dashboard/sales/books">Sales</router-link></li>
               </ul>
               <b>Music</b>
               <ul>
                    <li><router-link to="/dashboard/music/streams">Streams</router-link></li>
               </ul>
            </div>
        </aside>
    
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
