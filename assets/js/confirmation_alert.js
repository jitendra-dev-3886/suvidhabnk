 
// function confirmationVisibility(anchor){
//     var conf = confirm("Are You Want To Update Visibility?");
//     if(conf){
//         window.location.attr("href");
//     }
// }

function confirmationDelete(anchor){
      const href = $(this).attr('href')
    Swal.fire({
        title : 'Are You Sure?',
        text : 'Record will be deleted?',
        type: 'waring',
        showCancelButton:true,
        confirmButtonColor: '#3085d6',
        confirmButtonText: 'Delete Record',
    }).then((result) => {
        if(result.value){
            document.location.href = href;
        }
    })
}
// $('.delete_btn').on('click', function(e) {
//     e.prventDefault();
//     const href = $(this).attr('href')
//     Swal.fire({
//         title : 'Are You Sure?',
//         text : 'Record will be deleted?',
//         type: 'waring',
//         showCancelButton:true,
//         confirmButtonColor: '#3085d6',
//         confirmButtonText: 'Delete Record',
//     }).then((result) => {
//         if(result.value){
//             document.location.href = href;
//         }
//     })
// })