<?php include '../includes/meta.php'; ?>
<?php include '../includes/header.php'; ?>
<?php include '../config/koneksi.php'; ?>


<div class="menu-page">
    <div class="msec1">
        <h1>Menu</h1>
        <h2>Makanan dan minuman terbaik dikelasnya serta terjamin!</h2>
    </div>

    <div class="msec2">
        <div class="item">
            <div class="dish-img">
                <img src="../assets/images/menu5.png" alt="">
            </div>
            <div class="dish-content">
                <h2>Menu Terlaris</h2>
                <img src="../assets/images/logo2.png" alt="">

                <div class="item-price">
                    <div>
                        <h3>Lorem ipsum dolor</h3>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Dignissimos, incidunt.</p>
                    </div>
                    <div>
                        <h3>Rp10.000</h3>
                    </div>
                </div>

                <div class="item-price">
                    <div>
                        <h3>Lorem ipsum dolor</h3>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Dignissimos, incidunt.</p>
                    </div>
                    <div>
                        <h3>Rp10.000</h3>
                    </div>
                </div>

                <div class="item-price">
                    <div>
                        <h3>Lorem ipsum dolor</h3>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Dignissimos, incidunt.</p>
                    </div>
                    <div>
                        <h3>Rp10.000</h3>
                    </div>
                </div>

                <div class="item-price">
                    <div>
                        <h3>Lorem ipsum dolor</h3>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Dignissimos, incidunt.</p>
                    </div>
                    <div>
                        <h3>Rp10.000</h3>
                    </div>
                </div>
            </div>
        </div>

        <div class="item">
            <div class="dish-content">
                <h2>Menu Hot Promo</h2>
                <img src="../assets/images/logo2.png" alt="">

                <div class="item-price">
                    <div>
                        <h3>Lorem ipsum dolor</h3>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Dignissimos, incidunt.</p>
                    </div>
                    <div>
                        <h3>Rp10.000</h3>
                    </div>
                </div>

                <div class="item-price">
                    <div>
                        <h3>Lorem ipsum dolor</h3>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Dignissimos, incidunt.</p>
                    </div>
                    <div>
                        <h3>Rp10.000</h3>
                    </div>
                </div>

                <div class="item-price">
                    <div>
                        <h3>Lorem ipsum dolor</h3>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Dignissimos, incidunt.</p>
                    </div>
                    <div>
                        <h3>Rp10.000</h3>
                    </div>
                </div>

                <div class="item-price">
                    <div>
                        <h3>Lorem ipsum dolor</h3>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Dignissimos, incidunt.</p>
                    </div>
                    <div>
                        <h3>Rp10.000</h3>
                    </div>
                </div>
            </div>

            <div class="dish-img">
                <img src="../assets/images/menu6.png" alt="">
            </div>
        </div>
    </div>
</div>

<!-- Menu dari Database -->
<div class="menu-db-page">
    <div class="menu-db-container">
        <div class="menu-db-card">
            <div class="menu-db-content">

                <h2 class="menu-db-title">Menu Tersedia</h2>
                <img src="assets/images/logo2.png" alt="" class="menu-db-logo">

                <?php
                $result = mysqli_query($conn, "SELECT * FROM menu ORDER BY id DESC");
                while ($row = mysqli_fetch_assoc($result)) {
                ?>
                    <div class="menu-db-item">
                        <div class="menu-db-info">
                            <h3><?= $row['nama_menu']; ?></h3>
                            <p><?= $row['deskripsi']; ?></p>
                        </div>
                        <div class="menu-db-price">
                            Rp<?= number_format($row['harga'], 0, ',', '.'); ?>
                        </div>
                    </div>
                <?php } ?>

                <div class="menu-order-btn">
                    <a href="order.php" class="org-btn">Order Now</a>
                </div>

            </div>
        </div>
    </div>
</div>


<?php include '../includes/footer.php'; ?>