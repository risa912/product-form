document.addEventListener('DOMContentLoaded', function () {
    const imageInput = document.getElementById('image');
    const previewDiv = document.getElementById('image-preview'); // class は JS には影響なし

    imageInput.addEventListener('change', event => { 
        const file = event.target.files[0]; 

        if (file && file.type.match(/image\/*/)) {
            const reader = new FileReader(); 
            reader.addEventListener('load', event => {  
                previewDiv.innerHTML = '<img src="' + event.target.result + '" class="detail-form__preview-img">';
            });
            reader.readAsDataURL(file);
        } else {
            alert("画像ファイルを指定してください。");
            imageInput.value = '';   
            return false;   
        }
    });
});