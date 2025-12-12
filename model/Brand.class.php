<?php
class Brand extends DB {
    public function getAll() {
        $sql = "SELECT * FROM brand";
        return $this->select($sql); 
    }
}
?>