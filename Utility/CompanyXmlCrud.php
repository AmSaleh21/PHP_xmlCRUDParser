<?php
require_once "vendor/autoload.php";

class CompanyXmlCrud
{
    //properties
    private $xmlFileHandler;
    public function __construct()
    {
        $this->xmlFileHandler = simplexml_load_file(_FILE_PATH_);
    }

    //CRUD operation methods
    public function createEmployee(string $name, string $phone, string $address, string $email)
    {
        $newEmp = $this->xmlFileHandler->addChild("employee");
        $newEmp->addChild("name", $name);
        $newEmp->addChild("phone", $phone);
        $newEmp->addChild("address", $address);
        $newEmp->addChild("email", $email);
        $this->saveToFile();
    }

    public function readByPosition(int $position): EmployeeDTO
    {
        $employee = $this->xmlFileHandler->xpath("/company/employee[$position]");
        // var_dump($employee);
        // echo "</br></br> break </br></br>";
        // var_dump($employee[0]);
        $employeeDTO = new EmployeeDTO();
        $employeeDTO->setName($employee[0]->name);
        $employeeDTO->setPhone($employee[0]->phone);
        $employeeDTO->setAddress($employee[0]->address);
        $employeeDTO->setEmail($employee[0]->email);
        $employeeDTO->setPosition($position);
        return $employeeDTO;
    }

    public function searchByName(string $name): EmployeeDTO
    {
        $employeeDTO = new EmployeeDTO();
        $recordCount = $this->recordCount();
        for ($iterator = 1; $iterator <= $recordCount; $iterator++) {
            $employee = $this->xmlFileHandler->xpath("/company/employee[$iterator]")[0];
            if (strcmp($employee->name, $name) == 0) {
                $employeeDTO->setPosition($iterator);
                $employeeDTO->setName($employee->name);
                $employeeDTO->setPhone($employee->phone);
                $employeeDTO->setAddress($employee->address);
                $employeeDTO->setEmail($employee->email);
                break;
            }
        }
        return $employeeDTO;
    }

    public function updateEmployeeRecord(int $position, string $name, string $phone, string $address, string $email)
    {
        $employee = $this->xmlFileHandler->xpath("/company/employee[$position]")[0];
        $employee->name = $name;
        $employee->phone = $phone;
        $employee->address = $address;
        $employee->email = $email;
        $this->saveToFile();
    }

    public function deleteEmp(int $position)
    {
        unset($this->xmlFileHandler->employee[$position]);
        $this->saveToFile();
    }

    //helper methods
    /** 
     * get all xml main tag count
     * @return int 
     */
    public function recordCount(): int
    {
        return $this->xmlFileHandler->count();
    }

    /**
     * save the property data to the xml file
     */
    private function saveToFile()
    {
        file_put_contents(_FILE_PATH_, $this->xmlFileHandler->saveXML());
    }
}
