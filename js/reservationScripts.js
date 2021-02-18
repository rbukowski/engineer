function checkTerm() {
  // get form from dom tree
  const myForm = document.getElementById("term-form");
  const invalidElement = document.getElementById("invalid");
  const priceResultElement = document.getElementById("price-result");
  const bookButton = document.getElementById("book-button");
  const checkTermButton = document.getElementById("check-term-button");

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
    invalidElement.classList.remove("hidden");
    invalidElement.innerHTML = "Niepoprawny zakres dat";
    return false
  }

  // TODO: REMOVE RANDOM
  const isTerm = Math.random() * 1 > 0.5;

  if (!isTerm) {
    invalidElement.classList.remove("hidden");
    invalidElement.innerHTML = "Niestety to pomieszczenie nie jest dostepne w tym okresie";
    checkTermButton.classList.remove("hidden");
    bookButton.classList.add("hidden");

    return false
  }

  checkTermButton.classList.add("hidden");
  bookButton.classList.remove("hidden");

  const pricePerPeriodNode = document.getElementsByClassName("price-per-period")[0];
  const price = Number(pricePerPeriodNode.innerHTML);

  if (isNaN(price)) {
    return false
  }

  const diffTime = Math.abs(dateTo - dateFrom);
  const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24)); 

  priceResultElement.classList.remove("hidden");
  const priceElementInner = priceResultElement.getElementsByClassName("price")[0];

  priceElementInner.innerHTML = `${diffDays * price} zł`;
}