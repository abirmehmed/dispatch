<?php
$links = json_decode(file_get_contents(__DIR__ . '/links.json'), true) ?: [];
?>
<!DOCTYPE html>
<html>
<head><title>Dispatch</title></head>
<body>
    <h1>Dispatch</h1>
    <?php foreach ($links as $l): ?>
        <p><a href="<?= htmlspecialchars($l['url']) ?>"><?= htmlspecialchars($l['title']) ?></a></p>
    <?php endforeach; ?>
</body>
</html>
