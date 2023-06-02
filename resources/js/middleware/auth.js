export default function auth({ to, next, store, router }) {
    const loginQuery = { path: "/login", query: { redirect: to.fullPath } };

    if (!store.getters.auth) {
        next(loginQuery);
    } else {
        next();
    }
}