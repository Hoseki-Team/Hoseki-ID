		<nav id="nav">
			<!-- Lista generale -->
			<ul>
				<!-- 1° Elemento: Home -->
				<li class="nav_selected">
					<a href="index.html">Home</a>
				</li>
				
				<!-- 2° Elemento: Blog -->
				<li>
					<a href="blog/index.html">Blog</a>
				</li>
				
				<!-- 2° Elemento: Contattaci -->
				<li>
					<a href="contatti.html">Contatti</a>
				</li>

				<!-- 3° Elemento: Hoseki Team -->
				<li>
					<a id="team">Team</a>
					<ul>
						<li>
							<a href="team/team.html" onmouseover="setClass('team')" onmouseout="removeClass('team')">Chi  siamo</a>
						</li>
						<li>
							<a href="team/members.html" onmouseover="setClass('team')" onmouseout="removeClass('team')">Membri</a>
						</li>
					</ul>
				</li>
				
				<!-- 4° Elemento: Progetti -->
				<li>
					<a id="projects">Progetti</a>
					<ul>
						<li>
							<a href="/project/cremisi-portal.html" onmouseover="setClass('projects')" onmouseout="removeClass('projects')">Cremisi  Portals</a>
						</li>
						<li>
							<a href="project/red-adventure.html" onmouseover="setClass('projects')" onmouseout="removeClass('projects')">Red  Adventure</a>
						</li>
						<li>
							<a href="project/divine-bond.html" onmouseover="setClass('projects')" onmouseout="removeClass('projects')">Divine  Bond</a>
						</li>
						<li>
							<a href="project/oxy.html" onmouseover="setClass('projects')" onmouseout="removeClass('projects')">Oxy</a>
						</li>
					</ul>
				</li>
			</ul>
			
			<ul id="nav_user">
				<?php if (!$logged): ?>
				<script language="javascript" charset="UTF-8">
					$(document).ready(function(){
					    $('#login-trigger').click(function() {
					        $(this).next('#login-content').toggle();
					        $(this).toggleClass('nav_selected');                    
					        
					        })
					});
				</script>
				<li id="login">
					<a id="login-trigger" href="#">Entra</a>
					<div id="login-content">
						<form action="login.php" method="post">	<!-- TODO -->
							<fieldset id="inputs">
								<input id="username" type="text" name="username" placeholder="Username" required>   
								<input id="password" type="password" name="password" placeholder="Password" required>
							</fieldset>
							<fieldset id="actions">
								<input type="submit" class="button">
								<label><input type="checkbox" class="checkbox" checked="checked"><span class="standard">Rimani connesso</span></label>
							</fieldset>
						</form>
					</div>                     
        		</li>

				<li id="signup">
					<a href="<?= $path ?>/signup.php">Registrati</a>
				</li>
				<?php else: ?>
				<li>
					<a href="#"><?php echo htmlspecialchars($_SESSION["username"]); ?></a>
				</li>
				<li>
					<a href="#">Esci</a>
				</li>
				<?php endif; ?>
			</ul>
		</nav>