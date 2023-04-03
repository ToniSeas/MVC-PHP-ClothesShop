CREATE DATABASE IF NOT EXISTS tiendavestirdb;
USE tiendavestirdb;

CREATE USER IF NOT EXISTS 'root_tienda'@'localhost' IDENTIFIED BY 'LPlma0MoqlwLv{p0';
GRANT ALL PRIVILEGES ON *.* TO 'root_tienda'@'localhost';

CREATE TABLE tb_discount(
	discount_id INT PRIMARY KEY AUTO_INCREMENT
,	start_date DATETIME
,	end_date DATETIME
,	discount_percent INT NOT NULL 
,  CONSTRAINT CHK_Dates CHECK (start_date < end_date)
) ENGINE=INNODB;

INSERT INTO  tb_discount(
	start_date
,	discount_percent
,	end_date
)
VALUES
(NULL, 0, NULL);

CREATE TABLE tb_category(
	category_id INT PRIMARY KEY AUTO_INCREMENT
,	category_name VARCHAR(100) NOT NULL UNIQUE
) ENGINE=INNODB;

CREATE TABLE tb_products (
	product_id INT PRIMARY KEY AUTO_INCREMENT
,	name VARCHAR(150) NOT NULL
,	price DECIMAL(12, 2) NOT NULL
,	description VARCHAR(500) NOT NULL
,	image_path VARCHAR(200) NOT NULL
,	discount_id INT NOT NULL
,	category_id INT NOT NULL
,	FOREIGN KEY(discount_id) REFERENCES tb_discount(discount_id)
,	FOREIGN KEY(category_id) REFERENCES tb_category(category_id)
) ENGINE=INNODB;

CREATE TABLE tb_users (
	user_id INT PRIMARY KEY AUTO_INCREMENT NOT NULL
,	person_name VARCHAR(100) NOT NULL
,	person_surnames VARCHAR(100) NOT NULL
,	email_address VARCHAR(100) NOT NULL UNIQUE CHECK(email_address <> '' AND email_address LIKE '_%@_%._%')
,	user_name VARCHAR(100) NOT NULL UNIQUE
, 	password VARCHAR(20) NOT NULL
, 	gender CHAR NOT NULL CHECK (gender = 'F' OR gender = 'M' OR gender = 'N')
# users types: S = SysAdmin; A = Admin; C = Client
, 	user_type CHAR NOT NULL CHECK (user_type = 'S' OR user_type = 'A' OR user_type = 'C')
,	is_deleted BIT DEFAULT B'0' NOT NULL
) ENGINE=INNODB;

CREATE TABLE tb_shopping_cart(
	register_id INT PRIMARY KEY AUTO_INCREMENT NOT NULL
,	user_id INT NOT NULL
,	product_id INT NOT NULL
, 	FOREIGN KEY(user_id) REFERENCES tb_users(user_id)
, 	FOREIGN KEY(product_id) REFERENCES tb_products(product_id)
) ENGINE=INNODB;

INSERT INTO tb_users
(
	person_name
, 	person_surnames
,	email_address
,	user_name
,	password
,	gender
,	user_type
)
VALUES
('Sysadmin', '', 'sysadmin@gmail.com', 'admin', '1234', 'N', 'S');

CREATE TABLE tb_sales_header(
	sale_id INT PRIMARY KEY AUTO_INCREMENT NOT NULL
,	user_id INT NOT NULL
,	card_number VARCHAR(200) NOT NULL
,	card_brand VARCHAR(200) NOT NULL
,	card_owner VARCHAR(500) NOT NULL
,	card_exp VARCHAR (100) NOT NULL
,	card_cvv VARCHAR (50) NOT NULL
,	sale_date DATETIME NOT NULL
, 	FOREIGN KEY(user_id) REFERENCES tb_users(user_id)
) ENGINE=INNODB;

CREATE TABLE tb_sales_detail(
	sale_detail_id INT PRIMARY KEY AUTO_INCREMENT NOT NULL
,	sale_id INT NOT NULL
,	product_id INT NOT NULL
,	quantity INT NOT NULL
, 	FOREIGN KEY(product_id) REFERENCES tb_products(product_id)
, 	FOREIGN KEY(sale_id) REFERENCES tb_sales_header(sale_id)
) ENGINE=INNODB;

DELIMITER //
CREATE PROCEDURE sp_add_product(IN param_product_name VARCHAR(150), IN param_product_price DECIMAL(12, 2), 
	IN param_product_description VARCHAR(500), IN param_product_image_path VARCHAR(200), param_category_id INT)
BEGIN

	/*Valores retornados:
		0 = Registrado correctamente
		1 = El producto ya está registrado
	*/

	IF (EXISTS(SELECT name FROM tb_products WHERE name = param_product_name))
	THEN
		SELECT '1' AS query_state;
	ELSE
	BEGIN
		INSERT INTO tb_products(
			name
		,	price
		,	description
		,	image_path
		,	discount_id
		,	category_id
		)
		VALUES
			(param_product_name, param_product_price, param_product_description, param_product_image_path, 1, param_category_id);
			
		SELECT '0' AS query_state;
	END;
	END IF;
	
	
END //
DELIMITER ;

DELIMITER //
CREATE PROCEDURE sp_remove_product(IN param_product_id INT)
BEGIN
	DELETE FROM tb_products
	WHERE product_id = param_product_id;
END //
DELIMITER ;

DELIMITER //
CREATE PROCEDURE sp_add_category(IN param_category_name VARCHAR(100))
BEGIN

	/*Valores retornados:
		0 = Registrado correctamente
		1 = La categoría ya está registrada
	*/

	IF (EXISTS(SELECT category_name FROM tb_category WHERE category_name = param_category_name))
	THEN
		SELECT '1' AS query_state;
	ELSE
	BEGIN
		INSERT INTO tb_category (
			category_name
		)
		VALUES
			(param_category_name);
			
		SELECT '0' AS query_state;
	END;
	END IF;
	
	
END //
DELIMITER ;

DELIMITER //
CREATE PROCEDURE sp_add_discount(IN param_start_date DATETIME, IN param_end_date DATETIME, IN param_discount_percent INT)
BEGIN

	/*Valores retornados:
		0 = Registrado correctamente
		1 = El porcentaje debe ser entre 0 y 100
		2 = La fecha de inicio debe ser menor que la fecha de fin
	*/
	
	IF (param_discount_percent < 0 || param_discount_percent > 100)
	THEN
		SELECT '1' AS query_state;
	ELSEIF (param_start_date > param_end_date)
	THEN
		SELECT '2' AS query_state;
	ELSE
	BEGIN

		INSERT INTO  tb_discount(
			start_date
		,	discount_percent
		,	end_date
		)
		VALUES
		(param_start_date, param_discount_percent, param_end_date);
			
		SELECT '0' AS query_state;	
		
	END;
	END IF;
	
END //
DELIMITER ;

DELIMITER //
CREATE PROCEDURE sp_add_discount_to_product(IN param_discount_id INT, IN param_product_id INT)
BEGIN

	/*Valores retornados:
		0 = Registrado correctamente
		1 = El producto no existe
		2 = El descuento no existe
	*/
	
	IF (NOT EXISTS(SELECT product_id FROM tb_products WHERE product_id = param_product_id))
	THEN
	BEGIN
		SELECT '1' AS query_state;
	END;
	ELSEIF (NOT EXISTS(SELECT discount_id FROM tb_discount WHERE discount_id = param_discount_id))
	THEN
	BEGIN
		SELECT '2' AS query_state;
	END;
	ELSE
	BEGIN

		UPDATE tb_products
			SET discount_id := param_discount_id
		WHERE product_id = param_product_id;
		
		SELECT '0' AS query_state;
		
	END;
	END IF;
	
END //
DELIMITER ;

DELIMITER //
CREATE PROCEDURE sp_exists_user(IN param_user_name VARCHAR(100), IN param_password VARCHAR(20)) 
BEGIN
	SET @local_is_user_name := 'No';
	SET @local_is_password := 'No';
	SET @local_user_type := '';

	IF (EXISTS(SELECT user_name FROM tb_users WHERE user_name = param_user_name AND is_deleted = B'0'))
	THEN
	BEGIN
		SET @local_is_user_name := 'Yes';
	END;
	END IF;
	
	IF (@local_is_user_name = 'Yes' AND (SELECT password FROM tb_users WHERE user_name = param_user_name) = param_password)
	THEN
	BEGIN
		SET @local_is_password := 'Yes';
	END;
	END IF;
	
	IF (@local_is_password = 'Yes')
	THEN
	BEGIN
		SET @local_user_type := (SELECT user_type FROM tb_users WHERE user_name = param_user_name);
	END;
	END IF;
	
	SELECT @local_is_user_name AS is_user_name, @local_is_password AS is_password, @local_user_type AS user_type;
	
END //
DELIMITER ;

DELIMITER //
CREATE PROCEDURE sp_add_admin(IN param_person_name VARCHAR(100), IN param_person_surnames VARCHAR(100), 
	IN param_email_address VARCHAR(100), IN param_user_name VARCHAR(100), IN param_password VARCHAR(20), IN param_gender CHAR)
BEGIN
	
	/*Valores retornados:
		0 = Registrado correctamente
		1 = El correo ya está registrado
		2 = El usuario ya existe
		3 = El correo no tiene el formato correcto
	*/
	
	IF (EXISTS(SELECT email_address FROM tb_users WHERE email_address = param_email_address))
	THEN
		SELECT '1' AS query_state;
	ELSEIF (EXISTS(SELECT user_name FROM tb_users WHERE user_name = param_user_name))
	THEN
		SELECT '2' AS query_state;
	ELSE
	BEGIN
		IF (param_email_address NOT LIKE '_%@_%._%')
		THEN
			SELECT '3' AS query_state;
		ELSE
		BEGIN
			INSERT INTO tb_users
			(
				person_name
			, 	person_surnames
			,	email_address
			,	user_name
			,	password
			,	gender
			,	user_type
			)
		   VALUES (param_person_name, param_person_surnames, param_email_address, param_user_name, param_password, param_gender, 'A');
	   
			SELECT '0' AS query_state;
		END;
		END IF;
	END;
   END IF;
END //
DELIMITER ;

DELIMITER //
CREATE PROCEDURE sp_remove_admin(IN param_user_name VARCHAR(100))
BEGIN
	
	/*Valores retornados:
		0 = Eliminado correctamente
		1 = El usuario no existe
	*/
	
	IF (EXISTS(SELECT user_name FROM tb_users WHERE user_name = param_user_name))
	THEN
	BEGIN
	
		UPDATE tb_users
		SET is_deleted = B'1'
		WHERE user_name = param_user_name;
		
   	SELECT '0' AS query_state;
	END;
	ELSE
		SELECT '1' AS query_state;
   END IF;
   
END //
DELIMITER ;

DELIMITER //
CREATE PROCEDURE sp_add_client(IN param_person_name VARCHAR(100), IN param_person_surnames VARCHAR(100), 
	IN param_email_address VARCHAR(100), IN param_user_name VARCHAR(100), IN param_password VARCHAR(20), IN param_gender CHAR)
BEGIN

	/*Valores retornados:
		0 = Registrado correctamente
		1 = El correo ya está registrado
		2 = El usuario ya existe
		3 = El correo no tiene el formato correcto
	*/
	
	IF (EXISTS(SELECT email_address FROM tb_users WHERE email_address = param_email_address))
	THEN
		SELECT '1' AS query_state;
	ELSEIF (EXISTS(SELECT user_name FROM tb_users WHERE user_name = param_user_name))
	THEN
		SELECT '2' AS query_state;
	ELSE
	BEGIN
		IF (param_email_address NOT LIKE '_%@_%._%')
		THEN
			SELECT '3' AS query_state;
		ELSE
		BEGIN
			INSERT INTO tb_users
			(
				person_name
			, 	person_surnames
			,	email_address
			,	user_name
			,	password
			,	gender
			,	user_type
			)
		   VALUES (param_person_name, param_person_surnames, param_email_address, param_user_name, param_password, param_gender, 'C');
	   
			SELECT '0' AS query_state;
		END;
		END IF;
	END;
   END IF;
END //
DELIMITER ;

DELIMITER //
CREATE PROCEDURE sp_get_users() 
BEGIN
	SELECT
		user_id	
	,	person_name
	, 	person_surnames
	,	email_address
	,	user_name
	,	password
	,	gender
	,	user_type
	FROM tb_users;
END //
DELIMITER ;

DELIMITER //
CREATE PROCEDURE sp_get_discount(IN param_product_id INT)
BEGIN

	/*Valores retornados:
		descuento = Descuento válido
		F = Fechas inválidas
		N = La promoción ya acabó
		D = El valor del descuento es nulo
	*/
	
	SET @product_discount := (SELECT discount_id FROM tb_products WHERE product_id = param_product_id);
	SET @beginDate := (SELECT start_date FROM tb_discount WHERE discount_id = @product_discount);
	SET @endDate := (SELECT end_date FROM tb_discount WHERE discount_id = @product_discount);
	SET @discount_value := (SELECT discount_percent FROM tb_discount WHERE discount_id = @product_discount);

	IF (@endDate IS NULL || @beginDate IS NULL)
	THEN
		SELECT 'F' AS query_state;
	ELSEIF (@endDate < CURDATE())
	THEN
		SELECT 'N' AS query_state;
	ELSEIF (@discount_value IS NULL)
	THEN
		SELECT 'D' AS query_state;
	ELSE
	BEGIN
		SELECT @discount_value AS query_state;
	END;
	END IF;
	
	
END //
DELIMITER ;

DELIMITER //
CREATE PROCEDURE sp_add_product_cart(IN param_product_id INT, IN param_user_id INT)
BEGIN

	/*Valores retornados:
		0 = Registrado correctamente
		1 = El usuario no existe
		2 = El producto no existe
	*/
	
	IF (NOT EXISTS(SELECT user_id FROM tb_users WHERE user_id = param_user_id))
	THEN
		SELECT '1' AS query_state;
	ELSEIF (NOT EXISTS(SELECT product_id FROM tb_products WHERE product_id = param_product_id))
	THEN
		SELECT '2' AS query_state;
	ELSE
	BEGIN
		
		INSERT INTO tb_shopping_cart
		(
			user_id
		,	product_id
		)
	   VALUES (param_user_id, param_product_id);
   
		SELECT '0' AS query_state;

	END;
   END IF;
END //
DELIMITER ;

DELIMITER //
CREATE PROCEDURE sp_add_sale(IN param_sale_id INT, IN param_user_id INT, IN param_card_number VARCHAR(200), IN param_card_brand VARCHAR(200), 
										IN param_card_owner VARCHAR(500), IN param_card_exp VARCHAR(100), IN param_card_cvv VARCHAR(50),
										IN param_product_id INT, IN quantity INT)
BEGIN

	/*Valores retornados:
		0 = Registrado correctamente
		2 = El producto no existe
	*/
	
	SET @local_sale_id = NULL;
	
	IF (EXISTS(SELECT sale_id FROM tb_sales_header WHERE sale_id = param_sale_id))
	THEN
		SET @local_sale_id = param_sale_id;
	ELSE
	BEGIN
	
		INSERT INTO tb_sales_header(
			user_id
		,	card_number
		,	card_brand
		,	card_owner
		,	card_exp
		,	card_cvv
		,	sale_date
		)
		VALUES
		(param_user_id, param_card_number, param_card_brand, param_card_owner, param_card_exp, param_card_cvv, CURDATE());
		
		SET @local_sale_id = (SELECT LAST_INSERT_ID());
		
	END;
	END IF;
	
	IF (NOT EXISTS(SELECT product_id FROM tb_products WHERE product_id = param_product_id))
	THEN
		SELECT '2' AS query_state;
	ELSE
	BEGIN
		
		INSERT INTO tb_sales_detail
		(
			sale_id
		,	product_id
		,	quantity
		)
	   VALUES (@local_sale_id, param_product_id, quantity);
   
		SELECT '0' AS query_state, @local_sale_id AS sale_id;

	END;
   END IF;
END //
DELIMITER ;

DELIMITER //
CREATE PROCEDURE sp_empty_cart(IN param_user_id INT)
BEGIN

	DELETE FROM tb_shopping_cart
	WHERE user_id = param_user_id;
	
END //
DELIMITER ;

DELIMITER //
CREATE PROCEDURE sp_remove_product_cart(IN param_user_id INT, IN param_product_id INT)
BEGIN

	DELETE FROM tb_shopping_cart
	WHERE user_id = param_user_id AND product_id = param_product_id;
	
END //
DELIMITER ;