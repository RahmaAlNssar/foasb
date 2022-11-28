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
//    wsHost: import.meta.env.VITE_PUSHER_HOST ?? `ws-${import.meta.env.VITE_PUSHER_APP_CLUSTER}.pusher.com`,
//    wsPort: 6001,
//    wssPort: import.meta.env.VITE_PUSHER_PORT ?? 443,
//     forceTLS: false,
//     enabledTransports: ['ws', 'wss'],
//     cluster:'ap2',

// });

// Pusher.logToConsole = true;
// const pusher = new Pusher('7a34c1f33d960fcba0be', {
//     cluster: 'ap2',
//     authEndpoint: '/broadcasting/auth',
//     auth: {
//         headers: {
//             'X-CSRF-TOKEN': '{{ csrf_token() }}',
//         }
//     }
// });



// var channel = pusher.subscribe(`Notification.${userId}`);
// var count = $('#notifications_count').text();
// var route = $('#href').attr('href');


// channel.bind(`NotificationEvent`, function(data) {

// count++;
// if(count > 99){
//     count = '99+';
// }

// $('#notifications_count').text(count);

// $('#newNotifications').prepend(`
// <div class="dropdown-divider"></div>
// <a href="`+route+`" class="dropdown-item" >
// <i class="fas fa-user mr-2"></i>  From: ${data.complain.user.name}
// <br>
//   <i class="fas fa-envelope mr-2"></i> ${data.complain.body}
//   <span class="float-right text-muted text-sm">${moment(
//     data.complain.created_at
// ).fromNow()}</span>
// </a>`);
//   });

