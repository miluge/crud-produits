//BUTTONS______________________________________________

//details modal trigger
$('#detailsModal').on('show.bs.modal', function (event) {
    //get product id
    const button = $(event.relatedTarget);
    const productId = button.data('id');
    const formData = new FormData();
    formData.append('id_products',productId);
    //fetch('php/details-template.php',{method: 'post', body: formData}).then(res=>res.json()).then(data =>{
        //const content = document.getElementById('details-content');
        //content.innerHTML = data['content'];
    //})
    const editBtn = document.getElementById('edit-btn');
    editBtn.setAttribute('data-id', productId);
})

//edit/create form modal trigger
$('#formModal').on('show.bs.modal', function (event) {
    //check product id
    const button = $(event.relatedTarget);
    const productId = button.data('id');

    if (productId){//edit mode
        const formData = new FormData();
        formData.append('id',productId);
        fetch('php/edit-product.php',{method: 'post', body: formData}).then(res=>res.text()).then(data=>{
            const formModal = document.getElementById('form-modal-content');
            formModal.innerHTML = data;
        });
    }else{//create mode
        fetch('php/edit-product.php').then(res=>res.text()).then(data=>{
            const formModal = document.getElementById('form-modal-content');
            formModal.innerHTML = data;
        });
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