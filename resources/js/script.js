document.addEventListener("DOMContentLoaded",function (){

    setTimeout(correctLabels,500);
    setTimeout(correctLabels,700);
    setTimeout(correctLabels,1000);
    setTimeout(correctLabels,1300);
    setTimeout(correctLabels,1500);
    setTimeout(correctLabels,1700);
    setTimeout(correctLabels,2000);

    let labels = document.querySelectorAll(".input-box label");

    if(labels !== null)
        console.log(labels.length);
});

function correctLabels(){
    let inputBoxes = document.querySelectorAll(".input-box input");

    if(inputBoxes !== null){
            inputBoxes.forEach(el=>{
                el.focus();
                el.blur();
            });
    }
}
