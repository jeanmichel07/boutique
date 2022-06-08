var addCart = document.querySelectorAll('.cart');
var added = document.querySelector('.added');
addCart.forEach(el=>{
    el.addEventListener('click', (event)=>{
        el.classList.add("loading");
        event.preventDefault();
        let xhr = new XMLHttpRequest();
        let url = el.getAttribute("href");
        xhr.open('POST', `${url}`, true);
        xhr.onreadystatechange = function () {
            if(xhr.readyState === 4 && xhr.status === 200){
                let rsp = JSON.parse(xhr.response);
                let prod = 0;
                let idProd = el.dataset.id;
                for(var key in rsp){
                    var value = rsp[key];
                    if(key === idProd){
                        el.innerHTML = `<i class="fas fa-shopping-cart"></i><span>(${value})</span>`;
                        el.classList.remove("loading")
                    }
                    prod += value;
                }
                added.innerHTML = `${prod}`;
            }else{

            }
        };
        xhr.send();
    })
});
