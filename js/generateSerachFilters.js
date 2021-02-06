function renderFilters(filtersInJson) {
  // parse filters from json to normal js array
  // TODO: dodać try kacza :D
  const parsedFilters = JSON.parse(filtersInJson);
  const elementInner = document.getElementById("filters-inner");

  if (!elementInner) {
    return false
  }

  const filtersParts = window.location.search.split("&");
  const filterValues = filtersParts.map(part => Number(part.replace("filters[]=", ""))).filter(value => !isNaN(value));

  // get initial data
  getAndAppendOffers(window.location.search);

  parsedFilters.forEach(singleFilter => createSelect(singleFilter, elementInner, filterValues));
}

function createSelect(singleFilter, elementWhereInsert, selectedValues) {
  const { id, name, types } = singleFilter

  // creating label for input
  const label = document.createElement('label');
  // adding class to label element
  label.setAttribute('for', 'standard-select');
  label.setAttribute('class', 'selectLabel');
  // set label content
  label.innerHTML = name;

  // create select wrapper
  const selectWrapper = document.createElement('div');
  selectWrapper.setAttribute ("class", "select");

  // create select element
  const selectElement = document.createElement('select');
  selectElement.setAttribute('name', id);

  // -- parse select available options to objects
  let selectHasValue = false;

  const typesParsedToObjects = Object.entries(types).map(singleEntry => {
    const typeId = Number(singleEntry[0]);
    const typeLabel = singleEntry[1];
    const isSelected = selectedValues.includes(typeId);

    if (isSelected && !selectHasValue) {
      selectHasValue = true;
    }

    return {
      typeId,
      typeLabel,
      isSelected
    }
  })

  typesParsedToObjects.unshift({
    typeId: "",
    typeLabel: "---",
    isSelected: !selectHasValue
  })


  // create select options and append them to select
  typesParsedToObjects.map(singleParsedType => {
    const selectOption = createSelectOption(
      singleParsedType.typeId,
      singleParsedType.typeLabel,
      singleParsedType.isSelected
    );

    selectElement.appendChild(selectOption)
  })

  selectWrapper.appendChild(selectElement)

  elementWhereInsert.appendChild(label);
  elementWhereInsert.appendChild(selectWrapper)
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
  const loaderElement = document.getElementById("loader");

  loaderElement.classList.remove("hidden");

  const myForm = document.querySelector("form");
  const formData = new FormData(myForm);

  const formValueObject = Object.fromEntries(formData);

  const selectedFilters = Object.values(formValueObject).filter(Boolean);

  const queryString = selectedFilters.map(singleFilter => `filters[]=${singleFilter}`).join('&');
  const currentQueryStringParamsParts = window.location.search.replace('?', '').split("&");
  const typeParts = currentQueryStringParamsParts.filter(singlePart => singlePart.includes("type="));
  const newQueryString = ['?',...typeParts, queryString].filter(Boolean).join("&");
  const newUrl = `${window.location.origin}${window.location.pathname}${newQueryString}`;

  // url change
  window.history.pushState({}, '', newUrl);
  // get data
  getAndAppendOffers(newQueryString)
}

async function getAndAppendOffers(query) {
  const loaderNode = document.getElementById("loader");
  const resultNode = document.getElementById("results");

  // turn on loader and clear result list
  loaderNode.classList.remove("hidden");
  resultNode.innerHTML = '';

  const apiUrl = `/admin/ajax-search.php${query}`;

  try {
    const result = await fetch(apiUrl)
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

    const titleNode = clonedTemplate.getElementsByClassName("card-text")[0];
    titleNode.innerHTML = singleOffer.name;

    const priceNode = clonedTemplate.getElementsByClassName("price")[0];
    priceNode.innerHTML+= ` ${singleOffer.price}`;

    const details = Object.values(singleOffer.types).join(", ").toLowerCase();

    const detailsNode = clonedTemplate.getElementsByClassName("details")[0];
    detailsNode.innerHTML += ` ${details}`;

    appendToNode.appendChild(clonedTemplate);
  })
}