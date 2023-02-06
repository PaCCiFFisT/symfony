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

// function sendUpdatedUser(e) {
//     e.preventDefault();
//     let formData = new FormData(updateForm);
//     let data = {};
//     for (let [dataKey, value] of formData.entries()) {
//          let key = dataKey.substring(dataKey.indexOf("[")+1,dataKey.indexOf("]"));
//          data[key]=value;
//     }
//     let method = 'POST';
//     let xhr = new XMLHttpRequest();
//     xhr.open("POST",'/user/update');
//     xhr.setRequestHeader( 'Content-Type', 'application/json');
//     xhr.onreadystatechange=()=>{
//         if (xhr.readyState === 4 && xhr.status === 200){
//             console.log(JSON.parse(xhr.response));
//         }
//     }
//     delete data['_token'];
//     data = JSON.stringify(data);
//     console.log(data);
//
//     xhr.send(data);
//     // xhr.send();
//
// }
// async function sendUpdatedUser(e) {
//     e.preventDefault();
//     let formData = new FormData(updateForm);
//     let data = {};
//     for (let [dataKey, value] of formData.entries()) {
//         let key = dataKey.substring(dataKey.indexOf("[") + 1, dataKey.indexOf("]"));
//         data[key] = value;
//     }
//     const response = await fetch('',{
//         method: 'PATCH',
//         mode: "cors",
//         headers: {
//             'Content-Type': 'application/json'
//         },
//         referrerPolicy: 'no-referrer',
//         body: JSON.stringify(data)
//     })
//     console.log(response.json());
//     return response.json();
// }
// updateForm.addEventListener('submit', sendUpdatedUser)
