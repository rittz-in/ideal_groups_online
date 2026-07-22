<!DOCTYPE html>
<html lang="en">
 <?php echo view('header.php'); ?>
<body class="home-one">
<?php echo view('menu.php'); ?>
<?php echo view($child_view); ?>
<?php echo view('footer.php'); ?>

<script type="text/javascript">
     var base_url = '<?php echo $base_url; ?>';
</script>
</body>
</html>
<?PHP die; ?>