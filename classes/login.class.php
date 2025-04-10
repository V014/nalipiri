<?php
require_once '../classes/database.class.php'; // include database connection class
class Login { // create class for login
    // create properties for login class{ 
    private $db;

    protected function __construct()
    {
        $this->db = new Dbh();
    }
    
    public function getUser($username, $password) {
        $stmt = $this->db->getConnection()->prepare('SELECT id, role FROM user WHERE username = ? AND password = ?');
    
        // Bind values securely
        $stmt->bindValue(1, $username, PDO::PARAM_STR);
        $stmt->bindValue(2, $password, PDO::PARAM_STR);
    
        // Execute the query
        if (!$stmt->execute()) { 
            $stmt = null; // Prevent residual data issues
            header('location: ../login.php?error=stmt_failed');
            exit();
        }
    
        return $stmt->fetch(PDO::FETCH_ASSOC); // Return user data
    }    
}
?>