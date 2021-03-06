<?php defined('C5_EXECUTE') or die('Access Denied.'); 

\View::element('_errors', array('bp_errors' => $bp_errors, 'backup_meta' => $backup_meta, 'context' => $this, 'view_helper' => $view_helper), 'backup_pro');
\View::element('_dashboard_nav', array('active_tab' => 'dashboard', 'context' => $this, 'view_helper' => $view_helper), 'backup_pro');
$space_available_header = $view_helper->m62Lang('total_space_available');
if($settings['auto_threshold'] != '0')
{
    $space_available_header .= ' ('.$available_space['available_percentage'].'%)';
}
?>

    <div class="panel">
    	<table border="0" cellspacing="0" cellpadding="0" class="table"  width="100%" >
    	<thead>
    	<tr>
    		<th width="120"><?php echo $view_helper->m62Lang('total_backups'); ?></th>
    		<th><?php echo $view_helper->m62Lang('total_space_used'); ?></th>
    		<th><?php echo $space_available_header; ?></th>
    		<th><div style="float:right"><?php echo $view_helper->m62Lang('last_backup_taken'); ?></div></th>
    		<th><div style="float:right"><?php echo $view_helper->m62Lang('first_backup_taken'); ?></div></th>
    	</tr>
    	</thead>
    	<tbody>
    	<tr>
    		<td width='120'> <?php echo $backup_meta['global']['total_backups']; ?> </td>
    		<td width='150'><?php echo $backup_meta['global']['total_space_used']; ?></td>
    		<td><?php echo ($settings['auto_threshold'] == '0' ? $view_helper->m62Lang('unlimited') : $available_space['available_space'].' / '.$available_space['max_space']); ?></td>
    		<td align='right' width='150'><?php echo ($backup_meta['global']['newest_backup_taken'] != '' ? $view_helper->m62DateTime($backup_meta['global']['newest_backup_taken']) : $view_helper->m62Lang('na')); ?></td>
    		<td align='right' width='150'><?php echo ($backup_meta['global']['oldest_backup_taken'] != '' ? $view_helper->m62DateTime($backup_meta['global']['oldest_backup_taken']) : $view_helper->m62Lang('na')); ?></td>
    	</tr>
    	</tbody>
    	</table>
	</div>

<div class=" panel">

	<div class="col-md-6 ">
				<table class="table"  width="100%" border="0" cellpadding="0" cellspacing="0">
					<thead>
						<tr class="odd">
							<th width="50%"><?php echo $view_helper->m62Lang('database_backups'); ?></th>
							<th> </th>
						</tr>
					</thead>
					<tbody>
					<tr class="even">
						<td><strong><?php echo $view_helper->m62Lang('total_backups'); ?></strong></td>
						<td><?php echo $backup_meta['database']['total_backups']; ?></td>
					</tr>
					<tr class="odd">
						<td><strong><?php echo $view_helper->m62Lang('total_space_used'); ?></strong></td>
						<td><?php echo $backup_meta['database']['total_space_used']; ?></td>
					</tr>
					<tr class="even">
						<td><strong><?php echo $view_helper->m62Lang('last_backup_taken'); ?></strong></td>
						<td><?php echo ($backup_meta['database']['newest_backup_taken'] != '' ? $view_helper->m62DateTime($backup_meta['database']['newest_backup_taken']) : $view_helper->m62Lang('na')); ?></td>
					</tr>
					</tbody>
				</table>	
	</div>
	<div class="col-md-6 ">
	
				<table class="table"  width="100%" border="0" cellpadding="0" cellspacing="0">
					<thead>
						<tr class="odd">
							<th width="50%"><?php echo $view_helper->m62Lang('file_backups'); ?></th>
							<th> </th>
						</tr>
					</thead>
					<tbody>
						<tr class="even">
						<td><strong><?php echo $view_helper->m62Lang('total_backups'); ?></strong></td>
							<td><?php echo $backup_meta['files']['total_backups']; ?></td>
						</tr>
					<tr class="odd">
						<td><strong><?php echo $view_helper->m62Lang('total_space_used'); ?></strong></td>
						<td><?php echo $backup_meta['files']['total_space_used']; ?></td>
					<tr class="even">
						<td><strong><?php echo $view_helper->m62Lang('last_backup_taken'); ?></strong></td>
						<td><?php echo ($backup_meta['files']['newest_backup_taken'] != '' ? $view_helper->m62DateTime($backup_meta['files']['newest_backup_taken']) : $view_helper->m62Lang('na')); ?></td>
					</tr>
				</tbody>
				</table>		
	
	</div>

</div>

<div class=" panel">

	<?php 
		if(count($backups) > 0):
			$options = array(
			    'enable_type' => 'yes', 
			    'enable_editable_note' => 
			    'yes', 'enable_actions' => 'yes', 
			    'enable_delete' => 'no',
			    'backups' => $backups,
			    'context' => $this,
			    'view_helper' => $view_helper,
			    'bp_static_path' => $bp_static_path			    
            );
            \View::element('_backup_table', $options, 'backup_pro');
	?>
	<?php else: ?>
		<div class="no_backup_found"><?php echo $view_helper->m62Lang('no_backups_exist')?> <a href="<?php echo $this->url('/dashboard/backup_pro/backup_database'); ?>"><?php echo $view_helper->m62Lang('would_you_like_to_backup_database_now')?></a></div>
	<?php endif; ?>

</div>