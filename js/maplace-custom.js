jQuery(document).ready(function($){
	
	var $this = '';
	
	$('.gmap').each(function(){
		
		$this = $(this);
		
		new Maplace({
			locations: [{
				icon: $this.data('marker'),
				lat: $this.data('lat'), 
				lon: $this.data('lon'),
				zoom: $this.data('zoom')
			}],
			
			map_div: "#"+$this.attr('id')
		}).Load(); 
	});
	
	
	
	
});