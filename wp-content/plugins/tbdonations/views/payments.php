<?php
	$payments = $this->db->fetch('tbdonations_payment');
	$paid = array(0 => 'Pendding',1=> 'Success');
?>
<div class="payment_wrap">
	<h2><?php _e('Payments','tbdonations'); ?></h2>
	<table class="wp-list-table widefat fixed striped posts">
		<tr>
			<th><?php _e('Donation','tbdonations'); ?></th>
			<th><?php _e('Datetime','tbdonations'); ?></th>
			<th><?php _e('First Name','tbdonations'); ?></th>
			<th><?php _e('Last Name','tbdonations'); ?></th>
			<th><?php _e('Email','tbdonations'); ?></th>
			<th><?php _e('Phone','tbdonations'); ?></th>
			<th><?php _e('Address','tbdonations'); ?></th>
			<th><?php _e('Note','tbdonations'); ?></th>
			<th><?php _e('Paid','tbdonations'); ?></th>
		</tr>
		<?php
		if($payments):
			foreach($payments as $k=>$v): ?>
				<tr>
					<td><?php echo get_the_title($v['donations_id'])? get_the_title($v['donations_id']) : 'Donation site';?></td>
					<td><?php echo $v['date'];?></td>
					<td><?php echo $v['firstname'];?></td>
					<td><?php echo $v['lastname'];?></td>
					<td><?php echo $v['email'];?></td>
					<td><?php echo $v['phone'];?></td>
					<td><?php echo $v['address'];?></td>
					<td><?php echo $v['addition_notes'];?></td>
					<td><?php echo $paid[$v['paid']];?></td>
				</tr>
			<?php endforeach;
		endif;
		?>
	</table>
</div>