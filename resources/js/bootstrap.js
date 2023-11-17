import 'bootstrap';

/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */

import axios from 'axios';
window.axios = axios;

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allows your team to easily build robust real-time web applications.
 */

// import Echo from 'laravel-echo';

// import Pusher from 'pusher-js';
// window.Pusher = Pusher;

// window.Echo = new Echo({
//     broadcaster: 'pusher',
//     key: import.meta.env.VITE_PUSHER_APP_KEY,
//     wsHost: import.meta.env.VITE_PUSHER_HOST ?? `ws-${import.meta.env.VITE_PUSHER_APP_CLUSTER}.pusher.com`,
//     wsPort: import.meta.env.VITE_PUSHER_PORT ?? 80,
//     wssPort: import.meta.env.VITE_PUSHER_PORT ?? 443,
//     forceTLS: (import.meta.env.VITE_PUSHER_SCHEME ?? 'https') === 'https',
//     enabledTransports: ['ws', 'wss'],
// });

//intercepta os request da aplicação
axios.interceptors.request.use(
 config => {
    //definir para todas  as requisiçoes os parametros de accept e autorization
    //pode acessar a sintaxe tanto array como objeto

    config.headers['Accept'] = 'application/json'
    
  let token = document.cookie.split(';').find(indice => {
            return indice.includes('token=')
        });
        token = token.split('=')[1];
        token = 'Bearer ' + token
        
        
    
    config.headers.Authorization = token
   

    console.log('Interceptando o requesta ntes do envio',config)

    return config
 },
 error=> {
    console.log('Erro na requisição:',error)
    return Promise.reject(error)
}
)

//intercepta os responses da aplicação
axios.interceptors.response.use(
    response => {
        console.log('Interceptando a resposta antes da aplicacao',response)

        return response
    },
    error => {
        console.log('Erro na resposta:',error)
        return Promise.reject(error)
    }
)

