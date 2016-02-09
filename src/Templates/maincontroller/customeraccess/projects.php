<?php
/**
 * Created by PhpStorm.
 * User: Florian Moser
 * Date: 13.09.2015
 * Time: 14:42
 */?>

<?php include $_SERVER['DOCUMENT_ROOT'] . "/Framework/Templates/Parts/header_content.php"; ?>

    <div class="col-md-9 content">
        <h1>projects</h1>
        <table class="table table-hover sortable" id="projects">
            <thead>
            <tr>
                <th data-sort="string">
                    <a>name</a>
                </th>
                <th class="buttons buttons1"></th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($this->_['projects'] as $project) {
                ?>
                <tr>
                    <td>
                        <a href="<?php echo $this->_['customer']->Url; ?>/<?php echo $project->Id; ?>"><?php echo $project->GetIdentification(); ?></a>
                    </td>
                    <td>
                        <div class="btn-group">
                            <?php if ($project->IsCompletedBool)
                                echo '<span class="flaticon-check64 tilebutton"></span>';
                            ?>
                        </div>
                    </td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>


<?php include $_SERVER['DOCUMENT_ROOT'] . "/Framework/Templates/Parts/footer_content.php"; ?>