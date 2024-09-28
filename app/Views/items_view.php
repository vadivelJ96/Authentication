<!DOCTYPE html>
<html>

<head>
    <title>Items List</title>
</head>

<body>
    <h1>Items List</h1>
    <ul>
        <?php foreach ($items as $item): ?>
            <li><?php echo $item['name']; ?>: <?php echo $item['description']; ?></li>
        <?php endforeach; ?>
    </ul>
</body>

</html>