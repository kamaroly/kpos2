<?php

$lang['transfers_giftcard_number']='Gift Card Number';
$lang['transfers_select_insurance']='Select insurance';
$lang['transfers_insurance_percentage']='Enter contribution';

$lang['transfers_payment_currency']='Payment Currency';
$lang['transfers_no_amount_entered']='No amount entered';
$lang['transfers_must_enter_bank_name_and_check_number']='You must enter bank name and Check number';

$lang['transfers_successfully_saved_quotation'] ='Pro Forma Transaction done successfully';
$lang['transfers_failed_to_saved_quotation'] ='Pro Forma Transaction failed to be completed';

$lang['transfers_giftcard']='Gift Card';
$lang['transfers_register']='transfers Register';
$lang['transfers_locations']='Transfer Locations';
$lang['transfers_type']='transfers type';
$lang['transfers_new_item'] = 'New Item';
$lang['transfers_item_name'] = 'Item Name';
$lang['transfers_item_number'] = 'Item #';
$lang['transfers_new_customer'] = 'New';
$lang['transfers_customer'] = 'Customer';
$lang['transfers_no_items_in_cart']='There are no items in the cart';
$lang['transfers_total']='Total';
$lang['transfers_total_in']='Total in ';
$lang['transfers_total_foreign']='Total in foreign';
$lang['transfers_tax_percent']='Tax %';
$lang['transfers_price']='Price';
$lang['transfers_quantity']='Qty.';
$lang['transfers_discount']='Disc %';
$lang['transfers_edit']='Edit';
$lang['transfers_payment']='Payment Type';
$lang['transfers_edit_item']='Edit Item';
$lang['transfers_find_or_scan_item']='Find/Scan Item';
$lang['transfers_find_or_scan_item_or_receipt']='Find/Scan Item OR Receipt';
$lang['transfers_select_customer']='Select client';
$lang['transfers_start_typing_item_name']='Start Typing item\'s name or scan barcode...';
$lang['transfers_start_typing_customer_name']='Search client...';
$lang['transfers_sub_total']='Sub Total';
$lang['transfers_tax']='Tax';
$lang['transfers_comment']='Comment';
$lang['transfers_unable_to_add_item']='Unable to add item to Transfer';
$lang['transfers_Transfer_for_customer']='Customer:';
$lang['transfers_remove_customer']='Remove Customer';
$lang['transfers_error_editing_item']='Error editing item';
$lang['transfers_complete_transfer']='Complete Transfer';
$lang['transfers_complete_proforma']='Complete Pro Forma';
$lang['transfers_cancel_transfer']='Cancel Transfer';
$lang['transfers_add_payment']='Add Payment';
$lang['transfers_receipt']='transfers Receipt';
$lang['transfers_id']='Invoice No';
$lang['transfers_normal']='Normal';
$lang['transfers_grossary']='Grossary';
$lang['transfers_interprener']='Interprener';
$lang['transfers_transfer']='Transfer';
$lang['transfers_return']='Receiving';
$lang['transfers_confirm_finish_Transfer'] = 'Are you sure you want to submit this Transfer? This cannot be undone.';
$lang['transfers_confirm_cancel_Transfer'] = 'Are you sure you want to clear this Transfer? All items will cleared.';
$lang['transfers_cash'] = 'Cash';
$lang['transfers_check'] = 'Check';
$lang['transfers_insurance'] = 'Insurance';
$lang['transfers_debit'] = 'Debit Card';
$lang['transfers_credit'] = 'Credit Card';
$lang['transfers_giftcard'] = 'Gift Card';

//SDC MESSAGES
$lang['transfers_error_during_transaction']                            ="SDC error Occured during transaction,Please check if SDC is working well , or if it's powered on.";
$lang['transfers_sdc_not_connected']                                   ="Couldn't complete transfers because SDC is not connected on this computer";

$lang['transfers_sdc_not_connected_to_the_port']                       ="The set sdc port (_SDC_PORT_) is not correct. Please check the connection<br /> 
        (Right Click on My Computer->Select Properties->Hardware->Device Manager->Ports (COM & LPT))<br /> 
        If there is a comm-port on which SDC is connected, make sure that it is is well set in Configuration , on Left side under transfers Data Controller Menu";

$lang['sdc_error_internal_memory_full']                            ="SDC Internal memory full.";
$lang['sdc_error_internal_data_corrupted']                         ="SDC internal data corrupted.";
$lang['sdc_error_internal_memory_error']                           ="SDC Internal memory error.";
$lang['sdc_error_real_Time_Clock_error']                           ="SDC Real Time Clock error.";
$lang['sdc_error_wrong_command_code']                              ="SDC wrong command code.";
$lang['sdc_error_wrong_data_format_in_the_CIS_request_data']       ="Wrong data format in the CIS request data.";
$lang['sdc_error_wrong_TIN_in_the_CIS_request_data']               ="wrong TIN in the CIS request data.";
$lang['sdc_error_wrong_tax_rate_in_the_CIS_request_data']          ="Wrong tax rate in the CIS request data";
$lang['sdc_error_invalid_receipt_number_int_the_CIS_request_data'] ="Invalid receipt number int the CIS request data";

$lang['sdc_error_sdc_not_activated']                               ="SDC not activated";
$lang['sdc_error_sdc_already_activated']                           ="SDC already activated";
$lang['sdc_error_sim_card_error']                                  ="SIM card error";
$lang['sdc_error_gprs_modem_error']                                ="GPRS modem error";
$lang['sdc_error_hardware_intervention_is_necessary']              ="Hardware intervention is necessary";

$lang['sdc_is_busy']                                               ="SDC is busy/not responding please switch it off  and on again.";


//Insurances
$lang['transfers_rama'] = 'RAMA';
$lang['transfers_soras'] = 'SORAS';
$lang['transfers_colar'] = 'COLAR';
$lang['transfers_radiant'] = 'RADIANT';


$lang['transfers_amount_tendered'] = 'Amount Tendered';
$lang['transfers_change_due'] = 'Change Due';
$lang['transfers_payment_not_cover_total'] = 'Payment Amount does not cover Total';

$lang['transfers_transaction_failed'] = 'transfers Transaction Failed';
$lang['transfers_transaction_success'] = 'transfers Transaction completed successfully';

$lang['transfers_must_enter_numeric'] = 'Must enter numeric value for amount tendered';
$lang['transfers_must_enter_numeric_giftcard'] = 'Must enter numeric value for giftcard number';
$lang['transfers_serial'] = 'Serial';
$lang['transfers_description_abbrv'] = 'Desc';
$lang['transfers_item_out_of_stock'] = 'Item is Out of Stock';
$lang['transfers_item_insufficient_of_stock'] = 'Item is Insufficient of Stock';
$lang['transfers_quantity_less_than_zero'] = 'Warning, Desired Quantity is Insufficient. You can still process the Transfer, but check your inventory';
$lang['transfers_successfully_updated'] = 'Transfer successfully updated';
$lang['transfers_unsuccessfully_updated'] = 'Transfer unsuccessfully updated';
$lang['transfers_edit_Transfer'] = 'Edit Transfer';
$lang['transfers_employee'] = 'Employee';
$lang['transfers_successfully_deleted'] = 'Transfer successfully deleted';
$lang['transfers_unsuccessfully_deleted'] = 'Transfer unsuccessfully deleted';
$lang['transfers_delete_entire_Transfer'] = 'Delete entire Transfer';
$lang['transfers_delete_confirmation'] = 'Are you sure you want to delete this Transfer, this action cannot be undone';
$lang['transfers_date'] = 'Transfer Date';
$lang['transfers_delete_successful'] = 'You have successfully deleted a Transfer';
$lang['transfers_delete_unsuccessful'] = 'You have unsuccessfully deleted a Transfer';
$lang['transfers_suspend_transfer'] = 'Suspend Transfer';
$lang['transfers_confirm_suspend_Transfer'] = 'Are you sure you want to suspend this Transfer?';
$lang['transfers_receive_transfers'] = 'Receive Stock from other locations';
$lang['transfers_suspended_Transfer_id'] = 'Suspended Transfer ID';
$lang['transfers_date'] = 'Date';
$lang['transfers_customer'] = 'Customer';
$lang['transfers_comments'] = 'Comments';
$lang['transfers_unsuspend_and_delete'] = 'Unsuspend and Delete';
$lang['transfers_unsuspend'] = 'Unsuspend';
$lang['transfers_successfully_suspended_Transfer'] = 'Your Transfer has been successfully suspended';
$lang['transfers_successfully_saved_quatation'] = 'Your Quotation has been successfully saved';
$lang['transfers_successfully_saved_draft'] = 'Your Draft has been successfully saved';
$lang['transfers_email_receipt'] = 'E-Mail Receipt';
$lang['transfers_please_select_client']='You must select the customer in order to continue';

$lang['transfers_you_are_selling_on_credit_have_to_choose_customer']='You are selling on credit, You have to choose the customer';
?>