<?php
  include "../phpinvoice.php";
  $invoice = new phpinvoice('decentblue','Legal', '$');

  // Header Settings 
  $invoice->setLogo("../templates/decentblue/logo.jpg");
  $invoice->setType("Purchase Invoice");
  $invoice->setReference("INV-55033645");
  $invoice->setDate(date('M dS ,Y',time()));
  $invoice->setDue(date('M dS ,Y',strtotime('+3 months')));
  $invoice->setFrom(array("Company Name","100 Cool Heights, XY 80000, US","(602) 519-0450","company@example.com"));
  $invoice->setTo(array("John Doe","796 Silver Harbour,","TX 79273, US","john@example.com"));

  // Adding Items in table
  $invoice->addItem("AMD Athlon X2DC-7450","2.4GHz/1GB/160GB/SMP-DVD/VB",1,"50%",100,"50%");
  $invoice->addItem("PDC-E5300","2.6GHz/1GB/320GB/SMP-DVD/FDD/VB",1,50,100,50);
  $invoice->addItem('LG 18.5" WLCD',"Test multilingue soutenu dans cette section en ajoutant personnalisée description du produit ici",1,0,100,0);
  $invoice->addItem("HP LaserJet (Citroën) źłóźśćąę ","Ceci est une description de test pour le produit HP LaserJet 5200",1,0,100,20);

  // Make sure to add  "$invoice->items_total" first before adding other "addTotal()"
  $invoice->addTotal("Sub Total",		$invoice->items_total);
  $invoice->addTotal("VAT 10%", 	 	$invoice->GetPercentage(10));
  $invoice->addTotal("Discount 10%", 	$invoice->GetPercentage(10),"red",true);
  $invoice->addTotal("Shipment", 		"100");
  $invoice->addTotal("Grand Total",	 	$invoice->GetGrandTotal());

  // Add title 
  $invoice->addTitle("NOTICE:");
  // Add Paragraph
  $invoice->addParagraph("A finance charge of 1.5% will be made on unpaid balances after 30 days.");
  // Set footer note
  $invoice->setFooternote("Buy this script from <a href='http://codecanyon.net/item/php-invoice-php-class-for-beautiful-pdf-invoices/9512525/'>codecanyon</a> ");
  
  echo $invoice->render('example2.pdf','I'); /* I => Display on browser, D => Force Download, F => local path save, S => return document path */
?>