/**
 * QuietScan - Frontend Application Engine
 * Supports client-side authentication, sound detection simulation,
 * Web Audio API real-time microphone analysis, and reactive UI updates.
 */

// --- 1. Authentication Manager ---
const QuietScanAuth = {
    STORAGE_KEY: 'quietscan_users',
    SESSION_KEY: 'quietscan_current_user',

    // Default users matching users.csv
    defaultUsers: [
        { username: 'Sanjai', password: '06122006' },
        { username: 'Pon', password: '19102006' },
        { username: 'Rishapthi', password: '19052007' },
        { username: 'Reshekumar', password: '17112006' }
    ],

    init() {
        if (!localStorage.getItem(this.STORAGE_KEY)) {
            localStorage.setItem(this.STORAGE_KEY, JSON.stringify(this.defaultUsers));
        }
    },

    getUsers() {
        this.init();
        try {
            return JSON.parse(localStorage.getItem(this.STORAGE_KEY)) || this.defaultUsers;
        } catch (e) {
            return this.defaultUsers;
        }
    },

    register(username, password) {
        if (!username || !password) {
            return { success: false, message: 'Please enter both username and password.' };
        }
        const users = this.getUsers();
        const exists = users.some(u => u.username.toLowerCase() === username.trim().toLowerCase());
        if (exists) {
            return { success: false, message: 'Username already exists!' };
        }

        users.push({ username: username.trim(), password: password });
        localStorage.setItem(this.STORAGE_KEY, JSON.stringify(users));
        return { success: true, message: 'Registration successful!' };
    },

    login(username, password) {
        if (!username || !password) {
            return { success: false, message: 'Please provide both username and password.' };
        }
        const users = this.getUsers();
        const match = users.find(u => u.username.toLowerCase() === username.trim().toLowerCase() && u.password === password);
        if (match) {
            localStorage.setItem(this.SESSION_KEY, match.username);
            return { success: true, user: match.username };
        }
        return { success: false, message: 'Invalid credentials.' };
    },

    getCurrentUser() {
        return localStorage.getItem(this.SESSION_KEY);
    },

    logout() {
        localStorage.removeItem(this.SESSION_KEY);
        window.location.href = 'login.html';
    },

    requireAuth() {
        const user = this.getCurrentUser();
        if (!user) {
            window.location.href = 'login.html';
        }
        return user;
    }
};

// --- 2. Sound Detection Simulation & Hardware Emulation ---
const QuietScanDetector = {
    isRunning: true,
    timer: null,
    audioContext: null,
    analyser: null,
    micStream: null,
    isMicActive: false,

    // Real photo evidence captured during project experiments
    sampleEvidence: [
        'images/2025-10-30_12_06_39.jpg',
        'images/2025-10-30_12_06_48.jpg',
        'images/2025-10-30_12_06_56.jpg',
        'images/2025-12-20_15_03_28.jpg',
        'images/2025-12-20_15_03_30.jpg',
        'images/2025-12-20_15_05_20.jpg',
        'images/2025-12-20_15_05_22.jpg',
        'images/2025-12-20_15_05_24.jpg',
        'images/2025-12-20_15_05_27.jpg'
    ],

    soundTypes: [
        { type: 'Speech', icon: 'bi-mic-fill', color: 'success', category: 'speech', location: 'Classroom / Hallway A' },
        { type: 'Noise', icon: 'bi-exclamation-triangle-fill', color: 'warning', category: 'noise', location: 'Hostel Corridor North' },
        { type: 'Glass', icon: 'bi-shield-fill-exclamation', color: 'danger', category: 'glass', location: 'Laboratory Entrance' },
        { type: 'Dog Bark', icon: 'bi-bell-fill', color: 'info', category: 'dog', location: 'Campus Perimeter Gate' },
        { type: 'Music', icon: 'bi-music-note-beamed', color: 'primary', category: 'music', location: 'Auditorium Quad' }
    ],

    history: [
        {
            sound: 'Speech',
            location: 'Classroom / Hallway A',
            time: '2025-10-30 12:06:56',
            image_path: 'images/2025-10-30_12_06_56.jpg'
        },
        {
            sound: 'Noise',
            location: 'Hostel Corridor North',
            time: '2025-10-30 12:06:48',
            image_path: 'images/2025-10-30_12_06_48.jpg'
        },
        {
            sound: 'Glass',
            location: 'Laboratory Entrance',
            time: '2025-10-30 12:06:39',
            image_path: 'images/2025-10-30_12_06_39.jpg'
        }
    ],

    init() {
        this.updateUI();
        this.startAutoDetection();
    },

    getCurrentFormattedTime() {
        const now = new Date();
        const pad = (n) => String(n).padStart(2, '0');
        return `${now.getFullYear()}-${pad(now.getMonth()+1)}-${pad(now.getDate())} ${pad(now.getHours())}:${pad(now.getMinutes())}:${pad(now.getSeconds())}`;
    },

    triggerDetection(soundTypeName = null) {
        if (!this.isRunning) return;

        let soundItem;
        if (soundTypeName) {
            soundItem = this.soundTypes.find(s => s.type.toLowerCase().includes(soundTypeName.toLowerCase())) || this.soundTypes[0];
        } else {
            soundItem = this.soundTypes[Math.floor(Math.random() * this.soundTypes.length)];
        }

        const randomImage = this.sampleEvidence[Math.floor(Math.random() * this.sampleEvidence.length)];
        const newDetection = {
            sound: soundItem.type,
            location: soundItem.location,
            time: this.getCurrentFormattedTime(),
            image_path: randomImage,
            icon: soundItem.icon,
            color: soundItem.color,
            category: soundItem.category
        };

        this.history.unshift(newDetection);
        if (this.history.length > 20) {
            this.history.pop();
        }

        this.updateUI();
    },

    startAutoDetection() {
        if (this.timer) clearInterval(this.timer);
        this.isRunning = true;
        this.timer = setInterval(() => {
            if (this.isRunning && !this.isMicActive) {
                // Occasional detection simulation every 8 seconds
                this.triggerDetection();
            }
        }, 8000);
        this.updateUI();
    },

    stopDetection() {
        this.isRunning = false;
        if (this.timer) {
            clearInterval(this.timer);
            this.timer = null;
        }
        if (this.isMicActive) {
            this.toggleMicrophone(false);
        }
        this.updateUI();
    },

    resumeDetection() {
        this.isRunning = true;
        this.startAutoDetection();
    },

    toggleDetection() {
        if (this.isRunning) {
            this.stopDetection();
        } else {
            this.resumeDetection();
        }
    },

    // Optional Web Audio API Live Microphone Analyzer
    async toggleMicrophone(forceState = null) {
        const targetState = forceState !== null ? forceState : !this.isMicActive;
        const micBtn = document.getElementById('btn-mic-toggle');
        const visualizer = document.getElementById('mic-visualizer');

        if (!targetState) {
            this.isMicActive = false;
            if (this.micStream) {
                this.micStream.getTracks().forEach(t => t.stop());
                this.micStream = null;
            }
            if (this.audioContext) {
                this.audioContext.close();
                this.audioContext = null;
            }
            if (micBtn) {
                micBtn.innerHTML = '<i class="bi bi-mic"></i> Enable Live Mic Analysis';
                micBtn.classList.remove('btn-danger');
                micBtn.classList.add('btn-secondary');
            }
            if (visualizer) visualizer.style.display = 'none';
            return;
        }

        try {
            const stream = await navigator.mediaDevices.getUserMedia({ audio: true, video: false });
            this.micStream = stream;
            const AudioContext = window.AudioContext || window.webkitAudioContext;
            this.audioContext = new AudioContext();
            const source = this.audioContext.createMediaStreamSource(stream);
            this.analyser = this.audioContext.createAnalyser();
            this.analyser.fftSize = 64;
            source.connect(this.analyser);

            this.isMicActive = true;
            if (micBtn) {
                micBtn.innerHTML = '<i class="bi bi-mic-fill"></i> Stop Mic Analysis';
                micBtn.classList.remove('btn-secondary');
                micBtn.classList.add('btn-danger');
            }
            if (visualizer) visualizer.style.display = 'block';

            this.pollMicLevels();
        } catch (err) {
            console.warn('Microphone access denied or unavailable:', err);
            alert('Microphone access was denied or is not supported by your browser. Simulated detection is active.');
        }
    },

    pollMicLevels() {
        if (!this.isMicActive || !this.analyser) return;

        const dataArray = new Uint8Array(this.analyser.frequencyBinCount);
        this.analyser.getByteFrequencyData(dataArray);

        // Calculate average volume
        let sum = 0;
        for (let i = 0; i < dataArray.length; i++) {
            sum += dataArray[i];
        }
        const average = sum / dataArray.length;

        // Animate visualizer bars
        const bars = document.querySelectorAll('.v-bar');
        bars.forEach((bar, idx) => {
            const val = dataArray[idx % dataArray.length] || 10;
            const height = Math.max(10, Math.min(65, (val / 255) * 65));
            bar.style.height = `${height}px`;
            if (average > 60) {
                bar.style.background = '#ff5252';
            } else {
                bar.style.background = '#00e676';
            }
        });

        // Volume threshold trigger (burst capture on loud sound)
        if (average > 65) {
            const now = Date.now();
            if (!this.lastTrigger || now - this.lastTrigger > 3000) {
                this.lastTrigger = now;
                this.triggerDetection('Noise');
            }
        }

        requestAnimationFrame(() => this.pollMicLevels());
    },

    updateUI() {
        // Status Badge
        const statusBadge = document.getElementById('detection-status-badge');
        const toggleBtn = document.getElementById('btn-toggle-detection');
        if (statusBadge) {
            if (this.isRunning) {
                statusBadge.className = 'status-badge active';
                statusBadge.innerHTML = '<span class="pulse-dot"></span> Active Monitoring';
            } else {
                statusBadge.className = 'status-badge paused';
                statusBadge.innerHTML = '<i class="bi bi-pause-circle"></i> Detection Paused';
            }
        }
        if (toggleBtn) {
            if (this.isRunning) {
                toggleBtn.className = 'btn-action btn-danger';
                toggleBtn.innerHTML = '<i class="bi bi-stop-circle"></i> Stop Detection';
            } else {
                toggleBtn.className = 'btn-action btn-success';
                toggleBtn.innerHTML = '<i class="bi bi-play-circle"></i> Resume Detection';
            }
        }

        // Latest Detection Card
        const latest = this.history[0];
        const latestContainer = document.getElementById('latest-detection-container');
        if (latestContainer) {
            if (!latest) {
                latestContainer.innerHTML = '<div class="alert alert-info">No sound detected yet.</div>';
                return;
            }

            let iconClass = 'bi-question-circle-fill text-secondary';
            let categoryClass = 'speech';
            const sLower = latest.sound.toLowerCase();
            if (sLower.includes('speech')) {
                iconClass = 'bi-mic-fill text-success';
                categoryClass = 'speech';
            } else if (sLower.includes('music')) {
                iconClass = 'bi-music-note-beamed text-primary';
                categoryClass = 'music';
            } else if (sLower.includes('noise')) {
                iconClass = 'bi-exclamation-triangle-fill text-warning';
                categoryClass = 'noise';
            } else if (sLower.includes('glass')) {
                iconClass = 'bi-shield-fill-exclamation text-danger';
                categoryClass = 'glass';
            } else if (sLower.includes('dog') || sLower.includes('bark')) {
                iconClass = 'bi-bell-fill text-info';
                categoryClass = 'dog';
            }

            latestContainer.innerHTML = `
                <div class="card-sound-alert ${categoryClass}">
                    <div>
                        <i class="bi ${iconClass} sound-type-icon"></i>
                    </div>
                    <div style="flex: 1;">
                        <h4 style="margin: 0 0 6px 0; font-weight: 700; color: #2c3e50;">${latest.sound}</h4>
                        <p style="margin: 3px 0; font-size: 14px; color: #555;"><strong>Time:</strong> ${latest.time}</p>
                        <p style="margin: 3px 0; font-size: 14px; color: #555;"><strong>Location:</strong> ${latest.location}</p>
                        ${latest.image_path ? `
                            <div style="margin-top: 10px;">
                                <img src="${latest.image_path}" alt="Burst Camera Snapshot" class="camera-preview" style="max-height: 180px;">
                                <div style="font-size: 12px; color: #777; margin-top: 4px;">📸 Automatic Burst Photo Captured</div>
                            </div>
                        ` : ''}
                    </div>
                </div>
            `;
        }

        // History Log Table
        const logTbody = document.getElementById('detection-log-tbody');
        if (logTbody) {
            logTbody.innerHTML = this.history.map(item => `
                <tr>
                    <td><span class="badge bg-light text-dark border">${item.time}</span></td>
                    <td><strong>${item.sound}</strong></td>
                    <td>${item.location}</td>
                    <td>
                        <a href="${item.image_path}" target="_blank" style="color: #2980b9; text-decoration: none; font-weight: 600;">
                            <i class="bi bi-image"></i> View Snapshot
                        </a>
                    </td>
                </tr>
            `).join('');
        }
    }
};

// Initialize auth check and navbar active highlights on load
document.addEventListener('DOMContentLoaded', () => {
    QuietScanAuth.init();

    // Auto highlight active navbar link
    const currentPath = window.location.pathname.split('/').pop() || 'index.html';
    const navLinks = document.querySelectorAll('.navbar li a');
    navLinks.forEach(link => {
        const href = link.getAttribute('href');
        if (href === currentPath || (currentPath === '' && href === 'index.html')) {
            link.classList.add('active');
        }
    });

    // Check auth for display buttons
    const user = QuietScanAuth.getCurrentUser();
    const userDisplay = document.getElementById('user-display-name');
    if (userDisplay && user) {
        userDisplay.textContent = user;
    }
});
