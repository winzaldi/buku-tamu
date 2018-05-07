<?

class Db {
    private static $instance = NULL;

    private function __construct() {
    }

    private function __clone() {
    }

    public static function getInstance() {
        if (!isset(self::$instance)) {
            $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
            try {
                self::$instance = new PDO('mysql:dbname=' . DATABASE_NAME . ';host=' . DATABASE_HOST, DATABASE_LOGIN, DATABASE_PASSWORD, $pdo_options);
            } catch (PDOException $exception) {
                echo $exception->getMessage();
            }
        }
        return self::$instance;
    }

    public static function userIsRegistered($email, $password) {
        if (!isset(self::$instance)) {
            self::$instance = self::getInstance();
        }
        $sql = 'SELECT password_hash FROM user WHERE email = :email';
        $stmt = self::$instance->prepare($sql);
        $stmt->execute(array(':email' => $email));
        if ($stmt->rowCount() == 1) {
            if (password_verify($password, $stmt->fetchColumn())) {
                return true;
            }
        }
        return false;
    }

    public static function getUserName($email) {
        if (!isset(self::$instance)) {
            self::$instance = self::getInstance();
        }
        $sql = 'SELECT name FROM user WHERE email = :email';
        $stmt = self::$instance->prepare($sql);
        $stmt->execute(array(':email' => $email));
        if ($stmt->rowCount() == 1) {
            return $stmt->fetchColumn();
        }
        return null;
    }

    public static function getUserRole($email) {
        if (!isset(self::$instance)) {
            self::$instance = self::getInstance();
        }
        $sql = 'SELECT role FROM user WHERE email = :email';
        $stmt = self::$instance->prepare($sql);
        $stmt->execute(array(':email' => $email));
        if ($stmt->rowCount() == 1) {
            return $stmt->fetchColumn();
        }
        return null;
    }
}
