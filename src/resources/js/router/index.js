import { createRouter, createWebHistory } from 'vue-router'

const router = createRouter({
  history: createWebHistory(),
  routes: [
    {
      path: '/',
      component: () => import('../pages/Answers.vue')
    },
    {
      path: '/answer/:mode',
      component: () => import('../pages/Answers.vue'),
      name: 'answer'
    },
    {
      path: '/odai/recent',
      component: () => import('../pages/Odai.vue')
    },
    {
      path: '/MC/recent',
      component: () => import('../pages/Mc.vue')
    },
    {
      path: '/login',
      name: 'login',
      component: () => import('../pages/Login.vue')
    },
    {
      path: '/register',
      name: 'register',
      component: () => import('../pages/Register.vue')
    },
    {
      path: '/show',
      component: () => import('../pages/Show.vue')
    },
    {
      path: '/threads/:id',
      component: () => import('../pages/ThreadDetail.vue')
    },
    {
      path: '/500',
      component: () => import('../pages/errors/System.vue')
    }
  ]
})

export default router