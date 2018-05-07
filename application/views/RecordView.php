<?

class RecordView {

    private $model;
    private $paging;
    private $sorting;

    function __construct($model, $paging, $sorting) {
        $this->model = $model;
        $this->paging = $paging;
        $this->sorting = $sorting;
    }

    function output($exceptionMessage = '') {
        require __ROOT__ . '/application/views/pages/header.php';
        require __ROOT__ . '/application/views/pages/record/index.php';
        require __ROOT__ . '/application/views/pages/record/pagination.php';
        require __ROOT__ . '/application/views/pages/footer.php';
    }
}
