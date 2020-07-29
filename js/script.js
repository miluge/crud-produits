//BUTTONS______________________________________________

//details modal trigger
$('#detailsModal').on('show.bs.modal', function (event) {
    //get product id
    const button = $(event.relatedTarget);
    const productId = button.data('id');
    // fetch product details

    //add data-id to edit button
    const editBtn = document.getElementById('edit-btn');
    editBtn.setAttribute('data-id',productId);
})

//delete modal trigger
$('#deleteModal').on('show.bs.modal', function (event) {
    //get product name and id
    const button = $(event.relatedTarget);
    const productId = button.data('id');
    const productName = button.data('name');
    //add product name
    const name = document.getElementById('delete-name');
    name.innerText = productName;
    //add data-id to delete button
    const deleteBtn = document.getElementById('delete-btn');
    deleteBtn.setAttribute('data-id',productId);
})