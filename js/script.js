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

//reset form validation global notification
function resetGlobal(){
    const formError = document.getElementById("formError");
    formError.innerHTML = "";
}

//take input name argument and reset validation notifications
function resetInput(input){
    const inputElt = document.getElementById(`${input}Input`);
    inputElt.classList.remove("is-valid");
    inputElt.classList.remove("is-invalid");
    inputElt.nextElementSibling.innerHTML = "";
    //reset notifications on input
    inputElt.addEventListener("input",()=>{
        resetInput(input);
        resetGlobal();
    });
}

//take select name argument and reset validation notifications
function resetSelect(select){
    const selectElt = document.getElementById(`${select}Select`);
    selectElt.classList.remove("is-valid");
    selectElt.classList.remove("is-invalid");
    selectElt.nextElementSibling.innerHTML = "";
    //reset notificationon change
    selectElt.addEventListener("change",()=>{
        resetSelect(select);
        resetGlobal();
    });
}

//reset all
function resetForm(){
    resetGlobal();
    resetInput("name");
    resetInput("reference_number");
    resetInput("buy_date");
    resetInput("price");
    resetInput("source");
    resetInput("end_warranty");
    resetInput("care_products");
    resetSelect("category");
    resetSelect("type");
}

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
            const id = e.target.getAttribute('data-id');
            const form = document.querySelector('form');
            const formData = new FormData(form);
            formData.append('id',id);
            fetch(url,{method: 'post', body: formData}).then(res=>res.json()).then(errors=>{
                resetForm();

                if (!errors.global){//if no errors, reload page
                    window.location.reload();
                }else{
                    //manage global notification
                    const formError = document.getElementById("formError");
                    formError.innerHTML = errors.global;

                    //manage name error notification
                    const nameInput = document.getElementById("nameInput");
                    if (errors.name){
                        nameInput.classList.add("is-invalid");
                        nameInput.nextElementSibling.innerHTML = errors.name;
                    } else {
                        nameInput.classList.add("is-valid");
                    }

                    //manage reference_number error notification
                    const reference_numberInput = document.getElementById("reference_numberInput");
                    if (errors.reference_number){
                        reference_numberInput.classList.add("is-invalid");
                        reference_numberInput.nextElementSibling.innerHTML = errors.reference_number;
                    } else {
                        reference_numberInput.classList.add("is-valid");
                    }

                    //manage buy_date error notification
                    const buy_dateInput = document.getElementById("buy_dateInput");
                    if (errors.buy_date){
                        buy_dateInput.classList.add("is-invalid");
                        buy_dateInput.nextElementSibling.innerHTML = errors.buy_date;
                    } else {
                        buy_dateInput.classList.add("is-valid");
                    }

                    //manage price error notification
                    const priceInput = document.getElementById("priceInput");
                    if (errors.price){
                        priceInput.classList.add("is-invalid");
                        priceInput.nextElementSibling.innerHTML = errors.price;
                    } else {
                        priceInput.classList.add("is-valid");
                    }

                    //manage source error notification
                    const sourceInput = document.getElementById("sourceInput");
                    if (errors.source){
                        sourceInput.classList.add("is-invalid");
                        sourceInput.nextElementSibling.innerHTML = errors.source;
                    } else {
                        sourceInput.classList.add("is-valid");
                    }

                    //manage end_warranty error notification
                    const end_warrantyInput = document.getElementById("end_warrantyInput");
                    if (errors.end_warranty){
                        end_warrantyInput.classList.add("is-invalid");
                        end_warrantyInput.nextElementSibling.innerHTML = errors.end_warranty;
                    } else {
                        end_warrantyInput.classList.add("is-valid");
                    }

                    //manage care_products error notification
                    const care_productsInput = document.getElementById("care_productsInput");
                    if (errors.care_products){
                        care_productsInput.classList.add("is-invalid");
                        care_productsInput.nextElementSibling.innerHTML = errors.care_products;
                    } else {
                        care_productsInput.classList.add("is-valid");
                    }

                    //manage category error notification
                    const categorySelect = document.getElementById("categorySelect");
                    if (errors.category_id){
                        categorySelect.classList.add("is-invalid");
                        categorySelect.nextElementSibling.innerHTML = errors.category_id;
                    } else {
                        categorySelect.classList.add("is-valid");
                    }

                    //manage type error notification
                    const typeSelect = document.getElementById("typeSelect");
                    if (errors.id_type){
                        typeSelect.classList.add("is-invalid");
                        typeSelect.nextElementSibling.innerHTML = errors.id_type;
                    } else {
                        typeSelect.classList.add("is-valid");
                    }
                }
            });
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