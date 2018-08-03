<?php
/**
 * User edit profile template
 *
 * @link https://anspress.io
 * @since 4.0.0
 * @package WordPress/AnsPress
 */

$user = get_user_by( 'id', ap_current_user_id() );
$user_meta = get_user_meta( get_current_user_id() );
$user_meta = array_map( function( $a ) {
	return $a[0];
}, $user_meta );

$public_display = [];

if ( ! empty( $user_meta['nickname'] ) ) {
	$public_display[] = $user_meta['nickname'];
}

if ( ! empty( $user_meta['user_login'] ) ) {
	$public_display[] = $user_meta['user_login'];
}

if ( ! empty( $user_meta['first_name'] ) ) {
	$public_display[] = $user_meta['first_name'];
}

if ( ! empty( $user_meta['last_name'] ) ) {
	$public_display[] = $user_meta['last_name'];
}

if ( ! empty( $user_meta['first_name'] ) && ! empty( $user_meta['last_name'] ) ) {
	$public_display[] = $user_meta['first_name'] . ' ' . $user_meta['last_name'];
	$public_display[] = $user_meta['last_name'] . ' ' . $user_meta['first_name'];
}
?>

<div class="ap-user-edit">
	<form class="ab-profile-edit form-horizontal" method="POST" id="ab_edit_profile" apform>
		<!-- Userlogin -->
		<div class="form-group">
			<label for="userlogin" class="col-sm-2 control-label"><?php _e( 'Username', 'ab' ); ?></label>
			<div class="col-sm-10">
				<input name="userlogin" id="userlogin" class="form-control" type="text" disabled="disabled" value="<?php echo esc_attr( $user->user_login ); ?>" />
			</div>
		</div>
		<!-- /Userlogin -->

		<!-- Email -->
		<div class="form-group">
			<label for="email" class="col-sm-2 control-label"><?php _e( 'Email', 'ab' ); ?></label>
			<div class="col-sm-10">
				<input name="email" id="email" class="form-control" type="text" disabled="disabled" value="<?php echo esc_attr( $user->user_email ); ?>" />
			</div>
		</div>
		<!-- /Email -->

		<!-- First name -->
		<div class="form-group">
			<label for="first_name" class="col-sm-2 control-label"><?php _e( 'First Name', 'ab' ); ?></label>
			<div class="col-sm-10">
				<input name="first_name" id="first_name" class="form-control" type="text" value="<?php echo esc_attr( $user->user_firstname ); ?>" />
			</div>
		</div>
		<!-- /First name -->

		<!-- Last name -->
		<div class="form-group">
			<label for="last_name" class="col-sm-2 control-label"><?php _e( 'Last Name', 'ab' ); ?></label>
			<div class="col-sm-10">
				<input name="last_name" id="last_name" class="form-control" type="text" value="<?php echo esc_attr( $user->user_lastname ); ?>" />
			</div>
		</div>
		<!-- /Last name -->

		<!-- Nick name -->
		<div class="form-group">
			<label for="nickname" class="col-sm-2 control-label"><?php _e( 'Nickname', 'ab' ); ?></label>
			<div class="col-sm-10">
				<input name="nickname" id="nickname" class="form-control" type="text" value="<?php echo esc_attr( $user->nickname ); ?>" />
			</div>
		</div>
		<!-- /Nick name -->

		<!-- Display name -->
		<div class="form-group">
			<label for="display_name" class="col-sm-2 control-label"><?php _e( 'Display Name', 'ab' ); ?></label>
			<div class="col-sm-10">
				<select name="display_name" id="display_name" class="form-control">
					<?php
					foreach ( $public_display as $name ) {
						echo '<option value="' . esc_attr( $name ) . '" ' . selected( $user->display_name, $name, false ) . '>' . esc_attr( $name ) . '</option>';
					}
					?>
				</select>
			</div>
		</div>
		<!-- /Display name -->

		<!-- Url name -->
		<div class="form-group">
			<label for="user_url" class="col-sm-2 control-label"><?php _e( 'Website', 'ab' ); ?></label>
			<div class="col-sm-10">
				<input name="user_url" id="user_url" class="form-control" type="text" value="<?php echo esc_attr( $user->user_url ); ?>" />
			</div>
		</div>
		<!-- /Url name -->

		<!-- Description name -->
		<div class="form-group">
			<label for="description" class="col-sm-2 control-label"><?php _e( 'Description', 'ab' ); ?></label>
			<div class="col-sm-10">
				<textarea name="description" id="description" class="form-control" rows="5"><?php echo esc_attr( $user_meta['description'] ); ?></textarea>
			</div>
		</div>
		<!-- /Description name -->

		<div class="form-group">
			<div class="col-sm-offset-2 col-sm-10">
				<button type="submit" class="btn btn-default"><?php _e( 'Update Profile', 'ab' ); ?></button>
			</div>
		</div>

		<input type="hidden" name="action" value="ap_ajax" />
		<input type="hidden" name="ap_ajax_action" value="ab_update_user_profile" />
		<input type="hidden" name="__nonce" value="<?php echo wp_create_nonce( 'update_profile' ); ?>" />

	</from>
</div>
