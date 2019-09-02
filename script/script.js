
function addListeners(id) {
    const field = document.getElementById(id);
    field.addEventListener('blur', () => { //first on blur

        //checkPass(field.value);

        field.addEventListener('input', () => { /*checkPass(field.value)*/ }); //rest valid checks only on some changes 

    }, {once: true}); //once mean what first listener will be used only once;
    }

// Submit button validation checker
let form = document.querySelector('.regForm');
form.addEventListener('submit', (event) => {
    event.preventDefault();

    let pass = form.querySelector('#regPass');
    if(checkPass(pass.value)) {
        gotToNextForm();
    }
});

// /**
//  * main Password validation checker
//  */
function checkPass(password) {
    let result = true;
    let validation = [/([a-z]+)/, /[A-Z]+/, /[0-9]+/, /[!@#\$%\^&\*]+/, /(?=.{8,})/]; //all regExp list
    let propositions = ['one little character', 'one big character', 'one number', 'one specific symbol: !@#$%^&*', '8 characters']; //list of tips for each validation case
    
    const alertText = document.getElementById('alertPass'); //our text field for changing
    alertText.innerHTML = '';
    
    for(let i = 0; i < validation.length; i++) {
        if(!validation[i].test(password)) {
            alertText.innerHTML += 'must be atleast ' + propositions[i];
            result = false;
            break; //get tips one-by-one until all validations will be checked
        }
    }
    return result;
}

function gotToNextForm() {
    switchDisplays();
}

function switchDisplays() {
    document.getElementById('formOne').style.display = 'none';
    document.getElementById('formTwo').style.display = 'block';
}