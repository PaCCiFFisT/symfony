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

updateUserOption.onchange = (e) => {
    e.preventDefault();

    let xhr = new XMLHttpRequest();

    let id = updateUserOption.options[updateUserOption.selectedIndex].innerText;


    xhr.onreadystatechange = () => {
        if (xhr.status === 200 && xhr.readyState === 4) {
            console.log(123123)
            console.log(JSON.parse(xhr.response))
        }
    }
    xhr.open("GET", 'update');
    xhr.send('id='+id);

}

