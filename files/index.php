<?php

$config = require __DIR__ . '/config.php';

$path = rtrim($config['baseDir'], '/');
$webRout = rtrim($config['webRout'], '/');

$rout = ltrim($_GET['rout'] ?? '', '/');
if ($rout) {
    $path .= "/{$rout}";
}

$content = 'File not selected';
if (is_file($path)) {
    $mimeType = mime_content_type($path);
    switch ($mimeType) {
        case 'image/jpeg':
        case 'image/png':
            $content = "<img src='{$webRout}/{$rout}' alt='Image' width='100%'>";
            break;
        case 'text/plain':
            $content = nl2br(file_get_contents($path));
            break;
        default:
            $content = "File {$rout} can not be processed";
    }

    $path = dirname($path);
}

$dirData = scandir($path);
if (rtrim($path, '/') === rtrim($config['baseDir'], '/')) {
    $dirData = array_filter($dirData, static function (string $item) {
        return !in_array($item, ['.', '..']);
    });
}

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <table width="100%" border="1" cellpadding="10">
        <tr>
            <td width="30%" valign="top">
                <form action="createDir.php" method="post">
                    <input name="baseDir" value="<?= $path ?>" type="hidden">
                    <input name="name" type="text">
                    <button type="submit">Create Dir</button>
                </form>
                <ul>
                    <?php foreach ($dirData as $dirRout) : ?>
                        <li><a href="?rout=<?= $rout ?>/<?= $dirRout ?>"><?= $dirRout ?></a></li>
                    <?php endforeach; ?>
                </ul>
            </td>
            <td valign="top">
                <?= $content ?>
            </td>
        </tr>
    </table>
</body>
</html>
