// import { useToast } from "vue-toastification";
import { mapGetters } from "vuex";

const mixins = {
    methods: {
        // toast_notification(
        //     { message = "", type = "success" }
        // ) {
        //     const toast = useToast();

        //     toast(
        //         message,
        //         {
        //             type: type,
        //             position: "bottom-right",
        //             maxToasts: 2,
        //             timeout: 5000,
        //             closeOnClick: true,
        //             pauseOnFocusLoss: true,
        //             pauseOnHover: true,
        //             draggable: true,
        //             draggablePercent: 0.6,
        //             showCloseButtonOnHover: true,
        //             hideProgressBar: false,
        //             closeButton: "button",
        //             icon: true,
        //             rtl: false
        //         }
        //     )
        // },

        send_http_request(endpoint, method, headers, params, data = null) {
            return new Promise((resolve, reject) => {
                axios({
                    url: endpoint,
                    method: method,
                    headers: headers,
                    params: params,
                    data: data
                }).then(response => {
                    resolve(response)
                })
                    .catch(error => {
                        reject(error)
                    });
            })
        },

        emit_event(event_name, data) {
            console.log('asd');
            this.$emit(event_name, data)
        },

        scroll_to(element_id) {
            const element = document.getElementById(element_id);

            if (element) {
                element.scrollIntoView({ behavior: 'smooth' });
            }
        },

        window_open(url) {
            let width = 1080;
            let height = 2048;
            let left = (window.screen.width - width) / 2;
            let top = (window.screen.height - height) / 2;

            window.open(
                url,
                "",
                `width=${width},height=${height},left=${left},top=${top}` // Center window in X,Y center of the screen
            )
        },

        go_to_route(route_name, route_params = {}) {
            this.$router.push({ name: route_name, params: route_params });
        },

        go_to_url(url, newTab = true) {
            if (newTab) {
                window.open(url, '_blank');
            } else {
                window.open(url, '_self');
            }
        },
    },
    computed: {
    }
}

export default mixins
