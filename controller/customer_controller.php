<?php
include_once __DIR__ . '/../model/customer.php';
class CustomerController extends Customer
{
    public function getCustomers()
    {
        $customers = $this->getCustomerList();
        return $customers;
    }

    public function addCustomers($name, $phone, $email, $addresss)
    {
        $result = $this->createCustomer($name, $phone, $email, $addresss);
        return $result;
    }
}
?>