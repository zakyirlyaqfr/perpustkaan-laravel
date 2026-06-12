<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Bootstrap Bundle JS -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>

<!-- Skrip Vendor dan Plugin -->
<script src="{{ asset('assets/vendors/js/vendor.bundle.base.js') }}"></script>
<script src="{{ asset('assets/vendors/chart.js/chart.umd.js') }}"></script>
<script src="{{ asset('assets/vendors/datatables.net/jquery.dataTables.js') }}"></script>
<script src="{{ asset('assets/vendors/datatables.net-bs5/dataTables.bootstrap5.js') }}"></script>
<script src="{{ asset('assets/js/dataTables.select.min.js') }}"></script>

<!-- Inject JS -->
<script src="{{ asset('assets/js/off-canvas.js') }}"></script>
<script src="{{ asset('assets/js/template.js') }}"></script>
<script src="{{ asset('assets/js/settings.js') }}"></script>
<script src="{{ asset('assets/js/todolist.js') }}"></script>

<!-- Custom JS -->
<script src="{{ asset('assets/js/jquery.cookie.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/js/dashboard.js') }}"></script>

<!-- Kode Kustom -->
<script src="{{ asset('assets/js/baru.js') }}"></script>

<!-- Page transition: fade out on internal link click -->
<script>
document.addEventListener('DOMContentLoaded', function(){
	var content = document.querySelector('.content-wrapper');
	if(!content) return;
	// ensure starting visible
	content.style.transition = 'opacity .22s ease-in';

	document.querySelectorAll('a').forEach(function(a){
		var href = a.getAttribute('href');
		if(!href || href === '#' || href.startsWith('javascript:') ) return;
		// skip external links
		try {
			var url = new URL(href, location.href);
			if(url.origin !== location.origin) return;
		} catch(e){ return; }

		a.addEventListener('click', function(e){
			// allow anchors that are form submits or have data-toggle behaviours
			if(a.getAttribute('data-bs-toggle') || a.getAttribute('data-toggle')) return;
			e.preventDefault();
			content.style.opacity = 0;
			setTimeout(function(){ location.href = href; }, 220);
		});
	});
});
</script>
