<template>
    <div :class="$page.props.showingMobileMenu ? 'block' : 'hidden'" @click="$page.props.showingMobileMenu = false"
         class="fixed inset-0 z-20 bg-black opacity-50 transition-opacity lg:hidden"></div>

    <div :class="$page.props.showingMobileMenu ? 'translate-x-0 ease-out' : '-translate-x-full ease-in'"
         class="overflow-y-auto fixed inset-y-0 left-0 z-30 w-64 bg-green-900 transition duration-300 transform lg:translate-x-0 lg:static lg:inset-0">
        <div class="flex justify-center items-center mt-8">
            <div class="flex items-center">
               

                <span class="mx-2 text-2xl font-semibold text-white">Gestion de Recursos UTS</span>
            </div>
        </div>

        <nav class="mt-10" x-data="{ isMultiLevelMenuOpen: false }">
            <nav-link :href="route('dashboard')" :active="route().current('dashboard')">
                
                Inicio
            </nav-link>

            <nav-link :href="route('departments.index')" :active="route().current('departments.index')">
                <i class="fa-solid fa-building"></i>
                Recursos
            </nav-link>
            <nav-link :href="route('employees.index')" :active="route().current('employees.index')">
                <i class="fa-solid fa-plus"></i>
                Prestamos
            </nav-link>
           <!--  <nav-link :href="route('graphic')" :active="route().current('graphic')">
                <i class="fa-solid fa-chart-pie"></i>
                Grafica
            </nav-link> -->
            <nav-link :href="route('reports')" :active="route().current('reports')">
                <i class="fa-solid fa-table"></i>
                reporte
            </nav-link>

            <nav-link :href="route('users.index')" :active="route().current('users.index')">
                <template #icon>
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                         xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                    </svg>
                </template>
                Usuario 
            </nav-link>

   

            <a class="flex items-center mt-4 py-2 px-6 text-gray-100" href="#" @click="showingTwoLevelMenu = !showingTwoLevelMenu">
                <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M17 14v6m-3-3h6M6 10h2a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v2a2 2 0 002 2zm10 0h2a2 2 0 002-2V6a2 2 0 00-2-2h-2a2 2 0 00-2 2v2a2 2 0 002 2zM6 20h2a2 2 0 002-2v-2a2 2 0 00-2-2H6a2 2 0 00-2 2v2a2 2 0 002 2z"></path>
                </svg>
                <span class="mx-3">Two-level menu</span>
            </a>
            <transition
                enter-to-class="transition-all duration-300 ease-in-out"
                enter-from-class="max-h-0 opacity-25"
                leave-from-class="opacity-100 max-h-xl"
                leave-to-class="max-h-0 opacity-0">
                <div v-show="showingTwoLevelMenu">
                    <ul class="overflow-hidden p-2 mx-4 mt-2 space-y-2 text-sm font-medium text-white bg-gray-700 bg-opacity-50 rounded-md shadow-inner"
                        aria-label="submenu">
                        
                        <li class="px-2 py-1 transition-colors duration-150">
                            <Link class="w-full" :href="route('departments.index')">Recursos</Link>
                        </li>
                        <li class="px-2 py-1 transition-colors duration-150">
                            <Link class="w-full" :href="route('employees.index')">Estudiantes</Link>
                        </li>
                        <li class="px-2 py-1 transition-colors duration-150">
                            <Link class="w-full" :href="route('graphic')">Grafica</Link>
                        </li>
                        <li class="px-2 py-1 transition-colors duration-150">
                            <Link class="w-full" :href="route('reports')">Reporte</Link>
                        </li>
                    </ul>
                </div>
            </transition>
        </nav>
    </div>

</template>

<script>
import NavLink from '@/Components/NavLink.vue';
import { Link } from '@inertiajs/vue3';
import { ref } from 'vue'

export default {
    components: {
        NavLink,
        Link,
    },

    setup() {
        let showingTwoLevelMenu = ref(false)

        return {
            showingTwoLevelMenu
        }
    },
}
</script>

<style scoped>

</style>
