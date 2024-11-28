document.addEventListener("DOMContentLoaded",function (){
    let passwordGenerate= document.getElementById("passwordGenerate");

    if(passwordGenerate)
        setPasswordGenerate(passwordGenerate);
});

function setPasswordGenerate(el){

    let password = document.getElementById("newPassword")
    let confirm = document.getElementById("newPassConfirm")


    el.addEventListener("change",()=>{
        if(el.checked){
            password.removeAttribute("required")
            confirm.removeAttribute("required")
            password.setAttribute("disabled","")
            confirm.setAttribute("disabled","")
        }
        else{
            password.removeAttribute("disabled")
            confirm.removeAttribute("disabled")
            password.setAttribute("required","")
            confirm.setAttribute("required","")
        }
    });
}
