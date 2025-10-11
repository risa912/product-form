document.addEventListener('DOMContentLoaded', function () {
    const imageInput = document.getElementById('image');
    const previewImg = document.getElementById('image-preview');

    if (imageInput && previewImg) {
        imageInput.addEventListener('change', function () {
            const file = this.files[0];
            if (!file) {
                previewImg.src = '#';
                previewImg.style.display = 'none';
                return;
            }
            const reader = new FileReader();
            reader.onload = function (e) {
                previewImg.src = e.target.result;
                previewImg.style.display = 'block';
            };
            reader.readAsDataURL(file);
        });
    }
});