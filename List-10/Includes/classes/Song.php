<?php 

	class Song {

		private $con;
		private $id;
		private $mysqliData;
		private $title;
		private $albumId;
		private $artistId;
		private $genre;
		private $duration;
		private $path;

		public function __construct($con,$id)
		{
			$this->con=$con;
			$this->id=$id;

			$query=mysqli_query($this->con,"SELECT * FROM songs WHERE id=$this->id");
			$mysqliData=mysqli_fetch_array($query);

			$this->title=$mysqliData['title'];
			$this->albumId=$mysqliData['album'];
			$this->artistId=$mysqliData['artist'];
			$this->genre=$mysqliData['genre'];
			$this->duration=$mysqliData['duration'];
			$this->path=$mysqliData['path'];

		}


		public function getTitle(){
			return $this->title;
		}

		public function getIds(){
			return $this->id;
		}

		public function getAlbum(){
			return new Album($this->con,$this->albumId);
		}

		public function getArtist(){
			return new Artist($this->con,$this->artistId);
		}

		public function getGenre(){
			return $this->genre;
		}

		public function getDuration(){
			return $this->duration;
		}

		public function getPath(){
			return $this->path;
		}
		

	}

 ?>