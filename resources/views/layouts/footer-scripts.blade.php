<!-- jquery -->
<script src="{{ URL::asset('assets/js/jquery-3.3.1.min.js') }}"></script>
<!-- plugins-jquery -->
<script src="{{ URL::asset('assets/js/plugins-jquery.js') }}"></script>
<!-- plugin_path -->
<script type="text/javascript">
    var plugin_path = "{{asset('assets/js')}}/";

</script>

<!-- chart -->
<script src="{{ URL::asset('assets/js/chart-init.js') }}"></script>
<!-- calendar -->
<script src="{{ URL::asset('assets/js/calendar.init.js') }}"></script>
<!-- charts sparkline -->
<script src="{{ URL::asset('assets/js/sparkline.init.js') }}"></script>
<!-- charts morris -->
<script src="{{ URL::asset('assets/js/morris.init.js') }}"></script>
<!-- datepicker -->
<script src="{{ URL::asset('assets/js/datepicker.js') }}"></script>
<!-- sweetalert2 -->
<script src="{{ URL::asset('assets/js/sweetalert2.js') }}"></script>
<!-- toastr -->
@if (App::getLocale() === 'ar')
<script src={{ URL::asset('assets/js/bootstrap-datatables/jqueryEN.dataTables.min.js') }}></script>
<script src={{ URL::asset('assets/js/bootstrap-datatables/dataTablesEN.bootstrap4.min.js') }}></script>
@else
<script src={{ URL::asset('assets/js/bootstrap-datatables/jquery.dataTables.min.js') }}></script>
<script src={{ URL::asset('assets/js/bootstrap-datatables/dataTables.bootstrap4.min.js') }}></script>
@endif
<script src="{{ URL::asset('assets/js/toastr.js') }}"></script>
<!-- validation -->
<script src="{{ URL::asset('assets/js/validation.js') }}"></script>
<!-- lobilist -->
<script src="{{ URL::asset('assets/js/lobilist.js') }}"></script>
<!-- custom -->
<script src="{{ URL::asset('assets/js/custom.js') }}"></script>
@yield('js')
<script>
    function checkAll(classN,elem){
        var elements=document.getElementsByClassName(classN);
        if(elem.checked){
            for (let i = 0; i < elements.length; i++) {
                elements[i].checked=true;
            }
        }
            else{
                for (let i = 0; i < elements.length; i++) {
                elements[i].checked=false;
            }
        }
    }
</script>

