<?php

use Psr\Container\ContainerInterface;

class HomeController {
    protected $container;

    public function __construct(ContainerInterface $container) {
        $this->container = $container;
    }

    public function name ($request, $response, $args) {
        $name = $args["name"];
        $response->getBody()->write("Ssup, $name");
        return $response;
    }

    public function getCustId ($request, $response, $args) {
        $id = $request->getAttribute('id');
        $sql = "SELECT * FROM customers WHERE id = $id";

        try {
            $db = new db();
            // $db->query($sql);
            $db = $db->connect();

            $stmt = $db->query($sql);

            $customer = $stmt->fetchAll(PDO::FETCH_OBJ);
            $db = null;
            echo json_encode($customer);

        } catch (PDOException $e) {
            echo '{"error": "text": '.$e->getMessage().'}';
        }
    }

    public function custAdd ($request, $response, $args) {
        $first_name = $request->getParam('first_name');
        $last_name = $request->getParam('last_name');
        $address = $request->getParam('address');

        $sql = "INSERT INTO customers (first_name,last_name,address) VALUES (:first_name, :last_name, :address)";

        try {
            $db = new db();
            $db = $db->connect();

            $stmt = $db->prepare($sql);
            $stmt->bindParam(':first_name', $first_name);
            $stmt->bindParam(':last_name', $last_name);
            $stmt->bindParam(':address', $address);

            $stmt->execute();

         echo `{"notice": {"text": }`;
        } catch (PDOException $e) {
            echo '{"error": "text": '.$e->getMessage().'}';
        }
    }

    public function custLogin ($request, $response, $args) {
        $first_name = $request->getParam('first_name');
        $last_name = $request->getParam('last_name');
        $address = $request->getParam('address');
        $id = $request->getAttribute('id');

        $sql = "SELECT * FROM customers WHERE id = '$id'";

        try {
            $db = new db();
            $db = $db->connect();

            $stmt = $db->query($sql);
            $customer = $stmt->fetchAll(PDO::FETCH_OBJ);
            $db = null;


            if(sizeof($customer)>0){
                echo json_encode($customer);
             }else{
                 echo "customer does not exist";
             }
             //echo json_encode($customer);
            
        } catch (PDOException $e) {
            echo '{"error": "text": '.$e->getMessage().'}';
        }
    }

    public function custRegister ($request, $response, $args) {
        $first_name = $request->getParam('first_name');
        $phone_number = $request->getParam('phone_number');
        $pass = $request->getParam('pass');
        $hashed_pass = password_hash($pass, PASSWORD_DEFAULT);

        $sql = "INSERT INTO customer_login (first_name, phone_number, pass) VALUES (:first_name, :phone_number, :pass)";

        try {
            $db = new db();
            $db = $db->connect();

            $stmt = $db->prepare($sql);
            $stmt->bindParam(":first_name", $first_name);
            $stmt->bindParam(":phone_number", $phone_number);
            $stmt->bindParam(":pass", $hashed_pass);

            $stmt->execute();

        } catch (PDOException $e) {
            echo '{"error": "text": '.$e->getMessage().'}';
        }
    }

    public function Login ($request, $response, $args) {
        $first_name = $request->getParam('first_name');
        $phone_number = $request->getParam('phone_number');
        $pass = $request->getParam('pass');

        $sql = "SELECT * FROM customer_login WHERE phone_number = '$phone_number'";

        try {
            $db = new db();
            $db = $db->connect();

            $stmt = $db->query($sql);
            $customer = $stmt->fetchAll(PDO::FETCH_OBJ);
            $db = null;
            // $cust = json_decode($customer[0]->pass);
            //     echo json_decode($cust);

            if(sizeof($customer)>0){

                $cust = json_encode($customer[0]->pass);
                $hash = json_decode($cust);
                     
                if(password_verify($pass, $hash)){ 
                    // echo "Login accepted";



                }else{
                    echo "Invalid login";
                }
             }else{
                 echo "customer does not exist";
             }

        } catch (PDOException $e) {
            echo '{"error": "text": '.$e->getMessage().'}';
        }  

    }
}