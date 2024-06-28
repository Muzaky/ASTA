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

import Echo from 'laravel-echo';

import Pusher from 'pusher-js';
window.Pusher = Pusher;

window.Echo = new Echo({
    broadcaster: 'pusher',
    key: process.env.MIX_PUSHER_APP_KEY,
    cluster: process.env.MIX_PUSHER_APP_CLUSTER ?? 'mt1',
    wsHost: process.env.MIX_PUSHER_HOST ? process.env.MIX_PUSHER_HOST : `ws-${process.env.MIX_PUSHER_APP_CLUSTER}.pusher.com`,
    wsPort: process.env.MIX_PUSHER_PORT ?? 80,
    wssPort: process.env.MIX_PUSHER_PORT ?? 443,
    forceTLS: (process.env.MIX_PUSHER_SCHEME ?? 'https') === 'https',
    enabledTransports: ['ws', 'wss'],
});

const peerConnections = {};
const config = {
    iceServers: [{ urls: 'stun:stun.l.google.com:19302' }]
};

function createPeerConnection(socketId) {
    const peerConnection = new RTCPeerConnection(config);

    peerConnection.onicecandidate = ({ candidate }) => {
        if (candidate) {
            socket.emit('ice-candidate', { to: socketId, candidate });
        }
    };

    peerConnection.ontrack = ({ streams: [stream] }) => {
        document.getElementById('remote-video').srcObject = stream;
    };

    return peerConnection;
}

Echo.channel('signaling')
    .listen('.signal', (e) => {
        const { type, from, data } = e.message;

        switch (type) {
            case 'offer':
                peerConnections[from] = createPeerConnection(from);
                peerConnections[from].setRemoteDescription(new RTCSessionDescription(data));
                peerConnections[from].createAnswer()
                    .then(answer => peerConnections[from].setLocalDescription(answer))
                    .then(() => {
                        socket.emit('signal', { to: from, type: 'answer', data: peerConnections[from].localDescription });
                    });
                break;
            case 'answer':
                peerConnections[from].setRemoteDescription(new RTCSessionDescription(data));
                break;
            case 'ice-candidate':
                peerConnections[from].addIceCandidate(new RTCIceCandidate(data));
                break;
        }
    });