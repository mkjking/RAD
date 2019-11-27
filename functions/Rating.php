<?php
// 
// Rating class that is serialized and sent to ratings_tbl for comparison
// 
// 
	class Rating {
		public $id;
		public $name;
		public $likes;

		function setId($id) {
			$this->id = $id;
		}
		function getId() {
			return $this->id;
		}

		function setName($name) {
			$this->name = $name;
		}
		function getName() {
			return $this->name;
		}

		function setLikes($likes) {
			$this->likes = $likes;
		}
		function getLikes() {
			return $this->likes;
		}
	}	
?>