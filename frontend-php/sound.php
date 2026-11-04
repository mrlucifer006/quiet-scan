<?php
require_once __DIR__ . '/config.php';
require_login();
$page_title = "Sound Detection Dashboard – QuietScan";

$is_running = isset($_SESSION['detection_running']) ? $_SESSION['detection_running'] : true;
$currentUser = $_SESSION['user'];

// Default detection data
$detection = [
    'sound' => 'Speech',
    'time' => date('Y-m-d H:i:s'),
    'location' => 'Classroom / Hallway A',
    'image' => 'images/2025-10-30_12_06_56.jpg'
];

if (isset($_GET['trigger'])) {
    $trig = strtolower($_GET['trigger']);
    if ($trig === 'noise') {
        $detection = ['sound' => 'Noise', 'time' => date('Y-m-d H:i:s'), 'location' => 'Hostel Corridor North', 'image' => 'images/2025-10-30_12_06_48.jpg'];
    } elseif ($trig === 'glass') {
        $detection = ['sound' => 'Glass', 'time' => date('Y-m-d H:i:s'), 'location' => 'Laboratory Entrance', 'image' => 'images/2025-10-30_12_06_39.jpg'];
    } elseif ($trig === 'dog') {
        $detection = ['sound' => 'Dog', 'time' => date('Y-m-d H:i:s'), 'location' => 'Campus Perimeter Gate', 'image' => 'images/2025-12-20_15_05_22.jpg'];
    } elseif ($trig === 'music') {
        $detection = ['sound' => 'Music', 'time' => date('Y-m-d H:i:s'), 'location' => 'Auditorium Quad', 'image' => 'images/2025-12-20_15_03_30.jpg'];
    }
}

include __DIR__ . '/includes/header.php';
include __DIR__ . '/includes/navbar.php';
?>

<div class="content">
    <div class="dashboard-wrapper">

        <!-- Dashboard Header Bar -->
        <div class="dashboard-header">
            <div>
                <h2 style="margin: 0; font-size: 24px; color: var(--text-dark);">
                    <i class="bi bi-broadcast"></i> Sound Detection Dashboard
                </h2>
                <p style="margin: 4px 0 0 0; font-size: 14px; color: #666;">
                    Real-time acoustic analysis and burst camera monitoring
                </p>
            </div>

            <div style="display: flex; align-items: center; gap: 12px; flex-wrap: wrap;">
                <?php if ($is_running): ?>
                    <span class="status-badge active" id="detection-status-badge">
                        <span class="pulse-dot"></span> Active Monitoring
                    </span>
                    <a href="stop.php" class="btn-action btn-danger">
                        <i class="bi bi-stop-circle"></i> Stop Detection
                    </a>
                <?php else: ?>
                    <span class="status-badge paused" id="detection-status-badge">
                        <i class="bi bi-pause-circle"></i> Detection Paused
                    </span>
                    <a href="start.php" class="btn-action btn-success">
                        <i class="bi bi-play-circle"></i> Resume Detection
                    </a>
                <?php endif; ?>
            </div>
        </div>

        <!-- Dashboard Grid -->
        <div class="dashboard-grid">

            <!-- Left Column: Detection Display -->
            <div>
                <div class="card-panel">
                    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 16px;">
                        <h3 style="margin: 0; font-size: 18px; color: #34495e;">
                            <i class="bi bi-activity"></i> Latest Acoustic Event
                        </h3>
                        <span style="font-size: 13px; color: #777;">YAMNet Deep Learning Classifier</span>
                    </div>

                    <div id="latest-detection-container">
                        <?php if ($detection && $is_running): ?>
                            <?php
                                $soundLower = strtolower($detection['sound']);
                                $iconClass = 'bi-question-circle-fill text-secondary';
                                $categoryClass = 'speech';

                                if (strpos($soundLower, 'speech') !== false) {
                                    $iconClass = 'bi-mic-fill text-success';
                                    $categoryClass = 'speech';
                                } elseif (strpos($soundLower, 'music') !== false) {
                                    $iconClass = 'bi-music-note-beamed text-primary';
                                    $categoryClass = 'music';
                                } elseif (strpos($soundLower, 'noise') !== false) {
                                    $iconClass = 'bi-exclamation-triangle-fill text-warning';
                                    $categoryClass = 'noise';
                                } elseif (strpos($soundLower, 'glass') !== false) {
                                    $iconClass = 'bi-shield-fill-exclamation text-danger';
                                    $categoryClass = 'glass';
                                } elseif (strpos($soundLower, 'dog') !== false || strpos($soundLower, 'bark') !== false) {
                                    $iconClass = 'bi-bell-fill text-info';
                                    $categoryClass = 'dog';
                                }
                            ?>
                            <div class="card-sound-alert <?php echo $categoryClass; ?>">
                                <div>
                                    <i class="bi <?php echo $iconClass; ?> sound-type-icon"></i>
                                </div>
                                <div style="flex: 1;">
                                    <h4 style="margin: 0 0 6px 0; font-weight: 700; color: #2c3e50;">
                                        <?php echo htmlspecialchars(ucfirst($detection['sound'])); ?>
                                    </h4>
                                    <p style="margin: 3px 0; font-size: 14px; color: #555;">
                                        <strong>Time:</strong> <?php echo htmlspecialchars($detection['time']); ?>
                                    </p>
                                    <p style="margin: 3px 0; font-size: 14px; color: #555;">
                                        <strong>Location:</strong> <?php echo htmlspecialchars($detection['location']); ?>
                                    </p>
                                    <?php if (!empty($detection['image'])): ?>
                                        <div style="margin-top: 10px;">
                                            <img src="<?php echo htmlspecialchars($detection['image']); ?>"
                                                 alt="Burst Camera Snapshot"
                                                 class="camera-preview"
                                                 style="max-height: 180px;">
                                            <div style="font-size: 12px; color: #777; margin-top: 4px;">
                                                📸 Automatic Burst Photo Captured
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        <?php else: ?>
                            <div class="alert alert-info" style="background: #e8f4fd; color: #0c5460; padding: 15px; border-radius: 8px;">
                                Detection is paused or no sound detected yet. Click "Resume Detection" or test a trigger.
                            </div>
                        <?php endif; ?>
                    </div>
                </div>

                <!-- History Log Table -->
                <div class="card-panel">
                    <h3 style="margin-top: 0; font-size: 18px; color: #34495e;">
                        <i class="bi bi-clock-history"></i> Incident Event Log
                    </h3>
                    <div class="table-responsive">
                        <table class="log-table">
                            <thead>
                                <tr>
                                    <th>Timestamp</th>
                                    <th>Sound Classification</th>
                                    <th>Location</th>
                                    <th>Camera Evidence</th>
                                </tr>
                            </thead>
                            <tbody id="detection-log-tbody">
                                <tr>
                                    <td><span class="badge bg-light text-dark border"><?php echo htmlspecialchars($detection['time']); ?></span></td>
                                    <td><strong><?php echo htmlspecialchars(ucfirst($detection['sound'])); ?></strong></td>
                                    <td><?php echo htmlspecialchars($detection['location']); ?></td>
                                    <td>
                                        <a href="<?php echo htmlspecialchars($detection['image']); ?>" target="_blank" style="color: #2980b9; text-decoration: none; font-weight: 600;">
                                            <i class="bi bi-image"></i> View Snapshot
                                        </a>
                                    </td>
                                </tr>
                                <tr>
                                    <td><span class="badge bg-light text-dark border">2025-10-30 12:06:48</span></td>
                                    <td><strong>Noise</strong></td>
                                    <td>Hostel Corridor North</td>
                                    <td>
                                        <a href="images/2025-10-30_12_06_48.jpg" target="_blank" style="color: #2980b9; text-decoration: none; font-weight: 600;">
                                            <i class="bi bi-image"></i> View Snapshot
                                        </a>
                                    </td>
                                </tr>
                                <tr>
                                    <td><span class="badge bg-light text-dark border">2025-10-30 12:06:39</span></td>
                                    <td><strong>Glass</strong></td>
                                    <td>Laboratory Entrance</td>
                                    <td>
                                        <a href="images/2025-10-30_12_06_39.jpg" target="_blank" style="color: #2980b9; text-decoration: none; font-weight: 600;">
                                            <i class="bi bi-image"></i> View Snapshot
                                        </a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Right Column: Interactive Test Controls & Specs -->
            <div>
                <div class="card-panel">
                    <h3 style="margin-top: 0; font-size: 17px; color: #34495e;">
                        <i class="bi bi-sliders"></i> Test Audio Triggers
                    </h3>
                    <p style="font-size: 13px; color: #666; margin-bottom: 15px;">
                        Trigger simulated events to test the camera burst response:
                    </p>
                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 10px;">
                        <a href="sound.php?trigger=speech" class="btn-action btn-secondary" style="font-size: 13px; text-decoration: none;">
                            🗣️ Speech
                        </a>
                        <a href="sound.php?trigger=noise" class="btn-action btn-secondary" style="font-size: 13px; text-decoration: none;">
                            🚨 Quarrel / Noise
                        </a>
                        <a href="sound.php?trigger=glass" class="btn-action btn-secondary" style="font-size: 13px; text-decoration: none;">
                            💥 Glass Break
                        </a>
                        <a href="sound.php?trigger=dog" class="btn-action btn-secondary" style="font-size: 13px; text-decoration: none;">
                            🐕 Dog Bark
                        </a>
                        <a href="sound.php?trigger=music" class="btn-action btn-secondary" style="grid-column: span 2; font-size: 13px; text-decoration: none;">
                            🎵 Ambient Music
                        </a>
                    </div>
                </div>

                <div class="card-panel">
                    <h3 style="margin-top: 0; font-size: 17px; color: #34495e;">
                        <i class="bi bi-mic-fill"></i> Live Browser Microphone
                    </h3>
                    <p style="font-size: 13px; color: #666; margin-bottom: 12px;">
                        Activate Web Audio API to detect real sounds via browser microphone:
                    </p>
                    <button id="btn-mic-toggle" onclick="toggleMicrophoneLive()" class="btn-action btn-secondary" style="width: 100%;">
                        <i class="bi bi-mic"></i> Enable Live Mic Analysis
                    </button>

                    <div id="mic-visualizer" class="visualizer-container" style="display: none; margin-top: 15px;">
                        <div style="font-size: 12px; margin-bottom: 6px; color: #aaa;">Microphone Frequency Spectrum</div>
                        <div class="bars-wrapper">
                            <div class="v-bar"></div>
                            <div class="v-bar"></div>
                            <div class="v-bar"></div>
                            <div class="v-bar"></div>
                            <div class="v-bar"></div>
                            <div class="v-bar"></div>
                            <div class="v-bar"></div>
                            <div class="v-bar"></div>
                            <div class="v-bar"></div>
                            <div class="v-bar"></div>
                        </div>
                        <div style="font-size: 11px; color: #00e676;">Listening for loud disturbances...</div>
                    </div>
                </div>

                <div class="card-panel">
                    <h3 style="margin-top: 0; font-size: 17px; color: #34495e;">
                        <i class="bi bi-info-circle"></i> Edge Hardware Specs
                    </h3>
                    <ul style="padding-left: 20px; font-size: 13px; color: #555; margin: 0;">
                        <li><strong>Model:</strong> Google YAMNet (TF Hub)</li>
                        <li><strong>Sample Rate:</strong> 16,000 Hz (Mono)</li>
                        <li><strong>Camera:</strong> USB / CSI Optical Sensor</li>
                        <li><strong>Trigger Latency:</strong> &lt; 280ms</li>
                        <li><strong>Storage:</strong> Local CSV & Timestamped JPG</li>
                    </ul>
                </div>
            </div>

        </div>
    </div>
</div>

<script>
let micStream = null;
let audioContext = null;
let analyser = null;
let isMicActive = false;

async function toggleMicrophoneLive() {
    const btn = document.getElementById('btn-mic-toggle');
    const vis = document.getElementById('mic-visualizer');

    if (isMicActive) {
        isMicActive = false;
        if (micStream) micStream.getTracks().forEach(t => t.stop());
        if (audioContext) audioContext.close();
        btn.innerHTML = '<i class="bi bi-mic"></i> Enable Live Mic Analysis';
        btn.classList.remove('btn-danger');
        btn.classList.add('btn-secondary');
        vis.style.display = 'none';
        return;
    }

    try {
        const stream = await navigator.mediaDevices.getUserMedia({ audio: true, video: false });
        micStream = stream;
        const AudioCtx = window.AudioContext || window.webkitAudioContext;
        audioContext = new AudioCtx();
        const src = audioContext.createMediaStreamSource(stream);
        analyser = audioContext.createAnalyser();
        analyser.fftSize = 64;
        src.connect(analyser);

        isMicActive = true;
        btn.innerHTML = '<i class="bi bi-mic-fill"></i> Stop Mic Analysis';
        btn.classList.remove('btn-secondary');
        btn.classList.add('btn-danger');
        vis.style.display = 'block';

        pollAudio();
    } catch (e) {
        alert("Microphone permission was not granted or not supported by browser.");
    }
}

function pollAudio() {
    if (!isMicActive || !analyser) return;
    const data = new Uint8Array(analyser.frequencyBinCount);
    analyser.getByteFrequencyData(data);

    let sum = 0;
    for (let i = 0; i < data.length; i++) sum += data[i];
    const avg = sum / data.length;

    const bars = document.querySelectorAll('.v-bar');
    bars.forEach((bar, i) => {
        const val = data[i % data.length] || 10;
        const h = Math.max(10, Math.min(65, (val / 255) * 65));
        bar.style.height = `${h}px`;
        bar.style.background = avg > 60 ? '#ff5252' : '#00e676';
    });

    if (avg > 65) {
        // High volume detected
        window.location.href = "sound.php?trigger=noise";
        return;
    }

    requestAnimationFrame(pollAudio);
}
</script>

<?php include __DIR__ . '/includes/footer.php'; ?>
