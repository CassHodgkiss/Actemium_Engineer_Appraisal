<!doctype html>
<html lang="en">
  <head>
    <?php echo "<title>" . $title . "</title>" ?>
    
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous"> 
	<link rel="stylesheet" href="/auction_site/css/mobile.css"  />
	<link rel="stylesheet" href="/auction_site/css/tablet.css" media="only screen and (min-width: 512px)" />
	<link rel="stylesheet" href="/auction_site/css/desktop.css" media="only screen and (min-width: 768px)" />

  </head>

<body>
	<header>

			<nav class="navbar navbar-expand-md navbar-toggleable-md navbar-light bg-white border-bottom box-shadow mb-3">

				<div class="container">
					<a class="navbar-brand" href="/auction_site/admin/AdminIndex.php">Auction Site</a>

					<button class="navbar-toggler" type="button" data-toggle="collapse" data-target=".navbar-collapse" aria-controls="navbarSupportedContent"
							aria-expanded="false" aria-label="Toggle navigation">
						<span class="navbar-toggler-icon"></span>
					</button>

					<div class="navbar-collapse collapse d-md-inline-flex flex-md-row-reverse">

						<ul class="navbar-nav">

							<li class="nav-item">
								<a class="nav-link text-dark" href="/auction_site/Auctions.php">View Auctions</a>
							</li>
							
							<li class="nav-item">
								<a class="nav-link text-dark" href="/auction_site/admin/AdminIndex.php">DashBoard</a>
							</li>

							<li class="nav-item">
								<a class="nav-link text-dark" href="/auction_site/session/logout.php">Log Out</a>
							</li>

						</ul>
					</div>
				</div>
			</nav>
	</header>
