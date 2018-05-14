<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<?php foreach(array_reverse($requests) as $request):?>

    <h2 class="text-center"><a class="text-center" style="text-align: center;" href = "<?php echo $request['content'];?>"> <?php echo $request['comments'];?> </a></h2>

<?php endforeach; ?>