<!-- Main Footer -->
<footer class="main-footer">
    <strong>Copyright &copy; 2007-<?php echo date('Y') ?> <a href="./">Wipro</a>.</strong>
    All rights reserved.

</footer>
</div>
<!-- ./wrapper -->
<div class="modal fade" id="modal-default">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Referals</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table>
                    <thead>
                        <tr>
                            <th>S/N</th>
                            <th>ID</th>
                            <th>NAME</th>
                            <th>EMAIL</th>
                        </tr>

                    </thead>
                    <tbody>
                        <?php if ($num > 0) : ?>

                            <?php $i = 1;
                            while ($refe = mysqli_fetch_object($sql)) :  ?>
                                <tr>
                                    <td><?= $i ?></td>
                                    <td><?= $refe->id ?></td>
                                    <td><?= $refe->name ?></td>
                                    <td><?= $refe->email ?></td>
                                </tr>
                            <?php $i++;
                            endwhile; ?>
                        <?php else : ?>
                            <tr>No data</tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- REQUIRED SCRIPTS -->
<!-- jQuery -->
<script src="<?= $assets ?>/admin/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="<?= $assets ?>/admin/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- overlayScrollbars -->
<script src="<?= $assets ?>/admin/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="<?= $assets ?>/admin/dist/js/adminlte.js"></script>

<!-- PAGE PLUGINS -->
<!-- jQuery Mapael -->
<script src="<?= $assets ?>/admin/plugins/jquery-mousewheel/jquery.mousewheel.js"></script>
<script src="<?= $assets ?>/admin/plugins/raphael/raphael.min.js"></script>
<script src="<?= $assets ?>/admin/plugins/jquery-mapael/jquery.mapael.min.js"></script>
<!-- ChartJS -->
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="<?= $assets ?>/admin/dist/js/pages/dashboard2.js"></script>
</body>

</html>