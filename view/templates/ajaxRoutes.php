<?php if(!empty($routes['list'])){ ?>
<table id="tasks">
	<tr>
		<th>Date</th>
		<th>Name</th>
		<th>Count</th>
		<th>Distance</th>
	</tr>
	<?php foreach($routes['list'] as $route){ ?>
	<tr>
		<td><?=e($route['Date']); ?></td>
		<td><?=e($route['Name']); ?></td>
		<td><?=e($route['Count']); ?></td>
		<td><?=e($route['Distance']); ?></td>
	</tr>
	<?php }?>
</table>
<div class="paging">
	<?php for($i = 1; $i <= $pages; $i++) { ?>
		<?php if($i != $current_page) { ?>
			<a href="<?php echo $page_link . $i; ?>"><?=$i; ?></a>
		<?php } else { ?>
			<span><?=$i; ?></span>
		<?php } ?>
	<?php } ?>
</div>
<?php } ?>

<script>

pages_links_init();

</script>