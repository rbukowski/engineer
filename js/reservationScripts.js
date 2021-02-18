function checkTerm() {
  // get form from dom tree
  const myForm = document.getElementById("term-form");
  const invalidElement = document.getElementById("invalid");
  const priceResultElement = document.getElementById("price-result");

  // parse form to formData object * formdata is js data object wchich represents current seleted values
  const formData = new FormData(myForm); // object with selected values stored in format key: value

  const formValueObject = Object.fromEntries(formData);
  // get from to dates
  const { from, to } = formValueObject;

  const dateFrom = new Date(from);
  const dateTo = new Date(to);

  invalidElement.classList.add("hidden");
  priceResultElement.classList.add("hidden");

  if (!from || !to || Number(dateFrom) > Number(dateTo)) {
    console.log('k')
    invalidElement.classList.remove("hidden");
    invalidElement.innerHTML = "Niepoprawny zakres dat";
  }



  console.log(formValueObject)

}