<?php
class CommentModel {
    private $db;

    public function __construct() {
        $this->db = new Database(); // Không require thủ công, dùng class có sẵn
    }

    // Lấy tất cả bình luận của một bài blog
    public function getCommentsByBlogId($blog_id) {
        $blog_id = (int)$blog_id; // Ép kiểu an toàn
        $sql = "SELECT * FROM comments WHERE blog_id = $blog_id ORDER BY created_at DESC";
        return $this->db->fetchAll($sql);
    }

    // Thêm bình luận mới
    public function addComment($blog_id, $name, $email, $website, $comment) {
        $blog_id = (int)$blog_id;
        $name = $this->db->con->real_escape_string($name);
        $email = $this->db->con->real_escape_string($email);
        $website = $this->db->con->real_escape_string($website);
        $comment = $this->db->con->real_escape_string($comment);

        $sql = "INSERT INTO comments (blog_id, name, email, website, comment) 
                VALUES ('$blog_id', '$name', '$email', '$website', '$comment')";

        return $this->db->query($sql);
    }
}
?>
