<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<h2 class="text-center">Requests</h2>
<?php foreach(array_reverse($requests) as $request):?>

    <h2 class="text-center"><a onclick="window.location='<?php echo site_url("Welcome/getFriend/".$request['pending_requests']);?>'"><?php echo$request['comments'];?></a>
    <input type="button" class="btn btn-lg btn-success" value="Accept" onclick="window.location='<?php echo site_url("Welcome/accept/".$request['pending_requests']);?>'"></input>
    <input type="button" class="btn btn-lg btn-danger" value="Reject" onclick="window.location='<?php echo site_url("Welcome/reject/".$request['pending_requests']);?>'"></input>

</h2>

<?php endforeach; ?>

<h2 class="text-center">Friends suggestion</h2>