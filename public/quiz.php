<?php
$class['paragraph'] = 'content';
$intro = 'hello';
$line1 = 'This is line 1';
$line2 = 'This is line 2';
echo '<p>'.$intro.'<br>'.$line1.'</p> <p class="'.$class['paragraph'].'">'.$line2.'</p>'; ?>
<script type="text/javascript">
jQuery(document).ready(function(){
	var line1 = [<?php
    $first = true;
    for($i=1;$i < 10;$i++) {
        if ($first) {
            $first = false;
        } else {
            echo ', ';
        }
        echo '[';
        echo '"'.date('Y-m-d', strtotime("2016-10-$i")).' 1:00AM'.'"';
        echo ']';
    }?>];
});
</script>
