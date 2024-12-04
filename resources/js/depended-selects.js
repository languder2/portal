document.addEventListener("DOMContentLoaded",function (){
    let list = document.querySelectorAll("select[data-depended]");

    if(list === null) return false;

    list.forEach(el=>{
        let ids= JSON.parse(el.getAttribute('data-depended'));

        ids.forEach(id=>{
            let select = document.getElementById(id);

            if(select === null) return false;

            select.addEventListener('change',(e)=>{
                let value = e.target.value;
                let options = el.querySelectorAll('option[data-'+id+']');

                options.forEach(option=>{
                    option.setAttribute('disabled','disabled');
                    option.classList.add('hidden');
                });

                options = el.querySelectorAll('option[data-'+id+'="'+value+'"]');

                options.forEach(option=>{
                    option.removeAttribute('disabled');
                    option.classList.remove('hidden');
                });

                el.value = null;
            });
        })

    });
});

