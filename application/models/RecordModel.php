<?
error_reporting(E_ALL);

class RecordModel {
    private $id;
    private $date;
    private $name;
    private $address;
    private $instansi;
    private $jabatan;
    private $pesan;
    private $kesan;
    private $ip;

    function __construct($id, $date, $name, $address, $instansi, $jabatan, $kesan,$pesan, $ip) {
        $this->setId($id);
        $this->setDate($date);
        $this->setName($name);
        $this->setAddress($address);
        $this->setInstansi($instansi);
        $this->setJabatan($jabatan);
        $this->setKesan($kesan);
        $this->setPesan($pesan);
        $this->setIp($ip);
    }

    static function getOne($id) {
        $sql = 'SELECT * FROM record WHERE id = :id';
        $db = Db::getInstance();
        $stmt = $db->prepare($sql);
        $stmt->execute(array(
            'id' => $id,
        ));

        if ($stmt->rowCount() == 1) {
            $row = $stmt->fetch();
            return new RecordModel(
                $row["id"],
                $row["date"],
                $row["name"],
                $row["address"],
                $row["instansi"],
                $row["jabatan"],
                $row["kesan"],
                $row["pesan"],
                $row["ip"]
            );
        }
        return null;
    }

    static function getAll($page, $sort_column, $sort_order) {
        $offset = __ITEMS_PER_PAGE__ * ($page - 1);
        $sql = 'SELECT * FROM record ORDER BY ' . $sort_column . ' ' . $sort_order . ' LIMIT ' . __ITEMS_PER_PAGE__ . ' OFFSET ' . $offset;
        $db = Db::getInstance();
        $stmt = $db->prepare($sql);
        $stmt->execute();

        $records = array();
        foreach ($stmt as $record) {
            $record = new RecordModel(
                $record["id"],
                $record["date"],
                $record["name"],
                $record["address"],
                $record["instansi"],
                $record["jabatan"],
                $record["kesan"],
                $record["pesan"],
                $record["ip"]
            );
            array_push($records, $record);
        }

        return $records;
    }

    static function save($name, $address, $instansi, $jabatan, $kesan,$pesan) {
        date_default_timezone_set('Asia/Jakarta');

        $record = new RecordModel(
            null,
            date("Y-m-d H:i:s"),
            $name,
            $address,
            $instansi,
            $jabatan,
            $kesan,
            $pesan,
            $_SERVER['REMOTE_ADDR']);

        if (empty($record->name) || empty($record->address) || empty($record->instansi)) {
            throw new Exception('Error submitting record: one or few required fields are empty!');
        }



        $sql = 'INSERT INTO record (date, name, address, instansi, jabatan, kesan,pesan, ip)
                VALUES (:date, :name, :address, :instansi, :jabatan,:kesan , :pesan, :ip)';
        $db = Db::getInstance();
        $stmt = $db->prepare($sql);
        $data = array(
            'date' => $record->date,
            'name' => $record->name,
            'address' => $record->address,
            'instansi' => $record->instansi,
            'jabatan' => $record->jabatan,
            'kesan' => $record->kesan,
            'pesan' => $record->pesan,
            'ip' => $record->ip
        );

        $stmt->execute($data);
    }

    static function updateColumns($id, $name, $address, $instansi, $jabatan, $kesan,$pesan) {
        $record = new RecordModel(
            $id,
            null,
            $name,
            $address,
            $instansi,
            $jabatan,
            $kesan,
            $pesan,
            null
        );

        if (empty($record->name) || empty($record->address) || empty($record->instansi)) {
            throw new Exception('Error submitting record: one or few required fields are empty!');
        }

        $sql = 'UPDATE record SET name = :name, address = :address, instansi = :instansi, jabatan = :jabatan,kesan = :kesan ,pesan = :pesan WHERE id = :id';
        $db = Db::getInstance();
        $stmt = $db->prepare($sql);
        $stmt->execute(array(
            ':name' => $record->name,
            ':address' => $record->address,
            ':instansi' => $record->instansi,
            ':jabatan' => $record->jabatan,
            ':kesan' => $record->kesan,
            ':pesan' => $record->pesan,
            ':id' => $record->id
        ));
    }

    static function updateColumn($id, $column, $value) {
        if (!in_array($column, ['name', 'address', 'instansi', 'jabatan','kesan','pesan'])) {
            throw new Exception('Error updating record: invalid column name!');
        }
        $record = self::getOne($id);
        if ($record == null) {
            throw new Exception('Error updating record: record not found!');
        }
        $record->{'set' . ucfirst($column)}($value);
        $value = $record->{'get' . ucfirst($column)}();
        $sql = 'UPDATE record SET ' . $column . ' = :value WHERE id = :id';
        $db = Db::getInstance();
        $stmt = $db->prepare($sql);
        $stmt->execute(array(
            ':value' => $value,
            ':id' => $id
        ));
    }

    static function remove($id) {
        $sql = 'DELETE FROM record WHERE id = :id';
        $db = Db::getInstance();
        $stmt = $db->prepare($sql);
        $stmt->execute(array(':id' => $id));
    }

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getDate() {
        return $this->date;
    }

    public function setDate($date) {
        $this->date = $date;
    }

    public function getName() {
        return $this->name;
    }

    public function setName($name) {
        $res = trim(strip_tags($name));
        if (empty($res)) {
            throw new Exception('Error! Name can not be empty!');
        }
        $this->name = $res;
    }

    public function getAddress() {
        return $this->address;
    }

    public function setAddress($address) {
        $res = trim(strip_tags($address));
        if (empty($res)) {
            throw new Exception('Error! Address can not be empty!');
        }
        $this->address = $res;
    }

    public function getInstansi() {
        return $this->instansi;
    }

    public function setInstansi($instansi) {
        $res = trim(strip_tags($instansi));
        if (empty($res)) {
            throw new Exception('Error! Instansi can not be empty!');
        }
        $this->instansi = $res;
    }


    public function getJabatan() {
        return $this->jabatan;
    }

    public function setJabatan($jab) {
        $res = trim(strip_tags($jab));
        if (empty($res)) {
            throw new Exception('Error! Jabatan can not be empty!');
        }
        $this->jabatan = $res;
    }

    public function getPesan() {
        return $this->pesan;
    }

    public function setPesan($pesan) {
        $res = trim(strip_tags($pesan));
        if (empty($res)) {
            throw new Exception('Error! Pesan can not be empty!');
        }
        $this->pesan = $res;
    }


    public function getKesan() {
        return $this->kesan;
    }

    public function setKesan($kesan) {
        $res = trim(strip_tags($kesan));
        if (empty($res)) {
            throw new Exception('Error! Kesan can not be empty!');
        }
        $this->kesan = $res;
    }

    public function getIp() {
        return $this->ip;
    }

    public function setIp($ip) {
        $res = trim(strip_tags($ip));
        if (empty($res)) {
            throw new Exception('Error! IP can not be empty!');
        }
        $this->ip = $res;
    }






}
