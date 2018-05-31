<?php 

include("Includes/includedFiles.php") ;


	if(isset($_GET['id'])){
		$albumId=$_GET['id'];
	}else{
		header("Location: index.php");
	}

	$album=new Album($con,$_GET['id']);

	$artist=$album->getArtist();

  	
?>

<div class="entityInfo">
	
	<div class="leftSection">
		<img src="<?php echo $album->getArtworkPath() ?>">	
	</div>

	<div class="rightSection">
		<h2><?php echo $album->getTitle() ?></h2>
		<p>By <?php echo $artist->getName() ?></p>
		<p><?php echo $album->getNumberOfSongs() ?> songs</p>
	</div>

</div>

<div class="tracklistContainer">
		<ul class="tracklist">
			<?php 

				$songsIdArray=$album->getSongIds();
				$i=1;
				foreach($songsIdArray as $songId){
					
					$albumSong=new Song($con,$songId);
					$albumArtist=$albumSong->getArtist();

					echo "<li class='tracklistRow'>

							<div class='trackCount'>
								<img class='play' src='assets/images/icons/play-white.png' onclick='setTrack(\"". $albumSong->getIds()."\",tempPlaylist,true)'>
								<span clas='trackNumber'>$i</span>
							</div>

							<div class='trackInfo'>
								<span class='trackName'>".$albumSong->getTitle()."</span>
								<span class='artistName'>".$albumArtist->getName()."</span>
							</div>

							<div class='trackOptions'>
								<input class='songId' type='hidden' value='".$albumSong->getIds()."'>
								<img class='optionsButton' src='assets/images/icons/more.png' onclick='showOptionsMenu(this)'>
							</div>

							<div class='trackDuration'>
								<span class='duration'>".$albumSong->getDuration()."</span>
							</div>


						 </li>";
					$i++;
				}

			 ?>
			 <script>
			 	var tempSongIds='<?php echo json_encode($songsIdArray); ?>';
			 	tempPlaylist=JSON.parse(tempSongIds);
			 </script>
		</ul>
	</div>

	

	<nav class="optionsMenu">
		<div ></div>
		<input type="hidden" class="songId">
		<?php echo Playlist::getPlaylistDropdown($con,$username->getUsername()); ?>
	</nav>



