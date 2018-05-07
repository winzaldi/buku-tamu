<?

session_start();
define('__ROOT__', dirname(__FILE__));
error_reporting(E_ALL);
require_once(__ROOT__ . '/application/libs/simple_captcha/simple-php-captcha.php');
require_once(__ROOT__ . '/application/helpers/Constants.php');
require_once(__ROOT__ . '/application/controllers/RecordController.php');
require_once(__ROOT__ . '/application/helpers/Db.php');
require_once(__ROOT__ . '/application/helpers/Paging.php');
require_once(__ROOT__ . '/application/helpers/Sorting.php');

$controller = new RecordController();
if (isset($_GET['action'])) {
    try {
        if ($_GET['action'] == 'save') {
            $controller->save($_POST['name'], $_POST['address'], $_POST['instansi'], $_POST['jabatan'], $_POST['kesan'],$_POST['pesan']);
        }
        if ($_GET['action'] == 'login') {
            if (isset($_POST['email']) && isset($_POST['password'])) {
                if (Db::userIsRegistered($_POST['email'], $_POST['password'])) {
                    $_SESSION['loggedin'] = true;
                    $_SESSION['email'] = $_POST['email'];
                } else {
                    throw new Exception('Login error: invalid username or password.');
                }
            }
        }
        if ($_GET['action'] == 'logout') {
            // session_destroy();
            unset($_SESSION["loggedin"]);
            unset($_SESSION["email"]);
        }
        if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true && Db::getUserRole($_SESSION['email']) == 'admin') {
            if ($_GET['action'] == 'edit') {
                // $controller->editColumns($_GET['id'], $_GET['name'], $_GET['email'], $_GET['website'], $_GET['message']);
                $controller->editColumn($_GET['id'], $_GET['column'], $_GET['value']);
            }
            if ($_GET['action'] == 'remove') {
                $controller->remove($_GET['id']);
            }
        }
    } catch (Exception $e) {
        if(isset($_GET['type']) && $_GET['type'] == 'ajax') {
            header('Content-Type: application/json; charset=UTF-8');
            die(json_encode(array('error' => array('msg' => $e->getMessage(),'code' => $e->getCode()))));
        } else {
            $exceptionMessage = $e->getMessage();
        }
    }
}
$paging = new Paging($_GET['page']);
$sorting = new Sorting($_GET['sort'], $_GET['order']);
$controller->index($paging, $sorting, $exceptionMessage);
