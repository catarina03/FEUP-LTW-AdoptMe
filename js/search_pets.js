'use strict'

let text = document.getElementById("name");
console.log(text);
text.addEventListener("keyup", nameChanged);

let locationFilter = document.getElementById('location');
console.log(locationFilter);
locationFilter.addEventListener("change", locationChanged);

let speciesFilter = document.getElementById('species');
console.log(speciesFilter);
speciesFilter.addEventListener("change", speciesChanged);

let breedFilter = document.getElementById('breed');
console.log(breedFilter);
breedFilter.addEventListener("change", breedChanged);

let colorFilter = document.getElementById('color');
console.log(colorFilter);
colorFilter.addEventListener("change", colorChanged);



// Handler for change event on text input
function nameChanged(event) {
    let text = event.target;
    console.log(text);
  
    let request = new XMLHttpRequest();
    request.addEventListener("load", namesReceived);
    request.open("get", "get_names.php?name=" + text.value, true);
    request.send();
  }
  
// Handler for ajax response received
function namesReceived() {
    console.log(this.responseText);
    let names = JSON.parse(this.responseText);
    let list = document.getElementById("search_results");
    list.innerHTML = ""; // Clean current 

    // Add new suggestions
    for (name in names) {
        let item = document.createElement("li");
        item.innerHTML = names[name].name;
        list.appendChild(item);
    }
}


function locationChanged(event){
    let text = event.target;
    console.log(text);
  
    let request = new XMLHttpRequest();
    request.addEventListener("load", locationsReceived);
    request.open("get", "get_locations.php?location=" + text.value, true);
    request.send();
}

function locationsReceived(){
    console.log(this.responseText);
    let locations = JSON.parse(this.responseText);
    let list = document.getElementById("search_results");
    list.innerHTML = ""; // Clean current 

    // Add new suggestions
    for (location in locationss) {
        let item = document.createElement("li");
        item.innerHTML = locations[location].name;
        list.appendChild(item);
    }
}


function speciesChanged(event){
    let text = event.target;
    console.log(text);
  
    let request = new XMLHttpRequest();
    request.addEventListener("load", speciesReceived);
    request.open("get", "get_species.php?species=" + text.value, true);
    request.send();
}

function speciesReceived(){
    console.log(this.responseText);
    let allSpecies = JSON.parse(this.responseText);
    let list = document.getElementById("search_results");
    list.innerHTML = ""; // Clean current 

    // Add new suggestions
    for (species in allSpecies) {
        let item = document.createElement("li");
        item.innerHTML = allSpecies[species].name;
        list.appendChild(item);
    }
}


function breedChanged(event){
    let text = event.target;
    console.log(text);
  
    let request = new XMLHttpRequest();
    request.addEventListener("load", breedReceived);
    request.open("get", "get_breed.php?breed=" + text.value, true);
    request.send();
}

function breedReceived(){
    console.log(this.responseText);
    let breeds = JSON.parse(this.responseText);
    let list = document.getElementById("search_results");
    list.innerHTML = ""; // Clean current 

    // Add new suggestions
    for (breed in breeds) {
        let item = document.createElement("li");
        item.innerHTML = breeds[breed].name;
        list.appendChild(item);
    }
}


function colorChanged(event){
    let text = event.target;
    console.log(text);
  
    let request = new XMLHttpRequest();
    request.addEventListener("load", breedReceived);
    request.open("get", "get_color.php?color=" + text.value, true);
    request.send();
}

function colorReceived(){
    console.log(this.responseText);
    let colors = JSON.parse(this.responseText);
    let list = document.getElementById("search_results");
    list.innerHTML = ""; // Clean current 

    // Add new suggestions
    for (color in colors) {
        let item = document.createElement("li");
        item.innerHTML = colors[color].name;
        list.appendChild(item);
    }
}










/*
let filter_values = {};

function encode_for_ajax(data) {
    return Object.keys(data).map(function(k){
      return encodeURIComponent(k) + '=' + encodeURIComponent(data[k])
    }).join('&');
}

function updateResults() {
    let houses = JSON.parse(this.responseText);
    
    results.innerHTML = '';

    houses.forEach(function (house) {
        console.log(house);
    //    results.innerHTML += printHouse(house);
    });

    //add_card_links();
}

function filter() {
    let inputs = document.querySelectorAll('#search_filters input');
    let request = new XMLHttpRequest();

    inputs.forEach(function (input) {
        let name = input.attributes.name.value;

        console.log(name);
        console.log(input.attributes.name.value);

        filter_values[decodeURIComponent(name)] = decodeURIComponent(input.value);
    });

    console.log(filter_values);
    //request.onload = updateResults;
    request.open('get', '../ajax/filter_houses.php?' + encode_for_ajax(filter_values), true);
    request.send();
}


name_filter.addEventListener('change', function(){
    console.log(name_filter);
    filter();
});


console.log(name_filter);
//console.log(min_output.value);

filter();
*/