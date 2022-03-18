<?php 

$title = "Auction Site";
require("Header.php"); 

?>

	<div class="container">

        <main role="main">

			<h1>Welcome to Auction Site</h1>
			<h2>Login or Apply Here</h2>

			<div class="login_apply">

				<div class="box">

					<h2>Customer</h2>

					<div class="login_apply_buttons">

						<a href="CustomerApply.php" class="login_apply_button"> <button class="fill_button">Apply</button> </a>

						<a href="CustomerLogin.php" class="login_apply_button"> <button class="fill_button">Login</button> </a>

					</div>
						

				</div>

				<div class="box">

					<h2>Seller</h2>

					<div class="login_apply_buttons">

						<a href="CustomerApply.php" class="login_apply_button"> <button class="fill_button">Apply</button> </a>

						<a href="CustomerLogin.php" class="login_apply_button"> <button class="fill_button">Login</button> </a>
						
					</div>

				</div>

			</div>

		</main>

	</div>

<?php require("Footer.php"); ?>


