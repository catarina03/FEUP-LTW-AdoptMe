'use strict'

let text = document.getElementById("name");
text.addEventListener("keyup", filterPets);

let locationFilter = document.getElementById('location');
locationFilter.addEventListener("change", filterPets);

let speciesFilter = document.getElementById('species');
speciesFilter.addEventListener("change", filterPets);

let breedFilter = document.getElementById('breed');
breedFilter.addEventListener("change", filterPets);

let colorFilter = document.getElementById('color');
colorFilter.addEventListener("change", filterPets);

let statusFilter = document.getElementById('status');
statusFilter.addEventListener("change", filterPets);

let results = document.getElementById('search_results');

let filter_values = {};


function writePet(pet){
    let content = 
    '<article class="pet_card">' + 
        '<section>' +
            '<a href="petprofile.php?id=' + pet['id'] +'">' +
                pet['name'] +
            '</a>' +
            '<section class="info">' +
                '<img src="../images/pets/original/' + pet['id'] + '.jpg" alt="pet image" width="150" height="150">' + 
                '<ul>' +
                    '<li>Location: ' + pet['location'] + '</li>' +
                    '<li>Species: ' + pet['species'] + '</li>' +
                    '<li>Breed: ' + pet['breed'] + '</li>' +
                '</ul>' +
            '</section>' +
        '</section>' +
    '</article>';

    return content;
}


function updateResults() {
    console.log("Responde text: " + this.responseText);
    let pets = JSON.parse(this.responseText);
    
    results.innerHTML = '';

    pets.forEach(function (pet) {
        results.innerHTML += writePet(pet);
    });

    //add_card_links();
}


function encode_for_ajax(data) {
    return Object.keys(data).map(function(k){
      return k + '=' + data[k]
    }).join('&');
}

function filterPets() {
    let inputs = document.querySelectorAll('#search_form input');
    let selects = document.querySelectorAll('#search_form select');
    let request = new XMLHttpRequest();

    inputs.forEach(function (input) {
        let name = input.attributes.name.value;
        filter_values[name] = input.value;
    });

    selects.forEach(function (select) {
        let name = select.attributes.name.value;
        filter_values[name] = select.value;
    });

    console.log(filter_values);

    request.onload = updateResults;
    //request.open('get', 'ajax/filter_pets.php?' + encode_for_ajax(filter_values), true);
    request.open('get', '../ajax/filter_pets.php?' + encode_for_ajax(filter_values), true);
    request.send();

}




