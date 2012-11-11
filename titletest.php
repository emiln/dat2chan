    <html><body><table><tr><th>Title</th><th>URL</th></tr>
    <?php
    include('titlegenerator.php');
    $title = array(
        'This is a great title, and I feel absolutely great about it!',
        '_____________________________________',
        '`1398 5;a ;l \"||{#)) <<>#"#"%":%"":":AA',
        'Copy-paste',
        'Copy-paste',
        'Copy-paste',
        '\\\\\\\\\\\\\\////////////////',
        'A regular title',
        'atitlebyareallybadop',
        '123',
        '',
	'hello    .    !   world!'
    );
     
    foreach($title as $t) {
        ?>
        <tr>
            <td><?php echo $t; ?></td>
            <td><?php echo titlegenerator::cleanurl($t); ?></td>
        </tr>
        <?php
    }
    ?>
    </table></body></html>
