    <div class="../sidebar-overlay" data-reff="../"></div>
	<script src="{{asset('assets/js/popper.min.js')}}"></script>
    {{-- <script src="{{asset('assets/js/bootstrap.min.js')}}"></script> --}}
	<script src="{{asset('assets/plugins/amchart/js/amchart.js')}}"></script>
	<script src="{{asset('assets/plugins/amchart/js/serial.js')}}"></script>
	<script src="{{asset('assets/plugins/amchart/js/light.js')}}"></script>
	<script src="{{asset('assets/plugins/amchart/js/amstock.js')}}"></script>
	<script src="{{asset('assets/plugins/amchart/js/pie.js')}}"></script>
    <script src="{{asset('assets/plugins/amchart/js/responsive.min.js')}}"></script>
    <script src="{{asset('assets/js/Chart.bundle.js')}}"></script>
	<script src="{{asset('assets/plugins/morris/morris.js')}}"></script>
 	<script src="{{asset('assets/js/select2.min.js')}}"></script>
	<script src="{{asset('assets/js/jquery.slimscroll.js')}}"></script>
	<script src="{{asset('assets/js/moment.min.js')}}"></script>
    <script src="{{asset('assets/js/bootstrap-datetimepicker.min.js')}}"></script>
    <script src="{{asset('assets/js/app.js')}}"></script>
    <script src="{{asset('assets/js/msgpop.js')}}"></script>
    <script src="{{asset('assets/js/functions.js')}}"></script>

    <script>
        $(document).ready( function () {
            $('.table').DataTable();
        } );
    </script>

    {{-- <script>
        var script = document.createElement("script");
        script.type = "text/javascript";
        var pathname = window.location.pathname;

        if(pathname == '/user/drugs'){
            script.src = "{{asset('js/app.js')}}";
        }

        document.body.appendChild(script);
    </script> --}}

