

const inputFile = document.getElementById('inputImg');
const previewImage = document.getElementById('fieldImg');

inputFile.addEventListener('change', function(){
const file = this.files[0];

if(file){
    const reader = new FileReader();
    reader.readAsDataURL(file);
    reader.onload = function(){
    previewImage.setAttribute('src', this.result);
    };
}else{
    previewImage.setAttribute('src', 'img/profile/default-user-image.png');
}
});