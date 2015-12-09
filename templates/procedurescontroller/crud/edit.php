<?php
/**
 * Created by PhpStorm.
 * User: Florian Moser
 * Date: 24.05.2015
 * Time: 11:20
 */
?>
<?php include $_SERVER['DOCUMENT_ROOT'] . "/framework/templates/parts/header_crud.php"; ?>

    <form action="procedures/<?php echo $this->link ?>/<?php echo GetValue($this->_['obj'], "Id") ?>/" method="post">

        <input type="hidden" name="<?php echo $this->link ?>" value="true"/>

        <div class="clearfix">
            <div class="col-md-12">
                <?php echo GetInput($this->_["obj"], "MilestoneId", "milestone", "select", $this->_["milestones"]); ?>
            </div>
        </div>
        <hr/>

        <div class="clearfix">
            <div class="col-md-6">
                <?php echo GetInput($this->_["obj"], "StartDateTime", "start", "datetime"); ?>
            </div>

            <div class="col-md-6">
                <?php echo GetInput($this->_["obj"], "EndDateTime", "end", "datetime"); ?>
            </div>
        </div>

        <hr/>
        <div class="clearfix">
            <div class="col-md-8">
                <?php echo GetInput($this->_["obj"], "Name", "name"); ?>
            </div>

            <div class="col-md-4">
                <?php echo GetInput($this->_["obj"], "PaymentPerHour", "payment", "number"); ?>
            </div>
        </div>

        <div class="clearfix">
            <div class="col-md-12">
                <?php echo GetInput($this->_["obj"], "Description", "description", "textarea"); ?>
            </div>
        </div>



        <div class="clearfix">
            <div class="col-md-12">
                <?php echo GetSubmit() ?>
            </div>
        </div>
    </form>

<?php include $_SERVER['DOCUMENT_ROOT'] . "/framework/templates/parts/footer_crud.php"; ?>