<?php
require "auth.php";
$file = __DIR__ . '/links.json';
$links = json_decode(file_get_contents($file), true) ?: [];

if (isset($_GET['delete'])) {
    array_splice($links, (int)$_GET['delete'], 1);
    file_put_contents($file, json_encode($links, JSON_PRETTY_PRINT));
    header('Location: admin.php');
    exit;
}

$edit_index = null;
if (isset($_GET['edit'])) {
    $edit_index = (int)$_GET['edit'];
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $item = [
        'title' => $_POST['title'],
        'url' => $_POST['url'],
        'description' => $_POST['description'] ?? ''
    ];
    
    if (isset($_POST['edit_index']) && $_POST['edit_index'] !== '') {
        $links[(int)$_POST['edit_index']] = $item;
    } else {
        $links[] = $item;
    }
    
    file_put_contents($file, json_encode($links, JSON_PRETTY_PRINT));
    header('Location: admin.php');
    exit;
}
?>
<!DOCTYPE html>
<html>
<head><title>Admin</title><link rel="stylesheet" href="style.css"></head>
<body>
<h1><?= $edit_index !== null ? 'Edit Link' : 'Add Link' ?></h1>
<form method="POST">
    <?php if ($edit_index !== null): ?>
        <input type="hidden" name="edit_index" value="<?= $edit_index ?>">
    <?php endif; ?>
    <input name="title" placeholder="Title" required value="<?= htmlspecialchars($links[$edit_index]['title'] ?? '') ?>"><br><br>
    <input name="url" placeholder="URL" required value="<?= htmlspecialchars($links[$edit_index]['url'] ?? '') ?>"><br><br>
    <input name="description" placeholder="Description" value="<?= htmlspecialchars($links[$edit_index]['description'] ?? '') ?>"><br><br>
    <button type="submit"><?= $edit_index !== null ? 'Update' : 'Add' ?></button>
    <?php if ($edit_index !== null): ?> <a href="admin.php" style="margin-left:10px;">Cancel</a> <?php endif; ?>
</form>
<h2>Links</h2>
<ul>
<?php foreach ($links as $i => $l): ?>
    <li><?= htmlspecialchars($l['title']) ?> <a href="?edit=<?= $i ?>">[edit]</a> <a href="?delete=<?= $i ?>">[x]</a></li>
<?php endforeach; ?>
</ul>
</body>
</html>
