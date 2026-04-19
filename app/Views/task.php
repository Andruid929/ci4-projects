<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($taskTitle) ?></title>
    <link rel="stylesheet" href="<?= base_url("/css/style.css") ?>">
</head>
<body>
    <h1>Task <?= esc($taskId) ?>: <?= esc($taskTitle) ?></h1>

    <p>Notes: <?= esc($taskNotes) ?></p>

    <h2>Details</h2>
    <p>Project code:
        <a href="<?= base_url("project/" . esc($taskProjectCode)) ?>">
            <?= esc($taskProjectCode) ?>
        </a>
    </p>
    <p>Priority: <?= esc($taskPriority) ?></p>
    <p>Status: <?= esc($taskStatus) ?></p>
    <p>Due date: <?= esc($taskDueDate) ?></p>
</body>
</html>