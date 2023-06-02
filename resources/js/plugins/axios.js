import axios from "axios";

const token= document.querySelector('meta[name="csrf-token"]').getAttribute('content');

const apiClient = axios.create({
    baseURL: "/api",
    withCredentials: true,
    headers: {
        "Content-type": "application/json",
        'X-CSRF-TOKEN': token
    },
});

export default apiClient;