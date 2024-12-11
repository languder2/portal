document.addEventListener("DOMContentLoaded",function (){
    let list = document.querySelectorAll("select[data-dependents]");

    if(list === null) return false;

    list.forEach(el=>{
        let ids= JSON.parse(el.getAttribute('data-dependents'));

        if(ids === null) return false;

        ids.forEach(id=>{
            let select = document.getElementById(id);

            if(select === null) return false;

            select.addEventListener('change',(e)=>{
                changeAffectedSelect(id);
            });
        })

    });
});

function changeAffectedSelect(id){
    let selectList = document.querySelectorAll('select:has(option[data-'+id+'])');

    selectList.forEach(select=>{
        let ids= JSON.parse(select.getAttribute('data-dependents'));

        if(ids === null) return false;

        let where = '';

        ids.forEach(id=>{
            if(document.getElementById(id).value !== '')
                where += '[data-'+id+'="'+document.getElementById(id).value+'"]';
            else
                return false;
        });

        let options = null;

        if(where !== '') {
            options = select.querySelectorAll('option:not(' + where + ')');

            options.forEach(option => {
                if (option.value === '') return;
                option.setAttribute('disabled', 'disabled');
                option.classList.add('hidden');
            });
        }

        options = select.querySelectorAll('option'+where);

        options.forEach(option=>{
            option.removeAttribute('disabled');
            option.classList.remove('hidden');
        });

        select.value = '';

        select.classList
        return  false;
    })
    return false;
}
