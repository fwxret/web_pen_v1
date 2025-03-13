<?php
class Blog extends Controller {
    private $blogModel;

    public function __construct() {
        $this->blogModel = $this->model("BlogModel");  // Gọi model
    }

    public function index() {
        $blogs = $this->blogModel->getAllBlogs(); // Lấy danh sách blog từ database

        $this->view("layout", [
            "contentFile" => "pages/blog",
            "title" => "Blog",
            "blogs" => $blogs  
        ]);       
    }

    public function detail($slug) {
        $blog = $this->blogModel->getBlogBySlug($slug);
        
        if (!$blog) {
            die("Blog not found!");
        }
    
        // 🔥 Lấy danh sách bình luận theo `blog_id`
        $comments = $this->blogModel->getCommentsByBlogId($blog['id']);
    
        $this->view("layout", [
            "contentFile" => "pages/blog_detail",
            "title" => $blog['title'],
            "blog" => $blog,
            "comments" => $comments // Truyền danh sách comments vào view
        ]);
    }
    
    public function addComment() {
        $db = new Database();
    
        // Lấy dữ liệu từ POST và escape để tránh lỗi SQL Injection
        $blog_id = $db->con->real_escape_string($_POST['blog_id']);
        $slug = $db->con->real_escape_string($_POST['slug']); // Lấy slug
        $name = $db->con->real_escape_string($_POST['name']);
        $email = $db->con->real_escape_string($_POST['email']);
        $website = $db->con->real_escape_string($_POST['website']);
        $comment = $db->con->real_escape_string($_POST['comment']);
    
        // Câu lệnh INSERT đã được bảo vệ tránh lỗi SQL Injection
        $sql = "INSERT INTO comments (blog_id, name, email, website, comment, created_at) 
                VALUES ('$blog_id', '$name', '$email', '$website', '$comment', NOW())";
    
        if ($db->query($sql)) {
            header("Location: " . URLROOT . "/blog/detail/" . urlencode($slug)); // Chuyển hướng đúng trang blog
            exit;
        } else {
            die("Error: " . $db->con->error); // Debug lỗi SQL
        }
    }
    
    
    
    
}
?>
