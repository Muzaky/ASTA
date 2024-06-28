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
        background-color: red;
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
                <video id="remote-video" autoplay></video>
            </div>
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


    let peerConnection;

    document.getElementById('call-button').addEventListener('click', function() {
        console.log('Calling volunteer...');
        axios.get('/random-volunteer').then(response => {
            const volunteer = response.data;

            if (volunteer) {
                const peerConnection = createPeerConnection(volunteer.id);

                // Create offer and send SDP to the volunteer
                peerConnection.createOffer()
                    .then(offer => peerConnection.setLocalDescription(offer))
                    .then(() => {
                        axios.post('/signal', {
                                to: String(volunteer.id),
                                type: 'offer',
                                sdp: String(peerConnection.localDescription)
                            })
                            .then(response => {
                                console.log('Signal sent successfully:', response.data);
                            })
                            .catch(error => {
                                console.error('Error sending signal:', error);
                                if (error.response) {
                                    console.log(error.response
                                        .data); // Log server's validation error details
                                }
                            });
                    })
                    .catch(error => {
                        console.error('Error creating offer:', error);
                    });
            } else {
                alert('No volunteers are currently online.');
            }
        });
    });

    function createPeerConnection(peerId) {
        const config = {
            iceServers: [{
                urls: 'stun:stun.l.google.com:19302'
            }]
        };

        const peerConnection = new RTCPeerConnection(config);

        peerConnection.onicecandidate = ({
            candidate
        }) => {
            if (candidate) {
                // Send ICE candidate to the volunteer (via signaling server)
                axios.post('/signal', {
                        to: peerId,
                        candidate
                    })
                    .then(response => {
                        // Handle success if needed
                    })
                    .catch(error => {
                        console.error('Error sending ICE candidate:', error);
                    });
            }
        };

        peerConnection.ontrack = ({
            streams: [stream]
        }) => {
            // Handle incoming stream (e.g., display remote video)
            document.getElementById('remote-video').srcObject = stream;
        };

        return peerConnection;
    }

    Echo.channel('signaling').listen('.signal', (e) => {
        const {
            type,
            from,
            data
        } = e.message;

        switch (type) {
            case 'offer':
                // Received offer from caller
                peerConnection.setRemoteDescription(new RTCSessionDescription(data))
                    .then(() => {
                        // Create answer
                        return peerConnection.createAnswer();
                    })
                    .then(answer => {
                        // Set local description with answer and send it back
                        return peerConnection.setLocalDescription(answer);
                    })
                    .then(() => {
                        // Send answer via signaling server
                        axios.post('/signal', {
                                to: from,
                                type: 'answer',
                                sdp: peerConnection.localDescription
                            })
                            .then(response => {
                                // Handle success if needed
                            })
                            .catch(error => {
                                console.error('Error sending answer:', error);
                            });
                    })
                    .catch(error => {
                        console.error('Error setting remote description:', error);
                    });
                break;
            case 'answer':
                // Received answer from callee
                peerConnection.setRemoteDescription(new RTCSessionDescription(data))
                    .catch(error => {
                        console.error('Error setting remote description:', error);
                    });
                break;
            case 'ice-candidate':
                // Received ICE candidate from peer
                peerConnection.addIceCandidate(new RTCIceCandidate(data))
                    .catch(error => {
                        console.error('Error adding ICE candidate:', error);
                    });
                break;
            default:
                console.warn('Unknown signal type received:', type);
                break;
        }
    });

    // Handling ICE candidates
    peerConnection.onicecandidate = ({
        candidate
    }) => {
        if (candidate) {
            axios.post('/signal', {
                    to: volunteer.id,
                    type: 'ice-candidate',
                    candidate: candidate
                })
                .then(response => {
                    // Handle success if needed
                })
                .catch(error => {
                    console.error('Error sending ICE candidate:', error);
                });
        }
    };

    // Handling incoming tracks
    peerConnection.ontrack = ({
        streams: [stream]
    }) => {
        console.log('Received remote stream:', stream);
        document.getElementById('remote-video').srcObject = stream;
    };
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
