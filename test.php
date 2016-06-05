<?php
    // First day of this month
    echo $calendar_start=(new DateTime('first day of this month'))->format('D');
    echo $calendar_end=(new DateTime('last day of this month'))->format('d');
?>
