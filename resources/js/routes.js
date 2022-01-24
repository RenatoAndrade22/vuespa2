import Home from './pages/Home'
import About from "./pages/About";
import NotFound from "./pages/NotFound";
import Login from "./pages/Login";
import Register from "./pages/Register";
import Dashboard from "./pages/Dashboard";
import Investments from "./pages/Investments";
export default {
    mode: 'history',
    linkActiveClass:'active-menu',

    routes:[
        {
            path:'*',
            component: NotFound
        },

        {
            path:'/painel',
            component: Home,
            name: 'home'
        },
        {
            path:'/painel/investimentos',
            component: Investments
        },
        {
            path:'/painel/about',
            component: About
        },
        {
            path:'/login',
            component: Login
        },
        {
            path:'/register',
            component: Register
        },
        {
            path:'/dashboard',
            component: Dashboard,
            name: 'dashboard',

            beforeEnter:(to, from, next) => {
                axios.get('/api/athenticated').then((user) => {
                    console.log('userr', user)
                    next()
                }).catch((error)=>{
                    return next({ name: 'home'} )
                })
            }
        },
    ]
}











