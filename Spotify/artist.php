<?php 
	include("Includes/includedFiles.php");


	if (isset($_GET['id'])) {
		$artistId=$_GET['id'];
	}else{
		header("Location: index.php");
	}

	$artist=new Artist($con,$artistId);

 ?>
 

 <div class="entityInfo borderBottom">
 	
 	<div class="centerSection">
 		
 		<div class="artistInfo">
 			
 			<h1 class="artistName"><?php echo $artist->getName(); ?></h1>

 			<div class="headerButtons">
 				<button class="button green" onclick="playFirstSong()">PLAY</button>
 			</div>

 		</div>

 	</div>

 </div>

 <div class="tracklistContainer borderBottom">
 		<h2>Songs</h2>
		<ul class="tracklist">
			<?php 

				$songsIdArray=$artist->getSongIds();
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

	<div class="gridViewContainer">
		<h2>Albums</h2>
		<?php 

			$albumQuery=mysqli_query($con,"SELECT * FROM albums WHERE artist='$artistId'");

			while ($row=mysqli_fetch_array($albumQuery)) {
				
					echo "<div class='gridViewItem'>
							<a href='album.php?id=" . $row['id'] . "'>
								<img src='".$row['artworkPath']."'>

								<div class='gridViewInfo'>"
									.$row['title']."
								</div>

							</a>
						  </div>";

			}

		 ?>

	</div>

	<nav class="optionsMenu">
		<div ></div>
		<input type="hidden" class="songId">
		<?php echo Playlist::getPlaylistDropdown($con,$username->getUsername()); ?>
	</nav>
