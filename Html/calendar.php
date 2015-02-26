 
<?php

$year = date('Y');
$mEventCalendar = new MEventCalendar();
$cal = $mEventCalendar->getEventCalendar();
?>
<div id="calendar"></div>

<script type="text/javascript">
    $(document).ready(function() {

        $('#calendar').fullCalendar({
            header: {
                left: 'prev,next today',
                center: 'title',
                right: 'month,agendaWeek,agendaDay'
            },
            contentHeight: 420,
            eventClick: function(calEvent, jsEvent, view) {
                document.location.href = "index.php?EX=showInfoArticle&id="+calEvent.id;
            },
            events: [
            <?php 
            for($i = 0 ; $i < count($cal) ; ++$i) 
            {
                //start
                $date = strtotime($cal[$i]['BEGIN']);
                $year = date('Y', $date);
                $day = date('d', $date);
                $month = date('m', $date);
                $month--;

                $interval = $cal[$i]['DURATION'];

                //end
                $date = new DateTime($cal[$i]['BEGIN']);
                $date->add(new DateInterval('P'.$interval.'D'));
                $yearEnd = $date->format('Y');
                $dayEnd = $date->format('d');
                $monthEnd = $date->format('m');
                $monthEnd--;

                ?>
                {
                    id: <?php echo $cal[$i]["ID"]; ?>,
                    title: "<?php echo $cal[$i]['TITLE']; ?>",
                    start: <?php echo 'new Date('.$year.', '.$month.', '.$day.')'; ?>,
                    end: <?php echo 'new Date('.$yearEnd.', '.$monthEnd.', '.$dayEnd.')'; ?>,
                    color: '#337AB7'
                }
                <?php
                if ($i != count($cal) - 1)
                {
                    echo ',';
                }
            }


            ?>
            ]
        });
});
</script>