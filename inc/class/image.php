<?php
require_once "inc/class/database.php";

class Image
{
	private $id = null;
	private $img_key = null;
	private $user_key = null;
	private $img_datetime = null;
	private $public = null;


	public function __construct(array $kwargs)
	{
		$this->id = isset($kwargs['id'])? $kwargs['id'] : NULL;
    $this->img_key = isset($kwargs['img_key'])? $kwargs['img_key'] : NULL;
		$this->user_key = isset($kwargs['user_key'])? $kwargs['user_key'] : NULL;
		$this->img_datetime = isset($kwargs['img_datetime'])? $kwargs['img_datetime'] : NULL;
		$this->public = isset($kwargs['public'])? $kwargs['public'] : NULL;
	}

	public function getPublic()
	{
		return $this->public;
	}

	public function getId()
	{
		return $this->id;
	}

  public function getImgKey()
  {
    return $this->img_key;
  }

  public function getUserKey()
	{
		return $this->user_key;
	}

	public function isLikedBy($user, $bdd)
	{
		$log = $bdd->prepare("SELECT * FROM likes WHERE user_key=:user_key and img_key=:img_key",
		 array('user_key' => $user->getUserKey(),
	  				'img_key' => $this->getImgKey()));
		return (!$log);
	}

	public function getComBy($user, $bdd)
	{
		$log = $bdd->prepare("SELECT * FROM comments WHERE user_key=:user_key and img_key=:img_key",
		 array('user_key' => $user->getUserKey(),
	  				'img_key' => $this->getImgKey()),null,true);
		if (isset($log))
		{
			return $log['comment'];
		}
	}

	public function getLink()
	{
		return "img\gallery\\".$this->user_key."\\".$this->img_key.".png";
	}

	public function getComment()
	{
		return $this->comment;
	}

	public function getAll()
	{
		return $arrayName = array('id' => $this->id,
															'img_key' => $this->img_key,
														 	'user_key' => $this->user_key,
															'public' => $this->public);
	}

  public function setLiked()
  {
    if ($this->liked === 0){
      $this->liked = 1;
    }else{
      $this->liked = 0;
    }
  }

  public function setComment($comment)
  {
      $this->comment = $comment;
  }

	public function getCard()
	{
		return "<img src=\"  ".$this->getLink()."\" alt=\"\">
			<button onclick=\"delateImage(this,delateInGalrie)\" class=\"delete\"><i class=\"fa fa-trash\" aria-hidden=\"true\"></i></button>";
	}
	public function getCardPublic($user, $bdd)
	{
		return "<img src=\"  ".$this->getLink()."\" alt=\"\">
			<button class=\"like\" onclick=\"likeIt(this)\" >".($this->isLikedBy($user , $bdd)? "<i class=\"fa fa-heart\" aria-hidden=\"true\"></i>" : "<i class=\"fa fa-heart-o\" aria-hidden=\"true\"></i>")."</button>
			<button class=\"addComment\" onclick=\"getForm(this)\" ><i class=\"fa fa-pencil-square-o\" aria-hidden=\"true\"></i></i></button>
			<div class=\"comment\"><p>".$this->getComBy($user, $bdd)."</p></div>";
	}
}
?>
