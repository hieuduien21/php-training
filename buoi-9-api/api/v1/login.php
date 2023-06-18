<?php
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, X-Requested-With");

require_once __DIR__ . '/Authenticate.php';

class LoginUser
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

    public function LoginUser()
    {
        $result = [
            "code" => 400,
            "message" => "something wrong, login fail"
        ];

        try {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $data = file_get_contents("php://input");
                $data = json_decode($data);

                if ($data->password) {
                    $data->password = md5($data->password);
                }

                $pdo = $this->pdo;

                $data = (array) $data;

                foreach (array_keys($data) as $item) {
                    $placeholder[] = "$item=:$item";
                }

                $stmt = $pdo->prepare("SELECT id, name, email, roll FROM users WHERE " . implode(' AND ', $placeholder));
                $stmt->execute($data); 
                $user = $stmt->fetch(PDO::FETCH_OBJ); 

                if ($user) {
                    $authenticate = new Authenticate();
                    $token = $authenticate->createToken($user);
                    $result = [
                        "code" => 200,
                        "message" => "login success",
                        "token" => $token,
                        "data" => $user                                      
                    ];
                } else {
                    $result = [
                        "code" => 202,
                        "message" => "login fails, email or password is not correct"                     
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

$userLogin = new LoginUser();

$userLogin->LoginUser();
