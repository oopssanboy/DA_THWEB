<?php
class Dacdiem_sp extends DB{
    public function getAll(){
        $sql="select * from dacdiem_sp";
        return $this->select($sql);
    }
    public function getByid($id)
    {
        $sql="select * from dacdiem_sp where ma_dacdiem = $id";
        return $this->select($sql);
    }
    
    public function getAll_byid_sp($id)
    {
        $sql="select * from dacdiem_sp where ma_sp = $id";
        return $this->select($sql);
    }
    public function add_dacdiem($ma_sp, $size, $loai_mau, $soluong_tonkho) {
        $sql = "insert into dacdiem_sp (ma_sp, size, loai_mau, soluong_tonkho) values (?, ?, ?, ?)";
        return $this->insert($sql, [$ma_sp, $size, $loai_mau, $soluong_tonkho]);
    }
    public function delete_dacdiem($ma_dacdiem) {
        $sql = "delete from dacdiem_sp where ma_dacdiem = ?";
        return $this->delete($sql, [$ma_dacdiem]);
    }
    function update_tonkho($id, $size,$loai_mau,$soluong,$mod){
        if($mod=='giam')
            $sql = "UPDATE dacdiem_sp SET soluong_tonkho = soluong_tonkho - " . $soluong . " where ma_sp = " . $id . " and size = '" . $size . "' and loai_mau = '" . $loai_mau . "'";
        else
            $sql = "UPDATE dacdiem_sp SET soluong_tonkho = soluong_tonkho + " . $soluong . " where ma_sp = " . $id . " and size = '" . $size . "' and loai_mau = '" . $loai_mau . "'";
        return $this->update($sql);
    }
}
?>