<?php

include "conn.php";

class UserModel{
    protected $pdo;

    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
    }

    public function getTotalMembers() {
        try {
            $statement = $this->pdo->query("SELECT COUNT(*) AS total_members FROM registrations");
            $result = $statement->fetch(PDO::FETCH_ASSOC);
            return $result['total_members'] ?? 0;
        } catch (PDOException $e) {
            
            error_log('Error fetching total members: ' . $e->getMessage());
            // Return a default value or re-throw the exception
            throw $e;
        }
    }
}

?>