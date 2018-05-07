<?

class RecordController {

    private $model;
    private $view;

    function __construct() {
        require_once(__ROOT__ . '/application/models/RecordModel.php');
        require_once(__ROOT__ . '/application/views/RecordView.php');
    }

    function index($paging, $sorting, $exceptionMessage = '') {
        $this->model = RecordModel::getAll($paging->getPage(), $sorting->getSortColumn(), $sorting->getSortOrder());
        $this->view = new RecordView($this->model, $paging, $sorting);
        $this->view->output($exceptionMessage);
    }

    function save($name, $address, $instansi, $jabatan, $kesan,$pesan) {
        //print_r($name.'|'. $address.'|'. $instansi.'|'. $jabatan.'|'. $kesan.'|'.$pesan);
        //die();
        RecordModel::save($name, $address, $instansi, $jabatan, $kesan,$pesan);
    }

    function editColumns($id, $name, $address, $instansi, $jabatan, $kesan,$pesan) {
        RecordModel::updateColumns($id, $name, $address, $instansi, $jabatan, $kesan,$pesan);
    }

    function editColumn($id, $column, $value) {
        RecordModel::updateColumn($id, $column, $value);
    }

    function remove($id) {
        RecordModel::remove($id);
    }
}
