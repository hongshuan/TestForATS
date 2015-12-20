<?php

namespace App\Models;

use App\Models\Model;
use Common\Password;

class UserModel extends Model
{
    public function findById($id)
    {
        $id = intval($id);
        $row = $this->db->query("SELECT * FROM users WHERE id=$id");
        return current($row);
    }

    public function findByName($name)
    {
        $name = $this->db->quote($name);
        $row = $this->db->query("SELECT * FROM users WHERE username=$name");
        return current($row);
    }

    public function addUser($user)
    {
        $username  = $this->db->quote($user['username']);
        $password  = $this->db->quote(Password::encode($user['password']));
        $email     = $this->db->quote($user['email']);
        $telephone = $this->db->quote($user['telephone']);

        $this->db->exec("INSERT INTO users VALUES (NULL, $username, $password, $email, $telephone, NOW(), NOW())");

        return $this->db->lastInsertId();
    }
}
