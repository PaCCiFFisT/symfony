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
const updateForm = document.forms.namedItem('update_user');

/**
 * Sends AJAX-request and gets user data depends on chosen user id
 * @param e
 */
function getUserForChange(e) {

    e.preventDefault();
    let id = updateUserOption.options[updateUserOption.selectedIndex].innerText;
    updateForm.reset();
    updateUserOption.options[updateUserOption.selectedIndex].innerText = id;
    updateUserOption.options[updateUserOption.selectedIndex].setAttribute('value', id);
    let xhr = new XMLHttpRequest();

    xhr.open("GET", '?id=' + id);

    xhr.onreadystatechange = () => {
        if (xhr.status === 200 && xhr.readyState === 4) {

            let data = JSON.parse(xhr.response)[0];

            document.getElementById('update_user_name').setAttribute('value', data.name);
            document.getElementById('update_user_email').setAttribute('value', data.email);
            document.getElementById('update_user_password').setAttribute('type', 'text');
            document.getElementById('update_user_password').setAttribute('value', data.password);

        }
    }

    xhr.send();
}

updateUserOption.addEventListener('change', getUserForChange);
