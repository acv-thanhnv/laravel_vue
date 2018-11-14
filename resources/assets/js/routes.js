import VueRouter from 'vue-router';
import Login from './views/Login.vue';
import Sample from './views/Example.vue';


let routes = [
    {
        path: '/',
        component: Login,
        name:'login',
        
    },
    {
        path: '/sample',
        component: Sample,
        name:'dashboard',
    }
];


export default new VueRouter({
    routes
});