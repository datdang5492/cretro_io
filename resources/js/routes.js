import homepage from './components/homepage/Homepage';
import page_not_found from "./components/error_page/PageNotFound";
import retrospective from './components/meeting/Retrospective';
import setup_meeting from './components/meeting/SetupMeeting';
import signin from './components/authentication/Signin';
import signup from './components/authentication/Signup';
import forgot_password from './components/authentication/ForgotPassword';
import password_reset from './components/authentication/PasswordReset';
import navigation from './components/Navigation';
import bottom from './components/Bottom';
import signup_activate from './components/authentication/SignupActivate';

export default [
    {path: "*", component: page_not_found},
    {
        path: '/',
        name: 'homepage',
        components: {
            default: homepage,
            navigation: navigation,
            bottom: bottom,
        }
    },
    {path: '/sign-in', name: 'sign-in', components: {default: signin}},
    {path: '/sign-up', components: {default: signup}},
    {path: '/sign-up/activate/:token', component: signup_activate},
    {path: '/forgot-password', components: {default: forgot_password}},
    {path: '/password/find/:token', component: password_reset},
    {
        path: '/meeting/retrospective/create',
        components: {
            default: setup_meeting,
            // navigation: navigation,
            // bottom: bottom,
        },
        meta: {requiresAuth: true}
    },
    {
        path: '/meeting/retrospective/:id', components: {
            default: retrospective,
            // navigation: navigation,
            // bottom: bottom,
        }
    },
]
