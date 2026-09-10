<?php
/**
 * Gallery Model
 */

class Gallery {
    private $db;
    private $table = 'galleries';

    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }

    public function create($data) {
        $sql = "INSERT INTO {$this->table} (title, description, category, created_at) 
                VALUES (?, ?, ?, NOW())";
        
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param('sss', $data['title'], $data['description'], $data['category']);
        
        if ($stmt->execute()) {
            return $this->db->insert_id;
        }
        return false;
    }

    public function addImage($gallery_id, $image_path) {
        $sql = "INSERT INTO gallery_images (gallery_id, image_path, created_at) VALUES (?, ?, NOW())";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param('is', $gallery_id, $image_path);
        return $stmt->execute();
    }

    public function getAll($limit = 12, $offset = 0) {
        $sql = "SELECT g.*, COUNT(gi.id) as image_count, MAX(gi.image_path) as thumb 
                FROM {$this->table} g 
                LEFT JOIN gallery_images gi ON g.id = gi.gallery_id 
                WHERE g.status = 'active' 
                GROUP BY g.id 
                ORDER BY g.created_at DESC 
                LIMIT ? OFFSET ?";
        
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param('ii', $limit, $offset);
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    public function getById($id) {
        $sql = "SELECT * FROM {$this->table} WHERE id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param('i', $id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    public function getImages($gallery_id) {
        $sql = "SELECT * FROM gallery_images WHERE gallery_id = ? ORDER BY created_at DESC";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param('i', $gallery_id);
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    public function update($id, $data) {
        $sql = "UPDATE {$this->table} SET title = ?, description = ?, category = ?, updated_at = NOW() WHERE id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param('sssi', $data['title'], $data['description'], $data['category'], $id);
        return $stmt->execute();
    }

    public function deleteImage($image_id) {
        $sql = "DELETE FROM gallery_images WHERE id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param('i', $image_id);
        return $stmt->execute();
    }

    public function delete($id) {
        $sql = "UPDATE {$this->table} SET status = 'deleted', updated_at = NOW() WHERE id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param('i', $id);
        return $stmt->execute();
    }

    public function getTotalCount() {
        $sql = "SELECT COUNT(*) as total FROM {$this->table} WHERE status = 'active'";
        $result = $this->db->query($sql);
        return $result->fetch_assoc()['total'];
    }
}
