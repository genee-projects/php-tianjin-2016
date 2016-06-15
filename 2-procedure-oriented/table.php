<?php

$data = file_get_contents('./data.json');
$json = json_decode($data, true);

?>
<table border="1">
    <thead>
        <tr>
            <th>No.</th>
            <th>name</th>
            <th>value</th>
        </tr>
    </thead>
    <tbody>
    <?php $i = 0;
        foreach ($json as $book) { ?>
        <tr>
            <?php $i += 1; ?>
            <td><?php echo $i ?></td>
            <td><?php echo $book['name'] ?></td>
            <td><?php echo $book['value'] ?></td>
            <form>
                <input type="text" name="value" value="<?php echo $book['value'] ?>"/>
                <button type="submit">Submit</button>
            </form>
        </tr>
    <?php } ?>
    </tbody>
</table>
<script>
$.get('./table.php', {index: 1}, function () {
    
});
</script>
