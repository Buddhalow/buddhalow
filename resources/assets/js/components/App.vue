<template>
    <div class="page">
        <aside>
           <div class="aside-content" style="text-align: center">
               <div class="round" style="background-image: url('/images/avatar.jpg'); background-size: cover"></div>   
            
                <h3>Alecca</h3>
           </div>
            <div class="">
               <section>
                <label>Casting</label>
                <ul>
                    <li><router-link to="/dashboard/opportunities">Opportunities</router-link></li>
                    <li><router-link to="/dashboard/threats">Threats</router-link></li>
                </ul>
                </section>
               <section>
                <label>Health</label>
                <ul>
                    <li><router-link to="/dashboard/stats/cravings">Cravings</router-link></li>
                </ul>
                </section>
               <section>
                <label>Books</label>
                <ul>
                    <li><router-link to="/dashboard/sales/books">Sales</router-link></li>
               </ul>
                </section>
               <section>
               <label>Music</label>
               <ul>
                    <li><router-link to="/dashboard/music/streams">Streams</router-link></li>
               </ul>
                </section>
            </div>
           <div style="position: absolute; bottom: 3pt;">
               <div class="aside-content" style="text-align: center">
               <i style="font-size: 60pt" class="icon-buddhalow"></i><br>
               Buddhalow
               </div>
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
