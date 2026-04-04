<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<h2>Welcome to the Helpdesk Lite page</h2>

<form method="POST" action="<?= site_url('sign_in') ?>" class="form">
    <div class="form-group">
        <label for="username">Username</label>
        <input type="text"
               id="username"
               name="username"
               class="form-input"
               placeholder="Enter your username"
               required
               value="<?= set_value('username') ?>"
        >
    </div>
    
    <div class="form-group">
        <label for="email">Email</label>
        <input
                type="email"
                id="email"
                name="email"
                class="form-input"
                placeholder="your@email.com"
                required
                value="<?= set_value('email') ?>"
        >
    </div>
    
    <div class="form-group">
        <label for="category">Category</label>
        <select id="category" name="category" class="form-input">
            <option value="">Select a category</option>
            <option value="support" <?= set_select('category', 'support') ?> >Support</option>
            <option value="billing" <?= set_select('category', 'billing') ?> >Billing</option>
            <option value="other" <?= set_select('category', 'other') ?> >Other</option>
        </select>
    </div>
    
    <button type="submit" class="form-button">Submit</button>
</form>
<?= $this->endSection() ?>
