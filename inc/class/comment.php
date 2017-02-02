<?php
class comment
{
	private $id = null;
	private $img_key = null;
	private $user_key = null;
	private $com_datetime = null;


	public function __construct(array $kwargs)
	{
		$this->id = isset($kwargs['id'])? $kwargs['id'] : NULL;
    $this->img_key = isset($kwargs['img_key'])? $kwargs['img_key'] : NULL;
		$this->user_key = isset($kwargs['user_key'])? $kwargs['user_key'] : NULL;
		$this->com_datetime = isset($kwargs['com_datetime'])? $kwargs['com_datetime'] : NULL;
	}

  public function getDatetime()
  {
    if (isset($this->com_datetime)) {
      $date = new DateTime($this->com_datetime);
      return $date->format('d-m-Y H:i:s');
    }else {
      return false;
    }
  }

 ?>
