import os
import docx
from docx.shared import Inches, Pt, RGBColor
from docx.enum.text import WD_ALIGN_PARAGRAPH

def build_project_report(output_filename):
    doc = docx.Document()

    # Document properties
    doc.core_properties.title = "Deep Learning Based Audio Event Detection for Selective Video Capture Project Report"
    doc.core_properties.author = "Mr. Sanjai M S, Ms. Razeena Tasneem B, Ms. Pon Prathakshana G, Mr. Ramkumar V, Dr. R. Subramaniyan Raja"
    doc.core_properties.subject = "Deep Learning Based Audio Event Detection for Selective Video Capture"
    doc.core_properties.comments = "Project Report formatted to template specification and Indian Patent Application No. 202541109849 A"

    # Page setup: A4, Left 1.25", Right 1.0", Top 1.0", Bottom 1.0"
    sec = doc.sections[0]
    sec.page_width = Inches(8.268)
    sec.page_height = Inches(11.693)
    sec.top_margin = Inches(1.0)
    sec.bottom_margin = Inches(1.0)
    sec.left_margin = Inches(1.25)
    sec.right_margin = Inches(1.0)

    # Helper: Title (Heading 1)
    p_title = doc.add_paragraph()
    p_title.style = 'Heading 1'
    p_title.paragraph_format.space_before = Pt(24)
    p_title.paragraph_format.space_after = Pt(24)
    p_title.paragraph_format.line_spacing = 1.5
    r_title = p_title.add_run('DEEP LEARNING BASED AUDIO EVENT DETECTION FOR SELECTIVE VIDEO CAPTURE PROJECT REPORT')
    r_title.font.name = 'Times New Roman'
    r_title.font.size = Pt(14)
    r_title.font.bold = True

    # Empty paragraph
    p_e = doc.add_paragraph()
    p_e.paragraph_format.line_spacing = 1.5

    # Section 1: Abstract (Heading 2)
    p_h1 = doc.add_paragraph()
    p_h1.style = 'Heading 2'
    p_h1.paragraph_format.space_before = Pt(12)
    p_h1.paragraph_format.space_after = Pt(6)
    p_h1.paragraph_format.line_spacing = 1.5
    r_h1 = p_h1.add_run('1. Abstract')
    r_h1.font.name = 'Times New Roman'
    r_h1.font.size = Pt(12)
    r_h1.font.bold = True

    # Abstract Paragraph 1: Verbatim Patent Description
    p_abs1 = doc.add_paragraph()
    p_abs1.alignment = WD_ALIGN_PARAGRAPH.JUSTIFY
    p_abs1.paragraph_format.space_before = Pt(0)
    p_abs1.paragraph_format.space_after = Pt(6)
    p_abs1.paragraph_format.line_spacing = 1.5
    r_abs1 = p_abs1.add_run(
        "The invention relates to an AI-powered sound-activated surveillance system designed for efficient and intelligent security monitoring. "
        "It integrates a microphone array with a deep learning-based sound classification model to detect specific audio cues such as glass breaking, "
        "metal impact, forced entry, or screams. The system remains in a low-power listening mode and activates the camera only upon detecting suspicious sounds, "
        "capturing short image sequences instead of continuous video. This selective activation reduces storage requirements, power consumption, "
        "and operational costs while maintaining high reliability and privacy protection, making it ideal for low-visibility or nighttime surveillance environments."
    )
    r_abs1.font.name = 'Times New Roman'
    r_abs1.font.size = Pt(12)

    # Abstract Paragraph 2: Technical Architecture & System Implementation
    p_abs2 = doc.add_paragraph()
    p_abs2.alignment = WD_ALIGN_PARAGRAPH.JUSTIFY
    p_abs2.paragraph_format.space_before = Pt(0)
    p_abs2.paragraph_format.space_after = Pt(6)
    p_abs2.paragraph_format.line_spacing = 1.5
    r_abs2 = p_abs2.add_run(
        "The QuietScan system realizes this patented methodology by deploying Google YAMNet—a deep convolutional neural network based on MobileNet "
        "trained on the extensive AudioSet taxonomy—interfaced with real-time audio acquisition at 16 kHz. Operating autonomously within an optimized containerized "
        "environment, the system continuously analyzes streaming acoustic waveforms. When detected acoustic signatures correspond to high-priority threat categories "
        "(such as glass breaking, forced entry, quarreling vocalizations, or barking), an asynchronous thread-safe event trigger is activated. "
        "The optical subsystem immediately initiates burst image capture, recording high-resolution evidentiary photographs tagged with microsecond-resolution "
        "timestamps into a secure image repository. An authenticated web dashboard developed in Python Flask provides administrative controls, user management, "
        "and real-time incident monitoring, effectively eliminating the massive storage and power costs associated with 24/7 video streaming while ensuring tamper-evident surveillance records."
    )
    r_abs2.font.name = 'Times New Roman'
    r_abs2.font.size = Pt(12)

    # Abstract Paragraph 3: Official Patent Application Metadata
    p_abs3 = doc.add_paragraph()
    p_abs3.alignment = WD_ALIGN_PARAGRAPH.JUSTIFY
    p_abs3.paragraph_format.space_before = Pt(0)
    p_abs3.paragraph_format.space_after = Pt(6)
    p_abs3.paragraph_format.line_spacing = 1.5
    r_abs3 = p_abs3.add_run(
        "Patent Application Details: Patent Application No. 202541109849 A | Filing Date: 12/11/2025 | Publication Date: 28/11/2025 | "
        "The Patent Office Journal No. 48/2025 Dated 28/11/2025 (India) | International Classification: G08B 13/04, B21C 23/00, C03C 29/00, C03C 27/02, A63D 15/14 | "
        "Applicants: Mr. Ramkumar V, Mr. Sanjai M S, Ms. Razeena Tasneem B, Ms. Pon Prathakshana G, Dr. R. Subramaniyan Raja | "
        "Inventors: Mr. Sanjai M S, Ms. Razeena Tasneem B, Ms. Pon Prathakshana G, Mr. Ramkumar V, Dr. R. Subramaniyan Raja."
    )
    r_abs3.font.name = 'Times New Roman'
    r_abs3.font.size = Pt(12)

    # Empty paragraph
    p_e2 = doc.add_paragraph()
    p_e2.paragraph_format.line_spacing = 1.5

    # Section 2: Sample Code (Heading 2)
    p_h2 = doc.add_paragraph()
    p_h2.style = 'Heading 2'
    p_h2.paragraph_format.space_before = Pt(12)
    p_h2.paragraph_format.space_after = Pt(6)
    p_h2.paragraph_format.line_spacing = 1.5
    r_h2 = p_h2.add_run('2. Sample Code')
    r_h2.font.name = 'Times New Roman'
    r_h2.font.size = Pt(12)
    r_h2.font.bold = True

    # List of code files to include
    code_files = [
        ('QuietScan/sound.py', 'sound.py'),
        ('QuietScan/app.py', 'app.py'),
        ('QuietScan/compose.yaml', 'compose.yaml'),
        ('QuietScan/Dockerfile', 'Dockerfile'),
        ('QuietScan/requirements.txt', 'requirements.txt'),
        ('QuietScan/run_linux.sh', 'run_linux.sh'),
        ('QuietScan/users.csv', 'users.csv'),
        ('QuietScan/Templates/sound.html', 'templates\\sound.html'),
        ('QuietScan/Templates/home.html', 'templates\\home.html'),
        ('QuietScan/Templates/about.html', 'templates\\about.html'),
        ('QuietScan/Templates/team.html', 'templates\\team.html'),
        ('QuietScan/Templates/contact.html', 'templates\\contact.html'),
        ('QuietScan/Templates/login.html', 'templates\\login.html'),
        ('QuietScan/Templates/register.html', 'templates\\register.html'),
        ('QuietScan/Templates/success.html', 'templates\\success.html'),
        ('QuietScan/Templates/base.html', 'templates\\base.html'),
        ('QuietScan/static/style.css', 'static\\style.css'),
    ]

    for file_path, display_name in code_files:
        # File header
        p_f = doc.add_paragraph()
        p_f.paragraph_format.space_before = Pt(10)
        p_f.paragraph_format.space_after = Pt(4)
        p_f.paragraph_format.line_spacing = 1.5
        r_f = p_f.add_run(f'File: {display_name}')
        r_f.font.name = 'Consolas'
        r_f.font.size = Pt(11)
        r_f.font.bold = True

        with open(file_path, 'r', encoding='utf-8', errors='replace') as f:
            lines = f.readlines()

        for line in lines:
            line_str = line.rstrip('\r\n')
            p_l = doc.add_paragraph()
            p_l.paragraph_format.space_before = Pt(0)
            p_l.paragraph_format.space_after = Pt(0)
            p_l.paragraph_format.line_spacing = 1.0
            r_l = p_l.add_run(line_str)
            r_l.font.name = 'Consolas'
            r_l.font.size = Pt(10)

        # Spacing between files
        p_sep1 = doc.add_paragraph()
        p_sep1.paragraph_format.space_before = Pt(0)
        p_sep1.paragraph_format.space_after = Pt(0)
        p_sep1.paragraph_format.line_spacing = 1.0
        r_s1 = p_sep1.add_run('')
        r_s1.font.name = 'Consolas'
        r_s1.font.size = Pt(10)

        p_sep2 = doc.add_paragraph()
        p_sep2.paragraph_format.space_after = Pt(12)
        p_sep2.paragraph_format.line_spacing = 1.5

    # Section 3: Output Images (Heading 2)
    p_h3 = doc.add_paragraph()
    p_h3.style = 'Heading 2'
    p_h3.paragraph_format.space_before = Pt(12)
    p_h3.paragraph_format.space_after = Pt(6)
    p_h3.paragraph_format.line_spacing = 1.5
    r_h3 = p_h3.add_run('3. Output Images')
    r_h3.font.name = 'Times New Roman'
    r_h3.font.size = Pt(12)
    r_h3.font.bold = True

    # Descriptive overview of Output Images
    p_out_desc = doc.add_paragraph()
    p_out_desc.alignment = WD_ALIGN_PARAGRAPH.JUSTIFY
    p_out_desc.paragraph_format.space_before = Pt(0)
    p_out_desc.paragraph_format.space_after = Pt(6)
    p_out_desc.paragraph_format.line_spacing = 1.5
    r_out_desc = p_out_desc.add_run(
        "This section documents the experimental results, official patent documentation, and empirical camera outputs "
        "captured by the QuietScan surveillance system. Figure 1 illustrates the published Indian Patent Application document "
        "for the invention (Application No. 202541109849 A). Subsequent figures exhibit actual surveillance frames automatically "
        "captured in burst mode by the camera subsystem upon real-time classification of acoustic trigger events."
    )
    r_out_desc.font.name = 'Times New Roman'
    r_out_desc.font.size = Pt(12)

    # Image list: (path, width_inches, caption)
    images_to_add = [
        ('patent_document.png', 5.2, 'Figure 1: Official Indian Patent Application Publication Document (Application No. 202541109849 A)'),
        ('static/images/2025-12-20_15_05_20.jpg', 4.8, 'Figure 2: Sound-Triggered Optical Surveillance Frame (Sequence 1, Frame 1) – Timestamp: 2025-12-20 15:05:20'),
        ('static/images/2025-12-20_15_05_22.jpg', 4.8, 'Figure 3: Sound-Triggered Optical Surveillance Frame (Sequence 1, Frame 2) – Timestamp: 2025-12-20 15:05:22'),
        ('static/images/2025-12-20_15_05_24.jpg', 4.8, 'Figure 4: Sound-Triggered Optical Surveillance Frame (Sequence 1, Frame 3) – Timestamp: 2025-12-20 15:05:24'),
        ('static/images/2025-12-20_15_05_27.jpg', 4.8, 'Figure 5: Sound-Triggered Optical Surveillance Frame (Sequence 1, Frame 4) – Timestamp: 2025-12-20 15:05:27'),
        ('static/images/2025-12-20_15_03_28.jpg', 4.8, 'Figure 6: Burst Photo Capture on Acoustic Event Trigger (Sequence 2, Frame 1) – Timestamp: 2025-12-20 15:03:28'),
        ('static/images/2025-12-20_15_03_30.jpg', 4.8, 'Figure 7: Burst Photo Capture on Acoustic Event Trigger (Sequence 2, Frame 2) – Timestamp: 2025-12-20 15:03:30'),
        ('QuietScan/static/images/2025-10-30_12_06_39.jpg', 4.8, 'Figure 8: Baseline Acoustic Calibration Verification Frame – Timestamp: 2025-10-30 12:06:39'),
        ('QuietScan/static/images/2025-10-30_12_06_48.jpg', 4.8, 'Figure 9: Baseline Acoustic Calibration Verification Frame – Timestamp: 2025-10-30 12:06:48'),
        ('QuietScan/static/images/2025-10-30_12_06_56.jpg', 4.8, 'Figure 10: Baseline Acoustic Calibration Verification Frame – Timestamp: 2025-10-30 12:06:56'),
    ]

    for img_path, width_in, caption in images_to_add:
        if os.path.exists(img_path):
            p_img = doc.add_paragraph()
            p_img.alignment = WD_ALIGN_PARAGRAPH.CENTER
            p_img.paragraph_format.space_before = Pt(14)
            p_img.paragraph_format.space_after = Pt(4)
            r_img = p_img.add_run()
            r_img.add_picture(img_path, width=Inches(width_in))

            p_cap = doc.add_paragraph()
            p_cap.alignment = WD_ALIGN_PARAGRAPH.CENTER
            p_cap.paragraph_format.space_before = Pt(2)
            p_cap.paragraph_format.space_after = Pt(12)
            p_cap.paragraph_format.line_spacing = 1.5
            r_cap = p_cap.add_run(caption)
            r_cap.font.name = 'Times New Roman'
            r_cap.font.size = Pt(11)
            r_cap.font.italic = True
        else:
            print(f"Warning: Image {img_path} not found.")

    doc.save(output_filename)
    print(f"Report saved successfully as {output_filename}!")

if __name__ == '__main__':
    build_project_report('Project_Report.docx')
    build_project_report('Deep_Learning_Audio_Event_Detection_Project_Report.docx')
