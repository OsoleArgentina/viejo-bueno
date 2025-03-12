import Sidebar from '@admin/Components/Sidebar.vue'
import Navbar from '@admin/Components/Navbar.vue'
import ConfirmationModal from '@admin/Components/ConfirmationModal.vue';
import TextEditor from '@admin/Components/TextEditor.vue';

// TODO: pasarlo a common
import Toast from 'vue-toastification';

export default function register_admin_components(app) {
    app.use(Toast)

    app.component('sidebar', Sidebar);
    app.component('navbar', Navbar);
    app.component('confirmation-modal', ConfirmationModal);
    app.component('text-editor', TextEditor)
}