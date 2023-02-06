/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.css in this case)
import './styles/app.css';

// start the Stimulus application
import './bootstrap';

const updateUserOption = document.getElementById('update_user_id');

function getUserForChange(e){
    e.preventDefault();

    let xhr = new XMLHttpRequest();

    let id = updateUserOption.options[updateUserOption.selectedIndex].innerText;

    xhr.open("GET", '?id='+id);

    xhr.onreadystatechange = () => {
        if (xhr.status === 200 && xhr.readyState === 4) {
            let data = JSON.parse(xhr.response)[0];

            document.getElementById('update_user_name').setAttribute('value',data.name);
            document.getElementById('update_user_email').setAttribute('value',data.email);
            document.getElementById('update_user_password').setAttribute('type','text');
            document.getElementById('update_user_password').setAttribute('value',data.password);

        }
    }
    xhr.send();
}
updateUserOption.addEventListener('change',getUserForChange);

const updateForm = document.forms.namedItem('update_user');

function sentUpdatedUser(e) {
    e.preventDefault();
    let formData = new FormData(updateForm);
    let data = {};
    for (let [dataKey, value] of formData.entries()) {
        console.log(key, value)
         let key = dataKey.substring(dataKey.indexOf("[")+1,dataKey.indexOf("]"));
        console.log(key, value)

        data[key]=value;


    }
    let method = 'PATCH';
    let xhr = new XMLHttpRequest();
    console.log(method);
    xhr.open(method,'');
    // xhr.setRequestHeader()
    xhr.onreadystatechange=()=>{
        if (xhr.readyState === 4 && xhr.status === 200){
            console.log(JSON.parse(xhr.response));
        }
    }
    xhr.send(JSON.stringify(data));

}

updateForm.addEventListener('submit', sentUpdatedUser)
