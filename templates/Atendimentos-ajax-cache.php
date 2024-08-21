<?php
	$rdata = array_map('to_utf8', array_map('safe_html', array_map('html_attr_tags_ok', $rdata)));
	$jdata = array_map('to_utf8', array_map('safe_html', array_map('html_attr_tags_ok', $jdata)));
?>
<script>
	$j(function() {
		var tn = 'Atendimentos';

		/* data for selected record, or defaults if none is selected */
		var data = {
			Colaborador: <?php echo json_encode(['id' => $rdata['Colaborador'], 'value' => $rdata['Colaborador'], 'text' => $jdata['Colaborador']]); ?>,
			Eleitor: <?php echo json_encode(['id' => $rdata['Eleitor'], 'value' => $rdata['Eleitor'], 'text' => $jdata['Eleitor']]); ?>
		};

		/* initialize or continue using AppGini.cache for the current table */
		AppGini.cache = AppGini.cache || {};
		AppGini.cache[tn] = AppGini.cache[tn] || AppGini.ajaxCache();
		var cache = AppGini.cache[tn];

		/* saved value for Colaborador */
		cache.addCheck(function(u, d) {
			if(u != 'ajax_combo.php') return false;
			if(d.t == tn && d.f == 'Colaborador' && d.id == data.Colaborador.id)
				return { results: [ data.Colaborador ], more: false, elapsed: 0.01 };
			return false;
		});

		/* saved value for Eleitor */
		cache.addCheck(function(u, d) {
			if(u != 'ajax_combo.php') return false;
			if(d.t == tn && d.f == 'Eleitor' && d.id == data.Eleitor.id)
				return { results: [ data.Eleitor ], more: false, elapsed: 0.01 };
			return false;
		});

		cache.start();
	});
</script>

