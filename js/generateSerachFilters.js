function renderFilters(filtersInJson) {
  // parse filters from json to normal js array
  // TODO: dodać try kacza :D
  const parsedFilters = JSON.parse(filtersInJson);

  const elementInner = document.getElementById("filters-inner");

  if (!elementInner) {
    return false
  }

  parsedFilters.forEach(singleFilter => createSelect(singleFilter, elementInner))
}

function createSelect(singleFilter, elementWhereInsert) {
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
  selectElement.setAttribute('value', Object.keys(types)[0]);

  // create select options and append them to select
  Object.entries(types).map(entryType => {
    const selectOption = createSelectOption(entryType[0], entryType[1]);
    selectElement.appendChild(selectOption)
  })

  selectWrapper.appendChild(selectElement)

  elementWhereInsert.appendChild(label);
  elementWhereInsert.appendChild(selectWrapper)
}

function createSelectOption(optionId, optionLabel) {
  const optionElement = document.createElement('option');
  optionElement.setAttribute("value", optionId);
  optionElement.innerHTML = optionLabel;

  return optionElement
}

function submitFilter() {
  let myForm = document.getElementById('filters-inner');
  console.log(myForm)

  const formData = new FormData(myForm);
  console.log(formData)

}