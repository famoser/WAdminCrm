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
            <a href="milestones/add/<?php
            if (count($this->_["projects"]) == 1)
                echo $this->_["projects"][0]->Id; ?>" class="tilebutton dialogbutton"
               data-dialog-title="add new milestone"
               data-dialog-size="wide" data-dialog-type="primary">add new milestone <?php
                if (count($this->_["projects"]) == 1)
                    echo "to this project"; ?>
            </a>
        </div>

        <div class="col-md-12 content">
            <input type="text" class="searchinput" placeholder="Suche nach..." data-table-id="milestones">
        </div>
    </div>

    <div class="col-md-9 no-padding">
        <?php foreach ($this->_["projects"] as $project) { ?>
            <div class="content">
                <h2>
                    <a href="projects/bycustomer/<?php echo $project->CustomerId ?>"><?php echo $project->GetIdentification() ?></a>
                </h2>

                <table class="table table-hover sortable" id="milestones">
                    <thead>
                    <tr>
                        <th data-sort="string">
                            <a>name</a>
                        </th>
                        <th class="buttons buttons5"></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($project->Milestones as $milestone) {
                        ?>
                        <tr>
                            <td>
                                <a href="/procedures/bymilestone/<?php echo $milestone->Id; ?>"><?php echo $milestone->GetIdentification(); ?></a>
                            </td>
                            <td>
                                <div class="btn-group">
                                    <?php if ($milestone->IsCompletedBool)
                                        echo '<span class="flaticon-check64 tilebutton"></span>';
                                    ?>
                                    <a id="editbutton_<?php echo $milestone->Id; ?>"
                                       href="/milestones/edit/<?php echo $milestone->Id; ?>"
                                       class="tilebutton dialogbutton onlyicon"
                                       data-dialog-idbutton0="deletebutton_<?php echo $milestone->Id; ?>"
                                       data-dialog-title="Bearbeiten"
                                       data-dialog-type="warning"
                                       data-dialog-size="wide"
                                       role="button">
                                        <span class="flaticon-pencil124">bearbeiten</span>
                                    </a>
                                    <a id="deletebutton_<?php echo $milestone->Id; ?>"
                                       href="/milestones/delete/<?php echo $milestone->Id; ?>"
                                       class="tilebutton dialogbutton onlyicon"
                                       data-dialog-idbutton0="editbutton_<?php echo $milestone->Id; ?>"
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