const file = document.querySelector('.input-file');
const preview = document.querySelector('.preview');

file.addEventListener('change', (function(e){
    const files = e.target.files;
    const img_preview_old = document.querySelector('.img-preview');
    const file = files[0];
    const fileReader = new FileReader();
    fileReader.readAsDataURL(file);
    fileReader.onload = function() {
        const url = fileReader.result;
        if(img_preview_old){
            img_preview_old.remove();
        }
        if(!file['type'].search('image')){
            preview.insertAdjacentHTML(
                'beforeend',
                `<img src="${url}" alt="${file.name}" class="img-preview"/>`
            )
        }
    }
}));
