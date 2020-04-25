window.onload = function(){
    const lis = document.querySelectorAll('.category li.noadmin')
    for (let li of lis) {
        li.addEventListener('click', function(){
            li.classList.add('active')
        },false)
    }
    const buttons = document.querySelectorAll('button[data-id]');
    for(let button of buttons){
        button.addEventListener('click',function(){
            const id = this.dataset.id,
            url = "/tocart?id="+id,
            span = document.querySelector('.login li span');
            fetch(url).then((response) => {
                if(response.ok){
                    return response
                }
                throw Error(response.statusText)
            })
            .then(response => response.text())
            .then(text => span.innerText = text ? text : '0')
            .catch(error => alert(error))
        },false)
    }
   
}
function confirmDelete(){
        const conf = confirm('Are you sure?')
        if(!conf) return
        const btn = document.querySelector('button[class="btn btn-danger"]'),
        href = btn.dataset.href
        window.location.href = href
    }