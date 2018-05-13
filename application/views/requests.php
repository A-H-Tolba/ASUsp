<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<?php foreach(array_reverse($requests) as $request):?>

    <a style="text-align: center;" href = "<?php echo $request['content'];?>">  </a>

<?php endforeach; ?>