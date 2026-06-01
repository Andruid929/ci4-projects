<?php
use App\Helpers\RequestHelper;
use App\Helpers\StatusBadgeHelper;

?>
<span class="badge <?= StatusBadgeHelper::getStatusColour($status) ?>">
    <?= esc(RequestHelper::formatStatus($status)) ?>
</span>
