<?php

class like
{
	private $id = null;
	private $img_key = null;
	private $user_key = null;
	private $like_datetime = null;


	public function __construct(array $kwargs)
	{
		$this->id = isset($kwargs['id'])? $kwargs['id'] : NULL;
    $this->img_key = isset($kwargs['img_key'])? $kwargs['img_key'] : NULL;
		$this->user_key = isset($kwargs['user_key'])? $kwargs['user_key'] : NULL;
		$this->like_datetime = isset($kwargs['like_datetime'])? $kwargs['like_datetime'] : NULL;
	}

  public function getDatetime()
  {
    if (isset($this->like_datetime)) {
      $date = new DateTime($this->like_datetime);
      return $date->format('d-m-Y H:i:s');
    }else {
      return false;
    }
  }
 ?>
