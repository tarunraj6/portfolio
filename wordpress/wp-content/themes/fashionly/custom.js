/* ====================================================
   Fashionly — Premium Interactions v2.0
   ==================================================== */

document.addEventListener('DOMContentLoaded', function () {

    /* --------------------------------------------------
       1. SCROLL REVEAL — IntersectionObserver
       -------------------------------------------------- */
    const revealEls = document.querySelectorAll('.reveal');
    if (revealEls.length) {
        const revealObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('is-visible');
                    revealObserver.unobserve(entry.target);
                }
            });
        }, { root: null, rootMargin: '0px', threshold: 0.12 });

        revealEls.forEach(el => revealObserver.observe(el));
    }

    /* --------------------------------------------------
       2. STICKY HEADER — shadow on scroll
       -------------------------------------------------- */
    const header = document.querySelector('.site-header');
    if (header) {
        const onScroll = () => {
            if (window.scrollY > 60) {
                header.classList.add('scrolled');
            } else {
                header.classList.remove('scrolled');
            }
        };
        window.addEventListener('scroll', onScroll, { passive: true });
    }

    /* --------------------------------------------------
       3. ANIMATED COUNTER — stats section
       -------------------------------------------------- */
    function animateCounter(el, target, duration) {
        const isPercent = el.textContent.includes('%');
        const isPlus    = el.textContent.includes('+');
        let start = 0;
        const step = target / (duration / 16);
        const timer = setInterval(() => {
            start += step;
            if (start >= target) {
                start = target;
                clearInterval(timer);
            }
            el.textContent = Math.round(start).toLocaleString()
                + (isPercent ? '%' : '')
                + (isPlus ? '+' : '');
        }, 16);
    }

    const statNums = document.querySelectorAll('.fsh-stat-number');
    if (statNums.length) {
        const statsObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const el = entry.target;
                    const raw = el.textContent.replace(/[^0-9]/g, '');
                    const target = parseInt(raw, 10);
                    if (!isNaN(target)) animateCounter(el, target, 1800);
                    statsObserver.unobserve(el);
                }
            });
        }, { threshold: 0.3 });
        statNums.forEach(el => statsObserver.observe(el));
    }

    /* --------------------------------------------------
       4. SMOOTH SCROLL for anchor links
       -------------------------------------------------- */
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            const href = this.getAttribute('href');
            if (href === '#') return;
            const target = document.querySelector(href);
            if (target) {
                e.preventDefault();
                target.scrollIntoView({ behavior: 'smooth', block: 'start' });
            }
        });
    });

    /* --------------------------------------------------
       5. PRODUCT CARD — tilt on mouse move
       -------------------------------------------------- */
    document.querySelectorAll('.fsh-product-card').forEach(card => {
        card.addEventListener('mousemove', (e) => {
            const rect   = card.getBoundingClientRect();
            const x      = e.clientX - rect.left - rect.width  / 2;
            const y      = e.clientY - rect.top  - rect.height / 2;
            const tiltX  = -(y / rect.height) * 6;
            const tiltY  =  (x / rect.width)  * 6;
            card.style.transform = `translateY(-8px) perspective(800px) rotateX(${tiltX}deg) rotateY(${tiltY}deg)`;
        });
        card.addEventListener('mouseleave', () => {
            card.style.transform = '';
        });
    });

    /* --------------------------------------------------
       6. NAV — active link highlight
       -------------------------------------------------- */
    const currentPath = window.location.pathname;
    document.querySelectorAll('.main-navigation a').forEach(link => {
        if (link.getAttribute('href') && link.getAttribute('href').endsWith(currentPath)) {
            link.style.color = 'var(--c-gold)';
            link.style.borderBottomColor = 'var(--c-gold)';
        }
    });

});
