<?php
	class Template{
		public $_title = '1aasda';

		 public static function getHeaders($title) {
			echo "<head>\n";
			echo '		<title>' . $title . "</title>\n";
			echo '		<link href="' .  '/questionario/core/frontend/css/core.css" rel="stylesheet">' . "\n";
			echo '		<link href="' .  '/questionario/core/frontend/css/bootstrap.min.css" rel="stylesheet">' . "\n";
			echo '		<link href="' .  '/questionario/core/frontend/js/font-awesome/css/font-awesome.min.css" rel="stylesheet">' . "\n";
			echo '		<script src="' . '/questionario/core/frontend/js/jquery.js"></script>' . "\n";
			echo '		<script src="' . '/questionario/core/frontend/js/bootstrap.min.js"></script>' . "\n";
			echo '		<script src="' . '/questionario/core/frontend/js/canvasjs.min.js"></script>' . "\n";
			echo '	</head>';
			
			echo '<style>
					body {
						background-color: #25272F;
						background-image: url("/questionario/template/default/images/algorithm.jpg");
						background-repeat: no-repeat;
						background-size: cover;
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