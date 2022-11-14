<div id="layoutSidenav_content">
    <main class="login">
        <h1 class="mt-4"><?= esc($title); ?></h1>
        <!-- Nested Row within Card Body -->
        <form action="<?php echo site_url().'validate';?>" method="post">
            <?= csrf_field() ?>
            <div class="row">
                <div class="col-lg-6">
                    <div class="p-5">
                        <div class="text-center">
                            <h1 class="h4 text-gray-900 mb-4">Bienvenido!</h1>
                        </div>
                        <form class="user">
                            <div class="form-group">
                                <input type="text" class="form-control form-control-user" name="user"
                                    placeholder="Escriba su usuario aquí">
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control form-control-user" name="password"
                                    id="exampleInputPassword" placeholder="Password">
                            </div>
                            <div class="form-group mt-2">
                                <input type="submit" class="btn btn-primary btn-user btn-block" value="Ingresar" >
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </form>
    </main>

