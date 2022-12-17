<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

$app = new \Slim\App;

$app->options('/{routes:.+}', function ($request, $response, $args) {
    return $response;
});

$app->add(function ($req, $res, $next) {
    $response = $next($req, $res);
    return $response
            ->withHeader('Access-Control-Allow-Origin', '*')
            ->withHeader('Access-Control-Allow-Headers', 'X-Requested-With, Content-Type, Accept, Origin, Authorization')
            ->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS');
});

//get all products
$app->get('/products/all', function (Request $request, Response $response) {
    $sql = "SELECT * FROM products";
    try{
        $db = new db();
        $db = $db->connect();

        $stmt = $db->query($sql);
        $products = $stmt->fetchAll(PDO::FETCH_OBJ);
        $db = null;
        echo json_encode($products);
    }
    catch(PDOException $e){
        echo '{"error": {"text": '.$e->getMessage().'}';
    }
});

//get single product
$app->get('/products/{id}', function (Request $request, Response $response) {
    $id = $request->getAttribute('id');
    $sql = "SELECT * FROM products WHERE id = $id";

    try{
        $db = new db();
        $db = $db->connect();

        $stmt = $db->query($sql);
        $products = $stmt->fetch(PDO::FETCH_OBJ);
        $db = null;
        echo json_encode($products);
    }
    catch(PDOException $e){
        echo '{"error": {"text": '.$e->getMessage().'}';
    }
});

//add product
$app->post('/products/add', function(Request $request, Response $response){
    $title = $request->getParam('title');
    $description = $request->getParam('description');
    $image = $request->getParam('image');
    $price = $request->getParam('price');

    $sql = "INSERT INTO products (title, description, image, price) VALUES
    (:title, :description, :image, :price)";

    try{
        // Get DB Object
        $db = new db();
        // Connect
        $db = $db->connect();

        $stmt = $db->prepare($sql);

        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':image', $image);
        $stmt->bindParam(':price', $price);

        $stmt->execute();

        echo '{"notice": {"text": "Product Added"}';

    } catch(PDOException $e){
        echo '{"error": {"text": '.$e->getMessage().'}';
    }
});

//update product
$app->put('/products/update/{id}', function(Request $request, Response $response){
    $id = $request->getAttribute('id');

    $title = $request->getParam('title');
    $description = $request->getParam('description');
    $image = $request->getParam('image');
    $price = $request->getParam('price');

    $sql = "UPDATE products SET
        title = :title,
        description = :description,
        image = :image,
        price = :price
        WHERE id = $id";

    try{
        // Get DB Object
        $db = new db();
        // Connect
        $db = $db->connect();

        $stmt = $db->prepare($sql);

        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':image', $image);
        $stmt->bindParam(':price', $price);

        $stmt->execute();

        echo '{"notice": {"text": "Product Updated"}';

    } catch(PDOException $e){
        echo '{"error": {"text": '.$e->getMessage().'}';
    }
});

//delete product
$app->delete('/products/delete/{id}', function(Request $request, Response $response) {

    $id = $request->getAttribute('id');

    $sql = "DELETE FROM products WHERE id = $id";

    try{
        $db = new db();

        $db = $db->connect();

        $stmt = $db->prepare($sql);
        $stmt->execute();
        $db = null;
        echo '{"notice": {"text": "Product Deleted"}';
    }
    catch(PDOException $e){
        echo '{"error": {"text": '.$e->getMessage().'}';
    }
});