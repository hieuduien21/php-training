<?php
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, X-Requested-With");

require_once __DIR__ . '/Authenticate.php';

class ListNews
{
    private $pdo;

    public function __construct()
    {
        $host = '127.0.0.1';
        $db   = 'api_demo';
        $user = 'root';
        $pass = 'root';
        $port = "3306";
        $charset = 'utf8mb4';

        $dsn = "mysql:host=$host;dbname=$db;charset=$charset;port=$port";

        try {
            $this->pdo = new \PDO($dsn, $user, $pass);
        } catch (\PDOException $e) {
            throw new \PDOException($e->getMessage(), (int)$e->getCode());
        }
    }

    public function getListNews()
    {
        $result = [
            "code" => 400,
            "message" => "something wrong, get list fails"
        ];

        try {
            if ($_SERVER['REQUEST_METHOD'] === 'GET') {
                $jwt = $_SERVER['HTTP_AUTHORIZATION'];
                $jwt = explode(' ', $jwt);
                $jwt = end($jwt);
             
                $authenticate = new Authenticate();
                $tokenValid = $authenticate->validateToken($jwt);
                if ($tokenValid) {
                    $pdo = $this->pdo;

                    $stmt = $pdo->query("SELECT id, title, description, image FROM news");  
                    $news = $stmt->fetchAll(PDO::FETCH_OBJ);

                    $result = [
                        "code" => 200,
                        "message" => "success",
                        "data" => $news                                      
                    ]; 
                } else {
                    $result = [
                        "code" => 400,
                        "message" => "token no valid",
                        "data" => []                                      
                    ]; 
                } 
            } else {
                $result = [
                    "code" => 400,
                    "message" => "bad request"
                ];
            }

            echo json_encode($result);
            exit();
        } catch (Exception $e) {
            $result = [
                "code" => 500,
                "message" => 'Caught exception: ',  $e->getMessage(), "\n"
            ];
            echo json_encode($result);
            exit();
        }
    }
}

$list = new ListNews();

$list->getListNews();
