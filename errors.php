<?php if(count($errors) > 0) : ?>

    <div class="error" style=" background: #f5a7c1fa; padding: 10px; border: 1px solid #a94442; color: #a94442; border-radius: 5px;">  
        <?php foreach($errors as $error) : ?>
            <p><b><?php echo $error; ?></b> </p>
        <?php endforeach ?>

    </div>

<?php endif ?>
