import Navbar from '@site/Components/Navbar.vue'
import Footer from '@site/Components/Footer.vue'

export default function register_site_components(app) {
    app.component('navbar', Navbar);
    app.component('footer-site', Footer);
}