<div class="container-fluid">
    <p class="h2">List Course</p>
    <div class="row text-center">
        <?php foreach ($web_development as $c) : ?>
            <div class="card mr-3 mb-3" style="width: 21rem;">
                <img style="height: 180px;" class=" card-img-top" src="<?php echo base_url() . 'assets/uploads/' . $c->gambar ?>" alt="Card image cap">
                <div class="card-body">
                    <h5 class="card-title"><?php echo $c->nama_course ?></h5>
                    <small><?php echo $c->keterangan ?></small><br>
                    <span class="badge badge-pill badge-success mb-3">Rp. <?php echo number_format($c->harga, 0, ',', '.') ?></span><br>
                    <form action="<?php echo base_url() . 'dashboard/tambah_ke_keranjang/' . $c->id_course ?>" method="POST">
                        <input type="number" name="qty" class="text-right">
                        <button type="submit" class="btn btn-sm btn-primary mt-2">Tambah ke Keranjang</button>
                        <a href="#" class="btn btn-sm btn-success mt-2">Detail</a>
                    </form>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>