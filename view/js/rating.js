let like = document.querySelectorAll('.like');
let dislike = document.querySelectorAll('.dislike');

like.forEach((e) => {
    e.addEventListener('click', () => {
        IncrementLikes(event);
    });
});
dislike.forEach((e) => {
    e.addEventListener('click', () => {
        IncrementDislikes(event);
    });
});


function IncrementLikes(event) {


    let id_book = event.currentTarget.getAttribute('data-book-id');

    $.ajax({
        url: 'incrementLike',
        type: 'get',
        data: {
            id: id_book
        },
        success: function (res) {
            if (res) {
                let countL = document.querySelector(`.like[data-book-id="${id_book}"]+span`);
                let countD = document.querySelector(`.dislike[data-book-id="${id_book}"]+span`);
                let rating = res.split(' ');

                countL.innerText = rating[0];
                countD.innerText = rating[1];

            }
            else {
                alert("Авторизуйтесь, что бы оценивать");
            }

        },
        error: function () {
            alert('error');
        }
    });

    event.preventDefault();

}

function IncrementDislikes(event) {


    let id_book = event.currentTarget.getAttribute('data-book-id');

    $.ajax({
        url: 'incrementDislike',
        type: 'get',
        data: {
            id: id_book
        },
        success: function (res) {
            if (res) {
                let countD = document.querySelector(`.dislike[data-book-id="${id_book}"]+span`);
                let countL = document.querySelector(`.like[data-book-id="${id_book}"]+span`);
                let rating = res.split(' ');

                countD.innerText = rating[0];
                countL.innerText = rating[1];
            }
            else {
                alert("Авторизуйтесь, что бы оценивать");
            }

        },
        error: function () {
            alert('error');
        }
    });

    event.preventDefault();

}