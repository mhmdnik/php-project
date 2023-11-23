<?php

        require_once(BASE_PATH . '/template/admin/layouts/header.php');


?>


<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h5"><i class="fas fa-newspaper"></i> Articles</h1>
    <div class="btn-toolbar mb-2 mb-md-0">
        <a role="button" href="<?= url('admin/article/create') ?>" class="btn btn-sm btn-success">create</a>
        </div>
    </div>
    <div class="table-responsive">
        <table class="table table-striped table-sm">
            <caption>List of posts</caption>
            <thead>
                <tr>
                    <th>#</th>
                    <th>title</th>
                    <th>summary</th>
                    <th>view</th>
                    <th>status</th>
                    <th>image</th>
                    <th>cat ID</th>
                </tr>
            </thead>
            <tbody>
              
            <?php foreach ($articles as $article) { ?>
                <tr>
                    <td>
                        <?= $article['id'] ?>
                    </td>
                    <td>
                    <?= substr($article['title'], 0, 30) . ' ...'?>
                    <td>
                    <?= substr($article['summary'], 0, 35) . ' ...'?>
                    </td>
                    <td>
                    <?= $article['view'] ?>
                    </td>
                    <td>
                        <?php if($article['status'] == 'invisible') {?>
                        <a role="button" href="<?= url('admin/article/change-status/'.$article['id']) ?>">click to visible</a>
                        <?php } else{ ?>
                        <a role="button" href="<?= url('admin/article/change-status/'.$article['id']) ?>">click to not visible</a>
                            <?php } ?>
                    </td>
                    <td>
                        <img style="width: 80px;" src="<?= asset($article['image']) ?>" alt="">
                    </td>
                    <td>
                    <?= $article['category_name'] ?>
                    </td>
                    <td>
                        <a role="button" class="btn btn-sm btn-primary text-white" href="<?= url('admin/article/edit/' . $article['id']) ?>">edit</a>
                        <a role="button" class="btn btn-sm btn-danger text-white" href="<?= url('admin/article/delete/' . $article['id']) ?>">delete</a>
                    </td>
                </tr>

                <?php } ?>
                </tbody>

                </table>
        </div>




<?php

require_once(BASE_PATH . '/template/admin/layouts/footer.php');


?>