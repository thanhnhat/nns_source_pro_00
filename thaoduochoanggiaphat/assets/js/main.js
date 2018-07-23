(function ($) {
  'use strict';
  $(function () {
	customInputQuantity();

	$('body').on("updated_wc_div",function(){
		customInputQuantity();
	});
	
  });

  function customInputQuantity() {
	let inputList = $('input[type="number"]');

	$.each(inputList, function (i, input) {
	  let span_pre = document.createElement('span');
	  span_pre.classList.add('n-added', 'n-added--prepend', 'no_selection');
	  span_pre.innerText = '-';
	  span_pre.dataset.ref = input.id ? input.id : null;
	  span_pre.addEventListener('click', decrease);

	  input.parentElement.insertBefore(span_pre, input);

	  let span_app = document.createElement('span');
	  span_app.classList.add('n-added', 'n-added--append', 'no_selection');
	  span_app.innerText = '+';
	  span_app.dataset.ref = input.id ? input.id : null;
	  span_app.addEventListener('click', increase);
	  input.parentElement.insertBefore(span_app, input.nextSibling);

	  //Handle input value
	  input.addEventListener('keydown', function (e){
		if(this.value <= 0)
		  this.value = Math.abs(parseInt(this.value));
	  });

	});

  }
  function decrease() {
	if (this.dataset.ref == null)
	  return true;

	let ref = document.getElementById(this.dataset.ref);

	if(parseInt(ref.value) <=0 ) {
	  return true;
	}
	ref.value = parseInt(ref.value) - 1;
	$(ref).trigger('input');


  }

  function increase() {
	if (this.dataset.ref == null)
	  return true;

	let ref = document.getElementById(this.dataset.ref);
	ref.value = parseInt(ref.value) + 1;
	$(ref).trigger('input');
  }

})(jQuery);