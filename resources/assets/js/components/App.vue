<template>
    <div class="page">
        <aside>
            <div class="aside-content">
                <h3>Start</h3>
                <ul>
                 <li><router-link to="/dashboard/stats/cravings">Cravings</router-link></li>
                <li><router-link to="/dashboard/sales/books">Book sales</router-link></li>
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
