from flask import Flask, render_template, request, redirect, url_for
import csv
import os
import sound as sound_detector

app = Flask(__name__)
CSV_FILE = 'users.csv'

if not os.path.exists(CSV_FILE):
    with open(CSV_FILE, 'w', newline='') as f:
        writer = csv.writer(f)
        writer.writerow(['username', 'password'])


@app.route('/')
def root():
    return redirect(url_for('login'))

@app.route('/register', methods=['GET', 'POST'])
def register():
    message = ''
    if request.method == 'POST':
        username = request.form['username']
        password = request.form['password']

        with open(CSV_FILE, 'r') as f:
            reader = csv.DictReader(f)
            for row in reader:
                if row['username'] == username:
                    message = "Username already exists!"
                    return render_template('register.html', message=message)

        with open(CSV_FILE, 'a', newline='') as f:
            writer = csv.writer(f)
            writer.writerow([username, password])
        return redirect(url_for('login'))

    return render_template('register.html', message=message)

@app.route('/login', methods=['GET', 'POST'])
def login():
    error = ''
    if request.method == 'POST':
        username = request.form['username']
        password = request.form['password']
        with open(CSV_FILE, newline='') as file:
            reader = csv.reader(file)
            next(reader)  # Skip header
            for row in reader:
                if row and row[0] == username and row[1] == password:
                    # Start sound detection thread only once
                    if not sound_detector.stop_flag.is_set():
                        sound_detector.start_detection()
                    return redirect(url_for('sound'))
        error = "Invalid credentials."
    return render_template('login.html', error=error)

@app.route('/sound')
def sound():
    data = sound_detector.get_latest_detection()
    return render_template('sound.html', detection=data)

@app.route('/stop')
def stop():
    sound_detector.stop_detection()
    return redirect(url_for('sound'))

@app.route('/home')
def home():
    return render_template('home.html')

@app.route('/about')
def about():
    return render_template('about.html')

@app.route('/team')
def team():
    return render_template('team.html')

@app.route('/contact')
def contact():
    return render_template('contact.html')

# --- Main ---

if __name__ == '__main__':
    app.run(host = "0.0.0.0",port = 5000)
