import Home from './components/Home'
import About from "./components/About";
import NotFound from "./components/NotFound";

export default {
    mode: 'history',
    linkActiveClass:'active-menu',

    routes:[
        {
            path:'*',
            component: NotFound
        },
        {
            path:'/',
            component: Home
        },
        {
            path:'/about',
            component: About
        },
    ]
}
