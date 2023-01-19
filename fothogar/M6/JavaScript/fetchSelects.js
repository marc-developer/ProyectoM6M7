

fetch("fetchSelects.php", option)
    .then ((response) => response.json())
    .then ((data)=>{
        let opt = document.createElement('option');
        opt.value = el.id;
        opt.text = el.nom;
    })
    .catch ((error) =>{});

let formData = new formData();
formData.append("cat1", this.value);

let options = {
    method: 'POST',
    body:formData
}