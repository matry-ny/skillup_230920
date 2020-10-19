<?php

error_reporting(E_ALL);

$messages = [];
$file = fopen(__DIR__ . '/storage', 'rb');
while ($line = fgets($file, 1024)) {
    $messages[] = json_decode(trim($line), true, 512, JSON_THROW_ON_ERROR);
}
fclose($file);

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
<form action="/chat/send-message.php" method="post">
    <div>
        <label for="nickname">Nickname</label>
        <input type="text" name="nickname" id="nickname" required>
    </div>
    <div>
        <label for="massage">Message</label>
        <textarea name="message" id="massage" rows="10" cols="50" required></textarea>
    </div>
    <button type="submit">Send Message</button>
</form>

<table width="100%" border="1">
    <tr>
        <th>Nickname</th>
        <th>Message</th>
        <th>Time</th>
    </tr>
    <?php foreach ($messages as $message) : ?>
        <tr>
            <td><?= $message['nickname'] ?></td>
            <td><?= $message['message'] ?></td>
            <td><?= $message['time'] ?></td>
        </tr>
    <?php endforeach; ?>
</table>
</body>
</html>
