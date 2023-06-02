import { createWebHistory, createRouter } from "vue-router";
import Home from "../page/Home.vue";
import Order from "../page/Order.vue";
import Login from "../page/Login.vue";
import Transaction from "../page/Transaction.vue";
import auth from "../middleware/auth";
import store from "../store";

const routes = [
    { path: "/", component: Home },
    { path: "/order", component: Order },
    { path: "/login", component: Login },
    {
        path: "/transaction",
        meta: { middleware: [auth] },
        component: Transaction
    }
];

const router = createRouter({
    history: createWebHistory(),
    linkExactActiveClass: "active",
    routes,
    scrollBehavior() {
        return { top: 0 };
    },
});

router.beforeEach((to, from, next) => {
    const middleware = to.meta.middleware;
    const context = { to, from, next, store, router };

    // Check if no middlware on route
    if (!middleware) {
        return next();
    }

    middleware[0]({ ...context });
});

export default router;