<?php

if (1 > 0) {
    echo '<h1>TEST</h1>';
}

?>

<ul>
    <li>Test 1</li>
    <li>Test 2</li>
    <li>Test 3</li>
    <?php if (isset($_GET['p1']) && $_GET['p1'] % 2 === 0) : ?>
        <li>Test 4</li>
    <?php endif; ?>
</ul>
