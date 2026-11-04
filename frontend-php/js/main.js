// QuietScan PHP Frontend Helper Scripts
document.addEventListener('DOMContentLoaded', () => {
    // Highlight active navigation links
    const currentPath = window.location.pathname.split('/').pop() || 'home.php';
    const navLinks = document.querySelectorAll('.navbar li a');
    navLinks.forEach(link => {
        const href = link.getAttribute('href');
        if (href === currentPath || (currentPath === '' && href === 'home.php')) {
            link.classList.add('active');
        }
    });
});
