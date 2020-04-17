import homepage from './components/homepage/Homepage';
import page_not_found from "./components/error_page/PageNotFound";
import create_meeting from './components/meeting/CreateMeeting';
import signin from './components/authentication/Signin';
import signup from './components/authentication/Signup';
import forgot_password from './components/authentication/ForgotPassword';
import navigation from './components/Navigation';
import bottom from './components/Bottom';

export default [
    {
        // catch all 404
        path: "*",
        component: page_not_found
    },
    {
        path: '/',
        name: 'homepage',
        components: {
            default: homepage,
            navigation: navigation,
            bottom: bottom,
        }
    },
    {path: '/sign-in', components: {default: signin}},
    {path: '/sign-up', components: {default: signup}},
    {path: '/forgot-password', components: {default: forgot_password}},
    {
        path: '/retrospective/create', components: {
            default: create_meeting,
            navigation: navigation,
            bottom: bottom,
        }
    }
]
