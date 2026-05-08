<nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
    <div class="container">
        <p class="navbar-brand fw-bold" href="<?= url_to('/') ?>">
            <?= esc($pageName ?? "HR Portal") ?>
        </p>
        
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <?php if (auth()->loggedIn()): ?>
                    
                    <?php if (current_url() !== url_to("dashboard")): ?>
                        <li class="nav-item me-2">
                            <a href="<?= url_to('dashboard') ?>" class="nav-link btn btn-outline-primary btn-sm">
                                <i class="bi bi-house"></i> Dashboard
                            </a>
                        </li>
                    <?php endif; ?>
                    
                    <li class="nav-item">
                        <form action="<?= url_to('logout') ?>" method="post" class="d-inline">
                            <?= csrf_field() ?>
                            <button type="submit" class="nav-link btn btn-outline-danger btn-sm">
                                <i class="bi bi-box-arrow-right"></i> Logout
                            </button>
                        </form>
                    </li>
                
                <?php else: ?>
                    
                    <li class="nav-item">
                        <a class="nav-link" href="<?= url_to('login') ?>">Login</a>
                    </li>
                    
                    <li class="nav-item">
                        <a class="nav-link" href="<?= url_to('register') ?>">Register</a>
                    </li>
                
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>