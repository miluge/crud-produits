//BUTTONS______________________________________________

//details modal trigger
$('#detailsModal').on('show.bs.modal', function (event) {
    //get product id
    const button = $(event.relatedTarget);
    const productId = button.data('id');

    //fetch product details
    //render details template
    //insert in details modal

    //add data-id to edit button
    const editBtn = document.getElementById('edit-btn');
    editBtn.setAttribute('data-id',productId);
})

//edit/create form modal trigger
$('#formModal').on('show.bs.modal', function (event) {
    //check product id
    const button = $(event.relatedTarget);
    const productId = button.data('id')
    if (productId){//edit mode

        //fetch edit-product.php
        //render form template in 'Edit' mode with product details
        //insert response in form modal

    }else{

        //fetch add-product.php
        //render form template in 'Add' mode
        //insert response in form modal

    }
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