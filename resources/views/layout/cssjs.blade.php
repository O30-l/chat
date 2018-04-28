<link rel="stylesheet" href="{{asset('css/bootstrap/bootstrap-3.3.7.min.css')}}">
<script type="text/javascript" src="{{asset('js/jquery/jquery-3.2.1.min.js')}}"></script>
<script type="text/javascript" src="{{asset('js/bootstrap/bootstrap-3.3.7.min.js')}}"></script>
<script type="text/javascript" src="{{asset('js/sweetalert/sweetalert-2.1.0.min.js')}}"></script>
<link rel="stylesheet" href="{{asset('css/fontawesome/fontawesome-all.min.css')}}">
<script type="text/javascript">
    <?php
        if(isset($_SESSION['sweetalert'])){
    ?>
        $(function(){
            swal({
                title:`{{$_SESSION["sweetalert"]["title"]}}`,
                text:`{{$_SESSION["sweetalert"]["content"]}}`,
                icon:`{{$_SESSION["sweetalert"]["type"]}}`
            });
        });
    <?php
        unset($_SESSION['sweetalert']);
        }
    ?>
</script>
