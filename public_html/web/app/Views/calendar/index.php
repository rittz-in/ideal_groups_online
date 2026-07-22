<head>
<script src="<?php echo base_url('assets/js/jquery.min.js'); ?>"></script>
<script>
function getCalendar(target_div, year, month){
    $.get( '<?php echo base_url('calendar/eventCalendar/'); ?>'+year+'/'+month, function( html ) {
        $('#'+target_div).html(html);
    });
}

function getEvents(date){
    $.get( '<?php echo base_url('calendar/getEvents/'); ?>'+date, function( html ) {
        $('#event_list').html(html);
    });
}
</script>
</head>
<?php echo view('banner_section.php'); ?>

<section class="container-fluid no-padding">
    <h1 class="text-center">COMING SOON... </h1>
    <div id="calendar_div">
        <?php echo $eventCalendar; ?>
    </div>
    <script>
    $(document).on("change", ".month-dropdown", function(){
        getCalendar('calendar_div', $('.year-dropdown').val(), $('.month-dropdown').val());
    });
    $(document).on("change", ".year-dropdown", function(){
        getCalendar('calendar_div', $('.year-dropdown').val(), $('.month-dropdown').val());
    });
    </script>
</section>
<!--end-slider-->
<!--start-section-->
<!--end-section-->