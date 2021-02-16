function renderFilters(filtersInJson) {
  // parse filters from json to normal js array
  // TODO: dodać try kacza :D
  const parsedFilters = JSON.parse(filtersInJson);
  const elementInner = document.getElementById("filters-inner");

  // if element doesnt exist end script
  if (!elementInner) {
    return false
  }

  const filtersParts = window.location.search.split("&");
  const filterValues = filtersParts.map(part => Number(part.replace("filters[]=", ""))).filter(value => !isNaN(value));

  // get initial data from backend
  getAndAppendOffers(window.location.search);

  parsedFilters.forEach(singleFilter => createSelect(singleFilter, elementInner, filterValues));
}

function createSelect(singleFilter, elementWhereInsert, selectedValues) {
  // get id , name and filter options from filtr object
  const { id, name, types } = singleFilter

  // creating label for input
  const label = document.createElement('label');
  // adding class to label element
  label.setAttribute('for', 'standard-select');
  label.setAttribute('class', 'selectLabel');
  // set label content
  label.innerHTML = name;

  // add label to filters-inner form
  elementWhereInsert.appendChild(label);

  // create select element and store it in variable
  const selectElement = document.createElement('select');
  selectElement.setAttribute('name', id);

  // parse select available options to objects to have better acces to add them to dom tree

  // this value shows us if any options from this select is selected
  // it will help us mark "---" as selected if select doesnt has value
  let selectHasValue = false;

  // itterate over elements and preapare neccessary data to create select available options
  const typesParsedToObjects = Object.entries(types).map(singleEntry => {
    // get option id
    const typeId = Number(singleEntry[0]);
    // get option label
    const typeLabel = singleEntry[1];

    // check if option id is selected
    const isSelected = selectedValues.includes(typeId);

    // if value is selected then mark selectHasValue as true, it will tell us if we should mark "---" option as selected
    if (isSelected && !selectHasValue) {
      selectHasValue = true;
    }

    // return preapared data
    return {
      typeId,
      typeLabel,
      isSelected
    }
  })

  // add "---" element as first to the options list
  typesParsedToObjects.unshift({
    typeId: "",
    typeLabel: "---",
    isSelected: !selectHasValue
  })

  // itterate over list of options and create select option and append them to select
  typesParsedToObjects.map(singleParsedType => {
    const selectOption = createSelectOption(
      singleParsedType.typeId,
      singleParsedType.typeLabel,
      singleParsedType.isSelected
    );

    selectElement.appendChild(selectOption);
  })

  // create select wrapper
  const selectWrapper = document.createElement('div');
  selectWrapper.setAttribute ("class", "select");

  // add select as child to wrapper
  selectWrapper.appendChild(selectElement);

  // add select wrapper with select as child to form
  elementWhereInsert.appendChild(selectWrapper);
}

function createSelectOption(optionId, optionLabel, isSelected) {
  const optionElement = document.createElement('option');
  optionElement.setAttribute("value", optionId);
  optionElement.innerHTML = optionLabel;

  if (isSelected) {
    optionElement.setAttribute("selected", true);
  }

  return optionElement
}

async function submitFilter() {
  // get loader element it will hel us manipulate him
  const loaderElement = document.getElementById("loader");
  // display loader
  loaderElement.classList.remove("hidden");

  // get form from dom tree
  const myForm = document.querySelector("form");
  // parse form to formData object * formdata is js data object wchich represents current seleted values
  const formData = new FormData(myForm); // object with selected values stored in format key: value

  // get only values from formdata object and store them in array
  const formValueObject = Object.fromEntries(formData);
  const selectedFilters = Object.values(formValueObject).filter(Boolean);

  // create filter string from selected filters
  // itterate over each selected id and add filters[]= as prefix to create string like that: filters[]=id
  // after that join table to string usign "&" char
  const filterString = selectedFilters.map(singleFilter => `filters[]=${singleFilter}`).join('&');

  // get query string from the current url from browser and split it to the parts by &
  const currentQueryStringParamsParts = window.location.search.replace('?', '').split("&");

  // from query string parts get part wchich tell us wchich type is selected eg: room, apartment etc. tdi
  const typeParts = currentQueryStringParamsParts.filter(singlePart => singlePart.includes("type="));

  // create new querystring based on previous selected type and current selected filters
  // typeParts -> current selected type from browser url
  // filterString -> string wchich is created from current selected filters
  const newQueryString = ['?', ...typeParts, filterString].filter(Boolean).join("&");

  // create new url string. Get current origin and path from current browsr url and add new created query string
  const newUrl = `${window.location.origin}${window.location.pathname}${newQueryString}`;

  // uchange browser url without reloading
  window.history.pushState({}, '', newUrl);
  // get data from api
  getAndAppendOffers(newQueryString)
}

async function getAndAppendOffers(queryString) {
  const loaderNode = document.getElementById("loader");
  const resultNode = document.getElementById("results");

  // turn on loader and clear result list
  loaderNode.classList.remove("hidden");
  resultNode.innerHTML = '';

  const apiUrl = `/admin/ajax-search.php${queryString}`;

  try {
    // await - wait for server response
    const result = await fetch(apiUrl);
    // wait for js to parse respons to json
    const offerList = await result.json();

    addOffers(offerList, resultNode)
  } catch (e) {
    console.log(e)
  }

  loaderNode.classList.add("hidden");
}

function addOffers(offerArray, appendToNode) {
  if (!offerArray.length) {
    appendToNode.innerHTML ='Brak danych';

    return false;
  }

  const template = document.getElementById('offer-card-template');

  offerArray.forEach(singleOffer => {
    const clonedTemplate = template.cloneNode(true)
    clonedTemplate.classList.remove("hidden")

    // get title node and insert room name
    const titleNode = clonedTemplate.getElementsByClassName("card-text")[0];
    titleNode.innerHTML = singleOffer.name;

    const priceNode = clonedTemplate.getElementsByClassName("price")[0];
    priceNode.innerHTML+= ` ${singleOffer.price}zł`;

    // preapare details string wchich contains room details
    const details = Object.values(singleOffer.types).join(", ").toLowerCase();

    // get details node and add details string
    const detailsNode = clonedTemplate.getElementsByClassName("details")[0];
    detailsNode.innerHTML += ` ${details}`;

    appendToNode.appendChild(clonedTemplate);
  })
}