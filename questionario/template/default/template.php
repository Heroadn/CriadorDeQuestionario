<?php
	class Template{
		public $_title = '1aasda';

		 public static function getHeaders($title) {
			$path = '/questionario';
			 
			echo "<head>\n";
			echo '		<title>' . $title . "</title>\n";
			
			echo '<meta charset="utf-8">';
			echo '<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">';
			echo '		<link href="' . $path . '/core/frontend/css/core.css" rel="stylesheet">' . "\n";
			echo '		<link href="' . $path .  '/core/frontend/css/bootstrap.min.css" rel="stylesheet">' . "\n";
			echo '		<link href="' . $path .  '/core/frontend/js/font-awesome/css/font-awesome.min.css" rel="stylesheet">' . "\n";
			echo '		<script src="' . $path . '/core/frontend/js/jquery.js"></script>' . "\n";
			echo '		<script src="' . $path . '/core/frontend/js/bootstrap.min.js"></script>' . "\n";
			echo '		<script src="' . $path . '/core/frontend/js/canvasjs.min.js"></script>' . "\n";
			echo '	</head>';
			
			require '../../menu.php';
			
			echo '<style>
					body {
							background-color: #25272F;
							background-image: url("'. $path .'/template/default/images/algorithm.jpg");
							background-repeat: no-repeat;
							background-size: cover;
						}
			
					/* Extra small devices (phones, up to 480px) */
					@media screen and (max-width: 767px) {
						.panel-default>.panel-heading{
							font-size: 4.0vw;
						}
						
						.panel-info>.panel-heading {
							font-size: 4.0vw;
						}
						
						.panel-body {
							font-size: 4.0vw;
						}
						
						input[type=checkbox], input[type=radio] {
							width:30px;
							height:30px;
						}
					}
					
					/* Small devices (tablets, 768px and up) */
					@media (min-width: 768px) and (max-width: 991px) {
						.panel-default>.panel-heading{
							font-size: 4.0vw;
						}
						
						.panel-info>.panel-heading {
							font-size: 4.0vw;
						}
						
						.panel-body {
							font-size: 4.0vw;
						}
						
						input[type=checkbox], input[type=radio] {
							width:30px;
							height:30px;
						}
					}
					
					/* tablets/desktops and up ----------- */
					@media (min-width: 992px) and (max-width: 1199px) {	
						.panel-default>.panel-heading{
							font-size: 2.0vw;
						}
						
						.panel-info>.panel-heading {
							font-size: 1.5vw;
						}
						
						.panel-body {
							font-size: 1.5vw;
						}
						
						input[type=checkbox], input[type=radio] {
							width:20px;
							height:20px;
						}
					}
					
					/* large desktops and up ----------- */
					@media screen and (min-width: 1200px) {	
						.panel-default>.panel-heading{
							font-size: 2.0vw;
						}
						
						.panel-info>.panel-heading {
							font-size: 1.5vw;
						}
						
						.panel-body {
							font-size: 1.5vw;
						}
						
						input[type=checkbox], input[type=radio] {
							width:20px;
							height:20px;
						}
					}

					.starter-template {
						padding: 0px 15px;
					}
					header{
						height:60px;
						padding-top: 15px;
					}
					img{
						max-width: 95%;
					}
					.container-fluid{
						margin-top:5%;
					}
				</style>';
		}		
	}
?>
