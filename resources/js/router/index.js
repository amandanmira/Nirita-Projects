import { createRouter, createWebHistory } from 'vue-router'

// Import halaman
import Home from '../Pages/Home.vue'
import About from '../Pages/About.vue'
import Units from '../Pages/Units.vue'
import Review from '../Pages/Review.vue'
import Faq from '../Pages/Faq.vue'
import Login from '../Pages/Login.vue'
import TermAndCond from '../TermAndCond/TermSection.vue';
import DashboardLayouts from '../Layouts/DashboardLayouts.vue'

const routes = [
    { path: '/', name: 'home', component: Home },
    { path: '/about', name: 'about', component: About },
    { path: '/units', name: 'units', component: Units },
    { path: '/term-and-cond', name: 'Term And Condition', component: TermAndCond },
    { path: '/review', name: 'review', component: Review },
    { path: '/faq', name: 'FAQ', component: Faq },

]

const hiddenRoutes = [
    { path: '/dashboard', name: 'dashboard', component: DashboardLayouts, meta: { hidden: true } },
    { path: '/login/admin', name: 'login', component: Login, meta: { hidden: true } },
]

const router = createRouter({
    history: createWebHistory(),
    routes: [...routes, ...hiddenRoutes],
    scrollBehavior() {
        return { top: 0 }
    },
})

export default router
