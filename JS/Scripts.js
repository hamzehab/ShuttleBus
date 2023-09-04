let currentImageIndex = 0;
const images = document.querySelectorAll('.ImageCarousel img');
images[currentImageIndex].style.display = 'block';

function changeImage() {
    images[currentImageIndex].style.display = 'none';
    currentImageIndex++;
    if (currentImageIndex >= images.length) {
        currentImageIndex = 0;
    }
    images[currentImageIndex].style.display = 'block';
}
setInterval(changeImage, 5000);
