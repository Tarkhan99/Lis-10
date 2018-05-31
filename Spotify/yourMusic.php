<?php 

	include("Includes/includedFiles.php");

 ?>

 <div class="playlistsContainer">
 	
 	<div class="gridViewContainer">
 		
 		<h2>PLAYLISTS</h2>

 		<div class="buttonItems">
 			<button class="button green" onclick="createPlaylist()">NEW PLAYLIST</button>
 		</div>

 		<?php 

 			$username=$username->getUsername();

 			$playlistQuery=mysqli_query($con,"SELECT * FROM playlists WHERE owner='$username'");

 			if (mysqli_num_rows($playlistQuery)==0) {
 				echo "<span class='noResults'>You don't have any playlist yet.</span>";
 			}

 			while($row=mysqli_fetch_array($playlistQuery)){

 				$playlist=new Playlist($con,$row);

 				echo "<div style='cursor:pointer;' class='gridViewItem' role='link' tabindex='0' onclick='openPage(\"playlist.php?id=".$playlist->getId()."\")'>
							
							<div class='playlistImage'>
								<img src='assets/images/icons/playlist.png'>
							</div>


							<div class='gridViewInfo'>
								".$playlist->getName()."
							</div>

							
					  </div>";
 			}

 		 ?>

 	</div>

 </div>