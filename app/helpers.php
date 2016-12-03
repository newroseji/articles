<?php
function flash($title = null, $message = null)
{
    // session()->flash('message',$message);

    $flash = app('App\Http\Flash');


    if (func_num_args() == 0)
    {
        return $flash;
    }

    return $flash->info($title, $message);

}

function link_to($body, $path, $type,$classes){

	$csrf = csrf_field();


	if ( is_object($path)){

		$action=$path->getTable();

		if (in_array($type,['PUT','PATH','DELETE'])){
			$action .= '/' . $path->getKey();
		}
	}
	else{
		$action = $path;
	}

	return <<<EOT

<form method="POST" action="{$action}"  class="{$classes}">
<input type='hidden' name='_method' value='{$type}'>
$csrf
<button class="glyphicon glyphicon-trash" type="submit" title="Delete"></button>
</form>

EOT;

}
