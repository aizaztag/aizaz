<?php foreach($data as $k => $post): ?>
    <div class="card">
        <div><h2> <?php echo $post['title']; ?> </h2></div>
        <hr/>
        <div><p> <?php echo $post['body']; ?> </p></div>
<?php endforeach;?>

<?php
//echo "<pre>"; print_r($data); die;


