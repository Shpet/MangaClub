let butt_del = document.getElementById('deleteBook');
let butt_update = document.getElementById('updateBook');

butt_del.addEventListener('click', (e)=> {
    if(!confirm('Вы уверены, что хотите удалить?')){
        e.preventDefault();
    }
});
butt_update.addEventListener('click', (e)=> {
    if(!confirm('Вы уверены, что хотите изменить?')){
        e.preventDefault();
    }
});