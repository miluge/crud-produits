//BUTTONS______________________________________________

//details modal trigger
$('#detailsModal').on('show.bs.modal', function (event) {
    //get product id
    const button = $(event.relatedTarget);
    const productId = button.data('id');
    //fetch details render
    const formData = new FormData();
    formData.append('id',productId);
    formData.append('mode','details');
    fetch('php/view.php',{method: 'post', body: formData}).then(res=>res.text()).then(data =>{
        const detailsModal = document.getElementById('details-modal-content');
        detailsModal.innerHTML = data;
    })
})

//edit/create form modal trigger
$('#formModal').on('show.bs.modal', function (event) {
    //check product id
    const button = $(event.relatedTarget);
    const productId = button.data('id');
    const formData = new FormData();
    formData.append('id',productId);

    if (productId){//fetch form render in edit mode
        formData.append('mode','Edit');
        fetch('php/view.php',{method: 'post', body: formData}).then(res=>res.text()).then(data=>{
            const formModal = document.getElementById('form-modal-content');
            formModal.innerHTML = data;
        });
    }else{//fetch form render in add mode
        formData.append('mode','Add');
        fetch('php/view.php',{method: 'post', body: formData}).then(res=>res.text()).then(data=>{
            const formModal = document.getElementById('form-modal-content');
            formModal.innerHTML = data;
        });
    }
})

//delete modal trigger
$('#deleteModal').on('show.bs.modal', function (event) {
    //get product id
    const button = $(event.relatedTarget);
    const productId = button.data('id');
    //fetch delete render
    const formData = new FormData();
    formData.append('id',productId);
    formData.append('mode','delete');
    fetch('php/view.php',{method: 'post', body: formData}).then(res=>res.text()).then(data=>{
        const deleteModal = document.getElementById('delete-modal-content');
        deleteModal.innerHTML = data;
    });
})