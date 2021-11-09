<body class="bg-secondary">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-5 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0 bg-light">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="p-5">
                                    <div class="text-center">
                                        <img src="<?= base_url('assets/img/logo.png') ?>" alt="Logo Airaa" class="img-fluid mx-auto d-block" width="60%"><br>
                                        <h1 class="h4 text-grey-900 mb-4">Login Your Airaa Account</h1>
                                    </div>
                                    <?php echo $this->session->flashdata('pesan'); ?>
                                    <form class="user" action="<?php echo base_url('auth/login') ?>" method="POST">
                                        <div>
                                            
                                        </div>
                                        <div class="form-group">
                                            <input type="text" class="form-control form-control-user" id="exampleInputEmail" placeholder="Username" name="username">
                                            <?php echo form_error('username', '<div class="text-danger small ml-2">', '</div>') ?>
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control form-control-user" id="exampleInputPassword" placeholder="Password" name="password">
                                            <?php echo form_error('password', '<div class="text-danger small ml-2">', '</div>') ?>
                                        </div>

                                        <button type="submit" class="btn btn-secondary form-control">Login</button>
                                    </form>
                                    <hr>
                                    <div class="text-center">
                                        <a class="small" href="<?php echo base_url('registrasi') ?>">Belum Punya Akun? Daftar!</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

</body>

</html>