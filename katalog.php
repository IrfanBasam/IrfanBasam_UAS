<?php
include "koneksi.php";
$id=isset($_POST["id"]) ? $_POST["id"] : "";
$hapus=isset($_POST["hapus"]) ? $_POST["hapus"] : "";
if ($hapus AND $id != "")
{
  try {
      $query = $conn->prepare("DELETE FROM barang_tersedia WHERE id=:id");
      $query->bindParam(":id", $id);
      if ($query->execute())
      {
      echo "<script>alert('Data berhasil dihapus')</script>";
      }
      else
      {
      echo "<script>alert('Data gagal dihapus')</script>";
      }
  }
    catch(PDOException $e){
      echo $e->getMessage();
    }

}
?>
<div class="container">
  <div class="my-4">
  <div class="row justify-content-center">
    <div class="col-md-10">
      <h3 class="text-center">Daftar Barang</h3>
        <table class="table table-striped table-hover text-center">
          <thead style="background-color: #191970;color: white">
               <tr>
               <th>#</th>
               <th>Kode Barang</th>
               <th>Nama Barang</th>
               <th>Harga Satuan</th>
               <th>Gambar</th>
               <th>Perintah</th>
               </tr>
          </thead>
      <tbody>
           <?php
              try{
                $query = $conn->prepare("SELECT * FROM barang_tersedia");
                $query->execute();
                 $no = 1;
                 while ($data = $query->fetch(PDO::FETCH_OBJ))
                 {
                 echo "<form action='?page=katalog' method='post'>";
                 echo "<input type='hidden' name='id' value='".$data->id."'>";
                 echo "<tr>";
                 echo "<td>".$no."</td>";
                 echo "<td>".$data->kode."</td>";
                 echo "<td>".$data->nama_barang."</td>";
                 echo "<td>".$data->harga_barang."</td>";
                 echo "<td><img src='foto/".$data->foto."' widht='70' height='70'></td>";
                 echo "<td>";
                 echo "<a href='?page=edit&id=".$data->id."' class='btn btn-primary btn-sm'>Edit</a>";
                 echo " <button type='submit' name='hapus' value='Hapus' class='btn btn-danger btn-sm'>Hapus</button>";
                 echo "</td>";
                 echo "</tr>";
                 echo "</form>";
                 $no++;
                 }
              }
              catch(PDOException $e){
                echo $e->getMessage();
              }
           ?>
        </tbody>
      </table>
    </div>
  </div>
</div>
</div>