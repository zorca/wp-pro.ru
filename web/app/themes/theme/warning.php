<?php
/**
 *  Warning page template.
 *
 * @package WordPress/AskBug
 * @author Rahul Aryan <support@anspress.io>
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
	<head>
		<title>Warning! Please install or update AnsPress</title>
		<style>
			.ab-warning{
				max-width: 800px;
				margin: 80px auto;
				font-family: -apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,Oxygen-Sans,Ubuntu,Cantarell,"Helvetica Neue",sans-serif;
				background: #FFF3E0;
				border: solid 2px #FFCC80;
				border-radius: 3px;
				padding: 25px;
				font-size: 17px;
				text-align: center;
			}
			a{
				text-decoration: none;
				color: #F44336;
				font-weight: bold;
			}
			h1 {
				font-size: 20px;
				margin-top: 0;
			}
			#loginform{
				max-width: 250px;
				margin: 0 auto;
				text-align: left;
				padding: 5px;
				margin-top: 20px;
			}
			#loginform input[type="text"], #loginform input[type="password"]{
				border: solid 2px #d2d2d2;
				padding: 7px 10px;
				border-radius: 3px;
				width: 100%;
				-moz-box-sizing: border-box;
				-webkit-box-sizing: border-box;
				-ms-box-sizing: border-box;
				-o-box-sizing: border-box;
				box-sizing: border-box;
			}
			label {
				margin-bottom: 6px;
				display: block;
				font-size: 14px;
				color: #333;
			}
			input#wp-submit {
				margin: 0 auto;
				display: block;
				padding: 10px 45px;
				border-radius: 3px;
				background: #FF9800;
				border: none;
				color: #fff;
				font-weight: bold;
			}
		</style>
	</head>
	<body>
		<div class="container">
			<div class="ab-warning">
				<h1>AnsPress 4.0 not found!</h1>
				<?php
					echo __( 'Please update or install AnsPress 4.0 to use AskBug theme. If AnsPress already installed make sure to activate it. If you have more questions about this, please get in touch with us at ', 'ab' ) . '<a href="https://anspress.io/questions/" target="_blank">AnsPress Support</a>';
				?>

				<?php
					if ( ! is_user_logged_in() ) {
						wp_login_form( array(
							'redirect'       => admin_url( '/' ),
							'label_username' => __( 'Username' ),
						) );
					}
				?>
			</div>
		</div>
	</body>
</html>
