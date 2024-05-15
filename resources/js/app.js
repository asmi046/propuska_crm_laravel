import './bootstrap';
import SideMenu from './menues.js';

let side_menue = new SideMenu('#main_side_menue', '.show_menue_button');


import axios from 'axios'
import VueAxios from 'vue-axios'

import {createApp} from 'vue/dist/vue.esm-bundler';

import MassAlert from "./components/MassAlert.vue"
import MassAdd from "./components/MassAdd.vue"
import MassNumberCheck from "./components/MassNumberCheck.vue"

const mass_alert_app = createApp({
    components:{
        MassAlert,
        MassAdd
    },

    setup() {
        return {};
    },
})

if (document.getElementById('mass_alert_app')) {
    mass_alert_app.use(VueAxios, axios)
    mass_alert_app.mount("#mass_alert_app")
}

const mass_add = createApp({
    components:{
        MassAdd
    },

    setup() {
        return {};
    },
})

if (document.getElementById('mass_add')) {
    mass_add.use(VueAxios, axios)
    mass_add.mount("#mass_add")
}

const mass_n_check = createApp({
    components:{
        MassNumberCheck
    },

    setup() {
        return {};
    },
})

if (document.getElementById('mass_n_check')) {
    mass_n_check.use(VueAxios, axios)
    mass_n_check.mount("#mass_n_check")
}



