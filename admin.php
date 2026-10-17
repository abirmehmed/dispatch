<?php
$file = __DIR__ . '/links.json';
$links = json_decode(file_get_contents($file), true) ?: [];

if (isset($_GET['delete'])) {
    array_splice($links, (int)$_GET['delete'], 1);
    file_put_contents($file, json_encode($links, JSON_PRETTY_PRINT));
    header('Location: admin.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $links[] = [
        'title' => $_POST['title'],
        'url' => $_POST['url'],
        'description' => $_POST['description'] ?? ''
    ];
    file_put_contents($file, json_encode($links, JSON_PRETTY_PRINT));
    header('Location: admin.php?added=1');
    exit;
}
?>
<!DOCTYPE html>
<html><head><title>Admin</title></head><body>
<h1>Add Link</h1>
<?php if (isset($_GET['added'])) echo '<p>Saved.</p>'; ?>
<form method="POST">
    <input name="title" placeholder="Title" required><br><br>
    <input name="url" placeholder="URL" required><br><br>
    <input name="description" placeholder="Description"><br><br>
    <button type="submit">Add</button>
</form>
<h2>Links</h2>
<ul>
<?php foreach ($links as $i => $l): ?>
    <li><?= htmlspecialchars($l['title']) ?> <a href="?delete=<?= $i ?>">[x]</a></li>
<?php endforeach; ?>
</ul>
</body></html>
