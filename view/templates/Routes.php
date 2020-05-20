<?php
	
?>

<?php if(!empty($routes['list'])){ ?>
	<div id="filter">
		<div class="filter-block">
			<h3>Filter</h3>
			<label>Field</label>
			<select name="filter_field" class="filter_field">
				<option value=""></option>
				<option value="Date">Date</option>
				<option value="Count">Count</option>
				<option value="Distance">Distance</option>
			</select>
			<label>Rule</label>
			<select name="filter_rule" class="filter_rule">
				<option value=""></option>
				<option value="more">More</option>
				<option value="less">Less</option>
				<option value="like">Like</option>
				<option value="equal">Equal</option>
			</select>
			<input type="text" name="filter_value" value="" placeholder="Value..." onkeyup="this.value = this.value.replace(/[^\d-]/g,'');"/>
			<span>Дата вводится в формате %Y-%m-%d</span>
		</div>
		<div class="sorting-block">
			<h3>Sorting</h3>
			<label>Field</label>
			<select name="sorting_field" class="sorting_field">
				<option value=""></option>
				<option value="Name" <?php echo ( ( $sorting_field == 'Name') ? "selected" : "" ); ?> >Name</option>
				<option value="Count" <?php echo ( ( $sorting_field == 'Count') ? "selected" : "" ); ?> >Count</option>
				<option value="Distance" <?php echo ( ( $sorting_field == 'Distance') ? "selected" : "" ); ?> >Distance</option>
			</select>
			<label>Rule</label>
			<select name="sorting_rule" class="sorting_rule">
				<option value="asc" <?php echo ( ( $sorting_rule == 'asc') ? "selected" : "" ); ?> >Ascending</option>
				<option value="desc" <?php echo ( ( $sorting_rule == 'desc') ? "selected" : "" ); ?> >Descending</option>
			</select>

		</div>
		<div>
			<button id="filter-button">Filter</button>
		</div>
	</div>
	<div id="tasks-list">
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
					<a href=""><?=$i; ?></a>
				<?php } else { ?>
					<span><?=$i; ?></span>
				<?php } ?>
			<?php } ?>
		</div>
	</div>	
<?php } ?>


<script>

function pages_links_init(){
	jQuery('.paging a').on('click', function(){
		var page = jQuery(this).html();
		ajax(page);
		return false;
	});
}
pages_links_init();


function ajax(page){
	var tasks = jQuery('#tasks-list');
	var filter = jQuery('#filter');
	jQuery.ajax({
		url: '<?=$filter_action; ?>',
		type: 'GET',
		data: {
			filter_field: filter.find("select[name='filter_field']").val(),
			filter_rule: filter.find("select[name='filter_rule']").val(),
			filter_value: filter.find("input[name='filter_value']").val(),
			sorting_field: filter.find("select[name='sorting_field']").val(),
			sorting_rule: filter.find("select[name='sorting_rule']").val(),
			page: page,
			request: 'ajax'
		},
		success: function(data) {
			if (data) {
				tasks.html(data);
			}
		},
		error: function(xhr, ajaxOptions, thrownError) {
			alert(thrownError + '\r\n' + xhr.statusText + '\r\n' + xhr.responseText);
		}
	});
}

jQuery('#filter-button').on('click', function(){
	ajax(1);
});

</script>
