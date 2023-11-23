<?php

        require_once(BASE_PATH . '/template/admin/layouts/header.php');


?>
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h5"><i class="fas fa-newspaper"></i> Messages</h1>
        
    </div>
    <div class="table-responsive">
        <table class="table table-striped table-sm">
            <caption>List of messages</caption>
            <thead>
                <tr>
                    <th>#</th>
                    <th>status</th>
                    <th>body</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($messages as $message) { ?>
                <tr>
                    <td>
                        <?= $message['id'] ?>
                    </td>
                    <td>
                    <?= $message['status'] ?>
                     </td>
                    <td>
                        <?= substr($message['body'], 0, 35) . ' ...' ?>
                    </td>
                </tr>

                <?php } ?>

            </tbody>
        </table>
    </div>


    <?php

        require_once(BASE_PATH . '/template/admin/layouts/footer.php');


?>