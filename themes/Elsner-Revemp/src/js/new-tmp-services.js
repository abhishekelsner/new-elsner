// Book a Call Js 

document.addEventListener('DOMContentLoaded', function () {
    const tabs = document.querySelectorAll('.tab-button');
    const quoteTab = document.querySelector('.quote-tab');
    const callTab = document.querySelector('.call-tab');

    tabs.forEach(tab => {
        tab.addEventListener('click', () => {
            tabs.forEach(t => t.classList.remove('active'));
            tab.classList.add('active');

            const selected = tab.getAttribute('data-tab');

            if (selected === 'quote') {
                quoteTab.style.display = 'block';
                callTab.style.display = 'none';
            } else {
                quoteTab.style.display = 'none';
                callTab.style.display = 'block';
            }
        });
    });
});
// Developement Expertise 
document.querySelectorAll('.expertise-block').forEach(block => {
    const title = block.querySelector('.block-title');
    const text = block.querySelector('.block-text-wrapper');

    title.addEventListener('mouseenter', () => {
        text.classList.add('paused');
    });

    title.addEventListener('mouseleave', () => {
        text.classList.remove('paused');
    });
});
// WordPress Development Services js 
document.addEventListener("DOMContentLoaded", function () {
    const tabButtons = document.querySelectorAll(".service-tab-card");
    const tabContents = document.querySelectorAll(".service-tab-content");

    const autoRotate = true; // Set true for auto-rotate
    const rotationSpeed = 5000; // Time in milliseconds (5 seconds)
    let autoRotateTimeout;
    let currentIndex = 0;

    function resetProgressBars() {
        document.querySelectorAll('.progress-bar').forEach(bar => {
            bar.style.transition = 'none';
            bar.style.width = '0%';
        });
    }

    function animateProgressBar(index, onComplete) {
        resetProgressBars();
        const progressBar = tabButtons[index].querySelector('.progress-bar');

        if (progressBar) {
            void progressBar.offsetWidth; // Force reflow
            progressBar.style.transition = `width ${rotationSpeed}ms linear`;
            progressBar.style.width = '100%';

            clearTimeout(autoRotateTimeout);
            autoRotateTimeout = setTimeout(() => {
                if (typeof onComplete === "function") {
                    onComplete();
                }
            }, rotationSpeed);
        }
    }

    function activateTab(index) {
        // Remove active class
        tabButtons.forEach((btn, i) => {
            btn.classList.toggle("active", i === index);
        });
        tabContents.forEach((content, i) => {
            content.classList.toggle("active", i === index);
        });

        currentIndex = index;

        animateProgressBar(index, () => {
            if (autoRotate) {
                const nextIndex = (currentIndex + 1) % tabButtons.length;
                activateTab(nextIndex);
            }
        });
    }

    // On tab click
    tabButtons.forEach((button, index) => {
        button.addEventListener("click", () => {
            activateTab(index);
        });
    });

    // Pause auto-rotation on hover
    const wrapper = document.querySelector(".services-tabs-wrapper");
    if (wrapper) {
        wrapper.addEventListener("mouseenter", () => {
            clearTimeout(autoRotateTimeout);
        });
        wrapper.addEventListener("mouseleave", () => {
            animateProgressBar(currentIndex, () => {
                const nextIndex = (currentIndex + 1) % tabButtons.length;
                activateTab(nextIndex);
            });
        });
    }

    // Initial activation
    activateTab(currentIndex);
});
// Faqs Js 
document.addEventListener("DOMContentLoaded", function () {
    const faqItems = document.querySelectorAll(".faq-item");

    faqItems.forEach((item) => {
        const btnWrap = item.querySelector(".faq-question-wrap"); // use button wrapper
        const answer = item.querySelector(".faq-answer");
        const icon = item.querySelector(".toggle-icon");

        btnWrap.addEventListener("click", () => {
            const isOpen = btnWrap.getAttribute("aria-expanded") === "true";

            // Close all
            faqItems.forEach((otherItem) => {
                const otherBtn = otherItem.querySelector(".faq-question-wrap");
                const otherAnswer = otherItem.querySelector(".faq-answer");
                const otherIcon = otherItem.querySelector(".toggle-icon");
                console.log('hellotest');
                otherBtn.setAttribute("aria-expanded", "false");
                otherAnswer.hidden = true;
                otherIcon.src = "https://www.elsner.com/wp-content/uploads/2025/08/Border-5.png";
                otherItem.classList.remove("active");
            });

            // Open current only if it was closed
            if (!isOpen) {
                console.log('helfseflotest');
                btnWrap.setAttribute("aria-expanded", "true");
                answer.hidden = false;
                icon.src = "https://www.elsner.com/wp-content/uploads/2025/08/Border-1.png";
                item.classList.add("active");
            }
        });
    });
});
// Banner Js 
// Add some interactive effects
document.addEventListener('DOMContentLoaded', function () {
    // Parallax effect for banners
    window.addEventListener('scroll', function () {
        const scrolled = window.pageYOffset;
        const bannerLeft = document.querySelector('.banner-left');
        const bannerRight = document.querySelector('.banner-right');

        if (bannerLeft) {
            bannerLeft.style.transform = `rotate(0) translateY(${scrolled * 0.3}px)`;
        }
        if (bannerRight) {
            bannerRight.style.transform = `rotate(0) translateY(${scrolled * 0.2}px)`;
        }
    });

    // Add click tracking for CTA
    const ctaButton = document.querySelector('.hero-cta');
    if (ctaButton) {
        ctaButton.addEventListener('click', function (e) {
            // Add a subtle scale animation
            this.style.transform = 'scale(0.95)';
            setTimeout(() => {
                this.style.transform = '';
            }, 150);
        });
    }
});
// Awards certificates js 
document.addEventListener("DOMContentLoaded", function () {
    if (jQuery(".certifications-slider").length) {
        jQuery(".certifications-slider").slick({
            slidesToShow: 6,
            slidesToScroll: 1,
            autoplay: true,
            autoplaySpeed: 2000,
            infinite: true,
            arrows: true,
            dots: false,
            responsive: [
                {
                    breakpoint: 1024,
                    settings: {
                        slidesToShow: 4
                    }
                },
                {
                    breakpoint: 768,
                    settings: {
                        slidesToShow: 3
                    }
                },
                {
                    breakpoint: 480,
                    settings: {
                        slidesToShow: 2
                    }
                }
            ]
        });
    }
});

// Service price js

document.addEventListener("DOMContentLoaded", function () {
    var headerOffset = 120; // Adjust for sticky header height
    var scrollDuration = 4000; // 4 seconds for slow glide

    document.querySelectorAll('.hero-cta[href^="#"]').forEach(function (link) {
        link.addEventListener("click", function (e) {
            var targetID = this.getAttribute("href");

            if (targetID.length > 1 && document.querySelector(targetID)) {
                e.preventDefault();

                var targetElement = document.querySelector(targetID);
                var targetPosition = targetElement.getBoundingClientRect().top + window.pageYOffset - headerOffset;
                var startPosition = window.pageYOffset;
                var distance = targetPosition - startPosition;
                var startTime = null;

                function smoothEase(t) {
                    // Cubic ease-in-out
                    return t < 0.5
                        ? 4 * t * t * t
                        : 1 - Math.pow(-2 * t + 2, 3) / 2;
                }

                function animation(currentTime) {
                    if (!startTime) startTime = currentTime;
                    var timeElapsed = currentTime - startTime;
                    var progress = Math.min(timeElapsed / scrollDuration, 1);

                    window.scrollTo(0, startPosition + (distance * smoothEase(progress)));

                    if (progress < 1) {
                        requestAnimationFrame(animation);
                    }
                }

                requestAnimationFrame(animation);
            }
        });
    });
});

// Testimonial Section 

document.addEventListener("DOMContentLoaded", function () {
    const rows = document.querySelectorAll('.slider-track');
    rows.forEach(track => {
        const clone = track.innerHTML;
        track.innerHTML += clone;
    });
});



