<?php
session_start();

require_once "D:\ITI_Material\xml\Project\PHP_xmlParser\\vendor\autoload.php";
error_reporting(E_ERROR | E_PARSE);

$companyXmlCrud = new CompanyXmlCrud();
$recordCount = $companyXmlCrud->recordCount();

//set the employee position
if (isset($_GET["id"])) {
    if (($_GET["id"]) > $recordCount) {
        $currentEmp = $recordCount;
    } elseif ($_GET["id"] < 1) {
        $currentEmp = 1;
    } else {
        $currentEmp = $_GET["id"];
    }
} else {
    $currentEmp = 1;
}

$next = ($currentEmp + 1 <= $recordCount) ? $currentEmp + 1 : $currentEmp;
$prev = ($currentEmp - 1 != 0) ? $currentEmp - 1 : $currentEmp;

//display the current employee
$employeeDTO = $companyXmlCrud->readByPosition($currentEmp);
$name = $employeeDTO->getName();
$phone = $employeeDTO->getPhone();
$address = $employeeDTO->getAddress();
$email = $employeeDTO->getEmail();

//if GET and crud button was pressed
if (!empty($_GET)) {

    //get the user inputed data or currently displayed
    $inputName = $_GET["name"];
    $inputPhone = $_GET["phone"];
    $inputAddress = $_GET["address"];
    $inputEmail = $_GET["email"];

    if (isset($_GET["insert"])) {
        $companyXmlCrud->createEmployee($inputName, $inputPhone, $inputAddress, $inputEmail);
        $currentEmp = $companyXmlCrud->recordCount();
        $employeeDTO = $companyXmlCrud->readByPosition($currentEmp);
    } elseif (isset($_GET["update"])) {
        $companyXmlCrud->updateEmployeeRecord($currentEmp, $inputName, $inputPhone, $inputAddress, $inputEmail);
        $employeeDTO = $companyXmlCrud->readByPosition($currentEmp);
    } elseif (isset($_GET["delete"])) {
        $companyXmlCrud->deleteEmp($currentEmp);
        // $currentEmp -= 1;
        // $employeeDTO = $companyXmlCrud->readByPosition($currentEmp);
    } elseif (isset($_GET["search"])) {
        $employeeDTO = $companyXmlCrud->searchByName($_GET["name"]);
        $currentEmp = $employeeDTO->getPosition();
    }
    $name = $employeeDTO->getName();
    $phone = $employeeDTO->getPhone();
    $address = $employeeDTO->getAddress();
    $email = $employeeDTO->getEmail();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Company data</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <header>
        <center>
            <h1>Company lorem data</h1>
        </center>
    </header>
    <form action="index.php" method="get" id="xml-form">
        <div class="container">
            <label class="flex inner-container justify-between align-center" name="id">Employee id : <?= $currentEmp ?></label>
            <div class="flex inner-container justify-between align-center">
                <label for="name">Name</label>
                <input type="text" name="name" id="name" value="<?= $name ?>" class="input-fields">
            </div>
            <div class="flex inner-container justify-between align-center">
                <label for="phone">Phone</label>
                <input type="text" name="phone" id="phone" value="<?= $phone ?>" class="input-fields">
            </div>
            <div class="flex inner-container justify-between align-center">
                <label for="address">Address</label>
                <input name="address" id="address" cols="30" rows="2" value="<?= $address ?>" class="input-fields"></input>
            </div>
            <div class="flex inner-container justify-between align-center">
                <label for="email">Email</label>
                <input type="text" name="email" id="email" value="<?= $email ?>" class="input-fields">
            </div>
            <div class="justify-center flex align-center">
                <button type="submit" name="insert" id="insert" class="button">insert</button>
                <button type="submit" name="update" id="update" class="button">update</button>
                <button type="submit" name="delete" id="delete" class="button">delete</button>
                <button type="submit" name="search" id="searchName" class="button">search</button>
            </div>
            <div class="justify-center flex align-center">
                <a class="button" href="index.php?id=<?= $prev ?>">
                    < prior</a>
                        <a class="button" href="index.php?id=<?= $next ?>">next ></a>
            </div>
        </div>
    </form>
</body>

</html>