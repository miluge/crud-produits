//BUTTONS______________________________________________

//details modal trigger
$('#detailsModal').on('show.bs.modal', function (event) {
    const button = $(event.relatedTarget);
    const productId = button.data('id');
    // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
    const editBtn = document.getElementById('edit-btn');
    editBtn.setAttribute('data-id',productId);
})