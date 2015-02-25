# whmcs-payment-terms
Allow automatic modification of the invoice due date based on the commercial terms with the customer

## Setup
* Create a new drop down custom client field to hold the payment terms value. I recommend that it is not mandatory, and available only to the admin. My list of values is: ,+ 1 month, + 30 days, + 15 days, + 3 months
* The first comma is to create an empty default value.
* Make the new field use sequence number 0, so it becomes the first custom field called "customfields1". 
* Modify the invoice_payment_terms.php file, give the $adminuser and $termsKey variables proper values. The $adminuser is an internal WHMCS user used for the local API calls.
* Place the invoice_payment_terms.php file in the includes/hooks folder.

## Usage
* Assign payment terms to a customer. 
* Create an invoice, manually or automatically. The due date will reflect the new payment terms. 
