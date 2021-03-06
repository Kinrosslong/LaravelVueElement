export default {
    setToken(token) {
        window.localStorage.setItem('jwt_token', token);
    },

    getToken() {
        return window.localStorage.getItem('jwt_token', token);
    },
    
    removeToken() {
        window.localStorage.removeItem('jwt_token');
    }
}