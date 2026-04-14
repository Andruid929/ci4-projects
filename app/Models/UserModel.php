<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{

    protected $table = "portal_user";
    protected $primaryKey = "id";
    protected $useAutoIncrement = true;
    protected $returnType = "array";
    protected $useSoftDeletes = false;
    protected $allowedFields = ["first_name", "last_name", "email", "password", "last_activity"];

    protected $beforeInsert = ["beforeInsert"];

    protected $validationRules = [
        "first_name" => "required|string|max_length[30]",
        "last_name" => "required|string|max_length[30]",
        "email" => "required|string|max_length[50]",
        "password" => "required|string|min_length[8]|max_length[32]"
    ];

    public function beforeInsert(array $data)
    {
        if(isset($data["data"]["password"])) {

            $data["data"]["password"] = password_hash($data["data"]["password"],
             PASSWORD_BCRYPT);

        }

        return $data;
    }

    public function verifyPassword(string $email, string $plainPassword): bool
    {
        $user = $this->getUserByEmail($email);

        $id = $user["id"];
        
        if (!password_verify($plainPassword, $user["password"])) {
            $this->updateLastActivity($id);

            return false;
        }

        return true;
    }

    public function userExists(string $email): bool
    {
        if (!$this->getUserByEmail($email)) {
            return false;
        }

        return true;
    }

    public function getUserByEmail(string $email)
    {
        return $this->where("email", $email)->first();
    }

    private function updateLastActivity(int $userId)
    {
        return $this->update($userId, ["last_activity" => date("Y-m-d H:i:s")]);
    }
}
