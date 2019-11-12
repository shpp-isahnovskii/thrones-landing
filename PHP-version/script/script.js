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
   * @param houses array of houses with two fields: house, img.
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
