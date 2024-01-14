import { createRouter, createWebHistory } from 'vue-router';

import Login          from './components/auth/login';
import Dashboard      from './components/dashboard';



import AddChamber     from './components/addChamber';
import ManageEmployee  from './components/manageEmployee';

import AddTask       from './components/addTask';
import MangeTask     from './components/manageTask';

import userTask       from './components/userTask';
import AddUserTask    from './components/addUserTask';

const routes = [ 
//Pages
{
    path: '/login',
    component: Login,
    name: 'user-login'
},
{
    path: '/',
    component: Dashboard,
    name: 'dashboard-page'
},

{
    path: '/add-task',
    component: AddTask,
    name: 'add-task'
},
{
    path: '/manage-task',
    component: MangeTask,
    name: 'manage-task'
},

{
    path: '/add-task',
    component: AddTask,
    name: 'add-task'
},

{
    path: '/add-employee',
    component: AddChamber,
    name: 'add-employee'
},
{
    path: '/manage-employee',
    component: ManageEmployee,
    name: 'manage-employee'
},

{
    path: '/user-task',
    component: userTask,
    name: 'user-task'
},
{
    path: '/add-user-task',
    component: AddUserTask,
    name: 'add-user-task'
},

];
export default createRouter({
    history: createWebHistory(),
    routes
})