

function payWithPaystack(){
	var business_name =  $("#business_name").val();
	var tenant_business_website = $("#tenant_business_website").val();
	var business_type = $("#business_type").val();
	var tenant_usage = $("#tenant_usage").val();
	var tenant_country = $("#tenant_country").val();
	var tenant_city = $("#tenant_city").val();
	var payroll_start_year = $("#payroll_start_year").val();
	var contact_name = $("#contact_name").val();
	var contact_email = $("#contact_email").val();
	var contact_phone = $("#contact_phone").val();
	var contact_username = $("#contact_username").val();
	var password = $("#password").val();
	var plan = $("#plan").val();
	var referral_id = $("#referral_id").val();
	var price = parseFloat($("#price").val())/100;
	var today = new Date();


	if (jQuery.isEmptyObject(business_name) || jQuery.isEmptyObject(tenant_business_website) || jQuery.isEmptyObject(business_type)
		|| jQuery.isEmptyObject(tenant_usage) || jQuery.isEmptyObject(tenant_country) || jQuery.isEmptyObject(tenant_city) ||
		jQuery.isEmptyObject(payroll_start_year) || jQuery.isEmptyObject(contact_name) || jQuery.isEmptyObject(contact_email) ||
		jQuery.isEmptyObject(contact_phone) || jQuery.isEmptyObject(contact_username) || jQuery.isEmptyObject(password) || jQuery.isEmptyObject(plan)){

		swal('Please Fill All fields', { icon: 'error' });
	} else{
		var handler = PaystackPop.setup({
			key: 'pk_live_5f5e9ee6c8513b4800ef51f89d9fca898620c6fb',
			//key: 'pk_test_3867b2b50fe4f5d7c72a4ad9bcae7c06945c0440',
			email: $('form').find('input[name="tenant_contact_email"]').val(),
			amount: parseFloat(document.getElementById('price').value),
			ref: ''+Math.floor((Math.random() * 1000000000) + 1), // generates a pseudo-unique reference. Please replace with a reference you generated. Or remove the line entirely so our API will generate one for you
			metadata: {
				custom_fields: [
					{
						display_name: "Mobile Number",
						variable_name: "mobile_number",
						value: "+2348012345678"
					}
				]
			},
			callback: function(response){
				$('form').append('<input type="hidden" name="reference_code" value="' + response.reference + '">');
				function send(){

					$.ajax({
						url: 'https://amp-api.connexxiontelecom.com/public/new_product_sale',
						type: 'post',
						data: {
							'company_name': business_name,
							'contact_email': contact_email,
							'month': today.getMonth()+1,
							'year' : today.getFullYear(),
							'product_id': 7,
							'referral_code': referral_id,
							'amount': price
						},
						dataType: 'json',
						async: false,
						success:function(){

							$('form').submit();
							//setTimeout($('form').submit(), 5000);

						}
					});

				}

				async function sendI() {
					await send();
				}

				if(jQuery.isEmptyObject(referral_id)){

					document.getElementById('register-form').submit();
				}else{


					sendI();
					document.getElementById('register-form').submit();



				}






				//alert('success. transaction ref is ' + response.reference);
			},
			onClose: function(){
				//e.preventDefault();
				alert('window closed');
				//console.log('window closed');
			}
		});
		handler.openIframe();

	}






}




