<?php
/**
 * Created by PhpStorm.
 * User: Florian Moser
 * Date: 24.05.2015
 * Time: 11:20
 */
?>
<?php include $_SERVER['DOCUMENT_ROOT'] . "/templates/parts/crudheader.php"; ?>

    <form action="customers/<?php echo $this->link ?>/<?php echo GetValue($this->_['obj'], "Id") ?>/" method="post">

        <input type="hidden" name="<?php echo $this->link ?>" value="true"/>

        <div class="clearfix">
            <div class="col-md-6">
                <?php echo GetInput($this->_["obj"], "CustomerSinceDate", "customer since", "date"); ?>
            </div>
        </div>
        <div class="clearfix">
            <div class="col-md-6">
                <?php echo GetInput($this->_["obj"], "Url","url"); ?>
            </div>
            <div class="col-md-6">
                <?php echo GetInput($this->_["obj"], "UrlPassword","url password"); ?>
            </div>
        </div>
        <hr/>

        <div class="clearfix">
            <div class="col-md-6">
                <?php echo GetInput($this->_["obj"], "Company","company"); ?>
            </div>
        </div>

        <div class="clearfix">
            <div class="col-md-6">
                <?php echo GetInput($this->_["obj"], "FirstName", "firstname"); ?>
            </div>

            <div class="col-md-6">
                <?php echo GetInput($this->_["obj"], "LastName","lastname"); ?>
            </div>
        </div>

        <hr/>
        <div class="clearfix">
            <div class="col-md-5">
                <?php echo GetInput($this->_["obj"], "AdressExtension","adress extension"); ?>
            </div>

            <div class="col-md-5">
                <?php echo GetInput($this->_["obj"], "Street","street"); ?>
            </div>

        </div>
        <div class="clearfix">
            <div class="col-md-2">
                <?php echo GetInput($this->_["obj"], "Land", "land"); ?>
            </div>

            <div class="col-md-4">
                <?php echo GetInput($this->_["obj"], "ZipCode","zip code"); ?>
            </div>

            <div class="col-md-6">
                <?php echo GetInput($this->_["obj"], "Place","place"); ?>
            </div>

        </div>
        <hr/>
        <div class="clearfix">

            <div class="col-md-6">
                <?php echo GetInput($this->_["obj"], "TelPrivat", "tel privat"); ?>
            </div>

            <div class="col-md-6">
                <?php echo GetInput($this->_["obj"], "TelBusiness", "tel business"); ?>
            </div>

        </div>

        <div class="clearfix">
            <div class="col-md-6">
                <?php echo GetInput($this->_["obj"], "Mobile","mobile"); ?>
            </div>

            <div class="col-md-6">
                <?php echo GetInput($this->_["obj"], "Email", "e-mail"); ?>
            </div>

        </div>
        <hr/>
        <div class="clearfix">

            <div class="col-md-6">
                <?php echo GetInput($this->_["obj"], "BirthDate", "birth date", "date"); ?>
            </div>

        </div>

        <hr/>

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

<?php include $_SERVER['DOCUMENT_ROOT'] . "/templates/parts/crudfooter.php"; ?>