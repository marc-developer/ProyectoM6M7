let files = [];
let events = ['dragover','dragleave','drop'];

let dropArea = document.querySelector('.drop-area');
let dragDropText = dropArea.querySelector('h2');
let button = dropArea.querySelector('button');
let input = document.querySelector('#input-file');
let preview = document.querySelector('#preview');


events.forEach(event => {
    dropArea.addEventListener(event, prevDefault);
    function prevDefault (e) {
        e.preventDefault();
    }
});

dropArea.addEventListener("dragover", function(){
    //CODE   
    dropArea.classList.add('active');    
    dragDropText.textContent = "Drop to upload files";    
});

dropArea.addEventListener("dragleave", function(){
    dropArea.classList.remove('active');
    dragDropText.textContent="Drag & Drop files";
});

dropArea.addEventListener("drop", event =>{
    files = files.concat(Array.from(event.dataTransfer.files));
    showFiles();
    dropArea.classList.remove('active');
    dragDropText.textContent="Drag & Drop files";
});

input.addEventListener("change", () =>{
    console.log(input.files);
    files = files.concat(Array.from(input.files));
    showFiles();
});

button.addEventListener("click", function(e){
    e.preventDefault();
    input.click();
});

function showFiles() {
    preview.innerHTML="";
    console.log(files);
    if(files.length!==0) {
        files.forEach(function(file, index){
            processFile(file,index);
        });
    }
}

function processFile(file,index) {
    const validExtensions = ["image/jpeg", "image/jpg", "image/png", "image/gif"];
    const docType = file.type;

    if(validExtensions.includes(docType)) {
        let reader = new FileReader();
        reader.readAsDataURL(file);
        
        reader.addEventListener("load", function () {
            let prev = `<div class="previewImage">
                            <img src="${reader.result}"/>
                            <span>${file.name}</span>
                            <span onclick="remove(${index})" class="material-symbols-outlined removeBtn">c</span>
                        </div>`;
            preview.innerHTML += prev;
        });
    }
    else {
        console.log("formato de archivo no aceptado, asegurate que sea una imagen!");
        files.delete(file);
    }
}

function remove(i) {
    files.splice(i,1);
    preview.remove();
    showFiles();
}

document.getElementById("registroProducto").addEventListener("submit", function(e){
    e.preventDefault();  
    const dataTransfer = new DataTransfer();
     
    files.forEach(file=>{
        dataTransfer.items.add(file);
    })
               
    input.files = dataTransfer.files;
     
    this.submit();
});
    