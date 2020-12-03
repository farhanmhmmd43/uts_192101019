<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Hotel</title>
   <style>
        * {
        box-sizing: border-box;
        }

        form {
        padding: 1em;
        border: 1px solid black;
        margin-top: 2rem;
        max-width: 600px;
        margin-left: auto;
        margin-right: auto;
        padding: 1em;
        }
        form input {
        margin-bottom: 1rem;
        border: 1px solid black;
        }

        form select {
        margin-bottom: 1rem;
        border: 1px solid black;
        }

        form button, .button {
        padding: 0.7em;
        border: 0;
        margin: 2px;
        }


        label {
        text-align: left;
        display: block;
        padding: 0.5em 1.5em 0.5em 0;
        }

        
        input {
        width: 100%;
        padding: 0.7em;
        margin-bottom: 0.5rem;
        }
        
        select {
        width: 100%;
        padding: 0.5em 1.5em 0.5em 0;
        margin-bottom: 0.5rem;
        }

        @media (min-width: 400px) {
            form {
                overflow: hidden;
            }

            label {
                float: left;
                width: 220px;
            }

            input {
                float: left;
                width: calc(100% - 220px);
            }

            button, .button {
                float: right;
                width: calc(100% - 220px);
            }

            select {
                float: left;
                width: calc(100% - 220px);
            }
            
        }
   </style>
</head>
<body>

<form method="post" id="form">
    <u><h3>Form Input</h3></u>
    <center> <h1>Booking Hotel</h1> </center>
    
      <label for="Nama">Nama</label>
      <input id="Nama" type="text" name="nama" required placeholder="Masukan Nama">

      <label for="kode-booking">Kode Booking</label>
      <select id="kode-booking" name="kode-booking" required>
      <option value=""></option>
        <option value="AL02102">AL02102</option>
        <option value="BG03025">BG03025</option>
        <option value="CR02111">CR02111</option>
        <option value="KM03075">KM03075</option>
      </select>

      <label for="jumlah">Jumlah</label>
      <input id="jumlah" type="number" name="jumlah" required placeholder="Masukan Jumlah Orang">
      
      <label for="hari">Hari</label>
      <input id="hari" type="number" name="hari" required placeholder="Masukan lama hari">

      <label for="jenis-pembayaran">Jenis Pembayaran</label>
      <select id="jenis-pembayaran" name="jenis-pembayaran" required>
      <option value=""></option>
        <option value="Kartu Kredit">Kartu Kredit</option>
        <option value="Debit">Debit</option>
        <option value="Cash">Cash</option>
      </select>

      <button class="button" type="submit" name="submit">Submit</button>
      <input class="button" type="button" onclick="reset()" value="Reset form">
</form>

<?php 

    if(isset($_POST['submit'])){
        $data = $_POST;
        

        if(substr($data['kode-booking'], 0,2) == "AL"){
            $kamar = "Alamanda";
            $harga = "450000";
        }elseif(substr($data['kode-booking'], 0,2) == "BG"){
            $kamar = "Bougenvile";
            $harga = "350000";
        }elseif(substr($data['kode-booking'], 0,2) == "CR"){
            $kamar = "Crysan";
            $harga = "375000";
        }elseif(substr($data['kode-booking'], 0,2) == "KM"){
            $kamar = "Kemuning";
            $harga = "425000";
        }else{
            return "kamar not found";
        }

        $nomor = substr($data['kode-booking'], -3);
        $lantai = substr($data['kode-booking'], 2,2);
        $total = $harga * $data['hari'];
        $orang=$data['jumlah'];
        if($orang > 2){
            $sptambahan = 75000*($orang - 2);
        }else{
            $sptambahan = 0;
        }

        function discount($orang, $tipe, $total){
            $tambahan = 0;
            
            if($tipe == "Kartu Kredit"){
                $tambahan = $tambahan + $total * 2/100;
            }elseif($tipe == "Debit"){
                $tambahan = $tambahan + (-1 * ($total * 1.5/100));
            }else{
                $tambahan = $tambahan;
            }
            return $tambahan;
        }

        $discount = discount($data['jumlah'], $data['jenis-pembayaran'], $total)
        

?>
    <form method="post" id="form">
    <u><h3>Output</h3></u>
        <center> <h1>Florensia Hotel</h1> </center>
        <label>Nama </label>
        <label >: <?php print($data['nama'])?></label>

        <label>Nama Kamar </label>
        <label >: <?php print($kamar)?></label>

        <label>Nomor </label>
        <label >: <?php print($nomor)?></label>

        <label>Lama </label>
        <label >: <?php print($data['hari'])?> hari</label>

        <label>Kode Booking </label>
        <label >: <?php print($data['kode-booking'])?></label>

        <label>Lantai </label>
        <label >: <?php print($lantai)?></label>

        <label>Jumlah </label>
        <label >: <?php print($orang)?> orang</label>

        <label>Jenis Pembayaran </label>
        <label >: <?php print($data['jenis-pembayaran'])?></label>

        <label>Biaya Spring Bad Tambahan </label>
        <label >: <?php print($sptambahan)?></label>

        <label>Potongan/Tambahan </label>
        <label >: <?php print($discount)?></label>

        <label>Total Biaya Seluruhnya </label>
        <label >: Rp. <?php print($total + $discount + $sptambahan)?></label>
    </form> 
    <?php } ?>


<script>
    function reset() {
    document.getElementById("form").reset();
}
</script>
</body>
</html>