<?php
class User extends DB{
    public function get_user_byid($id){
        if (empty($id) || !is_numeric($id)) {
        return null; 
    }
        $sql="select * from users where ma_kh = $id";
        return $this->select($sql);
    }
    public function check_user_by_username($username){
        $sql = "select * from users where username = ?";
        return $this->select($sql, [$username]);
    }
    public function add_user_google($ten_kh, $email, $token) {
        $sql = "insert into users (ten_kh, email, token, username, password) 
                values (?, ?, ?, ?, ?)";
        $password_default = ''; 
        return $this->insert($sql, [$ten_kh, $email, $token, $email, $password_default]);;
    }
    public function update_token($ma_kh, $new_token) {
        $sql = "UPDATE users SET token = ? WHERE ma_kh = ?";
        return $this->update($sql, [$new_token, $ma_kh]); 
    }

}
?>