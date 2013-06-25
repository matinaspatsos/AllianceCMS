<p>
    <strong>Please Enter Your Database Connection Information</strong>
</p>

<div class="content_separator"></div>

<?php
    for ($i = 0; $i < count($installData); $i++) {
        if (isset($installData[$i]['dbFirstIteration'])) {
            $firstIteration = 1;
        }
    }

    if (empty($dbHostName)) {
        $dbHostName = "";
    }

    if (empty($dbUserName)) {
        $dbUserName = "";
    }

    if (empty($dbDatabase)) {
        $dbDatabase = "";
    }

    if (empty($dbDatabasePrefix)) {
        $dbDatabasePrefix = "";
    }
?>

<?php if (!isset($firstIteration)): ?>
    <?php if ($dbHostName == ""): ?>
        <p>
            <span style="color: red;">Error: Please Enter A Host Name</span>
        </p>
    <?php endif; ?>
    <?php if ($dbUserName == ""): ?>
        <p>
            <span style="color: red;">Error: Please Enter A User Name</span>
        </p>
    <?php endif; ?>
    <?php if ($dbDatabase == ""): ?>
        <p>
            <span style="color: red;">Error: Please Enter A Database Name</span>
        </p>
    <?php endif; ?>
<?php endif; ?>

<?php $formHelper->inputFormStart("index.php"); ?>
    <table class="data_table">
        <tr>
            <td>
                <strong>Database Software:</strong>
            </td>
            <td>
                <?php $formHelper->inputSelect("dbSoftware", array(array("MySQL", "mysql"), array("PostgreSQL", "postgres"), array("MsSQL", "mssql"))); ?>
            </td>
        </tr>
        <tr>
            <td>
                <span style="color: red;">*</span> <strong>Host Name:</strong>
            </td>
            <td>
                <?php $formHelper->inputText("dbHostName", ((isset($installData[1]['dbHostName'])) ? $installData[1]['dbHostName'] : $dbHostName)); ?>
            </td>
        </tr>
        <tr>
            <td>
                <span style="color: red;">*</span> <strong>User Name:</strong>
            </td>
            <td>
                <?php $formHelper->inputText("dbUserName", ((isset($installData[2]['dbUserName'])) ? $installData[2]['dbUserName'] : $dbUserName)); ?>
            </td>
        </tr>
        <tr>
            <td>
                <strong>Password:</strong>
            </td>
            <td>
                <?php $formHelper->inputPassword("dbPassword", (isset($dbPassword)) ? $dbPassword : ""); ?>
            </td>
        </tr>
        <tr>
            <td>
                <span style="color: red;">*</span> <strong>Database:</strong>
            </td>
            <td>
                <?php $formHelper->inputText("dbDatabase", (isset($dbDatabase)) ? $dbDatabase : ""); ?>
                <?php $formHelper->inputCheckBox("dbCreateDatabase", "1", "", ((isset($dbCreateDatabase)) && ($dbCreateDatabase == "1") ? "1" : NULL)); ?>
                Create?
            </td>
        </tr>
        <tr>
            <td>
                <strong>Database Prefix:</strong>
            </td>
            <td>
                <?php $formHelper->inputText("dbDatabasePrefix", ((isset($installData[3]['dbDatabasePrefix'])) ? $installData[3]['dbDatabasePrefix'] : $dbDatabasePrefix)); ?>
            </td>
        </tr>
    </table>

    <?php
        $formHelper->inputHidden("install", "3");

        for ($i = 0; $i < count($installData); $i++) {
            foreach($installData[$i] as $attribute => $value) {
                if (((string)(strpos($attribute, "db")) !== ((string)0))) {
                    $formHelper->inputHidden($attribute, $value);
                }
            }
        }

        $formHelper->inputSubmit("submit", "Continue", array("class" => "button"));
    ?>

<?php $formHelper->inputFormEnd(); ?>

<p>
    <span style="color: red;">*</span> = Required Field
</p>