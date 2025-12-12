<?php
class NXB extends DB {
    public function getAll() {
        $sql = "SELECT * FROM nxb";
        return $this->select($sql); 
    }
}
?>