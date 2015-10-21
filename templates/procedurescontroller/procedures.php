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
            <a href="procedures/add/<?php
            if (count($this->_["milestones"]) == 1)
                echo $this->_["milestones"][0]->Id; ?>" class="tilebutton dialogbutton"
               data-dialog-title="add new procedure"
               data-dialog-size="wide" data-dialog-type="primary">add new procedure<?php
                if (count($this->_["milestones"]) == 1)
                    echo " to this milestone"; ?>
            </a>
        </div>

        <div class="col-md-12 content">
            <input type="text" class="searchinput" placeholder="Suche nach..." data-table-id="procedures">
        </div>
    </div>

    <div class="col-md-9 no-padding">

        <?php foreach ($this->_["milestones"] as $milestone) { ?>
            <div class="content">
                <h2>
                    <a href="milestones/byproject/<?php echo $milestone->ProjectId ?>"><?php echo $milestone->GetIdentification() ?></a>
                </h2>

                <table class="table table-hover sortable procedures" id="procedures">
                    <thead>
                    <tr>
                        <th data-sort="string">
                            <a>name</a>
                        </th>
                        <th data-sort="string">
                            <a>time</a>
                        </th>
                        <th class="buttons buttons2"></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($milestone->Procedures as $procedure) {
                        ?>
                        <tr>
                            <td>
                                <?php echo $procedure->GetIdentification(); ?>
                            </td>
                            <td>
                                <?php echo format_TimeSpanText($procedure->StartDateTime, $procedure->EndDateTime); ?>
                            </td>
                            <td>
                                <div class="btn-group">
                                    <a id="editbutton_<?php echo $procedure->Id; ?>"
                                       href="/procedures/edit/<?php echo $procedure->Id; ?>"
                                       class="tilebutton dialogbutton onlyicon"
                                       data-dialog-idbutton0="deletebutton_<?php echo $procedure->Id; ?>"
                                       data-dialog-title="Bearbeiten"
                                       data-dialog-type="warning"
                                       data-dialog-size="wide"
                                       role="button">
                                        <span class="flaticon-pencil124">bearbeiten</span>
                                    </a>
                                    <a id="deletebutton_<?php echo $procedure->Id; ?>"
                                       href="/procedures/delete/<?php echo $procedure->Id; ?>"
                                       class="tilebutton dialogbutton onlyicon"
                                       data-dialog-idbutton0="editbutton_<?php echo $procedure->Id; ?>"
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