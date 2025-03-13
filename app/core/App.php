<?php
class App {
  protected $controller = "home";   // Controller mặc định
  protected $action = "index";      // Action mặc định
  protected $params = [];           // Tham số mặc định

  function __construct() {
      $arr = $this->URLProcess();
      
      // Kiểm tra nếu controller tồn tại
      if ( isset($arr[0]) && file_exists('./app/controllers/' . $arr[0] . '.php')) {
          $this->controller = $arr[0]; // Gán controller từ URL
          unset($arr[0]);
      }
      
      // Require file controller
      require_once './app/controllers/' . $this->controller . '.php';

      $this->controller = new $this->controller;

      // Kiểm tra action trong URL và gán
      if (isset($arr[1])) {
          if (method_exists($this->controller, $arr[1])) {
              $this->action = $arr[1];
          }
          unset($arr[1]);
      }
      
      //Params
      $this -> params = $arr?array_values($arr):[];
    
      call_user_func_array([$this->controller, $this->action], $this->params);
  }

  function URLProcess() {
      // Phân tích URL và trả về mảng
      if (isset($_GET['url'])) {
          return explode("/", filter_var(trim($_GET['url'], "/")));
      }
  }
}

define('URLROOT', 'http://localhost/web_pen_v1');
?>