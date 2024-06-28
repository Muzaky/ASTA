<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/laravel-echo/dist/echo.js"></script>
    <script src="https://js.pusher.com/7.0/pusher.min.js"></script>
    <title>Document</title>
</head>
<style>
    .status-indicator {
        width: 20px;
        height: 20px;
        border-radius: 50%;
        display: inline-block;
        margin-right: 10px;
    }

    .online {
        background-color: green;
    }

    .offline {
        z background-color: red;
    }
</style>

<body class="font-[Poppins]">
    <div id="container" class="max-md:p-[32px] ">
        <img src="{{ asset('img/logo_2.png') }}" alt="">
        <p class="font-[300] text-wrap w-[200px] text-[12px] text-[#828282] mb-2">Teman yang ada untuk
            membantu kesenjangan !</p>
        @if ($id_roles == 2)
            <div class="swiper mySwiper mt-20">
                <div class="swiper-wrapper ">
                    <div class="swiper-slide">
                        <div class="w-full h-[355px] bg-[#FAE588] flex items-center justify-center text-center">
                            <h1 class="text-[32px] font-semibold w-[200px] text-wrap">Video call Volunteer</h1>
                        </div>

                        <p class="font-[300] text-wrap w-full text-[12px] text-[#828282] flex justify-center mt-4">Slide
                            untuk mengganti mode</p>
                    </div>
                    <div class="swiper-slide">
                        <div class="w-full h-[355px] bg-[#FAE588] flex items-center justify-center text-center">
                            <h1 class="text-[32px] font-semibold w-[200px] text-wrap">Voice call Volunteer</h1>
                        </div>

                        <p class="font-[300] text-wrap w-full text-[12px] text-[#828282] flex justify-center mt-4">Slide
                            untuk mengganti mode</p>
                    </div>
                    <div class="swiper-slide flex flex-col items-center mt-2">
                        <div
                            class="w-[300px] h-[285px] rounded-full bg-[#FAE588] flex items-center justify-center text-center">
                            <h1 class="text-[32px] font-semibold w-[200px] text-wrap">SOS</h1>
                        </div>

                        <p class="font-[300] text-wrap w-full text-[12px] text-[#828282] flex justify-center mt-4">Slide
                            untuk mengganti mode</p>
                    </div>

                </div>
            </div>
        @elseif ($id_roles == 3)
            <div class="flex items-center justify-center mb-4">
                <span id="status-indicator" class="status-indicator offline"></span>
                <span id="status-text">Offline</span>
            </div>
            <button id="toggle-button" class="px-4 py-2 bg-blue-500 text-white rounded">Go Online</button>
            <div>
                <button id="call-button" class="px-4 py-2 bg-green-500 text-white rounded">Call</button>
                <video id="local-video" autoplay muted></video>
                <video id="remote-video" autoplay></video>
            </div>
            <div id="incoming-call" style="display:none;">
                <p>Incoming call...</p>
                <button id="answer-button">Answer</button>
                <button id="reject-button">Reject</button>
            </div>
            <button id="end-call-button" style="display:none;">End Call</button>
        @endif
    </div>
</body>

<script src="{{ asset('js/app.js') }}" defer></script>
<script>
    document.getElementById('toggle-button').addEventListener('click', function() {
        var statusIndicator = document.getElementById('status-indicator');
        var statusText = document.getElementById('status-text');
        var button = document.getElementById('toggle-button');
        var newStatus = statusIndicator.classList.contains('offline') ? 'online' : 'offline';

        axios.post('/toggle-status', {
            status: newStatus
        }).then(response => {
            if (response.data.status === 'online') {
                statusIndicator.classList.remove('offline');
                statusIndicator.classList.add('online');
                statusText.textContent = 'Online';
                button.textContent = 'Go Offline';
            } else {
                statusIndicator.classList.remove('online');
                statusIndicator.classList.add('offline');
                statusText.textContent = 'Offline';
                button.textContent = 'Go Online';
            }
        });
    });


    document.addEventListener('DOMContentLoaded', (event) => {
        let peerConnection;
        let callerId;

        document.getElementById('call-button').addEventListener('click', function() {
            console.log('Calling volunteer...');
            axios.get('/random-volunteer')
                .then(response => {
                    if (response.status === 200) {
                        const volunteer = response.data;
                        console.log(volunteer);
                        if (volunteer) {
                            handleIncomingOffer(volunteer.id, volunteer.sdp);
                            // Display UI elements for call in progress
                            document.getElementById('call-button').style.display = 'none';
                            document.getElementById('incoming-call').style.display = 'block';
                        } else {
                            alert('No volunteers are currently online.');
                        }
                    } else {
                        alert('No volunteers are currently online.');
                    }
                })
                .catch(error => {
                    if (error.response && error.response.status === 404) {
                        alert('No volunteers are currently online.');
                    } else {
                        console.error('Error fetching volunteer:', error);
                    }
                });
        });

        function handleIncomingOffer(from, sdp) {
            // Display incoming call UI elements
            document.getElementById('incoming-call').style.display = 'block';

            // Bind event listeners to answer and reject buttons
            document.getElementById('answer-button').addEventListener('click', () => answerCall(from, sdp));
            document.getElementById('reject-button').addEventListener('click', () => rejectCall(from));
        }

        function answerCall(peerId, sdp) {
            document.getElementById('incoming-call').style.display = 'none';
            document.getElementById('end-call-button').style.display = 'block';

            navigator.mediaDevices.getUserMedia({
                    video: true,
                    audio: true
                })
                .then(stream => {
                    // Add tracks to peer connection and update UI
                    stream.getTracks().forEach(track => peerConnection.addTrack(track, stream));
                    document.getElementById('local-video').srcObject = stream;

                    // Set remote description and create answer
                    return peerConnection.setRemoteDescription(new RTCSessionDescription({
                        type: 'offer',
                        sdp
                    }));
                })
                .then(() => peerConnection.createAnswer())
                .then(answer => peerConnection.setLocalDescription(answer))
                .then(() => {
                    // Send answer to caller
                    axios.post('/signal', {
                            to: String(peerId),
                            type: 'answer',
                            sdp: peerConnection.localDescription.sdp
                        })
                        .then(response => {
                            console.log('Answer sent successfully:', response.data);
                        })
                        .catch(error => {
                            console.error('Error sending answer:', error);
                        });
                })
                .catch(error => {
                    console.error('Error handling offer:', error);
                });
        }


        function createPeerConnection(peerId) {
            const config = {
                iceServers: [{
                    urls: 'stun:stun.l.google.com:19302'
                }]
            };

            const peerConnection = new RTCPeerConnection(config);

            peerConnection.onicecandidate = (event) => {
                if (event.candidate) {
                    axios.post('/signal', {
                            to: String(peerId),
                            type: 'ice-candidate',
                            candidate: event.candidate.toJSON()
                        })
                        .then(response => {
                            console.log('ICE candidate sent successfully:', response.data);
                        })
                        .catch(error => {
                            console.error('Error sending ICE candidate:', error);
                        });
                }
            };

            peerConnection.ontrack = (event) => {
                console.log('Received remote stream:', event.streams[0]);
                document.getElementById('remote-video').srcObject = event.streams[0];
            };

            // Event listener to handle call termination
            document.getElementById('end-call-button').addEventListener('click', () => {
                console.log('Ending call...');
                endCall(peerConnection);
            });

            return peerConnection;
        }
        // Initialize Pusher and Echo
        const pusher = new Pusher('asta2233', {
            cluster: 'mt1',
            encrypted: true
        });

        const echo = new Echo({
            broadcaster: 'pusher',
            key: 'asta2233',
            cluster: 'mt1',
            forceTLS: true
        });

        // Listen for signaling messages
        // Listen for signaling messages
        echo.channel('signaling').listen('.signal', (e) => {
            const {
                type,
                from,
                data
            } = e.message;

            switch (type) {
                case 'offer':
                    handleIncomingOffer(from, data.sdp);
                    break;
                case 'answer':
                    handleAnswer(data.sdp);
                    break;
                case 'ice-candidate':
                    handleIceCandidate(data);
                    break;
                default:
                    console.warn('Unknown signal type received:', type);
                    break;
            }
        });





        function rejectCall(peerId) {
            document.getElementById('incoming-call').style.display = 'none';
            console.log('Call rejected');
            // Optionally, notify the caller of rejection using signaling server
        }

        function endCall() {
            if (peerConnection) {
                peerConnection.close();
                peerConnection = null;
            }
            // Clean up UI or other necessary tasks
            document.getElementById('local-video').srcObject = null;
            document.getElementById('remote-video').srcObject = null;
            document.getElementById('incoming-call').style.display = 'none';
            document.getElementById('end-call-button').style.display = 'none';
        }

        document.getElementById('end-call-button').addEventListener('click', endCall)
    });
</script>
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<script>
    var swiper = new Swiper('.mySwiper', {
        slidesPerView: 1, // Use 1 as a number, not a string
        spaceBetween: 30,
        pagination: {
            el: '.swiper-pagination',
            clickable: true,
        },
    });
</script>

</html>
