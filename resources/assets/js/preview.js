window.previewImage = function (event, id, name) {
    console.log('ej')

    const file = event.target.files[0];
        
    if (!file) return; 

    const reader = new FileReader();
    reader.onload = function () {
        document.getElementById(id).src = reader.result;
    };
    reader.readAsDataURL(file);
    const fileName = file.name;
    document.getElementById(name).textContent = fileName;
};
