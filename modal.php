<style type="text/css">
.modal-backdrop {
    visibility: hidden !important;
}
.modal.in {
    background-color: rgba(0,0,0,0.5);
}
</style>
<script src="assets/jquery/jquery-1.10.2.js"></script>
<script src="assets/stylesheet/bootstrap.min.js"></script>
<link rel="stylesheet" href="assets/stylesheet/bootstrap.css">

 <h2>Stacked Bootstrap Modal Example.</h2>
 <a data-toggle="modal" href="#myModal" class="btn btn-primary">Launch modal</a>

<div class="modal fade" id="myModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                	<h4 class="modal-title">Modal 1</h4>
            </div>
            <div class="container"></div>
            <div class="modal-body">Content for the dialog / modal goes here.
                <br>
                <br>
                <br>
                <p>more content</p>
                <br>
                <br>
                <br>	
                <a data-toggle="modal" href="#myModal2" class="btn btn-primary">Launch modal</a>
            </div>
            <div class="modal-footer">	<a href="#" data-dismiss="modal" class="btn">Close</a>
	           <a href="#" class="btn btn-primary">Save changes</a>
            </div>
        </div>
    </div>
</div>

<!--  -->
<div class="modal fade" id="myModal2">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                	<h4 class="modal-title">Modal 2</h4>
            </div>
            <div class="container"></div>
            <div class="modal-body">Content for the dialog / modal goes here.
                <br>
                <br>
                <p>come content</p>
                <br>
                <br>
                <br>
            </div>
            <div class="modal-footer">	<a href="#" data-dismiss="modal" class="btn">Close</a>
	           <a href="#" class="btn btn-primary">Save changes</a>
            </div>
        </div>
    </div>
</div>


<script type="text/javascript">
    $(document).ready(function () {

    $('#openBtn').click(function () {
        $('#myModal').modal({
            show: true
        })
    });

    $('.modal').on('show.bs.modal', function (event) {
        var idx = $('.modal:visible').length;
        $(this).css('z-index', 1040 + (10 * idx));
    });
    $('.modal').on('shown.bs.modal', function (event) {
        var idx = ($('.modal:visible').length) - 1; // raise backdrop after animation.
        $('.modal-backdrop').not('.stacked').css('z-index', 1039 + (10 * idx));
        $('.modal-backdrop').not('.stacked').addClass('stacked');
    });
});
</script>