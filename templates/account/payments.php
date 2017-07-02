<?php
	/**
	 * @package     Freemius
	 * @copyright   Copyright (c) 2016, Freemius, Inc.
	 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
	 * @since       1.2.0
	 */

	if ( ! defined( 'ABSPATH' ) ) {
		exit;
	}

	/**
	 * @var array $VARS
	 * @var Freemius $fs
	 */
	$fs = freemius( $VARS['id'] );

	$slug = $fs->get_slug();

	$payments = $fs->_fetch_payments();

	$show_payments = ( is_array( $payments ) && 0 < count( $payments ) );

	if ( $show_payments ) :
?>
<div class="postbox">
	<div id="fs_payments">
		<h3><span class="dashicons dashicons-paperclip"></span> <?php fs_echo( 'payments', $slug ) ?></h3>

		<div class="inside">
			<table class="widefat">
				<thead>
				<tr>
					<th><?php fs_echo( 'id', $slug ) ?></th>
					<th><?php fs_echo( 'date', $slug ) ?></th>
					<th><?php fs_echo( 'amount', $slug ) ?></th>
					<th><?php fs_echo( 'invoice', $slug ) ?></th>
				</tr>
				</thead>
				<tbody>
				<?php $odd = true ?>
				<?php foreach ( $payments as $payment ) : ?>
					<tr<?php echo $odd ? ' class="alternate"' : '' ?>>
						<td><?php echo $payment->id ?></td>
						<td><?php echo date( 'M j, Y', strtotime( $payment->created ) ) ?></td>
						<td>$<?php echo $payment->gross ?></td>
						<td><a href="<?php echo $fs->_get_invoice_api_url( $payment->id ) ?>"
						       class="button button-small"
						       target="_blank"><?php fs_echo( 'invoice', $slug ) ?></a></td>
					</tr>
					<?php $odd = ! $odd; endforeach ?>
				</tbody>
			</table>
		</div>
	</div>
</div>
<?php
	endif;