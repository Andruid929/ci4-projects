<?php
$this->extend("layouts/main");

$this->section('content');
?>

<div class="container">

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

                                <?php
                                if (session('error') !== null): ?>
                                    <div class="alert alert-danger" role="alert"><?= esc(session('error')) ?></div>

                                <?php
                                elseif (session('errors') !== null): ?>

                                    <div class="alert alert-danger" role="alert">

                                        <?php
                                        if (is_array(session('errors'))): ?>

                                            <?php
                                            foreach (session('errors') as $error): ?>
                                                <?= esc($error) ?>
                                                <br>

                                                <?php
                                            endforeach ?>

                                        <?php
                                        else: ?>

                                            <?= esc(session('errors')) ?>
                                            
                                            <?php
                                        endif ?>
                                        
                                    </div>

                                    <?php
                                endif ?>

                                <form class="user" action="<?= base_url('register') ?>" method="post">

                                    <?= csrf_field() ?>

                                    <div class="form-group row">
                                        <div class="col-sm-6 mb-3 mb-sm-0">
                                            <input type="text" class="form-control form-control-user"
                                                id="floatingFirstNameInput" name="first_name" inputmode="text"
                                                autocomplete="text" placeholder="First name"
                                                value="<?= old('first_name') ?>" required>
                                        </div>

                                        <div class="col-sm-6">
                                            <input type="text" class="form-control form-control-user"
                                                id="floatingLastNameInput" name="last_name" inputmode="text"
                                                autocomplete="text" placeholder="Last name"
                                                value="<?= old('last_name') ?>" required>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <input type="email" class="form-control form-control-user"
                                            id="floatingEmailInput" name="email" inputmode="email" autocomplete="email"
                                            placeholder="Email address" value="<?= old('email') ?>" required>
                                    </div>
                                    
                                    <div class="form-group row">
                                        <div class="col-sm-6 mb-3 mb-sm-0">
                                            <input type="password" class="form-control form-control-user"
                                                id="floatingPasswordInput" name="password" inputmode="text"
                                                autocomplete="new-password" placeholder="Set password" required>
                                        </div>
                                        
                                        <div class="col-sm-6">
                                            <input type="password" class="form-control form-control-user"
                                                id="floatingPasswordConfirmInput" name="password_confirm"
                                                inputmode="text" autocomplete="new-password"
                                                placeholder="Confirm password" required>
                                        </div>
                                    </div>
                                    
                                    <button type="submit" class="btn btn-primary btn-user btn-block">
                                        Create Account
                                    </button>

                                    <hr>
                                    
                                    <div class="text-center">
                                        Already have an account?
                                        <a class="small" href="<?= base_url('login') ?>"> Login!</a>
                                    </div>
                                </form>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <?= $this->endSection() ?>