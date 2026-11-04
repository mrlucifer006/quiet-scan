# QuietScan – GitHub Pages Frontend Deployment Guide

This directory (`/docs`) contains the duplicate frontend of the QuietScan Smart Audio Surveillance and Burst Camera system, prepared specifically for **GitHub Pages (`github.io`)**.

---

## 🚀 How to Enable GitHub Pages (3 Steps)

1. **Commit and push** your changes to GitHub:
   ```bash
   git add docs/
   git commit -m "Add GitHub Pages frontend in docs/"
   git push origin main
   ```

2. Open your repository in your browser:
   - Navigate to: **Settings** > **Pages** (or `https://github.com/mrlucifer006/quiet-scan/settings/pages`)

3. Under **Build and deployment**:
   - **Source**: Select `Deploy from a branch`
   - **Branch**: Select `main`
   - **Folder**: Select `/docs`
   - Click **Save**.

Within 1–2 minutes, your project will be live at:
👉 **`https://mrlucifer006.github.io/quiet-scan/`**

---

## 🌟 Features Included

- **100% Client-Side Compatibility:** Uses pure HTML5, CSS3, and JavaScript without requiring server-side Python/PHP runtime on GitHub Pages.
- **Client-Side Authentication:** Preloaded with the project's authorized users (`Sanjai`, `Pon`, `Rishapthi`, `Reshekumar`). Supports custom user registration and session management in `localStorage`.
- **Interactive Sound Detection Simulator:** Generates real-time acoustic classifications (Speech, Loud Quarrel/Noise, Glass Break, Dog Bark, Music) and links to real captured burst camera snapshots.
- **Web Audio API Real-Time Microphone Analysis:** Test with your physical laptop/desktop microphone directly in the browser!
- **Zero Asset Breakage:** All asset links are strictly relative (`./css/style.css`, `./img/bg.jpg`, etc.) ensuring no broken links under sub-path repositories.
- **Jekyll Bypass:** Contains `.nojekyll` to prevent GitHub Pages Jekyll processing bugs.
