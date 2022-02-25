import Home from './pages/Home'
import About from "./pages/About";
import NotFound from "./pages/NotFound";
import Login from "./pages/Login";
import Register from "./pages/Register";
import Dashboard from "./pages/Dashboard";
import Investments from "./pages/Investments";
import LayoutFrontend from "./pages/LayoutFrontend";
import Layout from "./layout/Layout";
export default {
    mode: 'history',
    linkActiveClass:'active-menu',

    routes:[
        {
            path:'*',
            component: NotFound
        },
        {
            path: '',
            component: LayoutFrontend,
            children: [
                {
                    path: 'login',
                    component: Login,
                },
                {
                    path:'/register',
                    component: Register
                },
            ],
        },
        {
            path: '/painel',
            component: Layout,
            base: '/painel',
            children: [
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
                    path:'/about',
                    component: About
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
            ],
        },
    ]
}











