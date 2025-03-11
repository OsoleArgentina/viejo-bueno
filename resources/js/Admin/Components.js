import Sidebar from '@admin/Components/Sidebar.vue'
import Navbar from '@admin/Components/Navbar.vue'
import ConfirmationModal from '@admin/Components/ConfirmationModal.vue';

export default function register_admin_components(app) {
    app.component('sidebar', Sidebar);
    app.component('navbar', Navbar);
    app.component('confirmation-modal', ConfirmationModal);
}