<?

class Sorting {

    private $sort_column;
    private $sort_order;

    public function __construct($sort_column, $sort_order) {
        if (!isset($_SESSION['sort'])) {
            $_SESSION['sort'] = 'date';
        }
        if (!isset($_SESSION['order'])) {
            $_SESSION['order'] = 'desc';
        }
        $this->setSortColumn($sort_column);
        $this->setSortOrder($sort_order);
    }

    public function getSortColumn() {
        return $this->sort_column;
    }

    public function setSortColumn($sort_column) {
        if (isset($sort_column) && in_array($sort_column, ['date', 'name', 'email'])) {
            $this->sort_column = $sort_column;
        } else {
            $this->sort_column = $_SESSION['sort'];
        }
        $_SESSION['sort'] = $this->sort_column;
    }

    public function getSortOrder() {
        return $this->sort_order;
    }

    public function setSortOrder($sort_order) {
        if (isset($sort_order) && in_array($sort_order, ['asc', 'desc'])) {
            $this->sort_order = $sort_order;
        } else {
            $this->sort_order = $_SESSION['order'];
        }
        $_SESSION['order'] = $this->sort_order;
    }

}