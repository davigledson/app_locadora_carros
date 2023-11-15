/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

import './bootstrap';
import { createApp } from 'vue';
import { createStore } from 'vuex'
//Importando e configurando  o vuex


const store = createStore(
    { 
        state: { 
            teste: 'Teste de recuperação de valor da Store Vuex',
            item: {},
            transacao: {status:'',mensagem:'',}

     } 
    }
    ) 
/**
 * Next, we will create a fresh Vue application instance. You may then begin
 * registering components with the application instance so they are ready
 * to use in your application's views. An example is included for you.
 */

const app = createApp({});

import ExampleComponent from './components/ExampleComponent.vue';
import Login from './components/Login.vue';
import Home from './components/Home.vue';
import Marcas from './components/Marcas.vue';
import InputContainer from './components/InputContainer.vue';
import Table from './components/Table.vue';
import Card from './components/Card.vue';
import Modal from './components/Modal.vue';
import Alert from './components/Alert.vue';
import Paginate from './components/Paginate.vue';
app.component('example-component', ExampleComponent);
app.component('login-component', Login);
app.component('home-component', Home);
app.component('marcas-component', Marcas);
app.component('input-container-component', InputContainer);
app.component('table-component', Table);
app.component('card-component', Card);
app.component('modal-component', Modal);
app.component('alert-component', Alert);
app.component('paginate-component', Paginate);



/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// Object.entries(import.meta.glob('./**/*.vue', { eager: true })).forEach(([path, definition]) => {
//     app.component(path.split('/').pop().replace(/\.\w+$/, ''), definition.default);
// });

/**
 * Finally, we will attach the application instance to a HTML element with
 * an "id" attribute of "app". This element is included with the "auth"
 * scaffolding. Otherwise, you will need to add an element yourself.
 */
app.use(store)
app.mount('#app');
