import _ from 'lodash';
window._ = _;

/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */

import axios from 'axios';
window.axios = axios;

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

window.submitForm = () => {
    return {
        formData: {},
        errorMessages: [],
        isLoading: false,
        isSuccess: false,
        mainErrorMessage: null,

        onSubmitPost(e) {
            let storedata = new FormData(e.target);
            this.isLoading = true;
            axios.post(e.target.action, storedata)
                .then(response => {
                    this.errorMessages = [];
                    if (response.status == 201) {
                        this.isSuccess = true;
                        setTimeout(() => {
                            window.location.href = response.data.data?.slug ? response.data.data.slug : window.location;
                        }, 1000);
                    } else {
                        this.isLoading = false;
                    }
                })
                .catch(error => {
                    this.mainErrorMessage = error.response.data.message;
                    if (error.response.status !== 500) {
                        this.errorMessages = error.response.data.errors;
                    }
                    this.isLoading = false;
                });
        }
    }
}


/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allows your team to easily build robust real-time web applications.
 */

// import Echo from 'laravel-echo';

// import Pusher from 'pusher-js';
// window.Pusher = Pusher;

// window.Echo = new Echo({
//     broadcaster: 'pusher',
//     key: import.meta.env.VITE_PUSHER_APP_KEY,
//     cluster: import.meta.env.VITE_PUSHER_APP_CLUSTER ?? 'mt1',
//     wsHost: import.meta.env.VITE_PUSHER_HOST ? import.meta.env.VITE_PUSHER_HOST : `ws-${import.meta.env.VITE_PUSHER_APP_CLUSTER}.pusher.com`,
//     wsPort: import.meta.env.VITE_PUSHER_PORT ?? 80,
//     wssPort: import.meta.env.VITE_PUSHER_PORT ?? 443,
//     forceTLS: (import.meta.env.VITE_PUSHER_SCHEME ?? 'https') === 'https',
//     enabledTransports: ['ws', 'wss'],
// });
