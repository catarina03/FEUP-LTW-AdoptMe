'use strict'

let results = document.getElementById('search_results');
let name_filter = document.querySelector('#search_filters input[name="name"]');
let min_output = document.getElementById('location');

let text = document.getElementById("name");
console.log(text);
text.addEventListener("keyup", nameChanged);

let locationFilter = document.getElementById('location');
//let locationFilter = document.querySelectorAll('#location *');
console.log(locationFilter);
//locationFilter.option[locationFilter.selectedIndex].addEventListener("click", locationChanged);
locationFilter.addEventListener("change", locationChanged);

//let locationFilter = document.querySelector('#search_filters select[name="location"]');
//locationFilter.addEventListener("keyup", locationChanged);

//let check_out_filter = document.querySelector('#search_filters input[name="check_out"]');
//let min_output = document.getElementById('min_output');
//let max_output = document.getElementById('max_output');
//let min_price = document.querySelector('#filters input[name="min_price"]');
//let max_price = document.querySelector('#filters input[name="max_price"]');

//let get_url = window.location.search.substr(1);
//let get_url_parsed = get_url.split('&');
//let get_params = {};
//let filter_values = {};
//let expected_requests = 0, current_requests = 0;
//let last_request;

//name_filter.addEventListener('change', () => name_filter.type = 'search');

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