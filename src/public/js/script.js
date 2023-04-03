function registrarProductoAjax(nombreProducto, precioProducto){
	var parametros={"nombreajax":nombreProducto,"precioajax":precioProducto};
	$.ajax(
		{
				data:parametros,
				url:'?controlador=Producto&accion=registrarajax',
				type:'post',
				beforeSend:function(){
					$("#mensaje").html("Procesando espere");
				} 
			,
			success:function(response){
				$("#mensaje").html(response);
			}
		}
	);
}

function loginAjax(userName, userPassword) {
	var parameters={"userName":userName, "userPassword":userPassword};

	$.ajax(
		{
			data:parameters,
			url:'?controller=LoginController&action=loginAjax',
			type:'post',
			beforeSend:function() {
				$("#message").html('<span style="color:black; text-transform: uppercase; font-weight: 600;">Procesando, espere...</span>');
			},
			success:function(response) {
				console.log(response);
				if (response == 1) {
					$("#message").html('<span style="color:green; text-transform: uppercase; font-weight: 600;">Login Correcto.</span>');
					window.location.assign("?controller=MainController")
				} else if (response == 2) {
					$("#message").html('<span style="color:red; text-transform: uppercase; font-weight: 600;">Error: Contraseña Incorrecta.</span>');
				} else if (response == 3) {
					$("#message").html('<span style="color:red; text-transform: uppercase; font-weight: 600;">Error: Los datos ingresados no existen.</span>');
				} else {
					$("#message").html(response);
				}
				
			}
		}
	);
}

function logoutAjax() {
	var parameters={};

	$.ajax(
		{
			data:parameters,
			url:'?controller=LoginController&action=logoutAjax',
			type:'post',
			success:function(response) {
				window.location.assign("?controller=LoginController");
				console.log(response);
			}
		}
	);
}

function addAdminAjax(personName, personSurnames, emainAddress, userName, userPassword, personGender) {
	var parameters={'personName':personName, 'personSurnames':personSurnames, 'emainAddress':emainAddress, 'userName':userName, 'userPassword':userPassword, 'personGender':personGender};

	$.ajax(
		{
			data:parameters,
			url:'?controller=AdminController&action=addAdminAjax',
			type:'post',
			beforeSend:function() {
				$("#message").html('<span style="text-transform: uppercase; font-weight: 600;">Procesando espere...</span>');
			},
			success:function(response) {
				if (response == 1){
					$("#message").html('<span style="color:red; text-transform: uppercase; font-weight: 600;">Error: Ese correo electrónico ya existe.</span>');
				} else if (response == 2){
					$("#message").html('<span style="color:red; text-transform: uppercase; font-weight: 600;">Error: Ese nombre de usuario ya existe.</span>');
				} else if (response == 3){
					$("#message").html('<span style="color:red; text-transform: uppercase; font-weight: 600;">Error: El correo electrónico debe ser válido.</span>');
				} else if (response == 4) {
					$("#message").html('<span style="color:red; text-transform: uppercase; font-weight: 600;">Error: El nombre de la persona debe contener al menos un caracter.</span>');
				} else if (response == 5) {
					$("#message").html('<span style="color:red; text-transform: uppercase; font-weight: 600;">Error: Los apellidos de la persona debe contener al menos un caracter.</span>');
				} else if (response == 6) {
					$("#message").html('<span style="color:red; text-transform: uppercase; font-weight: 600;">Error: El correo debe contener al menos un caracter.</span>');
				} else if (response == 7) {
					$("#message").html('<span style="color:red; text-transform: uppercase; font-weight: 600;">Error: El nombre de usuario debe contener al menos un caracter.</span>');
				} else if (response == 8) {
					$("#message").html('<span style="color:red; text-transform: uppercase; font-weight: 600;">Error: La contraseña debe contener al menos un caracter.</span>');
				} else if (response == 9) {
					$("#message").html('<span style="color:red; text-transform: uppercase; font-weight: 600;">Error: El género debe ser válido.</span>');
				} else if (response == 0) {
					getAdminViewHTML(1, '<span style="color:green; text-transform: uppercase; font-weight: 600;">Administrador Registrado Correctamente.</span>');
				} else {
					console.log(response);
				}
			}
		}
	);
}

function removeAdminAjax(userName) {
	var parameters={'userName':userName};

	$.ajax(
		{
			data:parameters,
			url:'?controller=AdminController&action=removeAdminAjax',
			type:'post',
			beforeSend:function() {
				console.log("before send")
				$("#message").html('<span style="text-transform: uppercase; font-weight: 600;">Cargando, espere...</span>');
			},
			success:function(response) {
				if (response == 0) {
					getAdminViewHTML(2, '<span style="color:green; text-transform: uppercase; font-weight: 600;">Administrador Eliminado Correctamente.</span>');
				} else if (response == 1){
					$("#message").html('<span style="color:red; text-transform: uppercase; font-weight: 600;">Error: No existe ese nombre de usuario.</span>');
				} else if (response == 2){
					$("#message").html('<span style="color:red; text-transform: uppercase; font-weight: 600;">Error: No se puede eliminar el mismo usuario que se está usando.</span>');
				} else {
					console.log(response);
				}
			}
		}
	);
}

function getAdminsAjax(userName) {
	var parameters={'userName':userName};

	$.ajax(
		{
			data:parameters,
			url:'?controller=AdminController&action=getAdminsAjax',
			type:'post',
			beforeSend:function() {
				$("#loadingMessage").html('<span style="text-transform: uppercase; font-weight: 600;">Cargando, espere...</span>');
			},
			success:function(response) {
				$("#loadingMessage").html('<span style="text-transform: uppercase; font-weight: 600;"></span>');
				$("#admins").html(response);
			}
		}
	);
}

function getCategoriesAjax(categoryName) {
	var parameters={'categoryName':categoryName};

	$.ajax(
		{
			data:parameters,
			url:'?controller=AdminController&action=getCategoriesAjax',
			type:'post',
			beforeSend:function() {
				$("#loadingMessage").html('<span style="text-transform: uppercase; font-weight: 600;">Cargando, espere...</span>');
			},
			success:function(response) {
				$("#loadingMessage").html('<span style="text-transform: uppercase; font-weight: 600;"></span>');
				$("#categories").html(response);
			}
		}
	);
}

function getProductsAjax(productName) {
	var parameters={'productName':productName};

	$.ajax(
		{
			data:parameters,
			url:'?controller=AdminController&action=getProductsAjax',
			type:'post',
			beforeSend:function() {
				$("#loadingMessage").html('<span style="text-transform: uppercase; font-weight: 600;">Cargando, espere...</span>');
			},
			success:function(response) {
				$("#loadingMessage").html('<span style="text-transform: uppercase; font-weight: 600;"></span>');
				$("#products").html(response);
			}
		}
	);
}

function addCategoryAjax(categoryName) {
	var parameters={'categoryName':categoryName};

	$.ajax(
		{
			data:parameters,
			url:'?controller=AdminController&action=addCategoryAjax',
			type:'post',
			beforeSend:function() {
				$("#message").html('<span style="text-transform: uppercase; font-weight: 600;">Procesando, espere...</span>');
			},
			success:function(response) {
				if (response == 1){
					$("#message").html('<span style="color:red; text-transform: uppercase; font-weight: 600;">Error: La categoría ya existe.</span>');
				} else if (response == 0) {
					getAdminViewHTML(3, '<span style="color:green; text-transform: uppercase; font-weight: 600;">Categoría Registrada Correctamente.</span>');
				} else {
					console.log(response);
				}
			}
		}
	);
}

function addDiscountAjax(startDate, endDate, discountPercent) {
	var formData = new FormData();                  
	formData.append('startDate', startDate);
	formData.append('endDate', endDate);
	formData.append('discountPercent', discountPercent);
	formData.append('products', JSON.stringify(productsList));

	$.ajax(
		{
			data:formData,
			url:'?controller=AdminController&action=addDiscountAjax',
			type: "POST",
            data: formData,
            contentType: false,
            cache: false,
            processData:false,
			beforeSend:function() {
				$("#message").html('<span style="text-transform: uppercase; font-weight: 600;">Procesando, espere...</span>');
			},
			success:function(response) {
				if (response == 1){
					$("#message").html('<span style="color:red; text-transform: uppercase; font-weight: 600;">Error: El porcentaje debe ser un número entero entre 0 y 100.</span>');
				} else if (response == 2){
					$("#message").html('<span style="color:red; text-transform: uppercase; font-weight: 600;">Error: La Fecha de Inicio debe ser menor que la fecha de Fin.</span>');
				} else if (response == 3){
					$("#message").html('<span style="color:red; text-transform: uppercase; font-weight: 600;">Error: Las Fechas deben ser válidas.</span>');
				} else if (response == 4){
					$("#message").html('<span style="color:red; text-transform: uppercase; font-weight: 600;">Error: Debe seleccionar al menos un producto.</span>');
				} else if (response == 0) {
					getAdminViewHTML(4, '<span style="color:green; text-transform: uppercase; font-weight: 600;">Descuento Registrado Correctamente.</span>');
				} else {
					console.log(response);
				}
			}
		}
	);
}

function addProductAjax(name, price, description, categoryId) {
	var imgFile = $('#fileInput').prop('files')[0];
	if (imgFile == null) {
		$("#message").html('<span style="color:red; text-transform: uppercase; font-weight: 600;">Error: Debe seleccionar una imagen para el producto.</span>');
	} else {
		var formData = new FormData();                  
        formData.append('imgFile', imgFile);
		formData.append('name', name);
		formData.append('price', price);
		formData.append('description', description);
		formData.append('categoryId', categoryId);
		console.log(formData);
        $.ajax({
            url: "?controller=AdminController&action=addProductAjax",
            type: "POST",
            data: formData,
            contentType: false,
            cache: false,
            processData:false,
			beforeSend:function() {
				$("#message").html('<span style="text-transform: uppercase; font-weight: 600;">Procesando, espere...</span>');
			},
            success:function(response) {
				if (response == 1){
					$("#message").html('<span style="color:red; text-transform: uppercase; font-weight: 600;">Error: El producto ya está registrado.</span>');
				} else if (response == 2) {
					$("#message").html('<span style="color:red; text-transform: uppercase; font-weight: 600;">Error: La imagen no se pudo guardar en el servidor.</span>');
				} else if (response == 3) {
					$("#message").html('<span style="color:red; text-transform: uppercase; font-weight: 600;">Error: Debe ingresar un nombre.</span>');
				} else if (response == 4) {
					$("#message").html('<span style="color:red; text-transform: uppercase; font-weight: 600;">Error: Debe ingresar un precio.</span>');
				} else if (response == 5) {
					$("#message").html('<span style="color:red; text-transform: uppercase; font-weight: 600;">Error: Debe ingresar una descripción.</span>');
				} else if (response == 6) {
					$("#message").html('<span style="color:red; text-transform: uppercase; font-weight: 600;">Error: Debe seleccionar una categoría.</span>');
				} else if (response == 0) {
					getAdminViewHTML(5, '<span style="color:green; text-transform: uppercase; font-weight: 600;">Producto Registrado Correctamente.</span>');
				} else {
					console.log(response);
				}
			}
    	});
	}
}

function getAdminViewHTML(signal, message) {
	var action = '';
	if (signal == 1) {
		action = 'getAddAdminView';
	} else if (signal == 2) {
		action = 'getRemoveAdminView';
	} else if (signal == 3) {
		action = 'getAddCategoryView';
	} else if (signal == 4) {
		action = 'getAddDiscountView';
	} else if (signal == 5) {
		action = 'getAddProductView';
	}
	$.ajax(
		{
			url:'?controller=AdminController&action='+action,
			type:'post',
			beforeSend:function() {
				$("#admin-content").html("Cargando...");
			},
			success:function(response) {
				$("#admin-content").html(response);
				$("#message").html(message);
				//getAdminsAjax('');
			}
		}
	);
}

function getRadioChecked(radioName) {
	var radio = document.getElementsByName('gender');
	
	for (i = 0; i < radio.length; i++) {
		if(radio[i].checked) {
			return radio[i].value;
		}
	}
}

function previewImg(imgId) {
	var image = document.getElementById(imgId);
	image.src = URL.createObjectURL(event.target.files[0]);
}

var productsList = [];
function addProductInTable(tBodyId, productId, productName) {
	if (productId != 'None') {
		productsList.push(productId);
		tBody = document.getElementById(tBodyId);
		tBody.innerHTML += "<tr id='tr"+productId+"'><td><button type='button' class='btn btn-primary' onclick=\"removeElement('tr"+productId+"')\">Quitar</button></td><td>"+productName+"</td></tr>";
	}	
}

function removeElement(elementId) {
	element = document.getElementById(elementId).remove();
}

function getLoginViewHTML(signal, message) {
	var action = '';
	if (signal == 1) {
		action = 'getAddClientView';
	} else if (signal == 2) {
		action = 'getLoginView';
	}
	$.ajax(
		{
			url:'?controller=LoginController&action='+action,
			type:'post',
			beforeSend:function() {
				$("#login-content").html("Cargando...");
			},
			success:function(response) {
				$("#login-content").html(response);
				$("#message").html(message);
			}
		}
	);
}

function addClientAjax(personName, personSurnames, emainAddress, userName, userPassword, personGender) {
	var parameters={'personName':personName, 'personSurnames':personSurnames, 'emainAddress':emainAddress, 'userName':userName, 'userPassword':userPassword, 'personGender':personGender};

	$.ajax(
		{
			data:parameters,
			url:'?controller=LoginController&action=addClientAjax',
			type:'post',
			beforeSend:function() {
				$("#message").html('<span style="text-transform: uppercase; font-weight: 600;">Procesando espere...</span>');
			},
			success:function(response) {
				if (response == 1){
					$("#message").html('<span style="color:red; text-transform: uppercase; font-weight: 600;">Error: Ese correo electrónico ya existe.</span>');
				} else if (response == 2){
					$("#message").html('<span style="color:red; text-transform: uppercase; font-weight: 600;">Error: Ese nombre de usuario ya existe.</span>');
				} else if (response == 3){
					$("#message").html('<span style="color:red; text-transform: uppercase; font-weight: 600;">Error: El correo electrónico debe ser válido.</span>');
				} else if (response == 4) {
					$("#message").html('<span style="color:red; text-transform: uppercase; font-weight: 600;">Error: El nombre de la persona debe contener al menos un caracter.</span>');
				} else if (response == 5) {
					$("#message").html('<span style="color:red; text-transform: uppercase; font-weight: 600;">Error: Los apellidos deben contener al menos un caracter.</span>');
				} else if (response == 6) {
					$("#message").html('<span style="color:red; text-transform: uppercase; font-weight: 600;">Error: El correo debe contener al menos un caracter.</span>');
				} else if (response == 7) {
					$("#message").html('<span style="color:red; text-transform: uppercase; font-weight: 600;">Error: El nombre de usuario debe contener al menos un caracter.</span>');
				} else if (response == 8) {
					$("#message").html('<span style="color:red; text-transform: uppercase; font-weight: 600;">Error: La contraseña debe contener al menos un caracter.</span>');
				} else if (response == 9) {
					$("#message").html('<span style="color:red; text-transform: uppercase; font-weight: 600;">Error: El género debe ser válido.</span>');
				} else if (response == 0) {
					getLoginViewHTML(1, '<span style="color:green; text-transform: uppercase; font-weight: 600;">Cuenta Registrada Correctamente.</span>');
				} else {
					console.log(response);
				}
			}
		}
	);
}

signalIndicator = 'N'
orderIndicator = 'A';
valueIndicator = '';

function getProductsViewHTML(signal, value, order) {
	action = 'getProductsView';

	if (value == 'None') {
		value = '';
	}

	signalIndicator = signal;
	orderIndicator = order;
	valueIndicator = value;

	var parameters={'signal':signal, 'value':value, 'order':order};

	$.ajax(
		{
			data:parameters,
			url:'?controller=MainController&action='+action,
			type:'post',
			beforeSend:function() {
				$("#productsContainer").html("Cargando...");
			},
			success:function(response) {
				$("#productsContainer").html(response);
			}
		}
	);
}

function searchProductBy(signal){
	var htmlSearch = "";
	if (signal == 1) {
		htmlSearch = 
			"<div>"
			+"	<br>"
			+"	<label class='' for='categories'>Categoría</label>"
			+"	<br>"
			+"	<input type='text' id='searchBar' oninput='getCategoriesAjax($(\"#searchBar\").val()); return false;' placeholder='Buscar categoría...'>"
			+"	<br>"
			+"	<select id='categories' type='text' onchange='getProductsViewHTML(\"C\", $(categories).children(\":selected\").attr(\"id\"), \"A\")'></select>"
			+"	<div id='loadingMessage'></div>"
			+"</div>"
			+"<script>getCategoriesAjax($('#searchBar').val());</script>"
	} else if (signal == 2) {
		htmlSearch = 
			"<div>"
			+"	<br>"
			+"	<label class='' for='searchBar'>Ingrese el nombre del producto:</label>"
			+"	<br>"
			+"	<input type='text' id='searchBar' oninput='getProductsViewHTML(\"N\", $(\"#searchBar\").val(), \"A\"); return false;' placeholder='Buscar nombre...'>"
			+"</div>"
	}

	$("#searchProductContainer").html(htmlSearch);
}

function toggleProductsOrder () {

	orderButton = document.getElementById('orderProductButton');

	if (orderIndicator == 'A') {
		orderIndicator = 'D';
		orderButton.value = "Orden descendente por precio";
	} else if (orderIndicator == 'D') {
		orderIndicator = 'A';
		orderButton.value = "Orden ascendente por precio";
	}

	getProductsViewHTML(signalIndicator, valueIndicator, orderIndicator);

}

function addProductCartAjax(userId, productId) {
	var parameters={'userId':userId, 'productId':productId};
	console.log(parameters)
	$.ajax(
		{
			data:parameters,
			url:'?controller=MainController&action=addProductCartAjax',
			type:'post',
			beforeSend:function() {
				$("#message"+productId).html('<span style="text-transform: uppercase; font-weight: 600;">Procesando espere...</span>');
			},
			success:function(response) {
				if (response == 1){
					$("#message"+productId).html('<span style="color:red; text-transform: uppercase; font-weight: 600;">Error: El usuario no existe.</span>');
				} else if (response == 2){
					$("#message").html('<span style="color:red; text-transform: uppercase; font-weight: 600;">Error: El producto no existe.</span>');
				} else if (response == 0) {
					$("#message"+productId).html('<span style="color:green; text-transform: uppercase; font-weight: 600;">Agregado al carrito.</span>');
				} else {
					console.log(response);
				}
			}
		}
	);
}

function doPaymentAjax(cardNumber, cardBrand, cardExp, cardCVV, cardOwner) {
	cardBrand = 'MasterCard';
	var parameters={'cardNumber':cardNumber, 'cardBrand':cardBrand, 'cardExp':cardExp, 'cardCVV':cardCVV, 'cardOwner':cardOwner};
	$.ajax(
		{
			data:parameters,
			url:'?controller=PayController&action=doPaymentAjax',
			type:'post',
			beforeSend:function() {
				$("#message").html('<span style="text-transform: uppercase; font-weight: 600;">Procesando espere...</span>');
			},
			success:function(response) {
				if (response == 0) {
					$("#message").html('<span style="color:green; text-transform: uppercase; font-weight: 600;">Pago realizado.</span>');
				} else if (response == 1) {
					$("#message").html('<span style="color:red; text-transform: uppercase; font-weight: 600;">No se puede realizar el pago.</span>');
				} else if (response == 2) {
					$("#message").html('<span style="color:red; text-transform: uppercase; font-weight: 600;">Primero debe seleccionar al menos un producto.</span>');
				} else {
					console.log(response);
				}
			}
		}
	);
}

function removeProductAjax(productId) {
	var parameters={'productId':productId};
	$.ajax(
		{
			data:parameters,
			url:'?controller=CartController&action=removeProductAjax',
			type:'post',
			beforeSend:function() {
				$("#message").html('<span style="text-transform: uppercase; font-weight: 600;">Procesando espere...</span>');
			},
			success:function(response) {
				if (response == 0) {
					window.location.assign("?controller=CartController");
				} else {
					console.log(response);
				}
			}
		}
	);
}

function toggleFavProduct (buttonId) {

	button = document.getElementById(buttonId);
	value = button.value;

	if (value == 'F') {
		button.value = "N";
		button.innerHTML = 'Agregado a favoritos';
	} else if (value == 'N') {
		button.value = 'F';
		button.innerHTML = 'Agregar a favoritos';
	}

}