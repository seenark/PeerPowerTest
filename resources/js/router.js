import Vue from 'vue'
import Router from 'vue-router'
Vue.use(Router)

import dashboard from './components/DashBoardComponent'
import gallery from './components/GalleryComponent'
const routes = [
    {
        path:'/',
        component: dashboard
    },
    {
        path:'/gallery',
        component: gallery
    }
]


export default new Router({
    mode:'history',
    routes
})
