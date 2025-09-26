
document.addEventListener('DOMContentLoaded', () => {
    const hamburgerMenu = document.querySelector('.hamburger-menu');
    const navbar = document.querySelector('.navbar');
    const navLinks = document.querySelectorAll('.nav-links a');

    // Fungsi untuk membuka/menutup menu
    const toggleMenu = () => {
        navbar.classList.toggle('nav-open');
    };

    // Tambahkan event click pada ikon hamburger
    hamburgerMenu.addEventListener('click', toggleMenu);

    // Tambahkan event click pada setiap link menu
    // agar menu otomatis tertutup saat link diklik
    navLinks.forEach(link => {
        link.addEventListener('click', () => {
            if (navbar.classList.contains('nav-open')) {
                toggleMenu();
            }
        });
    });

    const testimonialText = document.getElementById('testimonial-text');
    const authorName = document.getElementById('testimonial-author-name');
    const authorTitle = document.getElementById('testimonial-author-title');
    const clientCards = document.querySelectorAll('.client-card');

    function updateTestimonial(card) {
        // Hapus kelas aktif dari semua kartu
        clientCards.forEach(c => c.classList.remove('active'));
        // Tambahkan kelas aktif ke kartu yang diklik
        card.classList.add('active');

        // Ambil data dari atribut data-*
        const quote = card.dataset.quote;
        const name = card.dataset.name;
        const title = card.dataset.title;

        // Kosongkan teks testimoni saat ini
        testimonialText.innerHTML = '';

        // Pecah kutipan menjadi kata-kata dan buat animasi cascade
        const words = quote.split(' ');
        words.forEach((word, index) => {
            const span = document.createElement('span');
            span.textContent = word; // Hanya kata, tanpa spasi
            span.className = 'quote-word';
            span.style.animationDelay = `${index * 0.03}s`;
            testimonialText.appendChild(span);
            
            // PERBAIKAN: Tambahkan spasi sebagai teks biasa SETELAH setiap kata
            testimonialText.append(' '); 
        });

        // Perbarui nama dan jabatan penulis
        authorName.textContent = name;
        authorTitle.textContent = title;
    }

    // Atur testimoni awal saat halaman dimuat
    const initialCard = document.querySelector('.client-card.active');
    if (initialCard) {
        updateTestimonial(initialCard);
    }

    // Tambahkan event listener untuk setiap kartu klien
    clientCards.forEach(card => {
        card.addEventListener('click', () => {
            updateTestimonial(card);
        });
    });
});

// --- Animation on Scroll Logic ---
const observerOptions = {
    root: null,
    rootMargin: '0px',
    threshold: 0.2 // Trigger saat 20% elemen terlihat
};

const observer = new IntersectionObserver((entries, observer) => {
    entries.forEach((entry, index) => {
        if (entry.isIntersecting) {
            // Cek jika parent memiliki class 'stagger-animation'
            const parent = entry.target.parentElement;
            if (parent && parent.classList.contains('stagger-animation')) {
                // Beri delay berdasarkan urutan elemen
                const delay = index * 100; // 100ms delay antar kartu
                entry.target.style.transitionDelay = `${delay}ms`;
            }

            entry.target.classList.add('visible');
            observer.unobserve(entry.target);
        }
    });
}, observerOptions);

// Terapkan observer ke semua elemen dengan class 'fade-in-up'
const fadeElements = document.querySelectorAll('.fade-in-up');
fadeElements.forEach(el => observer.observe(el));

// Terapkan observer ke semua kartu di dalam kontainer stagger
const staggerElements = document.querySelectorAll('.stagger-animation > *');
staggerElements.forEach(el => {
    el.classList.add('fade-in-up'); // Tambahkan class animasi utama
    observer.observe(el);
});

// --- Timeline Line Animation Logic ---
const timelineObserver = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
        if (entry.isIntersecting) {
            entry.target.classList.add('visible');
            timelineObserver.unobserve(entry.target);
        }
    });
}, { threshold: 0.5 }); // Trigger saat 50% timeline terlihat

const timeline = document.querySelector('.practice-timeline');
if (timeline) {
    timelineObserver.observe(timeline);
}