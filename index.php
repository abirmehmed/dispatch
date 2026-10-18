<?php
$links = json_decode(file_get_contents(__DIR__ . '/links.json'), true) ?: [];
?>
<!DOCTYPE html>
<html>
<head><title>Dispatch</title><link rel="stylesheet" href="style.css"></head>
<body>
    <h1>Dispatch</h1>
    <?php foreach ($links as $l): ?>
        <a href="<?= htmlspecialchars($l['url']) ?>" class="link-card" target="_blank">
            <div class="link-title"><?= htmlspecialchars($l['title']) ?></div>
            <div class="link-desc"><?= htmlspecialchars($l['description'] ?? '') ?></div>
        </a>
    <?php endforeach; ?>
</body>
</html>
