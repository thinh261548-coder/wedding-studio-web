<?php
/**
 * Inquiry Model
 */

class Inquiry {
    private $db;
    private $table = 'inquiries';

    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }

    public function create($data) {
        $sql = "INSERT INTO {$this->table} (user_id, full_name, email, phone, service_type, event_date, message, status, created_at) 
                VALUES (?, ?, ?, ?, ?, ?, ?, 'pending', NOW())";
        
        $stmt = $this->db->prepare($sql);
        $user_id = isset($data['user_id']) ? $data['user_id'] : null;
        $stmt->bind_param('issssss', $user_id, $data['full_name'], $data['email'], $data['phone'], 
                         $data['service_type'], $data['event_date'], $data['message']);
        
        return $stmt->execute();
    }

    public function getAll($limit = 20, $offset = 0) {
        $sql = "SELECT * FROM {$this->table} ORDER BY created_at DESC LIMIT ? OFFSET ?";
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

    public function getByUserId($user_id, $limit = 10, $offset = 0) {
        $sql = "SELECT * FROM {$this->table} WHERE user_id = ? ORDER BY created_at DESC LIMIT ? OFFSET ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param('iii', $user_id, $limit, $offset);
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    public function updateStatus($id, $status) {
        $sql = "UPDATE {$this->table} SET status = ?, updated_at = NOW() WHERE id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param('si', $status, $id);
        return $stmt->execute();
    }

    public function delete($id) {
        $sql = "DELETE FROM {$this->table} WHERE id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param('i', $id);
        return $stmt->execute();
    }

    public function getTotalCount() {
        $sql = "SELECT COUNT(*) as total FROM {$this->table}";
        $result = $this->db->query($sql);
        return $result->fetch_assoc()['total'];
    }

    public function getCountByStatus($status) {
        $sql = "SELECT COUNT(*) as total FROM {$this->table} WHERE status = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param('s', $status);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc()['total'];
    }
}
