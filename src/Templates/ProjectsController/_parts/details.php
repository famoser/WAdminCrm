<?php
/**
 * Created by PhpStorm.
 * User: Florian Moser
 * Date: 13.09.2015
 * Time: 19:38
 */ ?>

<div class="col-md-3 right-content">
    <div class="col-md-12 content">
        <?php if ($this->_["project"]->CostCeiling > 0) { ?>
            <p class="no-margin-top">Kosten bis jetzt: <?php echo format_Money($this->_["project"]->TotalCost()) ?></p>
            <p class="no-margin-bot">Kostenlimite: <?php echo format_Money($this->_["project"]->CostCeiling) ?></p>
        <?php } else { ?>
            <p class="no-margin">Kosten bis jetzt: <?php echo format_Money($this->_["project"]->TotalCost()) ?></p>
        <?php } ?>
        <p class="no-margin">Arbeitszeit bis
            jetzt: <?php echo format_WorkingTime($this->_["project"]->TotalWorkingTime()) ?></p>
    </div>

    <div class="col-md-12 content">
        <p class="no-margin">
            <a href="mailto:me@famoser.ch">Florian Moser kontaktieren</a>
        </p>
    </div>
</div>

<div class="col-md-9 content">
    <h1><?php echo $this->_["project"]->Name ?></h1>

    <h2>Milestones</h2>

    <?php foreach ($this->_["project"]->Milestones as $milestone) { ?>

        <div class="group">
            <h3 class="group-header">
                <?php echo $milestone->Name ?> (<?php echo format_Money($milestone->TotalCost()) ?>)
            </h3>

            <div class="clearfix">
                <div class="col-md-6">
                    <p>
                        <b>Description: </b>
                        <?php echo format_Text($milestone->Description) ?>
                    </p>

                    <p>
                        <b>Deadline: </b>
                        <?php echo format_DateText($milestone->DeadlineDate) ?>
                    </p>

                    <p>
                        <b>Cost Ceiling: </b>
                        <?php echo format_Money($milestone->CostCeiling, false) ?>
                    </p>
                </div>

                <div class="col-md-3 circle border-left">
                    <p>percentage complete</p>

                    <div class="c100 p<?php echo $milestone->PercentageComplete ?>">
                        <span><?php echo $milestone->PercentageComplete ?>%</span>

                        <div class="slice">
                            <div class="bar"></div>
                            <div class="fill"></div>
                        </div>
                    </div>
                </div>

                <?php if ($milestone->CostCeiling > 0) { ?>
                    <div class="col-md-3 circle border-left">
                        <p>budget used</p>

                        <div
                            class="c100 p<?php echo format_Percentage($milestone->TotalCost(), $milestone->CostCeiling) ?>">
                            <span><?php echo format_Percentage($milestone->TotalCost(), $milestone->CostCeiling) ?>
                                %</span>

                            <div class="slice">
                                <div class="bar"></div>
                                <div class="fill"></div>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>


            <table class="table table-hover proceduretable">
                <tbody>

                <?php foreach ($milestone->Procedures as $procedure) { ?>
                    <tr>
                        <td><?php echo $procedure->Name ?></td>
                        <td><?php echo format_DateTimeNumbers($procedure->StartDateTime) ?></td>
                        <td><?php echo format_TimeSpanMinutes($procedure->StartDateTime, $procedure->EndDateTime) ?>
                            minutes
                        </td>
                        <td><?php echo format_Money($procedure->TotalCost()) ?></td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>
    <?php } ?>
</div>