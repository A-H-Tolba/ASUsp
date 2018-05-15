<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<h2 class="text-center">Requests</h2>
<?php foreach(array_reverse($requests) as $request):?>

    <h2 class="text-center"><a onclick="window.location='<?php echo site_url("Welcome/getFriend/".$request['likes']);?>'"><?php echo$request['comments'];?></a>
</h2>

<?php endforeach; ?>

<h2 class="text-center">Friends suggestion</h2>