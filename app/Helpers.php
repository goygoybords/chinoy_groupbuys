<?php 

	function flash($message, $level = 'alert-info')
	{
		session()->flash('flash_message', $message);
		session()->flash('flash_message_level', $level);

	}

