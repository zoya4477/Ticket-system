import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

// import Echo from 'laravel-echo';
// import Pusher from 'pusher-js';

// window.Pusher = Pusher;

// window.Echo = new Echo({
//     broadcaster: 'pusher',
//     key: process.env.MIX_PUSHER_APP_KEY,
//     cluster: process.env.MIX_PUSHER_APP_CLUSTER,
//     forceTLS: true
// });

// // Replace `userId` with the authenticated user ID from Laravel blade
// const userId = document.head.querySelector('meta[name="user-id"]').content;

// window.Echo.private(`App.Models.User.${userId}`)
//     .notification((notification) => {
//         console.log(notification);
//         // show toast or update notification dropdown
//     });