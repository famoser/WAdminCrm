<?php
/**
 * Created by PhpStorm.
 * User: Florian Moser
 * Date: 25.05.2015
 * Time: 12:18
 */
?>

<?php include $_SERVER['DOCUMENT_ROOT'] . "/framework/templates/parts/header_crud.php"; ?>

    <form class="form-horizontal" action="settings/admin/<?php echo $this->link ?>/<?php echo GetValue($this->_['obj'], "Id") ?>" method="post">
        <p>Nach dem Erstellen des Adminaccounts wird eine Nachricht an diese E-Mail Adresse gesendet. Die E-Mail enthält
            einen Link, durch den der Admin seinen neuen Account aktivieren kann.</p>
        <input type="hidden" name="<?php echo $this->link ?>" value="true"/>

        <div class="clearfix">
            <div class="col-md-12">
                <?php echo GetInput($this->_["obj"], "Email", "Email", "email"); ?>
            </div>
        </div>
        <div class="clearfix">
            <div class="col-md-5">
                <?php echo GetInput($this->_["obj"], "FirstName", "first name"); ?>
            </div>
            <div class="col-md-5">
                <?php echo GetInput($this->_["obj"], "LastName", "last name"); ?>
            </div>
            <div class="col-md-2">
                <?php echo GetInput($this->_["obj"], "PaymentPerHour", "pay / hour"); ?>
            </div>
        </div>

        <div class="clearfix">
            <div class="col-md-12">
                <?php echo GetSubmit(); ?>
            </div>
        </div>
    </form>
<?php include $_SERVER['DOCUMENT_ROOT'] . "/framework/templates/parts/footer_crud.php"; ?>