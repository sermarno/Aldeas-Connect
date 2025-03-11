const galleries = document.querySelectorAll('.gallery');
const lightbox = document.getElementById('lightbox');
const lightboxImg = document.getElementById('lightbox-img');
const close = document.querySelector('.close');
const prev = document.querySelector('.prev');
const next = document.querySelector('.next');
let currentIndex = 0;
let currentGallery = [];

galleries.forEach(gallery => {
    gallery.addEventListener('click', (e) => {
        if (e.target.tagName === 'IMG') {
            currentGallery = Array.from(gallery.querySelectorAll('img'));
            currentIndex = currentGallery.indexOf(e.target);
            showImage(currentIndex);
            hideOtherImages(currentGallery, currentIndex);
        }
    });
});

close.addEventListener('click', () => {
    lightbox.style.display = 'none';
    showAllImages(currentGallery);
});

prev.addEventListener('click', () => {
    currentIndex = (currentIndex > 0) ? currentIndex - 1 : currentGallery.length - 1;
    showImage(currentIndex);
    hideOtherImages(currentGallery, currentIndex);
});

next.addEventListener('click', () => {
    currentIndex = (currentIndex < currentGallery.length - 1) ? currentIndex + 1 : 0;
    showImage(currentIndex);
    hideOtherImages(currentGallery, currentIndex);
});

lightbox.addEventListener('click', (e) => {
    if (e.target !== lightboxImg && e.target !== prev && e.target !== next) {
        lightbox.style.display = 'none';
        showAllImages(currentGallery);
    }
});

function showImage(index) {
    lightboxImg.src = currentGallery[index].src;
    lightbox.style.display = 'flex';
}

function hideOtherImages(gallery, index) {
    gallery.forEach((img, i) => {
        if (i !== index) {
            img.style.visibility = 'hidden';
        }
    });
}

function showAllImages(gallery) {
    gallery.forEach(img => {
        img.style.visibility = 'visible';
    });
}