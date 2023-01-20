// var deletebtn = document.querySelector('.delete');
// deletebtn.addEventListener('click', function () {
//     let message = confirm("Are you sure to delete?");
//     if (message) {
//         let id = $(this).parent('td').attr('id');
//         $.ajax({
//             url: 'delete_category.php',
//             type: 'post',
//             data: { id: id },
//             success: function (response) {
//                 console.log(response);
//             },
//             error: function () {

//             }
//         })
//     }
// })

var tbody = document.querySelector('#tbody');
tbody.addEventListener('click', function (e) {
    console.log(e.target);
    let deletebtn = e.target;
    console.log(e.target.innerText)
    if (e.target.innerText == 'Delete') {
        let message = confirm("Are you sure to delete?");
        let tr = deletebtn.parentNode.parentNode;
        if (message) {
            let id = deletebtn.parentNode.getAttribute('id');
            console.log(id);
            $.ajax({
                url: 'delete_category.php',
                type: 'post',
                data: { id: id },
                success: function (response) {
                    if (response == "fail") {
                        console.log(response);
                        alert("You can't delete this data");
                    } else {
                        tbody.removeChild(tr);
                    }
                },
                error: function () {

                }
            })
        }
    }
})