<?php
/**
 * Service Model
 */

class Service {
    private $db;
    private $table = 'services';

    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }

    public function create($data) {
        $sql = "INSERT INTO {$this->table} (name, description, icon, price, created_at) 
                VALUES (?, ?, ?, ?, NOW())";
        
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param('sssd', $data['name'], $data['description'], $data['icon'], $data['price']);
        
        return $stmt->execute();
    }

    public function getAll($limit = null, $offset = 0) {
        $sql = "SELECT * FROM {$this->table} WHERE status = 'active' ORDER BY created_at DESC";
        
        if ($limit) {
            $sql .= " LIMIT ? OFFSET ?";
            $stmt = $this->db->prepare($sql);
            $stmt->bind_param('ii', $limit, $offset);
        } else {
            $stmt = $this->db->prepare($sql);
        }
        
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

    public function update($id, $data) {
        $sql = "UPDATE {$this->table} SET name = ?, description = ?, icon = ?, price = ?, updated_at = NOW() WHERE id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param('sssdi', $data['name'], $data['description'], $data['icon'], $data['price'], $id);
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
