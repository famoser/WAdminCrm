<?php
/**
 * Created by PhpStorm.
 * User: Florian Moser
 * Date: 13.09.2015
 * Time: 14:42
 */ ?>
<?php if (!IsAjaxRequest())
    include $_SERVER['DOCUMENT_ROOT'] . "/templates/parts/header.php";
?>
    <div class="col-md-3 right-content">
        <div class="col-md-12 content">
            <a href="projects/add/<?php
            if (count($this->_["customers"]) == 1)
                echo $this->_["customers"][0]->Id; ?>" class="tilebutton dialogbutton"
               data-dialog-title="add new project"
               data-dialog-size="wide" data-dialog-type="primary">add new project<?php
                if (count($this->_["customers"]) == 1)
                    echo " to this customer"; ?>
            </a>
        </div>

        <div class="col-md-12 content">
            <input type="text" class="searchinput" placeholder="Suche nach..." data-table-id="projects">
        </div>
    </div>


    <div class="col-md-9 no-padding">
        <?php foreach ($this->_["customers"] as $customer) { ?>

            <div class="content">
                <h2>
                    <?php echo $customer->GetIdentification() ?>
                </h2>

                <table class="table table-hover sortable" id="projects">
                    <thead>
                    <tr>
                        <th data-sort="string">
                            <a>name</a>
                        </th>
                        <th class="buttons buttons5"></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($customer->Projects as $project) {
                        ?>
                        <tr>
                            <td>
                                <a href="/milestones/byproject/<?php echo $project->Id; ?>"><?php echo $project->GetIdentification(); ?></a>
                            </td>
                            <td>
                                <div class="btn-group">
                                    <?php if ($project->IsCompletedBool)
                                        echo '<span class="flaticon-check64 tilebutton"></span>';
                                    ?>
                                    <a class="tilebutton onlyicon" href="projects/<?php echo $project->Id; ?>">
                                        <span class="flaticon-chart47">customer view</span>
                                    </a>
                                    <a id="editbutton_<?php echo $project->Id; ?>"
                                       href="/projects/edit/<?php echo $project->Id; ?>"
                                       class="tilebutton dialogbutton onlyicon"
                                       data-dialog-idbutton0="deletebutton_<?php echo $project->Id; ?>"
                                       data-dialog-title="Bearbeiten"
                                       data-dialog-type="warning"
                                       data-dialog-size="wide"
                                       role="button">
                                        <span class="flaticon-pencil124">bearbeiten</span>
                                    </a>
                                    <a id="deletebutton_<?php echo $project->Id; ?>"
                                       href="/projects/delete/<?php echo $project->Id; ?>"
                                       class="tilebutton dialogbutton onlyicon"
                                       data-dialog-idbutton0="editbutton_<?php echo $project->Id; ?>"
                                       data-dialog-title="Löschen"
                                       data-dialog-type="danger"
                                       role="button">
                                        <span class="flaticon-cancel22">löschen</span>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
            </div>
        <?php } ?>

    </div>


<?php if (!IsAjaxRequest())
    include $_SERVER['DOCUMENT_ROOT'] . "/templates/parts/footer.php";
?>