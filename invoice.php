<?php
  @session_start();
  @error_reporting(0);
  ini_set("display_errors", "0");
  include "./invoice/phpinvoice.php";
  $invoice = new phpinvoice('basic','A4', '€');

  //print_r($_SESSION); die;
  // Header Settings 
  $invoice->setLogo("./invoice/templates/basic/logo.jpg");
  $invoice->setType("Sales Invoice");
  $invoice->setReference($_SESSION['invoice']['inv_num']);
  $invoice->setDate($_SESSION['invoice']['inv_date']);
  $invoice->setDue( $_SESSION['invoice']['due_date']);
  $invoice->setFrom($_SESSION['invoice']['inv_from']);
  $invoice->setTo(  $_SESSION['invoice']['inv_to']);

  // Adding Items in table
  foreach($_SESSION['invoice']['items'] as $item)
  $invoice->addItem( $item[0], $item[1], $item[2], $item[3], $item[4], $item[5] );
  

  // Make sure to add  "$invoice->items_total" first before adding other "addTotal()"
  $invoice->addTotal("Sub Total",		$_SESSION['invoice']['sub_total']);
  $invoice->addTotal("VAT " . $_SESSION['invoice']['vat']. "%", $_SESSION['invoice']['total'] - $_SESSION['invoice']['sub_total']);
  $invoice->addTotal("Discount ", 	$_SESSION['invoice']['discount'] , (!empty($_SESSION['invoice']['discount']) ? "red" : "") , true);
  $invoice->addTotal("Shipment", 	$_SESSION['invoice']['shipment']);
  $invoice->addTotal("Grand Total",	 	$invoice->GetGrandTotal());

  // Set badge 
  $invoice->addBadge("Duplicate");
  // Add title 
  $invoice->addTitle("Footer Notice");
  // Add Paragraph
  $invoice->addParagraph("");
  $invoice->addParagraph("");
  // Set footer note
  $invoice->setFooternote("Buy this mail test from <a href='http://www.mail-analyzer.com'>mail-analyzer</a> ");
  
  echo $invoice->render('invoice' . $_SESSION['invoice']['inv_num'] . '.pdf','I'); /* I => Display on browser, D => Force Download, F => local path save, S => return document path */
