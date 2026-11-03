#Sound-Triggered Burst Camera
 A CCTV-like system that *captures burst photos when sound is detected*.It uses *YAMNet (Google's audio classification model)* and a *microphone array* to continuously listen for sound events and trigger the camera.

##Features
-Real-time sound event detection with *YAMNet*.
-Burst shot capture on sound trigger.
-Supports microphone arrays.
-Saves images with timestamps.
-Lightweight and easy to set up.

##Tech Stack
-Python 3.x.
-TensorFlow/TensorFlow Lite(YAMNet model).
-OpenCV(camera handling).
-PyAudio/sounddevice(microphone input).
-NumPy/SciPy(signal processing).
