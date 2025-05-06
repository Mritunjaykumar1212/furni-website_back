(function() {
	'use strict';

	var tinyslider = function() {
		var el = document.querySelectorAll('.testimonial-slider');

		if (el.length > 0) {
			var slider = tns({
				container: '.testimonial-slider',
				items: 1,
				axis: "horizontal",
				controlsContainer: "#testimonial-nav",
				swipeAngle: false,
				speed: 700,
				nav: true,
				controls: true,
				autoplay: true,
				autoplayHoverPause: true,
				autoplayTimeout: 3500,
				autoplayButtonOutput: false
			});
		}
	};
	tinyslider();

	


	var sitePlusMinus = function() {

		var value,
    		quantity = document.getElementsByClassName('quantity-container');

		function createBindings(quantityContainer) {
	      var quantityAmount = quantityContainer.getElementsByClassName('quantity-amount')[0];
	      var increase = quantityContainer.getElementsByClassName('increase')[0];
	      var decrease = quantityContainer.getElementsByClassName('decrease')[0];
	      increase.addEventListener('click', function (e) { increaseValue(e, quantityAmount); });
	      decrease.addEventListener('click', function (e) { decreaseValue(e, quantityAmount); });
	    }

	    function init() {
	        for (var i = 0; i < quantity.length; i++ ) {
						createBindings(quantity[i]);
	        }
	    };

	    function increaseValue(event, quantityAmount) {
	        value = parseInt(quantityAmount.value, 10);

	        console.log(quantityAmount, quantityAmount.value);

	        value = isNaN(value) ? 0 : value;
	        value++;
	        quantityAmount.value = value;
	    }

	    function decreaseValue(event, quantityAmount) {
	        value = parseInt(quantityAmount.value, 10);

	        value = isNaN(value) ? 0 : value;
	        if (value > 0) value--;

	        quantityAmount.value = value;
	    }
	    
	    init();
		
	};
	sitePlusMinus();


})()
// adii ka change hai suru
function form_contact() {
    let form_v_2002 = document.getElementById("my_form_2_2002");

    form_v_2002.addEventListener("submit", (e) => {
        e.preventDefault();

        let email_v_c = document.getElementById("email_2_2002").value.trim();
        let name_f_c = document.getElementById("fname_2002").value.trim();
        let name_l_c = document.getElementById("lname_2002").value.trim();
        let message_v_c = document.getElementById("message_2002").value.trim();
        let errorMsg = document.getElementById("error-msg");

        // Clear previous error
        errorMsg.textContent = "";
        errorMsg.style.color = "red";

        if (email_v_c === "" || name_f_c === "" || name_l_c === "" || message_v_c === "") {
            errorMsg.textContent = "Please fill all fields.";
            return;
        }

        if (!email_v_c.includes("@") || !email_v_c.includes(".")) {
            errorMsg.textContent = "Invalid email format.";
            return;
        }

        if (message_v_c.length > 50) {
            errorMsg.textContent = "Message must be under 50 characters.";
            return;
        }

        // Success
        errorMsg.style.color = "green";
        errorMsg.textContent = "Form submitted successfully ";

        // Clear the form
        form_v_2002.reset();
    });
}
form_contact();
// adii ka change hai khatam hai 