<?=
$this->extend("layouts/main");

$this->section('content');
?>

<div class="container">
    
    <!-- Outer Row -->
    <div class="row justify-content-center">
        
        <div class="col-xl-10 col-lg-12 col-md-9">
            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">
                    <!-- Nested Row within Card Body -->
                    <div class="row justify-content-center">
                        <div class="col-lg-6">
                            <div class="p-5">
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-4">Welcome Back!</h1>
                                </div>

                                <?php if (session('error') !== null) : ?>
                                    <div class="alert alert-danger" role="alert"><?= esc(session('error')) ?></div>
                                <?php elseif (session('errors') !== null) : ?>
                                    <div class="alert alert-danger" role="alert">
                                        <?php if (is_array(session('errors'))) : ?>
                                            <?php foreach (session('errors') as $error) : ?>
                                                <?= esc($error) ?>
                                                <br>
                                            <?php endforeach ?>
                                        <?php else : ?>
                                            <?= esc(session('errors')) ?>
                                        <?php endif ?>
                                    </div>
                                <?php endif ?>

                                <?php if (session('message') !== null) : ?>
                                    <div class="alert alert-success" role="alert"><?= esc(session('message')) ?></div>
                                <?php endif ?>

                                <form class="user" action="<?= url_to('login') ?>" method="post">
                                    <?= csrf_field() ?>

                                    <div class="form-group">
                                        <input type="email" class="form-control form-control-user"
                                               id="floatingEmailInput" name="email"
                                               inputmode="email" autocomplete="email"
                                               placeholder="Enter email"
                                               value="<?= old('email') ?>" required>
                                    </div>

                                    <div class="form-group">
                                        <input type="password" class="form-control form-control-user"
                                               id="floatingPasswordInput" name="password"
                                               inputmode="text" autocomplete="current-password"
                                               placeholder="Enter password" required>
                                    </div>

                                    <?php if (setting('Auth.sessionConfig')['allowRemembering']): ?>
                                        <div class="form-group">
                                            <div class="custom-control custom-checkbox small">
                                                <input type="checkbox" name="remember" class="custom-control-input" id="customCheck" <?php if (old('remember')): ?> checked<?php endif ?>>
                                                <label class="custom-control-label" for="customCheck">Remember Me</label>
                                            </div>
                                        </div>
                                    <?php endif; ?>

                                    <button type="submit" class="btn btn-primary btn-user btn-block">
                                        Login
                                    </button>
                                    <hr>
                                    <div class="text-center">
                                        No account?
                                        <a class="small" href="<?= base_url('register') ?>">Register here!</a>
                                    </div>
                                </form>
                                <hr>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    
    </div>

</div>

<?= $this->endSection() ?>
