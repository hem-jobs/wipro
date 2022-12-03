<div class="content-wrapper">
    <table class="table m-2">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Balance</th>
                <th>Joined</th>
                <th>Referals</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $users = mysqli_query($Core->dbCon, "SELECT * FROM `user` ORDER BY `id` ASC");
            while ($user = mysqli_fetch_object($users)) : ?>
                <tr>
                    <td><a href="javascript:void(0)"><?= $user->id ?></a></td>
                    <td><?= $user->name ?></td>
                    <td>$<?= $user->balance ?></td>
                    <td>
                        <div class="sparkbar" data-color="#00a65a" data-height="20"><?= $user->created ?></div>
                    </td>
                    <td>
                        <a href="./referals/view/<?=$user->id?>" type="button" class="btn btn-default">

                            <?php
                            $sql = "SELECT * FROM `user` WHERE `ref_id` = '$user->id'";
                            $sql = mysqli_query($Core->dbCon, $sql);
                            $num = $sql->num_rows;
                            if ($sql->num_rows) {
                                echo $sql->num_rows;
                            } else {
                                echo "0";
                            }
                            ?>
                        </a>
                    </td>

                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>