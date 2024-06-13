document.addEventListener('DOMContentLoaded', () => {

  const elementSubTotal = document.getElementById('subtotal');

  const elementsSubProduct = document.querySelectorAll('.sub-product');
  //fica escutando os eventos de click do eslementos que possuem a classe sub-product
  for(let i = 0; i < elementsSubProduct.length; i++) {
    elementsSubProduct[i].addEventListener('click', ()=>{subProduct(elementsSubProduct[i], elementSubTotal)}, false);
  }

  const elementsAddProduct = document.querySelectorAll('.add-product');
  //fica escutando os eventos de click do eslementos que possuem a classe add-product
  for(let i = 0; i < elementsAddProduct.length; i++) {
    elementsAddProduct[i].addEventListener('click', ()=>{addProduct(elementsAddProduct[i], elementSubTotal)}, false);
  }
  
})

const subProduct = (element, elementSubTotal) => {
    const elementInputId = element.getAttribute('input-id');
    const elementInput = document.getElementById(elementInputId);
    
    if (elementInput.value > 0) {
      document.getElementById(elementInputId).value = parseInt(elementInput.value)-1;

        const elementPriceId = element.getAttribute('price-id');    
        const elementPrice = document.getElementById(elementPriceId); 
        let addeddPrice = parseFloat(elementPrice.innerText);
        if (addeddPrice == 0) {
          elementSubTotal.innerText = 0.00;
        } else {
          let subTotal = parseFloat(elementSubTotal.innerText) - addeddPrice;
          elementSubTotal.innerText = subTotal;
        }
    }
}

const addProduct = (element, elementSubTotal) => {
    const elementInputId = element.getAttribute('input-id');
    const elementInput = document.getElementById(elementInputId);   
    document.getElementById(elementInputId).value = parseInt(elementInput.value)+1;

    const elementPriceId = element.getAttribute('price-id');    
    const elementPrice = document.getElementById(elementPriceId); 
    let subTotal = parseFloat(elementSubTotal.innerText) + parseFloat(elementPrice.innerText);
    elementSubTotal.innerText = subTotal;
}

const makeOrderWhatsapp = ()=>{
  
}