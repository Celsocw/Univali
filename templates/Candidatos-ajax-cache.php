<?php
	$rdata = array_map('to_utf8', array_map('safe_html', array_map('html_attr_tags_ok', $rdata)));
	$jdata = array_map('to_utf8', array_map('safe_html', array_map('html_attr_tags_ok', $jdata)));
?>
<script>
	$j(function() {
		var tn = 'Candidatos';

		/* data for selected record, or defaults if none is selected */
		var data = {
			Partido: <?php echo json_encode(['id' => $rdata['Partido'], 'value' => $rdata['Partido'], 'text' => $jdata['Partido']]); ?>,
			Nome: <?php echo json_encode(['id' => $rdata['Nome'], 'value' => $rdata['Nome'], 'text' => $jdata['Nome']]); ?>
		};

		/* initialize or continue using AppGini.cache for the current table */
		AppGini.cache = AppGini.cache || {};
		AppGini.cache[tn] = AppGini.cache[tn] || AppGini.ajaxCache();
		var cache = AppGini.cache[tn];

		/* saved value for Partido */
		cache.addCheck(function(u, d) {
			if(u != 'ajax_combo.php') return false;
			if(d.t == tn && d.f == 'Partido' && d.id == data.Partido.id)
				return { results: [ data.Partido ], more: false, elapsed: 0.01 };
			return false;
		});

		/* saved value for Nome */
		cache.addCheck(function(u, d) {
			if(u != 'ajax_combo.php') return false;
			if(d.t == tn && d.f == 'Nome' && d.id == data.Nome.id)
				return { results: [ data.Nome ], more: false, elapsed: 0.01 };
			return false;
		});

		cache.start();
	});
</script>

