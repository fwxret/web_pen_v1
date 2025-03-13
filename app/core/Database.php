<?php
class Database {
    public $con;
    protected $servername = "localhost";
    protected $username = "root";
    protected $password = "";
    protected $dbname = "web_pen_v1";

    function __construct() {
        mysqli_report(MYSQLI_REPORT_OFF); // Tắt báo lỗi mặc định
        $this->con = new mysqli($this->servername, $this->username, $this->password, $this->dbname);

        if ($this->con->connect_error) {
            die("Database connection failed.");
        }
    }

    // Thực thi truy vấn SQL và bắt lỗi
    public function query($sql) {
        try {
            $result = $this->con->query($sql);
            return $result ?: false;
        } catch (mysqli_sql_exception $e) {
            return false; // Trả về false thay vì crash
        }
    }

    // Lấy tất cả dữ liệu từ một truy vấn
    public function fetchAll($sql) {
        $result = $this->query($sql);
        return $result ? $result->fetch_all(MYSQLI_ASSOC) : [];
    }

    // Lấy một dòng dữ liệu duy nhất từ truy vấn
    public function fetchOne($sql) {
        $result = $this->query($sql);
        return $result ? $result->fetch_assoc() : null;
    }

    // Đóng kết nối khi đối tượng bị hủy
    function __destruct() {
        if ($this->con) {
            $this->con->close();
        }
    }
}
?>
