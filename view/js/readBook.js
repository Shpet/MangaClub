window.onload = () => {
    toms.value = 'Tom1';
    toms.dispatchEvent(new Event('change'));
    chapters.value = '1';
    chapters.dispatchEvent(new Event('change'));
};
const buttBack = document.getElementsByClassName('backPage'),
    toms = document.getElementById('selectToms'),
    chapters = document.getElementById('selectChapters'),
    content = document.getElementById('content');


buttBack[0].addEventListener('click', backPage);

toms.addEventListener('change', () => {
    chapters.value = '1';
    chapters.dispatchEvent(new Event('change'));
    getChapters(toms.value)
});

chapters.addEventListener('change', () => {
   getContent(chapters.value);
});



function backPage() {
    history.back();
    return false;
}
function getContent(numChapters){
    $.ajax({
        url: 'img_content',
        type: 'get',
        data: {
            chapter: numChapters,
            tom: toms.value
        },
        success: function(res){
                content.innerHTML = `${res}`;

        },
        error: function () {
            console.log('error');
        }
    })
}
function getChapters(numToms) {
    $.ajax({
        url: 'chapter',
        type: 'get',
        data: numToms,
        success: function(countOfChapters) {
            chapters.innerHTML = '';
            for(let i = 0; i < countOfChapters; i++){
                chapters.innerHTML += `<option value=${i+1}>Глава ${i+1}</option>`;
            }
         },
        error: function () {
            alert('Произошла ошибка!');
        }
    });
}


