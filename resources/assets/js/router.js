import Vue from 'vue'
import VueRouter from 'vue-router'

import AuthService from './services/auth'

/*
 |--------------------------------------------------------------------------
 | Admin Views
 |--------------------------------------------------------------------------|
 */

//Layouts
import LayoutLogin from './views/layouts/LayoutLogin.vue'
import LayoutFront from './views/layouts/LayoutFront.vue'
import LayoutForgotPasswords from './views/layouts/LayoutForgotPasswords.vue' 
import LayoutResetPassword from './views/layouts/LayoutResetPassword.vue'

//Login : Auth
// import Login from './views/auth/Login.vue'
import Register from './views/auth/Register.vue'

// Error : Not Found page
import NotFoundPage from './views/errors/404.vue'

/*
 |--------------------------------------------------------------------------
 | Frontend Views
 |--------------------------------------------------------------------------|
 */

/*
 |--------------------------------------------------------------------------
 | Vins Pages
 |--------------------------------------------------------------------------|
 */


import Welcome from './views/admin/vins/Welcome.vue'
import Dashboard from './views/admin/vins/dashboard.vue'
import Home from './components/home.vue'

import NewUser from './views/admin/vins/newUser.vue'
import vinsletterheadheaderpart from './views/admin/vins/vins_letter_header.vue'
import vinsletterheadfooterpart from './views/admin/vins/vins_letter_footer.vue'
import userDetailEdit from './views/admin/vins/userDetailEdit.vue'

//import changePwd from './views/emails/ChangePwd.vue'

import UserList from './views/admin/vins/UserList.vue'

//Hydro 
import NominationForm from './views/admin/hydro/nomination_add.vue'
import NominationList from './views/admin/hydro/nomination_list.vue'
import NominationLpgList from './views/admin/hydro/nomination_lng_list.vue'

//invoice
import Invoice from './views/admin/hydro/invoice.vue'

//Hydro selleer Dashboard
import dashboardSeller from './views/admin/hydro/dashboard_seller.vue'

//Hydro buer Dashboard
import dashboardBuyer from './views/admin/hydro/dashboard_buyer.vue'

import generateInvoice from './views/admin/hydro/generate_invoice.vue'
import generateInvoiceLng from './views/admin/hydro/generate_invoice_lng.vue'

import invoiceListBuyer from './views/admin/hydro/invoiceListBuyer.vue'

import generateBuyerInvoice from './views/admin/hydro/generate_buyer_invoice.vue'
//import generateBuyerInvoiceLng from './views/admin/hydro/generate_buyer_invoice_lng.vue'

//Truck dashboard
import dashboardTruckBuyer from './views/admin/hydro/dashboard_truck_buyer.vue'


import dashboardTruckSeller from './views/admin/hydro/dashboard_truck_seller.vue'

import suppliedLng from './views/admin/hydro/suppliedLng.vue'

import LngInvoice from './views/admin/hydro/invoicelng.vue'



import nominationLngSupplierByTruckList from './views/admin/hydro/nominationLngSupplierByTruckList.vue'



Vue.use(VueRouter)

const routes = [


    /*
     |--------------------------------------------------------------------------
     | EuroSport Route File
     |--------------------------------------------------------------------------|
     */
     /*
     |--------------------------------------------------------------------------
     | Frontend Routes
     |--------------------------------------------------------------------------|
     */

    {
        path: '/', component: LayoutFront,
        children: [
            {
                path: '/',
                component: Dashboard,
                meta: { requiresAuth: true },
                name: 'home'

            },
            {
                path: '/dashboard',
                component: Dashboard,
                meta: { requiresAuth: true },
                name: 'dashboard'
            },
            {
                path: '/nomination_add',
                component: NominationForm,
                meta: { requiresAuth: true },
                name: 'nomination_add'
            },
            {
                path: '/nomination_list',
                component: NominationList,
                meta: { requiresAuth: true },
                name: 'nomination_list'
            },
            {
                path: '/nomination_lpg_list',
                component: NominationLpgList,
                meta: { requiresAuth: true },
                name: 'nomination_lpg_list'
            },
            {
                path: '/lng_supply_bytruck_list',
                component: nominationLngSupplierByTruckList,
                meta: { requiresAuth: true },
                name: 'lng_supply_bytruck_list'
            },
            {
                path: '/generate_invoice',
                component: generateInvoice,
                meta: { requiresAuth: true },
                name: 'generate_invoice'
            },

            {
                path: '/generate_invoice_lng',
                component: generateInvoiceLng,
                meta: { requiresAuth: true },
                name: 'generate_invoice_lng'
            },
            
            {
                path: '/generate_buyer_invoice',
                component: generateBuyerInvoice,
                meta: { requiresAuth: true },
                name: 'generate_buyer_invoice'
            },
            // {
            //     path: '/generate_buyer_invoice_lng',
            //     component: generateBuyerInvoiceLng,
            //     meta: { requiresAuth: true },
            //     name: 'generate_buyer_invoice_lng'
            // },
            
            {
                path: '/invoice/:id',
                component: Invoice,
                meta: { requiresAuth: true },
                name: 'invoice'
            },
            {
                path: '/invoicelng/:id',
                component: LngInvoice,
                meta: { requiresAuth: true },
                name: 'invoicelng'
            },
             {
                path: '/buyer_invoice_list',
                component: invoiceListBuyer,
                meta: { requiresAuth: true },
                name: 'buyer_invoice_list'
            },
            {
                path: '/seller-dashboard',
                component: dashboardSeller,
                meta: { requiresAuth: true },
                name: 'seller-dashboard'
            },
            {
                path: '/buyer-dashboard',
                component: dashboardBuyer,
                meta: { requiresAuth: true },
                name: 'buyer-dashboard'
            },
            {
                path: '/buyer-v2-dashboard',
                component: dashboardTruckBuyer,
                meta: { requiresAuth: true },
                name: 'buyer-v2-dashboard'
            },
            {
                path: '/seller-v2-dashboard',
                component: dashboardTruckSeller,
                meta: { requiresAuth: true },
                name: 'seller-v2-dashboard'
            },
            {
                path: '/supply-lng',
                component: suppliedLng,
                meta: { requiresAuth: true },
                name: 'supply-lng'
            },
            
            {
                path: '/nomination-form',
                component: NominationForm,
                meta: { requiresAuth: true },
                name: 'nomination-form'
            },
            {
                path: '/vins_letterhead_Header',
                component: vinsletterheadheaderpart,
                meta: { requiresAuth: true },
                name: 'vins_letterhead_Header'
            },
             {
                path: '/vins_letterhead_footer',
                component: vinsletterheadfooterpart,
                meta: { requiresAuth: true },
                name: 'vins_letterhead_footer'
            },
            {
                path: '/NewUser',
                component: NewUser,
                meta: { requiresAuth: true },
                name: 'NewUser'
            },
            {
                path: '/UserList',
                component: UserList,
                meta: { requiresAuth: true },
                name: 'UserList'
            },
            {
                path: '/user/edit/:id',
                component: userDetailEdit,
                meta: { requiresAuth: true },
                name: 'user/edit'
            },
        ]
    },

    {
        path: '/admin', component: LayoutLogin,
        meta: { requiresAuth: true },
        children: [
            {
                path: '/',
                component: Welcome,
                name: 'welcome'
            }
        ]
    },



     /*
     |--------------------------------------------------------------------------
     | Auth & Registration Routes
     |--------------------------------------------------------------------------|
    */

    {

        path: '/login', component: LayoutLogin,

    },
    {

        path: '/forgotpassword',
        component: LayoutForgotPasswords,
        name: 'LayoutForgotPasswords'

    },

    // DEFAULT ROUTE
    {   path: '*', component : NotFoundPage }
]

const router = new VueRouter({
    routes,
    mode: 'history',
    linkActiveClass: 'active'
})

router.beforeEach((to, from, next) => {

    // If the next route is requires user to be Logged IN
    if (to.matched.some(m => m.meta.requiresAuth)){

        return AuthService.check().then(authenticated => {
            if(!authenticated){
                return next({ path : '/login'})
            }

            return next()
        })
    }

    return next()
});

export default router
