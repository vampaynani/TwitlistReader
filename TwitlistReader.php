<?php
class TwitlistReader{
	const LISTS_URL = "http://api.twitter.com/1/lists.json?screen_name=";
	const STATUSES_URL = "http://api.twitter.com/1/lists/statuses.json?list_id=";
	
	private $url_lists;
	private $url_statuses;
	
	public $lists;
	public $current_list;
	public $list_statuses;
	public $html_statuses;
	
	public function __construct(){}
	
	public function getListsFrom($user_screen_name){
		$this->url_lists = TwitlistReader::LISTS_URL . $user_screen_name;
		$object = $this->getJSONFromURL($this->url_lists);
		if(count($object->lists) > 0){
			return $this->lists = $object->lists;
		}else{
			echo "No lists available";
		}
	}
	
	public function getListStatuses($list_name){
		$list_ID = $this->getListID($list_name);
		$this->url_statuses = TwitlistReader::STATUSES_URL . $list_ID;
		$statuses = $this->getJSONFromURL($this->url_statuses);
		if($statuses){
			return $this->list_statuses = $statuses;
		}else{
			echo "No statuses available";
		}
	}
	
	public function getHTMLStatuses($list_name){
		$list = $this->getListStatuses($list_name);
		$html_string = "<div class='twitlist'>";
		foreach($list as $twit){
			$html_string .= "<div class='twit'>";
			$html_string .=	"<img src='".$twit->user->profile_image_url."' alt='".$twit->user->name."' />";
			$html_string .= "<p class='name'>". $twit->user->screen_name ."</p>";
    		$html_string .= "<p class='text'>". $twit->text ."</p>";
    		$html_string .= "<p class='date'><a href='http://twitter.com/#!/".$twit->user->name."/status/".$twit->id_str."'>".$this->since( $twit->created_at )."</a></p>";
			$html_string .= "</div>";
		}
		$html_string .= "</div>";
		echo $this->html_statuses = $html_string;
	}
	
	private function getListID($list_name){
		foreach($this->lists as $list){
			if($list->name == $list_name){
				return $list->id;
			}
		}
	}
	
	private function getJSONFromURL($url){
		$data_string = file_get_contents($url);
		return $object = json_decode($data_string);
	}
	
	private function since($datetime){
		$datetime = round((time() - strtotime($datetime)) / 60);
		if($datetime < 1)
			return 'Hace unos segundos.';
		if($datetime == 1)
			return 'Hace un minuto aproximadamente.';
		if($datetime < 60)
			return 'Hace ' . $datetime . ' minutos.';
		if($datetime >= 60) {
			$datetime = round($datetime / 60);
			if($datetime == 1)
				return 'Hace una hora aproximadamente.';
			if($datetime < 24)
				return 'Hace ' . $datetime . ' horas.';
			if($datetime >= 24) {
				$datetime = round($datetime / 24);
				if($datetime == 1)
					return 'Hace un dia aproximadamente.';
				if($datetime < 7)
					return 'Hace ' . $datetime . ' dias.';
				if($datetime >= 7){
					$datetime = round($datetime / 7);
					if($datetime == 1)
						return 'Hace una semana aproximadamente.';
					if($datetime < 4)
						return 'Hace mas de una semana';
					else
						return 'Hace mas de un mes';
				}
			}
		}
	}
}
?>