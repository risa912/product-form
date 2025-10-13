document.addEventListener('DOMContentLoaded', function () {
    const imageInput = document.getElementById('image');
    const previewContainer = document.querySelector('.detail-form__imageBox');
    const oldImage = document.querySelector('.detail-form__image');
    const previewDiv = document.getElementById('image-preview'); 

    imageInput.addEventListener('change', event => {
        const file = event.target.files[0];

        if (file && file.type.match(/^image\//)) {
            const reader = new FileReader();

            reader.addEventListener('load', e => {
                // 既存の画像を非表示にする
                if (oldImage) {
                    oldImage.style.display = 'none';
                }

                // 新しいプレビューを表示
                previewDiv.innerHTML = `<img src="${e.target.result}" class="detail-form__preview-img">`;
            });

            reader.readAsDataURL(file);
        } else {
            alert("画像ファイルを指定してください。");
            imageInput.value = '';
        }
    });
});