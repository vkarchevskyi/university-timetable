import './bootstrap';

// Theme toggle functionality
document.addEventListener('DOMContentLoaded', function() {
    const themeToggle = document.getElementById('theme-toggle');
    const darkIcon = document.getElementById('theme-toggle-dark-icon');
    const lightIcon = document.getElementById('theme-toggle-light-icon');
    const html = document.documentElement;

    // Check for saved theme preference or default to 'light'
    const currentTheme = localStorage.getItem('theme') || 'light';

    // Set initial theme
    if (currentTheme === 'dark') {
        html.classList.add('dark');
        darkIcon.classList.add('hidden');
        lightIcon.classList.remove('hidden');
    } else {
        html.classList.remove('dark');
        darkIcon.classList.remove('hidden');
        lightIcon.classList.add('hidden');
    }

    // Theme toggle event listener
    themeToggle.addEventListener('click', function() {
        html.classList.toggle('dark');

        if (html.classList.contains('dark')) {
            localStorage.setItem('theme', 'dark');
            darkIcon.classList.add('hidden');
            lightIcon.classList.remove('hidden');
        } else {
            localStorage.setItem('theme', 'light');
            darkIcon.classList.remove('hidden');
            lightIcon.classList.add('hidden');
        }
    });

    // Mobile menu functionality
    const mobileMenuButton = document.getElementById('mobile-menu-button');
    const mobileMenu = document.getElementById('mobile-menu');

    if (mobileMenuButton && mobileMenu) {
        mobileMenuButton.addEventListener('click', function() {
            mobileMenu.classList.toggle('hidden');
        });

        // Close mobile menu when clicking on links
        const mobileMenuLinks = mobileMenu.querySelectorAll('a');
        mobileMenuLinks.forEach(link => {
            link.addEventListener('click', function() {
                mobileMenu.classList.add('hidden');
            });
        });

        // Close mobile menu when clicking outside
        document.addEventListener('click', function(e) {
            if (!mobileMenuButton.contains(e.target) && !mobileMenu.contains(e.target)) {
                mobileMenu.classList.add('hidden');
            }
        });
    }

    // Smooth scrolling for anchor links
    const anchorLinks = document.querySelectorAll('a[href^="#"]');
    anchorLinks.forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            const targetId = this.getAttribute('href').substring(1);
            const targetElement = document.getElementById(targetId);

            if (targetElement) {
                const headerOffset = 80; // Account for fixed header
                const elementPosition = targetElement.offsetTop;
                const offsetPosition = elementPosition - headerOffset;

                window.scrollTo({
                    top: offsetPosition,
                    behavior: 'smooth'
                });
            }
        });
    });

    // Add scroll effect to navigation
    let lastScrollTop = 0;
    const nav = document.querySelector('nav');

    window.addEventListener('scroll', function() {
        let scrollTop = window.pageYOffset || document.documentElement.scrollTop;

        if (scrollTop > lastScrollTop && scrollTop > 100) {
            // Scrolling down
            nav.style.transform = 'translateY(-100%)';
        } else {
            // Scrolling up
            nav.style.transform = 'translateY(0)';
        }

        lastScrollTop = scrollTop;
    });

    // Add fade-in animation to sections on scroll
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -100px 0px'
    };

    const observer = new IntersectionObserver(function(entries) {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('animate-fade-in-up');
            }
        });
    }, observerOptions);

    // Observe all sections
    const sections = document.querySelectorAll('section');
    sections.forEach(section => {
        observer.observe(section);
    });

    // Demo interaction functionality
    const demoCommands = [
        { command: '/rings', response: generateRingsResponse() },
        { command: '/schedule today', response: generateScheduleResponse() },
        { command: '/s tomorrow', response: generateTomorrowSchedule() },
        { command: '/st', response: generateScheduleWithTime() }
    ];

    let currentDemoIndex = 0;

    // Auto-cycle through demo commands
    setInterval(() => {
        cycleDemoCommand();
    }, 8000);

    function cycleDemoCommand() {
        // This would update the demo terminal if we had interactive elements
        currentDemoIndex = (currentDemoIndex + 1) % demoCommands.length;
    }

    function generateRingsResponse() {
        return `1️⃣ 8:20 - 9:40
2️⃣ 9:50 - 11:10
3️⃣ 11:40 - 13:00
4️⃣ 13:10 - 14:30
5️⃣ 14:40 - 16:00`;
    }

    function generateScheduleResponse() {
        return `📅 **Today's Schedule**
1️⃣ Mathematics
2️⃣ Physics
3️⃣ Computer Science
4️⃣ English Literature`;
    }

    function generateTomorrowSchedule() {
        return `📅 **Tomorrow's Schedule**
1️⃣ Chemistry
2️⃣ History
3️⃣ Programming
4️⃣ Statistics`;
    }

    function generateScheduleWithTime() {
        return `📅 **Today's Schedule**
1️⃣ 8:20-9:40 Mathematics
2️⃣ 9:50-11:10 Physics
3️⃣ 11:40-13:00 Computer Science
4️⃣ 13:10-14:30 English Literature`;
    }
});
