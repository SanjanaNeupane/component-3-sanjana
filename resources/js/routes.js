import Index from './components/Index';
import Editor from './components/Editor';
import Register from './components/Register';
import Edit from './components/Edit';
import Create from './components/Create';
import User from './components/User';
import Profile from './components/Profile';

export default{
    mode:'history',
    linkActiveClass: 'link-active-color',
    routes: [
        {
            path: '/',
            component: Index,
            name: "Index"
        },
        {
            path: '/editor',
            component: Editor,
            beforeEnter: (to,form,next) => {
                axios.get('/api/authenticated').then(()=> next()).catch(()=> next('/'))
            },
            name: "Editor"
        },
        {
            path: '/register',
            component: Register,

            name: "Register"
        },
        {
            path: '/edit/:id',
            component: Edit,
            beforeEnter: (to,form,next) => {
                axios.get('/api/user').then((res)=> {
                    if(res.data.role != 0) next();
                    else next('Editor');
                }).catch(()=> next('/'))
            },
            name: "Edit"
        },
        {
            path: '/create',
            component: Create,
            beforeEnter: (to,form,next) => {
                axios.get('/api/user').then((res)=> {
                    if(res.data.role != 0) next();
                    else next('Editor');
                }).catch(()=> next('/'))
            },
            name: 'Create'


        },
        {
            path: '/user',
            component: User,
            beforeEnter: (to,form,next) => {
                axios.get('/api/user').then((res)=> {
                    if(res.data.role == 2) next();
                    else next('Editor');
                }).catch(()=> next('Index'))
            },
            name: 'User'


        },
        {
            path: '/profile',
            component: Profile,
            beforeEnter: (to,form,next) => {
                axios.get('/api/profile').then((res)=> {
                    if(res.data.role != 0) next();
                    else next('Editor');
                }).catch(()=> next('Index'))
            },
            name: 'Profile'


        }
    ]
}