import { createRouter, createWebHistory } from 'vue-router';
import UserRegister from '../views/UserRegister.vue';
import UserLogin from '../views/UserLogin.vue';
import UserTasks from '../views/UserTasks.vue';

const routes = [
  { path: '/register', name: 'Register', component: UserRegister },
  { path: '/login', name: 'Login', component: UserLogin },
  { path: '/tasks', name: 'Tasks', component: UserTasks, meta: { requiresAuth: true } },
];

const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes
});




router.beforeEach((to, from, next) => {
    const requiresAuth = to.matched.some(record => record.meta.requiresAuth);
    const token = localStorage.getItem('token');
  
    if (requiresAuth && !token) {
      next('/login');
    } else {
      next();
    }
  });
  
  export default router;
