<?php
/**
 * Created by PhpStorm.
 * User: Florian Moser
 * Date: 24.05.2015
 * Time: 10:15
 */
?>

<?php include $_SERVER['DOCUMENT_ROOT'] . "/Framework/Templates/Parts/header_content.php"; ?>
    <div class="col-md-3 right-content">
        <div class="col-md-12 content">
            <a href="customers/add" class="tilebutton dialogbutton" data-dialog-title="add new customer"
               data-dialog-size="wide" data-dialog-type="primary">add new customer
            </a>
        </div>

        <div class="col-md-12 content">
            <input type="text" class="searchinput" placeholder="Suche nach..." data-table-id="customers">
        </div>
    </div>

    <div class="col-md-9 content">
        <h1>customers</h1>
        <table class="table table-hover sortable" id="customers">
            <thead>
            <tr>
                <th data-sort="string">
                    <a>name</a>
                </th>
                <th class="buttons buttons4"></th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($this->_['customers'] as $customer) {
                ?>
                <tr>
                    <td>
                        <a href="/projects/bycustomer/<?php echo $customer->Id; ?>"><?php echo $customer->GetIdentification(); ?></a>
                    </td>
                    <td>
                        <div class="btn-group">
                            <a class="tilebutton onlyicon" href="mailto:<?php echo $customer->Email; ?>">
                                <span class="flaticon-envelope54">email</span>
                            </a>
                            <a id="editbutton_<?php echo $customer->Id; ?>" href="/customers/edit/<?php echo $customer->Id; ?>"
                               class="tilebutton dialogbutton onlyicon"
                               data-dialog-idbutton0="deletebutton_<?php echo $customer->Id; ?>"
                               data-dialog-title="Bearbeiten"
                               data-dialog-type="warning"
                               data-dialog-size="wide"
                               role="button">
                                <span class="flaticon-pencil124">bearbeiten</span>
                            </a>
                            <a id="deletebutton_<?php echo $customer->Id; ?>"
                               href="/customers/delete/<?php echo $customer->Id; ?>"
                               class="tilebutton dialogbutton onlyicon"
                               data-dialog-idbutton0="editbutton_<?php echo $customer->Id; ?>"
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

<?php include $_SERVER['DOCUMENT_ROOT'] . "/Framework/Templates/Parts/footer_content.php"; ?>