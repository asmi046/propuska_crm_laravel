import './bootstrap';
import SideMenu from './menues.js';

let side_menue = new SideMenu('#main_side_menue', '.show_menue_button');


import axios from 'axios'
import VueAxios from 'vue-axios'

import {createApp} from 'vue/dist/vue.esm-bundler';

import PrimeVue from 'primevue/config';
import 'primevue/resources/themes/aura-light-green/theme.css'
import 'primeicons/primeicons.css'

import CheckNumber from "./components/CheckNumber.vue"
import MassAlert from "./components/MassAlert.vue"
import MassAdd from "./components/MassAdd.vue"
import MassNumberCheck from "./components/MassNumberCheck.vue"
import DebtorsAdd from "./components/DebtorsAdd.vue"
import MainPage from "./components/MainPage/MainPage.vue"
import LogEvent from "./components/LogEvent/LogEvent.vue"

import ToAlertList from "./components/ToAlertList.vue"
import FineAlertList from "./components/FineAlertList.vue"

import DebtorsList from "./components/DebtorsList.vue"
import DeleteByEmail from './components/DeleteByEmail.vue';
import UpdateByNumber from './components/UpdateByNumber.vue';
import Settings from './components/Settings.vue';
import EmailTemplateList from './components/EmailTemplate/EmailTemplateList.vue';
import DebtorsCh from './components/DebtorsCh.vue';
import ToastService from 'primevue/toastservice';
import ConfirmationService from 'primevue/confirmationservice';

const email_templates = createApp({
    components:{
        EmailTemplateList
    },

    setup() {
        return {};
    },
})

if (document.getElementById('email_templates')) {
    email_templates.use(VueAxios, axios)
    email_templates.use(PrimeVue)
    email_templates.use(ToastService);
    email_templates.mount("#email_templates")
}

const debtors_chek = createApp({
    components:{
        DebtorsCh
    },

    setup() {
        return {};
    },
})

if (document.getElementById('debtors_chek')) {
    debtors_chek.use(VueAxios, axios)
    debtors_chek.use(PrimeVue)
    debtors_chek.use(ToastService);
    debtors_chek.use(ConfirmationService);
    debtors_chek.mount("#debtors_chek")
}

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
    mass_alert_app.use(PrimeVue)
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

const debtors_add = createApp({
    components:{
        DebtorsAdd
    },

    setup() {
        return {};
    },
})

if (document.getElementById('debtors_add')) {
    debtors_add.use(VueAxios, axios)
    debtors_add.mount("#debtors_add")
}

const main_page = createApp({
    components:{
        MainPage
    },

    setup() {
        return {};
    },
})

if (document.getElementById('main_page')) {
    main_page.use(PrimeVue);
    main_page.mount("#main_page")
}

const check_number = createApp({
    components:{
        CheckNumber
    },

    setup() {},
})

if (document.getElementById('check_number')) {
    check_number.use(PrimeVue);
    check_number.mount("#check_number")
}

const debtors_list = createApp({
    components:{
        DebtorsList
    },

    setup() {},
})

if (document.getElementById('debtors_list')) {
    debtors_list.use(PrimeVue);
    debtors_list.mount("#debtors_list")
}
const delete_by_email = createApp({
    components:{
        DeleteByEmail
    },

    setup() {},
})

if (document.getElementById('delete_by_email')) {
    delete_by_email.use(PrimeVue);
    delete_by_email.mount("#delete_by_email")
}

const update_by_number = createApp({
    components:{
        UpdateByNumber
    },

    setup() {},
})

if (document.getElementById('update_by_number')) {
    update_by_number.use(PrimeVue);
    update_by_number.mount("#update_by_number")
}

const settings_app = createApp({
    components:{
        Settings
    },

    setup() {},
})

if (document.getElementById('settings_app')) {
    settings_app.use(PrimeVue);
    settings_app.use(VueAxios, axios);
    settings_app.mount("#settings_app")
}

const event_log = createApp({
    components:{
        LogEvent
    },

    setup() {},
})

if (document.getElementById('event_log')) {
    event_log.use(PrimeVue);
    event_log.use(VueAxios, axios);
    event_log.mount("#event_log")
}

const to_alert_list = createApp({
    components:{
        ToAlertList
    },

    setup() {},
})

if (document.getElementById('to_alert_list')) {
    to_alert_list.use(PrimeVue);
    to_alert_list.use(VueAxios, axios);
    to_alert_list.mount("#to_alert_list")
}

const fine_alert_list = createApp({
    components:{
        FineAlertList
    },

    setup() {},
})

if (document.getElementById('fine_alert_list')) {
    fine_alert_list.use(PrimeVue);
    fine_alert_list.use(VueAxios, axios);
    fine_alert_list.use(ToastService);
    fine_alert_list.mount("#fine_alert_list")
}



