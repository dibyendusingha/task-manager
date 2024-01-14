import './bootstrap';
import { createApp } from 'vue';
import routes from './routes';

//For SweetAlert
import VueSweetalert2 from 'vue-sweetalert2';
import 'sweetalert2/src/sweetalert2.scss';
import vSelect from 'vue-select'
import 'vue-select/dist/vue-select.css';


// import "vue-select-3/dist/vue-select.css";

//For Toaster
import Toaster from "@meforma/vue-toaster";


const login = createApp({});
login.use(routes).mount('#login');
login.use(routes).mount('#dashboard');

login.use(VueSweetalert2);
login.use(Toaster);

login.component("v-select", vSelect);






