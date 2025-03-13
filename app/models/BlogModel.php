<?php
class BlogModel extends Database {
    public function getAllBlogs() {
        $sql = "SELECT * FROM blogs ORDER BY created_at DESC";
        return $this->fetchAll($sql);
    }
    public function getBlogBySlug($slug) {
        $slug = $this->con->real_escape_string($slug); // Tránh SQL Injection
        $sql = "SELECT * FROM blogs WHERE slug = '$slug' LIMIT 1";
        return $this->fetchOne($sql);
    }
    public function getCommentsByBlogId($blog_id) {
        $db = new Database();
        $blog_id = $db->con->real_escape_string($blog_id);
    
        $sql = "SELECT * FROM comments WHERE blog_id = '$blog_id' ORDER BY created_at DESC";
        $result = $db->query($sql);
    
        $comments = [];
        while ($row = $result->fetch_assoc()) {
            $comments[] = $row;
        }
    
        return $comments;
    }
    
}
?>
