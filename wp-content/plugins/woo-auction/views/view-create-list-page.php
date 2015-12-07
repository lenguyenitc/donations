<div class="wa-content-custom-pages">
	<table class="wp-list-table widefat fixed striped posts">
		<thead>
			<tr>
				<?php foreach($manage_header_columns as $col){ ?>
				<th class="manage-column" style=""><?php echo "{$col}"; ?></th>
				<?php } ?>
			</tr>
		</thead>

		<tbody>
			<?php if( count( $manage_datas ) > 0 ){ 
				foreach( $manage_datas as $item ){ ?>
			<tr>
				<?php foreach( $manage_content_columns as $col ){
					$content = ( isset( $filter ) )? call_user_func_array( $filter, array( $col, $item ) ) : $item[$col];
					echo "<td>" . $content .  "</td>";
				} ?>
			</tr> 
			<?php } } else { ?>
			<tr>
				<td><?php _e( 'Not item.', 'wa' ); ?></td>
			</tr>
			<?php } ?>
		</tbody>
	</table>
	<div>
		<?php echo "{$pagination}"; ?>
	</div>
</div>