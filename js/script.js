//MODALS______________________________________________

//details modal trigger
$('#detailsModal').on('show.bs.modal', function (event) {
    //get product id
    const button = $(event.relatedTarget);
    const productId = button.data('id');
    //fetch details render
    const postData = new FormData();
    postData.append('id',productId);
    postData.append('mode','details');
    fetch('php/view.php',{method: 'post', body: postData}).then(res=>res.text()).then(data =>{
        const detailsModal = document.getElementById('details-modal-content');
        detailsModal.innerHTML = data;
    })
})

//form modal trigger
$('#formModal').on('show.bs.modal', function (event) {
    //check product id
    const button = $(event.relatedTarget);
    const productId = button.data('id');
    const postData = new FormData();
    postData.append('id', productId);
    let mode;
    let url;
    if (productId){//edit mode
        mode = 'Edit';
        url = 'php/edit-product.php';
    }else{//add mode
        mode = 'Add';
        url = 'php/create-product.php';
    }

    //fill modal
    postData.append('mode',mode);
    fetch('php/view.php',{method: 'post', body: postData}).then(res=>res.text()).then(data=>{
        const formModal = document.getElementById('form-modal-content');
        formModal.innerHTML = data;
        //add submit button event
        const submit = document.getElementById("form-submit");
        submit.addEventListener('click',(e)=>{
            const form = document.querySelector('form');
            const formData = new FormData(form);
            fetch(url,{method: 'post', body: formData})
            .then(()=>location.reload());
        });
    });
})

//delete modal trigger
$('#deleteModal').on('show.bs.modal', function (event) {
    //get product id
    const button = $(event.relatedTarget);
    const productId = button.data('id');
    //fill delete render
    const postData = new FormData();
    postData.append('mode','delete');
    postData.append('id',productId);
    fetch('php/view.php',{method: 'post', body: postData}).then(res=>res.text()).then(data=>{
        const deleteModal = document.getElementById('delete-modal-content');
        deleteModal.innerHTML = data;
        //add delete button event
        const deleteBtn = document.getElementById("delete-btn");
        deleteBtn.addEventListener('click',(e)=>{
            const formData = new FormData();
            formData.append('id', productId);
            fetch('php/delete-product.php',{method: 'post', body: formData})
            .then(()=>location.reload());
        });
    });
})