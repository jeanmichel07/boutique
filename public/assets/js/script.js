var addCart = document.querySelectorAll('.cart');
var added = document.querySelector('.added');
addCart.forEach(el=>{
    el.addEventListener('click', (event)=>{
        event.preventDefault();
        let xhr = new XMLHttpRequest();
        let url = el.getAttribute("href");
        xhr.open('POST', `${url}`, false);
        xhr.onreadystatechange = function () {
            if(xhr.readyState === 4 && xhr.status === 200){
                let rsp = JSON.parse(xhr.response);
                let prod = Object.keys(rsp).length;
                added.innerHTML = `${prod}`
            }else{

            }
        };
        xhr.send()
    })
});