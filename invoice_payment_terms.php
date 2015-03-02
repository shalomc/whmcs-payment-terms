<?php

 function hook_invoice_payment_terms($vars) {
 // Setup
 $adminuser = "apiapi";
 $responsetype = "json";  // Probably unnecessary
 $termsKey = 'customfields1'; 
 
 $invoiceid = $vars['invoiceid'];
 $invoicesource =$vars['source'] ;
 $creatinguser = $vars['user'] ; 

 // Get Invoice structure 
 $command = "getinvoice";
 $values["invoiceid"] = $invoiceid;
 $values["responsetype"] = $responsetype ; 
 $getinvoice = localAPI($command,$values,$adminuser);

 $values = null; 
 unset($values);
 
 // Get customer details
 $command = "getclientsdetails";
 $values["clientid"] = $getinvoice['userid'];
 $values["stats"] = false;
 $values["responsetype"] = $responsetype ; 

 $getclientsdetails = localAPI($command,$values,$adminuser);

 $values = null; 
 unset($values);

 // Add payment terms to due date from customfields1
 $datestr=$getinvoice["duedate"];
 $errorOnTerms = false; 
 // check for errors on payment terms. If error then don't modify
 if ( ($duedate=strtotime($datestr . " " . $getclientsdetails[$termsKey])) === false) {
	$errorOnTerms = true ;
 }

 // Update invoice if not error 
 if ( !($errorOnTerms) ) {
	 $command = "updateinvoice";
	 $values["invoiceid"] = $invoiceid;
	 $values["duedate"] = date('Ymd', $duedate);
	 $values["responsetype"] = $responsetype ; 
 
	 $updateinvoice = localAPI($command,$values,$adminuser);

 	 $values = null;  
 	 unset($values);
 }

}
  
 add_hook("InvoiceCreation",99,"hook_invoice_payment_terms");
 
