var text_image = document.getElementById("serie_image")
var span = document.getElementById("erreur")
var btn = document.getElementById("submit")

text_image.addEventListener('input',callback)

function callback(){
    span.innerHTML = ''
 if(text_image.value.search(/..*\.jpg$/) != -1 || text_image.value.search(/..*\.png$/) != -1){
    span.innerHTML = 'format valide'
    span.className = 'text-success'
    btn.disabled = false
}
 else {
    span.innerHTML = 'format invalide'
    span.className = 'text-danger'
    btn.disabled = true
 }
}