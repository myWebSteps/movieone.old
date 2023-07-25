import './bootstrap';

import '../assets/css/osahan.css';
import '../assets/vendor/fontawesome-free/css/all.min.css';
import '../assets/AdminLte/dist/css/adminlte.min.css';

import '../assets/vendor/jquery/jquery.min'
import '../assets/vendor/bootstrap/js/bootstrap.bundle.min'
import '../assets/vendor/jquery-easing/jquery.easing.min'
import '../assets/AdminLte/dist/js/adminlte'

import { createApp } from 'vue';

import router from './router.js';

import App from './components/MainComponent.vue';
import Header from './components/layouts/Header.vue';
import Sidebar from './components/layouts/Sidebar.vue';
import Footer from './components/layouts/Footer.vue';
import Filter from './components/layouts/Filter.vue';
import PageTitle from "./components/layouts/PageTitle.vue";
import AdminHeader from "./components/layouts/Admin/Header.vue";
import AdminSidebar from "./components/layouts/Admin/Sidebar.vue";
import AdminFooter from "./components/layouts/Admin/Footer.vue";
import FrontComponent from "./components/FrontLayout.vue";
import AdminComponent from "./components/AdminLayout.vue";
import AuthHeaderComponent from "./components/layouts/Auth/AuthHeader.vue";
import AuthFooterComponent from "./components/layouts/Auth/AuthFooter.vue";



const app = createApp(App)

app.use(router);

app.component('main-component', App);

app.component('header-component', Header);
app.component('sidebar-component', Sidebar);
app.component('footer-component', Footer);
app.component('filter-component', Filter);
app.component('page-title-component', PageTitle);
app.component('admin-header-component', AdminHeader);
app.component('admin-sidebar-component', AdminSidebar);
app.component('admin-footer-component', AdminFooter);
app.component('front-component', FrontComponent);
app.component('admin-component', AdminComponent);
app.component('auth-header-component', AuthHeaderComponent);
app.component('auth-footer-component', AuthFooterComponent);



app.mount('#app');
