<?php if(!defined("Api_Store_1_0_0_D")) die("Acceso denegado");
	
	//ruta default de la api
	$app->get('/', function(){
		echo 'API-REST PAYSANO';
	});

	######################################################################
	##                                                                  ##
	##					/* CRUD TABLA PRODUCTO	*/						##
	##                                                                  ##
	######################################################################

	//retorna todos los productos dentro de la base de datos
	$app->get('/productos',function() use ($app){
		//obtiene la conexion de la base de datos
		$connection = getConnection();
		//prepara la consulta
		$db = $connection->prepare("SELECT * FROM productos");
		//ejecuta la consulta
		$db->execute();
		//obtiene todos los resultados de la consulta
		$productos = $db->fetchAll(PDO::FETCH_OBJ);
		//se cierra la conexion de la base de datos
		$connection = null;
		//evalua si la consulta retorno datos
		if(count($productos) > 0){
			//se define el estado del http
			$app->response->status(200);
			//retorna la respuesta en formato json
			$app->response->body(json_encode($productos));
		}else{
			//se define el estado del http
			$app->response->status(200);
			//retorna la respuesta en formato json
			$app->response->body(json_encode(getMessage('productos',0)));
		}
	});

	//retorna un solo producto segun el codigo
	$app->get('/productos/:id',function($id) use ($app){
		//obtiene la conexion de la base de datos
		$connection = getConnection();		
		$db = $connection->prepare("SELECT * FROM productos WHERE id_producto = ?");
		$db->bindParam(1,$id);
		$db->execute();
		
		$productos = $db->fetchAll(PDO::FETCH_OBJ);
		
		//evalua si la consulta retorno datos
		if(count($productos) > 0){		
			$app->response->status(200);		
			$app->response->body(json_encode($productos[0]));
		}else{			
			$app->response->status(200);			
			$app->response->body(json_encode(getMessage('productos',2)));
		}
	});	

	// Ruta para agreagar productos nuevos
	$app->post('/productos',function() use($app){		
		$nombre = $app->request->post("nombre");				
		$descripcion = $app->request->post("descripcion");
		$precio = $app->request->post("precio");
		$imagen = $app->request->post("imagen");

		try{
			// Se verifica que no exista el nombre nuevo
			$connection = getConnection();
			$db = $connection->prepare("SELECT nombre FROM productos WHERE nombre = ?");
			$db->bindParam(1, $nombre);
			$db->execute();
			$productos = $db->fetchAll(PDO::FETCH_OBJ);
			$connection = null;

			if(count($productos) > 0){
				// mandamos respuesta y mensaje de que existe ya el codigo
				$app->response->status(200);
				$app->response->body(json_encode(getMessage('productos',3)));
			}else{
				// Proceso de insercion
				$connection = getConnection();
				$db = $connection->prepare("INSERT INTO productos VALUES(null, ?, ?, ?, ?)");
				$db->bindParam(1, $nombre);
				$db->bindParam(2, $descripcion);
				$db->bindParam(3, $precio);
				$db->bindParam(4, $imagen);
				$db->execute();
				$connection = null;

				// respuesta y mensaje
				$app->response->status(200);
				$app->response->body(json_encode(getMessage('productos',4)));
			}
		}
		catch(PDOException $e){
			echo "Errors:".$e->getMessage();
			$app->response->status(200);
			$app->response->body(json_encode(getMessage('general',0)));
		}
	});

	//Elimina un producto de la db apartir de su id
    $app->delete('/productos/:id', function($id) use ($app) {
  		//Conecta a la db
    	$connection = getConnection();
		
		$db = $connection->prepare("SELECT * FROM productos WHERE id_producto = ?");
		$db->bindParam(1, $id);
		$db->execute();

		$productos = $db->fetchAll(PDO::FETCH_OBJ);
		        
        if(count($productos) >0) {
        
            try {
                $db = $connection->prepare("DELETE FROM productos WHERE id_producto = ?");
                $db->bindParam(1, $id);
                $db->execute();

                $app->response->status(200);
                $app->response->body(json_encode(getMessage('productos',5)));
        
            } catch(PDOException $e) {
            	$app->response->status(200);
                $app->response->body(json_encode(getMessage('productos',6)));
            }
        }else{
        	$app->response->status(200);
            $app->response->body(json_encode(getMessage('productos',7)));
        }        
        //Limpiamos la conexion a la db
        $connection = null;
    });

	//Actualiza un producto de la db apartir de su id
    $app->post('/productos/:id', function($id) use ($app) {
    	
		$nombre = $app->request->put("nombre");		
		$descripcion = $app->request->put("descripcion");
		$precio = $app->request->put("precio");
		$imagen = $app->request->put("imagen");

  		//Conecta a la db
    	$connection = getConnection();
		
		$db = $connection->prepare("SELECT * FROM productos WHERE id_producto = ?");
		$db->bindParam(1, $id);
		$db->execute();
		$productos = $db->fetchAll(PDO::FETCH_OBJ);

		if(count($productos) > 0){						
			try{
				$db = $connection->prepare("UPDATE productos SET nombre = ?, descripcion = ?, precio = ?, imagen = ? WHERE id_producto =?");				
				$db->bindParam(1, $nombre);
				$db->bindParam(2, $descripcion);
				$db->bindParam(3, $precio);
				$db->bindParam(4, $imagen);
				$db->bindParam(5, $id);
				$db->execute();				
				$app->response->status(200);
				$app->response->body(json_encode(getMessage('productos',8)));
			} catch(PDOException $e){
				echo "Error:".$e->getMessage();
				$app->response->status(200);
				$app->response->body(json_encode(getMessage('general',0)));
			}
			
		}else{
			$app->response->status(200);
			$app->response->body(json_encode(getMessage('productos',2)));
		}

        //Limpiamos la conexion a la db
        $connection = null;
    });

	######################################################################
	##                                                                  ##
	##					/* CRUD TABLA CATEGORIAS	*/					##
	##                                                                  ##
	######################################################################


	//retorna todos los productos dentro de la base de datos
	$app->get('/categories',function() use ($app){
		//obtiene la conexion de la base de datos
		$connection = getConnection();
		//prepara la consulta
		$db = $connection->prepare("SELECT * FROM categories");
		//ejecuta la consulta
		$db->execute();
		//obtiene todos los resultados de la consulta
		$categories = $db->fetchAll(PDO::FETCH_OBJ);
		//se cierra la conexion de la base de datos
		$connection = null;
		//evalua si la consulta retorno datos
		if(count($categories) > 0){
			//se define el estado del http
			$app->response->status(200);
			//retorna la respuesta en formato json
			$app->response->body(json_encode($categories));
		}else{
			//se define el estado del http
			$app->response->status(200);
			//retorna la respuesta en formato json
			$app->response->body(json_encode(getMessage('productos',0)));
		}
	});

	//retorna un solo producto segun el codigo
	$app->get('/categories/:id',function($id) use ($app){
		//obtiene la conexion de la base de datos
		$connection = getConnection();		
		$db = $connection->prepare("SELECT * FROM categories WHERE id_category = ?");
		$db->bindParam(1,$id);
		$db->execute();
		
		$categories = $db->fetchAll(PDO::FETCH_OBJ);
		
		//evalua si la consulta retorno datos
		if(count($categories) > 0){		
			$app->response->status(200);		
			$app->response->body(json_encode($categories[0]));
		}else{			
			$app->response->status(200);			
			$app->response->body(json_encode(getMessage('productos',2)));
		}
	});	

	// Ruta para agreagar productos nuevos
	$app->post('/categories',function() use($app){		
		$nombre = $app->request->post("nombre");

		try{
			// Se verifica que no exista el codigo nuevo
			$connection = getConnection();
			$db = $connection->prepare("SELECT nombre FROM categories WHERE nombre = ?");
			$db->bindParam(1, $nombre);
			$db->execute();
			$categories = $db->fetchAll(PDO::FETCH_OBJ);
			$connection = null;

			if(count($categories) > 0){
				// mandamos respuesta y mensaje de que existe ya el codigo
				$app->response->status(200);
				$app->response->body(json_encode(getMessage('productos',3)));
			}else{
				// Proceso de insercion
				$connection = getConnection();
				$db = $connection->prepare("INSERT INTO categories VALUES(null, ?)");
				$db->bindParam(1, $nombre);				
				$db->execute();
				$connection = null;

				// respuesta y mensaje
				$app->response->status(200);
				$app->response->body(json_encode(getMessage('productos',4)));
			}
		}
		catch(PDOException $e){
			echo "Error:".$e->getMessage();
			$app->response->status(200);
			$app->response->body(json_encode(getMessage('general',0)));
		}
	});

	//Elimina un producto de la db apartir de su id
    $app->delete('/categories/:id', function($id) use ($app) {
  		//Conecta a la db
    	$connection = getConnection();
		
		$db = $connection->prepare("SELECT * FROM categories WHERE id_category = ?");
		$db->bindParam(1, $id);
		$db->execute();

		$categories = $db->fetchAll(PDO::FETCH_OBJ);
		        
        if(count($categories) >0) {
        
            try {
                $db = $connection->prepare("DELETE FROM categories WHERE id_category = ?");
                $db->bindParam(1, $id);
                $db->execute();

                $app->response->status(200);
                $app->response->body(json_encode(getMessage('productos',5)));
        
            } catch(PDOException $e) {
            	$app->response->status(200);
                $app->response->body(json_encode(getMessage('productos',6)));
            }
        }else{
        	$app->response->status(200);
            $app->response->body(json_encode(getMessage('productos',7)));
        }        
        //Limpiamos la conexion a la db
        $connection = null;
    });

	//Actualiza un producto de la db apartir de su id
    $app->post('/categories/:id', function($id) use ($app) {
    	
		$nombre = $app->request->put("nombre");		

  		//Conecta a la db
    	$connection = getConnection();
		
		$db = $connection->prepare("SELECT * FROM categories WHERE id_category = ?");
		$db->bindParam(1, $id);
		$db->execute();
		$categories = $db->fetchAll(PDO::FETCH_OBJ);

		if(count($categories) > 0){						
			try{
				$db = $connection->prepare("UPDATE categories SET nombre = ? WHERE id_category = ?");
				$db->bindParam(1, $nombre);				
				$db->bindParam(2, $id);
				$db->execute();				
				$app->response->status(200);
				$app->response->body(json_encode(getMessage('productos',8)));
			} catch(PDOException $e){
				echo "Error:".$e->getMessage();
				$app->response->status(200);
				$app->response->body(json_encode(getMessage('general',0)));
			}
			
		}else{
			$app->response->status(200);
			$app->response->body(json_encode(getMessage('productos',2)));
		}

        //Limpiamos la conexion a la db
        $connection = null;
    });




?>