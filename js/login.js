//reset password validation function
function resetPassword() {
    const passwordInput = document.getElementsByName("password")[0];
    passwordInput.classList.remove("is-invalid");
    passwordInput.nextElementSibling.innerHTML = "";
}

//reset form validation function
function resetForm(){
    const submitError = document.getElementById("error");
    const emailInput = document.getElementsByName("email")[0];
    submitError.innerHTML = "";
    emailInput.classList.remove("is-valid");
    emailInput.classList.remove("is-invalid");
    emailInput.nextElementSibling.innerHTML = "";
    resetPassword();
}

//form submission
const form = document.getElementsByTagName("form")[0];
form.addEventListener("submit",(e)=>{
    e.preventDefault();
    const formData = new FormData(form);
    //send form to login.php
    fetch("php/login.php",{method: "post", body: formData}).then(res=>res.json()).then(error=>{
        const submitError = document.getElementById("error");
        const emailInput = document.getElementsByName("email")[0];
        const passwordInput = document.getElementsByName("password")[0];
        resetForm();

        //manage pdo error
        if (error.pdo){
            submitError.innerHTML = error.pdo;
        }

        //manage user error
        if (error.user){
            emailInput.classList.add("is-invalid");
            emailInput.nextElementSibling.innerHTML = error.user;
        }else{
            emailInput.classList.add("is-valid");
        }

        emailInput.addEventListener("input",()=>{
            resetForm();
        });

        //manage password error
        if (error.password){
            passwordInput.classList.add("is-invalid");
            passwordInput.nextElementSibling.innerHTML = error.password;
            passwordInput.addEventListener("input",()=>{
                resetPassword();
            });
        }

        //if login succeed
        if (error.none){
            window.location.replace('./index.php');
        }
    });
})