<!DOCTYPE html>
<html lang="en">
	
	<head>
		
		<meta charset="utf-8" />
		<title>Home - Guitar sales</title>
		<link rel="stylesheet" href="css/style.css" />
		<meta name="viewport" content="width=device-width" />
		<link rel="icon" href="vg.ico" />
		<style>
			#ad
			{
				max-width: 750px;
				padding: 4rem 2rem;
				border: 1px solid #2e2e2e;
				position: relative;
				top: 100px;
				text-align: center;
				margin: auto;
				box-shadow: 0 0 40px 5px rgba(255,255,255,.15);
			}
			
			h1
			{
				margin-top: 0;
			}
			
			ul
			{
				display: flex;
				justify-content: space-around;
				flex-wrap: wrap;
				padding: 0;
				margin: 48px 0;
				list-style-type: none;
			}
			
			ul li
			{
				margin: 22px 0;
			}
			
			ul a
			{
				margin-top: 3rem;
				font-size: 1.25rem;
				width: 20rem;
				max-width: 100%;
				padding: 1rem;
				font-weight: 700;
				border-radius: 4px;
			}
			
			ul a:hover
			{
				text-decoration: none;
			}
			
			a[href*="index"]
			{
				color: black;
				background-color: #F90;
			}
			
			a[href*="index"]:hover
			{
				background-color: #ffa31a;
			}
			
			a[href*="google"]
			{
				color: white;
				background-color: #1F1F1F;
			}
			
			a[href*="google"]:hover
			{
				background-color: #3F3F3F;
			}
		</style>
		
	</head>
	
	<body>
		
		<div id="ad">
			<h1>Guitar <span id="g">sales</span></h1>
			<h2>Level verification</h2>
			<p>This website contains music material, including sheet music and explicit representations of guitars. By registering, you affirm that you have at least a good level of guitar playing ability in the jurisdiction from which you are accessing the website, and that you consent to the viewing of explicit guitar content.</p>
			<ul>
				<li><a href="index.php?verif">I have the level - Enter</a></li>
				<li><a href="https://google.fr/">I don't have the level - Leave</a></li>
			</ul>
			<p>Our <a href="#">music control page</a> explains how you can easily block access to this site.</p>
		</div>
		
	</body>
	
</html>
