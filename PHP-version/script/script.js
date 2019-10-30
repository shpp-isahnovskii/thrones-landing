/***** Form 1 *****/
function registrationPart1() {

  //add listener on blur
  const field = document.getElementById('regPass');
  field.addEventListener('blur', () => { //first on blur

    checkPass(field.value);

    field.addEventListener('input', () => { checkPass(field.value) }); //rest valid checks only on some changes 

  }, { once: true }); //once mean what first listener will be used only once;


  // Submit button validation checker
  let form = document.querySelector('.regForm');
  form.addEventListener('submit', (event) => {
    let pass = form.querySelector('#regPass').value;
    if (!checkPass(pass)) {
      event.preventDefault();
    }
  });

  /**
   * main Password validation checker
   */
  function checkPass(password) {
    let result = true;
    let validation = [/([a-z]+)/, /[A-Z]+/, /\d+/, /[!@#\$%\^&\*]+/, /(?=.{8,})/]; //all regExp list
    let propositions = ['one little character', 'one big character', 'one number', 'one specific symbol: !@#$%^&*', '8 characters']; //list of tips for each validation case

    const alertText = document.getElementById('alertPass'); //our text field for changing
    alertText.innerHTML = '';

    for (let i = 0; i < validation.length; i++) {
      if (!validation[i].test(password)) {
        alertText.innerHTML += 'must be atleast ' + propositions[i];
        result = false;
        break; //get tips one-by-one until all validations will be checked
      }
    }
    return result;
  }
}

/***** Form 2 *****/
function registrationPart2() {

  const GOTHouses = [
    {
      house: 'greyjoy',
      img: './source/images/houses/1_01.gif'
    },
    {
      house: 'lannister',
      img: './source/images/houses/1_02.gif'
    },
    {
      house: 'baratheon',
      img: './source/images/houses/1_03.gif'
    },
    {
      house: 'stark',
      img: './source/images/houses/1_04.gif'
    },
    {
      house: 'targaryen',
      img: './source/images/houses/1_05.gif'
    }
  ];

  buildGOTDropdown(GOTHouses);
  $('.left-section-form2').append("<div class='owl-carousel'></div>");
  addCarousel();
  onChangeTriggers();

  //------------- init carousel ---------------
  function addCarousel() {
    addElements(GOTHouses);
    $('.owl-carousel').owlCarousel({
      startPosition: 0,
      loop: false,
      items:1
    });
  }
  //add images
  function addElements(array) {
    for(let element of array) {
      $('.owl-carousel').append(`<div><img src='${element.img}' alt='${element.house}'></div>`);
    }
  }
  //------------- end on carousel init --------

  /**
   * Add dropdown menu to the select element from 2nd regestration form
   * @param {array} houses array of houses with two fields: house, img.
   */
  function buildGOTDropdown(houses) {
    let house = $('#house');
    for(let [index,element] of houses.entries()) {
      const upper = element.house.replace(/^\w/, c => c.toUpperCase()); // https://joshtronic.com/2016/02/14/how-to-capitalize-the-first-letter-in-a-string-in-javascript/
      house.append(`<option value='${index}'>${upper}</option>`);
    }
  }
  
  function onChangeTriggers() {
    const dropdown = $('#house');
    const carousel = $('.owl-carousel');

    //if carousel are dragging left/right - change dropdown menu
    carousel.on('changed.owl.carousel', function(event) {
      let currentItem = event.item.index;
      dropdown.val(currentItem);
    });

  //if dropdown changed - change carousel
  dropdown.on('change', function(e) {carousel.trigger("to.owl.carousel", getSelectedElement())} )
  }

  function getSelectedElement() {
    const el = document.getElementById('house');
    return el[el.selectedIndex].value;
  }
}
