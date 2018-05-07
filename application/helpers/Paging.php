<?

class Paging {

    private $page;
    private $total_pages;
    private $buttons_limit;
    private $start_page;
    private $end_page;

    function __construct($page) {
        if (!isset($_SESSION['page'])) {
            $_SESSION['page'] = 1;
        }
        $this->setTotalPages($this->getTotalPagesFromDb());
        $this->setPage($page);
        $this->buttons_limit = 2;
        $this->setStartPage();
        $this->setEndPage();
    }

    private function getTotalPagesFromDb() {
        $db = Db::getInstance();
        $sql = "SELECT COUNT(*) FROM record";
        $sth = $db->prepare($sql);
        $sth->execute();
        $total_records = $sth->fetchColumn();
        $total_pages = ceil($total_records / __ITEMS_PER_PAGE__);

        return $total_pages;
    }

    public function getPage() {
        return $this->page;
    }

    public function setPage($page) {
        if (isset($page) && $page >= 1 && $page <= $this->total_pages) {
            $this->page = $page;
        } else {
            $this->page = $_SESSION['page'];
        }
        $_SESSION['page'] = $this->getPage();
    }

    public function getTotalPages() {
        return $this->total_pages;
    }

    private function setTotalPages($total_pages) {
        $this->total_pages = $total_pages;
    }

    public function getButtonsLimit() {
        return $this->buttons_limit;
    }

    public function getStartPage() {
        return $this->start_page;
    }

    private function setStartPage() {
        $this->start_page = 1;
        if ($this->page - $this->buttons_limit > 1) {
            $this->start_page = $this->page - $this->buttons_limit;
        }
    }

    public function getEndPage() {
        return $this->end_page;
    }

    private function setEndPage() {
        $this->end_page = $this->getTotalPages();
        if ($this->page + $this->buttons_limit < $this->total_pages) {
            $this->end_page = $this->page + $this->buttons_limit;
        }
    }

}
